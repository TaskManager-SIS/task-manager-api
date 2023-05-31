<?php

use GerenciadorTarefas\App\Utilitarios\ValidaFormulario;
use PHPUnit\Framework\TestCase;

class ValidaFormularioTest extends TestCase
{

    /**
     * @test
     */
    public function validarQuandoEhInformadoDadoVazio() {
        $nome = 'Gabriel';
        $sobrenome = '';
        $resultadoValidarForm = ValidaFormulario::validarFormulario($nome, $sobrenome);
        $this->assertFalse($resultadoValidarForm);
    }

    /**
     * @test
     */
    public function validarQuandoEhInformadoDadoInteiroIgualAZero() {
        $id = 0;
        $resultadoValidarForm = ValidaFormulario::validarFormulario($id);
        $this->assertFalse($resultadoValidarForm);
    }

    /**
     * @test
     */
    public function validarQuandoSaoInformadosDadosValidos() {
        $nome = 'Gabriel';
        $sobrenome = 'Rodrigues';
        $resultadoValidarForm = ValidaFormulario::validarFormulario($nome, $sobrenome);
        $this->assertFalse($resultadoValidarForm);
    }
}