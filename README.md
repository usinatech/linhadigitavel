# LinhaDigitavel
Pacote para capturar a linha digitável do boleto do PagSeguro em PHP 

Instalando o Tesseract no Debian:  
**sudo apt-get install tesseract-ocr**

Instalando o Tesseract no Mac: 
**brew install tesseract**

Utilizando o pacote no seu projeto PHP: 
```
<?php

use UsinaTech\LinhaDigitavel\LinhaDigitavel;

require __DIR__ . '/vendor/autoload.php';

$boletoURL = 'https://pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=xxxxx';

$ld = new LinhaDigitavel;

echo $ld->capture($boletoURL) . PHP_EOL;

```