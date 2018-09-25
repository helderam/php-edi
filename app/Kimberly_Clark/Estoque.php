<?php
namespace App\Kimberly_Clark;

use App\Layout;
use App\Campo;

class Estoque
{
    

    public function header($cod_sap)
    {
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1, 'INDICADOR DE REGISTRO', 'H', ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(2, 'CÓDIGO SAP DO DISTRIBUIDOR', $cod_sap, ALFA, 8, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }

    public function descricao($cod_sap, $ean, $cod_interno, $sku, $estoque_fisico, $estoque_transito, $estoque_reservado, $estoque_total)
    {
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1, 'INDICADOR DE REGISTRO', 'H', ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(2, 'CÓDIGO SAP DO DISTRIBUIDOR', $cod_sap, ALFA, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(3, 'EAN', $ean, ALFA, 14, OPCIONAL));
        $layout->adiciona(new Campo(4, 'COD INTERNO', $cod_interno, ALFA, 8, OPCIONAL));
        $layout->adiciona(new Campo(5, 'SKU', $sku, ALFA, 40, OPCIONAL));
        $layout->adiciona(new Campo(6, 'ESTOQUE FISICO', $estoque_fisico, ALFA, 15, OPCIONAL));
        $layout->adiciona(new Campo(7, 'ESTOQUE TRANSITO', $estoque_transito, ALFA, 15, OPCIONAL));
        $layout->adiciona(new Campo(8, 'ESTOQUE RESERVADO', $estoque_reservado, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(9, 'ESTOQUE TOTAL', $estoque_total, ALFA, 15, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }
}
