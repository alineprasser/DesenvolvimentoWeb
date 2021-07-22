<?php

require('./databaseConnection.php');
require('./config.php');

$connection = Database::Conection();

$nome = $_POST['name'];
$email = $_POST['email'];
$dataNascimento = $_POST['nascimento'];
$cpf = $_POST['cpf'];
$senha = $_POST['password'];
$confirmeSenha = $_POST['confirm_password'];


if (emailCadastrado($connection, $email)) {
    header('location: ' . URL_BASE, true, 422);
    echo 'Esse email já está cadastrado!';
    return false;
}

if (!verificarSenhas($senha, $confirmeSenha)) {
    header('location: ' . URL_BASE, true, 422);
    echo 'Senhas não conferem!';
    return false;
}

try {
    $query = $connection->prepare("INSERT INTO usuarios (nome, email, senha, cpf, data_nascimento) VALUE(:nome, :email, :senha, :cpf, :data_nascimento)");
    $query->bindValue(':nome', $nome, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':senha', $senha, PDO::PARAM_STR);
    $query->bindValue(':cpf', $cpf, PDO::PARAM_STR);
    $query->bindValue(':data_nascimento', $dataNascimento, PDO::PARAM_STR);
    $query->execute();
} catch (\PDOException $erro) {
    echo $erro->getMessage();
}
// header('HTTP/1.0 200 Ok');
header('location: ' . URL_BASE, true, 200);

function emailCadastrado($connection, $email)
{
    $query = $connection->prepare("SELECT * FROM usuarios WHERE email = :email");
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    return $query->rowCount();
}

function verificarSenhas($senha, $confirmeSenha)
{
    return $senha == $confirmeSenha;
}
