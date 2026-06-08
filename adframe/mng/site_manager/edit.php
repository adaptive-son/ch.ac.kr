<?
// adframe 공통 인클루드 파일
include_once "../_common.php";


if($j=="u") {
    $sql = " select * from ".TABLE_SITE_MNG." where site_no = '$site_no' ";
    $row = mysql_fetch_array(mysql_query($sql));
    $title = "수정";

} else if ($j == "") {
    $title = "입력";
}
?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
    <? include_once("../include/__meta.php"); ?>
    <title> 관리자페이지 </title>

    <SCRIPT LANGUAGE="JavaScript">
        function frmsite_check(f) {

            if(!Val_Chk(f.site_id,'사이트 아이디'))   return false;
            if(!Val_Chk(f.site_name,'사이트 명'))   return false;
            if(!Val_Chk(f.site_domain,'사이트 도메인'))   return false;
            if(!SelectBox_Chk(f.site_type, '사이트 구분'))   return false;
            if(!SelectBox_Chk(f.locale_lang, '언어'))   return false;
            if(!Val_Chk(f.site_title,'사이트 타이틀'))   return false;

            return true;
        }
    </SCRIPT>

</head>
<body>

<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; padding-left: 31px; min-height: 550px; background-color: #fff;">
    <!-- contents -->
    <div class="contents">

        <h2 class="title0201">
            사이트 관리
        </h2>
        <div class="board-area">
            <fieldset>
                <div class="board-search-area t1">
                    <form name=frm_input id="frm_input" method=post action='update.php' onsubmit="return frmsite_check(this)" >
                        <input type=hidden name=j value='<? echo $j?>'>
                        <input type=hidden name=site_no value='<? echo $site_no?>'>

                        <table width="100%">
                            <colgroup>
                                <col style="width: 20%" />
                                <col style="width: 80%" />
                            </colgroup>

                            <tbody>
                            <tr>
                                <th><strong>사이트 아이디(영문)</th>
                                <td style="text-align:left;">
                                    <input type="text" name="site_id" id="site_id" class="onlyAlphabetAndNumber" title="사이트아이디" class="inTxt cms_im_d" style="width:300px;" value="<?=$row['site_id']?>" <?if($j=="u") echo " readonly"?>/>
                                </td>
                            </tr>
                            <tr>
                                <th><strong>사이트명</th>
                                <td style="text-align:left;">
                                    <input type="text" name="site_name" id="site_name" title="사이트명" class="inTxt" style="width:300px;" value="<?= $row['site_name']?>" />
                                </td>
                            </tr>
                            <tr>
                                <th><strong>사이트도메인</th>
                                <td style="text-align:left;">
                                    <input type="text" name="site_domain" id="site_domain" title="사이트도메인" class="inTxt" style="width:300px;" value="<?= $row['site_domain']?>" />
                                </td>
                            </tr>
                            <tr>
                                <th><strong>사이트 타이틀</th>
                                <td style="text-align:left;"><input type="text" name="site_title" id="site_title" title="사이트 TITLE" class="inTxt" style="width:300px;" value="<?= $row['site_title']?>" /></td>
                            </tr>
                            <tr>
                                <th><strong>담당자</th>
                                <td style="text-align:left;"><input type="text" name="manager_name" id="manager_name" title="담당자" class="inTxt" style="width:300px;" value="<?= $row['manager_name']?>" /></td>
                            </tr>
                            <tr>
                                <th><strong>대표이메일</th>
                                <td style="text-align:left;"><input type="text" name="site_email" id="site_email" title="대표이메일" class="inTxt" style="width:300px;" value="<?= $row['site_email']?>" /></td>
                            </tr>
                            <tr>
                                <th><strong>전화번호</th>
                                <td style="text-align:left;"><input type="text" name="site_phone" id="site_phone" title="전화번호" class="inTxt" style="width:300px;" value="<?= $row['site_phone']?>" /></td>
                            </tr>
                            <tr>
                                <th><strong>팩스번호</th>
                                <td style="text-align:left;"><input type="text" name="site_fax" id="site_fax" title="팩스번호" class="inTxt" style="width:300px;" value="<?= $row['site_fax']?>" /></td>
                            </tr>
                            <tr>
                                <th><strong>주소</th>
                                <td style="text-align:left;"><input type="text" name="site_addr" id="site_addr" title="주소" class="inTxt" style="width:300px;" value="<?= $row['site_addr']?>" /></td>
                            </tr>
                            <tr>
                                <th><strong>copyright</th>
                                <td style="text-align:left;"><input type="text" name="site_copyright" id="site_copyright" title="copyright" class="inTxt" style="width:300px;" value="<?= $row['site_copyright']?>" /></td>
                            </tr>
                            <tr>
                                <th><strong>개인정보보호정책 담당자</th>
                                <td style="text-align:left;">
                                    <input type="text" name="pri_manager_name" id="pri_manager_name" title="개인정보보호정책 담당자" class="inTxt" style="width:300px;" value="<?= $row['pri_manager_name']?>" />
                                </td>
                            </tr>
                            <tr>
                                <th><strong>회원약관</th>
                                <td style="text-align:left;"><textarea name="member_clause" id="member_clause" title="회원약관" class="inTxt" style="width:500px;height:150px;"><?= $row['member_clause']?></textarea></td>
                            </tr>
                            <tr>
                                <th><strong>개인정보수집 이용안내</th>
                                <td style="text-align:left;"><textarea name="member_perinfo" id="member_perinfo" title="개인정보수집 이용안내" class="inTxt" style="width:500px;height:150px;"><?=$row['member_perinfo']?></textarea></td>
                            </tr>
                            <tr>
                                <th><strong>사이트 설명</th>
                                <td style="text-align:left;"><textarea name="site_desc" id="site_desc" title="사이트설명" class="inTxt" style="width:500px;height:150px;"><?=$row['site_desc']?></textarea></td>
                            </tr>
                            <tr>
                                <th><strong>검색엔진 키워드</th>
                                <td style="text-align:left;">
                                    <input type="text" name="site_keyword" id="site_keyword" title="키워드" class="inTxt" style="width:300px;" value="<?= $row['site_keyword']?>" />
                                </td>
                            </tr>
                            </tbody>

                        </table>

                        <div class="btns-area">
                            <div class="btns-center">
                                <input type="submit"  class="btn-type01" alt="확인" value="확인" />
                                <a href="list.php" class="btn-type02">목록</a>
                            </div>
                        </div>

                    </form>
                </div>

        </div>
    </div>
    <!-- //contents -->
</div>
<!-- //wrapper -->

</body>
</html>