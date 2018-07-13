<?php
/*
namespace PHP_EDI\proceda;

use EdiDoccob;

class GerarEdiDoccob extends EdiDoccob {
    /**
     * +-----------------------------------------------------------------------+
     * | php-edi - Sistema Geração EDI - LAYOUT DOCCOB                         |
     * +-----------------------------------------------------------------------+
     * | Este arquivo está disponível sob a Licença MIT disponível pela Web    |
     * | em https://pt.wikipedia.org/wiki/Licen%C3%A7a_MIT                     |
     * |                                                                       |
     * | Coordenação: <helder.afonso.de.morais@gmail.com>                      |
     * |                                                                       |
     * | Programa...: gerar_edi_doccob.php                                     |
     * |                                                                       |
     * | Autor......: Helder <helder.afonso.de.morais@gmail.com>               |
     * |                                                                       |
     * | Criação....: 26-06-2018                                               |
     * |                                                                       |
     * | Objetivo...: Gerar arquivo de texto conforme Layout DOCCOB            |
     * |                                                                       |
     * | Layout EDI.: 6.0 - 31/07/2008                                         |
     * |                                                                       |
     * +-----------------------------------------------------------------------+
     * | Versões....:                                                          |
     * |                                                                       |
     * |                                                                       |
     * |                                                                       |
     * +-----------------------------------------------------------------------+
     * /


    // Data e hora inicial
    var $inicial;# = date('d-m-Y H:i:s');  

    // Armazena as linhas que formarão o arquivo texto EDI
    var $linhas = array();

    // Armazena todos os registros a serem convertidos e formatados nolayout do EDI - PROCEDA - DOCCOB
    var $registros = array();

    /**
     *  
     * REGISTRO 000 - CABEÇALHO DE INTERCÂMBIO - Preenchimento: OBRIGATÓRIO 
     * TAMANHO DO REGISTRO: 280 
     * 
     *

    # IMPORTANTE: PREENCHER OS 4 CAMPOS: CONTEUDO, TAMANHO, PREENCHIMENTO, LADO PREENCHIMENTO, OBRIGATORIO

    # CAMPOS PARA VERIFICAÇÃO E VALIDAÇÃO 
    $this->code = '000'; // Codigo identificador do registro
    $this->length = 280; // Tamanho da linha completa
    $this->max_lines = 1; // Quantidade maxima de linhas deste tipo no total dos registros
    $this->fields = 7; // Quantidade total de campos 
    # IDENTIFICADOR DO REGISTRO - FIXO
    $this->campos = array();
    # 1 - IDENTIFICACAO DO REGISTRO
    $this->campos['registro'] = ['000', 3, '', STR_PAD_RIGHT, true]; 
    # 2 - NOME DA CAIXA POSTAL DO REMETENTE
    $this->campos['remetente'] = ['1234', 35, ' ', STR_PAD_RIGHT, true]; 
    # 3 - NOME DA CAIXA POSTAL DO DESTINATARIO
    $this->campos['destinatario'] = ['234234', 35, ' ', STR_PAD_RIGHT, true]; 
    # 4 - DDMMAA (DATA DE USO DA APLICAÇÃO EDI)
    $this->campos['data'] = ['01022018', 6, '', STR_PAD_RIGHT, true];
    # 5 - HORA
    $this->campos['hora'] = ['1035', 4, '', STR_PAD_RIGHT, true]; # HHMM
    # 6 - IDENTIFICAÇÃO DO INTERCAMBIO
    # SUGESTÃO: "COB50DDMMSSS"
    #           "COB50" = CONSTANTE COBrança+VERSÃO 50
    #           "DDMM” = DIA/MÊS
    #           "SSS" = SEQUÊNCIA DE 000 A 999
    $this->campos['intercambio'] = ['COB502906001', 12, '', STR_PAD_RIGHT, true];
    # 7 - PREENCHER COM ESPAÇOS 
    $this->campos['filler'] = [' ', 185, '', STR_PAD_RIGHT, false]; 


    // Formata REGIST|RO 000
    #$linhas[] = $this;

    #echo "<pre>"; var_dump($linhas); var_dump($registros); exit;

}

/**
 *  
 * REGISTRO 550 - CABEÇALHO DE DOCUMENTO (UNH) - Preenchimento: OBRIGATÓRIO 
 * TAMANHO DO REGISTRO: 280 
 * 

}

# IMPORTANTE: PREENCHER OS 4 CAMPOS: CONTEUDO, TAMANHO, PREENCHIMENTO, LADO PREENCHIMENTO
$registro_550 = new stdClass(); 
# TAMANHO PARA VERIFICAÇÃO
$registro_550->length = 280;
$registro_550->max_lines = 200;
# IDENTIFICADOR DO REGISTRO - FIXO
$registro_550->registro = ['550', 3, '0', STR_PAD_RIGHT]; 
# iDENTIFICAÇÃO DO DOCUMENTO
# SUGESTÃO: "COBRA50DDMMSSS"
#           "COBRA50" = CONSTANTE COBrança+VERSÃO 50
#           "DDMM” = DIA/MÊS
#           "SSS" = SEQUÊNCIA DE 001 A 200
$registro_550->documento = ['COBRA502906001', 14, '', STR_PAD_RIGHT];
# PREENCHER COM ESPAÇOS 
$registro_550->filler = [' ', 263, '', STR_PAD_RIGHT]; 

// Formata REGIST|RO 000
$linhas[] = formata_edi($registro_550);

echo "<pre>"; var_dump($linhas); echo "</pre> <br> ";
#echo strlen($linhas);
exit;



// Cria um arquivo em modo de escrita
#$arquivo = fopen("doccob.txt", "w") or die("Unable to open file!");

// Contado de registros
$conta_registros = 0; 


/*
        // tratamento de string
        $dtaemissao = $registro['DTAHORAEMISSAO'];
        $dtaemissaonf = $registro['DTADF'];
        $dtavencto = $registro['DTAVENCTO']; // + 60 dias sobre dtaemissao       
        $vlrfrete = str_replace(array(',', '.'), array('', ''), $registro['FRETEVALOR']);
        $vlrtotal = str_replace(array(',', '.'), array('', ''), $registro['VLRTOTAL']);
        $peso = str_replace(array(',', '.'), array('', ''), $registro['PESOBRUTO']);

        if (!isset($soma)) {
            $soma = $vlrtotal;
        } else {
            $soma += $vlrtotal;
        }

        $vlrnominal = str_replace(array(',', '.'), array('', ''), $registro['FRETEVALOR']);
        $vlricms = str_replace(array(',', '.'), array('', ''), $registro['VLRICMS']);

        if ($qtd == 1) {// Caso seja o primeiro registro/nota cria as 4 primeiras linhas cabeçalho
            # CABEÇALHO DE INTERCAMBIO # 1 LINHA
            # ----------------------------------------------------------------------------------------------------------
            $arquivo->str_pad(000, 3, 0, STR_PAD_LEFT)->gravar(true);                                               # 1 
            $arquivo->str_pad('TRANSVILA', 35, ' ', STR_PAD_RIGHT)->gravar(true);                                   # 2 
            $arquivo->str_pad($registro['RNOMERAZAO'], 35, ' ', STR_PAD_RIGHT)->gravar(true);                       # 3 
            $arquivo->str_pad(date('dmy'), 6, 0, STR_PAD_LEFT)->gravar(true);                                       # 4
            $arquivo->str_pad(date('Hi'), 4, 0, STR_PAD_LEFT)->gravar(true);                                        # 5                   
            $arquivo->str_pad('COB' . date('dmhi') . '0', 12, ' ', STR_PAD_RIGHT)->gravar(true);                    # 6
            $arquivo->str_pad(' ', 75, '  ', STR_PAD_RIGHT)->gravar(false);                                         # 7
            # CABEÇALHO DE DOCUMENTO  # 2LINHA
            # ----------------------------------------------------------------------------------------------------------

            $arquivo->str_pad(350, 3, 0, STR_PAD_LEFT)->gravar(true);                                               # 1
            $arquivo->str_pad('COBRA' . date('dmHi') . '1', 14, ' ', STR_PAD_RIGHT)->gravar(true);                  # 2
            $arquivo->str_pad(' ', 153, '  ', STR_PAD_RIGHT)->gravar(false);                                        # 3
            # DADOS DA TRANSPORTADORA # 3 LINHA
            # ----------------------------------------------------------------------------------------------------------

            $arquivo->str_pad(351, 3, 0, STR_PAD_LEFT)->gravar(true);                                               # 1
            $arquivo->str_pad($empresa_cnpj, 14, 0, STR_PAD_LEFT)->gravar(true);                                    # 2
            $arquivo->str_pad('TRANSVILA', 40, '  ', STR_PAD_RIGHT)->gravar(true);                                  # 3
            $arquivo->str_pad(' ', 113, '  ', STR_PAD_RIGHT)->gravar(false);
            
            # DOCUMENTO DE COBRANCA # 4 LINHA
            # ----------------------------------------------------------------------------------------------------------

            $arquivo->str_pad(352, 3, 0, STR_PAD_LEFT)->gravar(true);                                               # 1
            $arquivo->str_pad('TRANSVILA', 10, ' ', STR_PAD_RIGHT)->gravar(true);                                   # 2
            $arquivo->str_pad(0, 1, 0, STR_PAD_LEFT)->gravar(true);                                                 # 3
            $arquivo->str_pad(' ', 3, ' ', STR_PAD_RIGHT)->gravar(true);                                            # 4
            $arquivo->str_pad($nrofatura, 10, 0, STR_PAD_LEFT)->gravar(true);                                       # 5
            $arquivo->str_pad($dtaemissaofat, 8, 0, STR_PAD_LEFT)->gravar(true);                                    # 6
            $arquivo->str_pad($dtavencto, 8, 0, STR_PAD_LEFT)->gravar(true);                                        # 7
            $arquivo->str_pad($vlrtotal, 15, 0, STR_PAD_LEFT)->gravar(true);                                        # 8
            $arquivo->str_pad(' ', 3, ' ', STR_PAD_RIGHT)->gravar(true);                                            # 9
            $arquivo->str_pad($vlricms, 15, 0, STR_PAD_LEFT)->gravar(true);                                         # 10
            $arquivo->str_pad(0, 15, 0, STR_PAD_LEFT)->gravar(true);                                                # 11
            $arquivo->str_pad($dtavencto, 8, 0, STR_PAD_LEFT)->gravar(true);                                        # 12
            $arquivo->str_pad(0, 15, 0, STR_PAD_LEFT)->gravar(true);                                                # 13
            $arquivo->str_pad('BRADESCO', 35, ' ', STR_PAD_RIGHT)->gravar(true);                                    # 14
            $arquivo->str_pad(3368, 4, 0, STR_PAD_LEFT)->gravar(true);                                              # 15
            $arquivo->str_pad(5, 1, ' ', STR_PAD_RIGHT)->gravar(true);                                              # 16
            $arquivo->str_pad(14104, 10, 0, STR_PAD_LEFT)->gravar(true);                                            # 17
            $arquivo->str_pad(6, 2, ' ', STR_PAD_RIGHT)->gravar(true);                                              # 18
            $arquivo->str_pad('I', 1, '  ', STR_PAD_RIGHT)->gravar(true);                                           # 19
            $arquivo->str_pad(' ', 168, '  ', STR_PAD_RIGHT)->gravar(false);
        }

        // Se for 1 registro ou caso mudar o NROCTRC
        if ($qtd == 1 || $registro['NROCTRC'] <> $nroctrcanterior) {

            # CONHECIMENTOS DE COBRANCA # 5 LINHA
            # ----------------------------------------------------------------------------------------------------------

            $arquivo->str_pad(353, 3, 0, STR_PAD_LEFT)->gravar(true);                                               # 1
            $arquivo->str_pad('TRANSVILA', 10, ' ', STR_PAD_RIGHT)->gravar(true);                                  # 2
            $arquivo->str_pad($registro['SERIECTRC'], 5, ' ', STR_PAD_RIGHT)->gravar(true);                                            # 3
            $arquivo->str_pad($registro['NROCTRC'], 12, ' ', STR_PAD_RIGHT)->gravar(true);                          # 4
            $arquivo->str_pad($vlrfrete, 15, 0, STR_PAD_LEFT)->gravar(true);                                        # 5
            $arquivo->str_pad($dtaemissao, 8, 0, STR_PAD_LEFT)->gravar(true);                                       # 6
            $arquivo->str_pad($registro['RCNPJCPF'], 14, 0, STR_PAD_LEFT)->gravar(true);                          # 7
            $arquivo->str_pad($registro['DCNPJCPF'], 14, 0, STR_PAD_LEFT)->gravar(true);                         # 8
            $arquivo->str_pad($registro['DCNPJCPF'], 14, 0, STR_PAD_LEFT)->gravar(true);                         # 9
            $arquivo->str_pad(' ', 75, '  ', STR_PAD_RIGHT)->gravar(false);
        }

        # NF COBRANCA EM CONHECIMENTO # 6 LINHA
        # ---------------------------------------------------------------------------------------------------------
        // Esta parte repete a cada registro
        $arquivo->str_pad(354, 3, 0, STR_PAD_LEFT)->gravar(true);

        $seriedf = ($registro['SERIEDF'] == 3) ? '0' . $registro['SERIEDF'] : $registro['SERIEDF'];
        # 1
        $arquivo->str_pad($seriedf, 3, ' ', STR_PAD_RIGHT)->gravar(true);                           # 2
        $arquivo->str_pad($registro['NUMERODF'], 8, 0, STR_PAD_LEFT)->gravar(true);                             # 3
        $arquivo->str_pad($dtaemissaonf, 8, 0, STR_PAD_LEFT)->gravar(true);                                     # 4
        $arquivo->str_pad($peso, 7, 0, STR_PAD_LEFT)->gravar(true);                                             # 5
        $arquivo->str_pad($vlrtotal, 15, 0, STR_PAD_LEFT)->gravar(true);                                        # 6
        $arquivo->str_pad($registro['RCNPJCPF'], 14, 0, STR_PAD_LEFT)->gravar(true);                            # 7
        $arquivo->str_pad(' ', 112, '  ', STR_PAD_RIGHT)->gravar(false);

        if ($qtd == $total_registros) {  // Se for ultimo registro fecha com a ultima linha
            # TOTAL DE DOCUMENTOS DA COBRANCA # 7 LINHA
            # --------------------------------------------------------------------------------------------------------
            $arquivo->str_pad(355, 3, 0, STR_PAD_LEFT)->gravar(true);                                            # 1
            $arquivo->str_pad($qtd, 4, 0, STR_PAD_LEFT)->gravar(true);                                           # 2
            $arquivo->str_pad($soma, 15, 0, STR_PAD_LEFT)->gravar(true);                                             # 3 
            $arquivo->str_pad(' ', 148, '  ', STR_PAD_RIGHT)->gravar(false);
        }

        $nroctrcanterior = $registro['NROCTRC'];

        $qtd++;
    }
    // Fecha o arquivo para escrita
    $arquivo->finalizar_escrita();
}
*/

