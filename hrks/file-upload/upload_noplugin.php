<?php
$ID_KEY      = 'noplugin';

function getUploadStatus($id)
{
  global $SESSION_KEY;
  global $ID_KEY;
  
  if (trim($id)=="")
    return;
  if (!array_key_exists($id, $_SESSION[$SESSION_KEY])) {
    $_SESSION[$SESSION_KEY][$id] = array(
                    'id'       => $id,
                    'finished' => false,
                    'percent'  => 0,
                    'total'    => 0,
                    'complete' => 0
                );
    }
    $ret = $_SESSION[$SESSION_KEY][$id];

    return $ret;
}

?>
