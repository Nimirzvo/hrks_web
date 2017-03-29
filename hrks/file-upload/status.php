<?php
    require_once('upload.php');

    header('Content-type: application/json');
    echo json_encode(getUploadStatus($_GET["id"]));
?>
