var logoImage = document.getElementsByClassName("logo");
var welcomeWords = document.getElementsByClassName("welcome-name");
var bgTexts = document.getElementsByClassName("bg-txt");
var roadMessage = document.getElementById("roading-message");

var UA = navigator.userAgent.toLowerCase();
var ieWarn = 0;
if(UA.indexOf('ie') != -1){
    ieWarn = 1;
}

var randomWords = [
    "悪魔には悪魔の力を、だ。",
    "「・・・・・・明日も、私を殺してくれる？」",
    "尻に敷かれる人生は楽しいか？",
    "思わず顔がにやける。",
    "殺らなきゃ殺られる。",
    "人類は科学のほかに新たな文明向上の可能性を見出した。",
    "「これは人類の集合知だ。」",
    "刹那、視界が捻れるように歪んだ。",
    "「その・・・お願い、します」",
    "ヒット！",
    "ただの勘さ。",
    "彼は思わず復唱した。"
];


var timerBackgroundID;
var timerWordsID;

var logoOpacity;

var maxWidth;

var wordsWidth;
var gain;
var speed;
var wordsState;
var welOpacity;

function startAnimation(){
    if(logoImage.length == 0)return;
    logoOpacity = 0.0;
    maxWidth = 0;
    wordsWidth = 0.0;
    gain = 0.05;
    speed = 0.0;
    wordsState = 0;
    welOpacity = 0.0;

    if(window.innerWidth < 480){
        maxWidth = 300;
    }else{
        maxWidth = 500;
    }

    window.requestAnimationFrame(logoAnimation);
    roadMessage.style.display = "none";
}

function logoAnimation(){
    logoImage[0].style.opacity = logoOpacity;
    logoOpacity += 0.01;
    if(logoOpacity > 1.0){
        window.requestAnimationFrame(welcomeAnim);
    }else{
        window.requestAnimationFrame(logoAnimation);
    }
}

function welcomeAnim(){
    if(wordsState == 0){
        welcomeWords[0].style.width = wordsWidth.toString(10) + "px";
        speed = gain * (maxWidth - wordsWidth);
        wordsWidth += speed;
        speed -= 1.0;
        if(welOpacity <= 1.0){
            welOpacity += 0.01;
            welcomeWords[0].style.opacity = welOpacity;
        }
        if(wordsWidth > maxWidth - 2){
            wordsState = 1;
        }
        window.requestAnimationFrame(welcomeAnim);
    }else{
        welcomeWords[0].textContent = "HIHUMI";
        //window.requestAnimationFrame(bgAnimation);
        setTimeout( bgAnimation, 1000 / 30 );
    }
}

var lifeTime = Array(bgTexts.length);
var lifeSpan = Array(bgTexts.length);
var bgTextWords = Array(bgTexts.length);
var bgTextPositionTop = Array(bgTexts.length);
var bgTextPositionLeft = Array(bgTexts.length);
var bgTextOpacity = Array(bgTexts.length);
var bgTextMaxOpacity = Array(bgTexts.length);
var bgTextSpeed = Array(bgTexts.length);
var bgTextSize = Array(bgTexts.length);
lifeTime.fill(0);
bgTextOpacity.fill(0.0);

function bgAnimation(){
    for(var i = 0; i < bgTexts.length; i++){
        if(lifeTime[i] == 0){
            
            lifeTime[i] = 1;
            lifeSpan[i] = Math.floor( Math.random() * 150) + 50;

            if(window.innerWidth < 480){
                bgTextPositionTop[i] = Math.floor( Math.random() * window.innerHeight) -100;
                bgTextPositionLeft[i] = Math.floor( Math.random() * (window.innerWidth / 2));
            }else{
                bgTextPositionTop[i] = Math.floor( Math.random() * (window.innerHeight / 2)) - 200;
                bgTextPositionLeft[i] = Math.floor( Math.random() * (window.innerWidth / 2)) + Math.floor((window.innerWidth / 5));
            }
            
            var bgTextNearly= Math.floor( Math.random() * 101);
            bgTextMaxOpacity[i] = bgTextNearly / 100 + 0.2;
            bgTextSpeed[i] = Math.floor(bgTextNearly /50) + 1;
            if(window.innerWidth < 480){
                bgTextSize[i] = Math.floor(bgTextNearly / 6.0) + 10;
            }else{
                bgTextSize[i] = Math.floor(bgTextNearly / 3.0) + 20;
            }

            bgTexts[i].style.fontSize = bgTextSize[i] + "px";
            bgTexts[i].textContent = randomWords[Math.floor( Math.random() * randomWords.length )];
        }
    }
    for(var i = 0; i < bgTexts.length; i++){
        if(lifeTime[i] >= 1){

            if(bgTextOpacity[i] < bgTextMaxOpacity[i] && lifeTime[i] < 20){
                bgTextOpacity[i] += 0.05;
                bgTexts[i].style.opacity = bgTextOpacity[i];
            }
            if(lifeTime[i] > lifeSpan[i] && bgTextOpacity[i] > 0.0){
                bgTextOpacity[i] -= 0.05;
                bgTexts[i].style.opacity = bgTextOpacity[i];
            }

            bgTextPositionTop[i] += bgTextSpeed[i];
            bgTextPositionLeft[i] += bgTextSpeed[i];
            bgTexts[i].style.transform = "translate(" + bgTextPositionLeft[i].toString(10) + "px, " + bgTextPositionTop[i].toString(10) + "px) rotate(-45deg)"
            lifeTime[i]++;

            if(lifeTime[i] > lifeSpan[i] + 20){
                lifeTime[i] = 0;
                lifeSpan[i] = 0;
                bgTextOpacity[i] = 0.0;
                bgTextPositionTop[i] = 0.0;
                bgTextPositionLeft[i] = 0.0;
                bgTextSpeed[i] =  0.0;
                bgTextMaxOpacity[i] = 0.0;
                bgTextSize[i] = 0.0;
            }

        }
    }
    setTimeout( bgAnimation, 1000 / 30 );
}