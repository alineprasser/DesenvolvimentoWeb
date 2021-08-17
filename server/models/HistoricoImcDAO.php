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

    public function getByUserId(int $usuarioId)
    {
        try {
            $query = $this->conexao->prepare(
                "SELECT *
                FROM historico_imc
                WHERE usuario_id = :usuario_id
                ORDER BY data_cadastro desc"
            );
            $query->bindValue(':usuario_id', $usuarioId);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $erro) {
            echo $erro->getMessage();
            throw $erro;
        }
    }
}
