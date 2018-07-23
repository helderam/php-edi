<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - VALIDA CAMPOS                         |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: ValidaCampo.php                                          |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Validar Campos conforme: tamanho, obrigatoriedade e      |
 * |              preenchimento a direita ou esquerda                      | 
 * |                                                                       |
 * | Layout EDI.: 6.0 - 31/07/2008                                         |
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
 * Doccob
 *
 * @version    1.0
 * @package    proceda
 * @author     Helder Afonso de Morais
 * @copyright  Copyright (c) 2018 php-edi
 */
class ValidaCampo
{
    /**
     * Verifica campo tamanho e conteudo e retorna formatado 
     * @param $remetente Request
     * @param $destinatario Request
     * @param $data Request
     * @param $hora Request
     * @param $intercambio Request
     * @param $tamanho Request
     */
    public static function validar($campo, $conteudo, $tamanho, $obrigatorio=false, $preenchimento=' ', $lado=STR_PAD_RIGHT)
    {
        if (strlen($conteudo) > $tamanho) {
            throw new \Exception("TAMANHO CAMPO {$campo} MAIOR QUE {$tamanho}");
        }
        if (empty($conteudo) && $obrigatorio) {
            throw new \Exception("CAMPO {$campo} É OBRIGATÓRIO");
        }
        return str_pad($conteudo, $tamanho, $preenchimento, $lado);
    }
}
