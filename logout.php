<?php
session_start();

unset($_SESSION['user_row']);

session_destroy();


header("Location: login.php");
exit();
?>