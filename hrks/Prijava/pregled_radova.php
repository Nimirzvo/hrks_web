<?php
global $dataBox;
include("require/common.php");
include ("require/config.php");
$error="";
$OK=true;
$idSkup=$_GET['idSkup'];
if($_POST['Preuzimanje']){ // preuzimanje rada na lokalno raèunalo
	if(isset($_POST['box'])){
		foreach($_POST['box'] as $value){ 
   			// your file to upload  
			//echo "SKUP: $idSkup   ID: $value <br>";
   			$file_path = odredi_NazivRada_E($idSkup, $value); 
			//echo "Naziv datoteke: $file_path<br>";
			// odredimo ekstenziju
			$exten=findexts($file_path);
			//echo "Ekstenzija datoteke: $exten<br>";
			$datoteka=strtolower(substr(strrchr($file_path,"/"),1));
			//echo "Naziv datoteke: $datoteka<br>";
			$file_path2="../fiep2011/".$file_path;
			//echo "$file_path<br>";
			if ( file_exists($file_path2)&& $file_path!=""){
				output_file($file_path2, $datoteka, 'text/plain');
			}
			else{
				$error="Odabrani rad nije dostupan.";
			}
			break;
		}
	}
	else{
		$izbor=1;
		$error="Niste odabrali rad.";
	}
  }
session_start();
if($_SESSION['userId']<=0){
 header("Location: login.php");
 exit();
}
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
		header("Location: radovi.php?idSkup=$idSkup"); 
		exit();
}
elseif($_POST['Submit_4']){ // brisanje radova
	delete_id_check();
    if(isset($_POST['box'])){
		$izbor=2;
		foreach($_POST['box'] as $value){ 
			insert_id_check($value); //privremeni upis u bazu
		}
	}
	else{
		$izbor=1;
		$error="Niste odabrali rad.";
	}
}	
elseif($_POST['Submit_3']){ // prikaz dokumenta
	if(isset($_POST['box'])){
		foreach($_POST['box'] as $value){ 
   			// your file to upload  
			//echo "SKUP: $idSkup   ID: $value <br>";
   			$file_path = odredi_NazivRada_E($idSkup, $value); 
			//echo "Naziv datoteke: $file_path<br>";
			// odredimo ekstenziju
			$exten=findexts($file_path);
			//echo "Ekstenzija datoteke: $exten<br>";
			$datoteka=strtolower(substr(strrchr($file_path,"/"),1));
			//echo "Naziv datoteke: $datoteka<br>";
			$file_path2="../fiep2011/".$file_path;
		/*	echo "<SCRIPT LANGUAGE=\"javascript\"><!--n";
			echo " window.open(\"$file_path\");n";
			echo "// --></SCRIPT>n";
		*/	//echo "$file_path<br>";
		if ( file_exists($file_path2) && $file_path!=""){
			  header("Location: $file_path2"); 
			  exit();
		    }
			else{
				$error="Odabrani rad nije dostupan i ne može se prikazati.";
			}
			break;
		}//target="_blank"
	}
	else{
		$izbor=1;
		$error="Niste odabrali rad.";
	}
}
elseif($_POST['Submit_1']){
	$izbor=1;
}
elseif($_POST['Da_E']){
	$izbor=1;
	$rezultat=select_id_check(); // èitamo podatke koje trebamo brisati
	while ($row = mysql_fetch_array($rezultat)) {
		//echo $idSkup." - skup ".$row[0]." - id osobe<br>";
		delete_prijava_E($idSkup, $row[0]); // bisanje
	}
}
elseif($_POST['Ne']){
	$izbor=1;
}
elseif($_POST['Prijave']){
		header("Location: skupovi_pregled_E.php?idSkup=$idSkup"); 
		exit();
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
        <td height="12" colspan="2" class="meni" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp;<a href="skupovi.php" class="meniLeft2">Pregled skupova</a> :: Pregled radova</td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<strong>Meðunarodni skup</strong></td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<strong>Naziv skupa: <?php echo $nazivSkupa ?></strong></td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst"><?php echo $error ?></td>
      </tr>
      <tr >
        <td colspan="2" align="left" valign="top"><table width="100%"  border="0" cellpadding="1" cellspacing="1" bordercolor="#000000">
          <tr>
            <td align="left" valign="top"><form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>" class="bg">
              <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
                <tr align="left">
                  <td colspan="6"><input name="Prijave" type="submit" id="Povratak" class="tekst2"  value="   Povratak na prijave" onMouseOver="Tip('Povratak na pregled prijava odabranog skupa')" onMouseOut="UnTip()" ></td>
                  </tr>
                <tr align="left">
                  <td colspan="6">&nbsp;</td>
                  </tr>
                <tr align="left">
                  <td colspan="6"><input name="Submit_1" type="submit" class="tekst2" id="Submit_1" value="Pregled radova" onmouseover="Tip('Pregled svih radova odabranog skupa')" onmouseout="UnTip()" >
                    <input name="Submit_3" type="submit" class="tekst2" id="Submit_3" value=" Prikaz rada " onmouseover="Tip('Prikaz odabranog rada')" onmouseout="UnTip()" >
               <?php
			  	if($_SESSION['tipUser']==1){
					echo"
                    <input name=\"Submit_4\" type=\"submit\" class=\"tekst2\" id=\"Submit_4\" value=\" Brisanje radova\" onmouseover=\"Tip('Brisanje odabranih radova')\" onmouseout=\"UnTip()\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			    }
			  ?>
                    <input name="Preuzimanje" onmouseover="Tip('Snimanje rada na lokalno raèunalo.')" onmouseout="UnTip()" type="submit" class="tekst2" id="Preuzimanje" width="150px" value=" Preuzimanje rada " />                    
                    </td>
                  </tr>
                <tr align="left">
                  <td>&nbsp;</td>
                  </tr>
                <tr>
                  <td colspan="5" >
                    <div style="overflow:auto; height:300px;width:100%;">
                      <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
                        <?php
					switch($izbor){
						case 1:
							include ($body."/pregledReferata_E.php");
							break;
						case 2:
							include ($body."/brisanjeRadova_E.php");							
							break;
						default:
							include ($body."/pregledReferata_E.php");
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
