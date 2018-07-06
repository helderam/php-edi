<?php

namespace Doccob;

class Doccob 
{
    public function registro_000($remetente, $destinatario, $data, $hora, $intercambio) 
    {
      $linha = '000';
      if (strlength($remetente) > 35) {
         throw exception "TANANHO CAMPO REMETENTE MAIOR QUE 35";
      }
      $linha .= str_pad($remetente, 35, ' ',  STR_PAD_RIGHT);
      
      return $linha;
    }
}
