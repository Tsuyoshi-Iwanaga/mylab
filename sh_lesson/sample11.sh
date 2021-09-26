#!/bin/bash
f_ret() {
  if [ $1 = "y" ]; then
    return 0
  else
    return 1
  fi
}
f_ret y && echo "Success."
f_ret n || echo "Fail."