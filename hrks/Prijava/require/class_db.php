<?php
class userClass {
    var $idUser=0;  // int
    var $ime="";  // text
	var $prezime=""; // text
	var $login=""; // text
	var $password="";  // text
	var $lastLog;  // date
	var $tip=0;  // tip korisnika
	var $adresa="";  // text
	var $email="";  // text
	var $download=0;  // tip korisnika
}
class vrstaClass {
    var $idVrsta=0;  // int
    var $naziv="";  // text
}
class tipClass {
    var $idTip=0;  // int
    var $naziv="";  // text
}
class kategorijaClass {
    var $idKategorija=0;  // int
    var $naziv="";  // text
}
class omjerClass {
    var $up=0;  // int
    var $down=0;  // int
}
class sadrzajClass {
    var $id=0;  // int
    var $naziv="";  // text
	var $opis="";  // text
	var $datoteka="";  // naziv datoteke
	var $idVrsta=0;  // int
	var $idKategorija=0;  // int
	var $kapacitet=0;  // int
	var $download=0;  // int broj koliko puta smo skinuli sadržaj
	var $idUser=0;  // int - id korisnika koji je stavio sadržaj
	var $zabrana="N";  // zabrana objavljivanja sadržaja N - nema D-zabrana postoji
}
?>