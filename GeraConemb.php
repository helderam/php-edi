<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - GERA LAYOUT PROCEDA/CONEMB            |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: GeraProceda.php                                          |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Gerar todos os registros conforme Layout PROCEDA/CONEMB. |
 * |              Os dados devem estar no arquivo dados/conemb.xml         | 
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

// Delimitador
const DELIMITADOR = '';

// Tamanho da linha
const TAMANHO = 350;

// Tipo de campo A/N
const NUMERICO = 'N';
const ALFA = 'A';

require_once "vendor/autoload.php";

use App\Proceda\Conemb;

try {
    // Variavel memória de todas as linhas
    $linhas = '';

    // Instancia objeto DOCCOB
    $conemb = new Conemb();


    // Obtem os dados de arquivo XML: dados/proceda.xml
    $xml = simplexml_load_file('dados/conemb.xml');

    // Acrescenta registro 000
    $linhas = $conemb->registro_000($xml->remetente, $xml->destinatario, $xml->data, $xml->hora, $xml->intercambio, TAMANHO);

    foreach ($xml->documentos->sequencia as $documento) {
        // Acrescenta registro 520
        $linhas .= $conemb->registro_520($documento->documento, TAMANHO);
        // Acrescenta registro 521
        $linhas .= $conemb->registro_521($documento->transportadora->cnpj, $documento->transportadora->razao, TAMANHO);
        // Acrescenta registro 522
        $linhas .= $conemb->registro_522($documento->embarcados->filial_emissora, $documento->embarcados->serie_conhecimento, $documento->embarcados->numero_conhecimento, $documento->embarcados->data_emissao, $documento->embarcados->condicao_frete, $documento->embarcados->cnpj_local, $documento->embarcados->cnpj_emissor_nf, $documento->embarcados->cnpj_destino_conhecimento_devolucao, $documento->embarcados->cnpj_destinatario_notas, $documento->embarcados->cnpj_consignatario, $documento->embarcados->codigo_fiscal, $documento->embarcados->placa_veiculo, $documento->embarcados->numero_romaneio, $documento->embarcados->numero_sap1, $documento->embarcados->numero_sap2, $documento->embarcados->numero_sap3, $documento->embarcados->identificacao_autorizacao_carregamento, $documento->embarcados->chave_consulta, $documento->embarcados->protocolo, $documento->embarcados->codigo_chave_acesso, $documento->embarcados->filial_emissora_conhecimento, $documento->embarcados->serie_conhecimento_transportadora, $documento->embarcados->numero_conhecimento_transportadora, $documento->embarcados->tipo_transporte, $documento->embarcados->tipo_conhecimento, $documento->embarcados->tipo_frete, $documento->embarcados->acao_documento, $documento->embarcados->frete_diferenciado, $documento->embarcados->tabela_frete, $documento->embarcados->carga_rapida, $documento->embarcados->uf_embarcador, $documento->embarcados->uf_emissor, $documento->embarcados->uf_destinatario, TAMANHO);
        // Acrescenta registro 523
        $linhas .= $conemb->registro_523($documento->vlr_conhecimento->qntd_tot_volume, $documento->vlr_conhecimento->peso_bruto, $documento->vlr_conhecimento->peso_cubado, $documento->vlr_conhecimento->peso_densidade, $documento->vlr_conhecimento->valor_frete_total, $documento->vlr_conhecimento->valor_frete_peso, $documento->vlr_conhecimento->frete_valor, $documento->vlr_conhecimento->frete_ad_valorem, $documento->vlr_conhecimento->valor_sec, $documento->vlr_conhecimento->valor_itr, $documento->vlr_conhecimento->valor_despacho, $documento->vlr_conhecimento->valor_pedagio, $documento->vlr_conhecimento->valor_ademe_gris, $documento->vlr_conhecimento->valor_total_despesa_extra, $documento->vlr_conhecimento->valor_desconto_ou_acrescimo, $documento->vlr_conhecimento->indicador_desconto_ou_acrescimo, $documento->vlr_conhecimento->base_calculo_apuracao_icms, $documento->vlr_conhecimento->taxa_icms, $documento->vlr_conhecimento->valor_icms, $documento->vlr_conhecimento->substituicao_tributaria, $documento->vlr_conhecimento->base_calculo_icms_subst_tributaria, $documento->vlr_conhecimento->taxa_icms_subst_tributaria, $documento->vlr_conhecimento->valor_icms_subst_tributaria, $documento->vlr_conhecimento->base_calculo_iss, $documento->vlr_conhecimento->taxa_iss, $documento->vlr_conhecimento->valor_iss, $documento->vlr_conhecimento->valor_ir, $documento->vlr_conhecimento->direito_fiscal, $documento->vlr_conhecimento->tipo_imposto, TAMANHO);
        // Acrescenta registro 524
        $linhas .= $conemb->registro_524($documento->componente_conhecimento->cnpj, $documento->componente_conhecimento->numero_nf, $documento->componente_conhecimento->serie, $documento->componente_conhecimento->data_emissao, $documento->componente_conhecimento->valor_nf, $documento->componente_conhecimento->otde_total, $documento->componente_conhecimento->peso_bruto, $documento->componente_conhecimento->peso_densidade, $documento->componente_conhecimento->peso_cubado, $documento->componente_conhecimento->identificacao_pedido, $documento->componente_conhecimento->numero_romaneio, $documento->componente_conhecimento->numero_sap1, $documento->componente_conhecimento->numero_sap2, $documento->componente_conhecimento->numero_sap3, $documento->componente_conhecimento->nf_devolucao, $documento->componente_conhecimento->tipo_nf, $documento->componente_conhecimento->indicacao_bonificacao, $documento->componente_conhecimento->cfop, $documento->componente_conhecimento->uf, $documento->componente_conhecimento->desdobro, TAMANHO);
        // Acrescenta registro 525
        $linhas .= $conemb->registro_525($documento->dados_entrega->cnpj1, $documento->dados_entrega->razao1, $documento->dados_entrega->serie1, $documento->dados_entrega->numero_nf1, $documento->dados_entrega->cnpj2, $documento->dados_entrega->razao2, $documento->dados_entrega->serie2, $documento->dados_entrega->numero_nf2, $documento->dados_entrega->cnpj3, $documento->dados_entrega->razao3, $documento->dados_entrega->serie3, $documento->dados_entrega->numero_nf3, $documento->dados_entrega->redespacho_filial_emissora, $documento->dados_entrega->redespacho_serie_conhecimento, $documento->dados_entrega->redespacho_numero_conhecimento, $documento->dados_entrega->redespacho_cnpj_transportadora, TAMANHO);
        // Acrescenta registro 527
        $linhas .= $conemb->registro_527($documento->dados_consignatario->razao, $documento->dados_consignatario->cnpj, $documento->dados_consignatario->inscricao_estadual, $documento->dados_consignatario->endereco, $documento->dados_consignatario->bairro, $documento->dados_consignatario->cidade, $documento->dados_consignatario->codigo_postal, $documento->dados_consignatario->codigo_municipio, $documento->dados_consignatario->uf, $documento->dados_consignatario->numero_comunicacao, TAMANHO);
        // Acrescenta registro 529
        $linhas .= $conemb->registro_529($documento->final->qntd_total_conhecimentos, $documento->final->valor_total_conhecimentos, TAMANHO);

    }
    // Mostra resultado
    file_put_contents('arquivos/conemb.txt', $linhas);
    echo "<pre><br>\n";
    echo $linhas;

} catch (Exception $e) {
    echo 'ERRO: ' .$e->getMessage();
}
