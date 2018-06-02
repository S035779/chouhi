#!/bin/sh
while true ; do

date +"%H:%M:%S"
echo "+++++++++++ asin_import ++++++++++++"
bin/cake asin_import
sleep 360

date +"%H:%M:%S"
echo "+++++++++++ fetch_items ++++++++++++"
bin/cake fetch_items
sleep 360

date +"%H:%M:%S"
echo "+++++++++++ fetch_offer_items ++++++++++++"
bin/cake fetch_offer_items
sleep 360

date +"%H:%M:%S"
echo "+++++++++++ get_report ++++++++++++"
bin/cake get_report
sleep 360

done
