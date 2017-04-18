Calls Report by Gnovit.com
==========================

+ Copy the module to the modules folder.

+ Enable it in the session "Admin Modules"

+ Reload the configuration (retrieve_conf)

+ The schedules are executed via cron, include the line below:
```
 - 0 * * * * /usr/bin/php /var/www/html/admin/modules/callsreport/bin/verify_scheduling.php
```

+ The database tables are:
```
 - calls_report_scheduling
 - calls_report_send_log 
```
