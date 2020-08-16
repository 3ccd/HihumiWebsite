<?php
    require_once "utils/functions.php";

    $readerMode = false;

    if(isset($_GET["mid"]) && isset($_GET["cid"]) && isset($_GET["cnum"])){
        $memID = $_GET["mid"];
        $contentID = $_GET["cid"];
        $contentNum = $_GET["cnum"];

        $readerMode = true;
        $data = getContentData($memID, $contentID);
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文芸サークル灯文</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:100,200,300,400&display=swap" rel="stylesheet"> 
    <link rel="resetcss" href="./styles/reset.css">
    <link rel="stylesheet" href="./styles/styleSP.css" media="screen and (max-width:600px)">
    <link rel="stylesheet" href="./styles/style.css" media="screen and (min-width:600px)">
    <?php if($readerMode): ?>
    <meta name="twitter:site" content="@Tritonia_h" />
    <meta name="twitter:title" content="<?php echo $data[$cnum]->title ?> - <?php echo $data[$cnum]->author ?>" />
    <meta name="twitter:description" content="京都産業大学　文芸サークル　灯文" />
    <meta name="twitter:image" content="http://www.cc.kyoto-su.ac.jp/~g1853149/hihumi/thumbnail-generator.php?memberID=<?php echo $memID ?>&contentID=<?php echo $contentID ?>&cnum=<?php echo $contentNum ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <?php endif; ?>

    <script>
    function changeTwitterWidgetDesign(){
        var twitter_widget = document.getElementById('twitter-widget-0');
        var style = document.createElement("link");
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('href', './styles/style.css');
        
        if (twitter_widget !== null){
            var twitter_widget_head = twitter_widget.contentWindow.document.querySelector('head');
            twitter_widget_head.appendChild(style);
        }
        else {
            setTimeout(function(){
            changeTwitterWidgetDesign();
            }, 350);
        }
    }
    
    changeTwitterWidgetDesign();
    </script>

</head>

<body onload="startAnimation()">
<div class="topspacer"></div>
