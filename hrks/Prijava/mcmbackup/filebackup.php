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


$date = date("m-d-Y");

// repeat this command for multiple backups, changing the path - e.g. you can have a backup for email, another for files, etc.
shell_exec("tar cvfz /path/to/backup/location/here/file_backup_$date.tar.gz /path/to/files/to/backup/here/"); 


?>
