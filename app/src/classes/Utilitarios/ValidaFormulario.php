<?php

namespace GerenciadorTarefas\App\Utilitarios;

class ValidaFormulario
{

    public static function validarFormulario(...$dados) {

        foreach ($dados as $dado) {
    
            if (empty($dado)) {
    
                return false;
            }
    
        }
        
        return true;
    }
}