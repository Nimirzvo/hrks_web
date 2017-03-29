This program is free software; you can redistribute it and/or modify     
it under the terms of the GNU General Public License as published by     
the Free Software Foundation; either version 2 of the License, or        
(at your option) any later version.                                  
                  
Joseph McMurry
support@mcmwebsite.com
http://www.mcmwebsite.com
Version 0.1
1/8/2008                  
                                                                           
This program is distributed in the hope that it will be useful,          
but WITHOUT ANY WARRANTY; without even the implied warranty of           
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            
GNU General Public License for more details.     


filebackup.php backs up files.  It is recommended to be run in a password-protected or .htaccess protected directory.  You need to set the paths for the backup file location and the files to be backed up, in that order.

mysql_backup.php backs up a MySQL database.  Set the $dbhost, $dbname, $dbuser, and $dbpw variables to the appropriate values for your database.  Also set $backupDir

filebackup.php and mysql_backup.php need to be set to run nightly (or daily) using cron.
For the commands to run on cron use
php /full/path/to/backup/script/location/filebackup.php
php /full/path/to/backup/script/location/mysql_backup.php

autoBackup.php runs on your local PC - call it to download (using FTP internally) already created backups.  It must be run the same day as the backup is created.  Configure it using $sites with your FTP login information and backup locations on the server.

All backup directories must have write access.

Be sure to check your backups frequently for completeness and integrity!
