<?php
$error="";
session_start();
include("require/common.php");
include ("require/config.php");
	if(!session_is_registered("userId")) {
		session_register("userId");	
		$_SESSION['userId']=0;
	}
	if(!session_is_registered("tipUser")) { // 1-administrator, 2-koordinator skupa, 3-voditelj udruge
		session_register("tipUser");	
		$_SESSION['tipUser']=0;
	}
	if(!session_is_registered("login")) {
		session_register("login");	
		$_SESSION['login']="";
	}
	if(!session_is_registered("index")){
	   session_register("index");
	   $_SESSION['index'] = 0;
	}

if($_POST['Submit']){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$valid =authorization($username, $password);
	if($valid){
		$userId=$valid[id];
		$_SESSION['userId']=$userId;
		$_SESSION['tipUser']=$valid[tip];
		if(!session_is_registered("login"))
			session_register("login");
		$_SESSION['login']=$username;
		$login = $username;
		if($_SESSION['userId']!=0){
			@mysql_close();
			// Usmjeravamo na stranicu
			$error = 'OK!';
			if($_SESSION['tipUser']==3){
				header("Location: administracija_osoba.php");
				exit();
			}
			else{
			    header("Location: skupovi.php");
			    exit();
			}
		}
		else{
			$error = 'Nepravilna lozinka ili korisnièko ime!';
			@mysql_close();
		}
	} 
	else {
			$_SESSION['login']="";
			$error = 'Nepravilna lozinka ili korisnièko ime!';
			@mysql_close();
	}
}
else{
	$username="";
	$userId=0;
	$login=null;
	$_SESSION['login']="";
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
            <td align="right">&nbsp;</td>
          </tr>
          <tr>
            <td><img height=5 src="../image/left_menu_crta2.gif" width=190></td>
          </tr>
        </table>
        <p><img src="../image/meni_slika.gif" width="205" height="450"></p></td>
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
        <td colspan="2" align="center" valign="top""><p><br><br><br></p>
        <form action="<?php  echo "$PHP_SELF"; ?>" method="post" name="form1">
                <table width="500" border="0" class="bg">
                  <tr>
                    <td width="200" rowspan="8" align="center" valign="middle"><div align="left"><img src="../image/login.jpg" alt="" width="200" height="149"></div></td>
                    <td width="99">&nbsp;</td>
                    <td width="165">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="tekst">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="tekst">Korisnièko ime :</td>
                    <td align="left"><input name="username" type="text" class="tekst"></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top" ><span class="tekst">Lozinka:</span></td>
                    <td align="left" valign="top" ><input name="password" type="password" class="tekst"></td>
                  </tr>
                  <tr>
                    <td >&nbsp;</td>
                    <td align="left" valign="top"  class="tekst">&nbsp;</td>
                  </tr>
                  <tr>
                    <td >&nbsp;</td>
                    <td align="left" valign="top" ><input type="Submit" name="Submit" value="Prijava" class="tekst"></td>
                  </tr>
                  <tr>
                    <td >&nbsp;</td>
                    <td align="left" valign="top" class="tekst">&nbsp;</td>
                  </tr>
                  <tr>
                    <td >&nbsp;</td>
                    <td align="left" valign="top" class="tekst">&nbsp;</td>
                  </tr>
                </table>
            </form>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
