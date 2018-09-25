<?php
namespace App\Procter;

use App\Layout;
use App\Campo;

class Vendas
{
    public $conta_vendas;

    public function registro_vendas($sap_mae, $sap_filial, $numero_nf, $tipo_transacao, $data_doc, $cgc_cpf, $cod_vendedor, $dun_protudo, $qntd_vendida, $vlr_faturado)
    {
        $conta_vendas = 0;

        $layout = new Layout();

        if (strlen($cgc_cpf) == 11) {
            $cgc_cpf = "CPF".$cgc_cpf;
        }

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1, 'COD SAP MAE', $sap_mae, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(2, 'COD SAP FILIAL', $sap_filial, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(3, 'NUMERO DO DOCUMENTO', $numero_nf, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(4, 'TIPO DE TRANSAÇÃO', $tipo_transacao, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(5, 'DATA DO DOCUMENTO', $data_doc, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(6, 'CGC/CPF', $cgc_cpf, ALFA, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(7, 'SETOR/CODIGO DO VENDEDOR', $cod_vendedor, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(8, 'DUN DO PRODUTO', $dun_protudo, ALFA, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(9, 'QUANTIDADE VENDIDA', $qntd_vendida, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(10, 'VALOR FATURADO', $vlr_faturado, ALFA, 8.2, OBRIGATORIO));

        $conta_vendas++;

        $linha = $layout->gera_linha();
        
        // Gera linha conforme o layout
        return $linha;
    }
}
