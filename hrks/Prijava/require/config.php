<?php
    $db_host = 'localhost';					// Server na kojem je MySQL
// org	$db_user = 'hrks';						// Login MySQL baze
// org 	$db_pass = 'u7Monimac';					// Password MySQL baze

	$db_user = 'root';						// Login MySQL baze
	$db_pass = 'paup';					// Password MySQL baze

	$db_name = 'hrks';						// Ime MySQL baze
	$tb_users = 'users';					// Tablica popisa svih korisnika
	$tb_skupovi = 'skupovi';				// Tablica skupova
	$tb_osoba = 'osoba';					// Tablica osoba
	$tb_posta = 'posta';					// Tablica o poštama
	$tb_titula = 'titula';					// Tablica popisa titula
	$tb_zupanija = 'zupanija';				// Tablica o županijama
	$tb_poste = 'posta';					// Tablica o poštama
	$tb_osoba = 'osoba';					// Tablica osoba
	$tb_potvrda = 'potvrda';				// Tablica potvrda
	$tb_skola_osoba = 'skola_osoba';		// Tablica skola osoba
	$tb_udruge = 'udruge';					// Tablica udruge
	$tb_referat = 'referat';				// Tablica referada - pripcenja
	$tb_referat_osoba = 'referat_osoba';	// Tablica referada osoba
	$tb_osoba_prez = 'osoba_prezentacija';	// Tablica oznaka da li je osoba prezentirala referat
	$tb_prijava = 'prijava';				// Tablica prijava

	$meni="meni";
	$body="body";
	$dataBox;
//	$cookies	= $HTTP_COOKIE_VARS["pulsar"];
			
#######################################################################################################
#                                  Do not modify under this line                                      #
#######################################################################################################
	
	//if ($cookies) {list($login, $password) = explode("&&", $cookies);}
//-treba ukluciti	mysql_connect ($db_host, $db_user, $db_pass) or die ("Could not connect to MySQL server <b>$db_host</b>");	
	$connection = mysql_connect ($db_host, $db_user, $db_pass) or die ("Could not connect to MySQL server <b>$db_host</b>");	

	mysql_query("SET NAMES cp1250");
	mysql_query("SET CHARACTER SET cp1250");
	mysql_query("SET COLLATION_CONNECTION='cp1250_croatian_ci'");


?>