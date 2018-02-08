from wxpy import*
import requests

url='https://killitofx.cc/arduino/sever.php'
url2='https://killitofx.cc/arduino/ad/sever.php'


bot=Bot()
my_friendall = bot.friends()    
@bot.register(my_friendall)
def auto_reply(msg):
    if '开书架灯' in msg.text:
        data={'port':'1','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if '关书架灯' in msg.text:
        data={'port':'1','state':'0'}
        r=requests.get(url,params=data)
        return r.text
   
    if '开灯' in msg.text:
        data={'port':'2','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if '关灯' in msg.text:
        data={'port':'2','state':'0'}
        r=requests.get(url,params=data)
        return r.text

    if 'p3=1' in msg.text:
        data={'port':'3','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p3=0' in msg.text:
        data={'port':'3','state':'0'}
        r=requests.get(url,params=data)
        return r.text

    if 'p4=1' in msg.text:
        data={'port':'4','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p4=0' in msg.text:
        data={'port':'4','state':'0'}
        r=requests.get(url,params=data)
        return r.text

    if 'p5=1' in msg.text:
        data={'port':'5','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p5=0' in msg.text:
        data={'port':'5','state':'0'}
        r=requests.get(url,params=data)
        return r.text

    if 'p6=1' in msg.text:
        data={'port':'6','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p6=0' in msg.text:
        data={'port':'6','state':'0'}
        r=requests.get(url,params=data)
        return r.text
        
    if 'p7=1' in msg.text:
        data={'port':'7','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p7=0' in msg.text:
        data={'port':'7','state':'0'}
        r=requests.get(url,params=data)
        return r.text
        
    if 'p8=1' in msg.text:
        data={'port':'8','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p8=0' in msg.text:
        data={'port':'8','state':'0'}
        r=requests.get(url,params=data)
        return r.text
        
    if 'p9=1' in msg.text:
        data={'port':'9','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p9=0' in msg.text:
        data={'port':'9','state':'0'}
        r=requests.get(url,params=data)
        return r.text

    if 'p10=1' in msg.text:
        data={'port':'10','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p10=0' in msg.text:
        data={'port':'10','state':'0'}
        r=requests.get(url,params=data)
        return r.text
        
    if 'p11=1' in msg.text:
        data={'port':'11','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p11=0' in msg.text:
        data={'port':'11','state':'0'}
        r=requests.get(url,params=data)
        return r.text
        
    if 'p12=1' in msg.text:
        data={'port':'12','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p12=0' in msg.text:
        data={'port':'12','state':'0'}
        r=requests.get(url,params=data)
        return r.text
        
    if 'p13=1' in msg.text:
        data={'port':'13','state':'1'}
        r=requests.get(url,params=data)
        return r.text
    if 'p13=0' in msg.text:
        data={'port':'13','state':'0'}
        r=requests.get(url,params=data)
        return r.text



embed()
