<?php

/**
 * Twitter用サムネイル画像生成
 */

    $err = false;
    $memID = $_GET["memberID"];
    $contentID = $_GET["contentID"];

    $img = imagecreate(1000, 500);
    imageantialias ( $img , false );

    $white = imagecolorallocate($img, 255, 255, 255);
    $gray = imagecolorallocate($img, 66, 66, 66);

    $font = "../fonts/ipaexm.ttf";

    $url = "../backnumbers/text/".$contentID."_".$memID."_0.txt";
    $text = file_get_contents($url);
    $text = mb_substr($text, 1);
    $text = str_replace(array("\r", "\n"), '', $text);

    for($i = 0; $i < 8; $i++){
        $textal = mb_substr($text, $i * 21, 21, "UTF-8");
        imagettftext($img, 30, 0, 80, 90 + 50 * $i, $gray, $font, $textal);
    }

    header('Content-Type: image/png');

    imagepng($img);
?>
