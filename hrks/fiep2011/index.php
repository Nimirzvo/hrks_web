<?php
session_start();
//phpinfo();
$error="";
$meniText="";
$OK=true;
$idDrzava=0;
include("../Prijava/require/common.php");
include ("../Prijava/require/config.php");
if(!session_is_registered("izbor")) {
	session_register("izbor");	
	$_SESSION['izbor']=0;
}
//importCSV_Drzava("../fiep/country.txt");
$idSkup=$_POST["idSkup"];
$izbor=$_GET['izbor'];
switch($izbor){
	case 1:
		$meniText=" / Welcome - Naslovnica";
		break;
	case 2:
		$meniText=" / News";
		break;
	case 3:
		$meniText=" / Genaral";
		break;
	case 4:
		$meniText=" / Organisation ";
		break;
	case 5:
		$meniText=" / Patronage  ";
		break;
	case 6:
		$meniText=" / Committees  ";
		break;
	case 7:
		$meniText=" / Invited Speakers  ";
		break;
	case 8:
		$meniText=" / Venue  ";
		break;
	case 9:
		$meniText=" / Topic And Sessions  ";
		break;
	case 10:
		$meniText=" / Preliminary Programme  ";
		break;
	case 11:
		$meniText=" / Registration And Paper Submission  ";
		break;
	case 12:
		$meniText=" / Congress Fees  ";
		break;
	case 13:
		$meniText=" / Call For Papers  ";
		break;
	case 14:
		$meniText=" / Accommodation  ";
		break;
	case 15:
		$meniText=" / Contacts And Information  ";
		break;
	case 16:
		$meniText=" / Registration - Prijava  ";
		break;
	case 18:
		$meniText=" / Arriving in Poreè";
		break;
	case 19:
		$meniText=" / Golf, tennis";
		break;
	case 20:
		$meniText=" / Panoramic boat trip";
		break;
	default:
		$meniText=" / Welcome - Naslovnica";
		break;
}
if($_POST['Prijava']){
	$izbor=16;
	$idPrijave=$_POST["idPrijave"];
	$ime=trim($_POST["ime"]);
  	$prezime=trim($_POST["prezime"]);
  	$grad=$_POST["grad"];
	$posta=$_POST["posta"];
	$ulica=$_POST["ulica"];
	$tel=$_POST["tel"];
	$fax=$_POST["fax"];
	$titula=$_POST["titula"];
	$email=$_POST["email"];
	$institucija=$_POST["institucija"];
	$papir=$_POST["papir"];
	$autor=$_POST["autor"];
	$autor2=$_POST["autor2"];
	$spol=$_POST["radio"];
	$transport=$_POST["checkbox1"];
	$check_T="";
	$trans="";
	if(!empty($transport)){
		$check_T="checked";
		$trans="D";
	}
		
	if($spol==1)
		$check_M="checked";
	elseif($spol==2)
		$check_Z="checked";
	$sudionik=$_POST["radio3"];
	$check_ref_1=="";$check_ref_2=="";$check_ref_3=="";$check_ref_4=="";

	switch($sudionik){
		case 1: 
			$check_ref_1="checked";
			break;
		case 2: 
			$check_ref_2="checked";
			break;
		case 3: 
			$check_ref_3="checked";
			break;
		case 4: 
			$check_ref_4="checked";
			break;
	}
	$idDrzava=$_POST["idDrzava"];
	$sekcija=0;
	$sekcija=$_POST["radio2"];
	$check_sec_1="";$check_sec_2="";
	if($sekcija==1)
		$check_sec_1="checked";
	elseif($sekcija==2)
		$check_sec_2="checked";
	else
		$sekcija=0;
	// odredimo datoteku
	$nameFile ="";
	$target = "Radovi/"; 
	$nameFile = basename( $_FILES["file"]["name"]) ;
	$target = $target . basename( $_FILES["file"]["name"]) ; 
	//echo "Izlaz<br>";
	// provjera ispravnosti
	if($spol==0){
	 	$error="Your sex mark is missing.<br>Niste odredili spol.";
		$OK=false;
	 }	
	 elseif(empty($ime)){
	 	$error="Your name is missing.<br>Niste upisali Vaše ime.";
		$OK=false;
	 }
	 elseif(empty($prezime)){
	 	$error="Your family name is missing.<br>Niste upisali Vaše prezime.";
		$OK=false;
	 }
	 elseif(empty($grad)){
	 	$error="Your city name is missing.<br>Niste upisali Grad / mjesto.";
		$OK=false;
	 }
	 elseif(empty($posta)){
	 	$error="Your postal code is missing.<br>Niste upisali poštu stanovanja.";
		$OK=false;
	 }
	 elseif(empty($ulica)){
	 	$error="Your street name is missing.<br>Niste upisali ulicu stanovanja.";
		$OK=false;
	 }
	elseif($idDrzava==0){
	 	$error="Niste odredili državu.";
		$OK=false;
	 }	
	 elseif(empty($tel)){
	 	$error="Your phone no. is missing.<br>Niste upisali broj telefona.";
		$OK=false;
	 }
	 elseif(empty($email)){
	 	$error="Your mail address is missing.<br>Niste upisali email adresu.";
		$OK=false;
	 }
	elseif(!is_email3($email)){
	 	$error="Incorrect form of e-mail address.<br> Nepravilno upisana E-mail adresa.";
		$OK=false;
	 }
	elseif($sudionik==0){
	 	$error="Type of of participation is missing.<br>Niste odredili naèin sudjelovanja.";
		$OK=false;
	 }
	elseif($sudionik>1){
		// dodatna provjera
		if(empty($papir)){
	 		$error="Paper title is missing.<br>Nedostaje naziv rada.";
			$OK=false;
	 	}
		elseif(empty($autor)){
	 		$error="Autor name is missing.<br>Nedostaje naziv autora.";
			$OK=false;
	 	}
		elseif(empty($autor2)){
	 		$error="Presenting author name is missing.<br>Nedostaje naziv prezentatora rada.";
			$OK=false;
	 	}
		elseif($sekcija==0){
	 		$error="Peper section is missing.<br>Niste odredili sekciju pripadnosti rada.";
			$OK=false;
	 	}
		elseif((empty($nameFile) && $sudionik==2) || (empty($nameFile) && $sudionik==4)){
	 		$error="Paper file is missing.<br>Niste odabrali datoteku rad.";
			$OK=false;
	 	}
		elseif(($_FILES["file"]["name"]=="" && $sudionik==2) || ($_FILES["file"]["name"]=="" && $sudionik==4)){
	 		$error="Paper file is missing.<br>Niste odabrali datoteku rad.";
			$OK=false;
	 	}
	 }
	 //elseif(("Radovi/" . $_FILES["file"]["name"]=="" && $sekcija==2) || ("Radovi/" . $_FILES["file"]["name"]=="" && $sekcija==4)){
	 // provjera da li postoji zapis
	// echo "Provjera prijave<br>";
	// echo "$OK   $idPrijave   $idSkup<br>";
	 if($OK && $idPrijave!=0){
 		//echo "Provjera prijave<br>";	
		$id=provjeri_prijavu_osobe_E($idPrijave, $idSkup,$prezime, $ime);
		if($id!=0){
			//echo "Prijava veæ postoji.<br>";
			$error="Person was submmit registration.<br>Osoba pod tim imenom i prezimenom veæ je prijavljena.";
			$OK=false;
		}
	 }
	if($OK){ // ako je sve ok - kopiramo datoteku i šaljemo mail
	// upis u bazu
		 $izbor=17;
		 	// upis osobe
			$nadnevak=date("d-m-Y");
		 	$data= new osobaClass_E;
		 	$data ->id=$idPrijave;
			$data ->idSkupa=8;
			$data ->datum=table2mysql($nadnevak);
			$data ->prezime=$prezime;
			$data ->ime=$ime;
			$data ->titula=$titula;
			$data ->ulica=$ulica;
			$data ->grad=$grad;
			$data ->posta=$posta;
			$data ->idDrzava=$idDrzava;
			$data ->tel=$tel;
			$data ->fax=$fax;
			$data ->email=$email;
			$data ->institucija=$institucija;
			$data ->spol=$spol;
			$data ->vrsta=$sudionik;
			$data ->naslovRada=$papir;
			$data ->autor=$autor;
			$data ->autor2=$autor2;
			$data ->sekcija=$sekcija;
			$data ->transport=$trans;
			if($sudionik<2)
				$target="";
			$data ->dokument=$target;
			insert_Prijava_E($data);
			// kopiramo datoteku
			if($sudionik==2 || $sudionik==4){
				// treba kopirati datoteku
				//echo "Ušli za kopiranje datoteke<br>";
				if ($_FILES["file"]["error"] > 0 && $nameFile!="")
    			{
    				$error="Oznaka greške: " . $_FILES["file"]["error"] . "<br />";
    			}
  				else
    			{
					//echo $nameFile." naziv datoteke <br>";
					if($nameFile!="" && "Radovi/" . $_FILES["file"]["name"]!="Radovi/"){
					//if(file_exists($_FILES["file"]["name"])){
						
    					if ( file_exists("Radovi/" . $_FILES["file"]["name"]))
      					{
							$error=$_FILES["file"]["name"] . " veæ postoji u bazi. ";
							//echo $error."<br>";
      					}
    					else
      					{
							//echo "Prebacivanje<br>";
      						move_uploaded_file($_FILES["file"]["tmp_name"],
      						"Radovi/" . $_FILES["file"]["name"]);
							$kapac=($_FILES["file"]["size"] / 1024); // u KB
							$dat=$nameFile;
							// upis u bazu sadržaja
      					}
					}
				}
			}
			
			// slanje mail poruke da je zaprimljena prijava
			//echo "Odredi mail adresu<br>";
			$primatelj=odredi_mailAdresu(2);  //  2 - znaèi da je tu mail za meðunarodne skupove
            //$primatelj="pulsar@hi.htnet.hr";
            // osoba koja šalje poruku
			$nazivSkupa=odredi_naziv_skupa($idSkup);
			//echo "naziv skupa: $nazivSkupa<br>";
            $subjekt="Prijava za skup: ".$nazivSkupa;
            // adresa pošiljatelja
            $zaglavlje="From:$mail";
            //slanje poruke ili javljanje pogreške
			$textNarudzbe="Izvršena je prijava.<br>";
			$textNarudzbe.="Prijavljena osoba: ".$prezime." ".$ime."<br>";
			$textNarudzbe.="Adresa: <br>";
			$nazivDrzave=odredi_naziv_drzave($idDrzava);
			$textNarudzbe.=$ulica.", ".$posta.", ".$grad.", ".$nazivDrzave."<br>";
			$textNarudzbe.="E-mail adresa: ".$email."<br>";
			$textNarudzbe.="Transport: ".$trans."<br>";
			if($sudionik>1){
				$textNarudzbe.="Rad poslan: DA<br>";
				$textNarudzbe.="Naziv rada: ".$papir."<br>";
				$textNarudzbe.="Autori: ".$autor."<br>";
				$textNarudzbe.="Izlaže: ".$autor2."<br>";
				if($sekcija==1)
					$textNarudzbe.="Sekcija: Tjelesna i zdrastvena kultura<br>";
				else
					$textNarudzbe.="Sekcija: Školski sport<br>";
			}
			else{
				$textNarudzbe.="Rad poslan: NE<br>";
			}
			//echo $primatelj."<br>";
			//echo $subjekt."<br>";
			//echo $textNarudzbe."<br>";
			// slanje 
			if($sudionik==2 || $sudionik==4){ // šaljemo samo ako ima rada - samo ako je AUTOR
				mail($primatelj, $subjekt, $textNarudzbe, "From: admin@hrks.hr \nContent-Type: text/html; charset=windows-1250"); 
			}
			// obavijest onome koji je ispinio prijavu
			$textNarudzbe2="Thank you, we received your application.<br>Hvala, zaprimili smo Vašu prijavu.<br>";
			mail($email, $subjekt, $textNarudzbe2, "From: info@hrks.hr \nContent-Type: text/html; charset=windows-1250"); 
	}
	
}
//<body onLoad="document.getElementById('siteLoader').style.display = 'none';">
function myfunc(){
	echo "TESTTEST<br>";
	 header("Location: index.php?izbor=16");
 	exit();
}
?>

<script language="JavaScript" type="text/JavaScript">
<!--
function provjera(val) { 
  if (val=="1"){
  	form1.papir.disabled=true;
  	form1.autor.disabled=true;
  	form1.autor2.disabled=true;
	form1.radio2[0].disabled=true;
	form1.radio2[1].disabled=true;
//	var fileInput = document.getElementById ("file");
//	fileInput.disabled=true;
	form1.file.disabled=true;
	form1.papir.value="";
	form1.autor.value="";
  	form1.autor2.value="";
	form1.file.value="";
  }
  else if (val=="3" || val=="5"){
  	form1.papir.disabled=false;
  	form1.autor.disabled=false;
  	form1.autor2.disabled=false;
	form1.radio2[0].disabled=false;
	form1.radio2[1].disabled=false;
	form1.file.disabled=true;
	form1.file.value="";
  }
  else{
  	form1.papir.disabled=false;
  	form1.autor.disabled=false;
  	form1.autor2.disabled=false;
	form1.radio2[0].disabled=false;
	form1.radio2[1].disabled=false;
	form1.file.disabled=false;	
  }
  //onkeydown="return false;"
}

//-->
</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<META http-equiv=Content-Type content="text/html; charset=windows-1250">
<META http-equiv=Pragma content=no-cache>
<LINK href="../css/stil.css" type=text/css rel=stylesheet>
<html>
<head>
<title>6th FIEP EUROPEAN CONGRESS</title>
</head>

<body>
<table width="875" border="0" align="center" class="okvir">
  <tr>
    <td width="200" align="center" valign="top"><p><br>
            <img src="../image/fiep2.gif" width="120" height="179"></p>
        <table width="100%"  border="0">
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
        </table>
        <table width="100%"  border="0">
          <tr>
            <td align="right" class="meni"><A href="index.php?izbor=1" target="_parent" class=crni_link_U>WELCOME / NASLOVNICA</A></td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right" class="meni"><A href="index.php?izbor=2" target="_parent" class=crni_link_U>NEWS</A></td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right"><span class="meniLeft"><a href="index.php?izbor=19">Golf, tennis (Golf, tenis)</a></span></td>
          </tr>
          <tr>
            <td align="right"><span class="meniLeft"><a href="index.php?izbor=20">Panoramic boat trip (Izlet)</a></span></td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right" class="meni">ABOUT THE CONGRESS</td>
          </tr>
          <tr>
            <td align="right"><span class="meniLeft"><a href="index.php?izbor=3">General</a></span><br>
              <span class="meniLeft"><a href="index.php?izbor=4">Organisation</a><br>
                <span class="meniLeft"><a href="index.php?izbor=5">Patronage</a></span><br><span class="meniLeft"><a href="index.php?izbor=6">Committees</a></span><br><span class="meniLeft"><a href="index.php?izbor=7">Invited Speakers</a></span>
            </td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right" class="meni"><A href="index.php?izbor=8" target="_parent" class=crni_link_U>VENUE</A></td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right" class="meni"><A href="index.php?izbor=18" target="_parent" class=crni_link_U>ARRIVING IN POREÈ</A></td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right" class="meni">PROGRAMME</td>
          </tr>
          <tr>
            <td align="right"><span class="meniLeft"><a href="index.php?izbor=9">Topic And Sessions</a></span><br>
              <span class="meniLeft"><a href="index.php?izbor=10">Preliminary Programme</a></span>
            </td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right" class="meni">REGISTRATION AND FEES</td>
          </tr>
          <tr>
            <td align="right"><span class="meniLeft"><a href="index.php?izbor=11">Registration And Paper Submission</a></span><br>
              <span class="meniLeft"><a href="index.php?izbor=12">Congress Fees</a></span>
            </td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right" class="meni"><A href="index.php?izbor=13" target="_parent" class=crni_link_U>CALL FOR PAPERS</A></td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right" class="meni"><A href="index.php?izbor=14" target="_parent" class=crni_link_U>ACCOMMODATION</A></td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td align="right" class="meni"><A href="index.php?izbor=15" target="_parent" class=crni_link_U>CONTACTS AND INFORMATION</A></td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
        </table>
        <p>&nbsp;</p></td>
    <td width="8" align="center" valign="top" background="../image/mid_crta.gif">&nbsp;</td>
    <td width="670" align="left" valign="top">
     <table width="100%"  border="0" class="bgTabela">
      <tr>
        <td width="68%" height="210" valign="top" class="sivi">&nbsp;</td>
        <td width="32%" height="210" align="right" valign="bottom">&nbsp;</td>
      </tr>
      <tr>
        <td height="1" colspan="2" class="linija"><img src="../image/linija_horiz.gif" width="3" height="1"></td>
      </tr>
      <tr align="left" valign="middle">
        <td height="12" colspan="2" class="meniLeft2" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp;<a href="index.php" class="meniLeft2">Home</a><?php echo($meniText)?></td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">
        <div style="overflow:auto; height:400px;width:100%;" class="bg">
        <table width="100%"  border="0" cellspacing="2" cellpadding="1" class="tekst">
        <form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>" class="tekst">
        <?php
			switch($izbor){
				case 1:
					include ($body."/pocetna.php");
					break;
				case 2:
					require($body."/news.php");
					break;
				case 3:
					require($body."/genaral.php");
					break;
				case 4:
					require($body."/organisation.php");
					break;
				case 5:
					require($body."/patronage.php");
					break;
				case 6:
					require($body."/committees.php");
					break;
				case 7:
					require($body."/invited.php");
					break;
				case 8:
					require($body."/venue.php");
					break;
				case 9:
					require($body."/topis.php");
					break;
				case 10:
					require($body."/program.php");
					break;
				case 11:
					require($body."/registracion.php");
					break;
				case 12:
					require($body."/fees.php");
					break;
				case 13:
					require($body."/call.php");
					break;
				case 14:
					require($body."/accomm.php");
					break;
				case 15:
					require($body."/contacts.php");
					break;
				case 16:
					$idPrijave=odredi_max_prijave()+1;
					$idSkup=8;  // oznaka za fiep
					require($body."/prijava.php");
					break;
				case 17:
					require($body."/potvrda_prijave.php");
					break;
				case 18:
					require($body."/arriving.php");
					break;
				case 19:
					require($body."/tennis.php");
					break;
				case 20:
					require($body."/izlet.php");
					break;
				default:
					include ($body."/pocetna.php");
					break;
			}
		?>
        </form>
        </table>
        </div>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
