<?php

/**
 * 各種関数
 */

define('SERVER_PATH', "http://" .$_SERVER["SERVER_NAME"].str_replace($_SERVER["DOCUMENT_ROOT"], "",  dirname(__FILE__)));


//--------Json Database Operations---------//

function getMemberDatabase(){
    $url = "../databases/hihumi_member.json";
    $memberJson = file_get_contents($url);
    $memberJson = mb_convert_encoding($memberJson, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $memberArray = json_decode($memberJson,false);
    return $memberArray;
}

function getContentDatabase(){
    $url = "../databases/hihumi_backnumber.json";
    $backnumberJson = file_get_contents($url);
    $backnumberJson = mb_convert_encoding($backnumberJson, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $backnumberArray = json_decode($backnumberJson,false);
    return $backnumberArray;
}

//--------Template Functions---------//

//echo html header (include meta data for twitter)
function ReaderHeader($mid, $cid, $cnum){
    $_GET["cid"] = $cid;
    $_GET["mid"] = $mid;
    $_GET["cnum"] = $cnum;
    include("./header.php");
}

//echo html header (without meta data)
function DefaultHeader(){
    include("./header.php");
}

//echo NavigationBar
function NavigationBar(){
    include("./navBar.php");
}

//echo footer
function Footer(){
    include("./footer.php");
}

//echo html tag of page end
function PageEnd(){
    include("./pageEnd.php");
}

//--------

function getAuthorData($mid){

    $memberArray = getMemberDatabase();

    for($i = 0; $i < count($memberArray->members); $i++){
        if(strcmp($mid, $memberArray->members[$i]->id) == 0){

            $temp["name"] = $memberArray->members[$i]->name;
            $temp["position"] = $memberArray->members[$i]->position;
            $temp["department"] = $memberArray->members[$i]->department;
            $temp["grade"] = $memberArray->members[$i]->grade;
            $temp["introduction"] = $memberArray->members[$i]->introduction;

            $output = (object)$temp;
        }
    }
    return $output;
}

function getVolumeData($cid){
    $backnumberArray = getContentDatabase();

    for($i = 0; $i < count($backnumberArray->backnumber); $i++){
        if(strcmp($cid, $backnumberArray->backnumber[$i]->id) == 0){
            $contTemp = array();

            $contTemp["volume_title"] = $backnumberArray->backnumber[$i]->title;
            $contTemp["year"] = $backnumberArray->backnumber[$i]->year;
            $contTemp["id"] = $backnumberArray->backnumber[$i]->id;
            $contTemp["title"] = $backnumberArray->backnumber[$i]->content[$j]->title;
            $contTemp["author"] = $backnumberArray->backnumber[$i]->content[$j]->author;
            $contTemp["author_id"] = $backnumberArray->backnumber[$i]->content[$j]->authorid;
            if(isset($backnumberArray->backnumber[$i]->content[$j]->aux)){
                $contTemp["aux"] = $backnumberArray->backnumber[$i]->content[$j]->aux;
            }

            $output = (object)$contTemp;
        }
    }

    return $output;
}

function getContentData($mid, $cid){

    $backnumberArray = getContentDatabase();

    for($i = 0; $i < count($backnumberArray->backnumber); $i++){
        if(strcmp($cid, $backnumberArray->backnumber[$i]->id) == 0){
            for($j = 0; $j < count($backnumberArray->backnumber[$i]->content); $j++){

                if(strcmp($mid, $backnumberArray->backnumber[$i]->content[$j]->authorid) == 0){

                    $contTemp = array();

                    $contTemp["volume_title"] = $backnumberArray->backnumber[$i]->title;
                    $contTemp["year"] = $backnumberArray->backnumber[$i]->year;
                    $contTemp["id"] = $backnumberArray->backnumber[$i]->id;
                    $contTemp["title"] = $backnumberArray->backnumber[$i]->content[$j]->title;
                    $contTemp["author"] = $backnumberArray->backnumber[$i]->content[$j]->author;
                    $contTemp["author_id"] = $backnumberArray->backnumber[$i]->content[$j]->authorid;
                    if(isset($backnumberArray->backnumber[$i]->content[$j]->aux)){
                        $contTemp["aux"] = $backnumberArray->backnumber[$i]->content[$j]->aux;
                    }

                    $output[] = (object)$contTemp;

                }
            }
        }
    }

    return $output;
}

function getMemberContentList($mid){

    $backnumberArray = getContentDatabase();

    for($j = 0; $j < count($backnumberArray->backnumber); $j++){
        if(isset($backnumberArray->backnumber[$j]->content))for($k = 0; $k < count($backnumberArray->backnumber[$j]->content); $k++){
            if(strcmp($mid, $backnumberArray->backnumber[$j]->content[$k]->authorid) == 0){

                $workTemp = array();

                $workTemp["volume_title"] = $backnumberArray->backnumber[$j]->title;
                $workTemp["year"] = $backnumberArray->backnumber[$j]->year;
                $workTemp["id"] = $backnumberArray->backnumber[$j]->id;
                $workTemp["title"] = $backnumberArray->backnumber[$j]->content[$k]->title;
                $workTemp["author"] = $backnumberArray->backnumber[$j]->content[$k]->author;
                $workTemp["author_id"] = $backnumberArray->backnumber[$j]->content[$k]->authorid;
                if(isset($backnumberArray->backnumber[$j]->content[$k]->aux)){
                    $workTemp["aux"] = $backnumberArray->backnumber[$j]->content[$k]->aux;
                }

                $output[] = (object)$workTemp;
            }
        }
    }
    return $output;
}

function getVolumeContentList($cid){

    $backnumberArray = getContentDatabase();

    for($j = 0; $j < count($backnumberArray->backnumber); $j++){
        if(strcmp($cid, $backnumberArray->backnumber[$j]->id) == 0){
            if(isset($backnumberArray->backnumber[$j]->content))for($k = 0; $k < count($backnumberArray->backnumber[$j]->content); $k++){
                $workTemp = array();

                $workTemp["volume_title"] = $backnumberArray->backnumber[$j]->title;
                $workTemp["year"] = $backnumberArray->backnumber[$j]->year;
                $workTemp["id"] = $backnumberArray->backnumber[$j]->id;
                $workTemp["title"] = $backnumberArray->backnumber[$j]->content[$k]->title;
                $workTemp["author"] = $backnumberArray->backnumber[$j]->content[$k]->author;
                $workTemp["author_id"] = $backnumberArray->backnumber[$j]->content[$k]->authorid;
                if(isset($backnumberArray->backnumber[$j]->content[$k]->aux)){
                    $workTemp["aux"] = $backnumberArray->backnumber[$j]->content[$k]->aux;
                }

                $output[] = (object)$workTemp;
            }
        }
    }
    return $output;
}

function getAllMemberData(){
    return getMemberDatabase();
}

function content_element($title, $link, $array){
    echo '<div>';
    
    content_header($title, $link);

    if($array == null){
        echo '<p>データがありません。</p>';
    }else{
        $qua = count($array);
        for($i = 0; $i < $qua; $i++){
            if(isset($array[$i]->aux)){
                //echo '<a class="content-item" href="./online-reader.php?memberID='.$array[$i]->author_id.'&contentID='.$array[$i]->id.'&cnum='.$array[$i]->aux.'" target="_top">';
                echo '<a class="content-item" href="./works.php?mid='.$array[$i]->author_id.'&cid='.$array[$i]->id.'&cnum='.$array[$i]->aux.'" target="_top">';
            }else{
                //echo '<a class="content-item" href="./online-reader.php?memberID='.$array[$i]->author_id.'&contentID='.$array[$i]->id.'" target="_top">';
                echo '<a class="content-item" href="./works.php?mid='.$array[$i]->author_id.'&cid='.$array[$i]->id.'&cnum=0" target="_top">';
            }
            echo '<div><p>'.$array[$i]->title.'</p>';
            echo '<p class="description-text">'.$array[$i]->author.'</p>';
            echo '<p class="description-text">'.$array[$i]->volume_title.'</p>';
            echo '</div></a>';
        }
    }
    echo '</div>';
}

function comment_element($mid, $cid, $title, $link, $qua){
    $data = getCommentList($mid, $cid);

    content_header($title, $link);

    echo '<div>';

    if($data == null){
        echo'<p>まだコメントはありません。ぜひご感想をお寄せください！</p>';
        echo '</div>';
        return;
    }

    for($i = 0, $c = count($data) -1; $i <= $c; $i++){
        $v = $c - $i;
        if($data[$v]->hidden != 1){
            echo '<div class="content-item">';
            echo '<div>';
            echo '<p>'.$data[$v]->title.'</p>';
            echo '<p class="description-text">'.$data[$v]->body.'</p>';
            echo '<p class="description-text">（ '.getContentData($data[$v]->to, $data[$v]->content)[0]->title.' に投稿 ）</p>';
            echo '</div></div>';
        }
        if($i == $qua)break;
    }
    echo '</div>';
}

function content_header($title, $link){
    echo '
        <div class="content-header">
            <h4>'.$title.'</h4>
    ';
    if($link != null){
        echo '<a href="'.$link.'">もっと見る></a>';
    }
        
    echo '</div>';
}

function getCommentList($memberID, $contentID){
    $url = "./databases/comment.json";
    $commentJson = file_get_contents($url);
    $commentJson = mb_convert_encoding($commentJson, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $commentArray = json_decode($commentJson,false);

    $searchMode = 1;
    if($memberID == null && $contentID == null){
        $searchMode = 0;
    }elseif($memberID == null){
        $searchMode = 3;
    }elseif($contentID == null){
        $searchMode = 2;
    }

    switch($searchMode){
        case 0:
            $comment = $commentArray->comments;
            break;
        case 1:
            for($i = 0; $i < count($commentArray->comments); $i++){
                if(strcmp($memberID, $commentArray->comments[$i]->to) == 0 && strcmp($contentID, $commentArray->comments[$i]->content) == 0){
    
                    $temp["date"] = $commentArray->comments[$i]->date;
                    $temp["to"] = $commentArray->comments[$i]->to;
                    $temp["content"] = $commentArray->comments[$i]->content;
                    $temp["hidden"] = $commentArray->comments[$i]->hidden;
                    $temp["title"] = $commentArray->comments[$i]->title;
                    $temp["body"] = $commentArray->comments[$i]->body;
    
                    $comment[] = (object)$temp;
                }
            }
            break;
    
        case 2:
            for($i = 0; $i < count($commentArray->comments); $i++){
                if(strcmp($memberID, $commentArray->comments[$i]->to) == 0){
    
                    $temp["date"] = $commentArray->comments[$i]->date;
                    $temp["to"] = $commentArray->comments[$i]->to;
                    $temp["content"] = $commentArray->comments[$i]->content;
                    $temp["hidden"] = $commentArray->comments[$i]->hidden;
                    $temp["title"] = $commentArray->comments[$i]->title;
                    $temp["body"] = $commentArray->comments[$i]->body;
    
                    $comment[] = (object)$temp;
                }
            }
            break;
    
        case 3:
            for($i = 0; $i < count($commentArray->comments); $i++){
                if(strcmp($contentID, $commentArray->comments[$i]->content) == 0){
    
                    $temp["date"] = $commentArray->comments[$i]->date;
                    $temp["to"] = $commentArray->comments[$i]->to;
                    $temp["content"] = $commentArray->comments[$i]->content;
                    $temp["hidden"] = $commentArray->comments[$i]->hidden;
                    $temp["title"] = $commentArray->comments[$i]->title;
                    $temp["body"] = $commentArray->comments[$i]->body;
    
                    $comment[] = (object)$temp;
                }
            }
            
    }
    if(isset($comment))return $comment;
}