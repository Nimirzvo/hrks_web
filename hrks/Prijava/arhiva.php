<?php
include("require/common.php");
global $dataBox;
$error="";
$idSkup=0; // oznaka id skupa koji æe se mijenjati
$OK=true;
$porukaBox="";
$imeDatoteke="";
$poruka="";
$izbor=$_GET['izbor'];
  if($_POST['Arhiva_5']){ // preuzimanje arhive na lokalno raèunalo
	if(isset($_POST['box'])){
		foreach($_POST['box'] as $value){ 
   			// your file to upload  
   			$fileN = "Arhiva/".$value;  
			$file_path = "Arhiva/".$value;  
			output_file($file_path, $value, 'text/plain');
			// set headers
/*			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Type: $mtype");
			header("Content-Disposition: attachment; filename=\"$value\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: " . $fsize);
			// download
			// @readfile($file_path);
			$file = @fopen($fileN,"rb");
			if ($file) {
			  while(!feof($file)) {
				print(fread($file, 1024*8));
				flush();
				if (connection_status()!=0) {
				  @fclose($file);
				  die();
				}
			  }
			  @fclose($file);
			}
			*/
			break;
		}
	}
	else{
		$izbor=1;
		$error="Niste odabrali arhivu.";
	}
  }

session_start();

include ("require/config.php");
  if($_POST['Arhiva_3']){  // uèitavanje podataka u bazu
     $izbor=1;
	 $imeDatoteke="Datoteka: ".odrediNazivTitule(-100);
	 $poruka= "Zapoèeo je prijenos podataka u bazu!!!";
	// uèitavanje arhive
	// uèitavanje arhive
	$value=odrediNazivTitule(-100);
	// izrada sigurnosne kopije baze
	textCSV("Arhiva_COPY.txt");
	// prenos podataka
	$OK=importCSV("Arhiva/".$value);
	if(strlen($OK)==0){
		//unlink("Arhiva/Arhiva_COPY.txt");  // brišemo kopiju podataka
		echo("<script>
			<!--
				location.replace(\"arhiva.php?izbor=4\");
			-->
			</script>");
		// header("Location: arhiva.php?izbor=4");
	}
	else{
		// vraæamo podatke u bazu
		echo("<script>
			<!--
				location.replace(\"arhiva.php?izbor=5\");
			-->
			</script>");
	}
	delete_TEMP();
	exit();
}

//include('require/dbimexport.php');
if($_SESSION['userId']<=0){
 header("Location: login.php");
 exit();
}
//phpinfo();
  if($_POST['Arhiva_1']){
	  // izrada arhive	 
	  $current_date = date("Y-m-d-h-i-s");

	$date = explode('-',$current_date);

	$year = $date[0];
	$month = $date[1];
	$day = $date[2];
	$hour = $date[3];
	$minute = $date[4];
	$second = $date[5]; 
	  $ccyymmdd = date("dmY");
	  $OK=textCSV("Arhiva_".$ccyymmdd."_".$hour."_".$minute.".txt");
	  if($OK)
	  	$porukaBox="Arhiva baze podataka je izraðena.";
	  else
		$porukaBox="Pogrješka prilikom kreiranja CSV datoteke!";
  }
  elseif($_POST['Arhiva_2']){
	  	$target = "Arhiva/"; 
		$nameFile = basename( $_FILES["file"]["name"]) ;
		$target = $target . basename( $_FILES["file"]["name"]) ; 
		$ok=1; 
		$target_path = "Arhiva/";
  		if ($_FILES["file"]["error"] > 0 && $nameFile!="")
    	{
    		$error="Oznaka greške: " . $_FILES["file"]["error"] . "<br />";
    	}
  		else
    	{
			//echo $nameFile." naziv datoteke <br>";
			if($nameFile!=""){
    			if ( file_exists("Arhiva/" . $_FILES["file"]["name"]))
      			{
      				$error=$_FILES["file"]["name"] . " veæ postoji u arhivi. ";
      			}
    			else
      			{
      				move_uploaded_file($_FILES["file"]["tmp_name"],
      					"Arhiva/" . $_FILES["file"]["name"]);
					$kapac=($_FILES["file"]["size"] / 1024); // u KB
					$dat=$nameFile;
					// upis u bazu sadržaja
      			}
			}
		}
  }
  elseif($_POST['Arhiva_4']){ // brisanje arhive
	if(isset($_POST['box'])){
		foreach($_POST['box'] as $value){ 
			unlink("Arhiva/".$value);
//			break;
		}
	$izbor=1;
	}
	else{
		$izbor=1;
		$error="Niste odabrali arhivu.";
	}
  }
  elseif($_POST['Arhiva_6']){ // brisanje arhive
		$izbor=1;
		$_SESSION['arhivaNaziv']="";
  }
  elseif($_POST['Arhiva_7']){ // pokretanje uèitavanja podataka
  	delete_TEMP();
	if(isset($_POST['box'])){
		foreach($_POST['box'] as $value){ 			
			insert_TEMP($value);
			if(!session_is_registered("arhivaNaziv")) {
					session_register("arhivaNaziv");	
					$_SESSION['arhivaNaziv']=$value;					
			}	
			break;
		}
		$izbor=2;
	}
	else{
		$izbor=1;
		$error="Niste odabrali arhivu.";
	}
  }


/*  elseif($_POST['Arhiva_5']){ // preuzimanje arhive na lokalno raèunalo
	if(isset($_POST['box'])){
		foreach($_POST['box'] as $value){ 
   			// your file to upload  
   			$fileN = "Arhiva/".$value;  
// set headers
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: $mtype");
header("Content-Disposition: attachment; filename=\"$asfname\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . $fsize);

// download
// @readfile($file_path);
$file = @fopen($fileN,"rb");
if ($file) {
  while(!feof($file)) {
    print(fread($file, 1024*8));
    flush();
    if (connection_status()!=0) {
      @fclose($file);
      die();
    }
  }
  @fclose($file);
}
			break;
		}
	}
	else{
		$izbor=1;
		$error="Niste odabrali arhivu.";
	}
  }
*/

?>

<script language="JavaScript" type="text/JavaScript">
<!--
var d;

function sendIt() {
 if (d) document.body.removeChild(d);
// var info=arguments[0].options[arguments[0].selectedIndex].text
 d = document.createElement("script");
 d.src = "body/pozadinska_skripta.php;"
 d.type = "text/javascript";
 document.body.appendChild(d);
}

function ucitavanje() { 
	alert("This field can not be empty");
}

//-->
</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<META http-equiv=Content-Type content="text/html; charset=windows-1250">
<META http-equiv=Pragma content=no-cache>
<LINK href="css/style.css" type=text/css rel=stylesheet>
<LINK href="../css/stil.css" type=text/css rel=stylesheet>
<html>
<head>
<title>Hrvatski kineziološki savez</title>
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
        <td height="12" colspan="2" class="meni" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp;<a href="skupovi.php" class="meniLeft2">Administracija</a> :: Arhiviranje podataka</td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<?php echo $error ?></td>
      </tr>
      <tr >
        <td colspan="2" align="left" valign="top"><table width="100%"  border="0" cellpadding="1" cellspacing="1" bordercolor="#000000">
          <tr>
            <td align="left" valign="top" class="bg">
            <form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>">
              <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
               <tr >
        		<td align="left" valign="top">
              <?php
			  //echo "IZBOR=".$izbor."<br>";
			  switch($izbor){
						case 1:
							include ($body."/noviArhiva.php");
							break;
						case 2:
							include ($body."/ucitavnjeBaze.php");
							break;
						case 3:
							include ($body."/ucitavnjeBazeFinish.php");
							break;
						case 4:
							$poruka="Uèitavanje podataka uspješno je završeno.";
							include ($body."/ucitavnjeBazeFinish_OK.php");
							break;							
						case 5:
							$poruka="Pojavila se pogrješka prilikom uèitavanja podataka u bazu!";
							include ($body."/ucitavnjeBazeFinish_OK.php");
							$OK=importCSV("Arhiva/Arhiva_COPY.txt");  // vraæanje starih podataka
							break;							
						default:
							include ($body."/noviArhiva.php");
							break;
					}
   					
				?>
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

<?php
/* staro
if($_POST['Arhiva_3']){  // uèitavanje podataka u bazu
	// uèitavanje arhive
    if(isset($_POST['box'])){
		foreach($_POST['box'] as $value){ 
			$OK=importCSV("Arhiva/".$value);
			if(strlen($OK)==0)
				$error="Podatci iz odabrane arhive uspješno su prenešeni u bazu.";
			else
				$error="Pogrješka prilikom prijenosa podataka u bazu!";
			break;
		}
	}
	else{
		$izbor=1;
		$error="Niste odabrali arhivu.";
	}
  }
*/
?>
