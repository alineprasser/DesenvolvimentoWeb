<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/models/EventoSaudeDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/IRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/Router.php';

class EventoSaude implements IRouter
{
    private EventoSaudeDAO $eventoSaudeDao;

    public function __construct()
    {
        $this->eventoSaudeDao = new EventoSaudeDAO();
    }

    public function get()
    {
        $usuarioId = $_SESSION['usuario_id'];
        if (!$usuarioId) {
            echo 'Não foi informado o id do usuário.';
        }

        $eventos = $this->eventoSaudeDao->getByUserId($usuarioId);
        print json_encode($eventos);
    }

    public function post()
    {
        try {
            $dadosEvento = [
                'usuario_id' => $_SESSION['usuario_id'],
                'tipo_evento_id' => $_POST['tipo-evento'],
                'nome' => $_POST['nome-evento'],
                'data_e_hora' => $_POST['data'].' '.$_POST['hora'],
                'local' => $_POST['local']
            ];
            $this->eventoSaudeDao->cadastrarEventoSaude($dadosEvento);

            header('location: '.URL_BASE.'evento_saude.html');
            return true;
        } catch (Exception $erro) {
            echo 'Erro ao atualizar evento!'.PHP_EOL.$erro->getMessage();
            header('location: '.URL_BASE, true, 422);
            return false;
        }
    }

    public function put()
    {
        try {
            $dadosEvento = [
                'tipo_evento_id' => $_POST['tipo-evento'],
                'nome' => $_POST['nome-evento'],
                'data_e_hora' => $_POST['data'].' '.$_POST['hora'],
                'local' => $_POST['local']
            ];
            $this->eventoSaudeDao->atualizarEventoSaude($dadosEvento);

            header('location: '.URL_BASE.'evento_saude.html');
            return true;
        } catch (Exception $erro) {
            echo 'Erro ao cadastrar evento!'.PHP_EOL.$erro->getMessage();
            header('location: '.URL_BASE, true, 422);
            return false;
        }
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}

$router = new Router(new EventoSaude());
$router->run();
