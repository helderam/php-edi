<?php

namespace App\Proceda;

use App\ValidaCampo;

class Doccob
{
    var $conta_000 = 0;

    public function registro_000($remetente, $destinatario, $data, $hora, $intercambio, $tamanho)
    {
        // 1 - IDENTIFICADOR DO REGISTRO - SEMPRE 000
        $linha = '000';

        // 2 - IDENTIFICAÇÃO DO REMETENTE - ALFA 35 - OBRIGATÓRIO
        $linha .= validar('REMETENTE', $remetente, 35, true);

        // 3 - IDENTIFICAÇÃO DO DESTINATÁRIO - ALFA 35 - OBRIGATÓRIO
        $linha .= validar('DESTINATARIO', $destinatario, 35, true );

        // 4 - DATA - NUM 6 - OBRIGATORIO
        $linha .= validar('DATA', $data, 6, true);
      
        // 5 - HORA - NUM 4 - OBRIGATORIO
        $linha .= validar('HORA', $hora, 4, true);

        /* 6 - IDENTIFICAÇÃO DO INTERCAMBIO - 12 - OBRIGATÓRIO
           SUGESTÃO: "COB50DDMMSSS"
                     "COB50" = CONSTANTE COBrança+VERSÃO 50
                     "DDMM” = DIA/MÊS
                     "SSS" = SEQUÊNCIA DE 000 A 999
        */
        $linha .= validar('INTERCAMBIO', 'COB502906001', 12, true);

        // 7 - PREENCHER COM ESPAÇOS - 285 - OBRIGATÓRIO
        $linha .= validar('ESPAÇO',' ', 185, true); 

        if ($tamanho != strlen($linha)) {
          throw new Exception("REGISTRO 000 NAO CONFERE TAMANHO DE {$tamanho}");
        }

        $this->conta_000++;

        if ($this->conta_000 > 1) {
          throw new Exception("REGISTRO 000 OCORRE MAIS DE 1 VEZ");
        }

        return $linha;
    }
}
