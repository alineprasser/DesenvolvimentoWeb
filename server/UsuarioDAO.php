<?php

require_once('./DatabaseConnection.php');
require_once('./config.php');

class UsuarioDAO
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Database::Conection();
    }

    public function cadastrarUsuario($dadosUsuario)
    {
        try {
            $query = $this->conexao->prepare("INSERT INTO usuarios (nome, email, senha, cpf, data_nascimento) VALUES (:nome, :email, :senha, :cpf, :data_nascimento)");
            $query->bindValue(':nome', $dadosUsuario['nome']);
            $query->bindValue(':email', $dadosUsuario['email']);
            $query->bindValue(':senha', $dadosUsuario['senha']);
            $query->bindValue(':cpf', $dadosUsuario['cpf']);
            $query->bindValue(':data_nascimento', $dadosUsuario['data_nascimento']);
            $query->execute();
        } catch (\PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    public function verificarEmailJaCadastrado($email): int
    {
        $query = $this->conexao->prepare("SELECT * FROM usuarios WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();
        return $query->rowCount();
    }
}
