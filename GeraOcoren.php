<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - GERA LAYOUT PROCEDA/OCOREN            |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: GeraOcorren.php                                          |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Gerar todos os registros conforme Layout PROCEDA/Ocorren.|
 * |              Os dados devem estar no arquivo dados/ocoren.xml         | 
 * |                                                                       |
 * | Layout EDI.: 6.0 - 31/07/2008                                         |
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

// Tamanho da linha
const TAMANHO = 250;

// Delimitador
const DELIMITADOR = '';

// Tipo de campo A/N
const NUMERICO = 'N';
const PREENCHIMENTO = ' ';
const ALFA = 'A';

require_once "vendor/autoload.php";

use App\Proceda\Ocoren;

try {
    // Variavel memória de todas as linhas
    $linhas = '';

    // Instancia objeto DOCCOB
    $ocoren = new Ocoren();


    // Obtem os dados de arquivo XML: dados/proceda.xml
    $xml = simplexml_load_file('dados/ocoren.xml');

    // Acrescenta registro 000
    $linhas = $ocoren->registro_000($xml->remetente, $xml->destinatario, $xml->data, $xml->hora, $xml->intercambio, TAMANHO);

    foreach ($xml->documentos->sequencia as $documento) {
        // Acrescenta registro 540
        $linhas .= $ocoren->registro_540($documento->documento, TAMANHO);
        // Acrescenta registro 541
        $linhas .= $ocoren->registro_541($documento->cnpj, $documento->razao, TAMANHO);
        // Acrescenta registro 542
        $linhas .= $ocoren->registro_542($documento->ocorr_entrega->cnpj_emissor_nf, $documento->ocorr_entrega->serie_nf, $documento->ocorr_entrega->numero_nf, $documento->ocorr_entrega->codigo_ocorrencia_entrega, $documento->ocorr_entrega->data_ocorrencia, $documento->ocorr_entrega->hora_ocorrencia, $documento->ocorr_entrega->cod_observacao_ocorrencia_entrada, $documento->ocorr_entrega->numero_romaneio_identf_embarque, $documento->ocorr_entrega->identf_carga1, $documento->ocorr_entrega->identf_carga2, $documento->ocorr_entrega->identf_carga3, $documento->ocorr_entrega->filial_emissora_conhecimento, $documento->ocorr_entrega->serie_conhecimento, $documento->ocorr_entrega->numero_conhecimento, $documento->ocorr_entrega->indicacao_tipo_entrega, $documento->ocorr_entrega->codigo_empresa_emissora_nf, $documento->ocorr_entrega->codigo_filial_empresa_emissora_nf, $documento->ocorr_entrega->data_chegada_nf, $documento->ocorr_entrega->hora_chegada_nf, $documento->ocorr_entrega->data_inicio_descarregamento_destino, $documento->ocorr_entrega->hora_inicio_descarregamento_destino, $documento->ocorr_entrega->data_termino_descarregamento_destino, $documento->ocorr_entrega->hora_termino_descarregamento_destino, $documento->ocorr_entrega->data_saida_destino_nf, $documento->ocorr_entrega->hora_saida_destino_nf, $documento->ocorr_entrega->cnpj_emissor_nf_devolucao, $documento->ocorr_entrega->serie_nf_devolucao, $documento->ocorr_entrega->numero_nf_devolucao, TAMANHO);
        // Acrescenta registro 543
        $linhas .= $ocoren->registro_543($documento->texto_complementar->texto_livre1, $documento->texto_complementar->texto_livre2, $documento->texto_complementar->texto_livre3, TAMANHO);
        // Acrescenta registro 544
        $linhas .= $ocoren->registro_544($documento->dados_item_nf->qntd_volumes_nf, $documento->dados_item_nf->qntd_volumes_entregues, $documento->dados_item_nf->cod_item_nf, $documento->dados_item_nf->descricao_item_nf, TAMANHO);
        /// Acrescenta registro 545
        $linhas .= $ocoren->registro_545($documento->ocorr_despacho->cnpj_empresa_frete, $documento->ocorr_despacho->cnpj_empresa_emissora_ocorrencia, $documento->ocorr_despacho->filial_emissor_ocorrencia, $documento->ocorr_despacho->serie_conhecimento_ocorrencia, $documento->ocorr_despacho->numero_conhecimento_ocorrencia, TAMANHO);
        // Acrescenta registro 549
        $linhas .= $ocoren->registro_549($documento->final->numero_ocorrencias, TAMANHO);

    }
    // Mostra resultado
    file_put_contents('arquivos/ocoren.txt', $linhas);
    echo "<pre><br>\n";
    echo $linhas;

} catch (Exception $e) {
    echo 'ERRO: ' .$e->getMessage();
}
