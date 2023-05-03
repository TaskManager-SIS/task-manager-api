<?php

use GerenciadorTarefas\App\Utilitarios\ValidaEmail;
use PHPUnit\Framework\TestCase;

class ValidaEmailTest extends TestCase
{

    /**
     * @test
     */
    public function validarQuandoEmailEhValido() {
        $email = 'teste@gmail.com';
        $retornoTeste = ValidaEmail::validarEmail($email);
        $this->assertTrue($retornoTeste);
    }

    /**
     * @test
     */
    public function validarQuandoEmailEhInvalido() {
        $email = 'testegmail.com';
        $retornoTeste = ValidaEmail::validarEmail($email);
        $this->assertFalse($retornoTeste);
    }
}