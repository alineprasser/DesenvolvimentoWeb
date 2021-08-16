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
        print_r(($eventos));
    }

    public function post()
    {
        // TODO: Implement post() method.
    }

    public function put()
    {
        // TODO: Implement put() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}

$router = new Router(new EventoSaude());
$router->run();
