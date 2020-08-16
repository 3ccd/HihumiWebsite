<?php

/**
 * コメントの検索
 * 結果はJsonで出力
 * 
 * TODO:searcher.phpと統合
 */

$searchMode = 0;
$memberID = "";
$contentID = "";

if(isset($_GET["memberID"]) && isset($_GET["contentID"])){
    $searchMode = 1;
}else{
    if(isset($_GET["memberID"])){
        $searchMode = 2;
    }
    if(isset($_GET["contentID"])){
        $searchMode = 3;
    }
}

if($searchMode == 1 || $searchMode == 2)$memberID = $_GET["memberID"];
if($searchMode == 1 || $searchMode == 3)$contentID = $_GET["contentID"];

$url = "./databases/comment.json";
$commentJson = file_get_contents($url);
$commentJson = mb_convert_encoding($commentJson, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$commentArray = json_decode($commentJson,false);

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

                $comment[] = $temp;
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

                $comment[] = $temp;
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

                $comment[] = $temp;
            }
        }
        
}

header('content-type: application/json; charset=utf-8');
print json_encode($comment, JSON_UNESCAPED_UNICODE);

?>