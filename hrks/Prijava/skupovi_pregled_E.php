<?php
global $dataBox;
$error="";
$check_F0="checked";$check_F1="";$check_F2="";$check_F3=""; $check_F4="";
$selectA_0="selected"; $selectA_1="";$selectA_2="";
$selectB_0="selected"; $selectB_1="";$selectB_2="";$selectB_3="";$selectB_4="";$selectB_5="";
$selectC_0="selected"; $selectC_1="";$selectC_2="";
$OK=true;
session_start();
include("require/common.php");
include ("require/config.php");
if($_SESSION['userId']<=0){
 header("Location: login.php");
 exit();
}
$idSkup=$_GET['idSkup'];
if ($idSkup>0){
	$nazivSkupa=odrediNazivSkupa($idSkup);
	// da li je skup domaæi ili meðunarodni
	$vrstaSkupa=odrediVrstaSkupa($idSkup);
}
else{
	header("Location: skupovi.php?izbor=1"); //?izbor=1
	exit();
}
if($_POST['Submit_5']){
		header("Location: pregled_radova.php?idSkup=$idSkup"); 
		exit();
}
elseif($_POST['filter']){
		$radioF=$_POST["radioF"];
		$drzava=$_POST["drzava"];
		$rad=$_POST["sudjelovanje"];
		$sekcija=$_POST["sekcija"];
		if($radioF==1){
			$check_F0="";
			$check_F1="checked";
		}
		elseif($radioF==2){
			$check_F0="";
			$check_F2="checked";
		}
		elseif($radioF==3){
			$check_F0="";
			$check_F3="checked";
		}	
		elseif($radioF==4){
			$check_F0="";
			$check_F4="checked";
		}	
		if($drzava==1){
			$selectA_0="";
			$selectA_1="selected";
		}
		elseif($drzava==2){
			$selectA_0="";
			$selectA_2="selected";
		}
		if($sekcija==1){
			$selectC_0="";
			$selectC_1="selected";
		}
		elseif($sekcija==2){
			$selectC_0="";
			$selectC_2="selected";
		}
		if($rad==1){
			$selectB_0="";
			$selectB_1="selected";
		}
		elseif($rad==2){
			$selectB_0="";
			$selectB_2="selected";
		}
		elseif($rad==3){
			$selectB_0="";
			$selectB_3="selected";
		}
		elseif($rad==4){
			$selectB_0="";
			$selectB_4="selected";
		}
		elseif($rad==5){
			$selectB_0="";
			$selectB_5="selected";
		}
		$izbor=6;
}
elseif($_POST['posta']){
		$domSkup=odredi_mailAdresu(1);
		$medSkup=odredi_mailAdresu(2);
		$izbor=3;
}
elseif($_POST['pos']){ // potvrda o upisu novih adresa
		$idSkup=$_POST["idSkup"];
		$domSkup=$_POST["domSkup"];
		$medSkup=$_POST["medSkup"];
		$OK=true;
		// provjera e-mail adresa
		if(empty($domSkup)){
	 		$error="Niste upisali adresu za domaæe skupove.";
			$OK=false;
		}
		elseif(!is_email3($domSkup)){
	 		$error="Nepravilno upisana adresa E-pošte za domaæi skup.";
			$OK=false;
	 	}
		if(empty($medSkup)){
	 		$error="Niste upisali adresu za meðunarodne skupove.";
			$OK=false;
		}
		elseif(!is_email3($medSkup)){
	 		$error="Nepravilno upisana adresa E-pošte za meðunarodni skup.";
			$OK=false;
	 	}
		$izbor=3;
		if($OK){
			// upis promjene
			update_Email_Prijave(1, $domSkup);
			update_Email_Prijave(2, $medSkup);
			$error="Adrese E-pošte ispravno su zapisane u bazu.";
			$izbor=1;
		}
}
elseif($_POST['Da']){
	$izbor=1;
	$rezultat=select_id_check(); // èitamo podatke koje trebamo brisati
	while ($row = mysql_fetch_array($rezultat)) {
		//echo $idSkup." - skup ".$row[0]." - id osobe<br>";
		delete_prijava_E($idSkup, $row[0]); // bisanje
	}
}
elseif($_POST['Da_E']){
	$izbor=1;
	$rezultat=select_id_check(); // èitamo podatke koje trebamo brisati
	while ($row = mysql_fetch_array($rezultat)) {
		//echo $idSkup." - skup ".$row[0]." - id osobe<br>";
		delete_prijava_E($idSkup, $row[0]); // bisanje
		// treba dodati brisanje i datoteke rada ako je ima osoba
	}
}
elseif($_POST['Ne']){
	$izbor=1;
}
elseif($_POST['Submit_4']){ // brisanje prijavljene osobe
	delete_id_check();
    if(isset($_POST['box'])){
		$izbor=4;
		foreach($_POST['box'] as $value){ 
			insert_id_check($value); //privremeni upis u bazu
		}
	}
	else{
		$izbor=1;
		$error="Niste odabrali osobu.";
	}
}	
elseif($_POST['Submit_3']){  // edit prijave
	$izbor=1;
    if(isset($_POST['box'])){
   		foreach($_POST['box'] as $value){ 
			$idOsoba=$value;
			$izbor=2;
			break;
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
        <td height="12" colspan="2" class="meni" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp;<a href="skupovi.php" class="meniLeft2">Pregled skupova</a> :: Prijave</td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<strong>Meðunarodni skup</strong></td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<strong>Naziv skupa: <?php echo $nazivSkupa ?></strong></td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<?php echo $error ?></td>
      </tr>
      <tr >
        <td colspan="2" align="left" valign="top"><table width="100%"  border="0" cellpadding="1" cellspacing="1" bordercolor="#000000">
          <tr>
            <td align="left" valign="top"><form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>" class="bg">
              <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
                <tr align="left">
                  <td colspan="6" class="tekst"><strong><u>Filtriranje podataka:&nbsp;</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>
                    <input type="submit" class="tekst" name="filter" id="filter" value="Filtriraj podatke">
                  </strong></strong></td>
                </tr>
                <tr align="left">
                  <td colspan="6">&nbsp;&nbsp;<input name="radioF" type="radio" id="radioF" value="0" <?php echo $check_F0?>>
                    Sve prijave</td>
                </tr>
                <tr align="left">
                  <td colspan="6">&nbsp;&nbsp;<input type="radio" name="radioF" id="radioF" value="1"<?php echo $check_F1?>>
                    Prijave prema prebivali&scaron;tu sudionika: 
                      <select name="drzava" class="tekst" id="drzava">
                      <option value="0" <?php echo $selectA_0 ?>>-</option>
                      <option value="1" <?php echo $selectA_1 ?>>Domaæi sudionici skupa</option>
                      <option value="2" <?php echo $selectA_2 ?>>Strani sudionici skupa</option>
                    </select></td>
                </tr>
                <tr align="left">
                  <td colspan="6">&nbsp;&nbsp;<input type="radio" name="radioF" id="radioF" value="2"<?php echo $check_F2?>>
                    Prijave prema naèinu sudjelovanja na skupu:
                      <select name="sudjelovanje" class="tekst" id="sudjelovanje">
                      <option value="0" <?php echo $selectB_0 ?>>-</option>
                      <option value="1" <?php echo $selectB_1 ?>>Samo kao sudionik (bez rada) </option>
                      <option value="2" <?php echo $selectB_2 ?>>Podnosilac priopæenja &ndash; usmeno izlaganje &ndash; prvi autor </option>
                      <option value="3" <?php echo $selectB_3 ?>>Podnosilac priopæenja &ndash; usmeno izlaganje &ndash; koautor </option>
                      <option value="4" <?php echo $selectB_4 ?>>Podnosilac priopæenja &ndash; poster prezentacija &ndash; prvi autor</option>
                      <option value="5" <?php echo $selectB_5 ?>>Podnosilac priopæenja &ndash; poster prezentacija &ndash; koautor </option>
                    </select></td>
                </tr>
                <tr align="left">
                  <td colspan="6">&nbsp;&nbsp;<input type="radio" name="radioF" id="radioF" value="3" <?php echo $check_F3?>>
                  Prijave prema sekcija rada: 
                      <select name="sekcija" class="tekst" id="sekcija">
                      <option value="0" <?php echo $selectC_0 ?>>-</option>
                      <option value="1" <?php echo $selectC_1 ?>>Tjelesna i zdrastvena kultura</option>
                      <option value="2" <?php echo $selectC_2 ?>>&Scaron;kolski sport </option>
                    </select></td>
                </tr>
                <tr align="left">
                  <td colspan="6">&nbsp;&nbsp;<input name="radioF" type="radio" id="radioF" value="4" <?php echo $check_F4?>>
                    Zahtjev za prijevoz iz zagrebaèke zraène luke do Poreèa.</td>
                </tr>
      			<tr>
        			<td height="1" colspan="2" class="linija"><img src="../image/linija_horiz.gif" width="3" height="1"></td>
      			</tr>
                <tr align="left">
                  <td colspan="6"></td>
                </tr>
                <tr align="left">
                  <td colspan="6"><input name="Submit_1" type="submit" class="tekst2" id="Submit_1" value="   Pregled   " onmouseover="Tip('Pregled prijava odabranog skupa')" onmouseout="UnTip()" >
                    <input name="Submit_3" type="submit" class="tekst2" id="Submit_3" value=" Prikaz prijave " onmouseover="Tip('Prikaz detalja prijave')" onmouseout="UnTip()" >
                    <?php
			  	if($_SESSION['tipUser']==1){
					echo"
						<input name=\"Submit_4\" type=\"submit\" class=\"tekst2\" id=\"Submit_4\" value=\" Brisanje \" onmouseover=\"Tip('Brisanje odabranih prijava')\" onmouseout=\"UnTip()\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			    }
			  ?>
                    <input name="Submit_5" type="submit" class="tekst2" id="Submit_5" value="Pregled radova" onmouseover="Tip('Pregled svih prijavljenih radova ')" onmouseout="UnTip()">
                    <?php
			  	if($_SESSION['tipUser']==1){
					echo"
						<input name=\"posta\" type=\"submit\" class=\"tekst2\" id=\"posta\" value=\"  E-pošta  \" onmouseover=\"Tip('Ureðivanje adresa E-pošte')\" onmouseout=\"UnTip()\">";
			    }
			  ?></td>
                </tr>
                <tr>
                <td colspan="5" >
                <div style="overflow:auto; height:300px;width:100%;">
                  <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
                <?php
					switch($izbor){
						case 1:
							include ($body."/pregledPrijavljenihOsoba_E.php");
							break;
						case 2:
							include ($body."/pregledDetaljiOsoba_E.php");
							break;
						case 3:
							include ($body."/ePosta.php");
							break;
							break;
						case 4:
							include ($body."/brisanjePrijave_E.php");
							break;
						case 5:
							include ($body."/pregledPrijavljenihOsoba.php");
							break;
						case 6: // filtriranje
							include ($body."/pregledPrijavljenihOsoba_E_Filter.php");
							break;
						default:
							include ($body."/pregledPrijavljenihOsoba_E.php");
							break;
					}
					?>
                   </table>
                   </div>
                   </td>
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
