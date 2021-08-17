<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/DatabaseConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/config.php';

class ExerciciosDAO
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Database::Conection();
    }

    public function getAll()
    {
        try {
            $query = $this->conexao->prepare(
                "SELECT videos.id, titulo, descricao, calorias, imgPath, videoPath, categorias.nome as categoria
                FROM videos
                    INNER JOIN categoria_video on id_video = videos.id
                    INNER JOIN categorias on id_categoria = categorias.id");
            $query->execute();
            return $this->formatarRetorno($query->fetchAll(PDO::FETCH_ASSOC));
        } catch (\PDOException $erro) {
            echo $erro->getMessage();
            throw $erro;
        }
    }

    private function formatarRetorno($videos)
    {
        $resultado = [];
        foreach ($videos as $video) {
            $categoria = $video['categoria'];
            unset($video['categoria']);

            if (!isset($resultado[$video['id']])) {
                $resultado[$video['id']] = $video;
                continue;
            }
            $resultado[$video['id']]['categoria'][] = $categoria;
        }
        return array_values($resultado);
    }
}
