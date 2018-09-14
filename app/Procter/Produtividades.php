<?php
namespace App\Procter;

use App\Layout;
use App\Campo;

class Produtividades
{
    var $conta_produtividade;

    public function registro_produtividade($sap_mae, $sap_filial, $data_visitas, $cod_vendedor, $visitas_dia, $visitas_com_vendas)
    {
        $conta_produtividade = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'COD SAP MAE', $sap_mae, NUMERICO, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'COD SAP FILIAL', $sap_filial, NUMERICO, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'DATA DAS VISITAS', $data_visitas, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'SETOR/CODIGO DO VENDEDOR', $cod_vendedor, NUMERICO, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'VISITAS NO DIA', $visitas_dia, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'VISITAS COM VENDAS', $visitas_com_vendas, NUMERICO, 10, OBRIGATORIO));

        $conta_produtividade++;

        $linha = $layout->gera_linha();
        
        // Gera linha conforme o layout
        return $linha;
    }
}