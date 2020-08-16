<?php 
    require_once 'utils/functions.php';
    DefaultHeader();
    NavigationBar(); 
?>

    <section class="title-section" id="title">
        <h3 class="welcome-name">ようこそ</h3>
        <span id="ityped-one">p</span>
        <span id="ityped-two">p</span>
        <span id="ityped-three">p</span>
        <img src="images/logo.png" alt="灯文" class="logo">
        <img src="images/scrollDown.png" alt="灯文" class="scrollDown">
    </section>


    <div class="scroll-vision">

        <div class="section-latest">

            <section class="index-section" id="what">
                <h2>灯文について</h2>
                <p>こちらは京都産業大学 届出団体 文芸サークル灯文（ひふみ）のホームページです。活動や定期発行誌「Tritonia」について紹介しております。
                    興味のある方はお気軽にTwitterへ、リプライ・ダイレクトメッセージをお願いします！</p>
                <p>過去に公開されていたホームページは<a href="http://www.cc.kyoto-su.ac.jp/circle/hihumi/archive/index-j.html" target="_blank">こちら</a>からご覧いただけます。</p>
            </section>


            <section class="index-section" id="latest">
                <h2>最新情報</h2>
                <p>最新情報はTwitterにて発信しております。</p>
                <div class="twitter">
                    <a class="twitter-timeline" data-tweet-limit="2" data-chrome="noheader nofooter" data-width="600" data-height="600" data-theme="light" data-align="center" href="https://twitter.com/Tritonia_h?ref_src=twsrc%5Etfw">Tweets by Tritonia_h</a> 
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
                </div>
            </section>


            <section class="index-section" id="activity">
                <h2>活動内容</h2>
                <p>年間計画を元に部誌を発行し、合評を行うことが私たちの主な活動です。部誌は一年に春夏秋冬と新入生歓迎の５冊を予定しています。</p>
                <ul class="about-list">
                    <li class="about-point">
                        <h3>活動時間・場所</h3>
                        <p> 12号館12521教室にて毎週火曜日・木曜日に昼食をとりながら活動を行なっています。</p>
                    </li>
                    <li class="about-point">
                        <h3>年間計画</h3>
                        <p> 年間計画をもとに部誌を発行し、合評を行うことが私たちの主な活動です。部誌は１年に春夏秋冬と新入生歓迎の５冊を予定しています。</p>
                    </li>
                    <li class="about-point">
                        <h3>合評</h3>
                        <p>
                            自分の作品というのは、もちろん自分で作った設定の中にあります。
                            それゆえ客観的にみると穴が開いている部分にも、気付かないことがあるもの。
                            私たちは部誌制作後に互いの作品を批評しあう、合評という場を設けています。
                        </p>
                    </li>
                </ul>
            </section>

        </div>

<?php Footer();?>
    </div>
<?php PageEnd(); ?>
