<?php

require_once "vendor/autoload.php";

use App\Proceda\Doccob;

$linhas = '';
$doccob = new Doccob();

// Obtem os dados de arquivo XML: dados/proceda.xml
$arquivo_xml = simplexml_load_file('dados/proceda.xml');
var_dump($arquivo_xml);
exit;

$linhas .= $doccob->registro_000();



var_dump($dc);
