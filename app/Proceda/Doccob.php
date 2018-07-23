<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - LAYOUT DOCCOB                         |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Doccob.php                                               |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Formatar registros conforme Layout DOCCOB                | 
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

namespace App\Proceda;

use App\ValidaCampo;

/**
 * Doccob
 *
 * @version    1.0
 * @package    proceda
 * @author     Helder Afonso de Morais
 * @copyright  Copyright (c) 2018 php-edi
 */
class Doccob
{
    var $conta_000 = 0;

    /**
     * Formata campos recebidos para registro 000
     * @param $remetente Request
     * @param $destinatario Request
     * @param $data Request
     * @param $hora Request
     * @param $intercambio Request
     * @param $tamanho Request
     */
    public function registro_000($remetente, $destinatario, $data, $hora, $intercambio, $tamanho)
    {
        // 1 - IDENTIFICADOR DO REGISTRO - SEMPRE 000
        $linha = '000';

        // 2 - IDENTIFICAÇÃO DO REMETENTE - ALFA 35 - OBRIGATÓRIO
        $linha .= ValidaCampo::validar('REMETENTE', $remetente, 35, true);

        // 3 - IDENTIFICAÇÃO DO DESTINATÁRIO - ALFA 35 - OBRIGATÓRIO
        $linha .= ValidaCampo::validar('DESTINATARIO', $destinatario, 35, true );

        // 4 - DATA - NUM 6 - OBRIGATORIO
        $linha .= ValidaCampo::validar('DATA', $data, 6, true);
      
        // 5 - HORA - NUM 4 - OBRIGATORIO
        $linha .= ValidaCampo::validar('HORA', $hora, 4, true);

        /* 6 - IDENTIFICAÇÃO DO INTERCAMBIO - 12 - OBRIGATÓRIO
           SUGESTÃO: "COB50DDMMSSS"
                     "COB50" = CONSTANTE COBrança+VERSÃO 50
                     "DDMM” = DIA/MÊS
                     "SSS" = SEQUÊNCIA DE 000 A 999
        */
        $linha .= ValidaCampo::validar('INTERCAMBIO', 'COB502906001', 12, true);

        // 7 - PREENCHER COM ESPAÇOS - 285 - OBRIGATÓRIO
        $linha .= ValidaCampo::validar('ESPAÇO',' ', 185, true); 

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 000 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_000++;

        // Verifica se tem mais de 1 registro 000
        if ($this->conta_000 > 1) {
          throw new Exception("REGISTRO 000 OCORRE MAIS DE 1 VEZ");
        }

        // Devolve a linha formatada conforme leyout
        return $linha;
    }
}
