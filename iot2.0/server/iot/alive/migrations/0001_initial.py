# Generated by Django 2.0.2 on 2018-03-22 10:24

from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Alive',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('device_id', models.IntegerField()),
                ('ip_address', models.CharField(max_length=25)),
                ('times', models.IntegerField()),
            ],
        ),
    ]
