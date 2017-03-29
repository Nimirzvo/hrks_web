<?php

// Debugging switch. Set to 0 when not actively testing
$debug = 0;

// The address to send any error messages
$admin_email="your@your_domain";

// Your database hostname.
$dbhost = "localhost";

/* List of databases to be backed up 
Syntax: database_name => array(database_username, database_password)
Ensure that the final entry is NOT followed by a comma */
$dbs = array(
'hrks'=> array('root','')
);
/*
$dbs = array(
'database1_name'=> array('database1_username','database1_password'),
'database2_name'=> array('database2_username','database2_password')
);
*/
// name of backup script
$backup_script = 'backupzip_2.php';

//=============== END CONFIGURATION =================

foreach($dbs as $db => $dbinfo) {
	$dbname = $db;
	$dbuser = $dbinfo[0];
	$dbpass = $dbinfo[1];
	include $backup_script;
}
?>
