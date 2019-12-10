<?php

namespace Shelwei;

use Endroid\QrCode\QrCode as BaseQRCode;
use Endroid\QrCode\ErrorCorrectionLevel;

class QRCode
{
    public static function terminal($text, $level = null, $size = 3, $margin = 4)
    {
        $backColor = "\033[40m  \033[0m";
        $foreColor = "\033[47m  \033[0m";

        $qrCode = new BaseQRCode($text);
        $qrCode->setErrorCorrectionLevel($level ?? ErrorCorrectionLevel::HIGH());

        $data = $qrCode->getData();

        $output = '';
        foreach($data["matrix"] as $k => $data) {
            $len = count($data);
            $border = str_repeat($foreColor, $len + 2);
            if($k === 0){
                $output .= $border . "\n";
            }
            $curLine = '';
            for($i = 0; $i< count($data); $i++){
                $curLine .= ($data[$i] ? $backColor : $foreColor);
            }
            $output .= $foreColor. $curLine. $foreColor. "\n";

            if($k === $len -1){
                $output .= $border . "\n";
            }
        }
        return $output;
    }
}
