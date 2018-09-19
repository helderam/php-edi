<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - GERA LAYOUT PROCEDA                   |
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
 * | Objetivo...: Gerar todos os registros conforme Layout PROCEDA. Os     |
 * |              dados devem estar no arquivo dados/proceda.xml           | 
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
const TAMANHO = 280;

// Delimitador
const DELIMITADOR = '';

// Tipo de campo A/N
const NUMERICO = 'N';
const ALFA = 'A';

require_once "vendor/autoload.php";

use App\Proceda\Doccob;

try {
    // Variavel memória de todas as linhas
    $linhas = '';

    // Instancia objeto DOCCOB
    $doccob = new Doccob();


    // Obtem os dados de arquivo XML: dados/proceda.xml
    $xml = simplexml_load_file('dados/doccob.xml');

    // Acrescenta registro 000
    $linhas = $doccob->registro_000($xml->remetente, $xml->destinatario, $xml->data, $xml->hora, $xml->intercambio, TAMANHO);

    foreach ($xml->documentos->sequencia as $documento) {
        // Acrescenta registro 550
        $linhas .= $doccob->registro_550($documento->documento, TAMANHO);
        // Acrescenta registro 551
        $linhas .= $doccob->registro_551($documento->cnpj, $documento->razao, TAMANHO);
        // Acrescenta registro 552
        $linhas .= $doccob->registro_552($documento->cobranca->filial, $documento->cobranca->tipo,$documento->cobranca->serie, $documento->cobranca->numero, $documento->cobranca->emissao, $documento->cobranca->vencimento, $documento->cobranca->valor, $documento->cobranca->tipo_cobranca, $documento->cobranca->multa, $documento->cobranca->juros, $documento->cobranca->limite, $documento->cobranca->desconto, $documento->cobranca->agente, $documento->cobranca->nome, $documento->cobranca->agencia, $documento->cobranca->digito, $documento->cobranca->conta, $documento->cobranca->digito_conta, $documento->cobranca->acao, $documento->cobranca->pre_fatura, $documento->cobranca->complementar, $documento->cobranca->cfop, $documento->cobranca->codigo, $documento->cobranca->chave, $documento->cobranca->protocolo, TAMANHO);
        // Acrescenta registro 553
        $linhas .= $doccob->registro_553($documento->cobranca->imposto->valorICMS, $documento->cobranca->imposto->aliquotaICMS, $documento->cobranca->imposto->baseICMS, $documento->cobranca->imposto->valorISS, $documento->cobranca->imposto->aliquotaISS, $documento->cobranca->imposto->baseISS, $documento->cobranca->imposto->valorSUBS, $documento->cobranca->imposto->aliquotaSUBS, $documento->cobranca->imposto->baseSUBS, $documento->cobranca->imposto->valorIR, TAMANHO);
        // Acrescenta registro 555
        $linhas .= $doccob->registro_555($documento->fatura->filial, $documento->fatura->serie, $documento->fatura->numero, $documento->fatura->valor, $documento->fatura->emissao, $documento->fatura->remetente, $documento->fatura->destinatario, $documento->fatura->emissor_do_conhecimento, $documento->fatura->uf_embarcador, $documento->fatura->uf_emissora, $documento->fatura->uf_destinatario, $documento->fatura->conta_razao, $documento->fatura->iva, $documento->fatura->identificacao_embarque, $documento->fatura->identificacao_carga, $documento->fatura->numero_sap, $documento->fatura->outro_sap, $documento->fatura->devolucao, TAMANHO);
        // Acrescenta registro 556
        $linhas .= $doccob->registro_556($documento->cobranca->nota_fiscal->serie, $documento->cobranca->nota_fiscal->numero, $documento->cobranca->nota_fiscal->emissao, $documento->cobranca->nota_fiscal->peso, $documento->cobranca->nota_fiscal->valor, $documento->cobranca->nota_fiscal->emissor, $documento->cobranca->nota_fiscal->identificacao_embarque, $documento->cobranca->nota_fiscal->identificacao_carga, $documento->cobranca->nota_fiscal->numero_sap, $documento->cobranca->nota_fiscal->outro_sap, $documento->cobranca->nota_fiscal->nf_devolucao, TAMANHO);
        // Acrescenta registro 559
        $linhas .= $doccob->registro_559($documento->final->qntde_total, $documento->final->valor, TAMANHO);
    }
    // Mostra resultado
    file_put_contents('arquivos/doccob.txt', $linhas);
    echo "<pre><br>\n";
    echo $linhas;

} catch (Exception $e) {
    echo 'ERRO: ' .$e->getMessage();
}
