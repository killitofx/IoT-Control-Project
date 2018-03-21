from wxpy import*
import requests
jurl = "http://192.168.10.11:8000/api/cn/"

bot=Bot()
my_friendall = bot.friends()    
@bot.register(my_friendall)
def auto_reply(msg):

    if '开' in msg.text:
        data = msg.text
        data = data.replace("开",'')
        r = requests.get(jurl + data +'/1')
        if r.status_code == 403:
            return "success"


    if '关' in msg.text:
        data = msg.text
        data = data.replace('关','')
        r = requests.get(jurl + data + '/0')
        if r.status_code == 403:
            return "success"


embed()
