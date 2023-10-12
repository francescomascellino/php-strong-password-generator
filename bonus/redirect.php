<?php
require __DIR__ . '/functions.php';

// SE $_GET["length"] E' STATO SETTATO DAL FORM...
if (isset($_GET["length"])) {

    // ASSEGNA ALLA VARIABILE IL VALORE DEL $_GET
    $length = $_GET["length"];

    $password = gen_pwd($length);
}

session_start();
$_SESSION['password'] = $password;

header('Location: ./index.php');
