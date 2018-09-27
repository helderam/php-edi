<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - LAYOUT PROCTER/Inventarios            |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Inventarios.php                                          |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Formatar registros conforme Layout PROCTER/inventarios   | 
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

class Inventarios
{
    public $conta_inventario;
    public function registro_inventarios($sap_mae, $sap_filial, $dun_produto, $qntd_fisica, $qntd_transito, $data_leitura)
    {
        $inventario = 0;
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1, 'COD SAP MAE', $sap_mae, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(2, 'COD SAP FILIAL', $sap_filial, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(3, 'DUN DO PROTUDO', $dun_produto, ALFA, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4, 'QUANTIDADE FISICA', $qntd_fisica, ALFA, 10.3, OBRIGATORIO));
        $layout->adiciona(new Campo(5, 'QUANTIDADE EM TRANSIO', $qntd_transito, ALFA, 10.3, OBRIGATORIO));
        $layout->adiciona(new Campo(6, 'DATA DA LEITURA', $data_leitura, ALFA, 10, OBRIGATORIO));

        $inventario++;

        $linha = $layout->gera_linha();
        
        // Gera linha conforme o layout
        return $linha;
    }
}
