<?php
session_start();
if(!isset($_SESSION["email"])) 
{
    header('Location:home.php'); 
}
else 
{
    session_unset();    
    session_destroy();
    header('Location:index.php'); 
}
?>