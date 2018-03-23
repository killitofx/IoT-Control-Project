from urllib import urequest
from machine import Pin
import json
import time

device_id = 1
url = "http://192.168.10.30:8000/api/"
i = 0

while True:
    f = urequest.urlopen(url + "id/" + str(device_id))
    data = f.read()
    data = json.loads(data)
    port_id = data['id']
    is_change = data['change']
    if device_id == port_id:
        port_state = data["state"]
        port_type = data['type']
        if i == 0:
            if port_type:
                p2 = Pin(2, Pin.OUT)
                p2(port_state)
                i = 1
            else:
                p2 = Pin(2, Pin.IN)
                while True:
                    state = p2()
                    x = urequest.urlopen(url + "cn/" + str(device_id) + '/' + str(state))
                    time.sleep(1)
        else:
            if is_change == 1:
                p2(port_state)
