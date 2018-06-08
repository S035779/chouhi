#!/bin/sh
while true ; do

date +"%H:%M:%S"
echo "+++++++++++ asin_import ++++++++++++"
bin/cake asin_import
sleep 420

date +"%H:%M:%S"
echo "+++++++++++ fetch_items ++++++++++++"
bin/cake fetch_items
sleep 420

date +"%H:%M:%S"
echo "+++++++++++ fetch_offer_items ++++++++++++"
bin/cake fetch_offer_items
sleep 420

date +"%H:%M:%S"
echo "+++++++++++ get_report ++++++++++++"
bin/cake get_report
sleep 420

date +"%H:%M:%S"
echo "+++++++++++ submit_feed ++++++++++++"
bin/cake submit_feed
sleep 420

done
