<?php

$x = str_pad('123', 5, '0', STR_PAD_LEFT);

$string = 9;
echo str_pad($string, 5, '*', STR_PAD_LEFT); // Resultado: ****9

var_dump($x);