<?php

namespace GerenciadorTarefas\App\Utilitarios;

class ValidaEmail
{

    public static function validarEmail($email) {

        if (empty($email)) {

            return false;
        }

        if (!strpos($email, '@') || !strpos($email, '.com')) {

            return false;
        }

        $emailArray = explode('@', $email);

        if (strlen($emailArray[0]) === 0 || strlen($emailArray[1]) === 0) {
            
            return false;
        }

        return true;
    }
}