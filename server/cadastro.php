<?php

require_once('./UsuarioDAO.php');

try {
    $usuarioDao = new UsuarioDAO();
    verificarDadosCadastro($usuarioDao);

    $dadosUsuario = [
        'nome' => $_POST['name'],
        'email' => $_POST['email'],
        'dataNascimento' => $_POST['nascimento'],
        'cpf' => $_POST['cpf'],
        'senha' => $_POST['password'],
        'confirmeSenha' => $_POST['confirm_password'],
    ];
    $usuarioDao->cadastrarUsuario($dadosUsuario);

    header('location: '.URL_BASE, true, 200);
    echo 'Usuário cadastrado com sucesso!';
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
