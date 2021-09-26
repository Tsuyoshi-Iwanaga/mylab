#!/bin/bash
echo "enter 0(True) or 1(False)"
read answer

if [ $answer = "0" ]; then
  echo "True"
elif [ $answer = "1" ]; then
  echo "False"
else
  echo "NG"
fi

echo `test $answer = "0"`

# 代わりにtestコマンドを使う書き方もある
# if test $answer = "2"; then
#   echo "OK"
# fi