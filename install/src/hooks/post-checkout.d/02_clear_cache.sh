#!/bin/bash

ESC_SEQ="\x1b["
COL_RESET=$ESC_SEQ"39;49;00m"
COL_RED=$ESC_SEQ"0;31m"
COL_GREEN=$ESC_SEQ"0;32m"
COL_YELLOW=$ESC_SEQ"0;33m"

sudo chown -R www-data:www-data app/local/cache/
sudo chown -R www-data:www-data app/local/managed_cache/
sudo php -f bxcli cache:clear
php -f bxcli view:clear
exit 0
