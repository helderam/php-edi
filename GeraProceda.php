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

// Tipo de campo
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
    $xml = simplexml_load_file('dados/proceda.xml');

    // Acrescenta registro 000
    $linhas = $doccob->registro_000($xml->remetente, $xml->destinatario, $xml->data, $xml->hora, $xml->intercambio, TAMANHO);

    foreach ($xml->documentos->sequencia as $documento) {
        // Acrescenta registro 550
        $linhas .= $doccob->registro_550($documento->documento, TAMANHO);
        // Acrescenta registro 550
        $linhas .= $doccob->registro_551($documento->cnpj, $documento->razao, TAMANHO);
    }
    // Mostra resultado
    echo "<pre><br>\n";
    echo $linhas;

} catch (Exception $e) {
    echo 'ERRO: ' .$e->getMessage();
}
