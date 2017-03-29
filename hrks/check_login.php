<?php
define(DOC_ROOT,dirname(__FILE__)); // To properly get the config.php file
$username = $_POST['username']; //Set UserName
$password = $_POST['password']; //Set Password
$msg ='';
if(isset($username, $password)) {
    ob_start();
    include(DOC_ROOT.'Prijava/require/config.php'); 

    $myusername = stripslashes($username);
    $mypassword = stripslashes($password);
    $myusername = mysqli_real_escape_string($dbC, $myusername);
    $mypassword = mysqli_real_escape_string($dbC, $mypassword);
    $sql="SELECT * FROM login_admin WHERE user_name='$myusername' and user_pass=SHA('$mypassword')";
    $result=mysqli_query($dbC, $sql);
    $count=mysqli_num_rows($result);
    if($count==1){
        session_register("admin");
        session_register("password");
        $_SESSION['name']= $myusername;
        header("location:admin.php");
    }
    else {
        $msg = "Pobresno korisnicno ime ili lozinka";
        header("location:login.php?msg=$msg");
    }
    ob_end_flush();
}
else {
    header("location:login.php?msg=Please enter some username and password");
}
?>