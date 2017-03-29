<?php
/**
 * Dump MySQL database
 *
 * @name    MySQLDump
 * @author  Daniele Viganò - CreativeFactory.it <daniele.vigano@creativefactory.it>
 * @version 1.1 - 23 November 2006
 *
 * @example
 * $dumper = new MySQLDump($dbname);
 * $dumper->writeDump('filename.txt');
 *
 */

class MySQLDump {
	var $database;

	function MYSQLDump($db=null){
		return $this->setDatabase($db);
	}

	function setDatabase($db){
		$this->database = $db;
		return true;
  }

  function getDatabase(){
		return $this->database;
  }

	function getStructure(){
		if ( !(@mysql_select_db($this->database)) ){
			return false;
		}
		//Get table names from database
		$records = @mysql_list_tables($this->database);
		//For each table it creates the CREATE query
		while ( $record = @mysql_fetch_row($records) ) {
			$table = $record[0];

			//Header
			$structure .= "-- \n";
			$structure .= "-- Table structure for table `{$table}` \n";
			$structure .= "-- \n\n";

			//Dump Structure
			$structure .= "DROP TABLE IF EXISTS `{$table}`; \n";
			$tableStructure = @mysql_fetch_assoc(@mysql_query("SHOW CREATE TABLE $table"));
			$structure .= $tableStructure['Create Table'];
			$structure .= ";\n\n\n";
		}
		return "SET FOREIGN_KEY_CHECKS = 0;\n\n".$structure."SET FOREIGN_KEY_CHECKS = 1;\n\n";
  }

	function getData(){
		if ( !(@mysql_select_db($this->database)) ){
			return false;
		}
		//Get table names from database
		$records = @mysql_list_tables($this->database);
		//For each record it creates the INSERT query
		while ( $record = @mysql_fetch_row($records) ) {
			$table = $record[0];

			//Header
			$data .= "-- \n";
			$data .= "-- Dumping data for table `$table` \n";
			$data .= "-- \n\n";

			//Dump Data
			$records2 = mysql_query("SELECT * FROM `$table`");
			while ( $record2 = @mysql_fetch_assoc($records2) ){
				unset($tmp_data);
				$data .= "INSERT INTO `$table` VALUES (";
				// Values
				foreach ( $record2 as $key => $value ){
					$tmp_data .= ( !isset($record2[$key]) ) ? 'NULL' : "'".addslashes($value)."'";
					$tmp_data .= ', ';
				}
				$tmp_data = substr($tmp_data,0,-2);
				$data .= $tmp_data.");\n";
			}
			$data .= "\n\n";
		}
		return "SET FOREIGN_KEY_CHECKS = 0;\n\n".$data."SET FOREIGN_KEY_CHECKS = 1;\n\n";
  }

	function getDump() {
		if ( !(@mysql_select_db($this->database)) ){
			return false;
		}
		return $this->getStructure().$this->getData();
	}

  function writeDump($filename) {
		if ( !(@mysql_select_db($this->database)) || !($fp = @fopen($filename,'wb')) ){
			return false;
		}
		$dump = $this->getDump();
    $return = ( @fwrite($fp,$dump,@strlen($dump)) ) ? true : false;
    @fclose($fp);
    return $return;
	}
}
?>