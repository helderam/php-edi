<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - LAYOUT PROCTER & GAMBLE               |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Procter.php                                              |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 20-08-2018                                               |
 * |                                                                       |
 * | Objetivo...: Formatar registros conforme Layout PROCTER & GAMBLE      | 
 * |                                                                       |
 * | Layout EDI.: BRAZIL - MDO - TIME HFS-IDS - 01/11/2011                 |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 * | Versões....:                                                          |
 * |                                                                       |
 * |                                                                       |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 */

namespace App\Procter;

use App\Layout;
use App\Campo;

/**
 * Procter
 *
 * @version    1.0
 * @package    procter
 * @author     Helder Afonso de Morais
 * @copyright  Copyright (c) 2018 php-edi
 */
class Procter
{

    var $conta_clientes = 0;

    /**
     * Formata campos recebidos para registro CLIENTES
     * @param $cod_sap_mae 
     * @param $cod_sap_filial
     * @param $cgc_cpf
     * @param $razao
     * @param $ramo
     * @param $endereco
     */
    public function registro_cliente($remetente, $destinatario, $data, $hora, $intercambio, $tamanho)
    {
        // Zera contador de clientes
        $this->conta_clientes = 0;

        $layout = new Layout();

        $layout->adiciona(new Campo(1,'COD SAP MAE DO CLIENTE NA P&G', 0, NUMERICO, 15, OBRIGATORIO));

        $linha = $layout->gera_linha();

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO CLIENTES NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_clientes++;

        // Gera linha conforme o layout
        return $linha."\n";
    }

}