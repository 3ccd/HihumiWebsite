<?php
    require 'utils/functions.php';
    DefaultHeader();
    NavigationBar();
?>
    
    <section class="section-what" id="what">
        <h2>今までに発行した部誌</h2>
        <p>画像をクリックすると詳細をご覧いただけます</p>
    </section>

    <section>
        <?php

            echo '
                <ul class="backnumber-list">';
            
                $url = "./databases/hihumi_backnumber.json";
                $backnumberJson = file_get_contents($url);
                $backnumberJson = mb_convert_encoding($backnumberJson, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
                $backnumberArray = json_decode($backnumberJson,false);

                $qua = count($backnumberArray->backnumber);

                for($i = $qua -1; $i > 0; $i--){
                    echo '<li class="backnumber-element">';
                    if(file_exists('./images/backnumberThumbnails/'.$backnumberArray->backnumber[$i]->id.'.png')){
                        echo '<img src="./images/backnumberThumbnails/'.$backnumberArray->backnumber[$i]->id.'.png" alt="thumbnail" class="backnumber-pic" onclick="showContentDetail(&quot;'.$backnumberArray->backnumber[$i]->id.'&quot;)">';
                    }else{
                        echo '<img src="./images/backnumberThumbnails/noimage.png" alt="thumbnail" class="backnumber-pic" onclick="showContentDetail(&quot;'.$backnumberArray->backnumber[$i]->id.'&quot;)">';
                    }
                    echo '<p>'.$backnumberArray->backnumber[$i]->year.$backnumberArray->backnumber[$i]->title.'</p>';
                    echo '</li>';
                }
            echo'
                </ul>';
        ?>
    </section>

<?php
    Footer();
    PageEnd();
?>
