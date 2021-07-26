<?php

require_once('./databaseConnection.php');
require_once('./config.php');

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
                "INSERT INTO evento_consulta (usuario_id, tipo_evento_id, nome, data_e_hora, local) 
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
}
