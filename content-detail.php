<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文芸サークル 灯文</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+JP:200,400&amp;subset=japanese" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="resetcss" href="./styles/reset.css">
    <link rel="stylesheet" href="./styles/styleSP.css" media="screen and (max-width:600px)">
    <link rel="stylesheet" href="./styles/style.css" media="screen and (min-width:600px)">
</head>
<body>

    <section class="content-detail">
<?php
    ini_set('display_errors', "On");
    require_once 'utils/functions.php';
    $contentid = $_GET["contentID"];

    $dataa = getVolumeContentList($contentid);

    if(file_exists('./images/backnumberThumbnails/'.$contentid.'.png')){
        echo '<img src="./images/backnumberThumbnails/'.$contentid.'.png" alt="thumbnail" class="content-img">';
    }else{
        echo '<img src="./images/backnumberThumbnails/noimage.png" alt="thumbnail" class="content-img">';
    }

    content_element("収録作品", null, $dataa);
    comment_element(null, $contentid, "収録作品へのコメント", null, 5);
?>
    </section>