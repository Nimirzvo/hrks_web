<?php
global $dataBox;
$error="";
$idUser=0; // oznaka id skupa koji æe se mijenjati
$OK=true;
session_start();
include("require/common.php");
include ("require/config.php");
if($_SESSION['userId']<=0){
 header("Location: login.php");
 exit();
}

if($_POST['Submit_2']){
	$izbor=2;
	$edit=0;
	$idUser=0; // pamtimo za kasniju promijenu
  	$ime="";
	$prezime="";
	$userName2="";
	$lozinka1="";
	$lozinka2="";
	$adresa="";
	$posta="";
}
elseif($_POST['Da']){
	$izbor=1;
	$rezultat=select_id_check(); // èitamo podatke koje trebamo brisati
	while ($row = mysql_fetch_array($rezultat)) {
		brisiKorisnika($row[0]); // bisanje osoba s popisa
	}
}
elseif($_POST['Ne']){
	$izbor=1;
}
elseif($_POST['Submit_4']){
	delete_id_check();
    if(isset($_POST['box'])){
		$izbor=4;
		foreach($_POST['box'] as $value){ 
			insert_id_check($value); //privremeni upis u bazu
		}
	}
	else{
		$izbor=1;
		$error="Niste odabrali korisnika.";
	}
}	
elseif($_POST['Submit_3']){ // editiramo podatke o osobi
	$izbor=3;
	$edit=1;
	if(isset($_POST['box'])){
   		foreach($_POST['box'] as $value){ 
			$izb=$value;
	   	 	$data=prikaziUser_ID($value);
			while ($row = mysql_fetch_array($data)){
				$rezultat=$row;
				break;
			}
		}
	}
	$idUser=$rezultat[0]; // pamtimo za kasniju promijenu
  	$ime=$rezultat[1];
	$prezime=$rezultat[2];
	$userName2=$rezultat[3];
	$lozinka1=$rezultat[4];
	$lozinka2=$rezultat[4];
	$adresa=$rezultat[7];
	$posta=$rezultat[8];
}
elseif($_POST['Novi']){
	$idUser=$_POST["idUser"]; // pamtimo za kasniju promijenu
  	$ime=$_POST["ime"];
	$prezime=$_POST["prezime"];
	$userName2=$_POST["userName2"];
	$lozinka1=$_POST["lozinka1"];
	$lozinka2=$_POST["lozinka2"];
	$adresa=$_POST["adresa"];
	$posta=$_POST["posta"];
	$tipKorisnika=$_POST["tip"];
	if(empty($ime)){
	 	$error="Niste upisali ime korisnika.";
		$OK=false;
	 }
	 elseif(empty($prezime)){
	 	$error="Niste upisali prezime korisnika.";
		$OK=false;
	 }
	 elseif(empty($posta)){
	 	$error="Niste upisali E-mail adresu.";
		$OK=false;
	 }
	 elseif(empty($userName2)){
	 	$error="Niste upisali korisnièko ime.";
		$OK=false;
	 }
	 elseif(empty($lozinka1) || empty($lozinka2)){
	 	$error="Niste upisali lozinku.";
		$OK=false;
	 }
	 elseif($lozinka1!= $lozinka2){
	 	$error="Upisane lozinke nisu jednake.";
		$OK=false;
	 }
	 elseif($tipKorisnika==0){
	 	$error="Niste odreili tip korisnika.";
		$OK=false;
	 }
	$izbor=2;
	if($OK){
		$izbor=1;
		// upis korisnika
		$data= new userClass;
		$data ->id=$idUser;
		$data ->ime=$ime;
		$data ->prezime=$prezime;
		$data ->login=$userName2;
		$data ->password=$lozinka1;
		$data ->tip=$tipKorisnika;
		$data ->adresa=$adresa;
		$data ->email=$posta;
	    if( $idUdruga==0){
			 //echo "upis osobe <br>";
			 // provjera da li postoji osoba
			$valid =authorization_2($userName2, $lozinka1);
			if($valid==0){
		 	   insert_user($data);
			}
		}
		else{
			 // update osobe			 
			 update_korisnikClass($data);
		 }
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<META http-equiv=Content-Type content="text/html; charset=windows-1250">
<META http-equiv=Pragma content=no-cache>
<LINK href="../css/stil.css" type=text/css rel=stylesheet>
<LINK href="css/style.css" type=text/css rel=stylesheet>
<html>
<head>
<title>Hrvatski kineziološki savez</title>
   <link href="css/calendar.css" rel="stylesheet" type="text/css">

</head>

<body>
<table width="875" border="0" align="center" class="okvir">
  <tr>
    <td width="205" align="center" valign="top"><p><br>
            <img src="../image/logoTZK4.gif" width="113" height="170"></p>
        <table width="100%"  border="0" class="bg">
          <tr>
            <td align="right"><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td><table width="100%"  border="0">
              <tr>
                <td align="right" class="tekst"><strong>ADMINISTRACIJA</strong></td>
              </tr>
              <tr>
                <td><img src="../image/left_menu_crta2.gif" alt="" width=190 height=5></td>
              </tr>
              <tr>
                <td align="right"><A href="skupovi.php" target="_parent" class="crni_link_U_bez">Skupovi</A></td>
              </tr>
              <tr>
                <td align="right" ><A href="osobe.php" target="_parent" class="crni_link_U_bez">Baza kineziologa</A></td>
              </tr>
              <tr>
                <td align="right" ><A href="udruge.php" target="_parent" class="crni_link_U_bez">Udruge kineziologa</A></td>
              </tr>
              <?php
			  	if($_SESSION['tipUser']==1){
					echo"<tr>
                			<td align=\"right\" ><A href=\"korisnici.php\" target=\"_parent\" class=\"crni_link_U_bez\">Administracija korisnika</A></td>
              			</tr>
					";
			    }
			  ?>
              <tr>
                <td><img src="../image/left_menu_crta2.gif" alt="" width=190 height=5></td>
              </tr>
              <tr>
                <td align="right" ><A href="arhiva.php" target="_parent" class="crni_link_U_bez">Arhiviranje baze</A></td>
              </tr>
              <tr>
                <td><img src="../image/left_menu_crta2.gif" alt="" width=190 height=5></td>
              </tr>
              <tr>
                <td align="right"><A href="login.php" target="_parent" class="crni_link_U_bez">Odjava</A></td>
              </tr>
            </table>
              <p>&nbsp;</p>
            <p>&nbsp;</p></td>
          </tr>
        </table>
        <p>&nbsp;</p></td>
    <td width="8" align="center" valign="top" class="linija_mid">&nbsp;</td>
    <td align="left" valign="top"><table width="100%"  border="0">
      <tr>
        <td width="68%" height="55" valign="top" class="sivi"><img src="../image/ks.jpg" width="431" height="65"></td>
        <td width="32%" align="right" valign="bottom"><a href="http://www.fiep.net"><img src="../image/fiep.jpg" alt="FEDERATION  INTERNATIONALE   D'EDUCATION PHYSIQUE" width="194" height="105" border="0"></a></td>
      </tr>
      <tr>
        <td height="1" colspan="2" class="linija"><img src="../image/linija_horiz.gif" width="3" height="1"></td>
      </tr>
      <tr>
        <td height="75" colspan="2"><img src="../image/traka2.gif" width="670" height="80"></td>
      </tr>
      <tr>
        <td height="1" colspan="2" class="linija"><img src="../image/linija_horiz.gif" width="3" height="1"></td>
      </tr>
      <tr align="left" valign="middle">
        <td height="12" colspan="2" class="meni" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp;<a href="skupovi.php" class="meniLeft2">Administracija</a> :: Administracija korisnika</td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<?php echo $error ?></td>
      </tr>
      <tr >
        <td colspan="2" align="left" valign="top"><table width="100%"  border="0" cellpadding="1" cellspacing="1" bordercolor="#000000">
          <tr>
            <td align="left" valign="top" class="bg"><form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>">
              <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
                <tr align="left">
                  <td colspan="6"><input name="Submit_1" type="submit" class="tekst2" id="Submit_1" value="   Pregled   " >
                    <input name="Submit_2" type="submit" class="tekst2" id="Submit_2" value=" Dodavanje " >
                    <input name="Submit_3" type="submit" class="tekst2" id="Submit_3" value=" Ureðivanje " >
                    <input name="Submit_4" type="submit" class="tekst2" id="Submit_4" value=" Brisanje " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr align="left">
                  <td>&nbsp;</td>
                </tr>
                <?php
					switch($izbor){
						case 1:
							include ($body."/pregledKorisnika.php");
							break;
						case 2:
							require($body."/user.php");
							break;
						case 3:
							include ($body."/user.php");
							break;
						case 4:
							include ($body."/brisanjeKorisnika.php");
							break;
						default:
							include ($body."/pregledKorisnika.php");
							break;
					}
					?>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form>
              <br></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
