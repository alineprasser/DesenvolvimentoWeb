<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/models/HistoricoImcDAO.php';

try {
    $historicoImcDao = new HistoricoImcDAO();

    $dadosImc = [
        'usuario_id' => $_SESSION['usuario_id'],
        'peso' => $_POST['peso'],
        'altura' => $_POST['altura']
    ];
    $historicoImcDao->cadastrarImc($dadosImc);

    header('location: '.URL_BASE, true, 200);
    echo 'IMC cadastrado com sucesso!';
    return true;
} catch (Exception $erro) {
    echo 'Erro ao cadastrar IMC!'.PHP_EOL.$erro->getMessage();
    header('location: '.URL_BASE, true, 422);
    return false;
}

