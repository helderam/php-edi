<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - CAMPO                                 |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Campo.php                                                |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 02-08-2018                                               |
 * |                                                                       |
 * | Objetivo...: Padronizar campos e validar conforme: tamanho,           |
 * |              obrigatoriedade e preenchimento a direita ou esquerda    |
 * |                                                                       |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 * | Versões....:                                                          |
 * |                                                                       |
 * |                                                                       |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 */

namespace App;

/**
 * Campo
 *
 * @version    1.0
 * @package    APP
 * @author     Helder Afonso de Morais
 * @copyright  Copyright (c) 2018 php-edi
 */
class Campo
{
    public $ordem;
    public $descricao;
    public $conteudo;
    public $tipo;
    public $tamanho;
    public $obrigatorio;
    public $preenchimento;
    public $lado;

    public $inteiro;
    public $decimais;

    /**
     * Verifica campo tamanho e conteudo
     * @param $ordem     = sequencia para ajudar identificacao  
     * @param $descrição 
     * @param $conteudo Request
     * @param $tipo Request
     * @param $tamanho Request
     * @param $obrigatorio FALSE
     * @param $preenchimento ESPAÇO
     * @param $lado STR_PAD_RIGHT
     */
    public function __construct($ordem, $descricao, $conteudo, $tipo, $tamanho, $obrigatorio='S', $preenchimento=' ', $lado=STR_PAD_RIGHT)
    {
        // Verifica se tamanho de campo numerico
    $valor_inteiro =  0;
    $valor_decimais =  0;
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
        } else {
            if (strlen($conteudo) > $tamanho) {
                throw new \Exception("TAMANHO CAMPO '{$descricao}' MAIOR QUE {$tamanho}");
            }
        }
        if ($ordem < 1) {
            throw new \Exception("ORDEM CAMPO '{$descricao}' DEVE SER MAIOR QUE 1");
        }
        if (strlen($conteudo) === 0 && $obrigatorio) {
            throw new \Exception("CAMPO {$descricao} É OBRIGATÓRIO");
        }

        // formata campo conforme parametros
        #return str_pad($conteudo, $tamanho, $preenchimento, $lado);
        $this->ordem = $ordem;
        $this->descricao = $descricao;
        $this->conteudo = $conteudo;
        $this->tipo = $tipo;
        $this->tamanho = $tamanho;
        $this->inteiro = $valor_inteiro;
        $this->decimais = $valor_decimais;
        $this->obrigatorio = $obrigatorio;
        $this->preenchimento = $preenchimento;
        $this->lado = $lado;

    }
}
