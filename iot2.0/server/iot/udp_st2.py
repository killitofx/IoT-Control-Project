import requests
import json
import time
import socket
import threading

url = 'http://192.168.10.11:8000/'

api_url = url + 'api/'
alive_url = url + 'alive/'

s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
s.bind(("0.0.0.0", 9999))

def req(url,playload=0):
    if playload:
        kv = playload
        r = requests.get(url, params=kv)
        print(r.url)
    else:
        r = requests.get(url)
    return r.text


def udp_rec():
    print('start')
    while True:
        data, addr = s.recvfrom(1024)
        print(addr)
        #print('Received from %s:%s.' % addr,data)
        data = json.loads(data)
        if 'alive' in data['method']:
            ip_address = '%s:%s' % (addr[0], addr[1])
            kv = {'id': data['id'], 'ip':ip_address}
            req(alive_url + 'add', playload=kv)
            state = req(api_url + 'id/' + str(data['id']))
            state = json.loads(state)
            state = {"id":data['id'],"state":state['state'],"type":state['type']}
            state = json.dumps(state).encode()
            s.sendto(state, addr)




def clean_list():
    while True:
        req(alive_url + 'del')
        print("列表清理完成")
        time.sleep(60)


def check():
    try:
        while True:
            time.sleep(1)
            change_list=[]
            data1 = req(alive_url + 'get')
            data1 = json.loads(data1)
            data2 = req(api_url + 'gc')
            data2 = json.loads(data2)
            for i in data2.values():
                change_list.append(i)
                if str(i) in data1:
                    data3 = req(api_url + 'id/' + str(i))
                    data3 = json.loads(data3)
                    state = data3['state']
                    type = data3['type']
                    ip = data1[str(i)]
                    #('127.0.0.1', 62956)
                    sd = {'id':i,'state':state,'type':type}
                    sd = json.dumps(sd).encode()
                    ip = ip.split(':')
                    addr = (ip[0],int(ip[1]))
                    s.sendto(sd, addr)
                    req(api_url + 'cgc/'+ str(i))
                    print(sd,addr)
            # print(change_list)
    except:
        check()

threads = []
t1 = threading.Thread(target=check)
threads.append(t1)
t2 = threading.Thread(target=clean_list)
threads.append(t2)
t3 = threading.Thread(target=udp_rec)
threads.append(t3)
def main():
    for t in threads:
        t.setDaemon(True)
        t.start()
    t.join()

main()
# udp_rec()
# check()
# clean_list()