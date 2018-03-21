from django.db import models
from django.contrib.auth.models import User
# Create your models here.
class Port(models.Model):
    port_name = models.CharField(max_length=15)
    port_type = models.IntegerField()
    port_state = models.IntegerField()
    is_change = models.BooleanField()
    last_updated_time = models.DateTimeField(auto_now=True)
    author = models.ForeignKey(User, on_delete=models.DO_NOTHING)

class Time(models.Model):
    ctrl = models.BooleanField()
    loop = models.BooleanField()
    port_id = models.IntegerField()
    s_time = models.IntegerField()
    c_time = models.IntegerField()
