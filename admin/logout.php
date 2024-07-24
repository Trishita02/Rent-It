<?php
session_start();
unset($_SESSION['ADMIN']);
unset($_SESSION['Admin_username']);
header('location:login.php');
?>