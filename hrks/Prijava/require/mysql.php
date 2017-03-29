<? $TimeHtml=time(); 
/* Vindozo MYSQL-Copy. 
 ver.1.0 FREE / 04.02.2008  (upon vindozo.com)
 Please, do not public this script in Internet!!!
*/

if(empty($_POST)) {?>
<html>
<head>
  <title>VINDOZO: MYSQL-COPY</title>

<script language='JavaScript'>
function clickfrom(){
var f = document.forms['cform'];
document.getElementById('sqlfrom').style.display=(f.rfrom1.checked?'':'none');
document.getElementById('httpfrom').style.display=(f.rfrom2.checked?'':'none');
document.getElementById('filefrom').style.display=(f.rfrom3.checked?'':'none');
if(!f.rfrom1.checked){
f.rto1.checked=true;
document.getElementById('sqlto').style.display=''
document.getElementById('httpto').style.display='none';
document.getElementById('fileto').style.display='none';
} 
}

function clickto(){
var f = document.forms['cform'];
document.getElementById('sqlto').style.display=(f.rto1.checked?'':'none');
document.getElementById('httpto').style.display=(f.rto2.checked?'':'none');
document.getElementById('fileto').style.display=(f.rto3.checked?'':'none');
if(!f.rto1.checked){
f.rfrom1.checked=true;
document.getElementById('sqlfrom').style.display=''
document.getElementById('httpfrom').style.display='none';
document.getElementById('filefrom').style.display='none';
} 
}

function procform()
{  return true;
}


function isfont(font){
f1=document.createElement("DIV");
f2=document.createElement("SPAN");
f1.appendChild(f2);
f1.style.visibility='hidden';
f1.style.fontFamily = "sans-serif"; f2.style.fontFamily = "sans-serif";
f2.style.fontSize = "72px"; f2.innerHTML = "mmmmmmmmmml";
document.body.appendChild(f1);
 var defaultWidth = f2.offsetWidth; var defaultHeight = f2.offsetHeight;
document.body.removeChild(f1);
document.body.appendChild(f1);
 var f = []; f[0] = f2.style.fontFamily = font; f[1] = f2.offsetWidth; f[2] = f2.offsetHeight;
document.body.removeChild(f1);
font = font.toLowerCase();
if (font == "arial" || font == "sans-serif") {
 f[3] = true;
} else {f[3] = (f[1] != defaultWidth || f[2] != defaultHeight);}
return f; 
}
webdings=false;

function webdingsico(a,b){
if(webdings) {document.write(a)} else {document.write(b)}
}

</script>
<style>
.table1{background-color:#6E7100;color:#FFFFFF;border-bottom:1px solid #474A03}
.table2{background-color:#DAEAF7;color:#000000;border-top:1px solid #9DA77B;border-bottom:1px solid #FFF4C2}
.table3{background-color:#F1B942;color:#000000;border-top:1px solid #E0BE76;border-bottom:1px solid #FFD165;padding:10px}
.table4{background-color:#A3271B;color:#F0A56E;border-top:2px solid #7D0D00}
.table5{background-color:#F6D271;color:#000000;border:3px solid #FFD66D;padding:10px;font-size:13px;}
.table5x{background-color:#FFD66D;color:#444444;padding:5px;font-size:13px;}

.table6{border-right:3px solid #38607B;font-size:13px;}
.table6x{border-right:3px solid #58809B;border-top:1px solid #58809B;font-size:13px;}
.table7{border-left:3px solid #38607B;font-size:13px;}
.table7x{border-left:3px solid #58809B;border-top:1px solid #58809B;font-size:13px;}
#table6 td, #table7 td{padding-left:10px;padding-right:10px;}

.table8{font-family:"Trebuchet MS", "Franklin Gothic Book", Arial;font-size:13px;}

.logo{color:#FFFFFF;border:0px solid #FFF}
.logoico{color:#EABA28;font-family:Webdings;font-size:80px;}
.ico1{color:#A3271B;font-family:Webdings;font-size:30px;}
.ico2{color:#38607B;font-family:Webdings;font-size:30px;}
.ico3, .ico4{color:#A3271B;font-family:Webdings;font-size:15px;}

.logotitle1{color:#FFFFFF;font-family:"Felix Titling", Georgia, Times;font-size:30px;}

a, .logotitle2{color:#EABA28;font-family:"Trebuchet MS", "Franklin Gothic Book", Arial;font-size:13px;}
body{background-color:#FFFFFF;color:#000000;font-family:"Trebuchet MS", "Franklin Gothic Book", Arial;font-size:13px;}
a:hover, a:active, a:focus {color: #FACA38;}

a.download {color: #222;font-family:"Trebuchet MS", "Franklin Gothic Book", Arial;font-size:13px;}
a.download:hover {color: #444;}

.input1{background-color:#EEEEFF;border:1px solid #38607B;}
.input2{background-color:#FFFFFF;border:1px solid #18304B;}

button{font-family:"Trebuchet MS", "Franklin Gothic Book", Arial;font-size:13px;}

</style>
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" id="scrn" name="scrn">
<script> webdings=isfont('Webdings')[3]; </script>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"><tr><td height="50" class="table1" align="center">
<table width="600"  height="100" class="logo">
<tr><td width="150" class="logoico"><script>webdingsico("&#0251;","&#9632;")</script></td>
<td align="left" width="450"><span class="logotitle1">VINDOZO: MYSQL-COPY</span><br /><span class="logotitle2">connecting servers</span></td></tr></table>

</td></tr><tr><td height="100%" class="table2">
<br />
<form name="cform" action="mysql.php" method="post" enctype="multipart/form-data">
<table width="635" align=center><tr><td align=left>
<table width="300" align=center class="table6" id="table6">
  <tr><td colspan=2><span class="ico2"><script>webdingsico("&#0211;","&#9632;")</script></span> <b>Get tables FROM:</b></td></tr>
  <tr><td colspan=2>
  <input type="radio" id="rfrom1" name="rfrom" value="1" onclick="clickfrom()" checked /> <label for="rfrom1" onclick="clearTimeout();setTimeout('clickfrom()',100)">use MYSQL-Server (size nolimit)</label><br />
  <input type="radio" id="rfrom2" name="rfrom" value="2" onclick="clickfrom()" /> <label for="rfrom2" onclick="clearTimeout();setTimeout('clickfrom()',100)">use HTTP-Path file (*.sql, size 0..2Gb)</label><br />
  <input type="radio" id="rfrom3" name="rfrom" value="3" onclick="clickfrom()" /> <label for="rfrom3" onclick="clearTimeout();setTimeout('clickfrom()',100)">use Upload file (*.sql, size 0..<?=ini_get('upload_max_filesize');?>b)</label><br />
  </td></tr>
  <tr><td colspan=2>
<table width="300" align=center class="table6x" id="sqlfrom">
  <tr><td width=20%><nobr>Host MYSQL-Server:</nobr></td><td width=80%><input name="host_from" type="text" value="localhost" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
  <tr><td width=20%><nobr>Port (optional):</nobr></td><td width=80%><input name="port_from" type="text" value="3306" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
  <tr><td width=20%>Login:</td><td width=80%><input name="user_from" type="text" value="" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
  <tr><td width=20%>Password:</td><td width=80%><input name="pass_from" type="text" value="" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
  <tr><td width=20%>Database:</td><td width=80%><input type="text" name="db_from" value="" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
  </td></tr>
</table>
<table width="300" align=center class="table6x" id="httpfrom">
  <tr><td width=20%><nobr>HTTP-Path:</nobr></td><td width=80%><input name="http_from" type="text" value="http://" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
</table>
<table width="300" align=center class="table6x" id="filefrom">
  <tr><td width=20%><nobr>Local file:</nobr></td><td width=80%><input name="file_from" type="file" value="" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
</table>
  </td></tr>
</table>
</td><td align=center><span class="ico2"><script>webdingsico("&#056;","&#0187;")</script></span>
</td><td align=right>
<table width="300" align=center class="table7" id="table7">
  <tr><td colspan=2><span class="ico2"><script>webdingsico("&#0210;","&#9632;")</script></span> <b>And copy TO:<b></td></tr>
  <tr><td colspan=2>
  <input type="radio" id="rto1" name="rto" value="1" onclick="clickto()" checked /> <label for="rto1" onclick="clearTimeout();setTimeout('clickto()',100)">use MYSQL-Server (size nolimit)</label><br />
  <input type="radio" id="rto2" name="rto" value="2" onclick="clickto()" /> <label for="rto2" onclick="clearTimeout();setTimeout('clickto()',100)">use One report file (*.sql, size 0..2Gb)</label><br />
  <input type="radio" id="rto3" name="rto" value="3" onclick="clickto()" /> <label for="rto3" onclick="clearTimeout();setTimeout('clickto()',100)">use File-parts (*.sql, size 0..<?=ini_get('upload_max_filesize');?>b)</label><br />
  </td></tr>
  <tr><td colspan=2>
<table width="300" align=center class="table7x" id="sqlto">
  <tr><td width=20%><nobr>Host MYSQL-Server:</nobr></td><td width=80%><input name="host_to" type="text" value="localhost" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
  <tr><td width=20%><nobr>Port (optional):</nobr></td><td width=80%><input name="port_to" type="text" value="3306" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
  <tr><td width=20%>Login:</td><td width=80%><input name="user_to" type="text" value="" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
  <tr><td width=20%>Password:</td><td width=80%><input name="pass_to" type="text" value="" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
  <tr><td width=20%>Database:</td><td width=80%><input type="text" name="db_to" value="" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
</table>
<table width="300" align=center class="table7x" id="httpto">
  <tr><td>The file is created in a directory of this script<br/>(<? $p=parse_url($HTTP_SERVER_VARS["SCRIPT_NAME"]); $p=substr($p[path],0,strrpos($p[path],'/')); echo "http://" . $_SERVER['HTTP_HOST'] .$p ; ?>)</td></tr>
</table>
<table width="300" align=center class="table7x" id="fileto">
  <tr><td colspan="2">Files is created in a directory of this script<br/>(<? $p=parse_url($HTTP_SERVER_VARS["SCRIPT_NAME"]); $p=substr($p[path],0,strrpos($p[path],'/')); echo "http://" . $_SERVER['HTTP_HOST'] .$p ; ?>)</td></tr>
  <tr><td width=20%><nobr>File size (Kb):</nobr></td><td width=80%><input name="file_to" type="text" value="1024" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"'></td></tr>
</table>
  </td></tr>
  <tr><td width=20%>Charset:</td><td width=80%><select name="charset_from" style="width:100%" class="input1" onmouseover='this.className="input2"' onmouseout='this.className="input1"' size="1">
    <option value='utf8' selected>utf8 (UTF-8 Unicode)</option>
    <option value='ujis'>ujis (EUC-JP Japanese)</option>
    <option value='ucs2'>ucs2 (UCS-2 Unicode)</option>
    <option value='tis620'>tis620 (TIS620 Thai)</option>
    <option value='swe7'>swe7 (7bit Swedish)</option>
    <option value='sjis'>sjis (Shift-JIS Japanese)</option>
    <option value='macroman'>macroman (Mac West European)</option>
    <option value='macce'>macce (Mac Central European)</option>
    <option value='latin7'>latin7 (ISO 8859-13 Baltic)</option>
    <option value='latin5'>latin5 (ISO 8859-9 Turkish)</option>
    <option value='latin2'>latin2 (ISO 8859-2 Central European)</option>
    <option value='latin1'>latin1 (cp1252 West European)</option>
    <option value='koi8u'>koi8u (KOI8-U Ukrainian)</option>
    <option value='koi8r'>koi8r (KOI8-R Relcom Russian)</option>
    <option value='keybcs2'>keybcs2 (DOS Kamenicky Czech-Slovak)</option>
    <option value='hp8'>hp8 (HP West European)</option>
    <option value='hebrew'>hebrew (ISO 8859-8 Hebrew)</option>
    <option value='greek'>greek (ISO 8859-7 Greek)</option>
    <option value='geostd8'>geostd8 (GEOSTD8 Georgian)</option>
    <option value='gbk'>gbk (GBK Simplified Chinese)</option>
    <option value='gb2312'>gb2312 (GB2312 Simplified Chinese)</option>
    <option value='euckr'>euckr (EUC-KR Korean)</option>
    <option value='eucjpms'>eucjpms (UJIS for Windows Japanese)</option>
    <option value='dec8'>dec8 (DEC West European)</option>
    <option value='cp932'>cp932 (SJIS for Windows Japanese)</option>
    <option value='cp866'>cp866 (DOS Russian)</option>
    <option value='cp852'>cp852 (DOS Central European)</option>
    <option value='cp850'>cp850 (DOS West European)</option>
    <option value='cp1257'>cp1257 (Windows Baltic)</option>
    <option value='cp1256'>cp1256 (Windows Arabic)</option>
    <option value='cp1251'>cp1251 (Windows Cyrillic)</option>
    <option value='cp1250'>cp1250 (Windows Central European)</option>
    <option value='binary'>binary (Binary pseudo charset)</option>
    <option value='big5'>big5 (Big5 Traditional Chinese)</option>
    <option value='ascii'>ascii (US ASCII)</option>
    <option value='armscii8'>armscii8 (ARMSCII-8 Armenian)</option>
  </td></tr>
</table>
<script>clickfrom();clickto();</script>
</td></tr>
</table>
<br />
<center><button onclick="if(procform())document.forms['cform'].submit();" ><span class="ico3"><script>webdingsico("&#056;","&#0187;")</script></span> TRANSFER</button>
<br /><br />

</td></tr><tr><td height="100" class="table3" align="center">

<table width=700><tr><td>

<table width="450" height="100%" align="center" class="table5">
<tr><td width="5%" valign="top" class="ico1" ><script>webdingsico("&#0235;","&#9632;")</script></td>
<td>
Copy all tables in/out MYSQL Database. A directory start of this script 777 CMOD, for creating tmp files.
Adjust file/post upload limits -
using apache .htaccess file:<br/>
<div class="table5x">
php_value upload_max_filesize 100M<br/>
php_value post_max_size 101M<br/>
php_value memory_limit 128M<br/>
</div>
Right upload(<?=ini_get('upload_max_filesize')?>)&lt;post(<?=ini_get('post_max_size')?>)&lt;memory(<? echo(ini_get('memory_limit')==''?'max':ini_get('memory_limit'));?>).
The maximal size of a file on a disk depends on operational system. It is possible to expect on 2Gb.
</td></tr></table>

</td><td>


<table width="250" height="100%" align=center class="table8">
<tr><td width=5% valign="top"><b>Future:</b></td>
<td><span class="ico4"><script>webdingsico("&#097;","&#0149;")</script></span> Advanced Charset
<br/><span class="ico4"><script>webdingsico("&#097;","&#0149;")</script></span> Module EMAIL-Copy
<br/><br/><span class="ico4"><script>webdingsico("&#205;","&#9632;")</script></span> Download <b><a href="mysql.zip" class="download">mysql.zip</a></b>
</td></tr>
</table>

</td></tr></table>

</td></tr><tr><td height="30" class="table4 logotitle2" align="center">
&copy; All rights are reserved | <a href="http://vindozo.com" >vindozo.com</a> | ver.1.0 FREE / 04.02.2008
</form>
</td></tr></table>
</body>

</html>
<? }else{
  set_time_limit(3000);
  $err_msg=''; $out_message=''; $fpsize=0; $ffrom='';
  $tmp=0; $ctable=0;
  foreach ($_POST as $check) {
	if ($check!=htmlspecialchars($check)) {exit("Protection: POST attack is revealed!");
 	} else {$tmp+=crc32($check);};
  };
  $freport=fopen("rep".$tmp.".htm","w");
  $rfrom=$_POST['rfrom'];  $rto=$_POST['rto']; $ra=$rfrom.$rto;
  if(!$freport){exit("A directory start of this script 777 CMOD, for creating tmp files!");}
  if(($rto=='2')) {$fout=fopen("db".$tmp.".sql","w");};
  if(($rto=='3')) {$fpart=1;$fout=fopen("db".$fpart.$tmp.".sql","w");};

  echoout("<html><head><title>VINDOZO: MYSQL-COPY</title></head><body style='font-family:Arial;font-size:13px;'>");

  if($ra=='11'){
   $ip_from = @gethostbyname($host_from);
   if($ip_from == $host_from) exit("Server <b>$host_from</b> NOT found.");
   echoout("Connect <b>$host_from</b> ($ip_from)..."); 
   $dbfrom=db_connect($_POST['host_from'],$_POST['port_from'],$_POST['user_from'],$_POST['pass_from'],$_POST['db_from'],$_POST['charset_from']);
   if ($err_msg!=''){echoout("<br/>".$err_msg."<br/>"); exit();} else echoout("ok<br/>");
   echoout("Login <b>".$_POST['user_from'].":".$_POST['pass_from']."</b> ok.<br/> Database <b>".$_POST['db_from']."</b> open.<br/>");
   echoout("<br/>");
   $ip_to = @gethostbyname($host_to);
   if($ip_to == $host_to) exit("Server <b>$host_to</b> NOT found.");
   echoout("Connect to <b>$host_to</b> ($ip_to)..."); 
   $dbto=db_connect($_POST['host_to'],$_POST['port_to'],$_POST['user_to'],$_POST['pass_to'],$_POST['db_to'],$_POST['charset_from']);
   if ($err_msg!=''){echoout("<br/>".$err_msg."<br/>"); exit();} else echoout("ok<br/>");
   echoout("Login <b>".$_POST['user_to'].":".$_POST['pass_to']."</b> ok.<br/> Database <b>".$_POST['db_to']."</b> open.<br/>");
   $sth=mysql_query("/*!40030 SET max_allowed_packet=838860 */;",$dbto);
   $sth=mysql_query("show tables from ".$_POST['db_from'],$dbfrom);
   while($row=mysql_fetch_row($sth)){ do_mysql_table($row[0],$dbfrom,$dbto); };
  };


  if(($ra=='12')||($ra=='13')){
   $ip_from = @gethostbyname($host_from);
   if($ip_from == $host_from) exit("Server <b>$host_from</b> NOT found.");
   echoout("Connect <b>$host_from</b> ($ip_from)..."); 
   $dbfrom=db_connect($_POST['host_from'],$_POST['port_from'],$_POST['user_from'],$_POST['pass_from'],$_POST['db_from'],$_POST['charset_from']);
   if ($err_msg!=''){echoout("<br/>".$err_msg."<br/>"); exit();} else echoout("ok<br/>");
   echoout("Login <b>".$_POST['user_from'].":".$_POST['pass_from']."</b> ok.<br/> Database <b>".$_POST['db_from']."</b> open.<br/>");
   echoout("<br/>","-- VINDOZO:MYSQL-COPY \r\n-- Dump create datetime: ".date('Y-m-d H:i:s')."\r\n/*!40030 SET max_allowed_packet=838860 */;\r\n\r\n\r\n");
   $sth=mysql_query("show tables from ".$_POST['db_from']);
   while($row=mysql_fetch_row($sth)){ do_export_table($row[0]); };
  };

  if(($ra=='21')||($ra=='31')){
   $ip_to = @gethostbyname($host_to);
   if($ip_to == $host_to) exit("Server <b>$host_to</b> NOT found.");
   echoout("Connect to <b>$host_to</b> ($ip_to)..."); 
   $sth=db_connect($_POST['host_to'],$_POST['port_to'],$_POST['user_to'],$_POST['pass_to'],$_POST['db_to'],$_POST['charset_from']);
   if ($err_msg!=''){echoout("<br/>".$err_msg."<br/>"); exit();} else echoout("ok<br/>");
   echoout("Login <b>".$_POST['user_to'].":".$_POST['pass_to']."</b> ok.<br/> Database <b>".$_POST['db_to']."</b> open.<br/>");
   echoout("<br/>");
   if($ra=='31'){do_import_files();}else{do_import_http();};
   if ($err_msg!=''){echoout("<br/>".$err_msg."<br/>"); exit();} else echoout("<br/>".$out_message."<br/>&#9492; ok<br/>");
  };

  echoout(" <br/><br/> Stat:<br> ");
  echoout(" Time <b>".(time()-$TimeHtml)."</b> sec <br>");
  echoout(" Tables: <b>".$ctable."</b><br>");
  echoout(" Report file: <b><a href='rep".$tmp.".htm'>rep".$tmp.".htm</a></b><br/>");
  if(($rto=='2')) {
   @fclose($fout);
   $f="db".$tmp.".sql";
   echoout("DB file: <b><a href='$f'>$f</a></b> (size ".filesize($f)." bytes)<br/>"); 
  };
  if(($rto=='3')) {
   @fclose($fout);
   for($i=1;$i<=$fpart;$i++){
   $f="db".$i.$tmp.".sql";
    echoout("DB file part #".$i.": <b><a href='$f'>$f</a></b> (size ".filesize($f)." bytes)<br/>"); 
   }

  };
  echoout("</body></html>");
  @fclose($freport);

}
//-------------------------------
function do_mysql_table($t,$dbfrom,$dbto){
 global $ctable;  $ctable++; $cc=0;
 echoout("<br/> Open table <b>".$t."</b> ok");

  $sth=mysql_query("show create table `$t`",$dbfrom);
  $row=mysql_fetch_row($sth);$row=$row[1];
  $row2='';
  for($i=0;$i<strlen($row);$i++){
  if(substr($row,$i,8)=='collate ') {
   for($j=$i+8;($j<strlen($row))&&(substr($row,$j,1)!=' ');$j++);
   $i=$j;$row2.='collate '.$_POST['charset_from'].'_bin ';
  } else $row2.=substr($row,$i,1);
  };$row=str_replace("\n","\r\n",$row2);
  $r1=strpos($row,"DEFAULT CHARSET=");
  $row=substr($row,0,$r1)."DEFAULT CHARSET=".$_POST['charset_from']." COLLATE=".$_POST['charset_from'].'_bin;';
  echoout("<br/>&#9500; Drop table if exisits `$t` in ".$_POST['db_to']);
  $sth=mysql_query("drop table if exisits `$t`",$dbto);
  echoout("<br/>&#9500; Structure copy");
  $sth=mysql_query($row,$dbto);
  echoout("<br/>&#9500; Data transfer (# - 0..100 records):");
  $sth=mysql_query("/*!40000 ALTER TABLE `$t` DISABLE KEYS */;",$dbto);
  $sth=mysql_query("select * from `$t`",$dbfrom);$c=1;$cn=1;$cc=0;
  while($row=mysql_fetch_row($sth)){
    $values=''; 
    foreach($row as $value) $values.=(($values)?',':'')."'".mysql_real_escape_string($value)."'";
    $exsql.=(($exsql)?',':'')."(".$values.")";
    if($cn==1) echoout("<br/>&#9500;&#9472;"); if($c==1) echoout(" #");
    if($cn<5000){$cn++;}else{$cn=1;};
    if($c<100){$c++;}else{$c=1;};
    $sth2=mysql_query("INSERT INTO `$t` VALUES $exsql;",$dbto);$exsql='';$cc++;

  }
  $sth=mysql_query("/*!40000 ALTER TABLE `$t` ENABLE KEYS */;",$dbto);

 echoout("<br/>&#9492; End transfer ($cc records)<br/>");
}

function do_import_files(){
 global $err_msg,$out_message,$sth,$ra;

 if (($_FILES['file_from'] && $_FILES['file_from']['name'])){
  $filename=$_FILES['file_from']['tmp_name'];
  $f=fopen($filename,'r+b');
  if (!do_import_read($f,$_FILES['file_from']['name']) ){
     $err_msg.=mysql_error($sth);
  }else{
     $out_message='Import done successfully. <br/>&#9500; Tables in <b>'.$_POST['db_to'].'</b>';
     $sth=mysql_query("show tables from ".$_POST['db_to']);
     while($row=mysql_fetch_row($sth)){ $out_message.="<br/>&#9500;&#9472; ".$row[0]; };
     return;
  }
 }else{
  $err_msg="Error: Please select file first ";
 }

}

function do_import_http(){
 global $err_msg,$out_message,$sth,$ra;
 $f=fopen($_POST['http_from'],'r+b');
 if (!$f){$err_msg="Error: Not open file <b>".$_POST['http_from']."</b> "; }else{
  $filename=$_POST['http_from'];
  if (!do_import_read($f,$filename) ){
     $err_msg.=mysql_error($sth);
  }else{
     $out_message='Import done successfully. <br/>&#9500; Tables in <b>'.$_POST['db_to'].'</b>';
     $sth=mysql_query("show tables from ".$_POST['db_to']);
     while($row=mysql_fetch_row($sth)){ $out_message.="<br/>&#9500;&#9472; ".$row[0]; };
  }
 }
}

function do_import_read($f,$filename){
 global $err_msg,$ctable;
 echoout("<br/> Open file <b>".$filename."</b> ok<br/>&#9500; Data transfer (# - 0..100 records):");

 $sql='';$c=1;$cn=1;$cc=0; $cs=0;
 while (!feof($f)){ 
    $str=fgets($f, 838860);$cc++;$sql=trim($sql).' ';
    if($cn==1) echoout("<br/>&#9500;&#9472;"); if($c==1) echoout(" #");
    if($cn<5000){$cn++;}else{$cn=1;};
    if($c<100){$c++;}else{$c=1;};

    $pos=-1;$is_cmt=0;$is_txt=0;$type_txt='';
    $i=strlen($str);
    while ($i--){$pos++;
     if ((substr($str,0,2)=='--') || substr($str,0,1)=='#') break;
     if (substr($str, $pos, 2)=='/*' && substr($str, $pos, 3)!='/*!') $is_cmt=1;
     if (substr($str, $pos, 2)=='*/' && substr($str, $pos, 3)!='*/;') $is_cmt=0;
     if (substr($str, $pos, 1)=="'") if( substr($str, $pos-1, 2)!="\'" ) if($is_txt==0) {$is_txt=1;$type_txt="'";}else{if($type_txt=="'")$is_txt=0;};
     if (substr($str, $pos, 1)=='"') if( substr($str, $pos-1, 2)!='\"' ) if($is_txt==0) {$is_txt=1;$type_txt='"';}else{if($type_txt=='"')$is_txt=0;};
     if (substr($str, $pos, 12)=='CREATE TABLE') $ctable++;
     if ((substr($str, $pos, 1)==';')&&($is_txt==0)&&($is_cmt==0)){
	$cs++; 
        if ($sql!="") $sth=mysql_query($sql); 
        if (!$sth) {
           $err_msg='<br><br>Error (in line '.$cc.', query #'.$cs.' ): <br><i>'.$sql.'</i><br>';
	   return false;
        }
	$sql='';
     } else {$sql.=substr($str, $pos, 1);
     }
    }
 }
 echoout("<br/>&#9492; End transfer ($cc records, $cs queries)<br/>");

return true;}

function do_export_table($t){ 
global $ctable; $ctable++;
echoout('Table:'.$t.'<br/>','-- BEGIN TABLE '.$t);
  $sth=mysql_query("show create table `$t`");
  $row=mysql_fetch_row($sth);$row=$row[1];
  $row2='';
  for($i=0;$i<strlen($row);$i++){
  if(substr($row,$i,8)=='collate ') {
   for($j=$i+8;($j<strlen($row))&&(substr($row,$j,1)!=' ');$j++);
   $i=$j;$row2.='collate '.$_POST['charset_from'].'_bin ';
  } else $row2.=substr($row,$i,1);
  };$row=str_replace("\n","\r\n",$row2);
  $r1=strpos($row,"DEFAULT CHARSET=");
  $row=substr($row,0,$r1)."DEFAULT CHARSET=".$_POST['charset_from']." COLLATE=".$_POST['charset_from'].'_bin;';

  echoout("&#9500; Structure copy - ok <br/>&#9500; Data transfer (# - 0..100 records):","DROP TABLE IF EXISTS `$t`;\r\n$row;\r\n\r\n");
  echoout("","/*!40000 ALTER TABLE `$t` DISABLE KEYS */;\r\n");
  $sth=mysql_query("select * from `$t`");$c=1;$cn=1;$cc=0;
  while($row=mysql_fetch_row($sth)){
    $values=''; 
    foreach($row as $value) $values.=(($values)?',':'')."'".mysql_real_escape_string($value)."'";
    $exsql.=(($exsql)?',':'')."(".$values.")";
    if($cn==1) echoout("<br/>&#9500;&#9472;"); if($c==1) echoout(" #");
    if($cn<5000){$cn++;}else{$cn=1;};
    if($c<100){$c++;}else{$c=1;};
    echoout("","INSERT INTO `$t` VALUES $exsql;");$exsql='';$cc++;

  }
  echoout("<br/>&#9492; End transfer ($cc records)<br/>","/*!40000 ALTER TABLE `$t` ENABLE KEYS */;\r\n".'-- END TABLE '.$t." \r\n");
}

function db_connect($host,$port,$user,$pass,$db,$charset){
 global $err_msg;
 $err_msg='';
 $dbh=@mysql_connect($host.($port==''?"":":".$port),$user,$pass);
 if (!$dbh) {
    $err_msg='Error: Cannot connect to the database because: '.mysql_error();
 }

 if ($dbh) {
  $res=mysql_select_db($db, $dbh);
  if (!$res) {
     $err_msg='Error: Cannot select db because: '.mysql_error();
  }else{
     $res=mysql_query("SET CHARSET ".$charset);
     if (!$res) $err_msg='Error: Cannot set CHARSET: '.mysql_error();
     $res=mysql_query("SET names ".$charset);
     if (!$res) $err_msg='Error: Cannot set CHARSET NAMES: '.mysql_error();
  }
 }

 return $dbh;
}

  function echoout($a,$b=""){
   global $freport,$fout,$fpsize,$fpart,$tmp,$ra;
   echo $a; flush();
   if($a!="")@fputs($freport,$a." \r\n");
   if($b!=""){$fpsize+=strlen($b);
    if($ra=='12'){ @fputs($fout,$b." \r\n");} else {
	if($fpsize>($_POST['file_to']*1024)){
	$fpsize=0; $fpart++; 
	@fclose($fout);
	$fout=fopen("db".$fpart.$tmp.".sql","w");
	} @fputs($fout,$b." \r\n");
    }
   } 
  }


?>