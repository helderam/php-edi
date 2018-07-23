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
    $linhas .= $doccob->registro_000($xml->remetente, $xml->destinatario, $xml->data, $xml->hora, $xml->intercambio, 280);

    // Mostra resultado
    var_dump($linhas);

} catch (Exception $e) {
    echo 'ERRO: ' .$e->getMessage();
}
