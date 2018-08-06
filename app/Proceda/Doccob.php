<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - LAYOUT DOCCOB                         |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Doccob.php                                               |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Formatar registros conforme Layout DOCCOB                | 
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

namespace App\Proceda;

use App\Layout;
use App\Campo;

/**
 * Doccob
 *
 * @version    1.0
 * @package    proceda
 * @author     Helder Afonso de Morais
 * @copyright  Copyright (c) 2018 php-edi
 */
class Doccob
{

    var $conta_000 = 0;
    var $conta_550 = 0;
    var $conta_551 = 0;
    var $conta_552 = 0;

    /**
     * Formata campos recebidos para registro 000
     * @param $remetente Request
     * @param $destinatario Request
     * @param $data Request
     * @param $hora Request
     * @param $intercambio Request
     * @param $tamanho Request
     */
    public function registro_000($remetente, $destinatario, $data, $hora, $intercambio, $tamanho)
    {
        // Zera contador de 550 - ocorre até 200 para cada 000
        $this->conta_550 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 0, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'IDENTIFICAÇÃO DO REMETENTE', $remetente, ALFA, 35, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'IDENTIFICAÇÃO DO DESTINATARIO', $destinatario, ALFA, 35, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'DATA', $data, ALFA, 6, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'HORA', $hora, ALFA, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'INTERCAMBIO', 'COB502906001', ALFA, 12, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'ESPAÇO',' ', ALFA, 185, OBRIGATORIO)); 


        // Monta linha com os dados informados conferindo e validando os campos
        $linha = $layout->gera_linha();
        var_dump($linha); exit;
        
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 000 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_000++;

        // Verifica se tem mais de 1 registro 000
        if ($this->conta_000 > 1) {
          throw new Exception("REGISTRO 000 OCORRE MAIS DE 1 VEZ");
        }

        // Devolve a linha formatada conforme leyout
        return $linha."\n";
    }

    /**
     * Formata campos recebidos para registro 550
     * @param $documento Request
     * @param $tamanho Request
     */
    public function registro_550($documento, $tamanho)
    {
        // Zera contador de 551 - ocorre 1 para cada 550
        $this->conta_551 = 0;

        // 1 - IDENTIFICADOR DO REGISTRO - SEMPRE 550
        $linha = '550';
        /* 2 - IDENTIFICAÇÃO DO DOCUMENTO
           SUGESTÃO: "COB50DDMMSSS"
                     "COB50" = CONSTANTE COBrança+VERSÃO 50
                     "DDMM” = DIA/MÊS
                     "SSS" = SEQUÊNCIA DE 001 A 2000
        */
        $linha .= ValidaCampo::validar('DOCUMENTO', $documento, 14, OBRIGATORIO);

        // 3 - PREENCHER COM ESPAÇOS 
        $linha .= ValidaCampo::validar('ESPAÇO',' ', 263, OBRIGATORIO); 

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 550 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_550++;

        // Verifica se tem mais de 1 registro 000
        if ($this->conta_550 > 200) {
          throw new Exception("REGISTRO 550 OCORRE MAIS DE 200 VEZES");
        }

        // Devolve a linha formatada conforme leyout
        return $linha."\n";
    }

    /**
     * Formata campos recebidos para registro 551
     * @param $cnpj Request
     * @param $razao Request
     * @param $tamanho Request
     */
    public function registro_551($cnpj, $razao, $tamanho)
    {
        // Zera contador de 552 - ocorre ate 500 para cada 551
        $this->conta_552 = 0;
        
        // 1 - IDENTIFICADOR DO REGISTRO - SEMPRE 551
        $linha = '551';

        // 2 - CNPJ TRANSPORTADORA
        $linha .= ValidaCampo::validar('CNPJ', $cnpj, 14, OBRIGATORIO);

        // 3 - RAZAO SOCIAL 
        $linha .= ValidaCampo::validar('RAZAO SOCIAL', $razao, 50, OBRIGATORIO); 

        // 4 - PREENCHER COM ESPAÇOS 
        $linha .= ValidaCampo::validar('ESPAÇO',' ', 213, OBRIGATORIO); 

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 551 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_551++;

        // Verifica se tem mais de 1 registro 000
        if ($this->conta_551 > 1) {
          throw new Exception("REGISTRO 551 OCORRE MAIS DE 1 VEZES");
        }

        // Devolve a linha formatada conforme leyout
        return $linha."\n";
    }

    /**
     * Formata campos recebidos para registro 552
     * @param $cnpj Request
     * @param $razao Request
     * @param $tamanho Request
     */
    public function registro_552($filial, $tipo, $serie, $numero, $emissao, 
        $vencimento, $valor, $tipo_cobranca, $multa, $juros, $limite, $desconto, $agente, 
        $nome, $agencia, $digito, $conta, $digito_conta, $acao, $pre_fatura, $complementar, 
        $cfop, $codigo, $chave, $protocolo, $tamanho)
    {
        // Zera contador de 553 - ocorre 1 para cada 552
        $this->conta_553 = 0;
        
        // 1 - IDENTIFICADOR DO REGISTRO - SEMPRE 551
        $linha = '552';

        // 2 - FILIAL EMISSORA
        $linha .= ValidaCampo::validar('FILIAL', $filial, 10, OBRIGATORIO);

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 4 - SERIE
        $linha .= ValidaCampo::validar('SERIE', $serie, 3, OBRIGATORIO); 

        // 5 - NUMERO
        $linha .= ValidaCampo::validar('NUMERO', $numero, 10, OBRIGATORIO); 

        // 6 - DATA EMISSÃO
        $linha .= ValidaCampo::validar('DATA EMISSÃO', $emissao, 8, OBRIGATORIO); 





        
        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 3 - TIPO DOCUMENTO
        $linha .= ValidaCampo::validar('TIPO', $tipo, 1, OBRIGATORIO); 

        // 4 - PREENCHER COM ESPAÇOS 
        $linha .= ValidaCampo::validar('ESPAÇO',' ', 213, OBRIGATORIO); 

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 551 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_551++;

        // Verifica se tem mais de 1 registro 000
        if ($this->conta_551 > 1) {
          throw new Exception("REGISTRO 551 OCORRE MAIS DE 1 VEZES");
        }

        // Devolve a linha formatada conforme leyout
        return $linha."\n";
    }


}
