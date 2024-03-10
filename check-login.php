<?php
error_reporting(E_ALL);
session_start();
$idUserLoggedIn = $_SESSION['idUserLoggedIn'];
// if session and value not set, redirect to login
if (!isset($idUserLoggedIn)) {
 header("Location: login.php");
 exit;
}
?>