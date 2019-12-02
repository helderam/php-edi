<?php

/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - LAYOUT Kimberly Clark                 |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Venda.php                                                |
 * |                                                                       |
 * | Autor......: Ivan <ivan.silva@vilanova.com.br>                        |
 * |                                                                       |
 * | Criação....: 29-44-2019                                               |
 * |                                                                       |
 * | Objetivo...: Formatar registros conforme Layout Pernod Venda          | 
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

namespace App\Pernod;

use App\Layout;
use App\Campo;

class Venda
{
    

    public function header_venda($identificador, $cnpj_fornecedor)
    {
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1, 'TIPO DE REGISTRO', 'H', ALFA, 1, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2, 'IDENTIFICADOR', $identificador, ALFA, 7, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3, 'CNPJ FORNECEDOR', $cnpj_fornecedor, NUMERICO, 14, OBRIGATORIO, PREENCHIMENTO));
        
        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }

    public function detalhe_venda($cnpj_distribuicao, $identificacao_do_cliente)
    {
        $layout = new Layout();
         
        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1, 'TIPO DO REGISTRO', 'D', ALFA, 1, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2, 'CNPJ DISTRIBUIÇÃO', $cnpj_distribuicao, NUMERICO, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3, 'INDENTIFICAÇÃO CLIENTE', $identificacao_do_cliente, ALFA, 18, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(4, 'INDENTIFICAÇÃO CLIENTE', $identificacao_do_cliente, ALFA, 18, OBRIGATORIO, PREENCHIMENTO));

        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }
}
