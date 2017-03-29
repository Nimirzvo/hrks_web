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
class osobaClass {
    var $id=0;  
	var $datum;  
	var $prezime=""; 
	var $ime="";  
	var $idTitula=0; 
	var $godina=0;  
	var $ulica;  
	var $grad="";  
	var $idPosta=0;  
	var $idZupanija=0;  
	var $tel="";
	var $mob="";
	var $email="";  
	var $skola="";  
	var $skolaGrad="";  
	var $clan=0; 
	var $nazivDrustva=""; 
	var $napomena="";
	var $spol=0;
	var $ustanova=0;
}
class osobaClass_E {
    var $id=0;  
    var $idSkupa=0;  
	var $datum;  
	var $prezime=""; 
	var $ime="";  
	var $titula=""; 
	var $ulica;  
	var $grad="";  
	var $posta="";  
	var $idDrzava=0;  
	var $tel="";
	var $fax="";
	var $email="";  
	var $institucija=""; 
	var $spol=0;
	var $vrsta=0; // vrsta polaznika seminara
	var $naslovRada="";
	var $autor="";
	var $autor2=""; // tko je prezentirao rad
	var $sekcija=0;  // tjelesni ili škola
	var $dokument="";  // naziv datoteke dokumenta rada
	var $transport="";  // oznaka da li korisnik treba prijevoz od aerodroma ili ne
}
class udrugaClass{
    var $id=0;  
	var $ime="";  
	var $grad="";  
	var $idZupanija=0;  
}


class skupClass {
    var $id=0;  
	var $godina=0;  
	var $broj=0; 
	var $datum1="";  
	var $datum2=""; 
	var $mjesto="";  
	var $naziv="";  
	var $opis="";  
	var $aktivan="";  
	var $jezik="";  // hrvatski - H ili engleski - E
}

function zastita2(){
	if($_SESSION['userId'] == NULL || $_SESSION['userId']==0) {
	  header("Location: logiranje.php");
	  exit();
	}
}
function zastita(){
	if($_SESSION['login'] == NULL || $_SESSION['login']=="" ) {
	  header("Location: logiranje.php");
	  exit();
	}
}

function mysql2table($date) {
	//convert date from YYYY-MM-DD to DD-MM-YYYY
	$new = explode("-",$date);
	$a=array ($new[2], $new[1], $new[0]);
	return $n_date=implode("-", $a);
}
function table2mysql($date) {
	//convert date from DD-MM-YYYY to YYYY-MM-DD
	$new = explode("-",$date);
	$a=array ($new[2], $new[1], $new[0]);
	return $n_date=implode("-", $a);
}

function godinaDatum($date) {
	//convert date from DD-MM-YYYY 
	$new = explode("-",$date);
	return $new[2];
}
// upis vrši administrator 
function insert_user2($data){
		global $db_name, $tb_users, $tb_vrsta;
		
		$data[password] = $data[password1];		
	$data_perm=3;
		$query = "INSERT INTO $tb_users VALUES (null, '$data[ime]', '$data[prezime]', '$data[user]', '$data[password1]', '$data[mail]', ";
		$query.= "'$data[vrsta_korisnika]', '$data[razred]','$data_perm', '$data[url]', '$data[tel]', '$data[mob]', NOW(''),'', '$data[active]')";
		mysql_db_query($db_name, $query) or die(mysql_error());
}

function validate_input ($login, $pass1, $pass2, $email) {
		global $db_name, $tb_users;
		
		if (ereg("^[_a-z0-9-]+$",$login)) {
			if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+([\.][a-z0-9-]+)+$",$email)) {
				if ($pass1 == $pass2) {
					$owner=mysql_fetch_array(mysql_db_query($db_name, "SELECT login FROM $tb_users WHERE login='$login'"));
					if ($owner[login]) {$error="1";}
					else {$error="";} 
				} 	
				else {$error="3";}
			} 
			else {$error="4";}
		} 
		else {$error="5";}
		return $error;
}

function validate_input2($ime,$prezime,$login, $pass1, $pass2, $email) {
		global $db_name, $tb_users;
		// provjera imena i prezimena korisnika
		$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT * FROM users WHERE firstname='$ime' AND lastname='$prezime'"));
		if($valid != 0){//  znaci da korisnik postoji
			return $error="14";
		}
		if ($login) {
			if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+([\.][a-z0-9-]+)+$",$email)) {
				if ($pass1 == $pass2) {
					$owner=mysql_fetch_array(mysql_db_query($db_name, "SELECT login FROM $tb_users WHERE login='$login'"));
					if ($owner[login]) {$error="1";}
					else {$error="";} 
				} 	
				else {$error="3";}
			} 
			else {$error="4";}
		} 
		else {$error="9";}
		return $error;
}

// provjera upisanih podataka korisnika i update podataka
function validate_input3($ime,$prezime, $pass1, $pass2, $email) {
		global $db_name, $tb_users;
			if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+([\.][a-z0-9-]+)+$",$email)) {
				if ($pass1 != $pass2) {
					$error="3";
				} 	
			} 
			else {$error="4";}
		return $error;
}
// funkcija odreduje popis vrste korisnika.
function show_vrstaKorisnika_info () {
	global $db_name, $tb_vrsta;
	
	$result=mysql_db_query($db_name, "SELECT * FROM $tb_vrsta ORDER BY id_vrsta");
	return $result;
}
function prikaziUser_ID($idUser) {
	global $db_name, $tb_users;
	$data=mysql_db_query($db_name, "SELECT * from $tb_users WHERE id=$idUser");
	return $data;
}
function show_users() {
	global $db_name, $tb_users;
	$result=mysql_db_query($db_name, "SELECT * FROM $tb_users ORDER BY prezime, ime");
	return $result;
}
function authorization ($login, $password) {
	global $db_name, $tb_users;
//	$valid = mysql_db_query($db_name, "SELECT * FROM $tb_users WHERE (login='$login' AND password='$password')");
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT * FROM $tb_users WHERE (login='$login' AND password='$password')"));
	if ($login && $valid[id]!=0) {
		$result=$valid;
	} 
	else {$result[error]="2";}
	return $result;
}
function authorization_2 ($login, $password) {
	global $db_name, $tb_users;
//	$valid = mysql_db_query($db_name, "SELECT * FROM $tb_users WHERE (login='$login' AND password='$password')");
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT * FROM $tb_users WHERE (login='$login' AND password='$password')"));
	if ($login && $valid[id]!=0) {
		$result=$valid;
	} 
	else {$result=0;}
	return $result;
}
function delete_user($id) {
	global $db_name, $tb_user;
	mysql_db_query($db_name, "DELETE FROM $tb_user WHERE id =$id");
}
function select_userAll() {
	global $db_name, $tb_user;
	$dataArray=array();
	
	$query="SELECT * FROM $tb_user ORDER BY prezime, ime";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$userClass = new userClass;
			$userClass ->idUser=$row[0];
		    $userClass ->ime=$row[1]; 
			$userClass ->prezime=$row[2]; 
			$userClass ->login=$row[3]; 
			$userClass ->password=$row[4]; 
			$userClass ->lastLog=$row[5];	
			$userClass ->tip=$row[6];		
			$userClass ->adresa=$row[7];		
			$userClass ->email=$row[8];		
			$userClass ->download=$row[9];	
					
			$dataArray[]=$mailClass;				
		}
	}
	return $dataArray;
}
function select_user($id) {
	global $db_name, $tb_users;
	$query="SELECT * FROM $tb_users WHERE id =$id";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function insert_user($data){
	global $db_name, $tb_users;		
	$query = "INSERT INTO $tb_users VALUES (0, '$data->ime', '$data->prezime', '$data->login', '$data->password', NOW(''), ";
	$query.= "$data->tip,'$data->adresa', '$data->email', 0)";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function is_email3($email)
{
	if(empty($email))
	{
		return false;
	}
	if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+([\.][a-z0-9-]+)+$",$email))
	{
	  return true;
	}
	else{
	  return false;	
	}
}

function tipUser($id) {
	global $db_name, $tb_users;
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT tip FROM $tb_users WHERE (id=$id)"));
	$result=$valid[tip];
	return $result; // vraca tip korisnika
}

function select_skupovi_HR() {
	global $db_name,$tb_skupovi;
	$query="SELECT *, DATE_FORMAT(DATUM1, '%d-%m-%Y') AS DAT_1, DATE_FORMAT(DATUM2, '%d-%m-%Y') ";
	$query.=" FROM $tb_skupovi WHERE (AKTIVAN='D' AND jezik<>'E') ORDER BY  DATUM1 DESC ";

//	$query="SELECT GODINA, BROJ, DATE_FORMAT(DATUM1, '%d-%m-%Y'), DATE_FORMAT(DATUM2, '%d-%m-%Y'),";
//	$query.=" MJESTO, NAZIV, opis FROM $tb_skupovi ORDER BY  DATUM1 DESC ";
//	$query="SELECT GODINA, BROJ, CONVERT (varchar, DATUM1, 101), CONVERT (varchar, DATUM2, 101),";
//	$query.=" MJESTO, NAZIV, opis FROM $tb_skupovi ORDER BY  DATUM1 DESC ";

// CONVERT ( varchar,Start_Date, 100 )
    $result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}

function select_skupovi() {
	global $db_name,$tb_skupovi;
	$query="SELECT *, DATE_FORMAT(DATUM1, '%d-%m-%Y') AS DAT_1, DATE_FORMAT(DATUM2, '%d-%m-%Y') ";
	$query.=" FROM $tb_skupovi WHERE (AKTIVAN='D' AND jezik ORDER BY  DATUM1 DESC ";

//	$query="SELECT GODINA, BROJ, DATE_FORMAT(DATUM1, '%d-%m-%Y'), DATE_FORMAT(DATUM2, '%d-%m-%Y'),";
//	$query.=" MJESTO, NAZIV, opis FROM $tb_skupovi ORDER BY  DATUM1 DESC ";
//	$query="SELECT GODINA, BROJ, CONVERT (varchar, DATUM1, 101), CONVERT (varchar, DATUM2, 101),";
//	$query.=" MJESTO, NAZIV, opis FROM $tb_skupovi ORDER BY  DATUM1 DESC ";

// CONVERT ( varchar,Start_Date, 100 )
    $result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}

function select_skupovi_Svi() {
	global $db_name,$tb_skupovi;
	$query="SELECT *, DATE_FORMAT(DATUM1, '%d-%m-%Y') AS DAT_1, DATE_FORMAT(DATUM2, '%d-%m-%Y') ";
	$query.=" FROM $tb_skupovi ORDER BY  DATUM1 DESC ";

    $result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}

function select_sadrzaj_id($idSadrzaja) {
	global $db_name;
	$query="SELECT sadrzaj.id, sadrzaj.naziv, sadrzaj.opis, sadrzaj.datoteka, sadrzaj.id_vrsta,";
	$query.=" sadrzaj.id_kategorija, sadrzaj.kapacitet, sadrzaj.download, sadrzaj.zabrana,";
	$query.=" vrsta.naziv, kategorija.naziv, users.prezime, users.ime  ";	
	$query.="FROM ((sadrzaj INNER JOIN kategorija ON sadrzaj.id_kategorija = kategorija.id) INNER JOIN vrsta ON sadrzaj.id_vrsta = vrsta.id) INNER JOIN users ON sadrzaj.id_user = users.id";
	$query.=" WHERE sadrzaj.id=$idSadrzaja";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function select_sadrzaj_2() {
	global $db_name;
	$query="SELECT sadrzaj.id, sadrzaj.naziv, sadrzaj.opis, sadrzaj.datoteka, sadrzaj.id_vrsta,";
	$query.=" sadrzaj.id_kategorija, sadrzaj.kapacitet, sadrzaj.download, sadrzaj.zabrana,";
	$query.=" vrsta.naziv, kategorija.naziv, users.prezime, users.ime  ";	
	$query.="FROM ((sadrzaj INNER JOIN kategorija ON sadrzaj.id_kategorija = kategorija.id) INNER JOIN vrsta ON sadrzaj.id_vrsta = vrsta.id) INNER JOIN users ON sadrzaj.id_user = users.id";
	$query.=" ORDER BY  users.prezime, users.ime  DESC";
//	echo $query."<br>";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function brisiSadrzaj($id) {
	global $db_name, $tb_sadrzaj;
	mysql_db_query($db_name, "DELETE FROM $tb_sadrzaj WHERE id =$id");
}
function odrediKategorija() {
	global $db_name, $tb_kategorija;
	$query="SELECT * FROM $tb_kategorija ORDER BY naziv";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function odrediVrstu() {
	global $db_name, $tb_vrsta;
	$query="SELECT * FROM $tb_vrsta ORDER BY naziv";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function upis_sadrzaj($data){
	global $db_name, $tb_sadrzaj;
	$query = "INSERT INTO $tb_sadrzaj VALUES ($data->id, '$data->naziv', '$data->opis', '$data->datoteka', $data->idVrsta, ";
	$query.= " $data->idKategorija, $data->kapacitet, $data->download, $data->idUser, '$data->zabrana')";
	mysql_db_query($db_name, $query) or die(mysql_error());
}

function update_sadrzaj($data) {
	global $db_name, $tb_sadrzaj;	
	$query = "UPDATE $tb_sadrzaj SET  naziv='$data->naziv', opis='$data->opis', datoteka='$data->datoteka', id_vrsta=$data->idVrsta,";
	$query.= " id_kategorija=$data->idKategorija , kapacitet=$data->kapacitet, download=$data->download, zabrana='$data->zabrana' ";  
	$query.= " where (id=$data->id)";
	mysql_db_query($db_name, $query) or die (mysql_error());
}


function update_sadrzaj2($data) {
	global $db_name, $tb_sadrzaj;	
	$query = "UPDATE $tb_sadrzaj SET  naziv='$data[1]', opis='$data[2]', datoteka='$data[3]', id_vrsta=$data[4],";
	$query.= " id_kategorija=$data[5] , kapacitet=$data[6], download=$data[7], zabrana='$data[9]' ";  
	$query.= " where (id=$data[0])";
	mysql_db_query($db_name, $query) or die (mysql_error());
}
function update_korisnik($data) {
	global $db_name, $tb_users;	
	$query = "UPDATE $tb_users SET  ime='$data[1]', prezime='$data[2]', login='$data[3]', password='$data[4]',";
	$query.= " tip=$data[6] , adresa='$data[7]', mail='$data[8]'  ";  
	$query.= " where (id=$data[0])";
	mysql_db_query($db_name, $query) or die (mysql_error());
}
function select_SveKorisnike() {
	global $db_name, $tb_users;
	$query="SELECT users.id, users.ime, users.prezime, users.login, users.password, users.last_log, users.tip, users.adresa, users.mail, tip.naziv  ";
	$query.=" FROM users INNER JOIN tip ON users.tip = tip.id ";
	$query.=" ORDER BY users.prezime, users.ime ";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function brisiKorisnika($id) {
	global $db_name, $tb_users;
	$query="DELETE FROM $tb_users WHERE id =$id";
	mysql_db_query($db_name, $query);
}
function odrediTipoveKorisnika() {
	global $db_name, $tb_tip;
	$query="SELECT * FROM $tb_tip ORDER BY naziv";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function update_korisnikClass($data) {
	global $db_name, $tb_users;	
	$query = "UPDATE $tb_users SET  ime='$data->ime', prezime='$data->prezime', login='$data->login', password='$data->password',";
	$query.= " tip=$data->tip , adresa='$data->adresa', mail='$data->email' ";  
	$query.= " where (id=$data->idUser)";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die (mysql_error());
}

function downloadUser($id) {
	global $db_name, $tb_users;
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT download FROM $tb_users WHERE (id=$id)"));
	$result=$valid[download];
	return $result; // vraca tip korisnika
}
function downloadDokument($id) {
	global $db_name, $tb_sadrzaj;
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT datoteka FROM $tb_sadrzaj WHERE (id=$id)"));
	$result=$valid[datoteka];
	return $result; // vraca naziv datoteke
}
function odredi_osobu($ime, $prezime, $datum) {
	global $db_name, $tb_osoba;
	$query="SELECT * FROM $tb_osoba WHERE (IME='$ime' AND PREZIME='$prezime')";
	//echo $query."<br>"; 
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; //podatke o osobi
}
function odredi_osobu_ID($ime, $prezime) {
	global $db_name, $tb_osoba;
	$query="SELECT ID FROM $tb_osoba WHERE (IME='$ime' AND PREZIME='$prezime')";
	$result = (mysql_db_query($db_name, $query));
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[ID];
			break;
		}
	}
	return $id; 
}
function odredi_osobu_ID_datum($ime, $prezime,$datum) {
	global $db_name, $tb_osoba;
	$query="SELECT ID FROM $tb_osoba WHERE (IME='$ime' AND PREZIME='$prezime' AND DATUM='$datum')";
	$result = (mysql_db_query($db_name, $query));
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[ID];
			break;
		}
	}
	return $id; 
}
function odredi_prijava_ID_skup($idSkup, $idOsoba) {
	global $db_name, $tb_prijava;
	$query="SELECT ID_SKUP FROM $tb_prijava WHERE (ID_SKUP=$idSkup AND ID_OSOBE=$idOsoba)";
	$result = (mysql_db_query($db_name, $query));
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[ID_SKUP];
			break;
		}
	}
	return $id; 
}
function odredi_prijava_osoba_skup($idSkup, $idOsoba) {
	global $db_name, $tb_prijava;
	$query="SELECT * FROM $tb_prijava WHERE (ID_SKUP=$idSkup AND ID_OSOBE=$idOsoba)";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; //podatke o osobi
}

function odredi_osobuID($id) {
	global $db_name, $tb_osoba;
	$query="SELECT * FROM $tb_osoba WHERE (ID=$id)";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; //podatke o osobi
}
function odredi_naziv__osobuID($id) {
	global $db_name, $tb_osoba;
	$query="SELECT PREZIME, IME FROM $tb_osoba WHERE (ID=$id)";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	$naziv="";
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$naziv=$row[PREZIME]." ".$row[IME];
			break;
		}
	}
	return $naziv; 
}
function odredi_naziv_zupanije($id) {
	global $db_name, $tb_zupanija;
	$query="SELECT NAZIV FROM $tb_zupanija WHERE id=$id";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	$naziv="";
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$naziv=$row[NAZIV];
			break;
		}
	}
	return $naziv; 
}
function odredi_naziv_poste($id) {
	global $db_name, $tb_posta;
	$query="SELECT URED, NAZIV FROM $tb_posta WHERE BROJ=$id";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	$naziv="";
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$naziv=$row[URED]." ".$row[NAZIV];
			break;
		}
	}
	return $naziv; 
}
function odredi_titule() {
	global $db_name, $tb_titula;
	$query="SELECT * FROM $tb_titula ORDER BY NAZIV";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function odredi_zupanije() {
	global $db_name, $tb_zupanija;
	$query="SELECT * FROM $tb_zupanija ORDER BY NAZIV";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function odredi_poste() {
	global $db_name, $tb_poste;
	$query="SELECT * FROM $tb_poste ORDER BY NAZIV";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}

function odrediNazivSkupa($id) {
	global $db_name,$tb_skupovi;
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT NAZIV FROM $tb_skupovi WHERE (ID=$id)"));
	$result=$valid[NAZIV];
	return $result; // vraca naziv datoteke
}
function odrediVrstaSkupa($id) {
	global $db_name,$tb_skupovi;
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT jezik FROM $tb_skupovi WHERE (ID=$id)"));
	$result=$valid[jezik];
	return $result; // vraca naziv datoteke
}
function odredi_udruge() {
	global $db_name, $tb_udruge;
	$query="SELECT * FROM $tb_udruge ORDER BY NAZIV";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function odredi_referate() {
	global $db_name, $tb_referat;
	$query="SELECT * FROM $tb_referat ORDER BY NAZIV";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}

function odredi_sve_Referata($idSkupa) {
	global $db_name, $tb_referat;
	$query="SELECT * FROM $tb_referat WHERE (idSkup=$idSkupa) ORDER BY naziv";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function odredi_sve_ReferataALL() {
	global $db_name, $tb_referat;
	$query="SELECT * FROM $tb_referat";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}

function pretvaranje_datuma() {
 $date = "1973-05-20";
 list($month, $day, $year) = split('[/.-]', $date);
 echo "Month: $month; Day: $day; Year: $year<br />\n";
}
function insert_osoba($data){
	global $db_name, $tb_osoba;		
	$query = "INSERT INTO $tb_osoba VALUES (0, '$data->datum', '$data->prezime', '$data->ime', $data->idTitula, $data->godina,  ";
	$query.= " '$data->ulica','$data->grad', $data->idPosta, $data->idZupanija, ";
	$query.= " '$data->tel','$data->mob', '$data->email', '$data->skola', '$data->skolaGrad', ";
	$query.= " $data->clan,'$data->nazivDrustva', '$data->napomena', $data->spol, $data->ustanova )";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function update_OsobaClass($data) {
	global $db_name, $tb_osoba;	
	$query = "UPDATE $tb_osoba SET  IME='$data->ime', PREZIME='$data->prezime', DATUM='$data->datum', ID_TITULA=$data->idTitula,";
	$query.= " GODINA_R=$data->godina , ULICA='$data->ulica', GRAD='$data->grad',ID_POSTA=$data->idPosta, ID_ZUPANIJA=$data->idZupanija, ";  
	$query.= " TEL='$data->tel' , MAIL='$data->email', SKOLA='$data->skola',GRAD_SKOLA='$data->skolaGrad', CLAN=$data->clan, SPOL=$data->spol";  
	$query.= " 	,NAPOMENA='$data->napomena' where (ID=$data->id)";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die (mysql_error());
}
function insert_prijava($idSkup, $idOsoba, $potpuna){
	global $db_name, $tb_prijava;		
	$query = "INSERT INTO $tb_prijava VALUES ($idSkup, $idOsoba, NOW(''),'$potpuna' )  ";
	// echo $query."<br>";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function insert_referat($naziv,$idSkup,$dokument,$kapac,$vrstaRada,$sekcija){
	global $db_name, $tb_referat;		
	$query = "INSERT INTO $tb_referat VALUES (0,'$naziv',$idSkup, '$dokument', $kapac, $vrstaRada, $sekcija )  ";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die(mysql_error());
}

function insert_osoba_predavanje($idSkup,$idOsoba, $idRef){
	global $db_name, $tb_osoba_prez;		
	$query = "INSERT INTO $tb_osoba_prez VALUES ($idSkup, $idOsoba, $idRef)  ";
	mysql_db_query($db_name, $query) or die(mysql_error());
}

function odrediReferat_Osoba_Predaje($idSkupa, $idOsoba) {
	global $db_name,$tb_osoba_prez;
	//$query="SELECT idOsoba FROM $tb_osoba_prez WHERE (idOsoba=$idOsoba AND idSkupa=$idSkupa)";
	//echo $query."<br>";
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT idOsoba FROM $tb_osoba_prez WHERE (idOsoba=$idOsoba AND idSkupa=$idSkupa)"));
	$result=$valid[idOsoba];
	return $result; // vraca id osobe
}
function odrediReferat_Osoba_Predaje2($idSkupa, $idReferat) {
	global $db_name,$tb_osoba_prez;
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT idOsoba FROM $tb_osoba_prez WHERE (idReferat=$idReferat AND idSkupa=$idSkupa)"));
	$result=$valid[idOsoba];
	return $result; // vraca id osobe
}
function odrediReferat_Osoba($idSkupa, $idOsoba) {
	global $db_name,$tb_referat_osoba;
	//$query="SELECT idOsoba FROM $tb_osoba_prez WHERE (idOsoba=$idOsoba AND idSkupa=$idSkupa)";
	//echo $query."<br>";
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT idOsobe FROM $tb_referat_osoba WHERE (idOsobe=$idOsoba AND idSkup=$idSkupa)"));
	$result=$valid[idOsobe];
	return $result; // vraca id osobe
}
function odrediReferat_Osoba2($idSkupa, $idRef) {
	global $db_name,$tb_referat_osoba;
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT idOsobe FROM $tb_referat_osoba WHERE (idReferata=$idRef AND idSkup=$idSkupa)"));
	$result=$valid[idOsobe];
	return $result; // vraca id osobe
}
function odredi_referat_ID($naziv,$idSkup) {
	global $db_name, $tb_referat;
	$query="SELECT id FROM $tb_referat WHERE (naziv='$naziv' AND idSkup=$idSkup)";
	//echo $query."<br>";
	$result=mysql_db_query($db_name, $query) or die(mysql_error());
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[id];
			break;
		}
	}
	return $id; //podatke o ID referata
}
function odredi_referat_Naziv($idRef) {
	global $db_name, $tb_referat;
	$query="SELECT naziv FROM $tb_referat WHERE (id=$idRef)";
	//echo $query."<br>";
	$result=mysql_db_query($db_name, $query) or die(mysql_error());
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[naziv];
			break;
		}
	}
	return $id; //podatke o ID referata
}

function odredi_referat_ID_2($idOsoba,$idSkup) {
	global $db_name, $tb_referat_osoba;
	$query="SELECT idReferata FROM $tb_referat_osoba WHERE (idOsobe=$idOsoba AND idSkup=$idSkup)";
	//echo $query."<br>";
	$result=mysql_db_query($db_name, $query) or die(mysql_error());
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[idReferata];
			break;
		}
	}
	return $id; //podatke o ID referata
}
function odredi_referat_ID_3($idOsoba,$idSkup) {
	global $db_name, $tb_referat_osoba;
	$query="SELECT vrsta FROM $tb_referat_osoba WHERE (idOsobe=$idOsoba AND idSkup=$idSkup)";
	//echo $query."<br>";
	$result=mysql_db_query($db_name, $query) or die(mysql_error());
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[vrsta];
			break;
		}
	}
	return $id; //podatke o vrsta referata
}

function odredi_referatOsoba_Provodi($idSkup, $idReferat,$vrsta) {
	global $db_name, $tb_referat_osoba;
	$query="SELECT idOsobe FROM $tb_referat_osoba WHERE (idSkup=$idSkup AND idReferata=$idReferat AND vrsta=$vrsta)";
	//echo $query."<br>";
	$result=mysql_db_query($db_name, $query) or die(mysql_error());
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[idOsobe];
			break;
		}
	}
	return $id; //podatke o ID osobi koja je nosilac referata
}

function odredi_referatOsoba_E($idSkup) {
	global $db_name;
	$query="SELECT id, datum, prezime, ime, naslov, autor, autor2, sekcija, DATE_FORMAT(datum, '%d-%m-%Y') AS DAT_1 FROM  prijave_fiep  WHERE ((idSkupa=$idSkup AND vrsta=2) OR (idSkupa=$idSkup AND vrsta=4)) ORDER BY  datum DESC ";
	//echo $query."<br>";  vrsta 2 - autor i 4 -autor
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function odredi_NazivRada_E($idSkup, $id) {
	global $db_name;
	$query="SELECT dokument FROM  prijave_fiep  WHERE (idSkupa=$idSkup AND id=$id) ";
	//echo $query."<br>";
	$result = (mysql_db_query($db_name, $query));
	$naziv="";
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$naziv=$row[dokument];
			break;
		}
	}
	return $naziv; 
}
function odredi_NazivRada_D($idSkup, $idRef) {
	global $db_name;
	//echo $idRef."<br>";
	$query="SELECT dokument FROM  referat WHERE (referat.idSkup=$idSkup AND referat.id=$idRef) ";
/*	$query="SELECT referat.dokument, referat_osoba.idSkup, referat_osoba.idOsobe ";
	$query.=" FROM referat INNER JOIN referat_osoba ON referat.id = referat_osoba.idReferata ";
	$query.=" WHERE (((referat_osoba.idSkup)=$idSkup) AND ((referat_osoba.idOsobe)=$id))";
*/
    //echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
//	$result = (mysql_db_query($db_name, $query));
	$naziv="";
	if( $result ){
		 //echo "ULAZ..<br";
		while ($row = mysql_fetch_array($result)) {
			//echo "ULAZ - 2..<br";
			$naziv=$row[dokument];
			//echo "IME DATOTEKE $naziv"."<br>";
			break;
		}
	}
	return $naziv; 
}

function insert_referat_osoba($idReferat,$idSkup, $idOsoba,$vrsta){
	global $db_name, $tb_referat_osoba;		
	$query = "INSERT INTO $tb_referat_osoba VALUES ($idReferat,$idSkup,$idOsoba,$vrsta)  ";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function insert_osoba_predaje($idReferat,$idOsoba, $idRef){
	global $db_name, $tb_osoba_prez;		
	$query = "INSERT INTO $tb_osoba_prez VALUES ($idReferat,$idOsoba, $idRef)  ";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function odredi_sve_Osobe() {
	global $db_name, $tb_osoba;
	$query="SELECT * FROM $tb_osoba ORDER BY PREZIME, IME";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function odredi_sve_Prijavljene_Osobe_Skup($idSkup) {
	global $db_name, $tb_osoba, $tb_prijava;
	$query="SELECT osoba.* ";
	$query.="FROM $tb_prijava INNER JOIN $tb_osoba ON prijava.ID_OSOBE = osoba.ID ";
	$query.=" WHERE (prijava.ID_SKUP=$idSkup) ";
	$query.=" ORDER BY osoba.PREZIME, osoba.IME ";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function provjeri_prijavu_osobe($idOsoba, $idSkup,$potpuna) {
	global $db_name, $tb_prijava;
	$query="SELECT ID_OSOBE FROM $tb_prijava WHERE (ID_SKUP=$idSkup AND ID_OSOBE=$idOsoba AND POTPUNA='$potpuna')";
	//echo $query."<br>";
	$result=mysql_db_query($db_name, $query) or die(mysql_error());
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[ID_OSOBE];
			break;
		}
	}
	return $id; //podatke o ID osobe s skupa
}

function delete_skup($id) {
	global $db_name, $tb_skupovi, $tb_prijava, $tb_referat, $tb_osoba_prez, $tb_referat_osoba;
	$query="DELETE FROM $tb_skupovi WHERE ID =$id";
	//echo $query."<br>";
	mysql_db_query($db_name,$query);
	// brišemo sve prijave
	mysql_db_query($db_name, "DELETE FROM $tb_prijava WHERE ID_SKUP =$id");
	// brišemo referate
	mysql_db_query($db_name, "DELETE FROM $tb_referat WHERE idSkup =$id");
	// brišemo osoba prezentacija
	mysql_db_query($db_name, "DELETE FROM $tb_osoba_prez WHERE idSkupa =$id");
	// brišemo osoba prezentacija
	mysql_db_query($db_name, "DELETE FROM $tb_referat_osoba WHERE idSkup =$id");
}
function select_skup_id($idSkupa) {
	global $db_name,$tb_skupovi;
	$query="SELECT * FROM $tb_skupovi WHERE ID=$idSkupa";
    $result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function insert_skup($data){
	global $db_name, $tb_skupovi;		
	$query = "INSERT INTO $tb_skupovi VALUES (0, $data->godina, $data->broj, '$data->datum1', '$data->datum2',  ";
	$query.= " '$data->mjesto','$data->naziv', '$data->opis', '$data->aktivan', '$data->jezik')";
	mysql_db_query($db_name, $query) or die(mysql_error());
}

function update_skupClass($data) {
	global $db_name, $tb_skupovi;	
	$query = "UPDATE $tb_skupovi SET  GODINA=$data->godina, BROJ=$data->broj, DATUM1='$data->datum1', DATUM2='$data->datum2',";
	$query.= " MJESTO='$data->mjesto' , NAZIV='$data->naziv', opis='$data->opis',AKTIVAN='$data->aktivan',jezik='$data->jezik'";  
	$query.= " where (ID=$data->id)";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die (mysql_error());
}

function delete_id_check() {
	global $db_name;
	$query="DELETE FROM brisanje_id";
	mysql_db_query($db_name,$query); // brišemo cijelu tabelu
}
function insert_id_check($id){
	global $db_name;		
	$query = "INSERT INTO brisanje_id VALUES ($id)";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function select_id_check() {
	global $db_name;
	$query="SELECT * FROM brisanje_id ";
    $result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function delete_sosoba($id) {
	global $db_name, $tb_osoba, $tb_prijava, $tb_referat, $tb_osoba_prez, $tb_referat_osoba;
	$query="DELETE FROM $tb_osoba WHERE ID =$id";
	//echo $query."<br>";
	mysql_db_query($db_name,$query);
	// brišemo sve prijave
	mysql_db_query($db_name, "DELETE FROM $tb_prijava WHERE ID_OSOBE =$id");
	// brišemo osoba prezentacija
	mysql_db_query($db_name, "DELETE FROM $tb_osoba_prez WHERE idOsoba =$id");
	// brišemo osoba prezentacija
	mysql_db_query($db_name, "DELETE FROM $tb_referat_osoba WHERE idOsobe =$id");
}
function odredi_udruge2() {
	global $db_name, $tb_udruge;
	//$query="SELECT * FROM $tb_udruge ORDER BY NAZIV";
	$query="SELECT udruge.id, udruge.naziv, udruge.grad, udruge.idZupanija, zupanija.NAZIV ";
	$query.="FROM ((udruge INNER JOIN zupanija ON udruge.idZupanija = zupanija.ID)) ORDER BY udruge.naziv";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function delete_udruga($id) {
	global $db_name, $tb_udruge, $tb_osoba;
	$query="DELETE FROM $tb_udruge WHERE ID =$id";
	mysql_db_query($db_name,$query);
	// svim clanovima brišemo oznaku udruge
	$query = "UPDATE $tb_osoba SET  CLAN=0 where (CLAN=$id)";
	mysql_db_query($db_name, $query) or die (mysql_error());
}
function odredi_udrugu_id($id) {
	global $db_name, $tb_udruge;
	$query="SELECT udruge.id, udruge.naziv, udruge.grad, udruge.idZupanija, zupanija.NAZIV, zupanija.ID ";
	$query.="FROM ((udruge INNER JOIN zupanija ON udruge.idZupanija = zupanija.ID))";
	$query.="WHERE (udruge.id = $id)";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function insert_udruga($data){
	global $db_name, $tb_udruge;		
	$query = "INSERT INTO $tb_udruge VALUES (0, '$data->ime', '$data->grad', $data->idZupanija) ";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function update_udrugaClass($data) {
	global $db_name, $tb_udruge;	
	$query = "UPDATE $tb_udruge SET  naziv='$data->ime', grad='$data->grad',idZupanija=$data->idZupanija ";  
	$query.= " where (id=$data->id)";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die (mysql_error());
}
function delete_prijava($idSkup, $idOsobe) {
	global $db_name, $tb_prijava, $tb_osoba_prez;
	$query="DELETE FROM $tb_prijava WHERE (ID_SKUP =$idSkup AND ID_OSOBE=$idOsobe)";
	mysql_db_query($db_name,$query);
	// brisanje prezentira
	$query="DELETE FROM $tb_osoba_prez WHERE (idSkupa =$idSkup AND idOsoba=$idOsobe)";
	mysql_db_query($db_name,$query);
}
function delete_prijava_E($idSkup, $idOsobe) {
	global $db_name;
	// odredimo da li ima osoba rad, ako ga ima brišemo ga sa servera
/*	$nazivRada=odredi_NazivRada_E($idSkup, $idOsobe);
	if(strlen(trim($nazivRada))>0){
		// brišemo ga sa servera
		$file_path="../fiep2011/".$nazivRada;
		if ( file_exists($file_path))
			unlink($file_path);
	}
*/
    $query="DELETE FROM prijave_fiep  WHERE (idSkupa =$idSkup AND id=$idOsobe)";
	mysql_db_query($db_name,$query);
}

function delete_referati($idSkup, $idReferata) {
	global $db_name, $tb_referat, $tb_referat_osoba;
	$nazivRada=odredi_NazivRada_D($idSkup, $idReferata);
	//echo "RAD : $nazivRada <br>";
	if(strlen(trim($nazivRada))>0){
		// brišemo ga sa servera
		$file_path="Datoteke/".$nazivRada;
		//echo "$file_path <br>";
		if ( file_exists($file_path))
			unlink($file_path);
	}
	$query="DELETE FROM $tb_referat WHERE (idSkup =$idSkup AND id=$idReferata)";
	mysql_db_query($db_name,$query);
	$query="DELETE FROM $tb_referat_osoba WHERE (idSkup =$idSkup AND idReferata=$idReferata)";
	mysql_db_query($db_name,$query);
	// odredimo da li ima osoba rad, ako ga ima brišemo ga sa servera
}

function select_referat_id($idReferat) {
	global $db_name, $tb_referat;
	$query="SELECT * FROM $tb_referat WHERE (id=$idReferat)";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}

function update_referatNaziv($idReferata,$naziv) {
	global $db_name, $tb_referat;	
	$query = "UPDATE $tb_referat SET  naziv='$naziv' ";  
	$query.= " where (id=$idReferata)";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die (mysql_error());
}

function select_uplata_id($idSkup, $idOsoba) {
	global $db_name;
	$query="SELECT * FROM uplata WHERE (id_skup=$idSkup AND id_osoba=$idOsoba)";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function odredi_uplatu_ID_skup($idSkup, $idOsoba) {
	global $db_name;
	$query="SELECT id_osoba FROM uplata WHERE (id_skup=$idSkup AND id_osoba=$idOsoba)";
	// echo $query."<br>";
	$valid = mysql_fetch_array(mysql_db_query($db_name, $query));
	$result=$valid[id_osoba];
	return $result; //podatke o ID prijave
}
function odredi_uplatu_ID_skup_2($idSkup, $idOsoba) {
	global $db_name;
	$query="SELECT * FROM uplata WHERE (id_skup=$idSkup AND id_osoba=$idOsoba)";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function update_uplata($idSkup, $idOsoba,$iznos,$datum,$opis) {
	global $db_name;	
	$query = "UPDATE uplata SET  opis='$opis' , iznos=$iznos, datum='$datum' ";  
	$query.= " WHERE (id_skup=$idSkup AND id_osoba=$idOsoba)";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die (mysql_error());
}
function delete_uplata($idSkup, $idOsoba) {
	global $db_name;
	$query="DELETE FROM uplata WHERE (id_skup=$idSkup AND id_osoba=$idOsoba)";
	mysql_db_query($db_name,$query);
}
function insert_uplata($idSkup, $idOsoba,$iznos,$datum,$opis){
	global $db_name;		
	$query = "INSERT INTO uplata VALUES ($idOsoba, $idSkup, $iznos, '$opis','$datum' ) ";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function Getfloat($str) {
  if(strstr($str, ",")) {
    $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs
    $str = str_replace(",", ".", $str); // replace ',' with '.'
  }
 
  if(preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.'
    return floatval($match[0]);
  } else {
    return floatval($str); // take some last chances with floatval
  }
} 
function is_true_float($val){
    if( is_float($val) || ( (float) $val > (int) $val || strlen($val) != strlen( (int) $val) ) && (int) $val != 0  ) return true;
    else return false;
}
function zamjena_tocka_zarez($str) {
  if(strstr($str, ".")) {
    //$str = str_replace(",", "", $str); // replace dots (thousand seps) with blancs
    $str = str_replace(".", ",", $str); // replace ',' with '.'
  }
  return $str;
} 
function select_opce_uplate_All($idSkup) {
	global $db_name;
	$query="SELECT * FROM uplata_ostalo WHERE (id_skup=$idSkup) ORDER BY datum DESC";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function select_osobe_uplate_All($idSkup) {
	global $db_name;
	$query="SELECT uplata.id_osoba, uplata.iznos, uplata.opis, uplata.datum, osoba.PREZIME, osoba.IME ";
	$query.="FROM ((uplata INNER JOIN osoba ON uplata.id_osoba = osoba.ID))";
	$query.=" WHERE (id_skup=$idSkup) ORDER BY datum DESC";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function delete_uplataOpce($idUplata,$idSkup) {
	global $db_name;
	$query="DELETE FROM uplata_ostalo WHERE (id_skup=$idSkup AND id=$idUplata)";
	//echo $query."<br>";
	mysql_db_query($db_name,$query);
}
function update_uplata_opca($idSkup, $idUplate, $iznos,$datum,$opis, $ufa_ifa) {
	global $db_name;	
	$query = "UPDATE uplata_ostalo SET  opis='$opis' , iznos=$iznos, datum='$datum', ifa_ufa='$ufa_ifa' ";  
	$query.= " WHERE (id_skup=$idSkup AND id=$idUplate)";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die (mysql_error());
}

function insert_uplata_opca($idSkup, $iznos,$datum,$opis, $ufa_ifa){
	global $db_name;		
	$query = "INSERT INTO uplata_ostalo VALUES (0, $idSkup, $iznos, '$datum','$opis', '$ufa_ifa') ";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function odredi_uplatu_ID_opca($idUplata) {
	global $db_name;
	$query="SELECT * FROM uplata_ostalo WHERE (id=$idUplata)";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function postoji_uplatu_ID_opca($idUplata) {
	global $db_name;
	$query="SELECT id FROM uplata_ostalo WHERE (id=$idUplata)";
	//echo $query."<br>";
	$valid = mysql_fetch_array(mysql_db_query($db_name, $query));
	$result=$valid[id];
	return $result; //podatke o ID prijave
}
function suma_rashod($idSkup) {
	global $db_name;
	$query="SELECT SUM(iznos) as 'rashod' FROM uplata_ostalo WHERE (id_skup=$idSkup AND ifa_ufa='2')";
	//echo $query."<br>";
	$valid = mysql_fetch_array(mysql_db_query($db_name, $query));
	$result=$valid[rashod];
	return $result; //podatke o ID prijave
}
function suma_prihod($idSkup) {
	global $db_name;
	$query="SELECT SUM(iznos) as 'rashod' FROM uplata_ostalo WHERE (id_skup=$idSkup AND ifa_ufa='1')";
	//echo $query."<br>";
	$valid = mysql_fetch_array(mysql_db_query($db_name, $query));
	$result=$valid[rashod];
	return $result; //podatke o ID prijave
}
function suma_kotizacija($idSkup) {
	global $db_name;
	$query="SELECT SUM(iznos) as 'Total' FROM uplata WHERE (id_skup=$idSkup)";
	//echo $query."<br>";
	$valid = mysql_fetch_array(mysql_db_query($db_name, $query));
	$result=$valid[Total];
	return $result; //podatke o ID prijave
}
function postojiUdruga($ime) {
	global $db_name, $tb_udruge;
	$query="SELECT id FROM $tb_udruge WHERE (naziv='$ime')";
	$valid = mysql_fetch_array(mysql_db_query($db_name, $query));
	$result=$valid[id];
	return $result; //podatke o id udruge
}


function backUpMySQL(){
// Enter your MySQL access data
	global $db_name, $db_pass, $db_user, $db_host;

  $backupdir = 'Arhiva';
  // Compute day, month, year, hour and min.
  $today = getdate();
  $day = $today[mday];
  if ($day < 10) {
      $day = "0$day";
  }
  $month = $today[mon];
  if ($month < 10) {
      $month = "0$month";
  }
  $year = $today[year];
  $hour = $today[hours];
  $min = $today[minutes];
  $sec = "00";
  // Execute mysqldump command.
  // It will produce a file named $db-$year$month$day-$hour$min.gz
  // under $DOCUMENT_ROOT/$backupdir
  system(sprintf(
    'mysqldump --opt -h %s -u %s -p%s %s | gzip > %s/%s/%s-%s%s%s-%s%s.gz',                                             
    $db_host,
    $db_user,
    $db_pass,
    $db_name,
    getenv('Arhiva'),
    $backupdir,
    $db_name,
    $year,
    $month,
    $day,
    $hour,
    $min
  ));
  echo '+DONE';
}

  function create_backup_sql($file) {
    $line_count = 0;
  //  $db_connection = db_connect();
    mysql_select_db (db_name()) or exit();
    $tables = mysql_list_tables(db_name());
    $sql_string = NULL;
    while ($table = mysql_fetch_array($tables)) {   
      $table_name = $table[0];
      $sql_string = "DELETE FROM $table_name";
      $table_query = mysql_query("SELECT * FROM `$table_name`");
      $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO $table_name VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= ");";
        if ($sql_string != ""){
          $line_count = write_backup_sql($file,$sql_string,$line_count);        
        }
        $sql_string = NULL;
      }    
    }
    return $line_count;
  }

  function write_backup_sql($file, $string_in, $line_count) { 
    fwrite($file, $string_in);
    return ++$line_count;
  }
  
  function db_name() {
	   global $db_name;
      //return ("your_db_name_here");
	  return ($db_name);
  }
  
  function db_connect() {
	  global $db_name, $db_host, $db_pass;
//	  $db_connection =  mysql_connect ($db_host, $db_user, $db_pass);	
    // $db_connection = mysql_connect("localhost", "your_mysql_id_here", "your_mysql_pw_here");
//    return $db_connection;
  }
  function load_backup_sql($file) {
    $line_count = 0;
    $db_connection = db_connect();
    mysql_select_db (db_name()) or exit();
    $line_count = 0;
	echo " Datoteka: $file <br>";
	if(is_file($file)){
		echo " ulaz u bazu<br>";
    while (!feof($file)) {
      $query = NULL;
      while (!feof($file)) {
        $query .= fgets($file);
		echo " QUERY= $query <br>";
      }
      if (NULL != $query) {
        $line_count++;
        mysql_query($query) or die("sql not successful: ".mysql_error()." query: ".$query);
      }
    }  
	}
    return $line_count;
  }

function dirList ($directory) 
{

    // create an array to hold directory list
    $results = array();

    // create a handler for the directory
    $handler = opendir($directory);

    // keep going until all files in directory have been read
    while ($file = readdir($handler)) {

        // if $file isn't this directory or its parent, 
        // add it to the results array
        if ($file != '.' && $file != '..')
            $results[] = $file;
    }

    // tidy up: close the handler
    closedir($handler);

    // done!
    return $results;
}

function SQLRestore($filename) {

global $db_name, $db_pass, $db_user, $db_host;

// Temporary variable, used to store current query
$templine = ”;
$DELIMITER = ‘;’;
$D_LEN = 1;

// Read in entire file
$lines = file($filename);
if(!$lines) return 1;

// Loop through each line
foreach ($lines as $line_num => $line) {

$line = trim($line);

if(substr($line, 0, 9) == ‘DELIMITER’) { // change delimiter
	$DELIMITER = str_replace('DELIMITER ', '', $line);
	$D_LEN = strlen($DELIMITER);
	continue;
}

// Only continue if it’s not a comment
if(substr($line, 0, 2) != ‘–’ && $line != ”) { // Add this line to the current segment
$templine .= $line;

// If it has a DELIMITER at the end, it’s the end of the query
if(substr($line, -$D_LEN, $D_LEN) == $DELIMITER) {
mysql_query(rtrim($templine, $DELIMITER))
or print('Error performing query \'' .
$templine . '\': ' . mysql_error() . '');
$templine = ""; // Reset temp variable to empty
} else {
$templine .= "\n";
}
}
}
}

function odrediPopisTablicaBaza(){
	global $db_name;
	$tables = mysql_list_tables(db_name());
	return ;
/*    $sql_string = NULL;
    while ($table = mysql_fetch_array($tables)) {   
      $table_name = $table[0];
	  */
}

function mySQL_XML($file){
	global $db_name, $db_host,$db_user;
	$db_config = Array
            ( 
                'dbtype' => "MYSQL",
                'host' => $db_host,
                'database' => $db_name,
                'user' => $db_user,
                'password' => $db_pass,
            );
	$dbimexport = new dbimexport($db_config);
	$dbimexport->download = false;
    //$dbimexport->download_path = $_SERVER['DOCUMENT_ROOT'];
	$dbimexport->download_path = "Arhiva";
    $dbimexport->file_name = $file;
    $dbimexport->export();
}

function XML_MySQL($file){
	global $db_name, $db_host,$db_user;
	$db_config = Array
            ( 
                'dbtype' => "MYSQL",
                'host' => $db_host,
                'database' => $db_name,
                'user' => $db_user,
                'password' => $db_pass,
            );
	echo "Datoteka : ".$file."<br>";
	$dbimexport->import_path = $_SERVER['DOCUMENT_ROOT'] . $file;
    $dbimexport->import();
	/* Import database */
	// $dbimexport->addValue("import_path","auto_save.xml")->import();
	//$dbimexport->addValue("Arhiva",$file)->import();
}

	function backUP_New(){
		global $db_name;
		$backupDir = 'Arhiva/'; 
        $backup_file = 'db_' . date('Ymd') . '.sql';
        
        $fp = fopen($backupDir . $backup_file, 'w');

        $schema = '# Database Backup' .
                  '#' . "\n" .
                  '# Backup Date: ' . date('Y-m-d H:i:s') . "\n\n";
        fputs($fp, $schema);
		//$tableQuery = $this->execute ( "SHOW TABLES FROM  $db_name " );
		$tables_query =mysql_list_tables($db_name);
        //$tables_query = mysql_query('SHOW TABLES FROM  $db_name ');
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

	}

function MySQL_File() {
	global $db_name, $db_user, $db_pass;
	$tables_query =mysql_list_tables($db_name);
	$ccyymmdd = date("d_m_Y");
	$dir="Arhiva_".$ccyymmdd;
	if (!file_exists('Arhiva/'.$dir)){
		mkdir('Arhiva/'.$dir, 0777, true);
		//chmod('Arhiva/'.$dir, 0777);
	}
	// exec("mysql -u ".$db_user." -p'".$db_pass."' ".$db_name." < ./database/$db_name.sql");  
	//exec("mysql hrks > Arhiva/test2222.sql");  
	
	// $command="mysqldump --xml --host=localhost --user=USER --password=***** DATABASENAME > finallyWorks.xml";
	//$command="mysqldump --xml --host=localhost --user='root' --password='' hrks > finallyWorks.xml";
	//system($command);
	// mysql_query("SELECT * INTO OUTFILE 'mytablebackup.sql' FROM 'osoba'");


    while ($tables = mysql_fetch_array($tables_query)) {
		$backupFile = 'Arhiva/'.$dir.'/'.$tables[0].'.sql';
		
		$fp = fopen('Arhiva/'.$dir.'/'.$tables[0].'.sql', "w");
		if($fp==false)
			die("unable to create file");
		fwrite($fp, '');
		// kreiramo novi file
//		$ourFileHandle = fopen($backupFile, 'w') or die("can't open file");
//		fclose($ourFileHandle);

		// $query      = "SELECT * INTO OUTFILE '".$backupFile."' FROM $tables[0]";
		$query      = "SELECT * INTO OUTFILE Arhiva/test.sql FROM osoba";
		mysql_db_query($db_name,$query);
		//$result = mysql_query($query);
		//echo $query."<br>";
		//echo $backupFile."<br>";
		fclose($fp);
		break;
	}
	//$query      = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";
	//$result = mysql_query($query);
	
}
function File_MySQL_File() {
	$tableName  = 'mypet';
	$backupFile = 'backup/mypet.sql';
	$query      = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";
	$result = mysql_query($query);
}
//mysql_query("LOAD DATA LOCAL INFILE '/path/to/file' INTO TABLE mytable");

/*
$files_to_zip = array(
2 'preload-images/1.jpg',
3 'preload-images/2.jpg',
4 'preload-images/5.jpg',
5 'kwicks/ringo.gif',
6 'rod.jpg',
7 'reddit.gif'
8);
9//if true, good; if false, zip creation failed
10$result = create_zip($files_to_zip,'my-archive.zip');
*/
 function textBackUp(){
	 global $db_name, $db_user, $db_pass, $db_host;
	 $mysql_dump = new MYSQL_DUMP($db_host,$db_user,$db_pass);
	 $sql = $mysql_dump->dumpDB($db_name);
	 if($sql==false)
		echo $mysql_dump->error();
	$mysql_dump->save_sql($sql,'Arhiva/ Test_x.sql');
 }
 
 function textXML(){
	// create doctype
	$dom = new DOMDocument("1.0");
	
	// create root element
	$root = $dom->createElement("toppings");
	$dom->appendChild($root);
	$dom->formatOutput=true;
	
	// create child element
	$item = $dom->createElement("item");
	$root->appendChild($item);
	
	// create text node
	$text = $dom->createTextNode("pepperoni");
	$item->appendChild($text);
	
	// create attribute node
	$price = $dom->createAttribute("price");
	$item->appendChild($price);
	
	// create attribute value node
	$priceValue = $dom->createTextNode("4");
	$price->appendChild($priceValue);
	
	// create CDATA section
	$cdata = $dom->createCDATASection("\nCustomer requests that pizza be sliced into 16 square pieces\n");
	$root->appendChild($cdata);
	
	// create PI
	$pi = $dom->createProcessingInstruction("pizza", "bake()");
	$root->appendChild($pi);
	
	// save tree to file
	$dom->save("order.xml");
	
	// save tree to string
	$order = $dom->save("order.xml");
}
// kreiranje datoteke za zapisivanje csv zapis
 function textCSV($nazivDatoteke){
	$OK=true;
	$today = getdate();
	$fh = fopen("Arhiva/".$nazivDatoteke, "wb");
	if($fh==false)
		$OK=false;
	else{
		odredi_ALL($fh);
		fclose($fh); // zatvaranje datoteke
	}
	return $OK;
 }
 
 function izradaCSV_arhive($fh){
	 // odredujemo tabele i zapisujemo u datoteku
	
	//odredi_osobeALL($fh);
/*	 mb_internal_encoding("UTF-8");
	 $stringData="##csv##\n";
	// fputs($fh, $stringData);
	 fwrite($fh, $stringData);
	 $stringData="##Proba upisa u ÈÆŽŠ? èæžšd##\n";
//	 $stringData = iconv('ISO-8859-1', 'UTF-8', $stringData);
//	 fputs($fh, $stringData);
	 //@fwrite($fh,utf8_encode($somedata));
	fwrite($fh, $stringData);

//$somedata = html_entity_decode($stringData), ENT_COMPAT, 'ISO-8859-2');
//fwrite($fh,utf8_encode($somedata));
//fwrite($fh, $stringData);
//	 $return = iconv('UTF-8', 'cp1250', $text);
//	 fwrite($fh,iconv('UTF-8', 'cp1250', $stringData)); 
//	 fwrite($fh,iconv('cp1250','UTF-8', $stringData)); 
//	 $file3 = iconv("ISO-8859-1", "CP1250", $stringData);
//	 fwrite($fh, $file3); 
//	 file_put_contents ($fh, iconv ("ISO-8859-2", "CP1250", file_get_contents ($file1))); 
//	 fwrite($fh,utf8_encode($stringData)); 

*/
}

function odredi_osobeALL($fh) {
	global $db_name, $tb_osoba;
	$query="SELECT * FROM $tb_osoba";
	//echo $query."<br>"; 
	fwrite($fh, "##d##osoba##d##\r\n");
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	while ($row = mysql_fetch_array($result)) {
		for($index=0; $index<20;$index++){
			fwrite($fh, $row[$index]."##;##");
		}
		fwrite($fh, "\r\n");
	}
}
function odredi_dokumentiALL($fh) {
	global $db_name;
	$query="SELECT * FROM dokumenti";
	//echo $query."<br>"; 
	fwrite($fh, "##d##dokumenti##d##\r\n");
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	while ($row = mysql_fetch_array($result)) {
		for($index=0; $index<4;$index++){
			fwrite($fh, $row[$index]."##;##");
		}
		fwrite($fh, "\r\n");
	}
}
function odredi_ALL($fh) {
	global $db_name;
	$tablica="";
	$col=0;
	$tablicaArray= array("dokumenti","dokumenti_vrsta","osoba","osoba_prezentacija","potvrda","prijava","prijava_dolazak",
						 "racun","referat","referat_osoba","skola_osoba","skupovi","tip","titula","udruge","uplata","uplata_ostalo","users","zupanija","prijave_fiep","prijave_mail", "drugi_fiep", "drzave","javno_fiep", "prijave_fiep_biljeska","sekcija", "vrsta_rada","referat_dodatak");
	$colArray=array (4,2,20,3,7,4,12,
					 7,7,4,6,10,2,2,4,5,6,10,2,23,2,5,2,3,2,3,2,2
					 );
	for($x=0; $x<count($tablicaArray);$x++){
		$tablica=$tablicaArray[$x];
		$col=$colArray[$x];
	$query="SELECT * FROM ".$tablica;
	fwrite($fh, "##d##".$tablica."##d##\r\n");
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	while ($row = mysql_fetch_array($result)) {
		for($index=0; $index<$col;$index++){
			// izbrišemo \n i \r\n da kasnije nemamo problema kod uèitavanja podataka
			//$str     = "Line 1\nLine 2\rLine 3\r\nLine 4\n";
			$order   = array("\r\n", "\n", "\r");
			$replace = ' ';
			$podatak=$row[$index];
			// upis podataka u tablicu
			if(strlen($podatak)==0){
				echo $podatak;
				$podatak=" ";
			}
			fwrite($fh, str_replace($order, $replace, $podatak)."#;#");
			//fwrite($fh, str_replace($order, $replace, $row[$index])."#;#");
			//fwrite($fh, $row[$index]."#;#");
		}
		fwrite($fh, "\r\n");
	}
	}
}

 function importCSV($nazivDatoteke){
	 global $db_name;
	$Error="";
	$oznaka1   = '##d##';
	$nazivTablice="";
	$fh = fopen($nazivDatoteke, "rb");
	if($fh==false)
		$Error="Greska";
	else{
		// èitanje linija i upis u bazu
		// popis naredbi za brisati
	$tablicaArray= array("dokumenti","dokumenti_vrsta","osoba","osoba_prezentacija","potvrda","prijava","prijava_dolazak",
						 "racun","referat","referat_osoba","skola_osoba","skupovi","tip","titula","udruge","uplata","uplata_ostalo","users","zupanija","prijave_fiep","prijave_mail", "drugi_fiep", "drzave","javno_fiep", "prijave_fiep_biljeska","sekcija", "vrsta_rada","referat_dodatak");
		$tablicaNo=-1;
		while (!feof($fh) ) {
			$line_of_text = fgets($fh);
			if(strlen($line_of_text)==0)
				continue;
			//print $line_of_text. "<BR>";
			// provjera da li je prva oznaka naziv datoteke
			// $pos = stripos($line_of_text, $oznaka1); //strripos
			$pos = strstr($line_of_text, $oznaka1); //strripos
			if ($pos ===false) {
				$pieces = explode("#;#", $line_of_text);
				$Error=upis_u_Tablice($tablicaNo,$pieces,$nazivTablice);
				if(strlen($Error)!=0)
				  break;
			}
			else{
				// pocetak tablice. odredimo naziv tablice
				$pieces = explode("##d##", $line_of_text);
				$nazivTablice=$pieces[1];
				$tablicaNo++;
		//		print $line_of_text. "<BR>";
		//		print $pieces[1]. "<BR>";
				// brisanje tablice
				mysql_db_query($db_name, "DELETE FROM $nazivTablice");
			}
		}
		fclose($fh);
	}
	 // zatvaranje datoteke
	return $Error;
 }
 
function upis_u_Tablice($index,$pieces,$nazivTablice){
	global $db_name,$db_user, $db_pass, $db_name, $DB;
	$OK_Greska="";	
//	if($index!=19)
//		return;
	
	print "Tablica: ". $nazivTablice. "<BR>";
	print "INDEX: ". $index. "<BR>";
	switch($index){
		case 0: //dokumenti
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]', '$pieces[2]', $pieces[3])";
			mysql_db_query($db_name, $query) or $OK_Greska="Greska";
		//	print $query. "<BR>";
		//	print "<BR>";
			break;
		case 1: //dokumenti_vrsta
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]')";
			mysql_db_query($db_name, $query) or die(mysql_error());
		//	print $query. "<BR>";
			break;
		case 2: //osoba
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]','$pieces[2]','$pieces[3]',$pieces[4], ";
			$query.= " $pieces[5], '$pieces[6]','$pieces[7]',$pieces[8],$pieces[9],";
			$query.= " '$pieces[10]', '$pieces[11]','$pieces[12]','$pieces[13]','$pieces[14]',";
			$query.= " $pieces[15], '$pieces[16]','$pieces[17]',$pieces[18],$pieces[19])";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 3: //osoba_prezentacija
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], $pieces[2])";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 4: //potvrda
		  	$query = "INSERT INTO $nazivTablice VALUES ('$pieces[0]', '$pieces[1]','$pieces[2]','$pieces[3]','$pieces[4]', ";
			$query.= " $pieces[5], $pieces[6] )";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 5: //prijava
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1],'$pieces[2]','$pieces[3]')";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 6: //prijava_dolazak
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], $pieces[2], $pieces[3], $pieces[4], $pieces[5], ";
		  	$query.= " '$pieces[6]', $pieces[7], $pieces[8], $pieces[9], $pieces[10], $pieces[11] )";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 7: //racun
		  	$query = "INSERT INTO $nazivTablice VALUES ('$pieces[0]', '$pieces[1]', '$pieces[2]', '$pieces[3]', '$pieces[4]', '$pieces[5]', '$pieces[6]') ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 8: //referat
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]', $pieces[2], '$pieces[3]', $pieces[4], $pieces[5], $pieces[6] ) ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 9: //referat_osoba
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], $pieces[2], $pieces[3] ) ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 10: //skola_osoba
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], '$pieces[2]', $pieces[3], '$pieces[4]', '$pieces[5]' ) ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 11: //skupovi
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], $pieces[2], '$pieces[3]', '$pieces[4]', ";
			$query.= " '$pieces[5]', '$pieces[6]', '$pieces[7]', '$pieces[8]', '$pieces[9]')";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 12: //tip
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]' ) ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 13: //titula
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]' ) ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 14: //udruge
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]', '$pieces[2]', $pieces[3] ) ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 15: //uplata
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], $pieces[2], '$pieces[3]', '$pieces[4]' ) ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 16: //uplata_ostalo
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], $pieces[2], '$pieces[3]', '$pieces[4]', '$pieces[5]' ) ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 17: //users
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]', '$pieces[2]', '$pieces[3]', '$pieces[4]',  ";
			$query.= " '$pieces[5]', $pieces[6], '$pieces[7]', '$pieces[8]', $pieces[9])";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 18: //zupanija
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]' ) ";
		//	print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 19: //prijava_fiep
/*			echo str_replace(",","##",$pieces[2]);
			echo str_replace(",","##",$pieces[4]);
			echo str_replace(",","##",$pieces[5]);
			echo str_replace(",","##",$pieces[6]);
			echo str_replace(",","##",$pieces[7]);
			echo str_replace(",","##",$pieces[8]);
			echo str_replace(",","##",$pieces[9]);
			echo str_replace(",","##",$pieces[11]);
			echo str_replace(",","##",$pieces[12]);
			echo str_replace(",","##",$pieces[13]);
			echo str_replace(",","##",$pieces[14]);
			echo str_replace(",","##",$pieces[16]);
			echo str_replace(",","##",$pieces[17]);
			echo str_replace(",","##",$pieces[18]);
			echo str_replace(",","##",$pieces[20]);
*/			for($x=0; $x<23;$x++){
				if(is_string($pieces[x])){
					$pieces[x] = str_replace("'","\"",$pieces[x]);
					$pieces[x]=mysql_real_escape_string($pieces[x]);
				}
			}
			//$pieces[20]=mysql_real_escape_string($pieces[20])
			//print " PODACI: ".$pieces[20]. "  <BR>";
					  	$query2 = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], '$pieces[2]', $pieces[3], '$pieces[4]', '$pieces[5]', ";
		  	$query2.= " '$pieces[6]', '$pieces[7]', '', '', $pieces[10], '', '','$pieces[13]', '', ";
		  	$query2.= " $pieces[15],'', '', '', $pieces[19], '','$pieces[21]',$pieces[22])";
						
						
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], '$pieces[2]', $pieces[3], '$pieces[4]', '$pieces[5]', ";
		  	$query.= " '$pieces[6]', '$pieces[7]', '$pieces[8]', '$pieces[9]', $pieces[10], '$pieces[11]', '$pieces[12]','$pieces[13]', '$pieces[14]', ";
		  	$query.= " $pieces[15],'$pieces[16]', '$pieces[17]', '$pieces[18]', $pieces[19], '$pieces[20]','$pieces[21]',$pieces[22])";
		//	print $query. " - 1 <BR>";
			mysql_db_query($db_name, $query2) or die(mysql_error());
			// obnavljamo podatke 
			$query = "UPDATE $nazivTablice SET  posta='$pieces[8]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());

			$query = "UPDATE $nazivTablice SET  ulica='$pieces[9]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());

			$query = "UPDATE $nazivTablice SET  tel='$pieces[11]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());

			$query = "UPDATE $nazivTablice SET  fax='$pieces[12]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());

			$query = "UPDATE $nazivTablice SET  institucija='$pieces[14]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());

			$query = "UPDATE $nazivTablice SET  naslov='$pieces[16]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());

			$query = "UPDATE $nazivTablice SET  autor='$pieces[17]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());

			$query = "UPDATE $nazivTablice SET  autor2='$pieces[18]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());
			
			$query = "UPDATE $nazivTablice SET  dokument='$pieces[20]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());
			
			break;
		case 20: //prijave_mail 
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]' ) ";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 21: //drugi_fiep 
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1],'',$pieces[3], $pieces[4] ) ";
			//print $query. "<BR>";
			mysql_db_query($db_name, $query) or die(mysql_error());
			// update
			$pieces[2]=mysql_real_escape_string($pieces[2]);
			$query = "UPDATE $nazivTablice SET  nazivRef='$pieces[2]'  WHERE (idSkup=$pieces[0] and idOsoba=$pieces[1])";
			//print $query. "<BR>";
			mysql_db_query($db_name, $query) or die (mysql_error());
			
			break;
		case 22: //drzave 
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]' ) ";
			mysql_db_query($db_name, $query) or die(mysql_error());
			print $query. "<BR>";
			break;
		case 23: //javno_fiep 
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], $pieces[1], $pieces[2] ) ";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 24: //prijave_fiep_biljeska 
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '' ) ";
			mysql_db_query($db_name, $query) or die(mysql_error());
			// update
			$pieces[1]=mysql_real_escape_string($pieces[1]);
			$query = "UPDATE $nazivTablice SET  biljeska='$pieces[1]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());
			break;
		case 25: //sekcija
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]' ) ";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 26: //vrsta_rada
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '$pieces[1]' ) ";
			mysql_db_query($db_name, $query) or die(mysql_error());
			break;
		case 27: //referat_dodatak
		  	$query = "INSERT INTO $nazivTablice VALUES ($pieces[0], '' ) ";
			mysql_db_query($db_name, $query) or die(mysql_error());
			// update
			$pieces[1]=mysql_real_escape_string($pieces[1]);
			$query = "UPDATE $nazivTablice SET  naziv='$pieces[1]'  WHERE id=$pieces[0]";
			mysql_db_query($db_name, $query) or die (mysql_error());
			break;
		}
	return $OK_Greska;
}
function odrediNazivTitule($id) {
	global $db_name;
	$valid = mysql_fetch_array(mysql_db_query($db_name, "SELECT NAZIV FROM titula WHERE (ID=$id)"));
	$result=$valid[NAZIV];
	return $result; // vraca naziv titule
}
function insert_TEMP($data){
	global $db_name;		
	$query = "INSERT INTO titula VALUES (-100, '$data')";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function delete_TEMP() {
	global $db_name;
	mysql_db_query($db_name, "DELETE FROM titula WHERE ID =-100");
}

function output_file($file, $name, $mime_type='')
{
 /*
 This function takes a path to a file to output ($file), 
 the filename that the browser will see ($name) and 
 the MIME type of the file ($mime_type, optional).
 
 If you want to do something on download abort/finish,
 register_shutdown_function('function_name');
 */
 //echo "Datoteka ulaz $file<br>";
 if(!is_readable($file)) die('File not found or inaccessible!');
 
 $size = filesize($file);
 $name = rawurldecode($name);
 //echo "NAZIV ulaz $name<br>";
 
 /* Figure out the MIME type (if not specified) */
 $known_mime_types=array(
 	"pdf" => "application/pdf",
 	"txt" => "text/plain",
 	"html" => "text/html",
 	"htm" => "text/html",
	"exe" => "application/octet-stream",
	"zip" => "application/zip",
	"doc" => "application/msword",
	"xls" => "application/vnd.ms-excel",
	"ppt" => "application/vnd.ms-powerpoint",
	"gif" => "image/gif",
	"png" => "image/png",
	"jpeg"=> "image/jpg",
	"jpg" =>  "image/jpg",
	"php" => "text/plain",
	"docx" => "application/msword"
 );
 
 if($mime_type==''){
	 $file_extension = strtolower(substr(strrchr($file,"."),1));
	 if(array_key_exists($file_extension, $known_mime_types)){
		$mime_type=$known_mime_types[$file_extension];
	 } else {
		$mime_type="application/force-download";
	 };
 };
 
 @ob_end_clean(); //turn off output buffering to decrease cpu usage
 
 // required for IE, otherwise Content-Disposition may be ignored
 if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');
 
 header('Content-Type: ' . $mime_type);
 header('Content-Disposition: attachment; filename="'.$name.'"');
 header("Content-Transfer-Encoding: binary");
 header('Accept-Ranges: bytes');
 
 /* The three lines below basically make the 
    download non-cacheable */
 header("Cache-control: private");
 header('Pragma: private');
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 
 // multipart-download and download resuming support
 if(isset($_SERVER['HTTP_RANGE']))
 {
	list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
	list($range) = explode(",",$range,2);
	list($range, $range_end) = explode("-", $range);
	$range=intval($range);
	if(!$range_end) {
		$range_end=$size-1;
	} else {
		$range_end=intval($range_end);
	}
 
	$new_length = $range_end-$range+1;
	header("HTTP/1.1 206 Partial Content");
	header("Content-Length: $new_length");
	header("Content-Range: bytes $range-$range_end/$size");
 } else {
	$new_length=$size;
	header("Content-Length: ".$size);
 }
 
 /* output the file itself */
 $chunksize = 1*(1024*1024); //you may want to change this
 $bytes_send = 0;
 if ($file = fopen($file, 'r'))
 {
	if(isset($_SERVER['HTTP_RANGE']))
	fseek($file, $range);
 
	while(!feof($file) && 
		(!connection_aborted()) && 
		($bytes_send<$new_length)
	      )
	{
		$buffer = fread($file, $chunksize);
		print($buffer); //echo($buffer); // is also possible
		flush();
		$bytes_send += strlen($buffer);
	}
 fclose($file);
 } else die('Error - can not open file.');
 
die();
}	
//country.csv
 function importCSV_Drzava($nazivDatoteke){
	 global $db_name;
	$Error="";
	$oznaka1   = ';';
	$nazivTablice="drzave";
	$fh = fopen($nazivDatoteke, "rb");
	if($fh==false)
		$Error="Greska";
	else{
		// èitanje linija i upis u bazu
		// popis naredbi za brisati
		mysql_db_query($db_name, "DELETE FROM $nazivTablice");
		$index=1;
		while (!feof($fh) ) {
			echo "Ušli u citanje datoteke<br>";
			$line_of_text = fgets($fh);
			echo "LINIJA: $line_of_text<br>";
			if(strlen($line_of_text)==0)
				continue;
			//print $line_of_text. "<BR>";

				$pieces = explode(";", $line_of_text);
				// brišemo navodnike
				$letters = array('"');
				$fruit   = array('');
				$output  = str_replace($letters, $fruit, $pieces[1]);
				
				//echo "naziv države: $output <br>";
				$query = "INSERT INTO $nazivTablice VALUES ($index, '$output')";
				mysql_db_query($db_name, $query) or $OK_Greska="Greska";
				$index++;
		}
		fclose($fh);
	}
	 // zatvaranje datoteke
	return $Error;
 }
 
 function odredi_drzave() {
	global $db_name, $tb_titula;
	$query="SELECT * FROM drzave ORDER BY NAZIV";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function insert_Prijava_E($data){
	global $db_name;		
	$query = "INSERT INTO prijave_fiep VALUES ($data->id, $data->idSkupa,'$data->datum', $data->spol, '$data->prezime', '$data->ime', '$data->titula', '$data->grad',  ";
	$query.= " '$data->posta','$data->ulica', $data->idDrzava,  ";
	$query.= " '$data->tel','$data->fax', '$data->email', '$data->institucija', $data->vrsta, ";
	$query.= " '$data->naslovRada','$data->autor', '$data->autor2', $data->sekcija, '$data->dokument', '$data->transport',0)";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die(mysql_error());
}
function update_Prijava_E($data) {
	global $db_name;	
	$query = "UPDATE prijave_fiep SET  ime='$data->ime', prezime='$data->prezime', titula='$data->titula',";
	$query.= " mjesto='$data->grad' , posta='$data->posta', ulica='$data->ulica',idDrzava=$data->idDrzava, ";  
	$query.= " tel='$data->tel' , email='$data->email', fax='$data->fax',institucija='$data->institucija', vrsta=$data->vrsta, spol=$data->spol,";  
	$query.= " naslov='$data->tel' , email='$data->email', fax='$data->fax',institucija='$data->naslovRada', autor='$data->autor', autor2='$data->autor2',";	$query.= " sekcija='$data->sekcija' , dokument='$data->dokument', transport='$data->transport' ";  
	$query.= " where (id=$data->id)";
	//echo $query."<br>";
	mysql_db_query($db_name, $query) or die (mysql_error());
}
 function odredi_max_prijave() {
	global $db_name;
	$query="SELECT MAX(id) AS id_max FROM prijave_fiep";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[0];
			break;
		}
	}
	return $id; 
}

function provjeri_prijavu_osobe_E($idPrijava, $idSkup,$prezime, $ime) {
	global $db_name;
	$query="SELECT id FROM prijave_fiep WHERE (idSkupa=$idSkup AND id=$idPrijava)";
	//echo $query."<br>";
	$result=mysql_db_query($db_name, $query) or die(mysql_error());
	$id=0;
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$id=$row[id];
			break;
		}
	}
	if($id==0){
		// dodatna provjera
		$query="SELECT id FROM prijave_fiep WHERE (idSkupa=$idSkup AND prezime='$prezime' AND ime='$ime')";
		$result=mysql_db_query($db_name, $query) or die(mysql_error());
		if( $result ){
			while ($row = mysql_fetch_array($result)) {
				$id=$row[id];
				break;
			}
		}
	}
	return $id; // id zapisa prijave
}

function odredi_mailAdresu($id) {
	global $db_name;
	$query="SELECT email FROM prijave_mail where id=$id";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	$email="";
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$email=$row[email];
			break;
		}
	}
	return $email; 
}
function update_Email_Prijave($id, $data) {
	global $db_name;	
	$query = "UPDATE prijave_mail SET  email='$data' where (id=$id)";
	mysql_db_query($db_name, $query) or die (mysql_error());
}
function odredi_naziv_skupa($idSkup) {
	global $db_name, $tb_skupovi;
	$query="SELECT NAZIV FROM $tb_skupovi WHERE (ID=$idSkup)";
	//echo $query."<br>";
	$result = (mysql_db_query($db_name, $query));
	$naziv="";
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$naziv=$row[NAZIV];
			break;
		}
	}
	return $naziv; 
}
function odredi_naziv_drzave($idDrzava) {
	global $db_name ;
	$query="SELECT naziv FROM drzave WHERE (id=$idDrzava)";
	//echo $query."<br>";
	$result = (mysql_db_query($db_name, $query));
	$naziv="";
	if( $result ){
		while ($row = mysql_fetch_array($result)) {
			$naziv=$row[naziv];
			break;
		}
	}
	return $naziv; 
}
function odredi_Detalje_Prijave_Skup($idSkup, $idOsoba) {
	global $db_name;
	$query="SELECT * FROM prijave_fiep WHERE (idSkupa=$idSkup AND id=$idOsoba)";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function odredi_sve_Prijavljene_Osobe_Skup_E($idSkup) {
	global $db_name;
	$query="SELECT * FROM prijave_fiep ";
	$query.=" WHERE (idSkupa=$idSkup) ";
	$query.=" ORDER BY prezime, ime";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}

function findexts ($filename) 
 { 
 $filename = strtolower($filename) ; 
 $exts = split("[/\\.]", $filename) ; 
 $n = count($exts)-1; 
 $exts = $exts[$n]; 
 return $exts; 
 } 

function odredi_sve_Prijavljene_Osobe_Skup_E_Drzava($idSkup, $drzava) {
	global $db_name;
	$query="";
	if($drzava==1){
		$query="SELECT * FROM prijave_fiep ";
		$query.=" WHERE (idSkupa=$idSkup AND idDrzava=43) ";
		$query.=" ORDER BY prezime, ime";
	}
	elseif($drzava==2){
		$query="SELECT * FROM prijave_fiep ";
		$query.=" WHERE (idSkupa=$idSkup AND idDrzava<>43) ";
		$query.=" ORDER BY prezime, ime";
	}
	else{
		$query="SELECT * FROM prijave_fiep ";
		$query.=" WHERE (idSkupa=$idSkup) ";
		$query.=" ORDER BY prezime, ime";
	}
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function odredi_sve_Prijavljene_Osobe_Skup_E_Rad($idSkup, $rad) {
	global $db_name;
	$query="SELECT * FROM prijave_fiep ";
	if($rad==0)
		$query.=" WHERE (idSkupa=$idSkup) ";
	else
		$query.=" WHERE (idSkupa=$idSkup AND vrsta=$rad) ";
	$query.=" ORDER BY prezime, ime";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function odredi_sve_Prijavljene_Osobe_Skup_E_Transport($idSkup) {
	global $db_name;
	$query="SELECT * FROM prijave_fiep ";
	$query.=" WHERE (transport='D') ";
	$query.=" ORDER BY prezime, ime";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function odredi_sve_Prijavljene_Osobe_Skup_E_Sekcija($idSkup, $sekcija) {
	global $db_name;
	$query="SELECT * FROM prijave_fiep ";
	if($sekcija==0)
		$query.=" WHERE (idSkupa=$idSkup) ";
	else
		$query.=" WHERE (idSkupa=$idSkup AND sekcija=$sekcija) ";
	$query.=" ORDER BY prezime, ime";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function odredi_sve_Prijavljene_Osobe_Skup_D_Sekcija($idSkup, $sekcija) {
	global $db_name;
	$query="SELECT osoba.* ";
	$query.=" FROM (osoba INNER JOIN referat_osoba ON osoba.ID = referat_osoba.idOsobe) INNER JOIN referat ON referat_osoba.idReferata = referat.id ";
	$query.=" WHERE (((referat_osoba.idSkup)=$idSkup) AND ((referat.sekcija)=$sekcija))";
	$query.=" ORDER BY prezime, ime";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}
function odredi_sve_Prijavljene_Osobe_Skup_D_Ustanova($idSkup, $ustanova) {
	global $db_name, $tb_osoba, $tb_prijava;
	$query="SELECT osoba.* ";
	$query.="FROM $tb_prijava INNER JOIN $tb_osoba ON prijava.ID_OSOBE = osoba.ID ";
	$query.=" WHERE (prijava.ID_SKUP=$idSkup AND osoba.USTANOVA=$ustanova) ";
	$query.=" ORDER BY osoba.PREZIME, osoba.IME ";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}

function odredi_sve_Prijavljene_Osoba_Referat($idSkup, $idOsoba) {
global $db_name, $tb_referat_osoba, $tb_referat;
	$query="SELECT $tb_referat_osoba.idOsobe, $tb_referat_osoba.idReferata, $tb_referat.naziv  ";
	$query.="FROM $tb_referat_osoba INNER JOIN $tb_referat ON $tb_referat_osoba.idReferata = $tb_referat.id ";
	$query.=" WHERE ($tb_referat_osoba.idOsobe=$idOsoba AND $tb_referat_osoba.idSkup=$idSkup) ";
	//echo $query."<br>";
	$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	return $result;
}

function odredi_sve_Prijavljene_Osobe_Skup_D_Rad($idSkup, $rad) {
	global $db_name, $tb_osoba, $tb_prijava;
	$query="SELECT osoba.* ";
	$query.=" FROM (osoba INNER JOIN referat_osoba ON osoba.ID = referat_osoba.idOsobe) INNER JOIN referat ON referat_osoba.idReferata = referat.id ";
	switch($rad){
		case 1: //samo sudionik
			$result=odredi_sve_Prijavljene_Osobe_Skup($idSkup);
			break;
		case 2: // izlagao i autor
			$query.="WHERE ((referat_osoba.idSkup=$idSkup) AND (referat_osoba.vrsta=1))";
			break;
		case 3: // izlagao i koautor
			$query.="WHERE ((referat_osoba.idSkup=$idSkup) AND (referat_osoba.vrsta=2))";
			break;
		case 4: // nije izlagao i autor
			$query.="WHERE ((referat_osoba.idSkup=$idSkup) AND (referat_osoba.vrsta=1))";
			break;
		case 5: // nije izlagao i koautor
			$query.="WHERE ((referat_osoba.idSkup=$idSkup) AND (referat_osoba.vrsta=2))";
			break;
	}
	if($rad > 1){
		$query.=" ORDER BY osoba.PREZIME, osoba.IME ";
		//echo " $query <br>";
		$result=mysql_db_query($db_name,$query ) or die (mysql_error());
	}
	return $result;
}
function odredi_vrstuRada() {
	global $db_name;
	$query="SELECT * FROM vrsta_rada ORDER BY id";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}
function odredi_sekcije() {
	global $db_name;
	$query="SELECT * FROM sekcija ORDER BY id";
	//echo $query."<br>";
	$result =mysql_db_query($db_name, $query) or die (mysql_error());
	return $result; 
}

?>