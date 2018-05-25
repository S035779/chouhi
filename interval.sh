#!/bin/sh
while true ; do
date +"%H:%M:%S"
bin/cake fetch_items
sleep 600
done
