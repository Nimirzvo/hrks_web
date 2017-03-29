<?php
global $dataBox;
$error="";
$idOsoba=0; // oznaka id skupa koji æe se mijenjati
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
}
elseif($_POST['Da']){
	$izbor=1;
	$rezultat=select_id_check(); // èitamo podatke koje trebamo brisati
	while ($row = mysql_fetch_array($rezultat)) {
		delete_sosoba($row[0]); // bisanje osoba s popisa
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
		$error="Niste odabrali osobu.";
	}
}	
elseif($_POST['Submit_3']){ // editiramo podatke o osobi
	$izbor=3;
	$edit=1;
	if(isset($_POST['box'])){
   		foreach($_POST['box'] as $value){ 
			$izb=$value;
	   	 	$data=odredi_osobuID($value);
			while ($row = mysql_fetch_array($data)){
				$rezultat=$row;
				break;
			}
		}
	}
	$idOsoba=$rezultat[0]; // pamtimo za kasniju promijenu
	$nadnevak=mysql2table($rezultat[1]);

	$prezime=$rezultat[2];
  	$ime=$rezultat[3];
	$idTitula=$rezultat[4];
	$ulica=$rezultat[6];
	$grad=$rezultat[7];
	$idPosta=$rezultat[8];
	$idZupanija=$rezultat[9];
	$telefon=$rezultat[10];
	$email=$rezultat[12];
	$institucija=$rezultat[13];
	$gradInsti=$rezultat[14];
	$idUdruga=$rezultat[15];
	$napomena=$rezultat[17];
	$spol=$rezultat[18];
	if($spol==1)
		$check_M="checked";
	elseif($spol==2)
		$check_Z="checked";
}
elseif($_POST['Novi']){
	$idOsoba=$_POST["idOsoba"];
	$ime=trim($_POST["ime"]);
  	$prezime=trim($_POST["prezime"]);
  	$nadnevak=$_POST["nadnevak"];
	$spol=$_POST["radio"];
	if($spol==1)
		$check_M="checked";
	elseif($spol==2)
		$check_Z="checked";
	$idTitula=$_POST["titula"];
	$ulica=$_POST["ulica"];
	$grad=$_POST["grad"];
	$idPosta=$_POST["idPosta"];
	$idZupanija=$_POST["zupanija"];
	$telefon=$_POST["telefon"];
	$email=$_POST["email"];
	$institucija=$_POST["institucija"];
	$gradInsti=$_POST["gradInsti"];
	$idUdruga=$_POST["udruga"];
	if(empty($idUdruga))
	  $idUdruga=0;
	// provjera podataka
	if(empty($ime)){
	 	$error="Niste upisali Vaše ime.";
		$OK=false;
	 }
	 elseif(empty($prezime)){
	 	$error="Niste upisali Vaše prezime.";
		$OK=false;
	 }
	 elseif(empty($nadnevak)){
	 	$error="Niste odredili nadnevak roðenja.";
		$OK=false;
	 }
	 elseif($spol==0){
	 	$error="Niste odredili spol.";
		$OK=false;
	 }
	// ostala provjera ----------------
	 elseif(empty($ulica)){
	 	$error="Niste upisali naziv ulice.";
		$OK=false;
	 }
	 elseif(empty($grad)){
	 	$error="Niste upisali naziv grada/mjesta.";
		$OK=false;
	 }
	 elseif($idPosta==0){
	 	$error="Niste odredili poštu stanovanja.";
		$OK=false;
	 }
	 elseif($idZupanija==0){
	 	$error="Niste odredili županiju.";
		$OK=false;
	 }
	 elseif(empty($telefon)){
	 	$error="Niste upisali kontakt telefon.";
		$OK=false;
	 }
	 elseif(empty($institucija)){
	 	$error="Niste upisali naziv institucije.";
		$OK=false;
	 }
	 elseif(empty($gradInsti)){
	 	$error="Niste upisali naziv grada/mjesta institucije.";
		$OK=false;
	 }
	
	$izbor=2;
	if($OK){
		$izbor=1;
		// upis osobe
		$data= new osobaClass;
		$data ->id=$idOsoba;
		$data ->datum=table2mysql($nadnevak);
		$data ->prezime=$prezime;
		$data ->ime=$ime;
		$data ->idTitula=$idTitula;
		$data ->godina=godinaDatum($nadnevak);
		$data ->ulica=$ulica;
		$data ->grad=$grad;
		$data ->idPosta=$idPosta;
		$data ->idZupanija=$idZupanija;
		$data ->tel=$telefon;
		$data ->mob="";
		$data ->email=$email;
		$data ->skola=$institucija;
		$data ->skolaGrad=$gradInsti;
		$data ->clan=$idUdruga;
		$data ->nazivDrustva="";
		$data ->napomena="";
		$data ->spol=$spol;
	    if( $idOsoba==0){
			 //echo "upis osobe <br>";
		 	insert_osoba($data);
		}
		else{
			 // update osobe			 
			 update_OsobaClass($data);
		 }
	}
}
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function provjera(val) { 
  if (val=="1"){
  	form1.udruga.disabled=false;
  }
  else{
  	form1.udruga.disabled=true;
  }
}

//-->
</script>
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
                <td align="right" class="tekst">Baza kineziologa</td>
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
        <td height="12" colspan="2" class="meni" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp; Baza kineziologa</td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<?php echo $error ?></td>
      </tr>
      <tr >
        <td colspan="2" align="left" valign="top"><table width="100%"  border="0" cellpadding="1" cellspacing="1" bordercolor="#000000">
          <tr>
            <td align="left" valign="top"><form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>">
              <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
                <tr align="left">
                  <td colspan="6"><input name="Submit_1" type="submit" class="tekst2" id="Submit_1" value="   Pregled   " >
                    <input name="Submit_2" type="submit" class="tekst2" id="Submit_2" value=" Dodavanje " >
                    <input name="Submit_3" type="submit" class="tekst2" id="Submit_3" value=" Ureðivanje " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr align="left">
                  <td>&nbsp;</td>
                </tr>
                <?php
					switch($izbor){
						case 1:
							include ($body."/pregledOsoba.php");
							break;
						case 2:
							require($body."/novaOsoba.php");
							break;
						case 3:
							include ($body."/novaOsoba.php");
							break;
						case 4:
							include ($body."/brisanjeOsoba.php");
							break;
						default:
							include ($body."/pregledOsoba.php");
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
