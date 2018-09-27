<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - LAYOUT PROCEDA/OCOREN                 |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Ocoren.php                                               |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Formatar registros conforme Layout PROCEDA/OCOREN        | 
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

class Ocoren
{

    var $conta_000 = 0;
    var $conta_520 = 0;
    var $conta_521 = 0;
    var $conta_542 = 0;
    var $conta_543 = 0;
    var $conta_544 = 0;
    var $conta_545 = 0;
    var $conta_549 = 0;

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
        // Zera contador de 540 - ocorre até 200 para cada 000
        $this->conta_540 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 000, NUMERICO, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2,'IDENTIFICAÇÃO DO REMETENTE', $remetente, ALFA, 35, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3,'IDENTIFICAÇÃO DO DESTINATARIO', $destinatario, ALFA, 35, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(4,'DATA', $data, NUMERICO, 6, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(5,'HORA', $hora, NUMERICO, 4, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(6,'INTERCAMBIO', 'OCO50DDMM999', ALFA, 12, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(7,'ESPAÇO', ' ', ALFA, 155, OBRIGATORIO, PREENCHIMENTO)); 

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

    public function registro_540($documento, $tamanho)
    {
        // Zera contador de 541 - ocorre até 1 para cada 540
        $this->conta_541 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 540, NUMERICO, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2,'IDENTIFICAÇÃO DO DOCUMENTO', $documento, ALFA, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3,'ESPAÇO', ' ', ALFA, 233, OBRIGATORIO, PREENCHIMENTO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 540 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_540++;

        // Verifica se tem mais de 200 registro 540
        if ($this->conta_540 > 200) {
          throw new Exception("REGISTRO 540 OCORRE MAIS DE 200 VEZES");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_541($cnpj_transportadora, $razao_social_transportadora, $tamanho)
    {
        // Zera contador de 542 - ocorre até 9999 para cada 541
        $this->conta_542 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 541, NUMERICO, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2,'CNPJ(CGC) DA TRANSPORTADORA', $cnpj_transportadora, NUMERICO, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3,'RAZAO SOCIAL DA TRANSPORTADORA', $razao_social_transportadora, ALFA, 50, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(4,'ESPAÇO', ' ', ALFA, 183, OBRIGATORIO, PREENCHIMENTO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 541 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_541++;

        // Verifica se tem mais de 1 registro 541
        if ($this->conta_541 > 1) {
          throw new Exception("REGISTRO 541 OCORRE MAIS DE 1 VEZ");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_542($cnpj_emissor_nf, $serie_nf, $numero_nf, $codigo_ocorrencia_entrega, $data_ocorrencia, $hora_ocorrencia, $cod_observacao_ocorrencia_entrada, $numero_romaneio_identf_embarque, $identf_carga1, $identf_carga2,
                                 $identf_carga3, $filial_emissora_conhecimento, $serie_conhecimento, $numero_conhecimento, $indicacao_tipo_entrega, $codigo_empresa_emissora_nf, $codigo_filial_empresa_emissora_nf, $data_chegada_nf, $hora_chegada_nf, $data_inicio_descarregamento_destino,
                                 $hora_inicio_descarregamento_destino, $data_termino_descarregamento_destino, $hora_termino_descarregamento_destino, $data_saida_destino_nf, $hora_saida_destino_nf, $cnpj_emissor_nf_devolucao, $serie_nf_devolucao, $numero_nf_devolucao, $tamanho)
    {
        // Zera contador de 543 - ocorre até 1 para cada 542
        $this->conta_543 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 542, NUMERICO, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2,'CNPJ(CGC) DO EMISSOR DA NOTA FISCAL', $cnpj_emissor_nf, NUMERICO, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3,'SERIE DA NOTA FISCAL', $serie_nf, ALFA, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(4,'NUMERO DA NOTA FISCAL', $numero_nf, NUMERICO, 9, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(5,'CODIGO DE OCORRENCIA NA ENTREGA', $codigo_ocorrencia_entrega, NUMERICO, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(6,'DATA DA OCORRENCIA', $data_ocorrencia, NUMERICO, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(7,'HORA DA OCORRENCIA', $hora_ocorrencia, NUMERICO, 4, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(8,'CODIGO DE OBSERVACAO DE OCORRENCIA NA ENTRADA', $cod_observacao_ocorrencia_entrada, NUMERICO, 2, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(9,'NUMERO ROMANEIO, ORDEM DE COLETA, RESUMO DE CARGA, ETC(IDENTIFICACAO DE EMBARQUE)', $numero_romaneio_identf_embarque, ALFA, 20, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(10,'NUMERO SAP, SHIPMENT, ETC(IDENTIFICACAO DE CARGA) - #1', $identf_carga1, ALFA, 20, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(11,'NUMERO SAP, SHIPMENT, ETC(IDENTIFICACAO DE CARGA) - #2', $identf_carga2, ALFA, 20, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(12,'NUMERO SAP, SHIPMENT, ETC(IDENTIFICACAO DE CARGA) - #3', $identf_carga3, ALFA, 20, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(13,'FILIAL EMISSORA DO CONHECIMENTO', $filial_emissora_conhecimento, ALFA, 10, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(14,'SERIE DO CONHECIMENTO', $serie_conhecimento, ALFA, 5, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(15,'NUMERO DO CONHECIMENTO', $numero_conhecimento, ALFA, 12, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(16,'INDICACAO DO TIPO DE ENTREGA', $indicacao_tipo_entrega, ALFA, 1, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(17,'CODIGO DA EMPRESA EMISSORA DA NOTA FISCAL', $codigo_empresa_emissora_nf, ALFA, 5, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(18,'CODIGO DA FILIAL DA EMPRESA EMISSORA DA NF', $codigo_filial_empresa_emissora_nf, ALFA, 5, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(19,'DATA DA CHEGADA NO DESTINO DA NF', $data_chegada_nf, NUMERICO, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(20,'HORA DA CHEGADA NO DESTINO DA NF', $hora_chegada_nf, NUMERICO, 4, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(21,'DATA DO INICIO DO DESCARREGAMENTO NO DESTINO', $data_inicio_descarregamento_destino, NUMERICO, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(22,'HORA DO INICIO DO DESCARREGAMENTO NO DESTINO', $hora_inicio_descarregamento_destino, NUMERICO, 4, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(23,'DATA DO TERMINO DO DESCARREGAMENTO NO DESTINO', $data_termino_descarregamento_destino, NUMERICO, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(24,'HORA DO TERMINO DO DESCARREGAMENTO NO DESTINO', $hora_termino_descarregamento_destino, NUMERICO, 4, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(25,'DATA DA SAIDA DO DESTINO DA NF', $data_saida_destino_nf, NUMERICO, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(26,'HORA DA SAIDA DO DESTINO DA NF', $hora_saida_destino_nf, NUMERICO, 4, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(27,'CNPJ(CGC) DO EMISSOR DA NOTA FISCAL DEVOLUCAO', $cnpj_emissor_nf_devolucao, NUMERICO, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(28,'SERIE DA NOTA FISCAL DEVOLUCAO', $serie_nf_devolucao, ALFA, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(29,'NUMERO DA NOTA FISCAL DEVOLUCAO', $numero_nf_devolucao, NUMERICO, 9, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(30,'ESPAÇO', ' ', ALFA, 12, OBRIGATORIO, PREENCHIMENTO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 542 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_542++;

        // Verifica se tem mais de 9999 registro 542
        if ($this->conta_542 > 9999) {
          throw new Exception("REGISTRO 542 OCORRE MAIS DE 9999 VEZ");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_543($texto_livre1, $texto_livre2, $texto_livre3, $tamanho)
    {
        // Zera contador de 544 - ocorre até 9999 para cada 542
        $this->conta_544 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 543, NUMERICO, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2,'TEXTO LIVRE - 1', $texto_livre1, ALFA, 70, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3,'TEXTO LIVRE - 2', $texto_livre2, ALFA, 70, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(4,'TEXTO LIVRE - 3', $texto_livre3, ALFA, 70, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(5,'ESPAÇO', ' ', ALFA, 37, OBRIGATORIO, PREENCHIMENTO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 543 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_543++;

        // Verifica se tem mais de 1 registro 543
        if ($this->conta_543 > 1) {
          throw new Exception("REGISTRO 543 OCORRE MAIS DE 1 VEZ");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_544($qntd_volumes_nf, $qntd_volumes_entregues, $cod_item_nf, $descricao_item_nf, $tamanho)
    {
        // Zera contador de 545 - ocorre até 9999 para cada 542
        $this->conta_545 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(6,'IDENTIFICADOR DO REGISTRO', 544, NUMERICO, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(7,'QUANTIDADE DE VOLUMES DA NOTA', $qntd_volumes_nf, NUMERICO, 6.2, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(8,'QUANTIDADE DE VOLUMES ENTREGUES', $qntd_volumes_entregues, NUMERICO, 6.2, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(9,'CODIGO DO ITEM DA NOTA FISCAL', $cod_item_nf, ALFA, 20, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(10,'DESCRICAO DO ITEM DA NOTA FISCAL', $descricao_item_nf, ALFA, 50, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(11,'ESPAÇO', ' ', ALFA, 161, OBRIGATORIO, PREENCHIMENTO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 544 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_544++;

        // Verifica se tem mais de 1 registro 544
        if ($this->conta_544 > 9999) {
          throw new Exception("REGISTRO 544 OCORRE MAIS DE 9999 VEZES");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_545($cnpj_empresa_frete, $cnpj_empresa_emissora_ocorrencia, $filial_emissor_ocorrencia, $serie_conhecimento_ocorrencia, $numero_conhecimento_ocorrencia , $tamanho)
    {
        // Zera contador de 549 - ocorre até 1 para cada 540
        $this->conta_549 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 545, NUMERICO, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2,'CNPJ DA EMPRESA CONTRATANTE DO FRETE', $cnpj_empresa_frete, NUMERICO, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3,'CNPJ DA EMPRESA EMISSORA DO CONHECIMENTO ORIGINADOR DA OCORRENCIA', $cnpj_empresa_emissora_ocorrencia, NUMERICO, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(4,'FILIAL EMISSOR DO CTRC ORIGINADOR DA OCORRENCIA', $filial_emissor_ocorrencia, ALFA, 10, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(5,'SERIE DO CONHECIMENTO ORIGINADOR DA OCORRENCIA', $serie_conhecimento_ocorrencia, ALFA, 5, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(6,'NUMERO DO CONHECIMENTO ORIGINADOR DA OCORRENCIA', $numero_conhecimento_ocorrencia, ALFA, 12, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(7,'ESPAÇO', ' ', ALFA, 192, OBRIGATORIO, PREENCHIMENTO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 545 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_545++;

        // Verifica se tem mais de 1 registro 545
        if ($this->conta_545 > 1) {
          throw new Exception("REGISTRO 545 OCORRE MAIS DE 1 VEZ");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_549($numero_ocorrencias, $tamanho)
    {

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 549, NUMERICO, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2,'NUMERO DE REGISTRO DE OCORRENCIA', $numero_ocorrencias, NUMERICO, 4, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3,'ESPAÇO', ' ', ALFA, 243, OBRIGATORIO, PREENCHIMENTO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 549 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_549++;

        // Verifica se tem mais de 1 registro 549
        if ($this->conta_549 > 1) {
          throw new Exception("REGISTRO 549 OCORRE MAIS DE 1 VEZ");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }
    

}