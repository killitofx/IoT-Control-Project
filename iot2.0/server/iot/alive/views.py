from django.shortcuts import render, render_to_response
from django.http import HttpResponse, JsonResponse
from .models import Alive
import urllib.parse
import time
# Create your views here.

def insert_data(request):
    now = int(time.strftime("%H%M", time.localtime()))
    try:
        id = request.GET.get('id')
        #id = urllib.parse.unquote(id)
        ip = request.GET.get('ip')
        #ip = urllib.parse.unquote(ip)
        Alive.objects.create(device_id=id,ip_address=ip,times=now)
        return HttpResponse(status=403)
    except:
        return HttpResponse(status=404)

def del_data(request):
    try:
        now = int(time.strftime("%H%M", time.localtime())) - 1
        data = Alive.objects.filter(times__lt=now).delete()
        return HttpResponse(status=403)
    except:
        return HttpResponse(status=404)

def get_data(request):
    response={}
    for obj in Alive.objects.all():
        response[obj.device_id]= obj.ip_address
    return JsonResponse(response)


def up_date(request):
    try:
        ip = request.GET.get('ip')
        id = request.GET.get('id')
        Alive.objects.filter(device_id=id).update(ip_address=ip)
        return HttpResponse(status=403)
    except:
        return HttpResponse(status=404)