#!/bin/bash
#以日期为版本号备份文件

#判断是否有参数
if [ $# != 1 ] ; then
	echo "USAGE: $0 FILENAME"
	exit 1;
fi
#判断输入的是否为文件或目录
if [[ ! -f "$1" ]] && [[ ! -d "$1" ]]; then
	echo "ERROR：file/dir [$1] not found." 
	echo "USAGE: $0 FILENAME/DIRNAME"
	exit 1;
fi 

#取今天日期
now=`date +%m.%d.%H.%M`

#重命名
# mv ./"$1" "${1%-*}"-0."$now"

#压缩
tar -zcvf "${1%/*}"-0."$now".tar.gz "${1%/*}"
echo "[backup "${1%/*}"-0."$now".tar.gz succeed.]"