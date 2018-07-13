<?php

namespace App;

class ValidaCampo
{
    public function validar($campo, $conteudo, $tamanho, $obrigatorio=false, $preenchimento=' ', $lado=STR_PAD_RIGHT)
    {
        if (strlen($conteudo) > $tamanho) {
            throw new Exception("TAMANHO CAMPO {$campo} MAIOR QUE {$tamanho}");
        }
        if (empty($conteudo) && $obrigatorio) {
            throw new Exception("CAMPO {$campo} É OBRIGATÓRIO");
        }
        return str_pad($conteudo, $tamanho, $preenchimento, $lado);
    }
}
