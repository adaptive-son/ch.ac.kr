<?
// adframe 공통 인클루드 파일
include_once "../_common.php";

if ($w == "") {
    $BBS_BoardKey = Array (
        "10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35",
        "36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61",
        "62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84","85","86","87",
        "88","89","90","91","92","93","94","95","96","97","98","99",
        "a0","a1","a2","a3","a4","a5","a6","a7","a8","a9","b0","b1","b2","b3","b4","b5","b6","b7","b8","b9","c0","c1","c2","c3","c4","c5",
        "c6","c7","c8","c9","d0","d1","d2","d3","d4","d5","d6","d7","d8","d9","e0","e1","e2","e3","e4","e5","e6","e7","e8","e9","f0","f1",
        "f2","f3","f4","f5","f6","f7","f8","f9","g0","g1","g2","g3","g4","g5","g6","g7","g8","g9","h0","h1","h2","h3","h4","h5","h6","h7",
        "h8","h9","i0","i1","i2","i3","i4","i5","i6","i7","i8","i9",
        "j0","j1","j2","j3","j4","j5","j6","j7","j8","j9","k0","k1","k2","k3","k4","k5","k6","k7","k8","k9","l0","l1","l2","l3","l4","l5",
        "l6","l7","l8","l9","m0","m1","m2","m3","m4","m5","m6","m7","m8","m9","n0","n1","n2","n3","n4","n5","n6","n7","n8","n9","o0","o1",
        "o2","o3","o4","o5","o6","o7","o8","o9","p0","p1","p2","p3","p4","p5","p6","p7","p8","p9","q0","q1","q2","q3","q4","q5","q6","q7",
        "q8","q9","r0","r1","r2","r3","r4","r5","r6","r7","r8","r9",
        "s0","s1","s2","s3","s4","s5","s6","s7","s8","s9","t0","t1","t2","t3","t4","t5","t6","t7","t8","t9","u0","u1","u2","u3","u4","u5",
        "u6","u7","u8","u9","v0","v1","v2","v3","v4","v5","v6","v7","v8","v9","w0","w1","w2","w3","w4","w5","w6","w7","w8","w9","x0","x1",
        "x2","x3","x4","x5","x6","x7","x8","x9","y0","y1","y2","y3","y4","y5","y6","y7","y8","y9","z0","z1","z2","z3","z4","z5","z6","z7",
        "z8","z9","za","zb","zc","zd","ze","zf","zg","zh","zi","zj","zk","zl","zm","zn","zo","zp","zq","zr","zs","zt","zu","zx","zy","zz"
    );
    $len = strlen($board_key);
    if ($len == 10) {
        alert_back("게시판 분류를 더 이상 추가할 수 없습니다.\\n\\n5단계 분류까지만 가능합니다.");
    }
    //서브코드일 경우 상위 테이블명을 따라간다.
    if ( $len > 0 ) {
        $sql = " select board_id from ".TABLE_BOARD_MNG." where board_key = '$board_key' ";
        $view = $adb->getRow($sql);
        $view_board_id = $view[board_id];
    }
    $len2 = $len + 1;
    $sql = " select MAX(SUBSTRING(board_key,$len2,2)) as max_subid from ".TABLE_BOARD_MNG." where SUBSTRING(board_key,1,$len) = '$board_key' ";
    $row = $adb->getRow($sql);
    if ( $row[max_subid] ) {
        //최대값이 있을때
        for($i=0; $i<count($BBS_BoardKey); $i++){
            if($row[max_subid] == $BBS_BoardKey[$i]){
                $subid = $BBS_BoardKey[$i+1];
            }
        }
    }else{
        //최대값이 없을때
        $subid = $BBS_BoardKey[0];
    }
    $subid = $board_key.$subid;
    $sublen = strlen($subid);
    $board_key = $subid;
    /*********************** 기본 설정값 *********************************/
    $view[board_width] = "100";
    $view[board_titlecut] = "60";
    $view[board_listnum] = "20";
    $view[module_editor] = "PureEditer.php";
    $view[module_uploader] = "NormalUploader.php";
    $view[board_viewimgwidth] = "600";
    $view[board_gallnum] = "4";
    $view[board_gallwidth] = "180";
    $view[board_gallheight] = "180";
    $view[board_upfile] = "2";
    $view[board_upfilesize] = "10247680"; //10M
    //$view[board_upfile_limitext] = "ext,htm,html,css,asp,aspx,js,jsp,php,php3,php4,php5,phtml,phtm,inc,cgi,phps,pl,sh,htaccess,conf";
    $view[board_upfile_limitext] = "";
    $view[board_checkcolumn] = "title,name,pwd,content";
    $view[board_checktitle] = "제목,이름,비밀번호,내용";
    /*********************** 기본 설정값 *********************************/
}else{
    $sql = " select * from abbs_manager where idx = '$idx' ";
    $view = $adb->getRow($sql);
    $board_key = $view[board_key];
    $view[board_id] = $view[board_id];
}
?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
    <? include_once("../include/__meta.php"); ?>
    <title> 관리자페이지 </title>

    <script language="javascript">

        function chkPatten(field,patternGubun,trimYn) {
            var pattern = getMakePattern(field, patternGubun);
            var regNum   =/^[0-9]+$/;
            var regAlpha  =/^[a-zA-Z]+$/;
            // var regHangul  =/[가-�R]/;
            // var regHangulEng =/[가-�Ra-zA-Z]/;
            var regHangulOnly =/^[가-�R]*$/;
            var regHost   =/^[a-zA-Z-]+$/;
            var regPhone  =/^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/;
            var regMail   =/^[_a-zA-Z0-9-]+@[._a-zA-Z0-9-]+\.[a-zA-Z]+$/;
            var regId   = /^[a-zA-Z]{1}[a-zA-Z0-9_-]{4,15}$/;
            var regDate   =/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
            var regDomain  =/^[.a-zA-Z0-9-]+.[a-zA-Z]+$/;
            var fieldValue = field.value;
            if(!fieldValue) return true;
            if(trimYn=="trim") {
                fieldValue = trim(fieldValue);
                field.value = fieldValue;
            }
            pattern = eval(pattern);
            var re = new RegExp(pattern);
            if(!re.test(fieldValue)){
                alert("항목의 형식이 올바르지 않습니다.\n");
                field.focus();
                return false;
            }
            return true;
        }

        function getMakePattern(field, patternGubun) {
            var patternNum = "0-9";
            var patternAlpha ="a-zA-Z";
            var patternHangul ="가-�R";
            var patterngTrim = " ";
            var patterngSpe = "._-";
            var patternForm = patternGubun.split(",");
            var pattern = "/^[";
            var pattrenVal = "";
            var pattrenLength = "";
            for(var i=0; i<patternForm.length; i++){
                pattrenVal = patternForm[i];
                pattrenLength = pattrenVal.length;
                if(pattrenLength == 1){
                    if(pattrenVal == "N") pattern+=patternNum;
                    else if(pattrenVal == "A") pattern+=patternAlpha;
                    else if(pattrenVal == "H") pattern+=patternHangul;
                    else if(pattrenVal == "T") pattern+=patterngTrim;
                    else if(pattrenVal == "S") pattern+=patterngSpe;
                }else{
                    return patternGubun;
                }
            }
            pattern += "]+$/";
            return pattern;
        }

        function trim(str) {
            str = str.replace(/\s/g,'');
            return str;
        }

        function check_submit(f) {
            <? if($w != "u"){ ?>
            var bbs_id_check = isAlphabet(f.fm_board_id.value, "a");
            if (f.fm_board_id.value == ""){
                alert("게시판 아이디를 입력하여 주십시요!");
                f.fm_board_id.focus();
                return false;
            }
            <? } ?>
            if(!SelectBox_Chk(f.fm_site_id,"사이트 아이디"))   return false;
            if (f.fm_board_name.value == ""){
                alert("게시판 이름을 입력하여 주십시요!");
                f.fm_board_name.focus();
                return false;
            }
            if (f.fm_board_skin.value == ""){
                alert("게시판 스킨을 선택하여 주십시요!");
                f.fm_board_skin.focus();
                return false;
            }
            if (f.fm_board_width.value == ""){
                alert("게시판 테이블 가로폭을 입력하여 주십시요!");
                f.fm_board_width.focus();
                return false;
            }
            if (f.fm_board_titlecut.value == ""){
                alert("게시판 리스트 제목길이를 입력하여 주십시요!");
                f.fm_board_titlecut.focus();
                return false;
            }
            if (f.fm_board_listnum.value == ""){
                alert("게시판 페이지당 출력수를 입력하여 주십시요!");
                f.fm_board_listnum.focus();
                return false;
            }
            if (f.fm_board_gallnum.value == ""){
                alert("갤러리 가로 이미지수를 입력하여 주십시요!");
                f.fm_board_gallnum.focus();
                return false;
            }
            if (f.fm_board_gallwidth.value == ""){
                alert("갤러리 리스트 이미지 가로를 입력하여 주십시요!");
                f.fm_board_gallwidth.focus();
                return false;
            }
            if (f.fm_board_gallheight.value == ""){
                alert("갤러리 리스트 이미지 세로를 입력하여 주십시요!");
                f.fm_board_gallheight.focus();
                return false;
            }
            if (f.fm_board_upfile.value == ""){
                alert("파일 업로드 수 입력하여 주십시요!");
                f.fm_board_upfile.focus();
                return false;
            }
            if (f.fm_board_upfilesize.value == ""){
                alert("파일 업로드 용량 입력하여 주십시요!");
                f.fm_board_upfilesize.focus();
                return false;
            }
            if (f.fm_board_checkcolumn.value == ""){
                alert("게시판 필수 체크항목(컬럼)을 입력하여 주십시요!");
                f.fm_board_checkcolumn.focus();
                return false;
            }
        }
    </script>
    <style>
        .board-list tbody tr { height: 25px; line-height: 3em; }
        .board-list tbody tr td {
            padding: 5px 3px;
            line-height: 3em;
        }
        .board-list tbody tr td.top-line {
            border-top: 2px solid #65737d;
        }
    </style>
</head>
<body>

    <!-- wrapper -->
    <div class="wrapper" id="wrapper" style="padding: 0; padding-left: 31px; min-height: 550px; background-color: #fff;">
        <!-- contents -->
        <div class="contents">

            <h2 class="title0201">
                게시판 추가
            </h2>
            <div class="board-area">
                <fieldset>

                    <div class="board-list">
                        <form name="pform" method="post" action="proc.php"  onsubmit="return check_submit(this);">
                            <? if($w == "u"){ ?>
                                <input type="hidden" name="Confirm" value="update">
                                <input type="hidden" name="idx" value="<?=$idx?>">
                            <? }else{ ?>
                                <input type="hidden" name="Confirm" value="insert">
                            <? } ?>

                            <table style="width: 100%" summary="이 표는 게시판을 추가하기 위한 내용을 입력하는 표입니다.">
                                <colgroup>
                                    <col style="width: 30%" />
                                    <col style="width: *" />
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td class="top-line"> 게시판 서브코드 </td>
                                    <td class="left top-line"> <input type="hidden" name="fm_board_key" value="<?=$board_key?>"><?=$board_key?> </td>
                                </tr>
                                <? if($w != "u" && $sublen == 2){ ?>
                                <tr>
                                    <td>게시판 아이디</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_id" value="<?=$view[board_id]?>" size="40" onBlur="chkPatten(this,'N,A,T','trim');">
                                        ※영문, 숫자로만 작성해주세요
                                    </td>
                                </tr>
                                <? } else if ( $w != "u" && $sublen > 2 ) { ?>
                                <tr>
                                    <td>게시판 아이디</td>
                                    <td class="left">
                                        <input type="hidden" name="fm_board_id" value="<?=$view[board_id]?>">
                                        <?=$view_board_id?>
                                    </td>
                                </tr>
                                <? }else{ ?>
                                <tr>
                                    <td>게시판 아이디</td>
                                    <td class="left">
                                        <?=$view[board_id]?>
                                    </td>
                                </tr>
                                <? } ?>
                                <tr>
                                    <td>사용 사이트</td>
                                    <td class="left">
                                        <?php

                                        $selSite_sql ="SELECT * FROM  ".TABLE_SITE_MNG." mng ";
                                        $selSite_sql .=" WHERE mng.use_yn ='Y' ";
                                        $selSite_sql .=" ORDER BY mng.site_no asc ";
                                        $selSite_result = mysql_query($selSite_sql) or die (mysql_error());

                                        $selected_site = $_SESSION['sel_site_id'];
                                        if($sublen > 2 ){
                                            $sql = " select site_id  from ".TABLE_BOARD_MNG." where SUBSTRING(board_key,1,$len) = '$_GET[board_key]' ";
                                            $row = $adb->getRow($sql);
                                            $selected_site = $row[site_id];
                                        }
                                        ?>
                                        <select id="site_id" name="fm_site_id" class="select">
                                            <option value="">사이트 선택</option>
                                            <option value="common" <?php if($view['site_id']=="common" || $selected_site=="common") echo "selected";?>>공용</option>
                                            <?php while($selSite=mysql_fetch_array($selSite_result)) {?>
                                                <option value="<?=$selSite['site_id']?>" <?php if($view['site_id']==$selSite['site_id'] && $w == "u") echo "selected";   if($selSite['site_id']==$selected_site && $w == "") echo "selected";?>><?=$selSite['site_name']?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>게시판 이름</td>
                                    <td class="left"> <input type="text" name="fm_board_name" value="<?=$view[board_name]?>" size="40"></td>
                                </tr>
                                <tr>
                                    <td>게시판  카테고리</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_category" value="<?=$view[board_category]?>" style="width:100%">
                                        ※분류와 분류 사이는 | 로 구분하세요. (예: 질문|답변) 첫자로 #은 입력하지 마세요. (예: #질문|#답변 [X])
                                    </td>
                                </tr>
                                <tr>
                                    <td> 게시판 스킨 </td>
                                    <td class="left">
                                        <select name="fm_board_skin" style="width: 150px;">
                                            <option value="">::스킨선택::</option>
                                            <?
                                            $arr = get_dir_list($_SERVER["DOCUMENT_ROOT"]."/adframe/bbs/skin/");
                                            for ($i=0; $i<count($arr); $i++) {
                                                if($arr[$i]!="adm_board"){
                                                    if($arr[$i] == $view[board_skin])	$sel = " selected";
                                                    else								$sel = "";
                                                    echo "<option value='$arr[$i]' $sel>$arr[$i]</option>\n";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 에디터 모듈</td>
                                    <td class="left">
                                        <select name="fm_module_editor" style="width:150px;">
                                            <option value="">::에디터선택::</option>
                                            <?
                                            $arr = get_file_list($_SERVER["DOCUMENT_ROOT"]."/adframe/bbs/module/editor");
                                            for ($i=0; $i<count($arr); $i++) {
                                                $tmp1 = explode("/", $arr[$i]);
                                                $efile_name = $tmp1[count($tmp1)-1];
                                                $tmp2 = explode(".", $efile_name);
                                                $efile_view = $tmp2[0];
                                                if($efile_name == $view[module_editor])	$sel = " selected";
                                                else								$sel = "";
                                                echo "<option value='$efile_name' $sel>$efile_view</option>\n";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>업로드 모듈</td>
                                    <td class="left">
                                        <select name="fm_module_uploader" style="width:150px;">
                                            <option value="">::업로더선택::</option>
                                            <?
                                            $arr = get_file_list($_SERVER["DOCUMENT_ROOT"]."/adframe/bbs/module/uploader");
                                            for ($i=0; $i<count($arr); $i++) {
                                                $tmp1 = explode("/", $arr[$i]);
                                                $efile_name = $tmp1[count($tmp1)-1];
                                                $tmp2 = explode(".", $efile_name);
                                                $efile_view = $tmp2[0];
                                                if($efile_name == $view[module_uploader])	$sel = " selected";
                                                else									$sel = "";
                                                echo "<option value='$efile_name' $sel>$efile_view</option>\n";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="top-line">댓글 사용여부</td>
                                    <td class="top-line left">
                                        <select name="fm_board_commentuse" style="width: 150px;">
                                            <option value="N"<? if($view[board_commentuse] == "N") echo " selected"; ?>>사용안함</option>
                                            <option value="Y"<? if($view[board_commentuse] == "Y") echo " selected"; ?>>사용함</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="top-line">비밀글 사용여부</td>
                                    <td class="top-line left">
                                        <select name="fm_board_secure" style="width: 150px;">
                                            <option value="N"<? if($view[board_secure] == "N") echo " selected"; ?>>사용안함</option>
                                            <option value="Y"<? if($view[board_secure] == "Y") echo " selected"; ?>>체크박스 구분</option>
                                            <option value="E"<? if($view[board_secure] == "E") echo " selected"; ?>>글작성 시 무조건</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>보기페이지 목록출력</td>
                                    <td class="left">
                                        <select name="fm_board_listview" style="width: 150px;">
                                            <option value="N"<? if($view[board_listview] == "N") echo " selected"; ?>>사용안함</option>
                                            <option value="Y"<? if($view[board_listview] == "Y") echo " selected"; ?>>사용함</option>
                                        </select>
                                        ※사용시 보기페이지에서 게시판 목록출력
                                    </td>
                                </tr>
                                <tr>
                                    <td class="top-line">게시판 테이블 가로폭</td>
                                    <td class="left top-line">
                                        <input type="text" name="fm_board_width" value="<?=$view[board_width]?>" style="width:100px" onBlur="chkPatten(this,'N,T','trim');">
                                        ※100 이하는 % 처리 (99, 100은 %, 101부터 px)
                                    </td>
                                </tr>
                                <tr>
                                    <td>리스트 제목길이</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_titlecut" value="<?=$view[board_titlecut]?>" style="width:100px" onBlur="chkPatten(this,'N,T','trim');">
                                        ※목록에서의 제목 글자수. 잘리는 글은 … 로 표시
                                    </td>
                                </tr>
                                <tr>
                                    <td>페이지당 출력수</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_listnum" value="<?=$view[board_listnum]?>" style="width:100px" onBlur="chkPatten(this,'N,T','trim');">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="top-line">보기페이지 내용에서 이미지보기</td>
                                    <td class="left top-line">
                                        <select name="fm_board_viewimg" style="width: 150px;">
                                            <option value="N"<? if($view[board_viewimg] == "N") echo " selected"; ?>>사용안함</option>
                                            <option value="Y"<? if($view[board_viewimg] == "Y") echo " selected"; ?>>사용함</option>
                                        </select>
                                        ※첨부파일로 업로드 된 이미지를 본문에서 볼지 설정합니다.
                                    </td>
                                </tr>
                                <tr>
                                    <td>보기페이지 이미지 가로크기</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_viewimgwidth" value="<?=$view[board_viewimgwidth]?>" style="width:100px" onBlur="chkPatten(this,'N,T','trim');">
                                    </td>
                                </tr>
                                <tr>
                                    <td>갤러리 가로이미지 수</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_gallnum" value="<?=$view[board_gallnum]?>" style="width:100px" onBlur="chkPatten(this,'N,T','trim');">
                                        ※스킨이 갤러리형일때 적용됩니다.
                                    </td>
                                </tr>
                                <tr>
                                    <td>갤러리 리스트이미지 가로</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_gallwidth" value="<?=$view[board_gallwidth]?>" style="width:100px" onBlur="chkPatten(this,'N,T','trim');">
                                        ※스킨이 갤러리형일때 적용됩니다.
                                    </td>
                                </tr>
                                <tr>
                                    <td>갤러리 리스트이미지 세로</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_gallheight" value="<?=$view[board_gallheight]?>" style="width:100px" onBlur="chkPatten(this,'N,T','trim');">
                                        ※스킨이 갤러리형일때 적용됩니다.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="top-line">파일 업로드 수</td>
                                    <td class="top-line left">
                                        <input type="text" name="fm_board_upfile" value="<?=$view[board_upfile]?>" style="width:100px" onBlur="chkPatten(this,'N,T','trim');">
                                        ※게시물 한건당 업로드 할 수 있는 파일의 최대 개수 (0 이면 제한 없음)
                                    </td>
                                </tr>
                                <tr>
                                    <td>파일 업로드 용량</td>
                                    <td class="left">
                                        업로드 파일 한개당
                                        <input type="text" name="fm_board_upfilesize" value="<?=$view[board_upfilesize]?>" style="width:100px" onBlur="chkPatten(this,'N,T','trim');">
                                        bytes 이하 (1 MB = 1,024,768 bytes : php.ini설정 max값)
                                    </td>
                                </tr>
                                <tr>
                                    <td>업로드 파일확장자</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_upfile_limitext" value="<?=$view[board_upfile_limitext]?>" style="width:100%">
                                        ※확장자 추가시 콤마(,)로 구분하여 입력해 주세요. (설정시 지정한 파일만 업로드 가능)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="top-line">상단 인쿠르드파일 경로</td>
                                    <td class="top-line left">
                                        <input type="text" name="fm_board_topinclude" value="<?=$view[board_topinclude]?>" style="width:100%">
                                        ※ / 경로 이후부터 경로를 입력하시면 됩니다. ( ex : /sub01/top.php )
                                    </td>
                                </tr>
                                <tr>
                                    <td>하단 인쿠르드파일 경로</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_bottominclude" value="<?=$view[board_bottominclude]?>" style="width:100%">
                                        ※ / 경로 이후부터 경로를 입력하시면 됩니다. ( ex : /sub01/bottom.php )
                                    </td>
                                </tr>
                                <tr>
                                    <td class="top-line">게시판 추가컬럼사용</td>
                                    <td class="top-line left">
                                        <input type="text" name="fm_board_addcolumn" value="<?=$view[board_addcolumn]?>" style="width:100%">
                                        ※컬럼추가 사용 시 콤마(,)로 구분하여 입력해 주세요. (DB컬럼자동생성, 스킨에서 input네임만 추가시 사용가능)
                                    </td>
                                </tr>
                                <tr>
                                    <td>게시판 필수체크사용</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_checkcolumn" value="<?=$view[board_checkcolumn]?>" style="width:100%">
                                        ※스크립트로 체크 될 필수항목의 컬럼명을 콤마(,)로 구분하여 입력해 주세요.
                                    </td>
                                </tr>
                                <tr>
                                    <td>게시판 필수체크사용</td>
                                    <td class="left">
                                        <input type="text" name="fm_board_checktitle" value="<?=$view[board_checktitle]?>" style="width:100%">
                                        ※스크립트로 체크 될 필수항목의 타이틀을 콤마(,)로 구분하여 입력해 주세요.
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <div class="btns-area">
                        <div class="btns-right">
                            <a href="javascript:document.pform.submit();" class="btn-type01">
                                추가
                            </a>
                            <a href="list.php" class="btn-type01">
                                목록
                            </a>
                        </div>
                    </div>
                    
                </fieldset>

            </div>
        </div>
        <!-- //contents -->
    </div>
    <!-- //wrapper -->

</body>
</html>
