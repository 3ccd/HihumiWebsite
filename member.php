<?php
    ini_set('display_errors', "On");
    require_once 'utils/functions.php';
    DefaultHeader();
    NavigationBar();
?>

<?php
    $memberArray = getAllMemberData();
    $people = count($memberArray->members);
?>

    <section>
        <h2>メンバー</h2>
        <p>プロフィール画像をクリックすると、各メンバーの執筆作品へのリンクをご覧いただけます。</p>
        <p>OBの方の情報は<a href="http://www.cc.kyoto-su.ac.jp/circle/hihumi/archive/member.html" target="_blank">こちら</a>からご覧いただけます。</p>
    </section>
    <section class="section-member" id="member">
        <ul class="member-list">
            <?php for($i = 0; $i < $people; $i++){ ?>
            <li class="member-element">
                <div class="member-outline">
                    <p class="member-name"><?php echo $memberArray->members[$i]->name; ?></p>
                    <p><?php echo $memberArray->members[$i]->position; ?></p>
                </div>

                <?php if(file_exists('./images/profileImages/'.$memberArray->members[$i]->id.'_img.png') == true){ ?>
                <img src="./images/profileImages/<?php echo $memberArray->members[$i]->id; ?>_img.png" alt="メンバー" class="profile-image" onclick="showMemberWorks(&quot;<?php echo $memberArray->members[$i]->id; ?>&quot;)">
                <?php }else{ ?>
                <img src="./images/profileImages/profileDefault.png" alt="メンバー" class="profile-image" onclick="showMemberWorks(&quot;<?php echo $memberArray->members[$i]->id; ?>&quot;)">
                <?php } ?>

                <div class="member-detail">
                    <p><?php echo $memberArray->members[$i]->department;?>学部<?php echo $memberArray->members[$i]->grade;?>年次生</p>

                    <?php for($j = 0; $j < count($memberArray->members[$i]->introduction); $j++){?>
                    <p><?php echo $memberArray->members[$i]->introduction[$j];?></p>
                    <?php } ?>

                </div>
            </li>
            <?php } ?>
        </ul>
    </section>

<?php
    Footer();
    PageEnd();
?>


