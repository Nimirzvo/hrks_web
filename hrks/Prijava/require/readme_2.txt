BackupZip 2
===================================

Copyright (c) 2008 by Black Widow
http://www.blackwidows.co.uk
Adapted from backupDB() by James Heinrich <info@silisoftware.com> available at http:www.silisoftware.com                        
This code is released under the GNU GPL
http:www.gnu.org/copyleft/gpl.html                            

Support via http://forum.quirm.net

A simple method for creating zipped database backups for download via ftp.

===================================
REQUIREMENTS

	PHP 4.1.0 (or higher) with zlib support                       
	MySQL 3.22 (or higher)                                        

===================================
BEFORE YOU DO ANYTHING ELSE

	1. Rename mybackup.php
	2. Rename backupzip.php
	
If you do not rename these files, multiple backups could triggered by anyone with a copy of this readme!

===================================
CONFIGURATION
Edit your newly renamed copy of mybackup.php:

$debug
	Debugging switch. If not set to 0, messages will be output to the browser window.
	Set to 0 if using cron.

$dbs
	An array of the databases that you want backed up.
	For each database, you will need to provide the associated username and password in the format:
	database_name => array(database_username, database_password)

	Example:
		$dbs = array(
		'db_one'=> array('user1','foobar'),
		'db_two' => array('user2','barfoo')
		);

$dbhost
	Your MySQL host - often 'localhost'

$admin_email
	A valid email address to send any error/warning messages to
	
$backup_script
	The name (and path to, if necessary) of your newly renamed copy of backupzip.php

===================================
INSTALLATION                                                              
                                                                 
	1. Upload both php files
		Both files do not have to reside in the same directory. For additional security, you may wish to place the backupzip file outside of publically accessible web root directory.

	2. Create a sub-directory called 'zips' IN THE SAME DIRECTORY AS THE BACKUPZIP FILE and CHMOD it to 777 (-rwxrwxrx)
		This 'zips' directory will be used to store your zipped backups (1 zipped archive per database) until you download and/or remove them via FTP.

===================================
USAGE

Via web browser ($debug set to 1), navigate to:
http://www.your_domain/path_to_/your_renamed_copy_of_mybackup.php

Via cron ($debug set to 0), use:
	
	GET http://www.your_domain/path_to_/your_renamed_copy_of_mybackup.php > /dev/null

The ' > /dev/null' should stop you receiving messages from cron when the backup is successful.

Enjoy!
