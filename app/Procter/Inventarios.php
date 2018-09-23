<?php
namespace App\Procter;

use App\Layout;
use App\Campo;

class Inventarios
{
    public $conta_inventario;
    public function registro_inventarios($sap_mae, $sap_filial, $dun_produto, $qntd_fisica, $qntd_transito, $data_leitura)
    {
        $inventario = 0;
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1, 'COD SAP MAE', $sap_mae, NUMERICO, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(2, 'COD SAP FILIAL', $sap_filial, NUMERICO, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(3, 'DUN DO PROTUDO', $dun_produto, ALFA, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4, 'QUANTIDADE FISICA', $qntd_fisica, NUMERICO, 10.3, OBRIGATORIO));
        $layout->adiciona(new Campo(5, 'QUANTIDADE EM TRANSIO', $qntd_transito, NUMERICO, 10.3, OBRIGATORIO));
        $layout->adiciona(new Campo(6, 'DATA DA LEITURA', $data_leitura, NUMERICO, 10, OBRIGATORIO));

        $inventario++;

        $linha = $layout->gera_linha();
        
        // Gera linha conforme o layout
        return $linha;
    }
}
