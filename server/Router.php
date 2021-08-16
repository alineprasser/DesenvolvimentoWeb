<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/IRouter.php';

class Router implements IRouter
{
    public $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function run()
    {
        if ($this->get()) {
            return;
        } elseif ($this->post()) {
            return;
        } elseif ($this->put()) {
            return;
        } elseif ($this->delete()) {
            return;
        }
    }

    public function get(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->class->get();
            return true;
        }
        return false;
    }

    public function post(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->class->post();
            return true;
        }
        return false;
    }

    public function put(): bool
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_SERVER['X-HTTP-Method-Override']) &&
            $_SERVER['X-HTTP-Method-Override'] == 'put'
        ) {
            $this->class->put();
            return true;
        }
        return false;
    }

    public function delete(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $this->class->delete();
            return true;
        }
        return false;
    }
}
