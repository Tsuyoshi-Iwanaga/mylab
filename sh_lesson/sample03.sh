#!/bin/bash
read input1
case $input1 in
  yes )
    echo "OK!"
    ;;
  no )
    echo "NG!"
    ;;
  * )
    echo "Unknown"
    ;;
esac