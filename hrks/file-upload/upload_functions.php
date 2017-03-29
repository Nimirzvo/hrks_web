<?php
function checkSessions()
{
  global $SESSION_KEY;
  global $ID_KEY;
  
  session_start();

  if (!array_key_exists($SESSION_KEY, $_SESSION))
      $_SESSION[$SESSION_KEY] = array();
}

function upload($key, $path)
{
  global $SESSION_KEY;
  global $ID_KEY;
  
  if (!isset($_FILES[$key]) || !is_array($_FILES[$key]))
    return false;
 
  $file = $_FILES[$key];
	  
  $id   = $_POST[$ID_KEY];
 
  if ($file['error'] != UPLOAD_ERR_OK)
    return false;
 
  $fullpath = $path.basename($file['name']);
  if (!move_uploaded_file($file['tmp_name'], $fullpath))
    return false;
 
  $size = filesize($fullpath);
 
  $_SESSION[$SESSION_KEY][$id] = array(
                'id'       => $id,
                'finished' => true,
                'percent'  => 100,
                'total'    => $size,
                'complete' => $size
  );
 
  return true;
}

function checkCurrentOS( $_OS )
{
    if ( strcmp( $_OS, (substr( php_uname( ), 0, 7 ) == "Windows" ? "Win" : "_Nix") ) == 0 ) {
        return true;
    }
    return false;
}

function apcCheck()
{
  if (!extension_loaded('apc') || !function_exists('apc_fetch'))
    return false;
  return (ini_get('apc.enabled') && ini_get('apc.rfc1867'));
}

function uploadprogressCheck()
{
  if (!function_exists("uploadprogress_get_info") || !function_exists('getallheaders'))
    return false;
  return true;
}

function nopluginCheck()
{
  return true;
}
?>