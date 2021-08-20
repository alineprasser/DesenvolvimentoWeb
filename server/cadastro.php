<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/models/UsuarioDAO.php';

try {
    $usuarioDao = new UsuarioDAO();
    verificarDadosCadastro($usuarioDao);

    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dadosUsuario = [
        'nome' => $_POST['name'],
        'email' => $_POST['email'],
        'dataNascimento' => $_POST['nascimento'],
        'cpf' => $_POST['cpf'],
        'senha' => $hashed_password,
        'confirmeSenha' => $_POST['confirm_password'],
    ];
    $usuarioDao->cadastrarUsuario($dadosUsuario);

    header('location: '.URL_BASE);
    return true;
} catch (Exception $erro) {
    echo 'Erro ao cadastrar usuário!'.PHP_EOL.$erro->getMessage();
    header('location: '.URL_BASE, true, 422);
    return false;
}

function verificarDadosCadastro($usuarioDao)
{
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $confirmeSenha = $_POST['confirm_password'];

    if ($usuarioDao->verificarEmailJaCadastrado($email)) {
        header('location: '.URL_BASE, true, 422);
        echo 'Esse email já está cadastrado!';
        die();
    }

    if (!verificarSenhas($senha, $confirmeSenha)) {
        header('location: '.URL_BASE, true, 422);
        echo 'Senhas não conferem!';
        die();
    }
}

function verificarSenhas($senha, $confirmeSenha): bool
{
    return $senha == $confirmeSenha;
}
