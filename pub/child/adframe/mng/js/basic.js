jQuery(document).ready(function(){
    // class="onlyNumber" 숫자만 입력가능
    jQuery(".onlyNumber").keyup(function(event){
        if (!(event.keyCode >=37 && event.keyCode<=40)) {
            var inputVal = jQuery(this).val();
            jQuery(this).val(inputVal.replace(/[^0-9]/gi,''));
        }
    });
    // class="onlyAlphabet" 영문만 입력가능
    jQuery(".onlyAlphabet").keyup(function(event){
        if (!(event.keyCode >=37 && event.keyCode<=40)) {
            var inputVal = jQuery(this).val();
            jQuery(this).val(inputVal.replace(/[^a-z]/gi,''));
        }
    });
    // class="notHangul" 한글 외 입력가능
    jQuery(".notHangul").keyup(function(event){
        if (!(event.keyCode >=37 && event.keyCode<=40)) {
            var inputVal = jQuery(this).val();
            jQuery(this).val(inputVal.replace(/[^a-z0-9]/gi,''));
        }
    });
    // class="notHangul" 한글만 입력가능
    jQuery(".onlyHangul").keyup(function(event){
        if (!(event.keyCode >=37 && event.keyCode<=40)) {
            var inputVal = jQuery(this).val();
            jQuery(this).val(inputVal.replace(/[a-z0-9]/gi,''));
        }
    });

    jQuery('.onlyAlphabetAndNumber').keyup(function(event){
        if (!(event.keyCode >=37 && event.keyCode<=40)) {
            var inputVal = $(this).val();
            $(this).val($(this).val().replace(/[^_a-z0-9]/gi,'')); //_(underscore), 영어, 숫자만 가능
        }
    });

});


function getByteLength(s) { // 글자를 바이트로 체크. 영어,숫자는 글자당 1byte 한글은 글자당2byte
    var len = 0;

    if(s == null) return 0;

    for(var i = 0; i < s.length; i++) {
        var c = escape(s.charAt(i));

        if(c.length == 1) len ++;
        else if(c.indexOf("%u") != -1) len += 2;
        else if(c.indexOf("%") != -1) len += c.length / 3;
    }

    return len;
}


//글자수 Max까지다시 잘라내기
function assert_msglen(message, maximum){
    var inc = 0;
    var nbytes = 0;
    var msg = "";
    var msglen = message.length;

    for (i=0; i<msglen; i++) {
        var ch = message.charAt(i);
        if (escape(ch).length > 4) {
            inc = 2;
        } else if (ch == '\n') {
            if (message.charAt(i-1) != '\r') {
                inc = 1;
            }
        } else if (ch == '<' || ch == '>') {
            inc = 4;
        } else {
            inc = 1;
        }
        if ((nbytes + inc) > maximum) {
            break;
        }
        nbytes += inc;
        msg += ch;
    }
    return msg;
}

var mikExp = /[jQuery\\@\\\#%\^\&\*\(\)\[\]\+\_\{\}\`\~\=\|]/;
function dodacheck(val) {
    var strPass = val.value;
    var strLength = strPass.length;
    var lchar = val.value.charAt((strLength) - 1);
    if(lchar.search(mikExp) != -1) {
        var tst = val.value.substring(0, (strLength) - 1);
        val.value = tst;
    }
}



function check_key() {
    var char_ASCII = event.keyCode;

    //숫자
    if (char_ASCII >= 48 && char_ASCII <= 57 )
        return 1;
    //영어
    else if ((char_ASCII>=65 && char_ASCII<=90) || (char_ASCII>=97 && char_ASCII<=122))
        return 2;
    //특수기호
    else if ((char_ASCII>=33 && char_ASCII<=47) || (char_ASCII>=58 && char_ASCII<=64)
        || (char_ASCII>=91 && char_ASCII<=96) || (char_ASCII>=123 && char_ASCII<=126))
        return 4;
    //한글
    else if ((char_ASCII >= 12592) || (char_ASCII <= 12687))
        return 3;
    else
        return 0;
}

//특수문자 필터링
function specialObj(obj){
    // console.log(obj.keyCode);
    if((obj.keyCode > 32 && obj.keyCode < 48) || (obj.keyCode > 57 && obj.keyCode < 65) || (obj.keyCode > 90 && obj.keyCode < 97)){
        alert('특수문자는 사용하실 수 없습니다.');
        obj.returnValue = false;
    }
}




//이메일 검사
function Check_Email(form,alias){
    var str = form.value;
    var reg = /^((\w|[\-\.])+)@((\w|[\-\.])+)\.([A-Za-z]+)jQuery/;
    if (str.search(reg) == -1) {
        alert(alias+"형식이 올바르지 않습니다.");
        form.focus();
        return false;
    }
    return true;
}


//몸무게/키입력검사 175.5 or 55
function Check_Weight(form,alias){
    var str = form.value;
    var Reg;
    var dotReg      = /[^a-zA-Z0-9_]/; //특수문자있는지 체크
    var checkReg    = /^([0-9]{1,3})\.([0-9]{1,1})jQuery/;
    var normalReg   = /^([0-9]{1,3})jQuery/;
    if(str.search(dotReg)== -1){	   //특수문자 없으면
        Reg         = normalReg;

    }else{							   //특수문자있으면
        Reg			= checkReg;
    }

    if (str.search(Reg) == -1) {
        alert(alias+"형식이 올바르지 않습니다.");
        form.focus();
        return false;
    }
    return true;
}


//시간입력 검사 ex) 08:30-09:40
function Check_Time(form,alias){
    var str = form.value;
    var reg = /^([0-9]{2})+(\:[0-9]{2})+-([0-9]{2})+(\:[0-9]{2})jQuery/;
    if (str.search(reg) == -1) {
        alert(alias+"형식이 올바르지 않습니다.");
        form.focus();
        return false;
    }

    return true;
}


//날짜입력 검사 ex) 2006-03-08
function Check_Date(form,alias){
    var str = form.value;
    var reg = /^([0-9]{4})+(\-[0-9]{2})+(\-[0-9]{2})jQuery/;
    if (str.search(reg) == -1) {
        alert(alias+"형식이 올바르지 않습니다.");
        form.focus();
        return false;
    }
    return true;
}


//공백검사
function Blank_Chk(form,alias){
    var ls_value = form.value;
    var li_len   = form.value.length;
    for(var i=0;i<li_len;i++){
        var tmp = ls_value.substring(i,i+1);
        if(tmp==" "){
            alert(alias+"공백을 입력할수없습니다.");
            form.focus();
            return false;
        }
    }
    return true;
}


//입력값이 전부공백일경우 공백검사
function AllBlank_Chk(form,alias){
    var ls_value = form.value;
    var li_len   = form.value.length;
    var p=0;
    for(var i=0;i<li_len;i++){
        var tmp = ls_value.substring(i,i+1);
        if(tmp==" "){
            p=p+1;
        }
    }
    if(p==li_len){
        alert(alias+"공백을 입력할수없습니다.");
        form.focus();
        return false;
    }
    return true;
}


//한글입력만 검사
function Han_Chk(ao_fin,alias){
    var ls_value = ao_fin.value;
    var li_len   = ao_fin.value.length;
    for(k = 0 ; k < li_len ; k++){
        temp = ls_value.charAt(k);
        if (escape(temp).length < 4){
            var ls_msg = alias + "는 한글 만 입력할 수 있습니다.\n다시 확인하시고 입력해 주세요.";
            alert(ls_msg);
            ao_fin.focus();
            return false;
        }
    }
    return true;
}


//자리수 체크 몇자이상 몇자 이하
function Length_Chk(ao_fin,a,b,alias){
    var ls_len = ao_fin.value.length;
    if(ls_len<a || ls_len>b){
        var ls_msg = alias + "는 "+a+"자이상"+b+"자 이하로 입력해주세요";
        alert(ls_msg);
        ao_fin.focus();
        return false;

    }
    return true;
}

//자리수 체크  몇자 이하
function Length_Chk2(ao_fin,a,alias){
    var ls_len = ao_fin.value.length;
    if( ls_len>a){
        var ls_msg = alias + "는 "+a+"자 이하로 입력해주세요";
        alert(ls_msg);
        ao_fin.focus();
        return false;

    }
    return true;
}


//같은값인지 비교
function Same_Chk(ao_fin1,ao_fin2,alias){
    var val1 = ao_fin1.value;
    var val2 = ao_fin2.value;
    if(val1!=val2){
        var ls_msg = alias + "값을 확인해주세요";
        alert(ls_msg);
        ao_fin1.focus();
        return false;
    }
    return true;
}


//숫자여부 체크
function Num_Chk(ao_fin,alias){
    var len = ao_fin.value.length;
    var val = ao_fin.value;
    for (i=0 ; i<len ; i++ )
    {
        var ls_val = val.substring(i,i+1);
        if ((ls_val < '0') || (ls_val > '9'))
        {
            var ls_msg = alias + "는 숫자만 입력해주세요";
            alert(ls_msg);
            ao_fin.focus();
            return false;
        }
    }
    return true;
}


//특수 문자 체크
function Tstr_Chk(ao_fin,alias){
    var data = ao_fin.value;
    for (var i=0; i < data.length; i++) {
        ch_char = data.charAt(i);
        ch      = ch_char.charCodeAt();
        if( (ch >= 33 && ch <= 47) || (ch >= 58 && ch <= 64) || (ch >= 91 && ch <= 96) || (ch >= 123 && ch <= 126) ) {
            alert(alias+ " 는 문자 " +ch_char+ " 를 사용할 수 없습니다");
            ao_fin.focus();
            return false;
        }
    }
    return true;
}


//특수 문자 체크 ("."<=허용)
function Tstr_Chkdot(ao_fin,alias){
    var data = ao_fin.value;
    for (var i=0; i < data.length; i++) {
        ch_char = data.charAt(i);
        ch=ch_char.charCodeAt();
        if( (ch >= 33 && ch < 46) || (ch >= 58 && ch <= 64) || (ch >= 91 && ch <= 96) || (ch >= 123 && ch <= 126) ) {
            alert(alias+ " 는 문자 " +ch_char+ " 를 사용할 수 없습니다");
            ao_fin.focus();
            return false;
        }
    }
    return true;
}


//사업자번호 체크
function is_binNo(form) {
    var form;
    var reg = /([0-9]{3})-?([0-9]{2})-?([0-9]{5})/;
    if (!reg.test(form.value)){
        alert('사업자번호가 올바르지 않습니다.');
        form.focus();
        return false;
    }
    num = RegExp.jQuery1 + RegExp.jQuery2 + RegExp.jQuery3;
    var cVal = 0;
    for(var i=0;i<8;i++){
        var cKeyNum = parseInt(((_tmp = i % 3) == 0) ? 1 : ( _tmp  == 1 ) ? 3 : 7);
        cVal += (parseFloat(num.substring(i,i+1)) * cKeyNum) % 10;
    }
    var li_temp = parseFloat(num.substring(i,i+1)) * 5 + '0';
    cVal += parseFloat(li_temp.substring(0,1)) + parseFloat(li_temp.substring(1,2));
    return (parseInt(num.substring(9,10)) == 10-(cVal % 10)%10);
}



// 한글 입력을 금지 시키는 함수
function Hangul_Stop(as_fin,as_alias){
    var ls_value = as_fin.value;
    var li_len   = as_fin.value.length;

    for(k = 0 ; k < li_len ; k++){

        temp = ls_value.charAt(k);

        if (escape(temp).length > 4){
            var ls_msg = as_alias + "는 한글 입력을 금지하고 있습니다.\n다시 확인하시고 입력해 주세요.";
            alert(ls_msg);
            as_fin.focus();
            as_fin.select();
            return false;
        }
    }
    return true;
}


//메세지 창 띄우는 함수
function f_msg_box(as_msg){
    alert(as_msg);
    return;
}


/****************************************************************************/
/* 일정 자리수 만큼 입력했는지 체크하는 함수                                */
/* 2000.8.6																	*/
/****************************************************************************/
/* as_fin는 현재 포커스가 있는 항목을 말한다.                               */
/* as_next_fin는 현재 포커스가 있는 항목의 다음 항목을 말한다.              */
/* ai_maxlen_int는 입력할 수 있는 최고 자리수를 말한다.                     */

function f_maxlen_chk(as_fin,ai_maxlen_int,as_msg){
    //alert(as_fin.value.length);
    if (as_fin.value.length != ai_maxlen_int){
        var msg_prn = as_msg + ' ' + ai_maxlen_int + '자 모두 입력해 주세요.';
        f_msg_box(msg_prn);
        as_fin.focus();
        as_fin.select();
        return false;
    }
    return true;
}


//주민번호검사
function Jumin_Chk(ai_jumin1,ai_jumin2){

    /* 앞번호6자리, 뒷번호 7자리 모두 입력했는지 체크 */
    if (!f_maxlen_chk(ai_jumin1,6,'주민등록번호앞')){ return false;}
    if (!f_maxlen_chk(ai_jumin2,7,'주민등록번호뒤')){ return false;}

    /* 숫자만 입력되었는지를 체크 */
    var ls_f_jumin = ai_jumin1.value;
    var ls_r_jumin = ai_jumin2.value;

    /* 앞 6자리 숫자 체크 */
    for (i=0 ; i<ls_f_jumin.length ; i++ ){
        var ls_sub_jumin = ls_f_jumin.substring(i,i+1);
        if ((ls_sub_jumin < '0') || (ls_sub_jumin > '9')){
            f_msg_box('주민등록번호는 숫자만 입력할 수 있습니다.');
            ai_jumin1.select();
            ai_jumin1.focus();
            return false;
        }
    }

    /* 뒤 7자리 숫자 체크 */
    for (i=0 ; i<ls_r_jumin.length ; i++ ){
        var ls_sub_jumin = ls_r_jumin.substring(i,i+1);
        if ((ls_sub_jumin < '0') || (ls_sub_jumin > '9'))
        {
            f_msg_box('주민등록번호는 숫자만 입력할 수 있습니다.');
            ai_jumin1.select();
            ai_jumin1.focus();
            return false;
        }
    }

    /* 월 입력 체크 */
    var ls_sub_jumin = ls_f_jumin.substring(2,4);
    if ((ls_sub_jumin < '01') || (ls_sub_jumin > '12')){
        f_msg_box('01월부터 12월까지만 입력할 수 있습니다.');
        ai_jumin1.select();
        ai_jumin1.focus();
        return false;
    }

    /* 일 입력 체크 */
    var ls_sub_jumin = ls_f_jumin.substring(4,6);
    if ((ls_sub_jumin < '01') || (ls_sub_jumin > '31')){
        f_msg_box('01일부터 31일까지만 입력할 수 있습니다.');
        ai_jumin1.select();
        ai_jumin1.focus();
        return false;
    }

    /* 남녀 입력 체크 */
    var ls_sub_jumin = ls_r_jumin.substring(0,1);
    if ((ls_sub_jumin < '1') || (ls_sub_jumin > '4')){
        f_msg_box('남녀 입력은 1부터 4까지 입니다.');
        ai_jumin2.select();
        ai_jumin2.focus();
        return false;
    }

    /*  주민등록번호 유효성 검사 */
    ar_f_jumin = new Array(6);
    ar_r_jumin = new Array(7);
    var check_digit = 0;
    for (i=0 ; i < 6 ; i++ )
    {
        ar_f_jumin[i] = ls_f_jumin.substring(i,i+1);
        check_digit = check_digit + (ar_f_jumin[i] * (i+2));
    }

    for (i=0 ; i < 7 ; i++ )
    {
        ar_r_jumin[i] = ls_r_jumin.substring(i,i+1);
    }
    check_digit = check_digit + (ar_r_jumin[0]*8 + ar_r_jumin[1]*9 + ar_r_jumin[2]*2 +
        ar_r_jumin[3]*3 + ar_r_jumin[4]*4 + ar_r_jumin[5]*5);

    check_digit = check_digit % 11;
    check_digit = 11 - check_digit;
    check_digit = check_digit % 10;

    if (check_digit != ar_r_jumin[6])
    {
        f_msg_box('잘못된 주민등록번호입니다.\n다시 확인하시고 입력해 주세요');
        ai_jumin1.value = '';
        ai_jumin2.value = '';
        ai_jumin1.focus();
        return false;
    }
    return true;
}



//유효성검사
function Val_Chk(form,alias){
    if(form.value==""){
        alert(alias+"을(를) 입력하세요.");
        form.focus();
        return false;
    }
    return true;
}


//셀렉트박스 유효성 검사
function SelectBox_Chk(form,alias){
    var form;
    var chk = form.options[form.selectedIndex].value;
    if(chk==''){
        alert(alias+"(을)를 선택해주세요.");
        form.focus();
        return false;
    }else{
        return true;
    }
}

//라디오 버튼 유효성 체크
function radio_ck(form,val)
{
    var form;
    var len  = form.length;
    var returnValue = false;
    for(var i=0;i<len;i++){
        if(form[i].checked==true){
            returnValue = true;
        }
    }

    if(!returnValue){
        alert(val+"(을)를 선택해주세요.");
        //form.focus();
        return false;
    }else{
        return true;
    }
}


//셀렉트박스 셀렉트 값
function SelectBox_Val(form){
    var form;
    var chk = form.options[form.selectedIndex].value;
    return chk;
}


//레디오버튼 선택값
function RadioValue(form){
    var form;
    var len  = form.length;
    var returnValue;
    for(var i=0;i<len;i++){
        if(form[i].checked==true){
            returnValue = form[i].value;
        }
    }
    return returnValue;
}



//체크박스 모두체크 및 해제
//폼이름,엘레멘츠이름,선택
function All_Check(form_name,check_name,self){
    var form_name;
    var check_name;
    var form = eval("document."+form_name);
    if(self.checked==true){//전체선택.
        for(var i=0;i<form.elements.length;i++){
            if(form.elements[i].name==check_name){
                form.elements[i].checked=true;
            }
        }
    }else if(self.checked==false){//선택해제.
        for(var i=0;i<form.elements.length;i++){
            if(form.elements[i].name==check_name){
                form.elements[i].checked=false;
            }
        }
    }
}

function disableCheck(form_name,check_name,self){
    var form_name;
    var check_name;
    var form = eval("document."+form_name);
    if(self.checked==true){							//체크
        for(var i=0;i<form.elements.length;i++){
            if(form.elements[i].name==check_name){
                form.elements[i].disabled = true;
            }
        }
    }else if(self.checked==false){					//해제
        for(var i=0;i<form.elements.length;i++){
            if(form.elements[i].name==check_name){
                form.elements[i].disabled = false;
            }
        }
    }
    self.disabled = false;
}

function All_Check_Num(form,check_name,num,alias){
    var check_name;
    var j=0;
    var ls_msg = alias+"를 " + num + "개 이상선택해주세요";
    //alert(form);
    for(var i=0;i<form.elements.length;i++){
        if(form.elements[i].name==check_name){
            if(form.elements[i].checked==true){
                j++;
            }
        }
    }
    if(j<num){
        f_msg_box(ls_msg);
        return false;
    }else{
        return true;
    }
}


//체크박스선택값
function CheckBoxValue(form,check_name){
    var check_name;
    var returnVal="";
    for(var i=0;i<form.elements.length;i++){
        if(form.elements[i].name==check_name){
            if(form.elements[i].checked==true){
                checkVal = form.elements[i].value;
                returnVal += checkVal+'-';
            }
        }
    }
    var tlen = parseInt((returnVal.length)-1);
    returnVal = returnVal.substr(0,tlen);
    return returnVal;
}


//확인메시지
function msgCheck(alias){
    var msg = confirm(alias);
    if(msg==true){
        return true;
    }else{
        return false;
    }
}


//입력값 바이트체크
function ByteCheck(obj,showId,limitByte){

    var show  = document.getElementById(showId);
    var temp;
    var real_byte = obj.value.length;		//문자열길이

    for (i=0; i<obj.value.length; i++){

        temp = obj.value.substr(i,1).charCodeAt(0);

        if (temp > 127) {
            real_byte++;
        }  // 한글일경우 +1

    }

    show.innerHTML = real_byte;		//바이트 보이기

    if (real_byte>limitByte){			// 클경우 메시지 뿌리기
        //뒤에꺼 한개 자르기
        alert('입력한 글이 최대 길이 '+limitByte+'byte를 넘습니다. \n 더이상 입력할 수 없습니다.');
        return;
    }
}

//G-Market꺼..
function getNumWithComma(num){
    var isNegative, i, strNum, strReturn;

    strNum = num.toString();
    strReturn = "";

    isNegative = false;
    if (strNum.substr(0, 1) == "-") {
        isNegative = true;
        strNum = strNum.substr(1);
    }

    for (i = parseInt((strNum.length - 1) / 3); i >= 0 ; i--) {
        strReturn = "," + strNum.substr(strNum.length - 3) + strReturn;
        strNum = strNum.substring(0, strNum.length - 3);
    }
    strReturn = strReturn.substr(1);

    if (isNegative) {
        strReturn = "-" + strReturn;
    }

    return strReturn;
}


//onkeyup="javascript:ByteCheck(this);" onkeypress="javascript:ByteCheck(this);"
/*셀렉트박스 체인지
 function Select_Change(form){
 var exp1		= form.rf_exp1;
 var exp2		= form.rf_exp2;
 var school_		= new Array();
 var school_in	= new Array("f1","f2","f3");
 var school_out	= new Array("g1","g2","g3","g4");
 var chk			= exp1.options[exp1.selectedIndex].value;
 var list		= "school_"+chk;
 var chk_nm		= eval(list);

 for(var i=exp2.length-1;i>0;i--){
 exp2.options[i]=null;
 }

 for(var j=1;j<chk_nm.length+1;j++){
 exp2.options[j]=new Option(chk_nm[j-1],chk_nm[j-1]);
 }
 }*/

