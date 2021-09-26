#!/bin/bash
awk '
  BEGIN { print "Hello"; }
  { print $1; }
  ($1>10) { print "10 greater then"; }
  ($1<3) { print "3 less then"; }
  END { print "Bye"; }
'