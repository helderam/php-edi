<?php
namespace App\Kimberly_Clark;

use App\Layout;
use App\Campo;

class Estoque
{
    

    public function header_estoque($cod_sap)
    {
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1, 'INDICADOR DE REGISTRO', 'H', ALFA, 1, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2, 'CÓDIGO SAP DO DISTRIBUIDOR', $cod_sap, ALFA, 8, OBRIGATORIO, PREENCHIMENTO));
        
        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }

    public function detalhe_estoque($cod_sap, $ean, $cod_interno, $sku, $estoque_fisico, $estoque_transito, $estoque_reservado, $estoque_total)
    {
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1, 'INDICADOR DE REGISTRO', 'D', ALFA, 1, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2, 'CÓDIGO SAP DO DISTRIBUIDOR', $cod_sap, ALFA, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3, 'EAN', $ean, ALFA, 14, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(4, 'COD INTERNO', $cod_interno, ALFA, 8, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(5, 'SKU', $sku, ALFA, 40, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(6, 'ESTOQUE FISICO', $estoque_fisico, NUMERICO, 15, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(7, 'ESTOQUE TRANSITO', $estoque_transito, NUMERICO, 15, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(8, 'ESTOQUE RESERVADO', $estoque_reservado, NUMERICO, 15, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(9, 'ESTOQUE TOTAL', $estoque_total, NUMERICO, 15, OBRIGATORIO, PREENCHIMENTO));
        
        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }
}
