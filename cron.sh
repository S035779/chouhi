#!/bin/sh
while true ; do
date +"%H:%M:%S"
bin/cake asin_import
sleep 360
bin/cake fetch_items
sleep 360
bin/cake fetch_offer_items
sleep 360
done
