<?php
//  Adapted from backupDB() by James Heinrich <info@silisoftware.com> available at http:www.silisoftware.com

$backuptimestamp    = '.'.date('Y-m-d'); // datestamp
$backupabsolutepath = dirname(__FILE__).'/zips/';
$fullbackupfilename = $dbname.$backuptimestamp.'.sql.gz';
$tempbackupfilename = $dbname.'temp.sql.gz';

define('BACKTICKCHAR',    '`');
define('QUOTECHAR',       '\'');
define('LINE_TERMINATOR', "\n");  // \n = UNIX; \r\n = Windows; \r = Mac
define('BUFFER_SIZE',     32768); // in bytes
define('TABLES_PER_COL',  30);    //

$NeverBackupDBtypes = array('HEAP');
$GZ_enabled = (bool) function_exists('gzopen');

/////////////////////////////////////////////////////////////////////

$connect = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$connect) {
	mail($admin_email, 'FAILURE! Failed to connect to MySQL database', 'Failed to connect to SQL database in file '.@$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."\n".mysql_error());
	die('There was a problem connecting to the database:<br>'."\n".mysql_error());
}

ob_start();
flush();

if (($GZ_enabled && ($zp = gzopen($backupabsolutepath.$tempbackupfilename, 'wb'))) || (!$GZ_enabled && ($fp = fopen($backupabsolutepath.$tempbackupfilename, 'wb')))) {
	$fileheaderline .= '# mySQL backup ('.date('F j, Y g:i a').')   Type = ';
	if ($GZ_enabled) {
		gzwrite($zp, $fileheaderline, strlen($fileheaderline));
		gzwrite($zp, 'Complete'.LINE_TERMINATOR.LINE_TERMINATOR, strlen('Complete'.LINE_TERMINATOR.LINE_TERMINATOR));
	}
	else {
		fwrite($fp, $fileheaderline, strlen($fileheaderline));
		fwrite($fp, 'Complete'.LINE_TERMINATOR.LINE_TERMINATOR, strlen('Complete'.LINE_TERMINATOR.LINE_TERMINATOR));
	}
unset($SelectedTables);

	set_time_limit(60);
	$tables = mysql_list_tables($dbname);
	if (is_resource($tables)) {
		$tablecounter = 0;
		while (list($tablename) = mysql_fetch_array($tables)) {
			$TableStatusResult = mysql_query('SHOW TABLE STATUS LIKE "'.mysql_escape_string($tablename).'"');
			if ($TableStatusRow = mysql_fetch_array($TableStatusResult)) {
				if (in_array($TableStatusRow['Type'], $NeverBackupDBtypes)) {
					// no need to back up HEAP tables, and will generate errors if you try to optimize/repair

				} else {
					$SelectedTables[$dbname][] = $tablename;
				}
			}
		}
	}
}

$TableErrors = array();
foreach ($SelectedTables as $dbname => $selectedtablesarray) {
	mysql_select_db($dbname);
	$repairresult = '';
	$CanContinue = true;
	foreach ($selectedtablesarray as $selectedtablename) {
		$result = mysql_query('CHECK TABLE '.$selectedtablename);
		while ($row = mysql_fetch_array($result)) {
			set_time_limit(60);
			if ($row['Msg_text'] == 'OK') mysql_query('OPTIMIZE TABLE '.$selectedtablename);
			else {
				$repairresult .= 'REPAIR TABLE '.$selectedtablename.' EXTENDED'."\n\n";
				$fixresult = mysql_query('REPAIR TABLE '.$selectedtablename.' EXTENDED');
				$ThisCanContinue = false;
				while ($fixrow = mysql_fetch_array($fixresult)) {
					$repairresult .= $fixrow['Msg_type'].': '.$fixrow['Msg_text']."\n";
					if (($fixrow['Msg_type'] == 'status') && ($fixrow['Msg_text'] == 'OK')) $ThisCanContinue = true;
				}
				if (!$ThisCanContinue) $CanContinue = false;
				$repairresult .= "\n\n".str_repeat('-', 60)."\n\n";
			}
		}
	}
	if (!empty($repairresult)) {
		mail($admin_email, 'MySQL Table Error Report', $repairresult);
		echo '<pre>'.$repairresult.'</pre>';
		if (!$CanContinue) {
			ob_end_clean();
			echo 'errors';
			exit;
		}
	}
}

$overallrows = 0;
foreach ($SelectedTables as $dbname => $value) {
	mysql_select_db($dbname);
	$tablecounter = 0;
	for ($t = 0; $t < count($SelectedTables[$dbname]); $t++) {
		if ($tablecounter++ >= TABLES_PER_COL) $tablecounter = 1;
		$SQLquery = 'SELECT COUNT(*) AS num FROM '.$SelectedTables[$dbname][$t];
		$result = mysql_query($SQLquery);
		$row = mysql_fetch_array($result);
		$rows[$t] = $row['num'];
		$overallrows += $rows[$t];
	}
}

$alltablesstructure = '';
foreach ($SelectedTables as $dbname => $value) {
	mysql_select_db($dbname);
	for ($t = 0; $t < count($SelectedTables[$dbname]); $t++) {
		set_time_limit(60);
		$fieldnames     = array();
		$structurelines = array();
		$result = mysql_query('SHOW FIELDS FROM '.BACKTICKCHAR.$SelectedTables[$dbname][$t].BACKTICKCHAR);
		while ($row = mysql_fetch_array($result)) {
			$structureline  = BACKTICKCHAR.$row['Field'].BACKTICKCHAR;
			$structureline .= ' '.$row['Type'];
			$structureline .= ' '.($row['Null'] ? '' : 'NOT ').'NULL';
			if (isset($row['Default'])) {
				switch ($row['Type']) {
					case 'tinytext':
					case 'tinyblob':
					case 'text':
					case 'blob':
					case 'mediumtext':
					case 'mediumblob':
					case 'longtext':
					case 'longblob':
						// no default values
						break;
					default:
						$structureline .= ' default \''.$row['Default'].'\'';
						break;
				}
			}
			$structureline .= ($row['Extra'] ? ' '.$row['Extra'] : '');
			$structurelines[] = $structureline;

			$fieldnames[] = $row['Field'];
		}
		mysql_free_result($result);

		$tablekeys    = array();
		$uniquekeys   = array();
		$fulltextkeys = array();
		$result = mysql_query('SHOW KEYS FROM '.BACKTICKCHAR.$SelectedTables[$dbname][$t].BACKTICKCHAR);
		while ($row = mysql_fetch_array($result)) {
			$uniquekeys[$row['Key_name']]   = (bool) ($row['Non_unique'] == 0);
			$fulltextkeys[$row['Key_name']] = (bool) ($row['Index_type'] == 'FULLTEXT');
			$tablekeys[$row['Key_name']][$row['Seq_in_index']] = $row['Column_name'];
			ksort($tablekeys[$row['Key_name']]);
		}
		mysql_free_result($result);
		foreach ($tablekeys as $keyname => $keyfieldnames) {
			$structureline  = '';
			if ($keyname == 'PRIMARY') {
				$structureline .= 'PRIMARY KEY';
			} 
			else {
				if ($fulltextkeys[$keyname]) $structureline .= 'FULLTEXT ';
				elseif ($uniquekeys[$keyname]) $structureline .= 'UNIQUE ';
				$structureline .= 'KEY '.BACKTICKCHAR.$keyname.BACKTICKCHAR;
			}
			$structureline .= ' ('.BACKTICKCHAR.implode(BACKTICKCHAR.','.BACKTICKCHAR, $keyfieldnames).BACKTICKCHAR.')';
			$structurelines[] = $structureline;
		}


		$TableStatusResult = mysql_query('SHOW TABLE STATUS LIKE "'.mysql_escape_string($SelectedTables[$dbname][$t]).'"');
		if (!($TableStatusRow = mysql_fetch_array($TableStatusResult))) {
			die('failed to execute "SHOW TABLE STATUS" on '.$dbname.'.'.$tablename);
		}

		$tablestructure  = 'CREATE TABLE '.BACKTICKCHAR.$dbname.BACKTICKCHAR.'.'.BACKTICKCHAR.$SelectedTables[$dbname][$t].BACKTICKCHAR.' ('.LINE_TERMINATOR;
		$tablestructure .= '  '.implode(','.LINE_TERMINATOR.'  ', $structurelines).LINE_TERMINATOR;
		$tablestructure .= ') ENGINE='.$TableStatusRow['Engine'];
		if ($TableStatusRow['Auto_increment'] !== null) {
			$tablestructure .= ' AUTO_INCREMENT='.$TableStatusRow['Auto_increment'];
		}
		$tablestructure .= ';'.LINE_TERMINATOR.LINE_TERMINATOR;

		$alltablesstructure .= str_replace(' ,', ',', $tablestructure);

	} // end table structure backup
}

if ($GZ_enabled) gzwrite($zp, $alltablesstructure.LINE_TERMINATOR, strlen($alltablesstructure) + strlen(LINE_TERMINATOR));
else fwrite($fp, $alltablesstructure.LINE_TERMINATOR, strlen($alltablesstructure) + strlen(LINE_TERMINATOR));

$processedrows    = 0;
foreach ($SelectedTables as $dbname => $value) {
	set_time_limit(60);
	mysql_select_db($dbname);
	for ($t = 0; $t < count($SelectedTables[$dbname]); $t++) {
		$result = mysql_query('SELECT * FROM '.$SelectedTables[$dbname][$t]);
		$rows[$t] = mysql_num_rows($result);
		if ($rows[$t] > 0) {
			$tabledatadumpline = '# dumping data for '.$dbname.'.'.$SelectedTables[$dbname][$t].LINE_TERMINATOR;
			if ($GZ_enabled) gzwrite($zp, $tabledatadumpline, strlen($tabledatadumpline));
			else fwrite($fp, $tabledatadumpline, strlen($tabledatadumpline));
		}
		unset($fieldnames);
		for ($i = 0; $i < mysql_num_fields($result); $i++) {
			$fieldnames[] = mysql_field_name($result, $i);
		}
		$insertstatement = 'INSERT INTO '.BACKTICKCHAR.$SelectedTables[$dbname][$t].BACKTICKCHAR.' ('.BACKTICKCHAR.implode(BACKTICKCHAR.', '.BACKTICKCHAR, $fieldnames).BACKTICKCHAR.') VALUES (';
		$currentrow       = 0;
		$thistableinserts = '';
		while ($row = mysql_fetch_array($result)) {
			unset($valuevalues);
			foreach ($fieldnames as $key => $val) {
				$valuevalues[] = mysql_escape_string($row[$key]);
			}
			$thistableinserts .= $insertstatement.QUOTECHAR.implode(QUOTECHAR.', '.QUOTECHAR, $valuevalues).QUOTECHAR.');'.LINE_TERMINATOR;

			if (strlen($thistableinserts) >= BUFFER_SIZE) {
				if ($GZ_enabled) gzwrite($zp, $thistableinserts, strlen($thistableinserts));
				else fwrite($fp, $thistableinserts, strlen($thistableinserts));
				$thistableinserts = '';
			}
			if ((++$currentrow % STATS_INTERVAL) == 0) set_time_limit(60);
		}
		if ($GZ_enabled) gzwrite($zp, $thistableinserts.LINE_TERMINATOR.LINE_TERMINATOR, strlen($thistableinserts) + strlen(LINE_TERMINATOR) + strlen(LINE_TERMINATOR));
		else fwrite($fp, $thistableinserts.LINE_TERMINATOR.LINE_TERMINATOR, strlen($thistableinserts) + strlen(LINE_TERMINATOR) + strlen(LINE_TERMINATOR));
	}
}

if ($GZ_enabled) gzclose($zp);
else fclose($fp);

$newfullfilename = $backupabsolutepath.$fullbackupfilename;

if (file_exists($newfullfilename)) unlink($newfullfilename); // Windows won't allow overwriting via rename
rename($backupabsolutepath.$tempbackupfilename, $newfullfilename);
if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') {
	touch($newfullfilename);
	if (!chmod($newfullfilename, 0777)) mail(ADMIN_EMAIL, 'Failed to chmod()', 'Failed to chmod('.$newfullfilename.', 0777)');
}

ob_end_clean();
if ($debug != 0) echo "<pre>Backup created for database '".$dbname."'\n\nLocation: ".$backupabsolutepath.$fullbackupfilename."</pre>";

?>
