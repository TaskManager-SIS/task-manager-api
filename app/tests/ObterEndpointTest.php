<?php

use GerenciadorTarefas\App\Utilitarios\ObterEndpoint;
use PHPUnit\Framework\TestCase;

class ObterEndpointTest extends TestCase
{

    /**
     * @test
     */
    public function testarQuandoEndpointNaoPossuiParametrosNaUrl() {
        $urlTeste = '/index.php/produto';
        $endpointQueEuAguardo = '/produto';
        $endpointRetornado = ObterEndpoint::obterEndpoint($urlTeste);
        $this->assertEquals($endpointQueEuAguardo, $endpointRetornado);
    }

    /**
     * @test
     */
    public function testarQuandoEndpointPossuiParametrosNaUrl() {
        $urlTeste = '/index.php/produto/buscar-pelo-id?id=1';
        $endpointQueEuAguardo = '/produto/buscar-pelo-id';
        $endpointRetornado = ObterEndpoint::obterEndpoint($urlTeste);
        $this->assertEquals($endpointQueEuAguardo, $endpointRetornado);
    }
}