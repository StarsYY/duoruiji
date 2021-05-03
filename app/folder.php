<?php
function mkdirs($path, $mode = 0777)
{
    if (!file_exists($path))
    {
        mkdirs(dirname($path), $mode);
        mkdir($path, $mode);
    }
}

function getQRCode($date, $outfile){
    $path = app_path() . "/phpqrcode/phpqrcode.php";
    include_once $path;
    $level = "L";
    $size = 10;
    $margin = 1;
    $saveandprint = false;
    $back_color = 0xFFFFFFF;
    $fore_color = 0x000000;
    $QRcode = new QRcode();
    $QRcode->png($date, $outfile, $level, $size, $margin, $saveandprint, $back_color, $fore_color);
    return $outfile;
}
