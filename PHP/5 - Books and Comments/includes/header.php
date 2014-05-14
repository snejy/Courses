<?php
session_start();
include './includes/functions.php';
isLogged();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $tiltle; ?></title>
    </head>
    <body>