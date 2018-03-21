for i=0,8,1 do
gpio.mode(i,gpio.output)
end
gpio.write(0,0)

tmr.alarm(0, 5000, tmr.ALARM_AUTO, function()
--tmr.delay(1000000)
gpio.write(0,1)
http.get("http://192.168.10.5/test/raspi/api.php?dev_id=2&phone=17625002404&pw=LRKyWKxSf4mUrz9w7Wz7I6WQJlo=&method=0&data=state", nil, function(code, data)
    if (code < 0) then
      print("HTTP request failed")
      tmr.delay(1000000)
    else
t = sjson.decode(data)
for k,v in pairs(t) do 
k1=tonumber(k)
v1=tonumber(v)
print(k1,v1)
gpio.write(k1,v1)
tmr.delay(100000)
end
gpio.write(0,0)
end
end
)
end
)
--file.remove(“init.lua”)
