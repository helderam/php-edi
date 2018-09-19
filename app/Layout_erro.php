<?php

namespace App;

use App\Campo;

class Layout
{
    private $campos;

    public function adiciona(Campo $campo)
    {
        $this->campos[] = $campo;
    }

    public function __construct()
    {
        $this->campos = NULL;
    }

    public function gera_linha()
    {
        $linha = '';
        foreach($this->campos as $campo) {
            // formata campo conforme parametros
            $linha .= $campo->formatado.DELIMITADOR;
        }
        return $linha;
    }
}
