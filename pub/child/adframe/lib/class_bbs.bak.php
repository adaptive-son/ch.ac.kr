<?php
//alert("@@@@");
/******************************************************************************************************
//사용예제
$Obj=new Sub_BBSStart();
$Obj->makebbs($bbs,1,1,"iuk_board_6","iuk_bbs",20,1);


$Obj=new Sub_BBSStart();

$bbs		- Default
$BoardKey	- Int형 구분자
$sub_No	- Int형 구분자
DB			- Database Table명
SKIN		- 스킨명
LISTNUM	- 리스트 갯수

ADMIN		- INT형 (0:일반 , 1:관리모드)

$Obj->makebbs(
$bbs(현재동작상태표시),
$BoardKey(int),
$sub_No(int),
"데이터베이스",
게시판스킨,
리스트갯수(int),
어드민권한(int)

$bbs_userqry(userid에서 아이디값 검색)
bbs_subqry (and 절로 db추가검색)
);


서브컬럼쿼리 예제
갤러리게시판 리스트이미지 : , (select idx from [[BBSDBTABLE]]_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx
UCC게시판 리스트이미지 : , (select up_filename from [[BBSDBTABLE]]_file where file_type = 10 and up_file_idx = A.up_file_idx limit 0,1) as up_filename

 *******************************************************************************************************/

// BBS Make Module
class Sub_BBSStart {

    var $bbs;
    var $c_BoardKey;
    var $c_Sub_No;
    var $c_SecAdmin;
    var $skin_folder; // 스킨폴더

    function makebbs($bbs, $BoardKey, $Sub_No="0", $SecAdmin="0", $bbs_userqry="", $bbs_subqry="", $bbs_subcolumnqry="",$is_site_type="front") {
        global $PHP_SELF, $_SESSION, $data, $search, $searchstring;


		$searchstring = injection_filer($searchstring);
		$searchstring = xss_clean($searchstring);

		if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
			//echo $searchstring;
		}

        $_POST = array_map('mysql_escape_string', $_POST);
        $_GET = array_map('mysql_escape_string', $_GET);

        if ( strtolower(gettype($BoardKey)) == "array" ) {
            $bbsCode_flags = true;
            $subsql_BoardKey = "";
            foreach ( $BoardKey as $k => $v ) {
                if ( $v != "" ) {
                    if ( $subsql_BoardKey != "" ) $subsql_BoardKey .= ", ";
                    $subsql_BoardKey .= "'".$v."'";
                }
            }
            $BoardKey = $BoardKey[0];
        }

        $this->bbs			= $bbs;
        $this->c_BoardKey	= $BoardKey;
        $this->c_Sub_No		= $Sub_No;
        $this->c_SecAdmin	= $SecAdmin;


        $configBBS = DBarray("SELECT * FROM ".TABLE_BOARD_MNG." WHERE board_key='".$BoardKey."'"); //게시판 설정로드

        //2018-06-04 추가
        //관리자 페이지일 경우 /bbs/skin/adm_board 단일로 사용
        $configBBS[origin_board_skin] =  $configBBS[board_skin];
        if($is_site_type=="admin"){
            $configBBS[board_skin] = 'adm_board';
			if($configBBS[origin_board_skin]=="main_rule"){
				 $configBBS[board_skin] = 'adm_rule';
			}
        }

        if($_SERVER["REMOTE_ADDR"] == "112.217.216.250") {
            //print_r2($configBBS);
            //exit;
        }

        //권한매핑 설정
        include $_SERVER["DOCUMENT_ROOT"]."/adframe/mng/bbs_manager/auth_config.php";

        //글쓰기시 자동 이름, 패스워드 자동출력
        // $auto_bbs_input 값이
        // true  일 경우 input이 text타입으로 출력
        // false 일 경우 input이 hidden타입 & $auto_bbs_username출력
        if ( $SecAdmin == 1 ) {
            $auto_bbs_input = "true";
            $auto_bbs_username = $bbs_adminname;
            $auto_bbs_userpwd = time();
        } else {
            if ( $bbs_userid ) {
                $auto_bbs_input = "false";
                $auto_bbs_username = $bbs_username;
                $auto_bbs_userpwd = time();
            } else {
                $auto_bbs_input = "true";
                $auto_bbs_username = "";
                $auto_bbs_userpwd = "";
            }
        }

        //관리자 권한일 경우 다른 설정값 무시하고 공지사항형식으로
        if($configBBS[auth_admin] == "Y"){
            $configBBS[auth_list_use] = "N";	//리스트권한 사용여부
            $configBBS[auth_read_use] = "N";	//보기권한 사용여부
            $configBBS[auth_write_use] = "Y";	//쓰기권한 사용여부
            $configBBS[auth_reply_use] = "Y";	//답글권한 사용여부
            $configBBS[auth_comment_use] = "Y";	//댓글권한 사용여부
            $configBBS[auth_upload_use] = "Y";	//업로드권한 사용여부
            $configBBS[auth_download_use] = "N";	//다운로드권한 사용여부

            $configBBS[auth_list] = "";	//리스트권한 세션비교값
            $configBBS[auth_read] = "";	//보기권한 세션비교값
            $configBBS[auth_write] = "OnlyAdmin";	//쓰기권한 세션비교값
            $configBBS[auth_reply] = "OnlyAdmin";	//답글권한 세션비교값
            $configBBS[auth_comment] = "OnlyAdmin";	//댓글권한 세션비교값
            $configBBS[auth_upload] = "OnlyAdmin";	//업로드권한 세션비교값
            $configBBS[auth_download] = "";	//다운로드권한 세션비교값
        }

        //설치 에디터 설정사항

		if( $is_site_type=="admin") {
			$ScrpitBodyCheck = "
				var content = form.content.value;
			";
		} else if($configBBS[module_editor] == "PureEditer.php"){
            $ScrpitBodyCheck = " var content = edt.getHtml();";
        } else if($configBBS[module_editor] == "NamoWec7.php" ) {
            $ScrpitBodyCheck = "
			  if (form.browsertype.value == \"notmsie\"){
			    var content = form.Wec.value;

			    form.fm_content.value = content;
			  }else{
			    //var content = form.Wec.Value;
			    var content = form.Wec.MIMEValue;

			    form.fm_content.value = content;
			  }
			";
        }else if($configBBS[module_editor] == "smartEditor.php" || $configBBS[module_editor] == "smartEditor2.php"){	//20160923 스마트에디터 추가
            $ScrpitBodyCheck = "
				if (oEditors != undefined) {
					oEditors.getById[\"fm_content\"].exec(\"UPDATE_CONTENTS_FIELD\", []);
				}
				$('#fm_content').val( $('#fm_content').val() == '<p>&nbsp;</p>' ? '' :  $('#fm_content').val());
				 var content = form.fm_content.value;
			";
        }else if($configBBS[module_editor] == "None.php"){
            $ScrpitBodyCheck = " var content = form.fm_content.value; ";
        }else{
            $ScrpitBodyCheck = " var content = form.fm_content.value; ";
        }

        //업로드 설정사항
        if($configBBS[module_uploader] == "InnoAP.php"){
            $ScrpitUploadCheck = " if(InnoAPSubmit(form)) form.submit(); ";
            $ScrpitUploadCheckModify = " StartUpload(form); ";
        } else if($configBBS[module_uploader] == "MakeUCC.php" ) {
            //MAKE UCC모듈 로딩
            if($bbs == "compose" || $bbs == "repair")
                include $_SERVER["DOCUMENT_ROOT"]."/bbs/Extention/Uploader/MakeUCC/module/script_module.php";
            $ScrpitUploadCheck = "upload(form); ";
            $ScrpitUploadCheckModify = " upload(form); ";
        }else if($configBBS[module_uploader] == "NormalUploader.php"){
            $ScrpitUploadCheck = " form.submit(); ";
            $ScrpitUploadCheckModify = " form.submit(); ";
        }else if($configBBS[module_uploader] == "None.php"){
            $ScrpitUploadCheck = " form.submit(); ";
            $ScrpitUploadCheckModify = " form.submit(); ";
        }else{
            $ScrpitUploadCheck = " form.submit(); ";
            $ScrpitUploadCheckModify = " form.submit(); ";
        }

        //게시판 가로크기계산
        if($configBBS[board_width] > 100)	$configBBS[board_width] = $configBBS[board_width]."px";
        else								$configBBS[board_width] = $configBBS[board_width]."%";

        //카테고리가 있을 경우 변수에 배열로 담기
        if($configBBS[board_category])	$board_category = explode("|", $configBBS[board_category]);
        $category_list = '';
        for ( $i = 0 ; $i < count($board_category) ; $i++ ) {
            //$category_list .= "<option value='".($i+1)."' ";
            //if ( $category == $i+1 ) $category_list .= " selected ";
            $category_list .= "<option value='".$board_category[$i]."' ";
            if ( $_REQUEST['category'] == $board_category[$i] ) $category_list .= " selected ";
            $category_list .= " > ".$board_category[$i]." </option>";
        }

        //게시판 액션 변수가 없을때 리스트로
        if(!$bbs) $bbs = "list";

        // 게시판 Depth 설정여부
        if(!$BoardKey && !$Sub_No)		$Code_Que = "";
        else if($BoardKey && !$Sub_No)	{
            if ( $bbsCode_flags ) $Code_Que = " and code in ( ".$subsql_BoardKey." ) ";
            else $Code_Que = " and code='$BoardKey'";
        } else if(!$BoardKey && $Sub_No)	$Code_Que = " and sub_no='$Sub_No'";
        else if($BoardKey && $Sub_No)	{
            if ( $bbsCode_flags ) $Code_Que = " and code in ( ".$subsql_BoardKey." ) and sub_no = '$Sub_No' ";
            else $Code_Que = " and code='$BoardKey' and sub_no='$Sub_No'";
        } else	$Code_Que = "";

        //추가쿼리 처리
        if($bbs_userqry)	$Code_Que .= $Code_Que." and userid='$bbs_userqry' and re_step = '0' and re_level = '0' ";
        if($bbs_subqry)		$Code_Que .= $Code_Que." ".$bbs_subqry;

        if($bbs_subcolumnqry)	$bbs_subcolumnqry = str_replace("[[BBSDBTABLE]]", $configBBS[board_id], $bbs_subcolumnqry);

        //2016-08-10 카테고리 추가 배지열
        if($configBBS[board_category]){ // 카테고리사용중이면
            if ( $configBBS[board_skin] == "gallery" && $_REQUEST[category] != "" ) {
                $Code_Que .= " and category='".urldecode($_REQUEST[category])."' ";
            } else if($_REQUEST[category]){
                $Code_Que .= $Code_Que." and category='$_REQUEST[category]' ";
            }
        }

        /* #####################################################################################################################################################
         *
         *  게시판
         *
         ##################################################################################################################################################### */

        if($TREE_NO=="") $TREE_NO = $_GET['TREE_NO'];
        if($DEPTH=="") $DEPTH = $_GET['DEPTH'];
        // 게시판 - 목록
        if($bbs=="list") {

          //echo "o";

            //@session_unregister("_BBS_DELETE_CONN") or die("session_unregister err");
            //$_SESSION["_BBS_DELETE_CONN"] = $value;

            $dataArr=Decode64($data);
            $pagecnt=$dataArr[pagecnt];
            $letter_no=$dataArr[letter_no];
            $offset=$dataArr[offset];

            if(!$searchstring){ //검색
                $search=$dataArr[search];
                $searchstring=$dataArr[searchstring];
            }

            if($dataArr['urlgubun'] == "ko"){
              $searchstring = rawurldecode($searchstring);
            }

            $searchstring =  preg_replace("(\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-)","",$searchstring);

            if($searchstring) $numresults=DBquery("SELECT idx FROM ".$configBBS[board_id]." WHERE idx > 0 AND DEL_YN='N' ".$Code_Que." AND $search LIKE '%$searchstring%'"); //검색
            else $numresults=DBquery("SELECT idx FROM ".$configBBS[board_id]." WHERE idx > 0 AND DEL_YN='N' ".$Code_Que." ");

            //총 레코드수
            $numrows=mysql_num_rows($numresults);

            //페이지당 글 수
            $LIMIT = $configBBS[board_listnum];

			//페이징 테스트
			if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
				//$LIMIT = "4";
			}

            //블럭당 페이지 수
            $PAGEBLOCK	= 10;

            //페이지 번호
            if($pagecnt==""){$pagecnt=0;}

            //각 페이지의 시작 글
            if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;}

            //글번호
            if(!$letter_no) $letter_no=$numrows;
            else			$letter_no=$letter_no;

            //전체페이지 수
            $TotalPage = ceil($numrows / $LIMIT);

            //현재페이지
            $NowPage = ($offset/$LIMIT)+1;

            // 게시판 통합시, 날짜 우선 정렬
            if ( $bbsCode_flags ) $add_orderSql = " writeday DESC, ";
            else if ( $BoardKey=="2620" || $BoardKey=='2621'|| $BoardKey=='2624'|| $BoardKey=='1315') $add_orderSql = " writeday DESC, ";
            else $add_orderSql = "";

            // 공지사항 > 입찰정보 > 전체 리스트에서 제외 By.Son 2021.01.26
            //if ( $BoardKey == "2610" && empty($_REQUEST['category']) && $_REQUEST['category'] != "입찰정보" ) {
            //    $Code_Que .= " and category <> '입찰정보' ";
           // }

			// 쿼리 추가 : 공지사항 작성시 일반 게시물에서 나오지 않도록 처리 23.06.01 KDG
			//if($BoardKey=="1010") {
				$and_query = "and ((notice = 'Y' and DATE_FORMAT(now(),'%Y%m%d') < DATE_FORMAT(notice_start,'%Y%m%d')) or (notice = 'Y' and DATE_FORMAT(now(),'%Y%m%d') > DATE_FORMAT(notice_end,'%Y%m%d')) or ( notice <> 'Y' AND ( notice_start is null or notice_end is null or notice_start ='' or notice_end='') ) ) ";
			//}

            //검색시 리스트쿼리
            if($searchstring){
                $bbs_qry = "SELECT TB.*,
                                (SELECT COUNT( idx ) FROM ".$configBBS[board_id]."_comment WHERE bbs_idx=TB.idx AND del_yn='N') comment_cnt
                                FROM (
                                SELECT A.*, 'Y' as top_yn
                                FROM ".$configBBS[board_id]." A
                                WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%' AND del_yn='N' AND notice='Y'
                                AND ( ( notice='Y' AND now() BETWEEN DATE(CONCAT(notice_start, ' 00:00:00')) AND DATE(CONCAT(notice_end, ' 23:59:59')) ) or ( notice='Y' AND ( notice_start is null or notice_end is null  or notice_start ='' or notice_end='') ) )
                                UNION ALL
                                SELECT A.*, 'N' as top_yn
                                FROM ".$configBBS[board_id]." A
                                WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%' AND del_yn='N' ".$and_query."
                                )TB
                                ORDER BY  ".$add_orderSql."top_yn DESC, ref DESC, re_step ASC, writeday DESC LIMIT $offset,$LIMIT";

				//$bbs_qry = "SELECT ";
                //$bbs_qry .= " * ";
                //$bbs_qry .= " FROM ".$configBBS[board_id]." A WHERE  del_yn='N'  AND idx > 0 ".$Code_Que."  AND $search LIKE '%$searchstring%' ";
                //$bbs_qry.= " ORDER BY writeday DESC, ref DESC, re_step ASC LIMIT $offset, $LIMIT"; // notice DESC 추가

            }else{
                // 쿼리 수정 :: 공지사항에 체크를 하고 기간설정하지 않은 것도 게시글 포함 By.Son 2021.01.29
				if($configBBS['board_key']=="2610"){
					$bbs_qry = "SELECT TB.*,
									(SELECT COUNT( idx ) FROM ".$configBBS[board_id]."_comment WHERE bbs_idx=TB.idx AND del_yn='N') comment_cnt
									FROM (
									SELECT A.*, 'Y' as top_yn
									FROM ".$configBBS[board_id]." A
									WHERE idx > 0 ".$Code_Que." AND del_yn='N' AND notice='Y'
									AND ( ( notice='Y' AND now() BETWEEN DATE(CONCAT(notice_start, ' 00:00:00')) AND DATE(CONCAT(notice_end, ' 23:59:59')) ) or ( notice='Y' AND ( notice_start is null or notice_end is null or notice_start ='' or notice_end='') ) )


									UNION ALL
									SELECT A.*, 'N' as top_yn
									FROM ".$configBBS[board_id]." A
									WHERE idx > 0 ".$Code_Que." AND del_yn='N' ".$and_query."
									)TB
									ORDER BY  ".$add_orderSql."top_yn DESC, writeday DESC LIMIT $offset,$LIMIT";

				}else{
					$bbs_qry = "SELECT TB.*,
									(SELECT COUNT( idx ) FROM ".$configBBS[board_id]."_comment WHERE bbs_idx=TB.idx AND del_yn='N') comment_cnt
									FROM (
									SELECT A.*, 'Y' as top_yn
									FROM ".$configBBS[board_id]." A
									WHERE idx > 0 ".$Code_Que." AND del_yn='N' AND notice='Y'
									AND ( ( notice='Y' AND now() BETWEEN DATE(CONCAT(notice_start, ' 00:00:00')) AND DATE(CONCAT(notice_end, ' 23:59:59')) ) or ( notice='Y' AND ( notice_start is null or notice_end is null  or notice_start ='' or notice_end='') ) )
									UNION ALL
									SELECT A.*, 'N' as top_yn
									FROM ".$configBBS[board_id]." A
									WHERE idx > 0 ".$Code_Que." AND del_yn='N' ".$and_query."
									)TB
									ORDER BY  ".$add_orderSql."top_yn DESC, ref DESC, re_step ASC, writeday DESC LIMIT $offset,$LIMIT";

				}
            }
			if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
				//echo $bbs_qry;
            }

            //권한 테스트용
            if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
                //echo $bbs_qry;
                //echo "SecAdmin==".$SecAdmin."<br>";
                //echo "bbs_authgroup==".$bbs_authgroup."<br>";
                //echo "configBBS[auth_write]==".$configBBS[auth_write]."<br>";
                //echo @strpos(",".$configBBS[auth_write], $bbs_authgroup);
                //echo $bbs_qry;
				//print_R($configBBS);
            }

            //글쓰기 권한제어
            //if($SecAdmin != 1 && $configBBS[auth_write_use]=="Y" && $configBBS[auth_write] && @strpos($configBBS[auth_write], $bbs_authgroup) == false){
            if( $SecAdmin != 1 && (($configBBS[auth_write_use]=="Y" && $bbs_authgroup=="" ) || ($configBBS[auth_write_use]=="Y" && $bbs_authgroup!=="" && strpos($configBBS[auth_write], $bbs_authgroup) === false))){
                $_BBS_Written = "";

            }else{
                //글쓰기 링크
                $encode_data = "Sub_No=$Sub_No&Boardkey=$BoardKey&DBTable=$configBBS[board_id]";
                $data    = Encode64($encode_data);
                $_BBS_Written	=	"$PHP_SELF?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=compose&data=$data";
				//$_BBS_Written	=	"https://".$_SERVER["HTTP_HOST"].$PHP_SELF."?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=compose&data=$data";
            }


            // 검색시, 비밀글 스크립트 추가
            echo "
                  <script>
                  function searchSendit() {
                  	var form=document.searchForm;
                  	if(form.searchstring.value==\"\"){
                  		alert(\"검색 내용을 입력해 주십시오.\");
                  		form.searchstring.focus();
                  		return false;
                  	}else{
                  		return true;
                  	}
                  }
                  function chk_password() {
                  	var form=document.pwdForm;
					if(form.pwd.value == ''){
						alert('비밀번호를 입력해 주십시오.');
						form.pwd.focus();
					}else{
						form.action='/adframe/bbs/module_pw.php?data='+form.data.value+'&BURL=$PHP_SELF&secret=ok';
						form.submit();
					}
                  }
                  </script>
		    ";
				mysql_close($adb);
        }
        // 게시판 - 글 작성
        elseif($bbs=="compose") {
            $dataArr=Decode64($data);
            $_BBS_WRITE_CONN = $_SESSION["_BBS_WRITE_CONN"] = $BoardKey;
            //관리세션 굽기
            if($SecAdmin == 1){
                $_BBS_SecAdmin = $_SESSION["_BBS_SecAdmin"] = $SecAdmin;
            }
            if(!empty($dataArr[idx])) {
                $bbs_qry="SELECT * FROM ".$configBBS[board_id]." WHERE idx=$dataArr[idx]";
                $bbs_result=@DBquery($bbs_qry);
                $bbs_row=@mysql_fetch_array($bbs_result);
            }

            //답글 권한제어
            if($bbs_row[idx]) {
                if( $SecAdmin != 1 && (($configBBS[auth_reply_use]=="Y" && $bbs_authgroup=="" ) || ($configBBS[auth_reply_use]=="Y" && $bbs_authgroup!=="" && strpos($configBBS[auth_reply], $bbs_authgroup) === false))){
                //if($SecAdmin != 1 && $configBBS[auth_reply_use] == "Y" && $configBBS[auth_reply] && @strpos($configBBS[auth_reply], $bbs_authgroup) == false){
                    go_back("답글쓰기 권한이 없습니다.");
                    exit;
                }
            //글쓰기 권한제어
            }else{
                 if( $SecAdmin != 1 && (($configBBS[auth_write_use]=="Y" && $bbs_authgroup=="" ) || ($configBBS[auth_write_use]=="Y" && $bbs_authgroup!=="" && strpos($configBBS[auth_write], $bbs_authgroup) === false))){
                //if($SecAdmin != 1 && $configBBS[auth_write_use] == "Y" && $configBBS[auth_write] && @strpos($configBBS[auth_write], $bbs_authgroup) == false){
                    go_back("글쓰기 권한이 없습니다.");
                    exit;
                }
            }

            //등록시 체크구문 배열로 생성
            $checkcolumn = explode(",",$configBBS[board_checkcolumn]);
            $checktitle = explode(",",$configBBS[board_checktitle]);

            // 등록시 스크립트 추가
            echo "
            <script>
                function bbsSendit(){
                    var form=document.writeform;
                    $ScrpitBodyCheck
			";

            for($i=0; $i < count($checkcolumn); $i++){
                $input_column = "fm_".trim($checkcolumn[$i]);
                $input_title = trim($checktitle[$i]);
                if($i == 0)	$checkaddcon = "";
                else		$checkaddcon = "else ";
                if($checkcolumn[$i] == "content" && $configBBS[module_editor]!="None.php"){
                    echo $checkaddcon."if(content==\"\"){
		       			alert(\"".$input_title."을(를) 입력해 주십시오.\");
		       			if (oEditors != undefined) {
		       				oEditors[0].exec(\"FOCUS\",[]);
		       			} else {
		       				edt.focus();
		       			}
		       			//form.$input_column.focus();
					}
    				";
                }else{
                    echo $checkaddcon."if(form.$input_column.value==\"\"){
		       			alert(\"".$input_title."을(를) 입력해 주십시오.\");
		       			form.$input_column.focus();
					}
	    			";
                }
            }
            echo "
		       else{
					content = content.replace(/\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-/g,\"\");
				";


            echo "
		        	".$ScrpitUploadCheck."
		        }
           }
           </script>
           ";
		mysql_close($adb);
        }
        // 게시판 - 상세보기
        elseif($bbs=="see") {
            //내용보기 권한제어
            if( $SecAdmin != 1 && (($configBBS[auth_read_use]=="Y" && $bbs_authgroup=="" ) || ($configBBS[auth_read_use]=="Y" && $bbs_authgroup!=="" && strpos($configBBS[auth_read], $bbs_authgroup) === false))){
            //if($SecAdmin != 1 && $configBBS[auth_read_use] == "Y" && $configBBS[auth_read] && @strpos($configBBS[auth_read], $bbs_authgroup) == false){
                go_back("내용보기 권한이 없습니다.");
                exit;
            }
            $dataArr = Decode64($data);
            $_BBS_DELETE_CONN = $_SESSION["_BBS_DELETE_CONN"] = $dataArr[idx];
            $check=DBarray("SELECT COUNT(*) FROM ".$configBBS[board_id]." WHERE idx='".$dataArr[idx]."'");

            if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
              //print_r($dataArr);
              //echo "SELECT COUNT(*) FROM ".$configBBS[board_id]." WHERE idx='".$dataArr[idx]."'";
              //echo $check[0];
              //exit;
            }


            if($check[0]<1) go_back("게시물이 존재하지 않습니다.");

            $view_row = DBarray("SELECT * FROM ".$configBBS[board_id]." WHERE idx='".$dataArr[idx]."'"); //게시판 정보

            //2016-08-16
            if($_SESSION[_BBS_PASS_LOGIN]!=$view_row[pwd] && $view_row[view_secret] == "Y" && $SecAdmin != 1) go_back("\\n 비밀글입니다. \\n");

            // count overlapping check
            if($_SESSION[_BBS_COUNT_VIEW] != $view_row[idx]) {
                $_SESSION["_BBS_COUNT_VIEW"] = $view_row[idx];
                @DBquery("update ".$configBBS[board_id]." set readnum=readnum+1 where idx=$dataArr[idx]");
                $readnum = $view_row[readnum]+1;
            }else{
                $readnum = $view_row[readnum];
            }

            if($configBBS[module_editor] == "None.php" || $configBBS[module_editor] == ""){
               $content = str_replace("\n","<br>", $view_row[content]);
             }else{
                $content = $view_row[content];

					$regex    = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';
					$regex    = "~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~";
					$regex    = '~https?://\S+?(?:png|gif|jpe?g)~';

					preg_match($regex, $content, $matches);


					preg_match_all("/<img[^>]*alt=[']?([^>']+)[']?[^>]*>/", $content, $altArr);

					for($j=0; $j<count($matches);$j++){
						$src = $matches[$j];
						$srcNew = $src."\"";

						$alt = $altArr[$j];

						if(!$alt[0]){
							$file_text = $srcNew."alt=\"".$view_row['title']."의 본문".$j."\"";
							$content = str_replace($src,$file_text,$content);
						}
					}

            }


            $writeday = explode("-",substr($view_row[writeday],0,11));
            $bbs_name = $view_row[name];

            $up_file_count = $view_row[up_file];
            $up_file_idx = $view_row[up_file_idx];

            //첨부파일이 있을때
            if($up_file_count > 0){
                $filev = 0;
                $file_result = DBquery("SELECT * FROM ".$configBBS[board_id]."_file WHERE up_file_idx='".$up_file_idx."' order by idx ");
                while($file_row=mysql_fetch_array($file_result)){
                    //일반 첨부파일 일 경우
                    if ($file_row[up_filepath] && $file_row[file_type] < 10){
                        $encode_str = "Boardkey=".$BoardKey."&DBTable=".$configBBS[board_id]."&idx=".$file_row[idx]."&download=ok";
                        $down_data=Encode64($encode_str);
                        $upfile_link[$filev] .=  "<a href='/adframe/bbs/download.php?data=".$down_data."' class='add-file'>".$file_row[up_filename]."</a> ";
						$upfile_name[$filev] .= $file_row['up_filename'];
						$upfile_path[$filev] .= $file_row['up_filepath'];

						$upfile_imgview2[$filev] .= "<img src='/data/bbs_upload/{$file_row[up_filepath]}' alt='{$file_text}'>";
                        $filev = $filev+1;
                        if($configBBS[module_editor] == "smartEditor.php"){
							if ( file_exists(BBS_FILE_PATH."/".$file_row[up_filepath]) ) {
								$tmpimg = @getimagesize(BBS_FILE_PATH."/".$file_row[up_filepath]);
								if ( $tmpimg[2] > 0 && $tmpimg[2] < 4 ) {
									if($file_row['file_text']){
										$file_text = $file_row['file_text'];
									}else{
										$file_text = $view_row['title']."의 ".$filev."";
									}
									$upfile_imgview .= "<div id='bbs_imageview' style='text-align: center;'> <img src='".BBS_LOAD_PATH."/".$file_row[up_filepath]."' onload=sizeModify(this); alt='".$file_text."'> </div> ";
								}
							}
                        }else{
                            if(!file_exists(BBS_FILE_PATH."/".$file_row[up_filepath]))	{
                                // go_back("파일이 존재하지 않습니다.");
                            }else{
                                $tmpimg = @getimagesize(BBS_FILE_PATH."/".$file_row[up_filepath]);
                                if($tmpimg[2] > 0 && $tmpimg[2] < 4) {
                                    $upfile_imgview .= "<div id='bbs_imageview' style='text-align:center;'><img src='/data/bbs_upload/{$file_row[up_filepath]}' onload=sizeModify(this);></div>";
                                } else if ($tmpimg[2] > 0 && $tmpimg[2] < 4 && $configBBS[board_skin] == 'sanhak') {
									$upfile_imgview .= "/data/bbs_upload/{$file_row[up_filepath]}";
								}
                            }
                        }
                    }
                    /*
                    //UCC일 경우
                    if($file_row[up_filepath] && $file_row[file_type] == 10) {
                        $upfile_uccview .= "<embed src='http://www.iuk.ac.kr/bbs/Extention/Uploader/MakeUCC/makeucc.swf' quality='high' wmode='transparent' devicefont='true' bgcolor='#ffffff' width='600' height='400' id='bbsucc_".time()."' name='bbsucc_".time()."' align='middle' allowScriptAccess='always' allowfullscreen='true' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' ";
                        $upfile_uccview .= " flashvars='ComURL=http://www.iuk.ac.kr/bbs/Extention/Uploader/MakeUCC/&ComSrv_ID=iuk&MovieID=".$file_row[idx]."&playicon=null&WatermarkURL=null&BannerURL=null&ComSrv_AdText=null&ViewerParam1=".$configBBS[board_id]."&ViewerParam2=' /> ";
                    }
                    */
                }
                //글보기에서 이미지사용
                // 상세보기 페이지 내 첨부파일 이미지 보기 사용여부 확인 ( 2017-01-21 By.Son )
                if ( $configBBS[board_viewimg] == 'Y' ) $content = $upfile_uccview.$upfile_imgview.$content;
            }
            //다운로드 권한제어
            if( $SecAdmin != 1 && (($configBBS[auth_download_use]=="Y" && $bbs_authgroup=="" ) || ($configBBS[auth_download_use]=="Y" && $bbs_authgroup!=="" && strpos($configBBS[auth_download], $bbs_authgroup) === false))){
                $upfile_view = "<span style='font-size:11px; color:#BBBBBB;'>다운로드 권한이 없습니다.</span>";
            }else{
                if($filev > 0){
                    $upfile_view = "<div onclick=\"DisplayDetail('div_filedown',1)\" style='cursor:hand'>";
                    $upfile_view .= "<span style='font-size:11px; color:#8c8b8b;'>첨부파일</span><span style='font-size:11px; color:#005D79;'>(".$up_file_count.")</span>";
                    $upfile_view .= " <img src='/bbs/skin/".$configBBS[board_skin]."/images/filedown.gif' align='absmiddle'>";
                    $upfile_view .= "</div>";
                }else{
                    $upfile_view = "<span style='font-size:11px; color:#BBBBBB;'>첨부파일이 없습니다.</span>";
                }
            }

            //코멘트 권한제어
            if( $SecAdmin != 1 && (($configBBS[auth_comment_use]=="Y" && $bbs_authgroup=="" ) || ($configBBS[auth_comment_use]=="Y" && $bbs_authgroup!=="" && strpos($configBBS[auth_comment], $bbs_authgroup) === false))){
                $_BBS_commented = "";
            }else{
                $_BBS_commented = "OK";
            }

            //글쓰기 권한제어
            if( $SecAdmin != 1 && (($configBBS[auth_write_use]=="Y" && $bbs_authgroup=="" ) || ($configBBS[auth_write_use]=="Y" && $bbs_authgroup!=="" && strpos($configBBS[auth_write], $bbs_authgroup) === false))){
            //if($SecAdmin != 1 && $configBBS[auth_write_use] == "Y" && $configBBS[auth_write] && @strpos($configBBS[auth_write], $bbs_authgroup) == false){
                $_BBS_Written = "";
                $_BBS_Modified = "";
                $_BBS_Deleted = "";
                $_BBS_Password = "";
            }else{
                //보기에서 글쓰기 링크
                $wencode_data = "Boardkey=$dataArr[Boardkey]&Sub_No=$dataArr[Sub_No]&DBTable=$dataArr[DBTable]";
                $wdata    = Encode64($wencode_data);
                $_BBS_Modified = "javascript:call_bbsEdit();";
                $_BBS_Deleted = "javascript:call_bbsDel();";

                //패스워드 자동표시 여부
                if($SecAdmin == 1){
                    $_BBS_Password = "<input type='hidden' name='pwd' value='".$view_row[pwd]."'>";
                }else if($view_row[userid] != "" && $view_row[userid] == $bbs_userid){
                    $_BBS_Password = "<input type='hidden' name='pwd' value='".$view_row[pwd]."'>";
                }else{
                    $_BBS_Password = "<input type='hidden' name='pwd'>";
                }
            }
            //답변쓰기 권한제어
            if( $SecAdmin != 1 && (($configBBS[auth_reply_use]=="Y" && $bbs_authgroup=="" ) || ($configBBS[auth_reply_use]=="Y" && $bbs_authgroup!=="" && strpos($configBBS[auth_reply], $bbs_authgroup) === false))){
            //if($SecAdmin != 1 && $configBBS[auth_reply_use] == "Y" && $configBBS[auth_reply] && @strpos($configBBS[auth_reply], $bbs_authgroup) == false){
                $_BBS_Replied = "";
            }else{
                $_BBS_Replied	=	"$PHP_SELF?";
                if($view_row[category]){
                    $_BBS_Replied .= "&cat=$view_row[category]";
                }
                $_BBS_Replied	.=	"&site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=compose&data=$data";
            }
            // 비밀글 글수정 제어
            if(($view_row[userid] && $_SESSION[MEMBER_ID]==$view_row[userid]) || $_SESSION[_BBS_PASS_LOGIN] == $view_row[pwd] || $SecAdmin == 1){
                $permEdit = 1;
            }else{
                $permEdit = 0;
            }

            $list_link = "$PHP_SELF?bbs=list&data=$data"; //목록링크

            $action = "/adframe/bbs/module_pw.php?";

            if(!empty($dataArr[idx])) {
                $bbs_qry="SELECT * FROM ".$configBBS[board_id]." WHERE idx=$dataArr[idx]";
                $bbs_result=@DBquery($bbs_qry);
                $bbs_row=@mysql_fetch_array($bbs_result);
            }

            //이전글 가져오기
            $PrevSql = "SELECT idx,title FROM ".$configBBS[board_id]." WHERE IDX < $view_row[idx] $Code_Que AND del_yn='N' ORDER BY IDX DESC LIMIT 0, 1";
            $Prev = DBarray($PrevSql);

            //다음글 가져오기
            $NextSql = "SELECT idx,title FROM ".$configBBS[board_id]." WHERE IDX > $view_row[idx] $Code_Que AND del_yn='N' ORDER BY IDX ASC LIMIT 0, 1";
            $Next = DBarray($NextSql);

            // 스크립트 추가
            echo "
              <script>
              function bbsEdit() {
              	var form=document.pwdForm;
				if(form.pwd.value==\"\" && $permEdit != 1){
					alert('권한이 없습니다.');
              		form.pwd.focus();
              	}else{
                  ";
                    if($SecAdmin==0) echo "
                    form.site_id.value = '".TREE_ID."';
                    form.TREE_NO.value = '$TREE_NO';
                    form.data.value = '$data';";

                   echo "
					//var action = \"".$action."site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&edit=ok&data=$data&BURL=$PHP_SELF\";
					var action = \"".$action."edit=ok&data=$data&BURL=$PHP_SELF\";
              		form.action=action;
              		form.submit();
              	}
              }
              function bbsDel() {
              	var form=document.pwdForm;
              	if(form.pwd.value==\"\" && $SecAdmin != 1){
					alert('권한이 없습니다.');
              		form.pwd.focus();
              	}else{";
                    if($SecAdmin==0) echo "
              	    form.site_id.value = '".TREE_ID."';
                    form.TREE_NO.value = '$TREE_NO';
                    form.data.value = '$data';
                    ";
                    echo "
					var action = \"".$action."del=ok&data=$data&BURL=$PHP_SELF\";
              		form.action=action;
              		form.submit();
              	}
              }

              </SCRIPT>
              ";
							mysql_close($adb);
        }
        // 게시판 - 수정
        elseif($bbs=="repair") {

            $dataArr=Decode64($data);

//	        @session_unregister("_BBS_DELETE_CONN") or die("session_unregister err");
//	        @session_register("_BBS_WRITE_CONN") or die("session_register err");

            unset($_SESSION["_BBS_DELETE_CONN"]);
            $_BBS_WRITE_CONN = $_SESSION["_BBS_WRITE_CONN"] = $dataArr[idx];

            if($dataArr[idx]) {
                $bbs_row = DBarray("SELECT * FROM ".$configBBS[board_id]." WHERE idx='".$dataArr[idx]."'");

                if($_SESSION[_BBS_PASS_LOGIN]!=$bbs_row[pwd]) go_back("\\n 잘못된 접근입니다. \\n");
            }else{
                go_back("\\n 잘못된 접근입니다. \\n");
            }

            $up_file_count = $bbs_row[up_file];
            $up_file_idx = $bbs_row[up_file_idx];


            //등록시 체크구문 배열로 생성
            $checkcolumn = explode(",",$configBBS[board_checkcolumn]);
            $checktitle = explode(",",$configBBS[board_checktitle]);

            // 등록시 스크립트 추가
            echo "
			<script type='text/javascript'>

				function bbsSendit()
				{
				//alert(\"아래\");
				var form=document.writeform;
				".$ScrpitBodyCheck."
			";

            for($i=0; $i < count($checkcolumn); $i++){

                $input_column = "fm_".trim($checkcolumn[$i]);
                $input_title = trim($checktitle[$i]);

                if($i == 0)	$checkaddcon = "";
                else		$checkaddcon = "else ";

                if($checkcolumn[$i] == "content"){
                    echo $checkaddcon."if(content==\"\"){
			       			alert(\"".$input_title."을(를) 입력해 주십시오.\");
			       			edt.focus();
						}
					";
                }else{
                    echo $checkaddcon."if(form.$input_column.value==\"\"){
			       			alert(\"".$input_title."을(를) 입력해 주십시오.\");
			       			form.$input_column.focus();
						}
					";
                }
            }
            echo "
			       else{
					   content = content.replace(/\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-/g,\"\");

					 ";

            // 개인정보 보호를 위한 스크립트 추가 (수정)
            // 비밀글 체크 여부 확인 후 ( 비밀글인 경우, 해당내용을 확인하지 않음 )
            // 추가 2016-12-02 By.Son
            if ( $configBBS[board_secure] == 'Y' ) {
                echo "
					var flag_secret_chk = document.getElementById('view_secret').checked;
					if ( !flag_secret_chk ) {
						var regExp_phone1 = /01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})/;
						var regExp_phone2 = /01([0|1|6|7|8|9]?)?([0-9]{3,4})?([0-9]{4})/;
						var regExp_identity = /[0-9]{2}(0[1-9]|1[012])(0[1-9]|1[0-9]|2[0-9]|3[01])-?[012349][0-9]{6}/;

						if ( regExp_phone1.test(content) || regExp_phone2.test(content) || regExp_identity.test(content) ) {
							alert('본문 안에 저장될 수 없는 개인정보가 포함되어 있습니다. \\n다시 확인해주시기 바랍니다.');
							return false;
						}
					}
					";
            }
            echo "
			        	".$ScrpitUploadCheckModify."
			        }
	       }
	       </SCRIPT>
	       ";
mysql_close($adb);
        } else {

            //$bbs 액션이 없는경우

        }



        if($configBBS[board_topinclude] && $is_site_type!="admin") include $_SERVER["DOCUMENT_ROOT"].$configBBS[board_topinclude];	//상단 인클루드


        switch($bbs){

            case 'list' :

                //echo $configBBS[board_skin];
                    //리스트 권한제어
                if( $SecAdmin != 1 && (($configBBS[auth_list_use]=="Y" && $bbs_authgroup=="" ) || ($configBBS[auth_list_use]=="Y" && $bbs_authgroup!=="" && strpos($configBBS[auth_list], $bbs_authgroup) === false))){

                    echo "리스트 보기 권한이 없습니다.";

                }else{
                    include ADFRAME_ROOT_PATH."/bbs/skin/".$configBBS[board_skin]."/list.php";
                }

                break;

            case 'see' :
                include ADFRAME_ROOT_PATH."/bbs/skin/".$configBBS[board_skin]."/view.php";

                if($configBBS[board_commentuse] == "Y" ){
                    include ADFRAME_ROOT_PATH."/bbs/skin/".$configBBS[board_skin]."/comment.php";
                }

                if($configBBS[board_listview] == "Y"){

                    $dataArr=Decode64($data);
                    $pagecnt=$dataArr[pagecnt];
                    $letter_no=$dataArr[letter_no];
                    $offset=$dataArr[offset];

                    if(!$searchstring){ //검색
                        $search=$dataArr[search];
                        $searchstring=$dataArr[searchstring];
                    }

                    if($searchstring) $numresults=DBquery("SELECT idx FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%'"); //검색
                    else $numresults=DBquery("SELECT idx FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." ");


                    //총 레코드수
                    $numrows=mysql_num_rows($numresults);

                    //페이지당 글 수
                    $LIMIT = $configBBS[board_listnum];

                    //블럭당 페이지 수
                    $PAGEBLOCK	= 10;

                    //페이지 번호
                    if($pagecnt==""){$pagecnt=0;}

                    //각 페이지의 시작 글
                    if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;}

                    //글번호
                    if(!$letter_no) $letter_no=$numrows;
                    else			$letter_no=$letter_no;

                    //전체페이지 수
                    $TotalPage = ceil($numrows / $LIMIT);

                    //현재페이지
                    $NowPage = ($offset/$LIMIT)+1;

                    //검색시 리스트쿼리
                    if($searchstring){
                        $bbs_qry = "SELECT * FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%' ";
                        $bbs_qry.= " ORDER BY ref DESC,re_step ASC LIMIT $offset,$LIMIT";
                    }else{
                        $bbs_qry = "SELECT * FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." ORDER BY notice ASC, ref DESC,re_step ASC LIMIT $offset,$LIMIT";
                    }


                    $encode_data = "Sub_No=$Sub_No&Boardkey=$BoardKey&DBTable=$configBBS[board_id]";
                    $data    = Encode64($encode_data);

                    //글쓰기 버튼
                    $_BBS_Written	=	"$PHP_SELF?bbs=compose&data=$data";
                    include ADFRAME_ROOT_PATH."/bbs/skin/".$configBBS[board_skin]."/list.php";

                }
                break;

            //case 'compose' : include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/write.php"; break;
            case 'compose' : include ADFRAME_ROOT_PATH."/bbs/skin/".$configBBS[board_skin]."/write.php"; break;

            //case 'repair' : include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/edit.php"; break;
            case 'repair' : include ADFRAME_ROOT_PATH."/bbs/skin/".$configBBS[board_skin]."/edit.php"; break;

        }
        if($configBBS[board_bottominclude] && $is_site_type!="admin") include $_SERVER["DOCUMENT_ROOT"].$configBBS[board_bottominclude];	//하단 인클루드

    }



}





// 페이지 컷◀ 1 [2][3][4][5] ▶
class BList
{
    var $g_pageName;		//설정파일명 ex) ****.php, OOOO.php

    var $g_pageCnt;			//현재페이지 번호
    var $g_offset;			//데이타베이스 시작 포인트 번호
    var $g_numRows;			//총게시물 수
    var $g_pageBlock;		//블럭당 페이지 수 ex) 5 : [1][2][3][4][5]
    var $g_limit;			//페이지당 출력 게시물 수
    var $g_search;			//검색 컬럼 ex)name,title,...
    var $g_searchstring;	//검색어

    var $g_option;			//추가 get 값  ex) &getdata=$getdata

    var $g_pniView;			//링크되지 않은 아이콘 표시 여부 ex) true,1 : 표시  false,0 : 미표시
    var $g_pIcon;			//이전 아이콘
    var $g_nIcon;			//다음 아이콘

    //
    // 생성자
    // BList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
    // BList(페이지명, 현재페이지번호, DB시작offset, 총게시물수, 블럭당페이지수, 페이지당게시물수, 검색컬럼, 검색어, 추가get값)
    //
    function BList($pagename,$pagecnt,$offset,$numrows,$pageblock,$limit,$search,$searchstring,$option){

        $this->g_pageName		= $pagename;
        $this->g_pageCnt		= $pagecnt;
        $this->g_offset			= $offset;
        $this->g_numRows		= $numrows;
        $this->g_pageBlock		= $pageblock;
        $this->g_limit			= $limit;
        $this->g_search			= $search;
        $this->g_searchstring	= $searchstring;
        $this->g_option			= $option;
    }
    //
    // 아이콘 설정
    // putList( BOOL pniView, char* pre_icon, char* next_icon)
    // putList( 링크되지 않은 아이콘 표시 여부, 이전아이콘, 다음아이콘, 처음, 마지막, 한칸이전, 한칸다음
    //
    function putList($pniView,$pre_icon,$next_icon,$first_icon,$last_icon,$pre1_icon,$next1_icon){
        $this->g_pniView=$pniView;					//링크되지 않은 아이콘 표시 여부
        if(empty($pre_icon))	$this->g_pIcon="<<";			//이전 아이콘 설정
        else					$this->g_pIcon=$pre_icon;

        if(empty($next_icon))	$this->g_nIcon=">>";			//다음 아이콘 설정
        else					$this->g_nIcon=$next_icon;

        if(empty($first_icon))	$this->g_fIcon="처음으로";		//처음 아이콘 설정
        else					$this->g_fIcon=$first_icon;

        if(empty($last_icon))	$this->g_lIcon="마지막으로";	//마지막 아이콘 설정
        else					$this->g_lIcon=$last_icon;


        if(empty($pre1_icon))	$this->g_p1Icon="<";			//한칸이전 아이콘 설정
        else					$this->g_p1Icon=$pre1_icon;

        if(empty($next1_icon))	$this->g_n1Icon=">";			//한칸다음 아이콘 설정
        else					$this->g_n1Icon=$next1_icon;

        $this->pniPrint(); //화면 출력
    }


    //
    // 화면 출력
    //
    function pniPrint(){
        global $category;

        $chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //현제페이지 체크

        if($chekpage==$this->g_pageCnt){  //마지막 블럭일 경우....
            $pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //마지막 블럭 페이지수 계산
            if(!($this->g_numRows%($this->g_limit))){
                $pCnt--;
            }
        }else{
            $pCnt=$this->g_pageBlock;
        }


        $onstepcheck = ($this->g_offset/$this->g_limit)-($this->g_pageBlock*$this->g_pageCnt);

        $lastpagecnt = ceil(($this->g_numRows / $this->g_limit / $this->g_pageBlock)-1);
        $lastt = ceil($this->g_numRows / $this->g_limit);
        $lastoffset = ($lastt*$this->g_limit)-$this->g_limit;
        $lastletter_no=$this->g_numRows-(($lastt-1)*$this->g_limit);


        /*   처음   */
        $data=Encode64("search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);
        echo "<a href=".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option.">".$this->g_fIcon."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";



        /*    이전   */
        if($this->g_pageCnt>0){				//이전페이지 있음
            $prepage=$this->g_pageCnt-1;	//이전블럭 시작페이지 설정.
            $pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//이전블럭 시작글 번호 설정
            $data=Encode64("pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);

            $pre_str ="<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$this->g_pIcon."</a>&nbsp;";

            echo "$pre_str"; 	//이전아이콘 링크
        }else{					//이전페이지 없음
            if($this->g_pniView)//아이콘 표시
                $empty_pre_str = $this->g_pIcon."&nbsp;";
            //$empty_pre_str = "&nbsp;";

            else				//아이콘 비표시
                $empty_pre_str = "&nbsp;";

            echo "$empty_pre_str";
        }




        /*    1개 이전   */
        $p1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)-$this->g_limit;
        $p1letter_no=$this->g_numRows-$p1offset;


        if($onstepcheck == 0)	$p1pageCnt = $this->g_pageCnt-1;
        else					$p1pageCnt = $this->g_pageCnt;

        $data=Encode64("offset=".$p1offset."&letter_no=".$p1letter_no."&pagecnt=".$p1pageCnt."search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);
        //echo "offset=".$p1offset."&letter_no=".$p1letter_no."&pagecnt=".$this->g_pageCnt."search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($p1offset >= 0){
            echo "&nbsp;<a href=".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option.">".$this->g_p1Icon."</a>&nbsp;";
        }else{
            echo "&nbsp;".$this->g_p1Icon."&nbsp;";
        }



        /* 1 [2][3][4][5] */
        $l=0;
        while($l<$pCnt){
            $loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//시작글 지정
            $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//페이지 번호 설정
            $cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//시작글 번호 지정
            $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
            $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $data=Encode64($en_str);
            if($lnum==(($this->g_offset/$this->g_limit)+1))	{//현재 페이지 일 경우
                echo " <font size='2'><b>$lnum</b></font> ";
                //echo $en_str;
            }else{
                $mid_str = " [<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$lnum."</a>] ";

                echo"$mid_str";
            }

            //echo $en_str;
            $l++;
        }




        /*    1개 다음   */
        $n1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)+$this->g_limit;
        $n1letter_no=$this->g_numRows+$n1offset;


        if($onstepcheck == 9)	$n1pageCnt = $this->g_pageCnt+1;
        else					$n1pageCnt = $this->g_pageCnt;

        $data=Encode64("offset=".$n1offset."&letter_no=".$n1letter_no."&pagecnt=".$n1pageCnt."search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);

        if($n1offset <= $lastoffset){
            echo "&nbsp;<a href=".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option.">".$this->g_n1Icon."</a>&nbsp;";
        }else{
            echo "&nbsp;".$this->g_n1Icon."&nbsp;";
        }




        /*    다음   */
        if($this->g_pageCnt!=$chekpage){		//다음페이지 있음
            echo "&nbsp;";
            $newpagecnt=$this->g_pageCnt+1;		//다음 블럭 시작페이지 설정
            $newt=$cu_letter_no-$this->g_limit;	//다음 블럭 시작글 번호 설정
            $data=Encode64("pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);
            $next_str="<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$this->g_nIcon."</a>";

            echo $next_str;			//다음 아이콘 링크
        }else{						//다음페이지 없음
            if($this->g_pniView)	//아이콘 표시
                echo"&nbsp;".$this->g_nIcon;
            //echo"&nbsp;";

            else					//아이콘 비표시
                echo"&nbsp;";
        }


        /*   마지막   */
        $data=Encode64("pagecnt=".$lastpagecnt."&letter_no=".$lastletter_no."&offset=".$lastoffset."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);

        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."&".$this->g_option."'>".$this->g_lIcon."</a>";

    }//function putList()
}//class



// 페이지 컷◀ 1 [2][3][4][5] ▶
class CList
{
    var $g_pageName;		//설정파일명 ex) ****.php, OOOO.php

    var $g_pageCnt;			//현재페이지 번호
    var $g_offset;			//데이타베이스 시작 포인트 번호
    var $g_numRows;			//총게시물 수
    var $g_pageBlock;		//블럭당 페이지 수 ex) 5 : [1][2][3][4][5]
    var $g_limit;			//페이지당 출력 게시물 수
    var $g_search;			//검색 컬럼 ex)name,title,...
    var $g_searchstring;	//검색어

    var $g_option;			//추가 get 값  ex) &getdata=$getdata

    var $g_pniView;			//링크되지 않은 아이콘 표시 여부 ex) true,1 : 표시  false,0 : 미표시
    var $g_pIcon;			//이전 아이콘
    var $g_nIcon;			//다음 아이콘

    //
    // 생성자
    // CList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
    // CList(페이지명, 현재페이지번호, DB시작offset, 총게시물수, 블럭당페이지수, 페이지당게시물수, 검색컬럼, 검색어, 추가get값)
    //
    function CList($pagename,$pagecnt,$offset,$numrows,$pageblock,$limit,$search,$searchstring,$option){

        $this->g_pageName		= $pagename;
        $this->g_pageCnt		= $pagecnt;
        $this->g_offset			= $offset;
        $this->g_numRows		= $numrows;
        $this->g_pageBlock		= $pageblock;
        $this->g_limit			= $limit;
        $this->g_search			= $search;
        $this->g_searchstring	= $searchstring;
        $this->g_option			= $option;
    }
    //
    // 아이콘 설정
    // putList( BOOL pniView, char* pre_icon, char* next_icon)
    // putList( 링크되지 않은 아이콘 표시 여부, 이전아이콘, 다음아이콘, 처음, 마지막, 한칸이전, 한칸다음
    //
    function putList($pniView,$pre_icon,$next_icon){
        $this->g_pniView=$pniView;					//링크되지 않은 아이콘 표시 여부
        if(empty($pre_icon))	$this->g_pIcon="<<";			//이전 아이콘 설정
        else					$this->g_pIcon=$pre_icon;

        if(empty($next_icon))	$this->g_nIcon=">>";			//다음 아이콘 설정
        else					$this->g_nIcon=$next_icon;

        $this->pniPrint(); //화면 출력
    }


    //
    // 화면 출력
    //
    function pniPrint(){
        global $category, $TREE_NO, $DEPTH, $site_id;
        $GET_PARAM = "&site_id=".$site_id."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&";

        /*if($mobile_detect == 1){$GET_PARAM .= "app=app&";}*/

        if($_REQUEST[CHILD]){
            $GET_PARAM .= "CHILD=".$_REQUEST[CHILD]."&";
        }

        $chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //현제페이지 체크

        if($chekpage==$this->g_pageCnt){  //마지막 블럭일 경우....
            $pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //마지막 블럭 페이지수 계산
            if(!($this->g_numRows%($this->g_limit))){
                $pCnt--;
            }
        }else{
            $pCnt=$this->g_pageBlock;
        }


        $onstepcheck = ($this->g_offset/$this->g_limit)-($this->g_pageBlock*$this->g_pageCnt);



        /*    이전   */
        if($this->g_pageCnt>0){				//이전페이지 있음
            $prepage=$this->g_pageCnt-1;	//이전블럭 시작페이지 설정.
            $pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//이전블럭 시작글 번호 설정
            $data=Encode64("pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);

            $pre_str ="<a href='".$this->g_pageName."?".$GET_PARAM."data=".$data."&category=".$category."&".$this->g_option."' class='btn-preview'>".$this->g_pIcon."</a>&nbsp;";

            echo "$pre_str"; 	//이전아이콘 링크
        }else{					//이전페이지 없음
            if($this->g_pniView)//아이콘 표시
                //$empty_pre_str = "<a href='javascript:;' class='btn-preview'>".$this->g_pIcon."</a>";
                $empty_pre_str = "&nbsp;";

            else				//아이콘 비표시
                $empty_pre_str = "&nbsp;";

            echo "$empty_pre_str";
        }


        /* 1 [2][3][4][5] */
        $l=0;
        while($l<$pCnt){
            $loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//시작글 지정
            $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//페이지 번호 설정
            $cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//시작글 번호 지정
            $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
            $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $data=Encode64($en_str);
            if($lnum==(($this->g_offset/$this->g_limit)+1))	{//현재 페이지 일 경우
                //echo " <font size='2'><b>$lnum</b></font> ";
                echo "<strong>$lnum</strong>";
                //echo $en_str;
            }else{
                $mid_str = " <a href='".$this->g_pageName."?".$GET_PARAM."data=".$data."&category=".$category."&".$this->g_option."' title='".$lnum."페이지로 이동'>".$lnum."</a> ";
                echo"$mid_str";
            }

            //echo $en_str;
            $l++;
        }


        /*    다음   */
        if($this->g_pageCnt!=$chekpage){		//다음페이지 있음
            //echo "&nbsp;";
            $newpagecnt=$this->g_pageCnt+1;		//다음 블럭 시작페이지 설정
            $newt=$cu_letter_no-$this->g_limit;	//다음 블럭 시작글 번호 설정
            $data=Encode64("pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);
            $next_str="<a href='".$this->g_pageName."?".$GET_PARAM."data=".$data."&category=".$category."&".$this->g_option."' class='btn-next'>".$this->g_nIcon."</a>";
            echo $next_str;			//다음 아이콘 링크

        }else{						//다음페이지 없음
            if($this->g_pniView)	//아이콘 표시
                //echo"<a href='javascript:;' class='btn-next'>".$this->g_nIcon."</a>";
                echo"&nbsp;";

            else					//아이콘 비표시
                echo"&nbsp;";
        }

    }//function putList()
}//class


//게시판에 링크생성
function BBSButtonLink($BLINK, $BSRC, $VIEWOPT="", $STYLE=""){

    // $VIEWOPT 권한이 없을때 $BSRC 내용이 보일건지 여부 1이면 보이기

    if($BLINK){
        $ButtonLink = "<a href=\"".$BLINK."\" class=\"$STYLE\">".$BSRC."</a>";

    }else if(empty($BLINK) && $VIEWOPT == 1){
        $ButtonLink = $BSRC;

    }else{
        $ButtonLink = "";

    }

    echo $ButtonLink;
}
?>
