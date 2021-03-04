<?php

namespace UsinaTech\LinhaDigitavel;

use Ramsey\Uuid\Uuid; 

class LinhaDigitavel
{

    public function capture($boletoURL) {
    
        $boletoURL = str_replace('print', 'print_image', $boletoURL);

        $im = imagecreatefrompng($boletoURL);

        $uuid = Uuid::uuid4();
        
        $boletoTempfile = sys_get_temp_dir()  . '/boleto-'.$uuid. '.png';
        $ldTempfile = sys_get_temp_dir() . '/ld-'.$uuid ;

        imagepng($im , $boletoTempfile); 

        exec('tesseract '.$boletoTempfile.' '.$ldTempfile);   

        $handle = fopen($ldTempfile . '.txt','r');
        
        $content ='';

        while (!feof($handle)) {
            $content .= fread($handle, 8192);
          }
        fclose ($handle);

        preg_match('[\d{5}\.\d{5}\ \d{5}\.\d{6}\ \d{5}\.\d{6}\ \d{1}\ \d{14}]', $content, $linhadigitavel);

        unlink($boletoTempfile);
        unlink($ldTempfile.'.txt');

        return $linhadigitavel[0];
    }
}