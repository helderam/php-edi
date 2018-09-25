<?php

/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - GERA LAYOUT PROCTER                   |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: GeraProcter.php                                          |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 23-09-2018                                               |
 * |                                                                       |
 * | Objetivo...: Gerar todos os registros conforme Layout PROCTER. Os     |
 * |              dados devem estar no arquivo dados/procter.xml           | 
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

// Campo ORIGATÒRIO preencher o conteudo
const OBRIGATORIO = true;
const OPCIONAL = false;

const NUMERICO = 'N';
const ALFA = 'A';

const DELIMITADOR = ';';

require_once "vendor/autoload.php";

use App\Procter\Clientes;
use App\Procter\Inventarios;
use App\Procter\Produtividades;
use App\Procter\Vendas;
use App\Procter\Vendedores;

try {
    // Variavel memória de todas as linhas
    $linhas = '';

    // Instancia objetos
    $cliente = new Clientes();
    $vendedor = new Vendedores();
    $venda = new Vendas();
    $produtividade = new Produtividades();
    $inventario = new Inventarios();


    // Obtem os dados de arquivo XML: dados/procter.xml
    $xml = simplexml_load_file('dados/procter.xml');

    // Acrescenta registro clientes
    $linhas = $cliente->registro_clientes($xml->cliente->sap_mae, $xml->cliente->sap_filial, $xml->cliente->cgc_cpf, $xml->cliente->razao, $xml->cliente->ramo, $xml->cliente->endereco, $xml->cliente->bairro, $xml->cliente->cidade, $xml->cliente->estado, $xml->cliente->cep, $xml->cliente->telefone, $xml->cliente->setor, $xml->cliente->numero);
    file_put_contents('arquivos/BLZ_STOR_NC_10908082005.txt', $linhas);
    echo $linhas."\n";

    // Acrescenta registro vendedores
    $linhas = $vendedor->registro_vendedores($xml->vendedor->sap_mae, $xml->vendedor->sap_filial, $xml->vendedor->cod_vendedor, $xml->vendedor->nome_vendedor, $xml->vendedor->cod_supervisor, $xml->vendedor->nome_supervisor);
    file_put_contents('arquivos/BZL_SREP_NC_10908092005.txt', $linhas);
    echo $linhas."\n";

    // Acrescenta registro vendas
    $linhas = $venda->registro_vendas($xml->vendas->sap_mae, $xml->vendas->sap_filial, $xml->vendas->numero_nf, $xml->vendas->tipo_transacao, $xml->vendas->data_doc, $xml->vendas->cgc_cpf_distribuidor, $xml->vendas->cod_vendedor, $xml->vendas->dun_produto, $xml->vendas->qntd_vendida, $xml->vendas->vlr_faturado);
    file_put_contents('arquivos/BZL_FACT_NC_10908092005.txt', $linhas); 
    echo $linhas."\n";

    // Acrescenta registro prdutividade
    $linhas = $produtividade->registro_produtividade($xml->produtividade->sap_mae, $xml->produtividade->sap_filial, $xml->produtividade->data_visitas, $xml->produtividade->cod_vendedor, $xml->produtividade->visitas_dia, $xml->produtividade->visitas_com_vendas);
    file_put_contents('arquivos/BZL_PROD_NC_10908092005.txt', $linhas);
    echo $linhas."\n";

    // Acrescenta registro inventario
    $linhas = $inventario->registro_inventarios($xml->inventario->sap_mae, $xml->inventario->sap_filial, $xml->inventario->dun_produto, $xml->inventario->qntd_fisica, $xml->inventario->qntd_transito, $xml->inventario->data_leitura);
    file_put_contents('arquivos/BZL_FACTSINV_NC_10908092005.txt', $linhas);
    echo $linhas."\n";

} catch (Exception $e) {
    echo 'ERRO: ' .$e->getMessage();
}