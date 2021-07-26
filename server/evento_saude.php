<?php

require_once('./EventoSaudeDAO.php');

try {
    $eventoSaudeDao = new EventoSaudeDAO();

    $dadosEvento = [
        'usuario_id' => $_SESSION['usuario_id'],
        'tipo_evento_id' => $_POST['tipo-evento'],
        'nome' => $_POST['nome-evento'],
        'data_e_hora' => $_POST['data'].' '.$_POST['hora'],
        'local' => $_POST['local']
    ];
    $eventoSaudeDao->cadastrarEventoSaude($dadosEvento);

    header('location: '.URL_BASE, true, 200);
    echo 'Evento cadastrado com sucesso!';
    return true;
} catch (Exception $erro) {
    echo 'Erro ao cadastrar evento!'.PHP_EOL.$erro->getMessage();
    header('location: '.URL_BASE, true, 422);
    return false;
}

