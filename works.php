<?php
ini_set('display_errors', "On");
require_once 'utils/functions.php';
require_once 'picgen-info.php';
DefaultHeader();
NavigationBar();
?>

<?php
define("PAGE_PAR_EPISODE", 10);

$mid = $_GET["mid"];
$cid = $_GET["cid"];
$cnum = $_GET["cnum"];

$cData = getContentData($mid, $cid);
$data = $cData[$cnum];

$info = getPageInfo($mid, $cid, $cnum);
$pages = count($info);
$episodeCount = floor($pages / PAGE_PAR_EPISODE) +1;
$episodeLastPage = $pages -1;
$buttonEP = PAGE_PAR_EPISODE;
if($episodeLastPage < $buttonEP)$buttonEP = $episodeLastPage;
?>

<div class="works-pagetitle">
    <div class="works-inner">
        <img class="works-thumbnail" src="./images/backnumberThumbnails/<?php echo $cid; ?>.png">
        <div class="works-rightside">
            <div class="works-title-container">
                <img class="works-thumbnail-sp" src="./images/backnumberThumbnails/<?php echo $cid; ?>.png">
                <div>
                    <p class="works-title"><?php echo $data->title; ?></p>
                    <p class="works-author">著者：<?php echo $data->author ?></p>
                    <p class="works-author">収録巻：<?php echo $data->volume_title ?>（<?php echo $data->year ?>年発行）</p>
                </div>
            </div>
            <a class="works-goreader" href="./reader.php?mid=<?php echo $mid;?>&cid=<?php echo $cid; ?>&cnum=<?php echo $cnum; ?>&sp=0&ep=<?php echo $buttonEP; ?>">作品を読む（エピソード0）</a>
            <div class="works-detail-container">
                <p class="works-detail-title">作品紹介</p>
                <p class="works-detail">作品紹介はありません。</p>
                <div class="works-tag-container">
                    <a>タグ機能はまだありません。</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="works-pagedetail">
    <div class="works-inner">
        <div class="works-content-left">
            <div class="content-header">
                <h4>エピソード</h4>
            </div>
            <?php 
            for($i = 0; $i < $episodeCount; $i++){ 
                $sp = $i * PAGE_PAR_EPISODE;
                $ep = ($i +1) * PAGE_PAR_EPISODE -1;
                if($ep > $episodeLastPage)$ep = $episodeLastPage;
            ?>
            <a class="content-item" href="./reader.php?mid=<?php echo $mid;?>&cid=<?php echo $cid; ?>&cnum=<?php echo $cnum; ?>&sp=<?php echo $sp; ?>&ep=<?php echo $ep; ?>">
                <div>
                    <p>エピソード<?php echo $i; ?></p>
                    <p class="description-text">ページ<?php echo $sp.'〜'.$ep; ?></p>
                </div>
            </a>
            <?php } ?>
            <?php
            $dataa = getVolumeContentList($cid);
            content_element("他の作品", null, $dataa);
            ?>
        </div>
        <div class="works-content-right">
        <?php
        comment_element($mid, $cid, "この作品へのコメント", null, 10);
        ?>
        </div>
    </div>
</div>


<?php
Footer();
PageEnd();
?>

