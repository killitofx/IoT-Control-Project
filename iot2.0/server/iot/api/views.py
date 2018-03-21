from django.shortcuts import render_to_response, get_object_or_404
from django.http import HttpResponse, JsonResponse, FileResponse
from .models import Port
import time

# Create your views here.
def get_id(request,id):
    try:
        Port.objects.get(pk=id)
        data = Port.objects.get(pk=id)
        response = JsonResponse({'id': data.id, 'name': data.port_name, 'type': data.port_type, 'state': data.port_state, 'change': data.is_change})
        Port.objects.filter(pk=id).update(is_change=0)
        return response
    except:
        return HttpResponse(status=404)

def get_name(request,name):
    try:
        Port.objects.get(port_name=name)
        data = Port.objects.get(port_name=name)
        response = JsonResponse({'id': data.id, 'name': data.port_name, 'type': data.port_type, 'state': data.port_state})
        return response
    except:
        return HttpResponse(status=404)

def get_time(request):
    now = int(time.strftime("%H%M", time.localtime()))
    response = JsonResponse({'time': now})
    return response

def i_change_status(requests, id, status):
    try:
        Port.objects.get(pk=id)
        Port.objects.filter(pk=id).update(port_state=status)
        Port.objects.filter(pk=id).update(is_change=1)
        return HttpResponse(status=403)
    except:
        return HttpResponse(status=404)

def n_change_status(requests,name,status):
    try:
        Port.objects.get(port_name=name)
        Port.objects.filter(port_name=name).update(port_state=status)
        Port.objects.filter(port_name=name).update(is_change=1)
        return HttpResponse(status=403)
    except:
        return HttpResponse(status=404)



# def detail(request,port_id):
#     context = {}
#     context['data'] = get_object_or_404(Port, pk=port_id)
#     return render_to_response('port_detail.html', context)