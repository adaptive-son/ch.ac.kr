<?
// adframe 공통 인클루드 파일
include_once "../_common.php";

if ($mode == "u") {
    $sql = "select * from " . TABLE_PROFESSOR . " where del_yn='N' AND idx = '" . $idx . "'";
    $vinfo = mysql_fetch_array(mysql_query($sql));
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

    <script type="text/javascript">
        $(document).ready(function(){
        });


        function fn_inputFormSubmit(f){
            if(!Val_Chk(f.name,"교수명"))   return false;
            return true;
        }
    </script>


</head>
<body>

<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; padding-left: 31px; min-height: 550px; background-color: #fff;">
    <div class="contents">
        <form name="frm_userinfo" id="frm_userinfo" method="POST" action="proc.php" onsubmit="return fn_inputFormSubmit(this)"  enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="<?=$mode?>"/>
            <input type="hidden" name="idx" id="idx" value="<?=$idx?>"/>
            <h2 class="title0201">회원 관리</h2>

            <div class="menu-title-area">
                <h3 class="title0301">
                    회원 정보
                </h3>
            </div>
            <div class="t1 mb30">
                <table style="width: 100%">
                    <colgroup>
                        <col style="width: 20%">
                        <col style="width: 30%">
                        <col style="width: 20%">
                        <col style="width: 30%">
                    </colgroup>
                    <tbody>
                    <tr>
						<th>교수구분</th>
                        <td>
							<input type="radio" id="etc1" name="etc1" <?php if($vinfo["etc1"]=="1"){?>checked="checked"<?php } ?> value="1">
							<label for="etc1">
								전임교수
							</label>
							<input type="radio" id="etc2" name="etc1" <?php if($vinfo["etc1"]=="2"){?>checked="checked"<?php } ?> value="2">
							<label for="etc2">
								겸임교수
							</label>
							<input type="radio" id="etc3" name="etc1" <?php if($vinfo["etc1"]=="3"){?>checked="checked"<?php } ?> value="3">
							<label for="etc3">
								외래교수
							</label>
							<input type="radio" id="etc4" name="etc1" <?php if($vinfo["etc1"]=="4"){?>checked="checked"<?php } ?> value="4">
							<label for="etc4">
								조교
							</label>
							<input type="radio" id="etc5" name="etc1" <?php if($vinfo["etc1"]=="5"){?>checked="checked"<?php } ?> value="5">
							<label for="etc4">
								계장
							</label>
						</td>
                        <th>성명</th>
                        <td><input type="text" name="name" id="name" class="text" value="<?=$vinfo["name"]?>" hname="이름" required="required" maxlength="" /></td>

                    </tr>
                    <tr>
						<th>직위</th>
                        <td><input type="text" name="position" id="position" class="text" value="<?=$vinfo["position"]?>" hname="직위"  maxlength="" /></td>
						<th>순서</th>
                        <td><input type="number" name="sort" id="sort" class="text" value="<?=$vinfo["sort"]?>"   maxlength="" /></td>
                    </tr>
					<tr>
						<th>담당과목(담당업무) /<br>1학기 담당과목</th>
                        <td colspan="3"><input type="text" style="width:650px;" name="responsibility1" id="responsibility1" class="text" value="<?=$vinfo["responsibility1"]?>" hname="담당과목"  maxlength="" /></td>
					</tr>
					<tr>
						<th>2학기 담당과목</th>
                        <td colspan="3"><input type="text" style="width:650px;" name="responsibility2" id="responsibility2" class="text" value="<?=$vinfo["responsibility2"]?>" hname="담당과목"  maxlength="" /></td>
					</tr>
                    <tr>
                        <th>전자우편</th>
                        <td><input type="text" name="email" id="email" class="text" value="<?=$vinfo["email"]?>" hname="전자우편"  maxlength="" /></td>
                        <th>전화번호</th>
                        <td><input type="text" name="tel" id="tel" class="text" value="<?=$vinfo["tel"]?>" hname="전화번호"  maxlength="50" /></td>

                    </tr>
                    <tr>
                        <th>연구실(사무실)</th>
                        <td><input type="text" name="office" id="office" class="text" value="<?=$vinfo["office"]?>" hname="연구실"  maxlength="" /></td>
                        <th>사진</th>
                        <td>
                            <input type="file" name="b_file"  id="b_file" class="file"/><br/>
                            <? if($vinfo["file_name"]){?>
                                <input type="checkbox" name="del_file" value="1"/>삭제 (<?=$vinfo["file_org"]?>)<br/>
                            <?}?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!--<div>

                <div class="mb15">
                    <h3 class="title0301">담당과목</h3>
                    <input type="text" name="responsibility" id="responsibility" style="width:100%;" class="text" value="<?=$vinfo["responsibility"]?>" />
                </div>
                <div class="mb15">
                    <h3 class="title0301">학력</h3>
                    <textarea name="achievement" style="width:100%;height:100px;"><?=$vinfo["achievement"]?></textarea>
                </div>
                <div class="mb15">
                     <h3 class="title0301">경력</h3>
                    <textarea name="career" style="width:100%;height:100px;"><?=$vinfo["career"]?></textarea>

                </div>
                <div class="mb15">
                    <h3 class="title0301">연구실적 <input type="checkbox" name="researchresult_s" id="researchresult_s" <?=$vinfo['researchresult_s']?"checked='checked'":""?> value="1" /><label for="researchresult_s">비공개</label></h3>
                    <textarea name="researchresult" style="width:100%;height:100px;"><?=$vinfo["researchresult"]?></textarea>

                </div>
                <div class="mb15">
                    <h3 class="title0301">가족회사 및 산업체관련 경력</h3>
                    <textarea name="career2" style="width:100%;height:100px;"><?=$vinfo["career2"]?></textarea>

                </div>

            </div>-->

            <div class="btns-center">
                <button type="submit" class="btn-type01">
                    확인
                </button>
                <a href="javascript:history.back(-1);" class="btn-type02">
                    목록
                </a>
            </div>

        </form>

    </div>
</div>
<!-- //wrapper -->

</body>
</html>
