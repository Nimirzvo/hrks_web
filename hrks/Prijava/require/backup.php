<?php
// backup.php
// Create a text output of all/selected table in a database

//////////////////////// CONFIG /////////////////////////////////

// db settings
//Database name/
$mdb = "hrks";

//MySQL Host name/
$mhost = "localhost";

//MySQL Username/
$muser = "root";

//MySQL Password/
$mpass = "";

/* Tables. If you want to back up all tables, leave the array empty. Otherwise the format is:
$tables = array("table_1","table_2",..."table_n")*/
$tables = array();

//////////////////////// CONFIG ENDS /////////////////////////////////

DBConnect ($mhost,$muser,$mpass,$mdb);
unset($backup);
$backup = "";
header('Content-Type: text/plain');

$tab_status = mysql_query("SHOW TABLE STATUS");
if (!$tab_status) {
   echo "Error: Could not show table status\n";
   echo 'MySQL Error: ' . mysql_error();
   exit;
}
while($all = mysql_fetch_assoc($tab_status)) {
   $tbl_stat[$all['Name']] = $all['Auto_increment'];
}
if(count($tables) == 0) {
	// we want to backup all tables
	$all = mysql_query("SHOW TABLES FROM $mdb");
	if (!$all) {
	   echo "Error: Could not list tables\n";
	   echo "MySQL Error: " . mysql_error();
	   exit;
	}
	while($tabs = mysql_fetch_row($all)) {
		$backup .= PrintOut($backup,$tabs[0],$tbl_stat[$tabs[0]]);
	}
}
else {
	// we want to backup selected tables
	foreach($tables as $table) {
		$show_query ="SHOW TABLE STATUS FROM $mdb LIKE '$table'";
		$show = mysql_query($show_query);
		if (!$show) {
		   echo "Error: Could not show ".$table."\n";
		   echo "MySQL Error: ". mysql_error()."\n";
		   exit;
		}
		while($tabs = mysql_fetch_row($show)) {
			$backup .= PrintOut($backup,$tabs[0],$tbl_stat[$tabs[0]]);
		}
	}
}

echo "# mySQL backup\n# Date: ".date('d-m-Y')."\n# Time: ".date('H-i-m')."\n# Server: ".$_SERVER['SERVER_NAME']."\n# Database: ".$mdb."\n\n";
echo $backup;

/************************************************************************/

function PrintOut($output,$tbl,$stats) {
   $output = "--\n-- Table structure for `$tbl`\n--\n\nCREATE TABLE `$tbl` ( ";
   $res = mysql_query("SHOW CREATE TABLE $tbl");
   while($al = mysql_fetch_assoc($res)) {
	   $str = str_replace("CREATE TABLE `$tbl` (", "", $al['Create Table']);
	   $str = str_replace(",", ",", $str);
	   $str2 = str_replace("`) ) TYPE=MyISAM ", "`)\n ) TYPE=MyISAM ", $str);
	   if ($stats) {$str2 = $str2." AUTO_INCREMENT=".$stats;}
	   $output .= $str2.";\n\n";
	}
	$output .= "-- \n-- Dumping data for table `".$tbl."`\n-- \n\n";
   $data = mysql_query("SELECT * FROM $tbl");
   while($dt = mysql_fetch_row($data)) {
	   $output .= "INSERT INTO `$tbl` VALUES('$dt[0]'";
	   for($i=1; $i<sizeof($dt); $i++) {
		   $dt[$i] = mysql_real_escape_string($dt[$i]);
		   $output .= ", '$dt[$i]'";
	   }
	   $output .= ");\n";
   }
   $output .= "\n-- --------------------------------------------------------\n\n";
   return $output;
}

/************************************************************************/

function DBConnect ($mhost,$muser,$mpass,$mdb) {
	$connect = mysql_connect($mhost,$muser,$mpass);
	$error="";
	if (!$connect) $error="<p>Unable to connect to the database server at this time.</p>";
	$db_selected = mysql_select_db($mdb,$connect);
	if (!$db_selected) $error ="Unable to use ".$mdb." : ".mysql_error() ;
	return $error;
}

/************************************************************************/


?>