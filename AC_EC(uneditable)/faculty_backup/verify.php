<?php
session_start();
if(!isset($_SESSION['email'] )){
    header("Location: ../index.php");
    exit();
}elseif($_SESSION['role']!="faculty"){
    header("Location: ../index.php");
    exit();
}
?>