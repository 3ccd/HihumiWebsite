<?php

/**
 * XSS対策していないので使用しない。
 * もしデプロイするなら削除
 */

    ini_set('display_errors', "On");
    require_once 'utils/functions.php';
    defaultHeader();
    navBar();
?>

    <section class="section-latest">

        <h2>コメント一覧</h2>

    <?php
        $viewMode = 0;
        $memberID = $_GET["mid"];
        $contentID = $_GET["cid"];

        if(isset($_POST["title"]) && isset($_POST["body"])){
            $file = file_get_contents("./databases/comment.json");
    
            $json = json_decode($file,false);
            
            $input = new stdClass();
            if(!is_null($_POST["title"]))$input->title =$_POST["title"];
            if(!is_null($_POST["body"]))$input->body =$_POST["body"];
            $input->date = date('Y-m-d H:i:s');
            $input->hidden = 0;
            $input->content = $contentID;
            $input->to = $memberID;
            
            $json->comments[]= $input;
            
            file_put_contents("./databases/comment.json", json_encode((object)$json,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        }

        $dataa = getContentData($memberID,$contentID);

        echo '<h3>'.$dataa[0]->title.' - '.$dataa[0]->author.'</h3>';

        echo '<form action ="comment-viewer.php?mid='.$memberID.'&cid='.$contentID.'" method="POST">

                    <div>

                        <p>投稿する</p>
                        <label>タイトル</label><br>
                        <input type = "text" name="title"><br>
                        <label>本文</label><br>
                        <input type = "text" name="body"><br>
                        <input type ="submit" name ="投稿">

                    </div>

                </form>';

        echo '<div class="spacer-m"></div>';

        comment_element($memberID, $contentID, "投稿されたコメント", null, 10);

        echo '<div class="spacer-m"></div>';

    ?>
    </section>

<?php
    getFooter();
?>
