#!/bin/bash
cnt=0

until [ $cnt -eq 10 ]
do
  cnt=`expr ${cnt} + 1`
  echo $cnt
done