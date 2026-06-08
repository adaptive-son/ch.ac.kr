function _escape(str) {
    var str, ch;

    while((ch=str.indexOf("+"))>0) str=str.substr(0,ch)+"%2B"+str.substr(ch+1,str.length);
    while((ch=str.indexOf("/"))>0) str=str.substr(0,ch)+"%2F"+str.substr(ch+1,str.length);
    while((ch=str.indexOf("&"))>0) str=str.substr(0,ch)+"%26"+str.substr(ch+1,str.length);
    while((ch=str.indexOf("?"))>0) str=str.substr(0,ch)+"%3F"+str.substr(ch+1,str.length);
    while((ch=str.indexOf(":"))>0) str=str.substr(0,ch)+"%3A"+str.substr(ch+1,str.length);
    while((ch=str.indexOf("#"))>0) str=str.substr(0,ch)+"%23"+str.substr(ch+1,str.length);
    return str;
}

function setCookie( cookieName, cookieValue, expireDate ) {
    var t = new Date(); 
    var vto = new Date(t.getTime() + parseInt( expireDate ));
    document.cookie = cookieName + "=" + escape( cookieValue ) + "; path=/; expires=" + vto.toGMTString() + ";";
}

function getCookie( cookieName ) {
    var search = cookieName + "=";
    var cookie = document.cookie;

    // 현재 쿠키가 존재할 경우
    if( cookie.length > 0 ) {
        // 해당 쿠키명이 존재하는지 검색한 후 존재하면 위치를 리턴.
        startIndex = cookie.indexOf( cookieName );

        // 만약 존재한다면
        if( startIndex != -1 ) {
            // 값을 얻어내기 위해 시작 인덱스 조절
            startIndex += cookieName.length;

            // 값을 얻어내기 위해 종료 인덱스 추출
            endIndex = cookie.indexOf( ";", startIndex );

            // 만약 종료 인덱스를 못찾게 되면 쿠키 전체길이로 설정
            if( endIndex == -1) endIndex = cookie.length;

            // 쿠키값을 추출하여 리턴
            return unescape( cookie.substring( startIndex + 1, endIndex ) );
        } else {
            // 쿠키 내에 해당 쿠키가 존재하지 않을 경우
            return false;
        }
    } else {
        // 쿠키 자체가 없을 경우
        return false;
    }
}

function deleteCookie( cookieName ) {
    var expireDate = new Date();
    //어제 날짜를 쿠키 소멸 날짜로 설정한다.
    expireDate.setDate( expireDate.getDate() - 1 );
    document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString() + "; path=/";
}

function set_param() {
    var CA = clientInformation.appVersion; //사용자접속 플랫폼
    var CB = clientInformation.browserLanguage; //사용자접속 언어
    var DL = _escape(self.document.location.href); //사용자접속 URL
    var DR = _escape(self.document.referrer); //사용자접속 referrer
    var DT = document.title.toString(); //사용자접속 타이틀

    var SC = window.screen.colorDepth; //사용자접속 스크린 bit 색상 깊이
    var SW = window.screen.width+"x"+window.screen.height; //사용자접속 화면해상도

    var tt = new Date;
    var tye = tt.getYear();
    var tmo = tt.getMonth()+1;
    var tda = tt.getDate();
    var tho = tt.getHours();
    var tmi = tt.getMinutes();
    var tse = tt.getSeconds();
    var ttz = tt.getTimezoneOffset()/60;
    var tls = tt.toLocaleString();

    var TI = tye+"-"+tmo+"-"+tda+" "+tho+":"+tmi+":"+tse+" "+ttz; //사용자접속시간 - 년-월-일 시:분:초 타임존

    var im = new Image();
    im.src = "/adframe/mng/log/log_input.php?CA="+CA+"&CB="+CB+"&DL="+DL+"&DR="+DR+"&DT="+DT+"&SC="+SC+"&SW="+SW+"&TI="+TI+"&UN="+UN;
console.log(im.src)
    im.onload = function() { return; }

}