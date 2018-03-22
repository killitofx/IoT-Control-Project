import socket
import json
import threading
import time
data0 = {"id": 1, "method": "alive"}
data1 = {"id": 1, "method": "ok"}
data = json.dumps(data0)
data = data.encode()
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)

def send():
    while True:
        # 发送数据:
        s.sendto(data, ('127.0.0.1', 9999))
        time.sleep(62)
        # # 接收数据:
        # r = s.recv(1024).decode('utf-8')
        # print(r)
        # break

def get():
    while True:
        data = s.recv(1024).decode('utf-8')
        print(data)

threads = []
t1 = threading.Thread(target=send)
threads.append(t1)
t2 = threading.Thread(target=get)
threads.append(t2)
def main():
    for t in threads:
        t.setDaemon(True)
        t.start()
    t.join()

main()