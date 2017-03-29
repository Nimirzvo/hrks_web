<?php
	//MySQL connection parameters
	$dbhost = '127.0.0.1';
	$dbuser = 'root';
	$dbpsw = '';
	$dbname = 'hrks';
	
	//Connect to mysql server
	$connessione = @mysql_connect($dbhost,$dbuser,$dbpsw);
    mysql_query("SET NAMES cp1250");
	mysql_query("SET CHARACTER SET cp1250");
	mysql_query("SET COLLATION_CONNECTION='cp1250_croatian_ci'");


	//Include class
	require_once('mysqldump.php');

	//Create new instance of MySQLDump
  $dumper = new MySQLDump($dbname);
  
	//If you want to write the MySQL dump to file
  $dumper->writeDump('filename.sql');
  
  //If you want to get on string the MySQL dump
  $str = $dumper->getDump();
  
  //If you want to change the database
  //$dumper->setDatabase('database_2');
  
  //If you want to get only the database structure
  $str = $dumper->getStructure();

  //If you want to get only the database data
  $str = $dumper->getData();
?>