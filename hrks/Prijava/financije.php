<?php
global $dataBox;
$error="";
$OK=true;
session_start();
include("require/common.php");
include ("require/config.php");
$vrstaUplate=$_POST['vrstaUplate2'];
if($_SESSION['userId']<=0){
 header("Location: login.php");
 exit();
}
$idSkup=$_GET['idSkup'];
if ($idSkup>0)
	$nazivSkupa=odrediNazivSkupa($idSkup);
else{
	header("Location: skupovi.php?izbor=1"); //?izbor=1
	exit();
}
if($_POST['Submit_5']){
  // odredimo oznaèeni skup
  if(isset($_POST['box'])){
   	foreach($_POST['box'] as $value){ 
	   	$idSkup=$value;
		break;
	}
	$izbor=5;
  }
  else{
	  $izbor=1;
  }
}
elseif($_POST['Submit_1']){ // preklopnik za opæe uplate
	if($vrstaUplate!="2"){
		$izbor=1;
	}
	else{
		$izbor=11;
	}
}
elseif($_POST['Submit_6']){ // preklopnik za opæe uplate
	$izbor=1;
	$nazivUplate="Ostale uplate";
	$vrstaUplate="1";
}
elseif($_POST['Submit_7']){ // preklopnik za pregled uplata sudionika skupa
	$izbor=11;
	$nazivUplate="Uplate sudionika skupa";
	$vrstaUplate="2";
}
elseif($_POST['Submit_2']){
	if($vrstaUplate!=2){
		$izbor=2;
		$idUplata=0;
	}
	else{
		$izbor=21;
		$idOsoba=0;
	}
	$edit=0;
}
elseif($_POST['Da2']){
	$izbor=1;
	$rezultat=select_id_check(); // èitamo podatke koje trebamo brisati
	while ($row = mysql_fetch_array($rezultat)) {
		delete_uplataOpce($row[0],$idSkup) ; // bisanje osoba s popisa
	}
}
elseif($_POST['Da3']){
	$izbor=11;
	$rezultat=select_id_check(); // èitamo podatke koje trebamo brisati
	while ($row = mysql_fetch_array($rezultat)) {
		delete_uplata($idSkup, $row[0]) ; // bisanje uplata osobe
	}
}
elseif($_POST['Ne']){
	$izbor=1;
}
elseif($_POST['Ne3']){
	$izbor=11;
}
elseif($_POST['Submit_4']){
	delete_id_check();
    if(isset($_POST['box'])){
		if($vrstaUplate!=2)
			$izbor=4;
		else
			$izbor=41;
		foreach($_POST['box'] as $value){ 
			insert_id_check($value); //privremeni upis u bazu
		}
	}
	else{
		if($vrstaUplate!=2)
			$izbor=1;
		else
			$izbor=11;
		$error="Niste odabrali uplatu.";
	}
}	
elseif($_POST['Submit_3']){
	if($vrstaUplate!=2){		
		$izbor=3;
		if(isset($_POST['box'])){
   			foreach($_POST['box'] as $value){ 
	   	 		$data=odredi_uplatu_ID_opca($value);
				break;
			}
			while ($row = mysql_fetch_array($data)){
					$rezultat=$row;
					break;
			}
			$idUplata=$rezultat[0]; // id uplate
			$iznos=$rezultat[2];
			$nadnevak=mysql2table($rezultat[3]);
			$napomena=$rezultat[4];
			$ufa_ifa=$rezultat[5];
			if($ufa_ifa==1)
				$check_P="checked";
			elseif($spol==2)
				$check_R="checked";
		}
		else{
			$izbor=1;
			$error="Niste odabrali uplatu.";
		}
	}
	else{ // osobe
		$izbor=31;
		$idOs=0;
		if(isset($_POST['box'])){
   		  foreach($_POST['box'] as $value){ 
			// odredimo uplatu za osobu i ime i prezime
				$idOs=$value;
				$data=odredi_osobuID($value);
				while ($row = mysql_fetch_array($data)){
					$rezultat=$row;
					break;
				}
				$nadnevak="";
				$ime=$rezultat[3];
				$prezime=$rezultat[2];  // prezime i ime osobe
				$data=select_uplata_id($idSkup,$idOs);
				while ($row = mysql_fetch_array($data)){
					$nadnevak=mysql2table($row[4]);
					$iznos=$row[2];
					$napomena=$row[3];
					break;
				}
				
		  }	
		}
		else{
			$izbor=11;
			$error="Niste odabrali uplatu.";
		}
	}
}
elseif($_POST['NovaOsoba']){ // upis nove uplate za sudionika skupa
    if($vrstaUplate!=2)
			$izbor=3;
		else
			$izbor=31;
	$idSkup=$_POST["idSkup"];
	$idOsoba=$_POST["idOsoba"];
  	$napomena=trim($_POST["napomena"]);
	$iznos=trim($_POST["iznos"]);
	$ime=$_POST["ime"];
	$prezime=$_POST["prezime"];
	// zamijenimo , s toèkom
	$iznos= Getfloat($iznos); 
  	$nadnevak=($_POST["nadnevak"]);
	// provjerimo da li imamo osobu u bazi
	if($idOsoba<=0)
		$idOsoba=odredi_osobu_ID($ime,$prezime);
	// provjera ispravnosti unosa
	if(empty($ime)){
	 	$error="Niste upisali ime.";
		$OK=false;
	 }
	elseif(empty($prezime)){
	 	$error="Niste upisali prezime.";
		$OK=false;
	 }
	elseif($idOsoba<=0){
	 	$error="Osoba s tim imenom i prezimenom ne postoji u bazi kineziologa.";
		$OK=false;
	 }
	 elseif(empty($iznos)){
	 	$error="Niste upisali iznos uplate.";
		$OK=false;
	 }
	elseif(!is_float($iznos)){ // provjera da li je realni broj
	 	$error="Pogrješno upisan format broja kod iznosa uplate.";
		$OK=false;
	 }
	 //if(is_float(27.25))
	 elseif(empty($nadnevak)){
	 	$error="Niste odredili nadnevak uplate.";
		$OK=false;
	 }
/*	elseif(empty($napomena)){
	 	$error="Niste upisali napomenu.";
		$OK=false;
	 }
*/	
	if($OK){ // sve je ok
     $izbor=11;
	 //$idOS=odredi_osobu_ID($_POST['ime'],$_POST['prezime']); // odredimo id osobe
	//echo $iznos." - OK <br>";
		// provjera da li postoji uplata
		$nadnevak=table2mysql($_POST["nadnevak"]);
		// provjerimo id osobe koja plaæa
		$idRez=odredi_uplatu_ID_skup($idSkup,$idOsoba);
		if($idRez>0){
		// update uplate
			//echo $iznos." update - OK <br>";
			update_uplata($idSkup,$idOsoba,$iznos,$nadnevak,$napomena);
		}
		else{
			// upis nove uplate
			insert_uplata($idSkup,$idOsoba,$iznos,$nadnevak,$napomena);
			// dodajemo oznaku da je prijava izvršena ali nepotpuna
			$idPrijava=odredi_prijava_ID_skup($idSkup,$idOsoba);
		 	//echo $idPrijava."id prijave  <br>";
		 	if($idPrijava==0)
		 		insert_prijava($idSkup,$idOsoba,"N");
		}
	}
}
elseif($_POST['NovaUplata2']){ // upis nove opæe uplate
    if($vrstaUplate!=2)
			$izbor=3;
		else
			$izbor=31;
	$idSkup=$_POST["idSkup"];
	$idUplata=$_POST["idUplata"];
  	$napomena=trim($_POST["napomena"]);
	$iznos=trim($_POST["iznos"]);
	$ufa_ifa=$_POST["radio_p"];
	//echo "UFA_IFA ".$ufa_ifa."<br>";
	if($ufa_ifa==1)
		$check_P="checked";
	elseif($spol==2)
		$check_R="checked";
	// zamijenimo , s toèkom
	$iznos= Getfloat($iznos); 
	//echo $iznos." - poslije <br>";
  	$nadnevak=($_POST["nadnevak"]);
	// provjera ispravnosti unosa
	if(empty($iznos)){
	 	$error="Niste upisali iznos uplate.";
		$OK=false;
	 }
	elseif(!is_float($iznos)){ // provjera da li je realni broj
	 	$error="Pogrješno upisan format broja kod iznosa uplate.";
		$OK=false;
	 }
	 //if(is_float(27.25))
	 elseif(empty($nadnevak)){
	 	$error="Niste odredili nadnevak uplate.";
		$OK=false;
	 }
	elseif(empty($napomena)){
	 	$error="Niste upisali napomenu.";
		$OK=false;
	 }
	elseif($ufa_ifa==0){
	 	$error="Niste odredili vrstu uplate.";
		$OK=false;
	 }
	if($OK){ // sve je ok
     $izbor=1;

	 //echo $iznos." - OK <br>";
		// provjera da li postoji uplata
		$nadnevak=table2mysql($_POST["nadnevak"]);
		$idRez=postoji_uplatu_ID_opca($idUplata);
		if($idRez>0){
		// update uplate
		 // echo $iznos." - UPDATE <br>";
			update_uplata_opca($idSkup,$idUplata,$iznos,$nadnevak,$napomena,$ufa_ifa);
		}
		else{
		// upis nove uplate
		 // echo $iznos." - INSERT <br>"; 
			insert_uplata_opca($idSkup,$iznos,$nadnevak,$napomena,$ufa_ifa);
		}
	}
}

if($vrstaUplate!=2)
	$nazivUplate="Ostale uplate";
else
	$nazivUplate="Uplate sudionika skupa";
// odreðivanje ukupnih finacijskih podataka
$iznosSudionici=suma_kotizacija($idSkup);

$fin_rashod=suma_rashod($idSkup);
$fin_prihod=suma_prihod($idSkup);
$iznosUfa_Ifa=$fin_prihod-$fin_rashod;

$iznosUkupno=$iznosSudionici+$iznosUfa_Ifa;

round($iznosSudionici,2);
$iznosSudionici=number_format($iznosSudionici, 2, ',', ' ');

round($iznosUfa_Ifa,2);
$iznosUfa_Ifa=number_format($iznosUfa_Ifa, 2, ',', ' ');

round($iznosUkupno,2);
$iznosUkupno=number_format($iznosUkupno, 2, ',', ' ');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<META http-equiv=Content-Type content="text/html; charset=windows-1250">
<META http-equiv=Pragma content=no-cache>
<LINK href="../css/stil.css" type=text/css rel=stylesheet>
<LINK href="css/style.css" type=text/css rel=stylesheet>
<html>
<head>
<title>Hrvatski kineziološki savez</title>
   <script language="javaScript" type="text/javascript" src="css/calendar.js"></script>
   <link href="css/calendar.css" rel="stylesheet" type="text/css">
</head>

<body>
<script type="text/javascript" src="../css/wz_tooltip.js"></script>
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
        <td height="12" colspan="2" class="meni" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp;<a href="skupovi_pregled.php?idSkup=<?php echo $idSkup ?>" class="meni">Prijave  skup</a> :: Financije</td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;</td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<strong>Naziv skupa: <?php echo $nazivSkupa ?></strong></td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="meniLeft">&nbsp;<?php echo $error ?></td>
      </tr>
      <tr >
        <td colspan="2" align="left" valign="top">
        
        <table width="100%"  border="0" cellpadding="1" cellspacing="1" bordercolor="#000000">
          <tr>
            <td align="left" valign="top"><form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>">
                            <tr align="left">
                  <td colspan="6"><input name="Submit_6" type="submit" class="tekst2" id="Submit_6" value=" Ostale uplate " onmouseover="Tip('Podaci o ostalim uplatama skupa ')" onmouseout="UnTip()">&nbsp;&nbsp;&nbsp;
                    <input name="Submit_7" type="submit" class="tekst2" id="Submit_7" value=" Uplate sudionika " onmouseover="Tip('Podaci o uplatama sudionika skupa  ')" onmouseout="UnTip()">
                    <input name="vrstaUplate2" type="hidden" id="vrstaUplate2" value="<?php echo $vrstaUplate ?>" />
                  </td>
                </tr>
                <tr align="left">
                  <td colspan="5"  class="tekst">Odabran pregled uplata: <strong><?php echo $nazivUplate ?></strong></td>
                </tr>
                <tr align="left">
                  <td colspan="2"  class="tekst"><fieldset>
                  <legend class="meniLeft"> Financijsko stanje </legend> 
                  Ukupno financijsko stanje skupa: <strong><?php echo $iznosUkupno ?></strong><br>
                  Iznos uplata sudionika: <strong><?php echo $iznosSudionici ?></strong><br>
                  Iznos ostalih prihoda/rashoda: <strong><?php echo $iznosUfa_Ifa; ?></strong>
                  </fieldset>
                  </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr align="left">
                  <td colspan="6"><input name="Submit_1" type="submit" class="tekst2" id="Submit_1" value="   Pregled   " >
                    <input name="Submit_3" type="submit" class="tekst2" id="Submit_3" value=" Ureðivanje " >
                    <input name="Submit_2" type="submit" class="tekst2" id="Submit_2" value=" Dodavanje " >
                    <input name="Submit_4" type="submit" class="tekst2" id="Submit_4" value=" Brisanje " >
                   </td>
                </tr>
             </table>
            <div style="overflow:auto; height:300px;width:100%;">
              <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
                <?php
					switch($izbor){ 
						case 1:
							include ($body."/pregledOpcihUplata.php");
							break;
						case 11:
							include ($body."/pregledOsobeUplata.php");
							break;
						case 2:
							include ($body."/novaUplataOpca.php");
							break;
						case 21:
							include ($body."/novaUplata_Osoba_2.php");
							break;
						case 3:
							include ($body."/novaUplataOpca.php");
							break;
						case 31:
							include ($body."/novaUplata_Osoba_2.php");
							break; 
						case 4:
							include ($body."/brisanjeUplateOpce.php");
							break;
						case 41:
							include ($body."/brisanjeUplateOsoba_2.php");
							break;
						default:
							include ($body."/pregledOpcihUplata.php");
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
              </div>
            </form>
              <br></td>
          </tr>
        </table>
        
        </td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
