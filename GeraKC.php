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

use App\Kimberly_Clark\Estoque;

try {
    // Variavel memória de todas as linhas
    $linhas = '';

    // Instancia objetos
    $estoque = new Estoque();


    // Obtem os dados de arquivo XML: dados/proceda.xml
    $xml = simplexml_load_file('dados/KC.xml');

    // Acrescenta registro clientes
    $linhas = $cliente->header($xml->cod_sap);

    $linhas .= $cliente->descricao($xml->cliente->sap_mae, $xml->cliente->sap_filial, $xml->cliente->cgc_cpf, $xml->cliente->razao, $xml->cliente->ramo, $xml->cliente->endereco, $xml->cliente->bairro, $xml->cliente->cidade, $xml->cliente->estado, $xml->cliente->cep, $xml->cliente->telefone, $xml->cliente->setor, $xml->cliente->numero);
    file_put_contents('arquivos/KC.txt', $linhas);
    echo $linhas."\n";

} catch (Exception $e) {
    echo 'ERRO: ' .$e->getMessage();
}