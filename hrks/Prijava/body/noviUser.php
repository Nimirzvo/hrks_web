<?php

  // provjera da li je forma veè uèitana
  // provjera ispravnosti unesenih podataka
  $OK=false; // oznaka da je sve OK
  $error="";
  $var1="\"\""; // ime
  $var2="\"\""; // prezime
  $var3="\"\""; // adresa
  $var4="\"\""; // mail
  $var5="\"\""; // korisnièko ime
  $var6="\"\""; // lozinka_1
  $var7="\"\""; // lozinka_2
  $ime=$_POST["ime"];
  $prezime=$_POST["prezime"];
  $adresa=$_POST["adresa"];
  $userName2=$_POST["userName2"];
  $lozinka1=$_POST["lozinka1"];
  $lozinka2=$_POST["lozinka2"];
  $mail=$_POST["mail"];
  // include ("require/common.php");
  if (  $_POST["Submit2"] ){
     // provjera ispravnosti

	 if(empty($ime)){
	 	$error="Niste upisali Vaše ime.";
		$OK=false;
	 }
	 elseif(empty($prezime)){
	 	$error="Niste upisali Vaše prezime.";
		$OK=false;
	 }
	 elseif(empty($adresa)){
	 	$error="Niste upisali Vašu adresu.";
		$OK=false;
	 }
	 elseif(empty($mail)){
	 	$error="Niste upisali Vašu E-mail adresu.";
		$OK=false;
	 }
	 elseif(!is_email3($mail)){
	 	$error="Neispravno upisana E-mail adresa.";
		$OK=false;
	 }
	 elseif(empty($userName2)){
	 	$error="Niste upisali naziv korisnika.";
		$OK=false;
	 }
	 elseif(empty($lozinka1)){
	 	$error="Niste upisali lozinku.";
		$OK=false;
	 }
	 elseif(empty($lozinka2)){
	 	$error="Niste upisali lozinku.";
		$OK=false;
	 }
	 elseif($lozinka1!= $lozinka2){
	 	$error="Neispravno upisana lozinka.";
		$OK=false;
	 }
	 else{
	 	$OK=true;
	 }

	if( !empty($ime))
		$var1=$ime;
	if( !empty($prezime))
		$var2=$prezime;
	if( !empty($adresa))
		$var3=$adresa;
	if( !empty($mail))
		$var4=$mail;
	if( !empty($userName2))
		$var5=$userName2;
	if( !empty($lozinka1))
		$var6=$lozinka1;
	if( !empty($lozinka2))
		$var7=$lozinka2;
   }
?>
<html>
<head>

<META http-equiv=Content-Type content="text/html; charset=windows-1250">
<LINK href="image/stil.css" type=text/css rel=stylesheet>
</head>

<body>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=left border=0 >
  <TBODY>
    <TR>
      <TD width="201" align="left" ><img src="images/kljuc.gif" width="200" height="202"></TD> 
      <TD align="left" >
        <table width="100%" border="0">
          <tr>
            <td  class=tekst>
<?php
print("<p class=\"error\">$error</p>");
$form="
    <form action=\"prijava.php\" method=\"post\" name=\"form1\" class=\"tekst\">
     <input type=\"hidden\" name=\"formaPrikazana\" value=\"d\">
	<table width=\"100%\"  border=\"0\" class=\"tekst\">
    <tr>
      <td colspan=\"2\">
		<strong>REGISTRACIJA KORISNIKA</strong>
	</td>
    </tr>
    <tr>
      <td><div align=\"right\"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width=\"50%\"><div align=\"right\">Ime korisnika : </div></td>
      <td width=\"50%\"><input name=\"ime\" type=\"text\" value=$var1 class=\"tekst\" size=\"20\" maxlength=\"20\"></td>
    </tr>
    <tr>
      <td><div align=\"right\">Prezime korisnika :</div></td>
      <td><input name=\"prezime\" type=\"text\" value=$var2 class=\"tekst\" size=\"35\" maxlength=\"20\"></td>
    </tr>
    <tr>
      <td><div align=\"right\">Adresa : </div></td>
      <td><input name=\"adresa\" type=\"text\" value=$var3 class=\"tekst\" size=\"40\"></td>
    </tr>
    <tr>
      <td><div align=\"right\">E-pošta :</div></td>
      <td><input name=\"mail\" type=\"text\" value=$var4 class=\"tekst\" size=\"45\"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align=\"left\"><strong>Podaci za pristup multimedijskim sadržajima</strong></div></td>
    </tr>
    <tr>
      <td><div align=\"right\">Korisnièko ime : </div></td>
      <td><input name=\"userName2\" type=\"text\" value=$var5 class=\"tekst\" size=\"20\" maxlength=\"10\"></td>
    </tr>
    <tr>
      <td><div align=\"right\">Lozinka :</div></td>
      <td><input name=\"lozinka1\" type=\"password\" value=$var6 class=\"tekst\" size=\"12\" maxlength=\"10\"></td>
    </tr>
    <tr>
      <td><div align=\"right\">Ponovi lozinku :</div></td>
      <td><input name=\"lozinka2\" type=\"password\" value=$var7 class=\"tekst\" size=\"12\" maxlength=\"10\"></td>
    </tr>
    <tr>
      <td valign=\"top\">&nbsp;</td>
      <td>
		<input name=\"Submit2\" type=\"submit\" class=\"tekst\" value=\"Potvrdi\">
        <input name=\"Reset\" type=\"reset\" class=\"tekst\" value=\"Obriši\">	  
	  </td>
    </tr>

  </table>
  </form>";
		// provjera da li smo prvi puta vidjeli formu
        if(!$OK){
            print("$form");
        }
        else{
			// upis u bazu i stranica za prijavu
			$userClass = new userClass;
			$userClass ->idUser=0;
		    $userClass ->ime=$var1; 
			$userClass ->prezime=$var2; 
			$userClass ->adresa=$var3; 
			$userClass ->email=$var4; 
			$userClass ->login=$var5; 
			$userClass ->password=$var6; 
			$userClass ->lastLog=getdate();	
			$userClass ->tip=3;	
			insert_user($userClass);
	  echo "<h2>Hvala.</h2> Vaša registracija je obavljene. Razmjeni multimedijskih sadržaja možete pristupiti <a href=\"login.php\" target=\"_parent\" class=\"style6\"> ovdje </a>";
	  exit();

        }
  
?>
        
			</td>
          </tr>
        </table>
        </TD>
    </TR>
    <TR>
      <TD width="201">&nbsp;</TD> 
      <TD width="282">&nbsp;</TD>
      <TD align=right width="127">&nbsp; </TD>
    </TR>
    <TR> </TR>
  </TBODY>
</TABLE>
</body>
</html>
