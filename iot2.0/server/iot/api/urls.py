from django.urls import path
from .import views

urlpatterns = [
    path('id/<int:id>', views.get_id, name="get_id"),
    path('name/<str:name>', views.get_name, name="get_name"),
    path('cn/<int:id>/<int:status>', views.i_change_status, name="i_change_status"),
    path('cn/<str:name>/<int:status>', views.n_change_status, name="n_change_status"),
    path('time/', views.get_time),
]