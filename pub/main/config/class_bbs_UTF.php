<?

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
	
	function makebbs($bbs, $BoardKey, $Sub_No="0", $SecAdmin="0", $bbs_userqry="", $bbs_subqry="", $bbs_subcolumnqry="") {
		//mysql_query("set names utf8");
		global $PHP_SELF, $_SESSION, $data, $search, $searchstring, $major;
		global $UCC_SIZE_WIDTH, $UCC_SIZE_HEIGHT;
		
		$_POST = array_map('mysql_escape_string', $_POST);
		$_GET = array_map('mysql_escape_string', $_GET);

		$this->bbs			= $bbs;
		
		$this->c_BoardKey	= $BoardKey;
		$this->c_Sub_No		= $Sub_No;
		
		$this->c_SecAdmin	= $SecAdmin;
		
		$configBBS = DBarray("SELECT * FROM abbs_manager WHERE board_key='".$BoardKey."'"); //게시판 설정로드
		
		//function makebbs($bbs, $BoardKey, $Sub_No, $DBTable, $bbspart, $Listcount, $SecAdmin, $bbs_userqry="", $bbs_subqry="") {
		
		/*
		$configBBS[board_id];	//디비테이블
		$configBBS[board_name];	//게시판 이름
		
		$configBBS[board_skin];	//게시판스킨
		$configBBS[module_editor];	//게시판 에티터 모듈
		$configBBS[module_uploader]; //게시판 업로드 모듈
		
		$configBBS[board_category]; //카테고리 사용여부
		
		$configBBS[board_commentuse]; //댓글 사용여부
		
		$configBBS[board_listnum]; //페이지당 출력수
		$configBBS[board_listview]; //게시판 보기에서 리스트로딩
		
		$configBBS[board_width]; //게시판 가로폭
		$configBBS[board_titlecut]; //리스트 제목길이
		
		
		$configBBS[board_checkcolumn]; //등록&수정시 필수체크
		$configBBS[board_checktitle]; //등록&수정시 필수체크
		
		$configBBS[board_secure]; //비밀글 작성
		
		
		$configBBS[board_viewimg]; //보기페이지 이미지 자동보기
		$configBBS[board_viewimgwidth]; //보기페이지 이미지가로크기
		
		
		$configBBS[board_upfile]; //업로드 파일갯수
		$configBBS[board_upfilesize]; //업로드 개당 파일사이즈
		
		$configBBS[board_topinclude]; //상단 인크루드
		$configBBS[board_bottominclude]; //하단 인크루드
		*/

		//권한매핑 설정
		include $_SERVER["DOCUMENT_ROOT"]."/bbs/auth_config.php";
		
		//글쓰기시 자동 이름, 패스워드 자동출력
		// $auto_bbs_input 값이 
		// true  일 경우 input이 text타입으로 출력
		// false 일 경우 input이 hidden타입 & $auto_bbs_username출력
		if($SecAdmin == 1){
			
			$auto_bbs_input = "true";
			$auto_bbs_username = $bbs_adminname;
			$auto_bbs_userpwd = time();
					
		}else{
			
			if($bbs_userid){
				$auto_bbs_input = "false";
				$auto_bbs_username = $bbs_username;
				$auto_bbs_userpwd = time();
			}else{
				$auto_bbs_input = "true";
				$auto_bbs_username = "";
				$auto_bbs_userpwd = "";
			}
			
		}
		
		
		
		/*
		$configBBS[auth_admin];	//이 권한이 Y일 경우 공지게시판 (관리자만 글작성이 가능함)
		
		$configBBS[auth_list_use];	//리스트권한 사용여부
		$configBBS[auth_read_use];	//보기권한 사용여부
		$configBBS[auth_write_use];	//쓰기권한 사용여부
		$configBBS[auth_reply_use];	//답글권한 사용여부
		$configBBS[auth_comment_use];	//댓글권한 사용여부
		$configBBS[auth_upload_use];	//업로드권한 사용여부
		$configBBS[auth_download_use];	//다운로드권한 사용여부
		
		
		
		$configBBS[auth_list];	//리스트권한 세션비교값
		$configBBS[auth_read];	//보기권한 세션비교값
		$configBBS[auth_write];	//쓰기권한 세션비교값
		$configBBS[auth_reply];	//답글권한 세션비교값
		$configBBS[auth_comment];	//댓글권한 세션비교값
		$configBBS[auth_upload];	//업로드권한 세션비교값
		$configBBS[auth_download];	//다운로드권한 세션비교값
		*/
		
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
		
		
		//관리자일 경우 상단에 게시판 이름 출력
		if($SecAdmin == 1){
			echo "
				<table border=0 cellpadding=0 cellspacing=0 width=100%>
				 <tr>
				   <td height=50 align=center><strong>[".$configBBS[board_name]."]</strong></td>
				 </tr>
				</table>
			";	
		}
		
		
		
		
		//설치 에디터 설정사항
		if($configBBS[module_editor] == "PureEditer.php"){
			
			$ScrpitBodyCheck = " var content = edt.getHtml(); ";
		
		}else if($configBBS[module_editor] == "NamoWec7.php"){
			
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
		}else if($configBBS[module_editor] == "None.php"){
			
			$ScrpitBodyCheck = " var content = form.fm_content.value; ";
		
		}else{
			$ScrpitBodyCheck = " var content = form.fm_content.value; ";
				
		}
		

		//업로드 설정사항
		if($configBBS[module_uploader] == "InnoAP.php"){
			
			$ScrpitUploadCheck = " if(InnoAPSubmit(form)) form.submit(); ";
			$ScrpitUploadCheckModify = " StartUpload(form); ";
			
		}else if($configBBS[module_uploader] == "MakeUCC.php"){
			
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
		
		//echo $ScrpitUploadCheck;
				
		//게시판 가로크기계산
		if($configBBS[board_width] > 100)	$configBBS[board_width] = $configBBS[board_width]."px";
		else								$configBBS[board_width] = $configBBS[board_width]."%";
		
		
		//카테고리가 있을 경우 변수에 배열로 담기
      	if($configBBS[board_category])	$board_category = explode("|", $configBBS[board_category]);
      	
      	//비밀글이 설정 된 경우
      	if($configBBS[board_secure] != "N")	$board_secure = $configBBS[board_secure];
      	if($board_secure == "E") $board_secure_style = " style='display:none'";
      	
		
		//게시판 액션 변수가 없을때 리스트로
	    if(!$bbs) $bbs = "list";
	    
	    
	    
		// 게시판 Depth 설정여부
		/*
		if(!$Sub_No) $Sub_Que = "";
		else		 $Sub_Que = "Sub_No='$Sub_No' AND ";
		*/		
		if(!$BoardKey && !$Sub_No)		$Code_Que = "";
		else if($BoardKey && !$Sub_No)	$Code_Que = " and code='$BoardKey'";
		else if(!$BoardKey && $Sub_No)	$Code_Que = " and sub_no='$Sub_No'";
		else if($BoardKey && $Sub_No)	$Code_Que = " and code='$BoardKey' and sub_no='$Sub_No'";
		else	$Code_Que = "";
		
		
		//추가쿼리 처리
		if($bbs_userqry)	$Code_Que .= $Code_Que." and userid='$bbs_userqry' and re_step = '0' and re_level = '0' ";
		if($bbs_subqry)		$Code_Que .= $Code_Que." ".$bbs_subqry;
		
		if($bbs_subcolumnqry)	$bbs_subcolumnqry = str_replace("[[BBSDBTABLE]]", $configBBS[board_id], $bbs_subcolumnqry);
		
	if($bbs=="list") {

			@session_unregister("_BBS_DELETE_CONN") or die("session_unregister err");
			
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
          	  $bbs_qry = "SELECT ";
          	  $bbs_qry .= " * ";
          	  $bbs_qry .= $bbs_subcolumnqry;
          	  $bbs_qry .= " FROM ".$configBBS[board_id]." A WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%' ";
          	  $bbs_qry.= " ORDER BY ref DESC,re_step ASC LIMIT $offset,$LIMIT";
            }else{
          	  $bbs_qry = "SELECT * ";
          	  $bbs_qry .= $bbs_subcolumnqry;
          	  $bbs_qry .= " FROM ".$configBBS[board_id]." A WHERE idx > 0 ".$Code_Que." ORDER BY notice ASC, ref DESC,re_step ASC LIMIT $offset,$LIMIT";
            }
			
			//echo "<!--".$bbs_qry."-->";
			
			
			//글스기 권한제어
			if($SecAdmin != 1 && $configBBS[auth_write] && @strpos(",".$configBBS[auth_write], $bbs_authgroup) == false){
				$_BBS_Written = "";
			}else{
				//글쓰기 링크
				$encode_data = "Sub_No=$Sub_No&Boardkey=$BoardKey&DBTable=$configBBS[board_id]";
	  			$data    = Encode64($encode_data);
				$_BBS_Written	=	"$PHP_SELF?bbs=compose&data=$data";	
			}


		   
		   // 검색시 스크립트 추가
		   echo "
                  <SCRIPT Language=\"JavaScript\">
                  
                  function searchSendit()
                  {
                  	var form=document.searchForm;
                  
                  	if(form.searchstring.value==\"\"){
                  		alert(\"검색 내용을 입력해 주십시오.\");
                  		form.searchstring.focus();
                  		return false;
                  	}else{
                  		return true;
                  	}
                  }

                  </SCRIPT>
		    ";


	} elseif($bbs=="compose") {
		
      	$dataArr=Decode64($data);
      	
      	@session_unregister("_BBS_DELETE_CONN") or die("session_unregister err");
      	@session_register("_BBS_WRITE_CONN") or die("session_register err");
	    $_BBS_WRITE_CONN = $_SESSION["_BBS_WRITE_CONN"] = $BoardKey;
	    
	    //관리세션 굽기
	    if($SecAdmin == 1){
	    	@session_register("_BBS_SecAdmin") or die("session_register err");
	    	$_BBS_SecAdmin = $_SESSION["_BBS_SecAdmin"] = $SecAdmin;
	    }
      	
      	if(!empty($dataArr[idx]))
      	{
      		$bbs_qry="SELECT * FROM ".$configBBS[board_id]." WHERE idx=$dataArr[idx]";
      		$bbs_result=@DBquery($bbs_qry);
      		$bbs_row=@mysql_fetch_array($bbs_result);
      	}
      	
      	
      	//답글 권한제어
      	if($bbs_row[idx]) {
      		
			if($SecAdmin != 1 && $configBBS[auth_reply_use] == "Y" && $configBBS[auth_reply] && @strpos(",".$configBBS[auth_reply], $bbs_authgroup) == false){
				go_back("답글쓰기 권한이 없습니다.");
				exit;
			}
			
		//글쓰기 권한제어
      	}else{
			if($SecAdmin != 1 && $configBBS[auth_write_use] == "Y" && $configBBS[auth_write] && @strpos(",".$configBBS[auth_write], $bbs_authgroup) == false){
				go_back("글쓰기 권한이 없습니다.");
				exit;
			}	
      	}
      	
      	
      	//등록시 체크구문 배열로 생성
		$checkcolumn = explode(",",$configBBS[board_checkcolumn]);
		$checktitle = explode(",",$configBBS[board_checktitle]);

		// 등록시 스크립트 추가
		echo "
		<SCRIPT LANGUAGE=\"JavaScript\">
		
			function bbsSendit()
			{
			var form=document.writeform;
			$ScrpitBodyCheck
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
		        	".$ScrpitUploadCheck."
		        }
       }
       </SCRIPT>
       ";


	} elseif($bbs=="see") {
		
		
		//관리세션 굽기
	    if($SecAdmin == 1){
	    	@session_register("_BBS_SecAdmin") or die("session_register err");
	    	$_BBS_SecAdmin = $_SESSION["_BBS_SecAdmin"] = $SecAdmin;
	    }
		
		//내용보기 권한제어
		if($SecAdmin != 1 && $configBBS[auth_read_use] == "Y" && $configBBS[auth_read] && @strpos(",".$configBBS[auth_read], $bbs_authgroup) == false){
			go_back("내용보기 권한이 없습니다.");
			exit;
		}
			  $dataArr = Decode64($data);
			  
			  @session_register("_BBS_DELETE_CONN") or die("session_register err");
	      	  $_BBS_DELETE_CONN = $_SESSION["_BBS_DELETE_CONN"] = $dataArr[idx];
			  
              //$check=DBarray("SELECT COUNT(*) FROM ".$configBBS[board_id]." WHERE code='".$BoardKey."' AND idx='".$dataArr[idx]."'");
              $check=DBarray("SELECT COUNT(*) FROM ".$configBBS[board_id]." WHERE idx='".$dataArr[idx]."'");

			  if($check[0]<1) go_back("게시물이 존재하지 않습니다. ");

			  //$view_row = DBarray("SELECT * FROM ".$configBBS[board_id]." WHERE code='".$BoardKey."' AND idx='".$dataArr[idx]."'"); //게시판 정보
			  $view_row = DBarray("SELECT * FROM ".$configBBS[board_id]." WHERE idx='".$dataArr[idx]."'"); //게시판 정보
			  
			  //비밀글 보기제한
			  if($view_row[view_secret] == "Y" && $SecAdmin != 1){
			  	
			  	if($bbs_userid){
			  		if($view_row[userid] != $bbs_userid)	go_back("비밀글은 본인 이외에는 보실 수 없습니다. ");
			  	}else if($bbs_adminid){
			  		if($view_row[adminid] != $bbs_adminid)	go_back("비밀글은 본인 이외에는 보실 수 없습니다. ");
			  	}else{
			  		if($_SESSION["_BBS_VIEW_LOGIN"] != $view_row[pwd]){
			  			go_back("비밀글은 글을 작성하신 분 이외에는 보실 수 없습니다.");	
			  		}
			  	}
			  }
			  
			  
          	// count overlapping check
          	if($_SESSION[_BBS_COUNT_VIEW] != $view_row[idx]) {

          		@session_register("_BBS_COUNT_VIEW") or die("session_register err");
          	    $_SESSION["_BBS_COUNT_VIEW"] = $view_row[idx];

          	    @DBquery("update ".$configBBS[board_id]." set readnum=readnum+1 where idx=$dataArr[idx]");
          	    $readnum = $view_row[readnum]+1;
          	    
          	}else{
          		$readnum = $view_row[readnum];
          	}

			// 변수가공
			if($configBBS[module_editor] == "None.php" || $configBBS[module_editor] == ""){
				$content = str_replace("\n","<br>", $view_row[content]);
			}else{
				$content = $view_row[content];
			}
			$writeday = explode("-",substr($view_row[writeday],0,11));
			$bbs_name = $view_row[name];
			
			$up_file_count = $view_row[up_file];
	      	$up_file_idx = $view_row[up_file_idx];


		    //첨부파일이 있을때
		    if($up_file_count > 0){
			    
			    $filev = 0;
			    $file_result = DBquery("SELECT * FROM ".$configBBS[board_id]."_file WHERE up_file_idx='".$up_file_idx."'");
			    while($file_row=mysql_fetch_array($file_result)){
					
					//일반 첨부파일 일 경우
					if ($file_row[up_filepath] && $file_row[file_type] < 10){
						
						$encode_str = "Boardkey=".$BoardKey."&DBTable=".$configBBS[board_id]."&idx=".$file_row[idx]."&download=ok";
						$down_data=Encode64($encode_str);
						
						//$upfile_link[$filev] .=  $file_row[up_filepath];
						$upfile_link[$filev] .=  "<a href='/bbs/download.php?data=".$down_data."'>".$file_row[up_filename]."</a> ";
						
						$filev = $filev+1;
						
						if($configBBS[board_viewimg] == "Y" && $file_row[file_type] > 0 && $file_row[file_type] < 5){	
							$upfile_imgview .= "<div id='bbs_imageview'><img src='/bbs/imageview.php?data=".$down_data."' onload=sizeModify(this);></div>";
						}
					}
					
					//UCC일 경우
					if($file_row[up_filepath] && $file_row[file_type] == 10) {
						$upfile_uccview .= "<embed src='http://".$_SERVER['HTTP_HOST']."/bbs/Extention/Uploader/MakeUCC/makeucc.swf' quality='high' wmode='transparent' devicefont='true' bgcolor='#ffffff' width='".$UCC_SIZE_WIDTH."' height='".$UCC_SIZE_HEIGHT."' id='bbsucc_".time()."' name='bbsucc_".time()."' align='middle' allowScriptAccess='always' allowfullscreen='true' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' ";
						$upfile_uccview .= " flashvars='ComURL=http://".$_SERVER['HTTP_HOST']."/bbs/Extention/Uploader/MakeUCC/&ComSrv_ID=iuk&MovieID=".$file_row[idx]."&playicon=null&WatermarkURL=null&BannerURL=null&ComSrv_AdText=null&ViewerParam1=".$configBBS[board_id]."&ViewerParam2=' /> ";
					}
					//<embed src='/bbs/Extention/Uploader/MakeUCC/makeucc.swf' quality='high' wmode='transparent' devicefont='true' bgcolor='#ffffff' width='600' height='400' id='bbsucc_".time()."' name='bbsucc_".time()."' align='middle' allowScriptAccess='always' allowfullscreen='true' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' 
					//flashvars='ComURL=http://".$_SERVER['HTTP_HOST']."/bbs/Extention/Uploader/MakeUCC/&ComSrv_ID=iuk&MovieID=".$file_row[idx]."&playicon=null&WatermarkURL=null&BannerURL=null&ComSrv_AdText=null&ViewerParam1=".$configBBS[board_id]."&ViewerParam2=' />
					
			    }
				
				//글보기에서 이미지사용
				$content = $upfile_uccview.$upfile_imgview.$content;
			}
			
			//$content = url_auto_link($content);
			
			//다운로드 권한제어
			if($SecAdmin != 1 && $configBBS[auth_download_use] == "Y" && $configBBS[auth_download] && @strpos(",".$configBBS[auth_download], $bbs_authgroup) == false){
				
				$upfile_view = "<span style='font-size:11px; color:#BBBBBB;'>다운로드 권한이 없습니다.</span>";
				
			}else{
			
				if($filev > 0){	
					$upfile_view = "<div onclick=\"DisplayDetail('div_filedown',1)\" style='cursor:hand'>";
					$upfile_view .= "<span style='font-size:11px; color:#8c8b8b;'>첨부파일</span><span style='font-size:11px; color:#005D79;'>(".$up_file_count.")</span> <img src='/bbs/skin/".$configBBS[board_skin]."/images/filedown.gif' align='absmiddle'>";
					$upfile_view .= "</div>";
				}else{
					
					$upfile_view = "<span style='font-size:11px; color:#BBBBBB;'>첨부파일이 없습니다.</span>";
				}
			}
			
			
			//코멘트 권한제어
			if($SecAdmin != 1 && $configBBS[auth_comment] && @strpos(",".$configBBS[auth_comment], $bbs_authgroup) == false){
				$_BBS_commented = "";
			}else{
				$_BBS_commented = "OK";
			}
			
			
			//글쓰기 권한제어
			if($SecAdmin != 1 && $configBBS[auth_write] && @strpos(",".$configBBS[auth_write], $bbs_authgroup) == false){
				$_BBS_Written = "";
				
				$_BBS_Modified = "";
				$_BBS_Deleted = "";
				
				$_BBS_Password = "";
				
			}else{
				//보기에서 글쓰기 링크
				$wencode_data = "Boardkey=$dataArr[Boardkey]&Sub_No=$dataArr[Sub_No]&DBTable=$dataArr[DBTable]";
  			  	$wdata    = Encode64($wencode_data);
  			  
			  	$_BBS_Written	=	"$PHP_SELF?bbs=compose&data=$wdata";
			  	
			  	$_BBS_Modified = "javascript:bbsEdit();";
				$_BBS_Deleted = "javascript:bbsDel();";
				
				
				//패스워드 자동표시 여부
				if($SecAdmin == 1){
					$_BBS_Password = "<input type='hidden' name='pwd' value='".$view_row[pwd]."'>";
				}else if($view_row[userid] != "" && $view_row[userid] == $bbs_userid){
					$_BBS_Password = "<input type='hidden' name='pwd' value='".$view_row[pwd]."'>";
				}else if($view_row[adminid] != "" && $view_row[adminid] == $bbs_adminid){
					$_BBS_Password = "<input type='hidden' name='pwd' value='".$view_row[pwd]."'>";
				}else{
					$_BBS_Password = "<input type='password' name='pwd' value='' style='width:80px;'>&nbsp;";
				}
			}
			
			
			//답변쓰기 권한제어
			if($SecAdmin != 1 && $configBBS[auth_reply] && @strpos(",".$configBBS[auth_reply], $bbs_authgroup) == false){
				$_BBS_Replied = "";
			}else{
			  	$_BBS_Replied	=	"$PHP_SELF?bbs=compose&data=$data";
			}
			
			
			$list_link = "$PHP_SELF?bbs=list&data=$data"; //목록링크

              
			  // 스크립트 추가
              echo "
              <SCRIPT Language=\"JavaScript\">
              
              function bbsEdit()
              {
              	var form=document.pwdForm;
              	if(form.pwd.value==\"\"){
              		alert(\"비밀번호를 입력해 주십시오.\");
              		form.pwd.focus();
              	}else{
              		form.action=\"/bbs/module_pw.php?data=$data&BURL=$PHP_SELF&edit=ok\";
              		form.submit();
              	}
              }
              
              function bbsDel()
              {
              	var form=document.pwdForm;
              	if(form.pwd.value==\"\"){
              		alert(\"비밀번호를 입력해 주십시오.\");
              		form.pwd.focus();
              	}else{
              		form.action=\"/bbs/module_pw.php?data=$data&BURL=$PHP_SELF&del=ok\";
              		form.submit();
              	}
              }

              </SCRIPT>
              ";

	} elseif($bbs=="repair") {
		  
	      $dataArr=Decode64($data);
	      
	        @session_unregister("_BBS_DELETE_CONN") or die("session_unregister err");
	        @session_register("_BBS_WRITE_CONN") or die("session_register err");
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
			<SCRIPT LANGUAGE=\"JavaScript\">
			
				function bbsSendit()
				{
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
			        	".$ScrpitUploadCheckModify."
			        }
	       }
	       </SCRIPT>
	       ";


	} else {
		
		//$bbs 액션이 없는경우
		
	}
	
	   
	   
	   if($configBBS[board_topinclude]) include $_SERVER["DOCUMENT_ROOT"].$configBBS[board_topinclude];	//상단 인클루드

	   switch($bbs){
	   	
		case 'list' : 
		
			//리스트 권한제어
			if($SecAdmin != 1 && $configBBS[auth_list_use] == "Y" && $configBBS[auth_list] && @strpos(",".$configBBS[auth_list], $bbs_authgroup) == false){
				
				echo "리스트 보기 권한이 없습니다.";
				
			}else{
				
				if (($BoardKey == "1911" || $BoardKey == "1912" ||$BoardKey == "1913")&& $SecAdmin == "1"){
					include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/list_admin.php";
				}else {
					include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/list.php";	
				}
				
			}
			
			
			
			break;

		case 'see' :
			if (($BoardKey == "1911" || $BoardKey == "1912" ||$BoardKey == "1913")&& $SecAdmin == "1"){
				include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/view_admin.php";
			}else {
				include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/view.php";
			}
			
			
			if($configBBS[board_commentuse] == "Y"){
				if (($BoardKey == "1911" || $BoardKey == "1912" ||$BoardKey == "1913")&& $SecAdmin == "1"){
					include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/comment_admin.php";
				}else {
					include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/comment.php";
				}
				
				
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
				
				//echo $bbs_qry;
				
				$encode_data = "Sub_No=$Sub_No&Boardkey=$BoardKey&DBTable=$configBBS[board_id]";
	  			$data    = Encode64($encode_data);
	
				//글쓰기 버튼
				$_BBS_Written	=	"$PHP_SELF?bbs=compose&data=$data";

				if (($BoardKey == "1911" || $BoardKey == "1912" ||$BoardKey == "1913")&& $SecAdmin == "1"){
					include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/list_admin.php";
				}else {
					include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/list.php";
				}

				
				
			}
			break;

		case 'compose' : 
	
			if (($BoardKey == "1911" || $BoardKey == "1912" ||$BoardKey == "1913")&& $SecAdmin == "1"){
				include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/write_admin.php"; 
			}else {
				include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/write.php"; 
			}
			
		break;

		case 'repair' : 
			if (($BoardKey == "1911" || $BoardKey == "1912" ||$BoardKey == "1913")&& $SecAdmin == "1"){
				include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/edit_admin.php"; 
			}else {
				include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/edit.php"; 
			}		
			
		break;

	   }
	   if($configBBS[board_bottominclude]) include $_SERVER["DOCUMENT_ROOT"].$configBBS[board_bottominclude];	//하단 인클루드

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
		
	}//function putList()
}//class


//게시판에 링크생성
function BBSButtonLink($BLINK, $BSRC, $VIEWOPT=""){
	
	// $VIEWOPT 권한이 없을때 $BSRC 내용이 보일건지 여부 1이면 보이기
	
	if($BLINK){
		$ButtonLink = "<a href=\"".$BLINK."\">".$BSRC."</a>";
		
	}else if(empty($BLINK) && $VIEWOPT == 1){
		$ButtonLink = $BSRC;
		
	}else{
		$ButtonLink = "";
		
	}
	
	echo $ButtonLink;
}
?>