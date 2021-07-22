<?php

require('./databaseConnection.php');
require('./config.php');

session_start();
$connection = Database::Conection();

$query = $connection->prepare("SELECT * FROM usuarios WHERE email = :email");
$query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$query->execute();
if (!$query->rowCount()) {
    header('location: ' . URL_BASE, true, 422);
    echo 'Email e/ou senha inválidos!';
    return false;
}

$data = $query->fetch(PDO::FETCH_ASSOC);
if ($_POST['senha'] != $data['senha']) {
    header('location: ' . URL_BASE, true, 422);
    echo 'Email e/ou senha inválidos!';
    return false;
}

header('location: ' . URL_BASE . 'evento_saude.html');
return true;
