<?php

namespace GerenciadorTarefas\App\Utilitarios;

class ObterEndpoint
{

    public static function obterEndpoint($urlInformada) {
        $endpoint = '';
        $uri = $urlInformada;
    
        if (strpos($uri, '?')) {
            $uriArray = explode('?', $uri);
            $endpoint = $uriArray[0];
        } else {
            $endpoint = $uri;
        }
    
        $endpoint = str_replace('/index.php', '', $endpoint);
    
        return $endpoint;
    }
}