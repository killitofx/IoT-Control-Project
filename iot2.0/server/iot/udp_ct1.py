import sqlite3
import json
import time
import socket
import threading


s=socket.socket(socket.AF_INET,socket.SOCK_DGRAM)
s.bind(("0.0.0.0",9999))




def get_django_data():
    conn = sqlite3.connect('db.sqlite3')
    cursor = conn.cursor()
    cursor.execute('SELECT id FROM api_port WHERE is_change=1')
    values = cursor.fetchall()
    for row in values:
        print(row[0])
    close_db()
    cursor.close()
    conn.close()


class db(object):
    def __init__(self):
        self.conn = sqlite3.connect('link.db')
        self.cursor = self.conn.cursor()
        try:
            self.cursor.execute("SELECT *  from LINK")
        except:
            self.cursor.execute('''CREATE TABLE LINK
       (DEVICE_ID       INT     ,
       IP_ADDRESS      VCHAR(30),
       TIMES           INT);''')
            self.conn.commit()

        finally:
            pass

    def times(self):
        now = int(time.strftime("%H%M", time.localtime()))
        return now

    #找出数据
    def select_data(self):
        self.cursor.execute("SELECT device_id, ip_address, times  from LINK ")
        valus = self.cursor.fetchall()
        print(valus)

    #删除数据
    def del_data(self):
        now = self.times() - 1
        self.cursor.execute("DELETE from LINK where TIMES < %d" % now )
        self.conn.commit()

    #更新数据
    def update_data(self):
        pass

    #插入数据
    def insert_data(self,device_id,ip_address):
        now = self.times()
        self.cursor.execute("INSERT INTO LINK (DEVICE_ID,IP_ADDRESS,TIMES) VALUES ('%d', '%s', '%d')" % (device_id,ip_address,now))
        print(ip_address)
        self.conn.commit()

    def close_db(self):
        self.conn.close()

def udp_rec():
    while True:
        data, addr = s.recvfrom(1024)
        print('Received from %s:%s.' % addr,data)
        data = json.loads(data)
        if 'alive' in data['method'] :
            ip_address = '%s:%s' % (addr[0],addr[1])
            db.insert_data(int(data['id']),ip_address)
            s.sendto(b'200',addr)
            time.sleep(10)
            break




db=db()
# #db.insert_data(6,"192.168.10.8:8000")
# db.del_data()
# db.select_data()
# db.close_db()
trd=threading.Thread(target=udp_rec)
trd.start()
