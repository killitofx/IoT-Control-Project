import datetime
import pymysql
import time


def get_Time(method=0):
    now = datetime.datetime.now()
    if not method:
        times = int(now.strftime('%H%M'))
        return times
    else:
        times = now.strftime('%Y-%m-%d %H:%M:%S %f')
        return times

def compare (state, open_time, close_time):
    if close_time and get_Time() >= close_time:
        if state:
            return 0
        else:
            return 'no'
    elif open_time and get_Time() >= open_time:
        if not state:
            return 1
        else:
            return 'no'
    else:
        #print('data err')
        return 'no'


def data_change(devid, change_stage):
    global conn, cursor
    sql1 = "UPDATE STATE SET state = '%s' WHERE id = '%s'" % (change_stage, devid)
    try:
        cursor.execute(sql1)
        conn.commit()
        print("change deviceid=%d,state=%d" % (devid, change_stage), get_Time(1))
    except:
        conn.rollback()
        print('change error')

def data_clean(devid):
    global conn, cursor
    sql = "UPDATE `state` SET `time_ctrl` = '0',`open_time` = NULL, `close_time` = NULL WHERE `state`.`id` = '%d'" % devid
    try:
        cursor.execute(sql)
        conn.commit()
        print("del devid=", devid, 'at ', get_Time(1))
    except:
        conn.rollback()
        print('clean err')

def main():
    global conn, cursor
    sql = "SELECT time_ctrl,state,time_loop,open_time,close_time,id FROM state \
                        WHERE time_ctrl=1"
    try:
        cursor.execute(sql)
        results = cursor.fetchall()
        now = get_Time()
        #print('run state at', get_Time(1))
        for row in results:
            state = row[1]
            time_Loop = row[2]
            open_Time = row[3]
            close_Time = row[4]
            dev_id = row[5]
            #print(state, time_Loop, open_Time, close_Time)
            com = compare(state, open_Time, close_Time)
            #print (com)
            if com != 'no':
                data_change(dev_id, com)
            # if (not time_Loop) and (get_Time() > open_Time) and (get_Time() > close_Time):
            #     data_clean(dev_id)
            if not time_Loop:
                if get_Time() >= open_Time and get_Time() >= close_Time:
                    if not state:
                        data_clean(dev_id)

    except:
            print("select error at", get_Time(1))
    #conn.close()

def main_loop():
    global conn, cursor
    while True:
        try:
            print('stat at', get_Time(1))
            conn = pymysql.connect(host='127.0.0.1', user='root', passwd='', db='raspi', charset='utf8')
            cursor = conn.cursor()
            main()
            conn.close()
            print('finish at', get_Time(1))
            time.sleep(30)
            print('\n')
        except:
            main_loop()
            print('err reboot...', get_Time(1))

if __name__=='__main__':
    print('run at', get_Time(1))
    main_loop()
# main_loop()