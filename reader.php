<?php
    ini_set('display_errors', "On");
    $mid = $_GET["mid"];
    $cid = $_GET["cid"];
    $cnum = $_GET["cnum"];
    $sp = $_GET["sp"];
    $ep = $_GET["ep"];

    require_once 'picgen-info.php';
    //readfile("http://3ccd.jp/wwwroot/picgen-info.ph");

    $info = getPageInfo($mid, $cid, $cnum);

    $pages = count($info);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/reset.css">
  <link rel="stylesheet" href="styles/swiper.css">
  <title>文芸サークル灯文</title>
</head>
<body>
  <div class="swiper-container">
    <div class="swiper-wrapper">
    <?php
        for($i = 0; $i <= $ep - $sp; $i++){
            $j = $ep - $i;
            echo'<div class="swiper-slide"><img src="http://3ccd.jp/wwwroot/picgen.php?mid='.$mid.'&cid='.$cid.'&cnum='.$cnum.'&page='.$j.'&schar='.$info[$j].'" alt="Swiper'.$j.'"></div>';
        }
    ?>
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
<script src="scripts/swiper.js"></script>
<script>
  var swiper = new Swiper('.swiper-container', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    initialSlide: <?php echo $ep - $sp;?>,
    centeredSlides: true
  });
</script>
</body>
</html>