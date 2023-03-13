<?php

namespace GerenciadorTarefas\App\Repositorios;

use PDO;

class TarefaRepositorio
{
    private $conexaoBancoDados;

    public function __construct($conexaoBancoDados) {
        $this->conexaoBancoDados = $conexaoBancoDados;
    }

    public function cadastrarTarefa($titulo, $descricao, $dataCadastro, $usuarioId) {
        $query = 'INSERT INTO tbl_tarefas(titulo, descricao, dataCadastro, usuario_id) 
        VALUES(:titulo, :descricao, :dataCadastro, :usuario_id);';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':dataCadastro', $dataCadastro);
        $stmt->bindValue(':usuario_id', $usuarioId);

        return $stmt->execute();
    }

    public function buscarTodasTarefas() {
        $query = 'SELECT * FROM tbl_tarefas ORDER BY dataCadastro DESC;';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->execute();
        $tarefas = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $tarefas;
    }   

    public function buscarTarefaPeloId($id) {
        $query = 'SELECT * FROM tbl_tarefas WHERE id = :id;';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $tarefa = $stmt->fetch(PDO::FETCH_OBJ);

        return $tarefa;
    }

    public function editarTarefa($id, $titulo, $descricao, $ativo, $usuarioId) {

    }

    public function buscarTarefaPeloTitulo($titulo) {
        
    }

    public function buscarTarefaPelaDescricao($descricao) {

    }

    public function alterarStatusTarefa($novoStatus) {
        
    }

    public function removerTarefa($id) {
        $query = 'DELETE FROM tbl_tarefas WHERE id = :id;';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}