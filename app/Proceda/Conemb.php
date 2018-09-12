<?php
namespace App\Proceda;

use App\Layout;
use App\Campo;

class Conemb
{

    var $conta_000 = 0;
    var $conta_520 = 0;
    var $conta_521 = 0;
    var $conta_522 = 0;
    var $conta_523 = 0;
    var $conta_524 = 0;
    var $conta_525 = 0;
    var $conta_527 = 0;
    var $conta_529 = 0;

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
        // Zera contador de 520 - ocorre até 200 para cada 000
        $this->conta_520 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 0, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'IDENTIFICAÇÃO DO REMETENTE', $remetente, ALFA, 35, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'IDENTIFICAÇÃO DO DESTINATARIO', $destinatario, ALFA, 35, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'DATA', $data, NUMERICO, 6, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'HORA', $hora, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'INTERCAMBIO', "CON50DDMMSSS", ALFA, 12, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'ESPAÇO', ' ', ALFA, 255, OBRIGATORIO)); 

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

    public function registro_520($documento, $tamanho)
    {
        // Zera contador de 521 - ocorre até 1 para cada 520
        $this->conta_521 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 520, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'IDENTIFICAÇÃO DO REMETENTE', $documento, ALFA, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'ESPAÇO', ' ', ALFA, 333, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 520 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_520++;

        // Verifica se tem mais de 200 registro 520
        if ($this->conta_520 > 200) {
          throw new Exception("REGISTRO 520 OCORRE MAIS DE 200 VEZES");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_521($cnpj_transportadora, $nome_transportadora, $tamanho)
    {
        // Zera contador de 522 - ocorre até 50000 para cada 521
        $this->conta_522 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 521, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'CNPJ DA TRANSPORTADORA', $cnpj_transportadora, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'NOME DA TRANSPORTADORA(RAZAO SOCIAL)', $nome_transportadora, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'ESPAÇO', ' ', ALFA, 283, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 521 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_521++;

        // Verifica se tem mais de 1 registro 521
        if ($this->conta_521 > 1) {
          throw new Exception("REGISTRO 521 OCORRE MAIS DE 1 VEZ");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_522($filial, $serie, $numero, $data_emissao, $condicao_frete, $cnpj_filial, $cnpj_emissor_nf, $cnpj_destino_devolucao, $cnpj_destinatario_nf,
                                 $cnpj_consignatario, $codigo_fiscal_da_operacao, $placa_veiculo, $numero_romaneio_coleta_de_carga, $numeroSAP, $numeroSAP1, $numeroSAP2,
                                 $identf_documento_de_autorizacao, $chave_consulta_com_dv, $protocolo, $codigo_numerico_chave_acesso, $filial_emissora_trasportadora,
                                 $serie_conhecimento_transportadora, $numero_conhecimento_transportadora, $tipo_transporte, $tipo_conhecimento, $tipo_frete, $acao_documento,
                                 $frete_diferenciado, $tabela_frete, $plano_carga_rapida, $uf_embarcador_local_coleta, $uf_emissora, $uf_destinatario_nf , $tamanho)
    {
        // Zera contador de 523 - ocorre até 1 para cada 522
        $this->conta_523 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 522, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'FILIAL EMISSORA DO CONHECIMENTO', $filial, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'SERIE DO CONHECIMENTO', $serie, ALFA, 5, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'NUMERO DO CONHECIMENTO', $numero, ALFA, 12, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'DATA DA EMISSAO DO CONHECIMENTO', $data_emissao, NUMERICO, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'CONDICAO DE FRETE', $condicao_frete, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'CNPJ DO LOCAL/FILIAL EMISSORA DO CONHECIMENTO', $cnpj_filial, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'CNPJ DO EMISSOR DA NOTA FISCAL', $cnpj_emissor_nf, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'CNPJ DO DESTINO DO CONHECIMENTO DE DEVOLUCAO', $cnpj_destino_devolucao, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'CNPJ DO DESTINATARIO DAS NOTAS DO CONHECIMENTO', $cnpj_destinatario_nf, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(11,'CNPJ DO CONSIGNATARIO', $cnpj_consignatario, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(12,'CODIGO FISCAL DA NATUREZA DA OPERACAO', $codigo_fiscal_da_operacao, ALFA, 5, OBRIGATORIO));
        $layout->adiciona(new Campo(13,'PLACA DO VEICULO', $placa_veiculo, ALFA, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'NUMERO ROMANEIO ORDEM DE COLETA RESUMO DE CARGA', $numero_romaneio_coleta_de_carga, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(15,'NUMERO SAP SHIPMENT ETC - 1', $numeroSAP, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'NUMERO SAP SHIPMENT ETC - 2', $numeroSAP1, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'NUMERO SAP SHIPMENT ETC - 3', $numeroSAP2, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'IDENTIFICACAO DO DOCUMENTO DE AUTORIZACAO DE CARREGAMENTO E TRANSPORTE DA TRANSPORTADORA', $identf_documento_de_autorizacao, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(19,'CHAVE DE CONSULTA COM DV', $chave_consulta_com_dv, ALFA, 45, OBRIGATORIO));
        $layout->adiciona(new Campo(20,'PROTOCOLO', $protocolo, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(21,'CODIGO NUMERICO DA CHAVE DE ACESSO', $codigo_numerico_chave_acesso, NUMERICO, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(22,'FILIAL EMISSORA DO CONHECIMENTO ORIGINADOR DO CONHECIMENTO - TRANSPORTADORA CONTRATANTE', $filial_emissora_trasportadora, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(23,'SERIE DO CONHECIMENTO ORIGINADOR DO CONHECIMENTO - TRANSPORTADORA CONTRATANTE', $serie_conhecimento_transportadora, ALFA, 5, OBRIGATORIO));
        $layout->adiciona(new Campo(24,'NUMERO DO CONHECIMENTO ORIGINADOR DESTE CONHECIMENTO - TRANSPORTADORA CONTRATANTE', $numero_conhecimento_transportadora, ALFA, 12, OBRIGATORIO));
        $layout->adiciona(new Campo(25,'TIPO DO MEIO DE TRANSPORTE', $tipo_transporte, ALFA, 5, OBRIGATORIO));
        $layout->adiciona(new Campo(26,'TIPO DO CONHECIMENTO', $tipo_conhecimento, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(27,'TIPO DE FRETE', $tipo_frete, NUMERICO, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(28,'ACAO DO DOCUMENTO', $acao_documento, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(29,'CALCULO DO FRETE DIFERENCIADO', $frete_diferenciado, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(30,'TABELA DE FRETE', $tabela_frete, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(31,'PLANO DE CARGA RAPIDA', $plano_carga_rapida, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(32,'UF DO EMBARCADOR - LOCAL DA COLETA', $uf_embarcador_local_coleta, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(33,'UF DA UNIDADE EMISSORA DO CONHECIMENTO', $uf_emissora, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(34,'UF DO DESTINATARIO/LOCAL DE ENTREGA DA MERCADORIA/NOTA FISCAL', $uf_destinatario_nf, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(35,'ESPAÇO', ' ', ALFA, 10, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 522 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_522++;

        // Verifica se tem mais de 5000 registro 522
        if ($this->conta_522 > 5000) {
          throw new Exception("REGISTRO 522 OCORRE MAIS DE 5000 VEZES");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_523($qntd_total_volume, $peso_total_bruto, $peso_total_cubado, $peso_densidade, $valor_total_frete, $valor_frete_por_peso, $frete_valor,
                                 $frete_valorem, $valor_sec, $valor_itr, $valor_despacho, $valor_pedagio, $valor_ademe_griss, $valor_total_extra, $valor_desconto_acrescimo,
                                 $indicador_desconto_acrescimo, $base_calculo_apuracao_icms, $taxa_icms, $valor_icms, $subst_tributaria, $base_calculo_icms_subst_tributaria, $taxa_icms_subst_tributaria,
                                 $valor_icms_subst_tributaria, $base_calculo_iss, $taxa_iss_subst_tributaria, $valor_iss, $valor_ir, $direito_fiscal, $tipo_imposto , $tamanho)
    {
        // Zera contador de 524 - ocorre até 9999 para cada 522
        $this->conta_524 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 523, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'QUANTIDADE TOTAL DE VOLUMES/EMBALAGENS', $qntd_total_volume, NUMERICO, 6.2, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'PESO TOTAL TRANSPORTADO(PESO BRUTO)', $peso_total_bruto, NUMERICO, 6.3, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'PESO TOTAL CUBADO(VxD)', $peso_total_cubado, NUMERICO, 6.4, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'PESO DENSIDADE/CUBAGEM', $peso_densidade, NUMERICO, 6.4, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'VALOR TOTAL DO FRETE', $valor_total_frete, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'VALOR DO FRETE POR PESO/VOLUME', $valor_frete_por_peso, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'FRETE VALOR', $frete_valor, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'FRETE AD VALOREM', $frete_valorem, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'VALOR SEC - CAT', $valor_sec, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(11,'VALOR ITR', $valor_itr, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(12,'VALOR DO DESPACHO', $valor_despacho, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(13,'VALOR DO PEDAGIO', $valor_pedagio, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'VALOR ADEME/GRIS', $valor_ademe_griss, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(15,'VALOR TOTAL DE DESPESAS EXTRAS/ADICIONAIS', $valor_total_extra, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'VALOR DO DESCONTO OU DO ACRESCIMO', $valor_desconto_acrescimo, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'INDICADOR DE DESCONTO OU ACRESCIMO', $indicador_desconto_acrescimo, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'BASE DE CALCULO PARA APURACAO ICMS', $base_calculo_apuracao_icms, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(19,'$ DE TAXA DO ICMS', $taxa_icms, NUMERICO, 3.2, OBRIGATORIO));
        $layout->adiciona(new Campo(20,'VALOR DO ICMS', $valor_icms, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(21,'SUBSTITUICAO TRIBUTARIA', $subst_tributaria, NUMERICO, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(22,'BASE DE CALCULO ICMS - SUBSTITUICAO TRIBUTARIA', $base_calculo_icms_subst_tributaria, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(23,'% DE TAXA DO ICMS - SUBSTITUICAO TRIBUTARIA', $taxa_icms_subst_tributaria, NUMERICO, 3.2, OBRIGATORIO));
        $layout->adiciona(new Campo(24,'VALOR DO ICMS - SUBSTITUICAO TRIBUTARIA', $valor_icms_subst_tributaria, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(25,'BASE DE CALCULO DO ISS', $base_calculo_iss, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(26,'% DE TAXA DO ISS', $taxa_iss_subst_tributaria, NUMERICO, 3.2, OBRIGATORIO));
        $layout->adiciona(new Campo(27,'VALOR DO ISS', $valor_iss, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(28,'VALOR DO IR', $valor_ir, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(29,'DIREITO FISCAL', $direito_fiscal, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(30,'TIPO DE IMPOSTO', $tipo_imposto, ALFA, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(31,'ESPACO', ' ', ALFA, 16, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 523 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_523++;

        // Verifica se tem mais de 1 registro 523
        if ($this->conta_523 > 1) {
          throw new Exception("REGISTRO 523 OCORRE MAIS DE 1 VEZ");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_524($cnpj_emissor_nf, $numero_nf, $serie_nf, $data_emissao_nf, $valor_nf, $otde_total_volumes, $peso_bruto_total_mercadoria, $peso_densidade, $peso_total_cubado, $identf_pedido_cliente,
                                 $numero_romaneio_identf_embarque, $numeroSAP, $numeroSAP1, $numeroSAP2, $nota_fiscal_devolucao, $tipo_nf, $indicacao_bonificacao, $codigo_fiscal_da_operacao, $uf, $desdobro, 
                                 $tamanho)
    {
        // Zera contador de 525 - ocorre até 50 para cada 522
        $this->conta_525 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 524, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'CNPJ DO EMISSOR DA NOTA FISCAL', $cnpj_emissor_nf, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'NUMERO DA NOTA FISCAL', $numero_nf, NUMERICO, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'SERIE', $serie_nf, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'DATA DE EMISSAO DA NOTA FISCAL', $data_emissao_nf, NUMERICO, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'VALOR DA NOTA FISCAL', $valor_nf, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'OTDE TOTAL DE VOLUMES/EMBALAGENS', $otde_total_volumes, NUMERICO, 6.2, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'PESO BRUTO TOTAL DA MERCADORIA/NOTA', $peso_bruto_total_mercadoria, NUMERICO, 6.3, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'PESO DENSIDADE/CUBAGEM', $peso_densidade, NUMERICO, 6.4, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'PESO CUBADO(DxV)', $peso_total_cubado, NUMERICO, 6.4, OBRIGATORIO));
        $layout->adiciona(new Campo(11,'IDENTIFICACAO DO PEDIDO DO CLIENTE', $identf_pedido_cliente, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(12,'NUMERO ROMANEIO, ORDEM DE COLETA, RESUMO DE CARGA, ETC.(IDENTIFICACAO DE EMBARQUE)', $numero_romaneio_identf_embarque, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(13,'NUMERO SAP, SHIPMENT, ETC. - 1', $numeroSAP, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'NUMERO SAP, SHIPMENT, ETC. - 2', $numeroSAP1, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(15,'NUMERO SAP, SHIPMENT, ETC. - 3', $numeroSAP2, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'NOTA FISCAL DE DEVOLUCAO', $nota_fiscal_devolucao, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'TIPO DA NOTA FISCAL', $tipo_nf, NUMERICO, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'INDICACAO DE BONITIFICACAO', $indicacao_bonificacao, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(19,'CODIGO FISCAL DE OPERACAO', $codigo_fiscal_da_operacao, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(20,'SIGLA DO ESTADO(UF) DO FATO GERADOR', $uf, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(21,'DESDOBRO', $desdobro, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(22,'ESPACO', ' ', ALFA, 142, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 524 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_524++;

        // Verifica se tem mais de 9999 registro 524
        if ($this->conta_524 > 9999) {
          throw new Exception("REGISTRO 524 OCORRE MAIS DE 9999 VEZES");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_525($entrega_casada_cnpj_emissor1, $nome1, $serie_nf1, $numero_nf1, $entrega_casada_cnpj_emissor2, $nome2, $serie_nf2, $numero_nf2, $entrega_casada_cnpj_emissor3, $nome3,
                                 $serie_nf3, $numero_nf3, $redespacho_filial, $redespacho_serie, $redespacho_numero, $redespacho_cnpj_transp_contratatante , $tamanho)
    {
        // Zera contador de 527 - ocorre até 1 para cada 522
        $this->conta_527 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 525, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'ENTREGA CASADA: CNPJ/CGC DO EMISSOR DA NOTA - 1', $entrega_casada_cnpj_emissor1, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'NOME DO EMISSOR DA NOTA(RAZAO SOCIAL) - 1', $nome1, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'SERIE DA NOTA FISCAL - 1', $serie_nf1, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'NUMERO DA NOTA FISCAL - 1', $numero_nf1, NUMERICO, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'ENTREGA CASADA: CNPJ/CGC DO EMISSOR DA NOTA - 2', $entrega_casada_cnpj_emissor2, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'NOME DO EMISSOR DA NOTA(RAZAO SOCIAL) - 2', $nome2, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'SERIE DA NOTA FISCAL - 2', $serie_nf2, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'NUMERO DA NOTA FISCAL - 2', $numero_nf2, NUMERICO, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'ENTREGA CASADA: CNPJ/CGC DO EMISSOR DA NOTA - 3', $entrega_casada_cnpj_emissor3, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(11,'NOME DO EMISSOR DA NOTA(RAZAO SOCIAL) - 3', $nome3, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(12,'SERIE DA NOTA FISCAL - 3', $serie_nf3, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(13,'NUMERO DA NOTA FISCAL - 3', $numero_nf3, NUMERICO, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'REDESPACHO: FILIAL EMISSORA CONHECIMENTO', $redespacho_filial, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(15,'REDESPACHO: SERIE CONHECIMENTO', $redespacho_serie, ALFA, 5, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'REDESPACHO: NUMERO DO CONHECIMENTO', $redespacho_numero, ALFA, 12, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'REDESPACHO: CNPJ/CGC DA TRANSP. CONTRATANTE', $redespacho_cnpj_transp_contratatante, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'ESPACO', ' ', ALFA, 78, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 525 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_525++;

        // Verifica se tem mais de 50 registro 525
        if ($this->conta_525 > 50) {
          throw new Exception("REGISTRO 525 OCORRE MAIS DE 50 VEZES");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_527($razao_social, $cnpj, $inscricao_estadual, $enredeço, $bairro, $cidade, $codigo_postal, $codigo_municipio, $uf, $numero_comunicacao,
                                 $tamanho)
    {
        // Zera contador de 529 - ocorre até 1 para cada 520
        $this->conta_529 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 524, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'RAZAO SOCIAL', $razao_social, ALFA, 60, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'CNPJ(CGC)', $cnpj, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'INSCRICAO ESTADUAL', $inscricao_estadual, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'ENDERECO(LOGRADOURO)', $enredeço, ALFA, 60, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'BAIRRO', $bairro, ALFA, 35, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'CIDADE(MUNICIPIO)', $cidade, ALFA, 35, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'CODIGO POSTAL', $codigo_postal, ALFA, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'CODIGO DE MUNICIPIO', $codigo_municipio, ALFA, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'SIGLA DA UNIDADE DA FEDERACAO DO PAIS(ESTADO)', $uf, ALFA, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(11,'NUMERO DE COMUNICACAO', $numero_comunicacao, ALFA, 35, OBRIGATORIO));
        $layout->adiciona(new Campo(12,'ESPACO', ' ', ALFA, 66, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 527 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_527++;

        // Verifica se tem mais de 1 registro 527
        if ($this->conta_527 > 1) {
          throw new Exception("REGISTRO 527 OCORRE MAIS DE 1 VEZ");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_529($qntd_total_conhecimentos, $valor_total_conhecimentos, $tamanho)
    {

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 529, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'QUANTIDADE TOTAL DE CONHECIMENTOS', $qntd_total_conhecimentos, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'VALOR TOTAL DOS CONHECIMENTOS', $valor_total_conhecimentos, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'ESPACO', ' ', ALFA, 328, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 529 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        // Conta linhas para conferencia final
        $this->conta_529++;

        // Verifica se tem mais de 1 registro 529
        if ($this->conta_529 > 1) {
          throw new Exception("REGISTRO 529 OCORRE MAIS DE 1 VEZ");
        }

        // Gera linha conforme o layout
        return $linha."\n";
    }
}