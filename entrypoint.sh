#!/usr/bin/env sh
set -e

# std offset dst [offset],start[/time],end[/time]
# Mm.w.d
# This specifies day d of week w of month m.
# The day d must be between 0 (Sunday) and 6.
# The week w must be between 1 and 5;
#  week 1 is the first week in which day d occurs,
#  and week 5 specifies the last d day in the month.
# The month m should be between 1 and 12.

#TZ='EST+5EDT,M3.2.0/2,M11.1.0/2'
#export TZ

php-fpm8 -D
nginx -g 'daemon off;'
