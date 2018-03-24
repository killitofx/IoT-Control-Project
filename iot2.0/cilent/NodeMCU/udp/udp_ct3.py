import socket
import json
import time

device_id = 1
active_data = {"id": device_id, "method": "alive"}
apply_data = {"id": device_id, "method": "apply"}

def enc(data):
    data = json.dumps(data)
    data = data.encode()
    return data


s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)


def apply_state():
    pass


def main():
    data = enc(active_data)
    s.sendto(data, ('127.0.0.1', 9999))
    while True:
        rec_data = s.recv(1024).decode('utf-8')
        rec_data = json.loads(rec_data)
        if rec_data['id'] == device_id:
            print(rec_data)
            data = enc(apply_data)
            s.sendto(data, ('127.0.0.1', 9999))

main()