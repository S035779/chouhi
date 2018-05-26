#!/bin/sh
while true ; do
date +"%H:%M:%S"
bin/cake asin_import
sleep 300
bin/cake fetch_items
sleep 300
bin/cake fetch_offer_items
sleep 300
done
