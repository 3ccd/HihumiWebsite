function showMemberWorks(memberID){
    var section = document.getElementsByClassName("overlay-window");
    var fckip = document.getElementsByClassName("fuck-iphone");
    var iframe = document.createElement('iframe');
    var url = "./member-works.php?memberID=" + memberID;
    iframe.setAttribute("src", url);
    iframe.setAttribute("display", "block");
    iframe.setAttribute("scrolling", "auto");
    fckip[0].appendChild(iframe);
    section[0].style.display = "block";
    window.setTimeout( function() { section[0].classList.toggle("window-enable"); }, 100);
}

function showContentDetail(contentID){
    var section = document.getElementsByClassName("overlay-window");
    var fckip = document.getElementsByClassName("fuck-iphone");
    var iframe = document.createElement('iframe');
    var url = "./content-detail.php?contentID=" + contentID;
    iframe.setAttribute("src", url);
    iframe.setAttribute("display", "block");
    iframe.setAttribute("scrolling", "auto");
    fckip[0].appendChild(iframe);
    section[0].style.display = "block";
    window.setTimeout( function() { section[0].classList.toggle("window-enable"); }, 100);
}

function delFrame(){
    var section = document.getElementsByClassName("overlay-window");
    var fckip = document.getElementsByClassName("fuck-iphone");
    fckip[0].textContent = null;
    section[0].classList.toggle("window-enable");
    section[0].style.display = "none";
}

function downloadBacknumber(contentID){
    location.href = contentID;
}