<?php

class EdiDoccob
{
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
    const CODE = '000'; // Codigo identificador do registro

    // Armazena validação
    var $validar;
    // Tamanho da linha completa
    var $length; 
    // Quantidade maxima de linhas deste tipo no total dos registros
    var $max_lines; 
    // Quantidade total de campos 
    var $fields; 
    // Armazenar campos
    var $campos;

    /**
     * Formata o registro convertendo em linha conforme parametros
     * @param Registro $objeto
     * @return string
     * @throws \NFePHP\NFe\Exception\DocumentsException - PRECISA AJUSTAR AQUI
     */
    public function FormataEdi()
    {
        // Verifica quantidade de campos
        if (count($objeto->campos) != $objeto->fields) {
            throw new Exception("QUANTIDADE DE CAMPOS NÃO CONFEREM ");
        }
        // Cria linha a partir dos campos
        $linha = '';
        foreach ($this->campos as $campo) {
            $tamanho = (int) empty($campo[1]) ? 1 : $campo[1]; # minimo de 1 tamanho
            $conteudo = substr($campo[0], 0, $tamanho); # corta par que caiba no tamanho
            $preenchimento = isset($campo[2]) ? $campo[2] : ' '; # Se não informado, então espaço
            $preenchimento = empty($preenchimento) ? ' ' : $preenchimento; # preechimento default de espaço
            $lado = isset($campo[3]) ? $campo[3] : STR_PAD_RIGHT; # lado preenchimento dafault a direita
            $obrigatorio = isset($campo[4]) ? $campo[4] : false;
            // Verifica se campo orbigatorio preenchimento
            if ($obrigatorio && empty($conteudo)) {
                throw new Exception('CAMPO OBRIGATORIO NÃO PREENCHIDO');
            }
            $linha .= str_pad($conteudo, $tamanho, $preenchimento, $lado);
        }
        if (strlen($linha) != $this->length) {
            throw new Exception('TAMANHO DA LINHA NÃO CONFERE');
        }
        
        $this->validar[$objeto->code_id] = $this->validar[$objeto->code_id] + 1 | 1;
        return $linha;
    }
}
