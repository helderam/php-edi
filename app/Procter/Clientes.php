<?php
namespace App\Procter;

use App\Layout;
use App\Campo;

class Clientes
{
    var $conta_clientes;

    public function registro_clientes($sap_mae, $sap_filial, $cgc_cpf, $razao, $ramo, $endereco, $bairro, $cidade, $estado, $cep, $telefone, $setor, $numero)
    {
        $conta_clientes = 0;

        $layout = new Layout();

        // CAMPO: ORDEM, DESCRIÇÃO, CONTEUDO, TIPO N/A, TAMANHO, OBRIGATORIO
        $layout->adiciona(new Campo(1,'COD SAP MAE', $sap_mae, NUMERICO, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(2,'COD SAP FILIAL', $sap_filial, NUMERICO, 15, OBRIGATORIO));
        $layout->adiciona(new Campo(3,'CGC/CPF', $cgc_cpf, ALFA, 14, OBRIGATORIO));
        $layout->adiciona(new Campo(4,'RAZAO SOCIAL', $razao, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(5,'RAMO', $ramo, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(6,'ENDERECO', $endereco, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(7,'BAIRRO', $bairro, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(8,'CIDADE', $cidade, ALFA, 50, OBRIGATORIO));
        $layout->adiciona(new Campo(9,'ESTADO', $estado, ALFA, 2, OBRIGATORIO));
        $layout->adiciona(new Campo(10,'CEP', $cep, ALFA, 10, OPCIONAL));
        $layout->adiciona(new Campo(11,'TELEFONE', $telefone, ALFA, 20, OPCIONAL));
        $layout->adiciona(new Campo(12,'SETOR', $setor, ALFA, 10, OBRIGATORIO));
        $layout->adiciona(new Campo(13,'NUMERO', $numero, ALFA, 2, OBRIGATORIO));

        $conta_clientes++;
        
        $linha = $layout->gera_linha();
        // Gera linha conforme o layout
        return $linha;
    }
}