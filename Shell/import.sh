#!/bin/bash
#**
#* Company: AlmaBay Networks Private Limited < www.almabay.com >
#* Author : Vishal Sood < vishal@almabay.com >
#*
# store the current dir
CUR_DIR=$(pwd)
SCRIPT_DIR=$(dirname $0)

echo "Starting in latest changes for SCRIPTs..."

while true
do
	php $SCRIPT_DIR/import.php
	sleep 10
done
echo "Complete!"