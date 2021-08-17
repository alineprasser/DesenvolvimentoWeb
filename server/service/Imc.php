<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/models/HistoricoImcDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/IRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/Router.php';

class Imc implements IRouter
{
    private HistoricoImcDAO $historicoImcDAO;

    public function __construct()
    {
        $this->historicoImcDAO = new HistoricoImcDAO();
    }

    public function get()
    {
        $usuarioId = $_SESSION['usuario_id'];
        if (!$usuarioId) {
            echo 'Não foi informado o id do usuário.';
        }

        $imc = $this->historicoImcDAO->getByUserId($usuarioId);
        print json_encode($imc);
    }

    public function post()
    {
        try {
            $dadosImc = [
                'usuario_id' => $_SESSION['usuario_id'],
                'peso' => $_POST['peso'],
                'altura' => $_POST['altura']
            ];
            $this->historicoImcDAO->cadastrarImc($dadosImc);

            header('location: '.URL_BASE.'imc.html');
            return true;
        } catch (Exception $erro) {
            echo 'Erro ao cadastrar IMC!'.PHP_EOL.$erro->getMessage();
            header('location: '.URL_BASE, true, 422);
            return false;
        }
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

$router = new Router(new Imc());
$router->run();
