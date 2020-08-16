<?php
    require 'utils/functions.php';
    DefaultHeader();
    NavigationBar();

    $backnumberArray = getContentDatabase();
    
    $allcount = 0;
    for ($i = count($backnumberArray->backnumber) -1; $i >= 0; $i--){
        if(isset($backnumberArray->backnumber[$i]->content))$allcount += count($backnumberArray->backnumber[$i]->content);
    }
?>
    
    <section class="section-what" id="what">
        <h2>全作品一覧</h2>
        <p>ライブラリに収録されている作品一覧です。</p>
    </section>

    <section class="section-latest" id="latest">

        <div class="content-header">
            <h4>全作品一覧（<?php echo $allcount; ?>作品）</h4>
        </div>

        <?php 
        for ($i = count($backnumberArray->backnumber) -1; $i >= 0; $i--){
            if(isset($backnumberArray->backnumber[$i]->content))for ($j = 0; $j < count($backnumberArray->backnumber[$i]->content); $j++) {
                if(isset($backnumberArray->backnumber[$i]->content[$j]->aux)){
                    //echo '<a class="content-item" href="online-reader.php?memberID='.$backnumberArray->backnumber[$i]->content[$j]->authorid.'&contentID='.$backnumberArray->backnumber[$i]->id.'&cnum='.$backnumberArray->backnumber[$i]->content[$j]->aux.'"><div>';
                    echo '<a class="content-item" href="works.php?mid='.$backnumberArray->backnumber[$i]->content[$j]->authorid.'&cid='.$backnumberArray->backnumber[$i]->id.'&cnum='.$backnumberArray->backnumber[$i]->content[$j]->aux.'"><div>';
                }else{
                    //echo '<a class="content-item" href="online-reader.php?memberID='.$backnumberArray->backnumber[$i]->content[$j]->authorid.'&contentID='.$backnumberArray->backnumber[$i]->id.'"><div>';
                    echo '<a class="content-item" href="works.php?mid='.$backnumberArray->backnumber[$i]->content[$j]->authorid.'&cid='.$backnumberArray->backnumber[$i]->id.'&cnum=0"><div>';
                }
                echo '<p>'.$backnumberArray->backnumber[$i]->content[$j]->title."</p>";
                echo '<p class="description-text">'.$backnumberArray->backnumber[$i]->content[$j]->author."</p>";
                echo "</div></a>";
            }
        }
        ?>
    </section>

<?php
    Footer();
    PageEnd();
?>
