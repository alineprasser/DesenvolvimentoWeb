<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/DatabaseConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/config.php';

class HistoricoImcDAO
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Database::Conection();
    }

    public function cadastrarImc($dadosImc)
    {
        try {
            $query = $this->conexao->prepare(
                "INSERT INTO historico_imc (peso, altura, usuario_id) 
                    VALUES (:peso, :altura, :usuario_id)"
            );
            $query->bindValue(':peso', $dadosImc['peso']);
            $query->bindValue(':altura', $dadosImc['altura']);
            $query->bindValue(':usuario_id', $dadosImc['usuario_id']);
            $query->execute();
        } catch (\PDOException $erro) {
            echo $erro->getMessage();
        }
    }
}
