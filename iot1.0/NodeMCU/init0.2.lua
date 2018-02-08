for i=0,8,1 do
gpio.mode(i,gpio.OUTPUT)
print(i)
end


--gpio.write(5,0)

tmr.alarm(0, 5000, tmr.ALARM_AUTO, function()
gpio.write(0,0)
http.get("http://106.14.221.244/raspi/api.php?dev_id=1&phone=17625002404&pw=LRKyWKxSf4mUrz9w7Wz7I6WQJlo=&method=0&data=state", nil, function(code, data)
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
tmr.delay(10000)
end
gpio.write(0,1)
end
end
)
end
)
--file.remove(“init.lua”)
