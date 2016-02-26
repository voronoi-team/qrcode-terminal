<?php

namespace Shelwei;

use \PHPQRCode\QRencode;
use \PHPQRCode\Constants;

class QRCode
{
    public static function terminal($text, $level = Constants::QR_ECLEVEL_L, $size = 3, $margin = 4)
    {
        $backColor = "\033[40m  \033[0m";
        $foreColor = "\033[47m  \033[0m";

        $enc = QRencode::factory($level, $size, $margin);
        $qrcode = $enc->encode($text, false);

        $output = '';
        foreach($qrcode as $k=>$qr){
            $len = strlen($qr);
            $border = str_repeat($foreColor, $len + 2);
            if($k === 0){
                $output .= $border . "\n";
            }
            $curLine = '';
            for($i = 0; $i< strlen($qr); $i++){
                $curLine .= ($qr[$i] ? $backColor : $foreColor);
            }
            $output .= $foreColor. $curLine. $foreColor. "\n";

            if($k === $len -1){
                $output .= $border . "\n";
            }
        }
        return $output;
    }
}