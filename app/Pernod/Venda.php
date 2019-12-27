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
 * | Criação....: 29-12-2019                                               |
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

    public function detalhe_venda($cnpj_distribuicao, $identificacao_do_cliente, $data_transacao, $numero_documento, 
                                    $codigo_do_produto, $quantidade, $preco_de_venda,$codigo_vendedor, $campo_reservado,
                                    $tipo_documento, $cep, $codigo_lote, $validade_lote, $dia_validade_lote, $pedido_sugerido,
                                    $preco_de_venda_dolar, $tipo_de_unidade)
    {
        $layout = new Layout();
         
        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1, 'TIPO DO REGISTRO', 'D', ALFA, 1, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2, 'INDENTIFICAÇÃO CLIENTE', $identificacao_do_cliente, ALFA, 18, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3, 'CNPJ DISTRIBUIÇÃO', $cnpj_distribuicao, NUMERICO, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(4, 'DATA TRANSAÇÃO', $data_transacao, ALFA, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(5, 'NUMERO DOCUMENTO', $numero_documento, ALFA, 20, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(6, 'CODIGO DO PRODUTO', $codigo_do_produto, NUMERICO, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(7, 'QUANTIDADE', $quantidade, NUMERICO, 15.4, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(8, 'PREÇO DE VENDA', $preco_de_venda, NUMERICO, 5.2, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(9, 'CODIGO VENDEDOR', $codigo_vendedor, ALFA, 20, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(10,'CAMPO RESERVADO', $campo_reservado, ALFA, 10, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(11, 'TIPO DOCUMENTO', $tipo_documento, ALFA, 10, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(12, 'CEP', $cep, NUMERICO, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(13, 'CODIGO LOTE', $codigo_lote, ALFA, 13, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(14, 'VALIDADE LOTE', $validade_lote, NUMERICO, 6, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(15, 'DIA VALIDADE LOTE', $dia_validade_lote, NUMERICO, 2, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(16, 'PEDIDO SUGERIDO', $pedido_sugerido, ALFA, 1, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(17, 'PREÇO DE VENDA DOLAR', $preco_de_venda_dolar, NUMERICO, 5.2, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(18, 'TIPO DE UNIDADE', $tipo_de_unidade, NUMERICO, 4, OBRIGATORIO, PREENCHIMENTO));

        
       
        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }
}
