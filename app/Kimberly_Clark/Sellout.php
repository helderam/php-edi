<?php
/**
 * +-----------------------------------------------------------------------+
 * | php-edi - Sistema Geração EDI - LAYOUT Kimberly Clark                 |
 * +-----------------------------------------------------------------------+
 * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
 * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
 * |                                                                       |
 * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
 * |                                                                       |
 * | Programa...: Sellout.php                                              |
 * |                                                                       |
 * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
 * |                                                                       |
 * | Criação....: 26-06-2018                                               |
 * |                                                                       |
 * | Objetivo...: Formatar registros conforme Layout Kimberly Clark Sellout| 
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

namespace App\Kimberly_Clark;

use App\Layout;
use App\Campo;

class Sellout
{
    

    public function header_sellout($cod_sap, $data)
    {
        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1, 'INDICADOR DE REGISTRO', 'H', ALFA, 1, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2, 'CÓDIGO SAP DO DISTRIBUIDOR', $cod_sap, ALFA, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2, 'DATA FIM DO PERIODO REPORTADO', $data, ALFA, 10, OBRIGATORIO, PREENCHIMENTO));
        
        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }

    public function detalhe_sellout($cod_sap_dist, $cod_sap_ent, $cod_cliente, $nome_cliente, $cnpj_cliente_indireto, $cpf_cliente_indireto, $endereco, $cep, $estado,
                                    $bairro, $municipio, $telefone, $pais, $contato, $tipo_negocio, $zona_estabelecida_distribuidor, $representante_distribuidor, $nome_representante, $codigo_produto_atacado,
                                    $codigo_ean, $codigo_sap_produto, $venda_qntd, $valor_venda, $preco_unitario_venda, $tipo_moeda, $data_faturamento, $data_entrega, $tipo_documento, $cod_documento,
                                    $unidade_medida_qntd, $numerador_conversao_qntd_unidade, $denominador_conversor_qntd_unidade, $unidade_medida_preco, $numerador_conversor_preco_unidade, $denominador_conversor_preco_unidade, $data_fim_periodo_reportado, $data_transmissao_informacao, $numero_transmissao, $cpf_representante_vendas, $chave_acesso)
    {
        $layout = new Layout();
        #23-24-25-32-33-35-36
        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO, PREENCHIMENTO
        $layout->adiciona(new Campo(1, 'INDICADOR DE REGISTRO', 'D', ALFA, 1, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(2, 'CÓDIGO SAP DO DISTRIBUIDOR (FATURAMENTO)', $cod_sap_dist, ALFA, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(3, 'COD SAP DO DISTRIBUIDOR (ENTREGA)', $cod_sap_ent, ALFA, 8, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(4, 'COD CLIENTE', $cod_cliente, ALFA, 15, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(5, 'NOME CLIENTE', $nome_cliente, ALFA, 80, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(6, 'CNPJ DO CLIENTE INDIRETO (JURIDICA)', $cnpj_cliente_indireto, ALFA, 20, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(7, 'CPF DO CLIENTE INDIRETO (FISICA)', $cpf_cliente_indireto, ALFA, 60, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(8, 'ENDERECO', $endereco, ALFA, 80, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(9, 'CEP', $cep, ALFA, 8, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(10, 'ESTADO', $estado, ALFA, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(11, 'BAIRRO', $bairro, ALFA, 40, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(12, 'MUNICIPIO', $municipio, ALFA, 40, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(13, 'TELEFONE', $telefone, ALFA, 30, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(14, 'PAIS', $pais, ALFA, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(15, 'CONTATO', $contato, ALFA, 70, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(16, 'TIPO DE NEGOCIO', $tipo_negocio, ALFA, 4, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(17, 'ZONA ESTABELECIDA PELO DISTRIBUIDOR', $zona_estabelecida_distribuidor, ALFA, 40, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(18, 'REPRESENTANTE DO DISTRIBUIDOR', $representante_distribuidor, ALFA, 10, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(19, 'NOME DO REPRESENTANTE', $nome_representante, ALFA, 80, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(20, 'CODIGO DO PRODUTO (ATACADO)', $codigo_produto_atacado, ALFA, 35, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(21, 'CODIGO EAN13', $codigo_ean, ALFA, 14, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(22, 'CODIGO SAP PRODUTO (KCC)', $codigo_sap_produto, ALFA, 35, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(23, 'VENDA EM QUANTIDADE', $venda_qntd, NUMERICO, 5, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(24, 'VALOR DA VENDA', $valor_venda, NUMERICO, 13.2, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(25, 'PREÇO UNITARIO DA VENDA', $preco_unitario_venda, NUMERICO, 13.2, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(26, 'TIPO DE MOEDA', $tipo_moeda, ALFA, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(27, 'DATA DE FATURAMENTO', $data_faturamento, ALFA, 10, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(28, 'DATA DE ENTREGA', $data_entrega, ALFA, 10, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(29, 'TIPO DE DOCUMENTO', $tipo_documento, ALFA, 1, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(30, 'CODIGO DO DOCUMENTO', $cod_documento, ALFA, 35, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(31, 'UNIDADE DE MEDIDA DE QUANTIDADE', $unidade_medida_qntd, ALFA, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(32, 'NUMERADOR DE CONVERSAO DAS QUANTIDADES PARA UNIDADE', $numerador_conversao_qntd_unidade, NUMERICO, 15, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(33, 'DENOMINADOR DE CONVERSOR DAS QUANTIDADES PARA UNIDADE', $denominador_conversor_qntd_unidade, NUMERICO, 15, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(34, 'UNIDADE DE MEDIDA DO PRECO', $unidade_medida_preco, ALFA, 3, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(35, 'NUMERADOR DE CONVERSOR DO PRECO PARA UNIDADE', $numerador_conversor_preco_unidade, NUMERICO, 15, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(36, 'DENOMINADOR DE CONVERSOR DO PRECO PARA UNIDADE', $denominador_conversor_preco_unidade, NUMERICO, 15, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(37, 'DATA DE FIM DO PERIODO REPORTADO', $data_fim_periodo_reportado, ALFA, 10, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(38, 'DATA DE TRANSMISSAO DA INFORMACAO', $data_transmissao_informacao, ALFA, 10, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(39, 'NUMERO DE TRANSMISSAO', $numero_transmissao, ALFA, 35, OPCIONAL, PREENCHIMENTO));
        $layout->adiciona(new Campo(40, 'CPF REPRESENTANTE VENDAS ATACADO', $cpf_representante_vendas, ALFA, 11, OBRIGATORIO, PREENCHIMENTO));
        $layout->adiciona(new Campo(41, 'CHAVE DE ACESSO NFE', $chave_acesso, ALFA, 44, OBRIGATORIO, PREENCHIMENTO));
        
        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }
}
