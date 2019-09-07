#!/bin/bash

echo 100 - $(vmstat 60 2 | tail -1 | awk '{print $(NF-2)}') | bc > /var/www/html/cpu_util.txt
chmod 444 /var/www/html/cpu_util.txt
