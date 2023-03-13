<?php

namespace GerenciadorTarefas\App\Utilitarios;

class Log
{

    public static function escreverMensagemLog($mensagem) {
        $documentoRoot = explode('src', __DIR__)[0];
        $diretorioArquivoDeLog = 'arquivos_log/';
        $nomeArquivo = 'log.txt';
        
        if (is_dir($documentoRoot . $diretorioArquivoDeLog) === false) {
            mkdir($diretorioArquivoDeLog);
        }

        $arquivo = fopen($documentoRoot . $diretorioArquivoDeLog . $nomeArquivo, 'a+');
        $dataAtual = date('d-m-Y H:i:s');
        fwrite($arquivo, $mensagem . ' - ' . $dataAtual . PHP_EOL);
        fclose($arquivo);
    }
}