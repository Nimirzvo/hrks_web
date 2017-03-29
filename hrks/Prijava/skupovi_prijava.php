<?php
$error="";
$OK=true;
session_start();
include("require/common.php");
include ("require/config.php");
$izbor=$_GET['izbor'];
$idSkup=$_GET['idSkup'];
if($idSkup==0){
	header("Location: skupovi.php?izbor=1"); //?izbor=1
	exit();
}
$naziv=odrediNazivSkupa($idSkup);
$title="Naziv skupa";
$check_1=""; $check_2=""; $disable="false"; // provjera za èlanstvo u udruzi

if($_POST['Prijava_1']){
	/* prelazimo u drugi dio prijave
	 odredimo osobu iz baze, ako postoji upišemo id i podatke 
	*/
	$izbor=1;
	$ime=trim($_POST["ime"]);
  	$prezime=trim($_POST["prezime"]);
  	$nadnevak=$_POST["nadnevak"];
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
	 // provjera da li je osoba veæ prijavljena
	 $idOS=odredi_osobu_ID($_POST['ime'],$_POST['prezime']); // odredimo id osobe
	 if($idOS>0){
		 // provjera da li je prijavaljem
		 $test=provjeri_prijavu_osobe($idOS, $idSkup, "D");
		 if($test>0){
	 		$error="Osoba s tim podacima veæ je prijavljena za odabrani skup.";
			$OK=false;
		  }
	 }
	 
	 if($OK){
		 // idemo u drugi dio registracije
		 $izbor=2;  // oznaka da smo odredili sljedeæu fazu upisa
		 $data=odredi_osobu($_POST['ime'],$_POST['prezime'],$_POST['nadnevak']);
		 // punimo varijable s podacima
		  $idOsoba=0; $ulica=""; $grad=""; $idPosta="0"; $idZupanija="0"; $telefon=""; $email=""; $spol=""; $idTitula="0"; $institucija="";
		  $gradInsti=""; $idUdruga=0;
		 while ($row = mysql_fetch_array($data)) {
			 $idOsoba=$row[0];
			 $idTitula=$row[4];
			 $ulica=$row[6];
			 $grad=$row[7];
			 $idPosta=$row[8];
			 $idZupanija=$row[9];
			 $telefon=$row[10];
			 $email=$row[12];
			 $institucija=$row[13];
			 $gradInsti=$row[14];
			 $idUdruga=$row[15];
			 $spol=$row[18];			 
			 break;			
		 }
		 if ($idUdruga!=0){
			 $check_1="checked";
			 $check_2="";
			 $disable="false";
		}
		else{
			 $check_2="checked";
			 $check_1="";
			 $disable="true";
		}		
		// provjera spola
		 if ($spol==1){
			 $check_M="checked";
			 $check_Z="";
		 }
		 elseif ($spol==2){
			 $check_Z="checked";
			 $check_M="";
		 }
		else{
			 $check_Z="";
			 $check_M="";
		}		 
	 }
}
elseif($_POST['Prijava_2']){
	$izbor=1;
	$ime=$_POST["ime"];
  	$prezime=$_POST["prezime"];
  	$nadnevak=$_POST["nadnevak"];
}
elseif($_POST['Prijava_3']){
	//provjera podataka i upis u bazu
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
	$clan=$_POST["radio2"];
	$refAutori=$_POST["radio3"];
	$autor=$_POST["checkbox1"]; // autor rada
	$rad=$_POST["rad"]; // naziv referata ili izlaganja
	$koautor=$_POST["checkbox2"]; // oznak da li je koautro
	$idReferat=$_POST["refer"]; // id referata
	$radKo=$_POST["radKo"]; // naziv referata
	$predaje=$_POST["radio4"]; // da li osoba izlaže predavanje
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
	elseif(!empty($autor) && empty($rad)){
	 	$error="Niste upisali naziv priopèenja/referata kao autor.";
		$OK=false;		 
	 }
	 elseif(!empty($koautor) && empty($radKo) && $idReferat==0){
	 	$error="Niste upisali naziv priopèenja/referata kao koautor.";
		$OK=false;		 
	 }
	 $izbor=2;
	 if($OK){
		 // upis u bazu
		 $izbor=3;
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
			
			// original $idOsoba=odredi_osobu_ID_datum($data ->ime,$data ->prezime, $data ->datum);
			$idOsoba=odredi_osobu_ID($data ->ime,$data ->prezime);
			//echo $idOsoba." - ID osobe <br>";
		 if( $idOsoba==0){
			 //echo "upis osobe <br>";
		 	insert_osoba($data);
			// odredimo id nove osobe
			$idOsoba=odredi_osobu_ID($data ->ime,$data ->prezime);
			//echo $idOsoba." - ID osobe poslije <br>";
		 }
		 else{
			 // update osobe			 
			 update_OsobaClass($data);
		 }
		 // upis prijave i dokumenta ako je odabran
		 // provjera da li prijava postoji
		 $idPrijava=odredi_prijava_ID_skup($idSkup,$idOsoba);
		 //echo $idPrijava."id prijave  <br>";
		 if($idPrijava==0){
		 	insert_prijava($idSkup,$idOsoba,"D");
		 // upisujemo podatke o prijavi i autorima
		 //ako imamo prijavu referata
		 //echo "prije provjera autora <br>";
		 if($refAutori==1){
			 // provjera autora
			 //echo "unutar autora <br>";
			 $kapac=0;
			 $dat="";
			 $hidden=$_POST["attachement_loos"];
			 if(!empty($autor)){
				 // provjerimo da li postoji dokument koji se treba upload-ti
					$target = "Datoteke/"; 
					$nameFile = basename( $_FILES["file"]["name"]) ;
					$target = $target . basename( $_FILES["file"]["name"]) ; 
					$ok=1; 
					$target_path = "Datoteke/";
  					if ($_FILES["file"]["error"] > 0)
    				{
    					$error="Oznaka greške: " . $_FILES["file"]["error"] . "<br />";
    				}
  					else
    				{
						//echo $nameFile." naziv datoteke <br>";
						if($nameFile!=""){
    					if ( file_exists("Datoteke/" . $_FILES["file"]["name"]))
      					{
      						$error=$_FILES["file"]["name"] . " veæ postoji u bazi. ";
      					}
    					else
      					{
      						move_uploaded_file($_FILES["file"]["tmp_name"],
      						"Datoteke/" . $_FILES["file"]["name"]);
							$kapac=($_FILES["file"]["size"] / 1024); // u KB
							$dat=$nameFile;
							// upis u bazu sadržaja
      					}
					}
				 }
				 //echo "dodajemo referat <br>";
				 insert_referat($rad, $idSkup, $dat, $kapac);	// upis referata u bazu 
				 // odredi_referat_ID
				 $idRef=odredi_referat_ID($rad, $idSkup);
				 // upis autora u bazu
				 insert_referat_osoba($idRef,$idSkup,$idOsoba,1);
			 }
			 // provjera za koautora
			if(!empty($koautor)){
				//echo "imamo koautora <br>";
				 if($idReferat!=0){
					 //echo "koautor - id referat <br>";
					 // upis koautora
					 insert_referat_osoba($idReferat,$idSkup,$idOsoba,2);
				 }
				 else{ // upisujemo novi referat
				 	//echo "koautor upisan referat <br>";
				 	insert_referat($radKo, $idSkup, $dat, $kapac); // upis referata
					// odredi_referat_ID
				 	$idRef=odredi_referat_ID($radKo, $idSkup);
					// upis autora u bazu
				 	insert_referat_osoba($idRef,$idSkup,$idOsoba,2); // upis koautor
			}
			// provjera da li je korisnik i izlagal predavanje
			echo "Predaje= ".$predaje."<br>";
			if($predaje==1){
				insert_osoba_predaje($idSkup,$idOsoba);
				echo "ULAZ= ".$predaje."<br>";
			}
		}}// provjera da li postoji prijava 
	  } // OK
	}
	header("Location: skupovi_pregled.php?izbor=1&&idSkup=$idSkup"); 
	exit();
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
function provjera_2(val) { 
  if (val=="1"){
  	form1.checkbox1.disabled=false;
	form1.checkbox1.checked=false;
//	form1.rad.disabled=false;
//	form1.file.disable=false; // disabled="disabled"
	form1.checkbox2.disabled=false;
	form1.checkbox2.checked=false;
//	form1.refer.disabled=false;
//	form1.radKo.disabled=false;
	form1.radio4[0].disabled=false;
	form1.radio4[1].disabled=false;
  }
  else{
  	form1.checkbox1.disabled=true;
	form1.rad.disabled=true;
	//form1.file.disable=true;
	form1.checkbox2.disabled=true;
	form1.refer.disabled=true;
	form1.radKo.disabled=true;
	form1.radio4[0].disabled=true;
	form1.radio4[1].disabled=true;
  }
}
function check_1() { 
  if (form1.checkbox1.checked){
	form1.rad.disabled=false;
	//form1.file.disable=false; 
  }
  else{
	form1.rad.disabled=true;
//	form1.file.disable=true;
  }
}
function check_2() { 
  if (form1.checkbox2.checked){
	form1.refer.disabled=false;
	form1.radKo.disabled=false;
  }
  else{
	form1.refer.disabled=true;
	form1.radKo.disabled=true;
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
<script type="text/javascript" src="../css/wz_tooltip.js"></script>
<table width="875" border="0" align="center" class="okvir">
  <tr>
    <td width="205" align="center" valign="top" ><p><br>
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
      </table></td>
    <td width="8" align="center" valign="top"  class="linija_mid" >&nbsp;</td>
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
        <td height="12" colspan="2" class="meni" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp;<a href="skupovi_pregled.php?idSkup="<?php echo $idSkup ?>" class="meni">Prijave </a></td>
      </tr>
      <tr>
        <td height="3" colspan="2"><img src="../image/razmak.gif" width="2" height="3"></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top" class="btekst" height="14"><strong><?php echo $title ?></strong></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top" class="btekst"><strong><?php echo $naziv ?></strong></td>
      </tr>
      <tr>
        <td height="3" colspan="2"><img src="../image/razmak.gif" width="2" height="3"></td>
      </tr>
      <tr align="left" valign="top">
        <td height="3" colspan="2" class="meniLeft2"><?php echo $error ?></td>
      </tr>
      <tr>
        <td height="3" colspan="2"><img src="../image/razmak.gif" width="2" height="3"></td>
      </tr>
      <tr class="bg">
        <td height="3" colspan="2">
        <table width="100%"  border="0" cellspacing="2" cellpadding="1" >
        <form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>">
          <?php
		  switch($izbor){
			  case 1:
				include ($body."/prijava_1.php");
				break;
			  case 2:
				include ($body."/prijava_2.php");
				break;
			  case 3:
				include ($body."/prijava_1.php");
				break;
			  case 4:
				include ($body."/prijava_4.php");
				break;
			default:
				include ($body."/prijava_1.php");
		  }
		   ?>
         </form>
        </table>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
