<?php
namespace App\Proceda;

use App\Layout;
use App\Campo;

class Notfis
{

    var $conta_000 = 0;
    var $conta_500 = 0;
    var $conta_501 = 0;
    var $conta_502 = 0;
    var $conta_503 = 0;
    var $conta_505 = 0;
    var $conta_506 = 0;
    var $conta_507 = 0;
    var $conta_508 = 0;
    var $conta_509 = 0;
    var $conta_511 = 0;
    var $conta_513 = 0;
    var $conta_514 = 0;
    var $conta_515 = 0;
    var $conta_519 = 0;

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
        // Zera contador de 500 - ocorre até 200 para cada 000
        $this->conta_500 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 0, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'IDENTIFICAÇÃO DO REMETENTE', $remetente, ALFA, 35, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'IDENTIFICAÇÃO DO DESTINATARIO', $destinatario, ALFA, 35, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'DATA', $data, NUMERICO, 6, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'HORA', $hora, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'INTERCAMBIO', 'NOT50DDMMSSS', ALFA, 12, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'ESPAÇO', ' ', ALFA, 225, OBRIGATORIO)); 

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

    public function registro_500($documento, $tamanho)
    {
        // Zera contador de 501 - ocorre 100 para cada 500
        $this->conta_501 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 500, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'IDENTIFICAÇÃO DO DOCUMENTO', $documento, ALFA, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'ESPAÇO', ' ', ALFA, 303, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 500 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_500++;

        // Verifica se tem mais de 200 registros 500
        if ($this->conta_500 > 200) {
          throw new Exception("REGISTRO 500 OCORRE MAIS DE 200 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_501($documento, $cnpj, $insc_embarq, $insc_subs_tribut, $insc_muni, 
                                $endereco, $bairro, $cidade, $cod_postal, $cod_municipio, $uf, $data_embarque, $area_frete, $contato_emerg, $tamanho)
    {
        // Zera contador de 502 - ocorre 1 para cada 501
        $this->conta_502 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 501, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'RAZAO SOCIAL', $documento, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'CNPJ', $cnpj, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'INSCRICAO ESTADUAL EMBARCADORA', $insc_embarq, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'INSCRICAO ESTADUAL DO SUBSTITUTO TRIBUTARIO', $insc_subs_tribut, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'INSCRICAO MUNICIPAL', $insc_muni, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'ENDERECO', $endereco, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'BAIRRO', $bairro, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'CIDADE', $cidade, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'CODIGO POSTAL', $cod_postal, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'CODIGO MUNICIPIO', $cod_municipio, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'UF', $uf, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(13,'DATA DO EMBARQUE', $data_embarque, NUMERICO, 8, OBRIGATORIO)); 
        $layout->adiciona(new Campo(14,'AREA DE FRETE', $area_frete, ALFA, 4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(15,'CONTATO EMERGENCIA', $contato_emerg, ALFA, 25, OBRIGATORIO)); 
        $layout->adiciona(new Campo(16,'ESPAÇO', ' ', ALFA, 24, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 501 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_501++;

        // Verifica se tem mais de 100 registros 100
        if ($this->conta_501 > 100) {
          throw new Exception("REGISTRO 500 OCORRE MAIS DE 100 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_502($documento, $cnpj, $endereco, $bairro, $cidade, $cod_postal, $cod_municipio, $uf, $numero_contato, $area_frete, $tamanho)
    {
        // Zera contador de 503 - ocorre 500 para cada 501
        $this->conta_503 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 502, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'RAZAO SOCIAL', $documento, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'CNPJ', $cnpj, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'ENREREÇO', $endereco, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'BAIRRO', $bairro, ALFA, 35, OBRIGATORIO));   
        $layout->adiciona(new Campo(6,'CIDADE', $cidade, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'CODIGO POSTAL', $cod_postal, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'CODIGO MUNICIPIO', $cod_municipio, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'UF', $uf, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'NUMERO COMUNICACAO', $numero_contato, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'AREA DE FRETE', $area_frete, ALFA, 4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'ESPAÇO', ' ', ALFA, 67, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 502 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_502++;

        // Verifica se tem mais de 1 registro 502
        if ($this->conta_502 > 1) {
          throw new Exception("REGISTRO 502 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_503($documento, $cnpj, $insc_estadual, $insc_suframa, $endereco, $bairro, $cidade, $cod_postal,
                                $cod_municipio, $uf, $numero_contato, $cod_pais, $area_frete, $tipo_identificacao_dest, $tipo_estabelecimento_dest, $tamanho)
    {
        // Zera contador de 504 - ocorre 1 para cada 503
        $this->conta_504 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 503, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'RAZAO SOCIAL', $documento, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'CNPJ', $cnpj, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'INSCRICAO ESTADUAL', $insc_estadual, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'INSCRICAO SUFRAMA', $insc_suframa, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'ENDERECO', $endereco, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'BAIRRO', $bairro, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'CIDADE', $cidade, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'CODIGO POSTAL', $cod_postal, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'CODIGO MUNICIPIO', $cod_municipio, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'UF', $uf, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'NUMERO CONTATO', $numero_contato, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(13,'CODIGO PAIS', $cod_pais, ALFA, 4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(14,'AREA DE FRETE', $area_frete, ALFA, 4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(15,'TIPO DE IDENTIFICACAO DESTINATARIO', $tipo_identificacao_dest, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'TIPO DE ESTABELECIMENTO DESTINO', $tipo_estabelecimento_dest, ALFA, 1, OBRIGATORIO)); 
        $layout->adiciona(new Campo(17,'ESPAÇO', ' ', ALFA, 31, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 503 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_503++;

        // Verifica se tem mais de 500 registros 503
        if ($this->conta_503 > 500) {
          throw new Exception("REGISTRO 503 OCORRE MAIS DE 500 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_504($documento, $cnpj, $insc_estadual, $endereco, $bairro, $cidade, $cod_postal,
                                $cod_municipio, $uf, $numero_contato, $cod_pais, $area_frete, $tipo_identificacao_dest, $tipo_estabelecimento_dest, $tamanho)
    {
        // Zera contador de 505 - ocorre 500 para cada 503
        $this->conta_505 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 504, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'RAZAO SOCIAL', $documento, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'CNPJ', $cnpj, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'INSCRICAO ESTADUAL', $insc_estadual, ALFA, 15, OBRIGATORIO));  
        $layout->adiciona(new Campo(4,'ENDERECO', $endereco, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'BAIRRO', $bairro, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'CIDADE', $cidade, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'CODIGO POSTAL', $cod_postal, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'CODIGO MUNICIPIO', $cod_municipio, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'UF', $uf, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'NUMERO CONTATO', $numero_contato, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'CODIGO PAIS', $cod_pais, ALFA, 4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'AREA DE FRETE', $area_frete, ALFA, 4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(13,'TIPO DE IDENTIFICACAO DESTINATARIO', $tipo_identificacao_dest, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'TIPO DE ESTABELECIMENTO DESTINO', $tipo_estabelecimento_dest, ALFA, 1, OBRIGATORIO)); 
        $layout->adiciona(new Campo(15,'ESPACO', ' ', ALFA, 46, OBRIGATORIO));

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 504 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_504++;

        // Verifica se tem mais de 1 registro 504
        if ($this->conta_504 > 1) {
          throw new Exception("REGISTRO 504 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }
    
    public function registro_505($serie, $numero, $data, $tipo, $especie_acond, $cod_rota, $meio_transporte, $tipo_transporte,
                                $tipo_carga, $condicao_frete, $data_embarque, $desdobro, $plano_cargarapida, $tipo_doc_fiscal, $bonificacao,
                                $cfop, $uf, $frete_diferenciado, $tabela_frete, $modalidade_frete, $identf_pedido_cliente, $identf_embarque,
                                $numero_sap, $outro_sap, $outro_sap1, $tipo_periodo_entrega, $data_init_entrega, $hora_init_entrega, $data_final_entrega,
                                $hora_final_entrega, $cod_numerico_chaveacesso_nfe, $chaveacesso_nfe_dv, $numero_protocolo, $acao_doc, $tamanho)
    {
        // Zera contador de 506 - ocorre 1 para cada 505
        $this->conta_506 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 505, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'SERIE NOTA FISCAL', $serie, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'NUMERO NOTA FISCAL', $numero, NUMERICO, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'DATA EMISSAO', $data, NUMERICO, 8, OBRIGATORIO));  
        $layout->adiciona(new Campo(5,'TIPO', $tipo, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'ESPECIE ACONDICIONAMENTO', $especie_acond, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'CODIGO ROTA', $cod_rota, ALFA, 7, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'MEIO DE TRANSPORTE', $meio_transporte, NUMERICO, 1, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'TIPO DE TRANSPORTE', $tipo_transporte, NUMERICO, 1, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'TIPO DE CARGA', $tipo_carga, NUMERICO, 1, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'CONDICAO DE FRETE', $condicao_frete, ALFA, 1, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'DATA DE EMBARQUE', $data_embarque, NUMERICO, 8, OBRIGATORIO)); 
        $layout->adiciona(new Campo(13,'DESDOBRO', $desdobro, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'PLANO CARGA RAPIDA', $plano_cargarapida, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(15,'TIPO DOCUMENTO FISCAL', $tipo_doc_fiscal, NUMERICO, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'INDICACAO BONIFICACAO', $bonificacao, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'CFOP', $cfop, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'UF', $uf, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(19,'CALCULO DE FRETE DIFERENCIADO', $frete_diferenciado, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(20,'TABELA DE FRETE', $tabela_frete, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(21,'MODALIDADE FRETE', $modalidade_frete, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(22,'IDENTIFICACAO DO PEDIDO CLIENTE', $identf_pedido_cliente, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(23,'IDENTIFICACAO EMBARQUE', $identf_embarque, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(24,'NUMERO SAP 1', $numero_sap, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(25,'NUMERO SAP 2', $outro_sap, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(26,'NUMERO SAP 3', $outro_sap1, ALFA, 20, OBRIGATORIO));
        $layout->adiciona(new Campo(27,'TIPO PERIODO DE ENTREGA', $tipo_periodo_entrega, NUMERICO, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(28,'DATA INICIAL ENTREGA', $data_init_entrega, NUMERICO, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(29,'HORA INICIAL ENTREGA', $hora_init_entrega, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(30,'DATA FINAL ENTREGA', $data_final_entrega, NUMERICO, 8, OBRIGATORIO));
        $layout->adiciona(new Campo(31,'HORA FINAL ENTREGA', $hora_final_entrega, NUMERICO, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(32,'COD NUMERICO CHAVE DE ACESSO NFE', $cod_numerico_chaveacesso_nfe, NUMERICO, 9, OBRIGATORIO));
        $layout->adiciona(new Campo(33,'CHAVE DE ACESSO NFE COM D/V', $chaveacesso_nfe_dv, ALFA, 45, OBRIGATORIO));
        $layout->adiciona(new Campo(34,'NUMERO DO PROTOCOLO', $numero_protocolo, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(35,'ACAO DO DOCUMENTO', $acao_doc, ALFA, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(36,'ESPACO', ' ', ALFA, 21, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 505 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_505++;

        // Verifica se tem mais de 500 registro 505
        if ($this->conta_505 > 500) {
          throw new Exception("REGISTRO 505 OCORRE MAIS DE 500 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_506($otde_tot, $pesobruto_tot_mercadoria, $pesoliqui_tot_mercadoria, $peso_densidade, $peso_cubado, $incidencia_icms, $seguro_efetuado, $valor_cliente,
                                $valor_tot_nota, $valor_tot_seguro, $valor_tot_desconto, $valor_tot_outrasdispesas, $calculo_icms, $valor_tot_icms, $calculo_icms_subst_tributaria,
                                $valor_tot_icms_subst_tributaria, $valor_icms_retido, $valor_tot_imposto_importacao, $valor_ipi, $valor_pis, $valor_cofins, $valor_calculado_frete,
                                $valor_tot_icms_frete, $valor_tot_icms_subst_tributaria_frete, $valor_tot_iss_frete, $tamanho)
    {
        // Zera contador de 507 - ocorre 1 para cada 505
        $this->conta_507 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 506, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'OTDE TOTAL', $otde_tot, NUMERICO, 6.2, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'PESO BRUTO TOTAL MERCADORIA/NOTA', $pesobruto_tot_mercadoria, NUMERICO, 6.3, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'PESO LIQUIDO TOTAL MERCADORIA/NOTA', $pesoliqui_tot_mercadoria, NUMERICO, 6.3, OBRIGATORIO));  
        $layout->adiciona(new Campo(5,'PESO DENSIDADE/CUBAGEM', $peso_densidade, NUMERICO, 6.4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'PESO CUBADO (VxD)', $peso_cubado, NUMERICO, 6.4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'INCIDENCIA DE ICMS', $incidencia_icms, ALFA, 1, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'SEGURO EFETUADO', $seguro_efetuado, ALFA, 1, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'VALOR A SER COBRADO CLIENTE', $valor_cliente, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'VALOR TOTAL DA NOTA', $valor_tot_nota, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'VALOR TOTAL DO SEGURO', $valor_tot_seguro, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'VALOR TOTAL DO DESCONTO', $valor_tot_desconto, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(13,'VALOR TOTAL OUTRAS DESPESAS ACESSORIAS', $valor_tot_outrasdispesas, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'BASE DE CALCULO DO ICMS', $calculo_icms, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(15,'VALOR TOTAL DO ICMS', $valor_tot_icms, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'BASE DE CALCULO DO ICMS SUBST. TRIBUTARIA', $calculo_icms_subst_tributaria, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'VALOR TOTAL DO ICMS SUBST. TRIBUTARIA', $valor_tot_icms_subst_tributaria, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'VALOR DO ICMS RETIDO', $valor_icms_retido, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(19,'VALOR TOTAL DO IMPOSTO DE IMPORTACAO', $valor_tot_imposto_importacao, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(20,'VALOR TOTAL DO IPI', $valor_ipi, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(21,'VALOR TOTAL DO PIS', $valor_pis, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(22,'VALOR TOTAL DO COFINS', $valor_cofins, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(23,'VALOR CALCULADO DO FRETE', $valor_calculado_frete, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(24,'VALOR TOTAL DO ICMS DO FRETE', $valor_tot_icms_frete, NUMERICO, 11.2, OBRIGATORIO));
        $layout->adiciona(new Campo(25,'VALOR TOTAL ICMS-SUBST. TRIBUTARIA DO FRETE', $valor_tot_icms_subst_tributaria_frete, NUMERICO, 11.2, OBRIGATORIO));
        $layout->adiciona(new Campo(26,'VALOR TOTAL DO ISS DO FRETE', $valor_tot_iss_frete, NUMERICO, 11.2, OBRIGATORIO));
        $layout->adiciona(new Campo(27,'ESPACO', ' ', ALFA, 5, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 506 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_506++;

        // Verifica se tem mais de 1 registro 506
        if ($this->conta_506 > 1) {
          throw new Exception("REGISTRO 506 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_507($qntd_total_volumes_embalagens, $peso_total_transportado, $peso_cubado, $peso_densidade, $valor_tot_frete,
                                 $valor_frete_peso, $frete_valor, $frete_ad_valorem, $valor_sec_cat, $valor_it_gris, $valor_despacho,
                                 $valor_pedagio, $valor_ademe_gris, $valor_despesas_extras, $base_calculo_apuracao_icms_frete, $taxa_icms_frete,
                                 $valor_icms_frete, $subst_tributaria, $base_calculo_icms_subst_tributaria, $taxa_icms_subst_tributaria, $valor_icms_subst_tributaria,
                                 $base_calculo_iss, $taxa_iss, $valor_tot_iss, $valor_tot_ir, $direito_fiscal, $taxa_imposto, $uf, $tamanho)
    {
        // Zera contador de 508 - ocorre 50 para cada 505
        $this->conta_508 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 507, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'QUANTIDADE TOTAL DE VOLUMES/EMBALAGENS', $qntd_total_volumes_embalagens, NUMERICO, 6.2, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'PESO TOTAL TRANPORTADO(BRUTO)', $peso_total_transportado, NUMERICO, 6.3, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'PESO TOTAL CUBADO(VxD)', $peso_cubado, NUMERICO, 6.4, OBRIGATORIO));  
        $layout->adiciona(new Campo(5,'PESO DENSIDADE/CUBAGEM', $peso_densidade, NUMERICO, 6.4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'VALOR TOTAL DO FRETE', $valor_tot_frete, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'VALOR DO FRETE POR PESO/VOLUME', $valor_frete_peso, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'FRETE VALOR', $frete_valor, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'FRETE AD VALOREM', $frete_ad_valorem, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'VALOR SEC-CAT', $valor_sec_cat, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'VAOR IT/GRIS', $valor_it_gris, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'VALOR DO DESPACHO', $valor_despacho, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(13,'VALOR DO PEDAGIO', $valor_pedagio, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(14,'VALOR ADEME/GRIS', $valor_ademe_gris, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(15,'VALOR TOTAL DE DESPESAS EXTRAS/ADICIONAIS', $valor_despesas_extras, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'BASE DE CALCULO PARA APURACAO ICMS DO FRETE', $base_calculo_apuracao_icms_frete, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'% DE TAXA DO ICMS DO FRETE', $taxa_icms_frete, NUMERICO, 3.2, OBRIGATORIO));
        $layout->adiciona(new Campo(18,'VALOR DO ICMS DO FRETE', $valor_icms_frete, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(19,'SUBSTITUICAO TRIBUTARIA', $subst_tributaria, NUMERICO, 1, OBRIGATORIO));
        $layout->adiciona(new Campo(20,'BASE DE CALCULO ICMS - SUBSTITUICAO TRIBUTARIA', $base_calculo_icms_subst_tributaria, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(21,'% DE TAXA DO ICMS - SUBSTITUICAO TRIBUTARIA', $taxa_icms_subst_tributaria, NUMERICO, 3.2, OBRIGATORIO));
        $layout->adiciona(new Campo(22,'VALOR TOTAL DO ICMS - SUBSTITUICAO TRIBUTARIA', $valor_icms_subst_tributaria, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(23,'BASE DE CALCULO DO ISS', $base_calculo_iss, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(24,'% DE TAXA DO ISS', $taxa_iss, NUMERICO, 3.2, OBRIGATORIO));
        $layout->adiciona(new Campo(25,'VALOR TOTAL DO ISS', $valor_tot_iss, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(26,'VALOR TOTAL DO IR', $valor_tot_ir, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(27,'DIREITO FISCAL', $direito_fiscal, ALFA, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(28,'TIPO DE IMPOSTO', $taxa_imposto, ALFA, 4, OBRIGATORIO));
        $layout->adiciona(new Campo(29,'SIGLA DO ESTADO DO FATO GERADOR ICMS FRETE', $uf, ALFA, 2, OBRIGATORIO));
        //$layout->adiciona(new Campo(30,'ESPACO', ' ', ALFA, 1, OBRIGATORIO));
        
        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 507 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_507++;

        // Verifica se tem mais de 1 registro 507
        if ($this->conta_507 > 1) {
          throw new Exception("REGISTRO 507 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_508($marca_volumes, $num_volumes_transportados, $num_lacres, $tamanho)
    {
        // Zera contador de 509 - ocorre 50 para cada 505
        $this->conta_509 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 508, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'MARCA DOS VOLUMES TRANSPORTADOS', $marca_volumes, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'NUMERACAO DOS VOLUMES TRANSPORTADOS', $num_volumes_transportados, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'NUMERO DOS LACRES', $num_lacres, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'ESPACO', ' ', ALFA, 167, OBRIGATORIO));

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 508 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_508++;

        // Verifica se tem mais de 1 registro 508
        if ($this->conta_508 > 50) {
          throw new Exception("REGISTRO 508 OCORRE MAIS DE 50 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_509($cnpj1, $nome1, $serie1, $numero1, $cnpj2, $nome2, $serie2, $numero2, $cnpj3, $nome3, $serie3, $numero3,
                                 $desp_filial_emissora_conhecimento, $desp_serie_conhecimento, $desp_numero_conhecimento, $desp_cnpj_transp_contratante, $tamanho)
    {
        // Zera contador de 511 - ocorre 5000 para cada 505
        $this->conta_511 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 509, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'ENTREGA CASADA: CNPJ/CGC DO EMISSOR DA NOTA - 1', $cnpj1, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'NOME DO EMISSOR DA NOTA(RAZAO SOCIAL) - 1', $nome1, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'SERIE DA NOTA FISCAL - 1', $serie1, ALFA, 3, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'NUMERO DA NOTA FISCAL - 1', $numero1, NUMERICO, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'ENTREGA CASADA: CPNJ/CGC DO EMISSOR DA NOTA - 2', $cnpj2, NUMERICO, 14, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'NOME DO EMISSOR DA NOTA(RAZAO SOCIAL) - 2', $nome2, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'SERIE DA NOTA FISCAL - 2', $serie2, ALFA, 3, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'NUMERO DA NOTA FISCAL - 2', $numero2, NUMERICO, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'ENTREGA CASADA: CNPJ/CGC DO EMISSOR DA NOTA - 3', $cnpj3, NUMERICO, 14, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'NOME DO EMISOR DA NOTA(RAZAO SOCIAL) - 3', $nome3, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'SERIE DA NOTA FISCAL - 3', $serie3, ALFA, 3, OBRIGATORIO)); 
        $layout->adiciona(new Campo(13,'NUMERO DA NOTA FISCAL - 3', $numero3, NUMERICO, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(14,'DESPACHO: FILIAL EMISSORA CONHECIMENTO', $desp_filial_emissora_conhecimento, ALFA, 10, OBRIGATORIO)); 
        $layout->adiciona(new Campo(15,'REDESPACHO: SERIE CONHECIMENTO', $desp_serie_conhecimento, ALFA, 5, OBRIGATORIO));
        $layout->adiciona(new Campo(16,'REDESPACHO: NUMERO DO CONHECIMENTO', $desp_numero_conhecimento, ALFA, 12, OBRIGATORIO));
        $layout->adiciona(new Campo(17,'REDESPACHO: CNPJ/CGC DA TRANSP. CONTRTATANTE', $desp_cnpj_transp_contratante, NUMERICO, 14, OBRIGATORIO)); 
        $layout->adiciona(new Campo(18,'ESPAÇO', ' ', ALFA, 48, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 509 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_509++;

        // Verifica se tem mais de 50 registro 509
        if ($this->conta_509 > 50) {
          throw new Exception("REGISTRO 509 OCORRE MAIS DE 50 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_511($qntd_volume, $especie_acond, $cod_item_nf, $desc_item_nf, $cfop_item, $lote_item,
                                 $data_validade_item, $marca_volumes_transportados, $num_volumes_transportados, $num_lacres, $identf_pedido_cliente, $tamanho)
    {
        // Zera contador de 513 - ocorre 1 para cada 505
        $this->conta_513 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 511, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'QUANTIDADE DE VOLUMES', $qntd_volume, NUMERICO, 6.2, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'ESPECIE DE ACONDICIONAMENTO DO ITEM', $especie_acond, ALFA, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'CODIGO DO ITEM DA NOTA FISCAL', $cod_item_nf, ALFA, 20, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'DESCRICAO DO ITEM DA NOTA FISCAL', $desc_item_nf, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'CFOP DO ITEM', $cfop_item, NUMERICO, 4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'LOTE DO ITEM', $lote_item, NUMERICO, 20, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'DATA DE VALIDADE DO ITEM', $data_validade_item, NUMERICO, 8, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'MARCA DOS VOLUMES TRANSPORTADOS', $marca_volumes_transportados, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'NUMERACAO DOS VOLUMES TRANSPORTADOS', $num_volumes_transportados, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'NUMERO DOS LACRES', $num_lacres, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'IDENTIFICACAO DO PEDIDO DO CLIENTE', $identf_pedido_cliente, ALFA, 20, OBRIGATORIO)); 
        $layout->adiciona(new Campo(13,'ESPAÇO', ' ', ALFA, 22, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 511 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_511++;

        // Verifica se tem mais de 5000 registros 511
        if ($this->conta_511 > 5000) {
          throw new Exception("REGISTRO 511 OCORRE MAIS DE 5000 VEZES");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_513($documento, $cnpj, $insc_estadual, $endereco, $bairro, $cidade, $cod_postal, $cod_municipio, $uf, $numero_contato, $tamanho)
    {
        // Zera contador de 514 - ocorre 1 para cada 505
        $this->conta_514 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 513, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'NOME DO CONSCINITARIO(RAZAO SOCIAL)', $documento, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'CNPJ(CGC)', $cnpj, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'INSCRICAO ESTADUAL', $insc_estadual, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'ENDERECO(LOGRADOURO', $endereco, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'BAIRRO', $bairro, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'CIDADE(MUNICIPIO)', $cidade, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'CODIGO POSTAL', $cod_postal, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'CODIGO MUNICIPIO', $cod_municipio, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'SIGLA DO ESTADO(UF) SUBENTIDADE DO PAIS', $uf, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'NUMERO DE COMUNICACAO', $numero_contato, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'ESPAÇO', ' ', ALFA, 56, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 513 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_513++;

        // Verifica se tem mais de 1 registros 513
        if ($this->conta_513 > 1) {
          throw new Exception("REGISTRO 513 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_514($documento, $cnpj, $insc_estadual, $endereco, $bairro, $cidade, $cod_postal, $cod_municipio, $uf, $numero_contato, $area_frete, $tamanho)
    {
        // Zera contador de 515 - ocorre 1 para cada 505
        $this->conta_515 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 514, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'NOME DO RESP. PELO REDESPACHO(RAZAO SOCIAL)', $documento, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'CNPJ(CGC)', $cnpj, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'INSCRICAO ESTADUAL', $insc_estadual, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'ENDERECO(LOGRADOURO)', $endereco, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'BAIRRO', $bairro, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'CIDADE(MUNICIPIO)', $cidade, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'CODIGO POSTAL', $cod_postal, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'CODIGO DE MUNICIPIO', $cod_municipio, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'SIGLA DO ESTADO(UF) SUBENTIDADE DE PAIS', $uf, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'NUMERO DE COMUNICACAO', $numero_contato, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'AREA DE FRETE', $area_frete, ALFA, 4, OBRIGATORIO)); 
        $layout->adiciona(new Campo(13,'ESPAÇO', ' ', ALFA, 52, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 514 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_514++;

        // Verifica se tem mais de 1 registro 514
        if ($this->conta_514 > 1) {
          throw new Exception("REGISTRO 514 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_515($documento, $cnpj, $insc_estadual, $endereco, $bairro, $cidade, $cod_postal, $cod_municipio, $uf, $numero_contato, $tamanho)
    {
        // Zera contador de 515 - ocorre 1 para cada 500
        $this->conta_519 = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 515, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'NOME DO RESP. PELO REDESPACHO(RAZAO SOCIAL)', $documento, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'CNPJ(CGC)', $cnpj, NUMERICO, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'INSCRICAO ESTADUAL', $insc_estadual, ALFA, 15, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'ENDERECO(LOGRADOURO)', $endereco, ALFA, 50, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'BAIRRO', $bairro, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(7,'CIDADE(MUNICIPIO)', $cidade, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(8,'CODIGO POSTAL', $cod_postal, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(9,'CODIGO DE MUNICIPIO', $cod_municipio, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(10,'SIGLA DO ESTADO(UF) SUBENTIDADE DE PAIS', $uf, ALFA, 9, OBRIGATORIO)); 
        $layout->adiciona(new Campo(11,'NUMERO DE COMUNICACAO', $numero_contato, ALFA, 35, OBRIGATORIO)); 
        $layout->adiciona(new Campo(12,'ESPAÇO', ' ', ALFA, 56, OBRIGATORIO)); 

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 515 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_515++;

        // Verifica se tem mais de 1 registro 515
        if ($this->conta_515 > 1) {
          throw new Exception("REGISTRO 515 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

    public function registro_519($valor_tot_nf, $peso_bruto_nf, $qntd_tot_volumes, $num_notas, $tamanho)
    {

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'IDENTIFICADOR DO REGISTRO', 519, NUMERICO, 3, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'VALOR TOTAL DAS NOTAS FISCAIS', $valor_tot_nf, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'PESO BRUTO TOTAL DAS NTOAS FISCAIS', $peso_bruto_nf, NUMERICO, 13.2, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'QUANTIDADE TOTAL DE VOLUMES', $qntd_tot_volumes, NUMERICO, 13.2, OBRIGATORIO)); 
        $layout->adiciona(new Campo(5,'NUMERO DE NOTAS', $num_notas, NUMERICO, 10, OBRIGATORIO)); 
        $layout->adiciona(new Campo(6,'ESPACO', ' ', ALFA, 262, OBRIGATORIO));

        $linha = $layout->gera_linha();
        // Verifica se tamanho gerado está conforme o tamanho esperado
        if ($tamanho != strlen($linha)) {
          throw new \Exception("REGISTRO 519 NAO CONFERE TAMANHO DE {$tamanho} : ".strlen($linha));
        }

        // Conta linhas para conferencia final
        $this->conta_519++;

        // Verifica se tem mais de 1 registro 519
        if ($this->conta_519 > 1 ){
          throw new Exception("REGISTRO 519 OCORRE MAIS DE 1 VEZ");
        }
        
        // Gera linha conforme o layout
        return $linha."\n";
    }

}