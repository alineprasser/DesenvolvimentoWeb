<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/models/ExerciciosDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/IRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/Router.php';

class Exercicio implements IRouter
{
    private ExerciciosDAO $exerciciosDAO;

    public function __construct()
    {
        $this->exerciciosDAO = new ExerciciosDAO();
    }

    public function get()
    {
        $exercicios = $this->exerciciosDAO->getAll();
        print json_encode($exercicios);
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

$router = new Router(new Exercicio());
$router->run();
