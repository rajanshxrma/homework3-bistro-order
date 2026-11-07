<?php
session_start();

unset($_SESSION['dessert'], $_SESSION['drink'], $_SESSION['drinkSize']);
$_SESSION = [];
session_destroy();

header('Location: index.php');
exit;
