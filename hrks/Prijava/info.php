<?php
$error="";
session_start();
include("require/common.php");
include ("require/config.php");
if($_SESSION['userId']<=0){
 header("Location: login.php");
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
</head>

<body>
<table width="875" border="0" align="center" class="okvir">
  <tr>
    <td width="205" align="center" valign="top"><p><br>
            <img src="../image/logoTZK4.gif" width="113" height="170"></p>
        <table width="100%"  border="0">
          <tr>
            <td align="right"><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
          <tr>
            <td><table width="100%"  border="0">

              <tr>
                <td><img src="image/left_menu_crta2.gif" alt="" width=190 height=5></td>
              </tr>
              <tr>
                <td align="right" class="meni"><A href="administracija.php" target="_parent" class=crni_link_U>ADMINISTRACIJA</A></td>
              </tr>
              <tr>
                <td><img src="image/left_menu_crta2.gif" alt="" width=190 height=5></td>
              </tr>
              <tr>
                <td align="right" class="meni">SKUPOVI</td>
              </tr>
              <tr>
                <td align="right"><span class="meniLeft"><a href="skupovi.php">Preged podataka o skupovima</a></span><br>
                  <span class="meniLeft"><a href="prijave.php">Pregled prijava</a></span><br>
                  <span class="meniLeft"><a href="osobe.php">Pregled osoba</a></span><br>
                  <span class="meniLeft"><a href="info.php">Obavještavanje osoba</a></span><br>
                  <span class="meniLeft"><a href="financije.php">Financijska analiza</a></span><br>
                  </td>
              </tr>
              <tr>
                <td><img src="image/left_menu_crta2.gif" alt="" width=190 height=5></td>
              </tr>
              <tr>
                <td align="right" class="meni"><A href="udruge.php" target="_parent" class=crni_link_U>Športske udruge</A></td>
              </tr>
              <tr>
                <td><img src="image/left_menu_crta2.gif" alt="" width=190 height=5></td>
              </tr>
              <tr>
                <td align="right" class="meni"><A href="korisnici.php" target="_parent" class=crni_link_U>Administracija korisnika</A></td>
              </tr>
              <tr>
                <td><img src="image/left_menu_crta2.gif" alt="" width=190 height=5></td>
              </tr>
              <tr>
                <td align="right"><A href="login.php" target="_parent" class=meniLeft>Odjava</A></td>
              </tr>
            </table>
              <p>&nbsp;</p>
            <p><img height=5 src="../image/left_menu_crta2.gif" width=190></p></td>
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
        <td height="12" colspan="2" class="meni" >&nbsp;<img src="../image/kucica.gif" width="15" height="10" border="0">&nbsp;<a href="../index.htm" class="meniLeft2">Naslovnica </a></td>
      </tr>
      <tr>
        <td height="3" colspan="2"><img src="../image/razmak.gif" width="2" height="3"></td>
      </tr>
      <tr>
        <td height="3" colspan="2" class="tekst">&nbsp;<?php echo $error ?></td>
      </tr>
      <tr >
        <td colspan="2" align="center" valign="top">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
