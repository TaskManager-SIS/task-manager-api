<?php

namespace GerenciadorTarefas\App\Utilitarios;

class ObterEndpoint
{

    public static function obterEndpoint() {
        $endpoint = '';
        $uri = $_SERVER['REQUEST_URI'];
    
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