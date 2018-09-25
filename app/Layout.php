<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - LAYOUT                                |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Layout.php                                               |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 02-08-2018                                               |
 * |                                                                       |
 * | Objetivo...: Gerar linhas com os Campos conform layout                |
 * |                                                                       |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 * | Versões....:                                                          |
 * |                                                                       |
 * |                                                                       |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 */

namespace App;

use App\Campo;


/**
 * Layout
 *
 * @version    1.0
 * @package    APP
 * @author     Helder Afonso de Morais
 * @copyright  Copyright (c) 2018 php-edi
 */
class Layout
{
    private $campos;

    public function adiciona(Campo $campo)
    {
        $this->campos[] = $campo;
    }

    public function __construct()
    {
        $this->campos = NULL;
    }

    /**
     * Verifica campo tamanho e conteudo e retorna formatado
     * @param $ordem  - Ordem do campo no layout
     * @param $descrição Request
     * @param $conteudo Request
     * @param $tipo Request
     * @param $tamanho Request
     * @param $obrigatorio FALSE
     * @param $preenchimento ESPAÇO
     * @param $lado STR_PAD_RIGHT
     */
    public function gera_linha()

    {
        #var_dump($this->campos);
        #exit;
        $linha = '';
        foreach($this->campos as $campo) {
            // formata campo conforme parametros
            $linha .= $campo->formatado.DELIMITADOR;
            
        }
        return $linha;
    }
}
