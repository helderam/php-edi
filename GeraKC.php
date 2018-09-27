<?php

/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - GERA LAYOUT KIMBERLY CLARK            |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: GeraKC.php                                               |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 23-09-2018                                               |
 * |                                                                       |
 * | Objetivo...: Gerar todos os registros conforme Layout KimberlyClark.  |
 * |              Os dados devem estar no arquivo dados/KimberlyClark.xml  | 
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

const DELIMITADOR = '';
const PREENCHIMENTO = ' ';

require_once "vendor/autoload.php";

use App\Kimberly_Clark\Estoque;
use App\Kimberly_Clark\Sellout;

try {
    // Variavel memória de todas as linhas
    $linhas = '';

    // Instancia objetos
    $estoque = new Estoque();
    $sellout = new Sellout();


    // Obtem os dados de arquivo XML: dados/proceda.xml
    $xml = simplexml_load_file('dados/KimberlyClark.xml');

    // Acrescenta registro
    $linhas = $estoque->header_estoque($xml->cod_sap)."\n";

    $linhas .= $estoque->detalhe_estoque($xml->cod_sap, $xml->ean, $xml->cod_interno, $xml->sku, $xml->estoque_fisico, $xml->estoque_transito, $xml->estoque_reservado, $xml->estoque_total);
    file_put_contents('arquivos/ESTOQUE_00000000_20150701.txt', $linhas);
    echo $linhas."\n";
    echo "\n\n";

    
    $linhas = $sellout->header_sellout($xml->cod_sap, $xml->sellout->data)."\n";
    
    $linhas .= $sellout->detalhe_sellout($xml->sellout->cod_sap_dist, $xml->sellout->cod_sap_ent, $xml->sellout->cod_cliente, $xml->sellout->nome_cliente, $xml->sellout->cnpj_cliente_indireto, $xml->sellout->cpf_cliente_indireto, $xml->sellout->endereco, $xml->sellout->cep, $xml->sellout->estado, $xml->sellout->bairro, $xml->sellout->municipio, $xml->sellout->telefone, $xml->sellout->pais, $xml->sellout->contato, $xml->sellout->tipo_negocio, $xml->sellout->zona_estabelecida_distribuidor, $xml->sellout->representante_distribuidor, $xml->sellout->nome_representante, $xml->sellout->cod_produto_atacado, $xml->sellout->cod_ean, $xml->sellout->cod_sap_produto, $xml->sellout->venda_qntd, $xml->sellout->valor_venda, $xml->sellout->preco_unitario, $xml->sellout->tipo_moeda, $xml->sellout->data_faturamento, $xml->sellout->data_entrega, $xml->sellout->tipo_documento, $xml->sellout->cod_documento, $xml->sellout->unidade_medida_qntd, $xml->sellout->numerador_conversao_qntd_unidade, $xml->sellout->denominador_conversor_qntd_unidade, $xml->sellout->unidade_medida_preco, $xml->sellout->numerador_conversao_preco_unidade, $xml->sellout->denominador_conversor_preco_unidade, $xml->sellout->data_fim_periodo_reportado, $xml->sellout->data_transmissao_informacao, $xml->sellout->numero_transmissao, $xml->sellout->cpf_representante_vendas_atacado, $xml->sellout->chave_acesso);
    file_put_contents('arquivos/SELLOUT_CodigoFIA_AAAAMMDD.txt', $linhas);
    echo $linhas."\n";

} catch (Exception $e) {
    echo 'ERRO: ' .$e->getMessage();
}