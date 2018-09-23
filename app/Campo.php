<?php
namespace App;

class Campo
{
    public $ordem;
    public $descricao;
    public $conteudo;
    public $tipo;
    public $tamanho;
    public $obrigatorio;

    public $formatado;

    public function __construct($ordem, $descricao, $conteudo, $tipo, $tamanho, $obrigatorio)
    {
        
        // Verifica se tamanho de campo numerico
        $valor_inteiro =  0;
        $valor_decimais =  0;
        $conteudo = (string) $conteudo; // Retira objeto SimpleXML.
        if ($tipo == 'N') {
            $partes = explode('.', $tamanho);
            $tamanho_inteiro = $partes[0];
            $tamanho_decimal = isset($partes[1]) ? $partes[1]: 0;
            $quebra =  explode('.', $conteudo);
            $valor_inteiro =  $quebra[0];
            $valor_decimais =  isset($quebra[1]) ? $quebra[1]: '';
            if (strlen($valor_inteiro) > $tamanho_inteiro) {
                throw new \Exception("PARTE INTEIRA CAMPO '{$descricao}' MAIOR QUE {$tamanho_inteiro}");
            }
            if (strlen($valor_decimais) > $tamanho_decimal) {
                #var_dump($tamanho_decimal); var_dump($valor_decimais); exit;
                throw new \Exception("PARTE DECIMAL CAMPO '{$descricao}' MAIOR QUE {$tamanho_decimal}");
            }
            $formatado = str_pad($valor_inteiro, $tamanho_inteiro, '0', STR_PAD_LEFT) .
                         str_pad($valor_decimais, $tamanho_decimal, '0', STR_PAD_RIGHT);
    
        } else {
            if (strlen($conteudo) > $tamanho) {
                throw new \Exception("TAMANHO CAMPO '{$descricao}' MAIOR QUE {$tamanho}");
            }
            $formatado = str_pad($conteudo, $tamanho, ' ', STR_PAD_RIGHT);
        }

        if ($ordem < 1) {
            throw new \Exception("ORDEM CAMPO '{$descricao}' DEVE SER MAIOR QUE 1");
        }
        if (strlen($conteudo) === 0 && $obrigatorio) {
            throw new \Exception("CAMPO {$descricao} É OBRIGATÓRIO");
        }

        #if(strlen($formatado) == 11 && $descricao == "CGC/CPF"){
        #    $formatado = "CPF".$formatado;
        #}

        // formata campo conforme parametros
        #return str_pad($conteudo, $tamanho, $preenchimento, $lado);
        $this->ordem = $ordem;
        $this->descricao = $descricao;
        $this->conteudo = $conteudo;
        $this->tipo = $tipo;
        $this->obrigatorio = $obrigatorio;
        $this->formatado = $formatado;
    }
}
