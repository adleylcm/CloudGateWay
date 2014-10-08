#! /bin/sh

if [ $# != 1 ] ; then
	echo "USAGE: $0 FILENAME"
	exit 1;
fi
#判断输入的是否为文件
if [ ! -f "$1" ] ; then
	echo "ERROR：file [$1] not found." 
	echo "USAGE: $0 FILENAME/DIRNAME"
	exit 1;
fi 

tar zxvf "$1"
