<?php
namespace App;

class ValidaCampo
{

    public static function validar($campo)
    {
        $ordem = isset($campo[0]) ? $campo[0] : 0;
        $descrição = isset($campo[1]) ? $campo[1] : '';
        $conteudo = isset($campo[2]) ? $campo[2] : '';
        $tipo = isset($campo[3]) ? $campo[3] : 'A';
        $tamanho = isset($campo[4]) ? $campo[4] : 0;
        $obrigatorio = isset($campo[5]) ? $campo[5] : false;
        $preenchimento = isset($campo[6]) ? $campo[6] : ' ';
        $lado = isset($campo[7]) ? $campo[7] : STR_PAD_RIGHT;

        // Verifica se tamanho de campo numerico
        if ($tipo == 'N') {
            $tamanho_inteiro = floor($tamanho);
            $tamanho_decimal = ($tamanho - $tamanho_inteiro) * 10;
            $valor_inteiro = floor($conteudo);
            $valor_decimal = ($conteudo - $valor_inteiro);
        }
        if ($ordem < 1) {
            throw new \Exception("ORDEM CAMPO '{$descricao}' DEVE SER MAIOR QUE 1");
        }
        if (strlen($conteudo) > $tamanho) {
            throw new \Exception("TAMANHO CAMPO '{$descricao}' MAIOR QUE {$tamanho}");
        }
        if (empty($conteudo) && $obrigatorio) {
            throw new \Exception("CAMPO {$descricao} É OBRIGATÓRIO");
        }
        // formata campo conforme parametros
        return str_pad($conteudo, $tamanho, $preenchimento, $lado);
    }
}
