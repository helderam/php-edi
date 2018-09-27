<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - LAYOUT PROCTER/Produtividades         |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Produtividades.php                                       |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Formatar registros conforme Layout PROCTER/Produtividades| 
 * |                                                                       |
 * | Layout EDI.:                                                          |
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

class Produtividades
{
    public $conta_produtividade;

    public function registro_produtividade($sap_mae, $sap_filial, $data_visitas, $cod_vendedor, $visitas_dia, $visitas_com_vendas)
    {
        $conta_produtividade = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1, 'COD SAP MAE', $sap_mae, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(2, 'COD SAP FILIAL', $sap_filial, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(3, 'DATA DAS VISITAS', $data_visitas, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(4, 'SETOR/CODIGO DO VENDEDOR', $cod_vendedor, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(5, 'VISITAS NO DIA', $visitas_dia, ALFA, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(6, 'VISITAS COM VENDAS', $visitas_com_vendas, ALFA, 10, OBRIGATORIO));

        $conta_produtividade++;

        $linha = $layout->gera_linha();
        
        // Gera linha conforme o layout
        return $linha;
    }
}
