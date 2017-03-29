<?php
include('dbimexport.php');

$db_config = Array
            ( 
                'dbtype' => "MYSQL",
                'host' => "localhost",
                'database' => "test",
                'user' => "root",
                'password' => "",
            );
$dbimexport = new dbimexport($db_config);

$_GET['select'] = isset($_GET['select']) ? $_GET['select'] : "";

switch( $_GET['select'] )
{
    case "download_inline":
                                    $dbimexport->download_path = "";
                                    $dbimexport->download = true;
                                    $dbimexport->file_name = date("Y-m-d_H-i-s");
                                    $dbimexport->export();
                                    break;

    case "save_to_disc":
                                    $dbimexport->download = false;
                                    $dbimexport->download_path = $_SERVER['DOCUMENT_ROOT'];
                                    $dbimexport->file_name = "auto_save";
                                    $dbimexport->export();
                                    break;

    case "import":
                                    $dbimexport->import_path = $_SERVER['DOCUMENT_ROOT'] . "/auto_save.xml";
                                    $dbimexport->import();
                                    break;
}
?>

<ul>
    <li> <a href="example.php?select=download_inline"> Download Inline</a></li>
    <li> <a href="example.php?select=save_to_disc"> Save in disc</a></li>
    <li> <a href="example.php?select=import"> Import From Disc</a></li>
</ul>