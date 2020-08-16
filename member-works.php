<?php
    ini_set('display_errors', "On");
    require_once 'utils/functions.php';

    $memID = $_GET["memberID"];
    $author = getAuthorData($memID);
    $dataa = getMemberContentList($memID);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>個人詳細</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:100,200,300,400&display=swap" rel="stylesheet"> 
    <link rel="resetcss" href="./styles/reset.css">
    <link rel="stylesheet" href="./styles/styleSP.css" media="screen and (max-width:600px)">
    <link rel="stylesheet" href="./styles/style.css" media="screen and (min-width:600px)">
</head>
<body>
    <section>
    <h2><?php echo $author->name; ?></h2>
    <?php
        content_element("執筆作品", null, $dataa);

        comment_element($memID, null, "この作者へのコメント", null, 5);
    ?>
    </section>
</body>
