<?php
namespace App\Procter;

use App\Layout;
use App\Campo;

class Vendedores
{
    public $conta_vendedores;

    public function registro_vendedores($sap_mae, $sap_filial, $cod_vendedor, $nome_vendedor, $cod_supervisor, $nome_supervisor)
    {
        $conta_vendedores = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1, 'COD SAP MAE', $sap_mae, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(2, 'COD SAP FILIAL', $sap_filial, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(3, 'SETOR/CODIGO DO VENDEDOR', $cod_vendedor, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(4, 'NOME DO VENDEDOR', $nome_vendedor, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(5, 'CODIGO DO SUPERVISOR', $cod_supervisor, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(6, 'NOME DO SUPERVISOR', $nome_supervisor, ALFA, 50, OBRIGATORIO));

        $conta_vendedores++;

        $linha = $layout->gera_linha();
        
        // Gera linha conforme o layout
        return $linha;
    }
}
