<?php
    ini_set('display_errors', "On");
    require_once 'utils/functions.php';
    DefaultHeader();
    NavigationBar();
?>

<?php
    $backnumberArray = getContentDatabase();
?>
    
    <section class="section-what" id="what">
        <h2>灯文ライブラリ</h2>
        <p>ここでは最新の作品についての情報を掲載しています。</p>
    </section>

    <section class="section-latest">
        <div class="content-header">
            <h4>ピックアップ！(仮）</h4>
            <a>もっと見る></a>
        </div>
        <a class="content-item">
                <img src="./images/backnumberThumbnails/2019july0.png">
            <div class="no-bottomline">
                <p>比翼の小鳥</p>
                <p class="description-text">
                        私の先生はどうしようもなくダメな芸術家です。
                        そんな先生を好きな私もダメ人間です。
                        さぁ、先生。今日も私たちの作品を作りましょう。
                </p>
            </div>
        </a>
    </section>

    <section class="section-latest" id="latest">
            
        <div class="content-header">
            <h4>新着作品</h4>
            <a href="./library-all.php">もっと見る></a>
        </div>

        <?php for($coun = count($backnumberArray->backnumber), $new = $coun -1; $new > $coun -6; $new--){ ?>

        <?php 
        $image = '';
        if(file_exists('./images/backnumberThumbnails/'.$backnumberArray->backnumber[$new]->id.'.png')){
            $image = './images/backnumberThumbnails/'.$backnumberArray->backnumber[$new]->id.'.png';
        }else{
            $image = './images/backnumberThumbnails/noimage.png';
        }
        ?>

        <a href="javascript:void(0);" class="content-item" onclick="showContentDetail(&quot;<?php echo $backnumberArray->backnumber[$new]->id; ?>&quot;)">
            <img src="<?php echo $image; ?>">
            <div>
                <p><?php echo $backnumberArray->backnumber[$new]->title ?></p>
                <?php for($i = 0; $i < count($backnumberArray->backnumber[$new]->content); $i++){ ?>
                <p class="description-text"><?php echo $i; ?>・<?php echo $backnumberArray->backnumber[$new]->content[$i]->title; ?></p>
                <?php } ?>
            </div>
        </a>

        <?php } ?>

    </section>

    <section class="section-latest">
        <?php
            comment_element(null, null, "最新コメント", null, 5);
        ?>
    </section>

<?php
    Footer();
    PageEnd();
?>
