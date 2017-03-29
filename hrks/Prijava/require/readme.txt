Backup
===================================

Copyright (c) 2006 by Black Widow
http://www.blackwidows.co.uk

Support via http://forum.quirm.net

A simple method to output an sql database backup file to your web browser without using PhpMyAdmin.

===================================
REQUIREMENTS

* PHP4+

===================================
CONFIGURATION

Edit the CONFIG section of backup.php to fit your needs.

Database Settings
$mdb
The name of the database you wish to backup

$mhost
Your MySQL host - often 'localhost'

$muser
Your MySQL user name

$mpass = "";
The MySQL password for user $muser

$tables
If you want to back up all tables, leave the $tables array empty - eg $tables = array(); 
If you want to back tables alpah, beta and gamma, set up the $tables array as follows:

$tables = array("alpha","beta","gamma");


===================================
INSTALLATION & USAGE

Upload backup.php
Call using:
http://www.your_domain/path_to_/backup.php

The

Enjoy!



