<?php

/*
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
*/


$sites = array();
$date = date('Ymd');
$dateDash = date('m-d-Y');

// define an entry an the $site array for each site you want to backup
$sites[0] = array('host'=>'ftp.mysite.com', 'user'=>'ftp_username', 'password'=>'ftp_password', 
                    'dbBackupLocation'=>'server_folder_to_backup_db_to_here', 'dbBackupFilename'=>"db_$date".'.sql', 
                      'emailBackupLocation'=>'server_folder_to_backup_email_here', 'emailBackupFilename'=>'backup_mail_'.$dateDash.'.tar.gz',
                        'filesBackupLocation1'=>'server_folder_to_backup_files_here', 'filesBackupFilename1'=>'backup_files_'.$dateDash.'.tar.gz', 
                          'filesBackupLocation2'=>'server_folder_to_backup_2ndSet_files_here', 'filesBackupFilename2'=>'backup_files2_'.$dateDash.'.tar.gz');
  

         
function getBackup($conn, $location, $file, $mode, $local_file, $user) {
  ftp_chdir($conn, $location);
  $local_file = $user.'_'.$file;
  if (ftp_get($conn, $local_file, $file, $mode)) { // FTP_ASCII for ASCII text, FTP_BINARY FOR IMAGES AND VIDEO, ETC.
    echo "Successfully written to $local_file\n";
    
    // delete file on server
    ftp_delete($conn, $file);
    
  } 
  else {
    echo "There was a problem downloading the file\n";
  }
}        


                          

foreach ($sites as $site) {

   // connect to site using FTP
   $conn = ftp_connect($site['host']);
   if (!$conn) {
     echo "Error: Could not connect to FTP server<br>";
     exit;
   }
   echo "Connected to ".$site['host']."<br>";

  // log into host 
  $result = ftp_login($conn, $site['user'], $site['password']);
  if (!$result) {
    echo "Error: Could not log on as ".$site['user']."<br>";
    ftp_quit($conn);
    exit;
  }
  echo "Logged in as ".$site['user']."<br>";


  // download and save DB backup, email backup and file backup(s)
  if ( trim($site['dbBackupFilename']) != '' ) {  
     $local_file = $site['user'].'_'.$site['dbBackupFilename'];
     getBackup($conn, $site['dbBackupLocation'], $site['dbBackupFilename'], FTP_ASCII, $local_file, $site['user']);
  }
  
  if ( trim($site['emailBackupFilename']) != '' ) { 
     $local_file = $site['user'].'_'.$site['emailBackupFilename'];
     getBackup($conn, $site['emailBackupLocation'], $site['emailBackupFilename'], FTP_BINARY, $local_file, $site['user']);
  }  
  
  if ( trim($site['filesBackupFilename1']) != '' ) {   
     $local_file = $site['user'].'_'.$site['filesBackupFilename1'];
     getBackup($conn, $site['filesBackupLocation1'], $site['filesBackupFilename1'], FTP_BINARY, $local_file, $site['user']);
  }
  
  if ( trim($site['filesBackupFilename2']) != '' ) { 
     $local_file = $site['user'].'_'.$site['filesBackupFilename2'];
     getBackup($conn, $site['filesBackupLocation2'], $site['filesBackupFilename2'], FTP_BINARY, $local_file, $site['user']);
  }
  
  // close FTP connection
  ftp_close($conn);

} // end foreach

?>
