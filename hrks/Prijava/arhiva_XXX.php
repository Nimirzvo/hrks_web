<?php
global $dataBox;
$error="";
$idSkup=0; // oznaka id skupa koji će se mijenjati
$OK=true;
$porukaBox="";
session_start();
include("require/common.php");
include ("require/config.php");
if($_SESSION['userId']<=0){
 header("Location: login.php");
 exit();
}

  if($_POST['Arhiva_1']){
	  $izbor=1;
	$ccyymmdd = date("Ymd");
 	 $file = fopen("Arhiva/backup".$ccyymmdd.".sql","w");
  	$line_count = create_backup_sql($file);
  	fclose($file);
	$porukaBox="Arhiva baze podataka je izrađena.";
  }
  elseif($_POST['Arhiva_2']){
  	$izbor=2;
	$file = fopen("Arhiva/backup20070303.sql","w");
  	$line_count = load_backup_sql($file);
  	fclose($file);
  }
  elseif($_POST['Arhiva_3']){
	$izbor=3;
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
            <td align="left" valign="top" class="bg"><form name="form1" enctype="multipart/form-data" method="post" action="<?php  echo "$PHP_SELF"; ?>">
              <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
              <?php
					switch($izbor){
						case 1:
							include ($body."/noviArhiva.php");
							break;
						case 2:
							require($body."/noviArhiva.php");
							break;
						case 3:
							include ($body."/pregledArhiva.php");
							break;
						default:
							include ($body."/noviArhiva.php");
							break;
					}
					?>
                <tr>
                  <td>&nbsp;</td>
                  <td class="tekst">&nbsp;</td>
                </tr>
                <tr>
                  <td width="100px">&nbsp;
                  </td>
                  <td class="tekst"><input name="Arhiva_1" type="submit" class="tekst2" id="Submit_" width="150px" value="    Izrada arhive    " >                    
                    Izrada sigurnosne kopije baze podataka
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="error"><?php echo $porukaBox ?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="100px">&nbsp;
                  </td>
                  <td class="tekst"><input name="Arhiva_2" type="submit" class="tekst2" id="Submit_2" width="150px" value=" Učitavanje arhive " > 
                  Učitavanje izrađene arhive baze podataka
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="tekst">Odabir arhive:
                    <input name="file" onmouseover="Tip('Pritisnite kako biste odabrali arhivu.')" onmouseout="UnTip()" type="file" id="file" class="tekst" size="80" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="100px">&nbsp;
                  </td>
                  <td class="tekst"><input name="Arhiva_3" type="submit" class="tekst2" id="Submit_2" width="150px" value="   Pregled arhiva   " > 
                  Pregled izrađenih arhiva baze podataka
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="tekst">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="tekst">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="tekst">&nbsp;</td>
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
