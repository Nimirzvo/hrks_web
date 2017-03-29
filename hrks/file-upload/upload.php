<?php
/**
  * set some variables for upload script
  */
$SESSION_KEY = '__upload_status';  
$id = uniqid("");
$_SESSION[$SESSION_KEY]["handler"] = "";

$plugins = array(
           "apc", 
	   "uploadprogress",
	   "noplugin"
	   ); // available plugins. Each plugin has own checkfunction in upload_functions.php and own file with functions in upload_#KEY#.php
$path = "C:\\WINDOWS\\Temp"; // path where uploaded files will be stored

include_once("upload_functions.php");

if (checkCurrentOS("Win"))
  $separator = "\\";
else
  $separator = "/";

checkSessions();


foreach ($plugins as $plugin)
{
  $check = $plugin."Check";
    
  if ($check())
  {
    $_SESSION[$SESSION_KEY]["handler"] = $plugin;
    include_once("upload_".$plugin.".php");
    break;
  } 
}
?>
