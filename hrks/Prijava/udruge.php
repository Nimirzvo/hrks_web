<?php
global $dataBox;
$error="";
$idUdruga=0; // oznaka id skupa koji æe se mijenjati
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
		delete_udruga($row[0]); // bisanje osoba s popisa
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
		$error="Niste odabrali udrugu.";
	}
}	
elseif($_POST['Submit_3']){ // editiramo podatke o osobi
	$izbor=3;
	$edit=1;
	if(isset($_POST['box'])){
   		foreach($_POST['box'] as $value){ 
			$izb=$value;
	   	 	$data=odredi_udrugu_id($value);
			while ($row = mysql_fetch_array($data)){
				$rezultat=$row;
				break;
			}
		}
	}
	$idUdruga=$rezultat[0]; // pamtimo za kasniju promijenu
  	$ime=$rezultat[1];
	$grad=$rezultat[2];
	$idZupanija=$rezultat[3];
}
elseif($_POST['Novi']){
	$idUdruga=$_POST["idUdruga"];
	$ime=trim($_POST["ime"]);
	$grad=$_POST["grad"];
	$idZupanija=$_POST["zupanija"];
	if(empty($ime)){
	 	$error="Niste upisali Vaše ime.";
		$OK=false;
	 }
	 elseif(empty($grad)){
	 	$error="Niste upisali naziv grada/mjesta.";
		$OK=false;
	 }
	 elseif($idZupanija==0){
	 	$error="Niste odredili županiju.";
		$OK=false;
	 }
	$izbor=2;
	if($OK){
		$izbor=1;
		// upis osobe
		$data= new udrugaClass;
		$data ->id=$idUdruga;
		$data ->ime=$ime;
		$data ->grad=$grad;
		$data ->idZupanija=$idZupanija;
		$postoji_Udruga=postojiUdruga($ime);
	    if( $postoji_Udruga==0){
			 //echo "upis udruge <br>";
		 	insert_udruga($data);
		}
		else{
			 // update osobe	
			  //echo "update udruge <br>";
			 update_udrugaClass($data);
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
        <td height="12" colspan="2" class="meni" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp;<a href="skupovi.php" class="meniLeft2">Administracija</a> :: Udruge kineziologa</td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<?php echo $error ?></td>
      </tr>
      <tr >
        <td colspan="2" align="left" valign="top"><table width="100%"  border="0" cellpadding="1" cellspacing="1" >
          <tr>
            <td align="left" valign="top" >
            <form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>">
              <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
                    <tr align="left">
                      <td colspan="5"><strong>Pregled udruga kineziologa</strong></td>
                    </tr>
                <tr>
                <td colspan="5" >
                <div style="overflow:auto; height:300px;width:100%;" class="bg">
                  <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">                
                <?php
					switch($izbor){
						case 1:
							include ($body."/pregledUdruga.php");
							break;
						case 2:
							require($body."/novaUdruga.php");
							break;
						case 3:
							include ($body."/novaUdruga.php");
							break;
						case 4:
							include ($body."/brisanjeUdruge.php");
							break;
						default:
							include ($body."/pregledUdruga.php");
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
