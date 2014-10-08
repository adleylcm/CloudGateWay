#!/bin/bash
#快进系统时间

#开始的系统时间
startTime="2013-08-01 00:00:00"
#结束的系统时间
stopTime="2013-11-28 00:00:00"

#快进的速度
#每秒快进的小时数
speedup_HourPerSec=1
#每秒快进的分钟数
#speedup_MinutePerSec=`expr $RANDOM % 10`
speedup_MinutePerSec=0
#每秒快进的秒数
#speedup_SecPerSec=`expr $RANDOM % 60`
speedup_SecPerSec=0

startTimeSec=$(date -d "$startTime" +%s)
stopTimeSec=$(date -d "$stopTime" +%s)

for((i=startTimeSec;i<=stopTimeSec;\
	i+=speedup_HourPerSec*3600+$speedup_MinutePerSec*60+speedup_SecPerSec));
	do 
	date -s @$i;
	sleep 1;
	done
