<?php

if (!isset($_SESSION)){
  session_start();
}
$username = $_SESSION['username'];

$ID_UserType = $_SESSION['regtype'];

if(!isset($_SESSION['username']))
{
header("location:../index");
}  

/*
$inactive = 900;
// check to see if $_SESSION['timeout'] is set

$_SESSION['timeout'] = time();

if(isset($_SESSION['timeout']) )
{
    $session_life = time() - $_SESSION['timeout'];
    if($session_life > $inactive)
    { session_destroy(); header("Location: logout.php"); }
}  */

?>

