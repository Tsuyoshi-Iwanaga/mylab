#!/bin/bash
read in
echo "$in" | sed 's/abc/123/'
echo "$in" | sed 's/abc/123/g'