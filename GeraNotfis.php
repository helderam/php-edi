<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - GERA LAYOUT PROCEDA/NOTFIS            |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: GeraNotfis.php                                           |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Gerar todos os registros conforme Layout PROCEDA/NOTFIS. |
 * |              Os dados devem estar no arquivo dados/notfis.xml         | 
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
const TAMANHO = 320;

// Tipo de campo A/N
const NUMERICO = 'N';
const ALFA = 'A';

require_once "vendor/autoload.php";

use App\Proceda\Notfis;

try {
    // Variavel memória de todas as linhas
    $linhas = '';

    // Instancia objeto DOCCOB
    $notfis = new Notfis();


    // Obtem os dados de arquivo XML: dados/proceda.xml
    $xml = simplexml_load_file('dados/notfis.xml');

    // Acrescenta registro 000
    $linhas = $notfis->registro_000($xml->remetente, $xml->destinatario, $xml->data, $xml->hora, $xml->intercambio, TAMANHO);

    foreach ($xml->documentos->sequencia as $documento) {
        // Acrescenta registro 500
        $linhas .= $notfis->registro_500($documento->documento, TAMANHO);
        // Acrescenta registro 501
        $linhas .= $notfis->registro_501($documento->documento, $documento->cnpj, $documento->insc_embarq, $documento->insc_subs_tribut, $documento->insc_muni, $documento->endereco, $documento->bairro, $documento->cidade, $documento->cod_postal, $documento->cod_municipio, $documento->uf, $documento->data_embarque, $documento->area_frete, $documento->contato_emerg, TAMANHO);
        // Acrescenta registro 502
        $linhas .= $notfis->registro_502($documento->coleta->razao, $documento->coleta->cnpj, $documento->coleta->endereco, $documento->coleta->bairro, $documento->coleta->cidade, $documento->coleta->cod_postal, $documento->coleta->cod_municipio, $documento->coleta->uf, $documento->coleta->numero_contato, $documento->coleta->area_frete, TAMANHO);
        // Acrescenta registro 503
        $linhas .= $notfis->registro_503($documento->destinatario_nota->razao, $documento->destinatario_nota->cnpj, $documento->destinatario_nota->insc_estadual, $documento->destinatario_nota->insc_suframa, $documento->destinatario_nota->endereco, $documento->destinatario_nota->bairro, $documento->destinatario_nota->cidade, $documento->destinatario_nota->cod_postal, $documento->destinatario_nota->cod_municipio, $documento->destinatario_nota->uf, $documento->destinatario_nota->numero_contato, $documento->destinatario_nota->cod_pais, $documento->destinatario_nota->area_frete, $documento->destinatario_nota->tipo_identificacao_dest, $documento->destinatario_nota->tipo_estabelecimento_dest, TAMANHO);
        // Acrescenta registro 504
        $linhas .= $notfis->registro_504($documento->entrega->razao, $documento->entrega->cnpj, $documento->entrega->insc_estadual, $documento->entrega->endereco, $documento->entrega->bairro, $documento->entrega->cidade, $documento->entrega->cod_postal, $documento->entrega->cod_municipio, $documento->entrega->uf, $documento->entrega->numero_contato, $documento->entrega->cod_pais, $documento->entrega->area_frete, $documento->entrega->tipo_identificacao_dest, $documento->entrega->tipo_estabelecimento_dest, TAMANHO);
        // Acrescenta registro 505
        $linhas .= $notfis->registro_505($documento->dados_nf->serie, $documento->dados_nf->numero, $documento->dados_nf->data, $documento->dados_nf->tipo, $documento->dados_nf->especie_acond, $documento->dados_nf->cod_rota, $documento->dados_nf->meio_transporte, $documento->dados_nf->tipo_transporte, $documento->dados_nf->tipo_carga, $documento->dados_nf->condicao_frete, $documento->dados_nf->data_embarque, $documento->dados_nf->desdobro, $documento->dados_nf->plano_cargarapida, $documento->dados_nf->tipo_doc_fiscal, $documento->dados_nf->bonificacao, $documento->dados_nf->cfop, $documento->dados_nf->uf, $documento->dados_nf->frete_diferenciado, $documento->dados_nf->tabela_frete, $documento->dados_nf->modalidade_frete, $documento->dados_nf->identf_pedido_cliente, $documento->dados_nf->identf_embarque, $documento->dados_nf->numero_sap, $documento->dados_nf->outro_sap, $documento->dados_nf->outro_sap1, $documento->dados_nf->tipo_periodo_entrega, $documento->dados_nf->data_init_entrega, $documento->dados_nf->hora_init_entrega, $documento->dados_nf->data_final_entrega, $documento->dados_nf->hora_final_entrega, $documento->dados_nf->cod_numerico_chaveacesso_nfe, $documento->dados_nf->chaveacesso_nfe_dv, $documento->dados_nf->numero_protocolo, $documento->dados_nf->acao_doc, TAMANHO);
        // Acrescenta registro 506
        $linhas .= $notfis->registro_506($documento->valores_nf->otde_tot, $documento->valores_nf->pesobruto_tot, $documento->valores_nf->pesoliqui_tot, $documento->valores_nf->peso_densidade, $documento->valores_nf->peso_cubado, $documento->valores_nf->incidencia_icms, $documento->valores_nf->seguro_efetuado, $documento->valores_nf->valor_cliente, $documento->valores_nf->valor_tot_nota, $documento->valores_nf->valor_tot_seguro, $documento->valores_nf->valor_tot_desconto, $documento->valores_nf->valor_tot_outrasdispensas, $documento->valores_nf->calculo_icms, $documento->valores_nf->valor_tot_icms, $documento->valores_nf->calculo_icms_subst_tributaria, $documento->valores_nf->valor_tot_icms_subst_tributaria, $documento->valores_nf->valor_icms_retido, $documento->valores_nf->valor_tot_imposto_importacao, $documento->valores_nf->valor_ipi, $documento->valores_nf->valor_pis, $documento->valores_nf->valor_cofins, $documento->valores_nf->valor_calculado_frete, $documento->valores_nf->valor_tot_icms_frete, $documento->valores_nf->valor_tot_icms_subst_tributaria_frete, $documento->valores_nf->valor_tot_iss_frete, TAMANHO);
        // Acrescenta registro 507
        $linhas .= $notfis->registro_507($documento->calc_frete->qntd_total_volumes_embalagens, $documento->calc_frete->peso_total_transportado, $documento->calc_frete->peso_cubado, $documento->calc_frete->peso_densidade, $documento->calc_frete->valor_tot_frete, $documento->calc_frete->valor_frete_peso, $documento->calc_frete->frete_valor, $documento->calc_frete->frete_ad_valorem, $documento->calc_frete->valor_sec_cat, $documento->calc_frete->valor_itr_gris, $documento->calc_frete->valor_despacho, $documento->calc_frete->valor_pedagio, $documento->calc_frete->valor_ademe_gris, $documento->calc_frete->valor_despesas_extras, $documento->calc_frete->base_calculo_apuracao_icms_frete, $documento->calc_frete->taxa_icms_frete, $documento->calc_frete->valor_icms_frete, $documento->calc_frete->subst_tributaria, $documento->calc_frete->base_calculo_icms_subst_tributaria, $documento->calc_frete->taxa_icms_subst_tributaria, $documento->calc_frete->valor_icms_subst_tributaria, $documento->calc_frete->base_calculo_iss, $documento->calc_frete->taxa_iss, $documento->calc_frete->valor_tot_iss, $documento->calc_frete->valor_tot_ir, $documento->calc_frete->direito_fiscal, $documento->calc_frete->taxa_imposto, $documento->calc_frete->uf, TAMANHO);
        // Acrescenta registro 508
        $linhas .= $notfis->registro_508($documento->indentf_cargas->marca_volumes, $documento->indentf_cargas->num_volumes_transportados, $documento->indentf_cargas->num_lacres, TAMANHO);
        // Acrescenta registro 509
        $linhas .= $notfis->registro_509($documento->dados_entrega->cnpj1, $documento->dados_entrega->nome1, $documento->dados_entrega->serie1, $documento->dados_entrega->numero1, $documento->dados_entrega->cnpj2, $documento->dados_entrega->nome2, $documento->dados_entrega->serie2, $documento->dados_entrega->numero2, $documento->dados_entrega->cnpj3, $documento->dados_entrega->nome3, $documento->dados_entrega->serie3, $documento->dados_entrega->numero3, $documento->dados_entrega->desp_filial_emissora_conhecimento, $documento->dados_entrega->desp_serie_conhecimento, $documento->dados_entrega->desp_numero_conhecimento, $documento->dados_entrega->desp_cnpj_transp_contratante, TAMANHO);
        // Acrescenta registro 511
        $linhas .= $notfis->registro_511($documento->item_nf->qntd_volume, $documento->item_nf->especie_acond, $documento->item_nf->cod_item_nf, $documento->item_nf->desc_item_nf, $documento->item_nf->cfop_item, $documento->item_nf->lote_item, $documento->item_nf->data_validade_item, $documento->item_nf->marca_volumes_transportados, $documento->item_nf->num_volumes_transportados, $documento->item_nf->num_lacres, $documento->item_nf->identf_pedido_cliente, TAMANHO);
        // Acrescenta registro 513
        $linhas .= $notfis->registro_513($documento->dado_consignado->documento, $documento->dado_consignado->cnpj, $documento->dado_consignado->insc_estadual, $documento->dado_consignado->endereco, $documento->dado_consignado->bairro, $documento->dado_consignado->cidade, $documento->dado_consignado->cod_postal, $documento->dado_consignado->cod_municipio, $documento->dado_consignado->uf, $documento->dado_consignado->numero_contato, TAMANHO);
        // Acrescenta registro 514
        $linhas .= $notfis->registro_514($documento->dado_redespacho->documento, $documento->dado_redespacho->cnpj, $documento->dado_redespacho->insc_estadual, $documento->dado_redespacho->endereco, $documento->dado_redespacho->bairro, $documento->dado_redespacho->cidade, $documento->dado_redespacho->cod_postal, $documento->dado_redespacho->cod_municipio, $documento->dado_redespacho->uf, $documento->dado_redespacho->numero_contato, $documento->dado_redespacho->area_frete, TAMANHO);
        // Acrescenta registro 515
        $linhas .= $notfis->registro_515($documento->dado_frete->documento, $documento->dado_frete->cnpj, $documento->dado_frete->insc_estadual, $documento->dado_frete->endereco, $documento->dado_frete->bairro, $documento->dado_frete->cidade, $documento->dado_frete->cod_postal, $documento->dado_frete->cod_municipio, $documento->dado_frete->uf, $documento->dado_frete->numero_contato, TAMANHO);
        // Acrescenta registro 519
        $linhas .= $notfis->registro_519($documento->final->valor_tot_nf, $documento->final->peso_bruto_nf, $documento->final->qntd_tot_volumes, $documento->final->num_notas, TAMANHO);

    }
    // Mostra resultado
    file_put_contents('arquivos/notfis.txt', $linhas);
    echo "<pre><br>\n";
    echo $linhas;

} catch (Exception $e) {
    echo 'ERRO: ' .$e->getMessage();
}
