    <?php

    require 'utils/functions.php';

    $memID = $_GET["memberID"];
    $contentID = $_GET["contentID"];

    $cnum = 0;
    if(isset($_GET["cnum"]))$cnum = $_GET["cnum"];

    $data = getContentData($memID, $contentID);

    $linePerPage = 100;
    $pages = 0;
    $lines = 0;
    $text = null;
    $url = "./backnumbers/text/".$contentID."_".$memID."_".$cnum.".txt";
    if(file_exists($url) == true){
        $text = file_get_contents($url);
        $text = explode("\n", $text);
        $lines = count($text);
        $pages = intval($lines / $linePerPage);
    }
    $page = 0;
    if(isset($_GET["page"])){
        if($_GET["page"] > $pages){
            $page = $pages;
        }else{
            $page = $_GET["page"];
        }
    }


    ReaderHeader($memID, $contentID, $cnum);
    NavigationBar(); 
    ?>

    <section class="section-latest">
    <?php
        
        $image_frag = false;
        $image_url = "./images/embeddedImages/".$contentID."_".$memID."_".$cnum.".png";
        if(file_exists("./images/embeddedImages/".$contentID."_".$memID."_".$cnum.".png") == true){
            echo '<div class="embedded-image" style="background-image: url(';
            echo "'".$image_url."'";
            echo ')"></div>';
            $image_frag = true;
            echo'<div class="description-element">';
        }else{
            echo '<div>';
        }
        
        echo '<h2><span>'.$data[$cnum]->title.'</span></h2>';
	    echo '<p><a href="javascript:void(0);" onclick="showMemberWorks(&quot;'.$memID.'&quot;)"><span>'.$data[$cnum]->author.'</span></a></p>';
        echo '<p><span>'.$data[$cnum]->year.'年発行 <a href="javascript:void(0);" onclick="showContentDetail(&quot;'.$contentID.'&quot;)">'.$data[$cnum]->contenttitle.'</a>に収録</span></p>';
        echo '<p><span>コメント、ご感想は<a href="./comment-viewer.php?cid='.$contentID.'&mid='.$memID.'">こちら</a>にどうぞ</span></p>';
        if($image_frag)echo '<p><a href="'.$image_url.'"><span>画像を表示</span></a></p>';
        echo '</div>';

        $pageurl = './online-reader.php?memberID='.$memID.'&contentID='.$contentID.'&cnum='.$cnum.'&page=';
        if($pages != 0){
            echo '<div class="pagenation">';
            if($page != 0){
                $prev = $page -1;
                echo '<a href="'.$pageurl.$prev.'"><</a>';
            }
            for($i = 0; $i <= $pages; $i++){
                if($i == $page){
                    echo '<a class="nowpage">'.$i.'</a>';
                }else{
                    echo '<a href="'.$pageurl.$i.'">'.$i.'</a>';
                }
            }
            if($page != $pages){
                $next = $page +1;
                echo '<a href='.$pageurl.$next.'>></a>';
            }
            echo '</div>';
        }

        if($text != null){

            echo '<p class="text-body">';

            $startLine = $page * $linePerPage;
            $endLine = $startLine + $linePerPage;
            if($endLine > $lines){
                $endLine = $lines;
            }
            for($i = $startLine; $i < $endLine; $i++){
                echo $text[$i];
                echo "<br>";
            }
    
            echo '</p>';

        }else{

            echo '<p>この作品のバックナンバーは用意できておりません。</p>';

        }

    ?>
    </section>
    
    <?php
    $pageurl = './online-reader.php?memberID='.$memID.'&contentID='.$contentID.'&cnum='.$cnum.'&page=';
    if($pages != 0){
        echo '<div class="pagenation">';
        if($page != 0){
            $prev = $page -1;
            echo '<a href="'.$pageurl.$prev.'"><</a>';
        }
        for($i = 0; $i <= $pages; $i++){
            if($i == $page){
                echo '<a class="nowpage">'.$i.'</a>';
            }else{
                echo '<a href="'.$pageurl.$i.'">'.$i.'</a>';
            }
        }
        if($page != $pages){
            $next = $page +1;
            echo '<a href='.$pageurl.$next.'>></a>';
        }
        echo '</div>';
    }
    ?>

    <?php 
    Footer(); 
    PageEnd();
    ?>
