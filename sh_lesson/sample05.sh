#!/bin/bash
CSVFILE="./src/sample.csv"

while IFS=, read aa bb cc;
do
  aa_arr+=($aa)
  bb_arr+=($bb)
  cc_arr+=($cc)
done < $CSVFILE

arr_max=`expr ${#aa_arr[*]}`

i=0
while [ $i -lt $arr_max ]
do
  echo ${aa_arr[$i]},${bb_arr[$i]},${cc_arr[$i]}
  i=`expr $i + 1`
done