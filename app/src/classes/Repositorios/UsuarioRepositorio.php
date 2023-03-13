<?php

namespace GerenciadorTarefas\App\Repositorios;

use PDO;

class UsuarioRepositorio
{
    private $conexaoBancoDados;

    public function __construct($conexaoBancoDados) {
        $this->conexaoBancoDados = $conexaoBancoDados;
    }

    public function cadastrarUsuario($nome, $email, $senha) {
        $query = 'INSERT INTO tbl_usuarios(nome, email, senha) 
        VALUES(:nome, :email, :senha);';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        
        return $stmt->execute();
    }

    public function buscarTodosUsuarios() {
        $query = 'SELECT * FROM tbl_usuarios;';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $usuarios;
    }

    public function buscarUsuarioPeloId($id) {
        $query = 'SELECT * FROM tbl_usuarios WHERE id = :id;';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function buscarUsuarioPeloEmailESenha($email, $senha) {
        $query = 'SELECT * FROM tbl_usuarios WHERE email = :email AND senha = :senha;';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function editarUsuario($id, $nome, $email, $senha, $ativo) {
        
    }

    public function verificarSeExisteUsuarioCadastradoComEmailInformado($email) {
        $query = 'SELECT id FROM tbl_usuarios WHERE email = :email;';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->fetch(PDO::FETCH_OBJ) === false) {

            return false;
        }
        
        return true;
    }

    public function consultarSenhaUsuarioPeloEmail($email) {
        $query = 'SELECT senha FROM tbl_usuarios WHERE email = :email;';
        $stmt = $this->conexaoBancoDados->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_OBJ);

        return $usuario;
    }
}