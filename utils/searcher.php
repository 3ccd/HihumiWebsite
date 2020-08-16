<?php

/**
 * Jsonデータの検索
 * 結果はJsonで出力
 */

$searchMode = 0;
$memberID = "";
$contentID = "";


//メンバー指定検索・コンテンツ指定検索・メンバー、コンテンツ指定検索が可能
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

$url = "../databases/hihumi_member.json";
$memberJson = file_get_contents($url);
$memberJson = mb_convert_encoding($memberJson, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$memberArray = json_decode($memberJson,false);

$url = "../databases/hihumi_backnumber.json";
$backnumberJson = file_get_contents($url);
$backnumberJson = mb_convert_encoding($backnumberJson, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$backnumberArray = json_decode($backnumberJson,false);

//GETパラメータが指定された場合
if($searchMode != 0){

    if($searchMode == 1 || $searchMode == 2)$memberID = $_GET["memberID"];
    if($searchMode == 1 || $searchMode == 3)$contentID = $_GET["contentID"];

    $output = array();

    switch($searchMode){
        case 1:
            for($i = 0; $i < count($backnumberArray->backnumber); $i++){

                if(strcmp($contentID, $backnumberArray->backnumber[$i]->id) == 0){
                    for($j = 0; $j < count($backnumberArray->backnumber[$i]->content); $j++){

                        if(strcmp($memberID, $backnumberArray->backnumber[$i]->content[$j]->authorid) == 0){

                            $contTemp = array();

                            $contTemp["contenttitle"] = $backnumberArray->backnumber[$i]->title;
                            $contTemp["year"] = $backnumberArray->backnumber[$i]->year;
                            $contTemp["title"] = $backnumberArray->backnumber[$i]->content[$j]->title;
                            $contTemp["author"] = $backnumberArray->backnumber[$i]->content[$j]->author;
                            if(isset($backnumberArray->backnumber[$i]->content[$j]->aux)){
                                $contTemp["aux"] = $backnumberArray->backnumber[$i]->content[$j]->aux;
                            }

                            $output[] = $contTemp;
        
                        }
                    }
                }
            }

            break;

        case 2:
            for($i = 0; $i < count($memberArray->members); $i++){
                if(strcmp($memberID, $memberArray->members[$i]->id) == 0){

                    $temp["name"] = $memberArray->members[$i]->name;
                    $temp["position"] = $memberArray->members[$i]->position;
                    $temp["department"] = $memberArray->members[$i]->department;
                    $temp["grade"] = $memberArray->members[$i]->grade;
                    $temp["introduction"] = $memberArray->members[$i]->introduction;

                    $contTemp = array();
                    for($j = 0; $j < count($backnumberArray->backnumber); $j++){
                        $workTemp = array();
                        if(isset($backnumberArray->backnumber[$j]->content))for($k = 0; $k < count($backnumberArray->backnumber[$j]->content); $k++){
                            if(strcmp($memberID, $backnumberArray->backnumber[$j]->content[$k]->authorid) == 0){
    
                                $workTemp["contenttitle"] = $backnumberArray->backnumber[$j]->title;
                                $workTemp["year"] = $backnumberArray->backnumber[$j]->year;
                                $workTemp["id"] = $backnumberArray->backnumber[$j]->id;
                                $workTemp["title"] = $backnumberArray->backnumber[$j]->content[$k]->title;
                                $workTemp["author"] = $backnumberArray->backnumber[$j]->content[$k]->author;
                                if(isset($backnumberArray->backnumber[$j]->content[$k]->aux)){
                                    $workTemp["aux"] = $backnumberArray->backnumber[$j]->content[$k]->aux;
                                }

                                $contTemp[] = $workTemp;
                            }
                        }
                    }

                    $temp["works"] = $contTemp;

                    $output = $temp;
                }
            }
            break;

        case 3:
            for($i = 0; $i < count($backnumberArray->backnumber); $i++){
                if(strcmp($contentID, $backnumberArray->backnumber[$i]->id) == 0){

                    $output = $backnumberArray->backnumber[$i];
                }
            }
            
    }

}else{
    $output = $backnumberArray->backnumber;
}
header('content-type: application/json; charset=utf-8');
print json_encode($output, JSON_UNESCAPED_UNICODE);

?>