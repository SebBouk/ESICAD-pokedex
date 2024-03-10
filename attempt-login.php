<?php
require_once ("database-connection.php" );
session_start ();
$login = $_POST["login"];
$password = $_POST["password" ];
$hashedPassword = md5($password);
$user = $databaseConnection ->query("SELECT idUser, firstName, lastName , login, password FROM users
WHERE login = '$login' AND password = '$hashedPassword '")->fetch_assoc ();
if (isset($user)) {
 $_SESSION["idUserLoggedIn" ] = $user["idUser"];
 $_SESSION["firstName" ] = $user["firstName" ];
 $_SESSION["lastName" ] = $user["lastName" ];
 header("Location: index.php" );
 exit();
} else {
 header("Location: login.php" );
 exit();
}
?>