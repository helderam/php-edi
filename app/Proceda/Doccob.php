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
    var $conta_553 = 0;
    var $conta_555 = 0;
    var $conta_556 = 0;
    var $conta_559 = 0;


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
        $layout->adiciona(new Campo(4,'DATA', $data, NUMERICO, 6, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'HORA', $hora, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'INTERCAMBIO', 'COB502906001', ALFA, 12, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'ESPACO', ' ', ALFA, 185, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
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

        // Gera linha conforme o layout
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

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 550, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'IDENTIFICAÇÃO DO DOCUMENTO', $documento, ALFA, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'ESPACO', ' ', ALFA, 263, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 550 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_550++;

        // Verifica se tem mais de 200 registro 520
        if ($this->conta_550 > 200) {
          throw new Exception("REGISTRO 550 OCORRE MAIS DE 200 VEZES");
        }
        
        // Gera linha conforme o layout
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

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 551, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'CNPJ REMETENTE', $cnpj, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'RAZAO SOCIAL', $razao, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'ESPACO', ' ', ALFA, 213, OBRIGATORIO)); 

        $linha = $layout->gera_linha();

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 551 NAO CONFERE TAMANHO DE {$tamanho} :".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_551++;

        // Verifica se tem mais de 1 registro 550
        if ($this->conta_551 > 1) {
          throw new \Exception("REGISTRO 551 OCORRE MAIS DE 1 VEZ");
        }
      
        // Gera linha conforme o layout
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
        
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 552, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'FILIAL', $filial, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'TIPO', $tipo, NUMERICO, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'SERIE', $serie, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'NUMERO', $numero, NUMERICO, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'EMISSAO', $emissao, NUMERICO, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'VENCIMENTO', $vencimento, NUMERICO, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'VALOR', $valor, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'TIPO DE COBRANCA', $tipo_cobranca, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'MULTA', $multa, NUMERICO, 2.2, OBRIGATORIO));
        $layout->adiciona(new Campo(11,'JUROS', $juros, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(12,'DATA LIMITE', $limite, NUMERICO, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(13,'DESCONTO', $desconto, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'AGENTE', $agente, NUMERICO, 5, OBRIGATORIO));
        $layout->adiciona(new Campo(15,'NOME', $nome, ALFA, 30, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'AGENCIA', $agencia, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'DIGITO', $digito, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'CONTA', $conta, NUMERICO, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(19,'DIGITO DA CONTA', $digito_conta, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(20,'ACAO', $acao, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(21,'PRE FATURA', $pre_fatura, NUMERICO, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(22,'COMPLEMENTAR', $complementar, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(23,'CFOP', $cfop, ALFA, 5, OBRIGATORIO));
        $layout->adiciona(new Campo(24,'CODIGO', $codigo, NUMERICO, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(25,'CHAVE', $chave, ALFA, 45, OBRIGATORIO));
        $layout->adiciona(new Campo(26,'PROTOCOLO', $protocolo, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(27,'ESPACO', ' ', ALFA, 20, OBRIGATORIO));


        $linha = $layout->gera_linha();

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 552 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_552++;

        // Verifica se tem mais de 500 registro 552
        if ($this->conta_552 > 500) {
          throw new \Exception("REGISTRO 552 OCORRE MAIS DE 500 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    
    /**
     * Formata campos recebidos para registro 553
     * @param $cnpj Request
     * @param $razao Request
     * @param $tamanho Request
     */

    public function registro_553($valor_icms, $aliq_icms, $base_icms, $valor_iss, $aliq_iss, 
        $base_iss, $valor_subst, $aliq_subst, $base_subst, $valor_ir, $tamanho)
    {
        // Zera contador de 555 - ocorre até 5000 para cada 552
        $this->conta_555 = 0;
        
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 553, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'VALOR_ICMS', $valor_icms, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'ALIQUOTA_ICMS', $aliq_icms, NUMERICO, 3.2, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'BASE_ICMS', $base_icms, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'VALOR_ISS', $valor_iss, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'ALIQUOTA_ISS', $aliq_iss, NUMERICO, 3.2, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'BASE_ISS', $base_iss, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'VALOR_SUBSTITUICAO', $valor_subst, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'ALIQUOTA_SUBSTITUICAO', $aliq_subst, NUMERICO, 3.2, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'BASE_SUBSTITUICAO', $base_subst, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(11,'VALOR_IR', $valor_ir, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(12,'ESPACO', ' ', ALFA, 157, OBRIGATORIO));

        $linha = $layout->gera_linha();

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 553 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_553++;

        // Verifica se tem mais de 1 registro 553
        if ($this->conta_553 > 1) {
          throw new \Exception("REGISTRO 553 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    /**
     * Formata campos recebidos para registro 555
     * @param $cnpj Request
     * @param $razao Request
     * @param $tamanho Request
     */

    public function registro_555($filial, $serie, $numero, $valor, $emissao, 
        $remetente, $destinatario, $emissor_do_conhecimento, $uf_embarcador, $uf_emissora, $uf_destinatario, $conta_razao, $iva, 
        $identificacao_embarque, $identificacao_carga, $numero_SAP, $outro_SAP, $devolucao, $tamanho)
    {
        // Zera contador de 556 - ocorre até 9999 para cada 552
        $this->conta_556 = 0;
        
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 555, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'FILIAL', $filial, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'SERIE', $serie, ALFA, 5, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'NUMERO', $numero, ALFA, 12, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'VALOR', $valor, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'EMISSAO', $emissao, NUMERICO, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'REMETENTE', $remetente, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'DESTINATARIO', $destinatario, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'EMISSOR DO CONHECIMENTO', $emissor_do_conhecimento, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'UF EMBARCADOR', $uf_embarcador, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(11,'UF EMISSORA', $uf_emissora, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(12,'UF DESTINATARIO', $uf_destinatario, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(13,'CONTA RAZAO', $conta_razao, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'IVA', $iva, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(15,'IDENTIFICACAO EMBARQUE', $identificacao_embarque, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'IDENTIFICACAO CARGA', $identificacao_carga, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'NUMERO SAP', $numero_SAP, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'OUTRO SAP', $outro_SAP, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(19,'DEVOLUCAO', $devolucao, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(20,'ESPACO', ' ', ALFA, 86, OBRIGATORIO));

        $linha = $layout->gera_linha();

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 555 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_555++;

        // Verifica se tem mais de 5000 registro 555
        if ($this->conta_555 > 5000) {
          throw new \Exception("REGISTRO 555 OCORRE MAIS DE 5000 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    /**
     * Formata campos recebidos para registro 556
     * @param $cnpj Request
     * @param $razao Request
     * @param $tamanho Request
     */

    public function registro_556($serie, $numero, $emissao, $peso, $valor, 
        $emissor, $identificacao_embarque, $identificacao_carga, $numero_SAP, $outro_SAP, $devolucao, $tamanho)
    {
        // Zera contador de 559 - ocorre até 1 para cada 550
        $this->conta_559 = 0;
        
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 556, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'SERIE', $serie, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'NUMERO', $numero, NUMERICO, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'EMISSAO', $emissao, NUMERICO, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'PESO', $peso, NUMERICO, 5.2, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'VALOR', $valor, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'EMISSOR', $emissor, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'IDENTIFICACAO EMBARQUE', $identificacao_embarque, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'IDENTIFICACAO CARGA', $identificacao_carga, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'NUMERO SAP', $numero_SAP, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(11,'OUTRO SAP', $outro_SAP, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(12,'DEVOLUCAO', $devolucao, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(13,'ESPACO', ' ', ALFA, 140, OBRIGATORIO));

        $linha = $layout->gera_linha();

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 556 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_556++;

        // Verifica se tem mais de 9999 registro 556
        if ($this->conta_556 > 9999) {
          throw new \Exception("REGISTRO 556 OCORRE MAIS DE 9999 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    /**
     * Formata campos recebidos para registro 9
     * @param $cnpj Request
     * @param $razao Request
     * @param $tamanho Request
     */

    public function registro_559($qtde_total, $valor_total , $tamanho)
    {
        
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 559, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'QTDE TOTAL', $qtde_total, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'VALOR TOTAL', $valor_total, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'ESPACO', ' ', ALFA, 258, OBRIGATORIO));

        $linha = $layout->gera_linha();

        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 559 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_559++;

        // Verifica se tem mais de 1 registro 559
        if ($this->conta_559 > 1) {
          throw new \Exception("REGISTRO 559 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

}