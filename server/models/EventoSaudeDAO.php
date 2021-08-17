<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/DatabaseConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/config.php';

class EventoSaudeDAO
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Database::Conection();
    }

    public function cadastrarEventoSaude($dadosEvento)
    {
        try {
            $query = $this->conexao->prepare(
                "INSERT INTO evento_saude (usuario_id, tipo_evento_id, nome, data_e_hora, local) 
                    VALUES(:usuario_id, :tipo_evento_id, :nome, :data_e_hora, :local)"
            );
            $query->bindValue(':usuario_id', $dadosEvento['usuario_id']);
            $query->bindValue(':tipo_evento_id', $dadosEvento['tipo_evento_id']);
            $query->bindValue(':nome', $dadosEvento['nome']);
            $query->bindValue(':data_e_hora', $dadosEvento['data_e_hora']);
            $query->bindValue(':local', $dadosEvento['local']);
            $query->execute();
        } catch (\PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function atualizarEventoSaude($dadosEvento)
    {
//        try {
//            $query = $this->conexao->prepare(
//                "UPDATE evento_saude (usuario_id, tipo_evento_id, nome, data_e_hora, local)
//                    VALUES(:usuario_id, :tipo_evento_id, :nome, :data_e_hora, :local)"
//            );
//            $query->bindValue(':usuario_id', $dadosEvento['usuario_id']);
//            $query->bindValue(':tipo_evento_id', $dadosEvento['tipo_evento_id']);
//            $query->bindValue(':nome', $dadosEvento['nome']);
//            $query->bindValue(':data_e_hora', $dadosEvento['data_e_hora']);
//            $query->bindValue(':local', $dadosEvento['local']);
//            $query->execute();
//        } catch (\PDOException $erro) {
//            echo $erro->getMessage();
//        }
    }

    public function getByUserId(int $usuarioId)
    {
        try {
            $query = $this->conexao->prepare(
                "SELECT evento.*, tipo.descricao_evento 
                FROM evento_saude as evento     
                    INNER JOIN tipo_evento_saude as tipo ON evento.tipo_evento_id = tipo.id 
                WHERE usuario_id = :usuario_id
                ORDER BY data_e_hora desc, nome asc"
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
