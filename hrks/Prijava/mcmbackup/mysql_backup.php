<?php

/*
This program is free software; you can redistribute it and/or modify     
it under the terms of the GNU General Public License as published by     
the Free Software Foundation; either version 2 of the License, or        
(at your option) any later version.                                  

Joseph McMurry
support@mcmwebsite.com
http://www.mcmwebsite.com
Version 0.1.1
2/5/2008

Based on the osCommerce ( http://www.oscommerce.com ) database backup script
                                                                           
This program is distributed in the hope that it will be useful,          
but WITHOUT ANY WARRANTY; without even the implied warranty of           
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            
GNU General Public License for more details.     
*/

        // connect to DB
        
        $dbhost = 'localhost';
        
        // edit these 4 lines
        $dbname = 'db_name_here';
        $dbuser = 'db_user_here';
        $dbpw = 'db_pass_here';
        $backupDir = '/full/path/to/backup/dir/here/'; // full path, must be 777 and passwd-protected
 
        $dbh = mysql_connect($dbhost, $dbuser, $dbpw) or
                die ('I cannot connect to the database because: ' . mysql_error());

        mysql_select_db($dbname, $dbh);

        set_time_limit(0);

        $backup_file = 'db_' . date('Ymd') . '.sql';
        
        $fp = fopen($backupDir . $backup_file, 'w');

        $schema = '# Database Backup' .
                  '#' . "\n" .
                  '# Backup Date: ' . date('Y-m-d H:i:s') . "\n\n";
        fputs($fp, $schema);

        $tables_query = mysql_query('show tables');
        while ($tables = mysql_fetch_array($tables_query)) {
        
        
          list(,$table) = each($tables);

          $schema = 'drop table if exists ' . $table . ';' . "\n" .
                    'create table ' . $table . ' (' . "\n";

          $table_list = array();
          $fields_query = mysql_query("show fields from " . $table);
          while ($fields = mysql_fetch_array($fields_query)) {
          
            $table_list[] = "`".$fields['Field']."`"; // bug fix for fields with reserved names thanks to J. Frugier joris.frugier@gmail.com for pointing this out
            //$table_list[] = $fields['Field'];

            $schema .= '  ' . $fields['Field'] . ' ' . $fields['Type'];

            if (strlen($fields['Default']) > 0) $schema .= ' default \'' . $fields['Default'] . '\'';

            if ($fields['Null'] != 'YES') $schema .= ' not null';

            if (isset($fields['Extra'])) $schema .= ' ' . $fields['Extra'];

            $schema .= ',' . "\n";
          }

          $schema = ereg_replace(",\n$", '', $schema);

// add the keys
          $index = array();
          $keys_query = mysql_query("show keys from " . $table);
          while ($keys = mysql_fetch_array($keys_query)) {
          
          
            $kname = $keys['Key_name'];

            if (!isset($index[$kname])) {
              $index[$kname] = array('unique' => !$keys['Non_unique'],
                                     'fulltext' => ($keys['Index_type'] == 'FULLTEXT' ? '1' : '0'),
                                     'columns' => array());
            }

            $index[$kname]['columns'][] = $keys['Column_name'];
          }

          while (list($kname, $info) = each($index)) {
          
          
            $schema .= ',' . "\n";

            $columns = implode($info['columns'], ', ');

            if ($kname == 'PRIMARY') {
              $schema .= '  PRIMARY KEY (' . $columns . ')';
            } elseif ( $info['fulltext'] == '1' ) {
              $schema .= '  FULLTEXT ' . $kname . ' (' . $columns . ')';
            } elseif ($info['unique']) {
              $schema .= '  UNIQUE ' . $kname . ' (' . $columns . ')';
            } else {
              $schema .= '  KEY ' . $kname . ' (' . $columns . ')';
            }
          }

          $schema .= "\n" . ');' . "\n\n";
          fputs($fp, $schema);

// dump the data
          
            $rows_query = mysql_query("select " . implode(',', $table_list) . " from " . $table);
            while ($rows = mysql_fetch_array($rows_query)) {
            
            
              $schema = 'insert into ' . $table . ' (' . implode(', ', $table_list) . ') values (';

              reset($table_list);
              while (list(,$i) = each($table_list)) {
                $i = str_replace('`', '',$i);
              
                if (!isset($rows[$i])) {
                  $schema .= 'NULL, ';
                } elseif ( trim($rows[$i]) != '' ) {
                  $row = addslashes($rows[$i]);
                  $row = ereg_replace("\n#", "\n".'\#', $row);

                  $schema .= '\'' . $row . '\', ';
                } else {
                  $schema .= '\'\', ';
                }
              }

              $schema = ereg_replace(', $', '', $schema) . ');' . "\n";
              fputs($fp, $schema);
            }
         
        }

        fclose($fp);
         
        

      

?>
