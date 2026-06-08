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
*******************************************************************************************************/

// BBS Make Module
class Sub_BBSStart {

    var $bbs;
	var $c_BoardKey;
	var $c_Sub_No;
    var $c_DBTable;
	var $c_bbspart;
	var $c_Listcount;
	var $c_SecAdmin;

	function makebbs($bbs, $BoardKey, $Sub_No, $DBTable, $bbspart, $Listcount, $SecAdmin, $bbs_userqry="", $bbs_subqry="") {
	
		global $PHP_SELF, $s_id, $u_id, $u_name, $category, $HOMEDIR, $sub_code, $MainCD, $SubCD, $data, $search, $searchstring;

		$this->bbs			= $bbs;
		$this->c_BoardKey	= $BoardKey;
		$this->c_Sub_No		= $Sub_No;
		$this->c_DBTable	= $DBTable;
		$this->c_bbspart	= $bbspart;
		$this->c_Listcount  = $Listcount;
		$this->c_SecAdmin	= $SecAdmin;
		
		$part = $bbspart;

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
				
		if($bbs_userqry)	$Code_Que .= $Code_Que." and userid='$bbs_userqry' and re_step = '0' and re_level = '0' ";
		if($bbs_subqry)	$Code_Que .= $Code_Que." ".$bbs_subqry;
		
	if($bbs=="list") {

			$data=Decode64($data);
            $pagecnt=$data[pagecnt];
            $letter_no=$data[letter_no];
            $offset=$data[offset];

            if(!$searchstring){ //검색
          	  $search=$data[search];
          	  $searchstring=$data[searchstring];
            }

            /*
            if($searchstring) $numresults=DBquery("SELECT idx FROM ".$DBTable." WHERE ".$Sub_Que." code='".$BoardKey."' AND $search LIKE '%$searchstring%'"); //검색
            else			  $numresults=DBquery("SELECT idx FROM ".$DBTable." WHERE ".$Sub_Que." code='".$BoardKey."'");
            */
            
            if($searchstring) $numresults=DBquery("SELECT idx FROM ".$DBTable." WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%'"); //검색
            else $numresults=DBquery("SELECT idx FROM ".$DBTable." WHERE idx > 0 ".$Code_Que." ");


            //총 레코드수
			$numrows=mysql_num_rows($numresults);

            //페이지당 글 수
			/*
			if($bbspart==30) $LIMIT	= 12;
			else			 $LIMIT	= 10;
			*/
			$LIMIT = $Listcount;
			
            
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

            //검색
			/*
			if($searchstring){
          	  $bbs_qry = "SELECT * FROM ".$DBTable." WHERE ".$Sub_Que." code='".$BoardKey."' AND $search LIKE '%$searchstring%' ";
          	  $bbs_qry.= " ORDER BY ref DESC,re_step ASC LIMIT $offset,$LIMIT";
            }else{
          	  $bbs_qry = "SELECT * FROM ".$DBTable." WHERE ".$Sub_Que." code='".$BoardKey."' ORDER BY ref DESC,re_step ASC LIMIT $offset,$LIMIT";
            }
            */
            
            
            if($searchstring){
          	  $bbs_qry = "SELECT * FROM ".$DBTable." WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%' ";
          	  $bbs_qry.= " ORDER BY ref DESC,re_step ASC LIMIT $offset,$LIMIT";
            }else{
          	  $bbs_qry = "SELECT * FROM ".$DBTable." WHERE idx > 0 ".$Code_Que." ORDER BY ref DESC,re_step ASC LIMIT $offset,$LIMIT";
            }
			
			//echo $bbs_qry;
			
			$encode_data = "Sub_No=$Sub_No&BoardKey=$BoardKey&DBTable=$DBTable";
  			$data    = Encode64($encode_data);

			//글쓰기 버튼
			$_BBS_Written	=	"$PHP_SELF?bbs=compose&writemode=$writemode&data=$data&MainCD=$MainCD&SubCD=$SubCD";

		if($bbspart!=200) {
		   // 스크립트 추가
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
		}
	
	} elseif($bbs=="see") {
    
			  $dataArr = Decode64($data);
			
              //$check=DBarray("SELECT COUNT(*) FROM ".$DBTable." WHERE code='".$BoardKey."' AND idx='".$dataArr[idx]."'");
              $check=DBarray("SELECT COUNT(*) FROM ".$DBTable." WHERE idx='".$dataArr[idx]."'");

			  if($check[0]<1) MsgView("게시물이 존재하지 않습니다.",-1);

			  //$view_row = DBarray("SELECT * FROM ".$DBTable." WHERE code='".$BoardKey."' AND idx='".$dataArr[idx]."'"); //게시판 정보
			  $view_row = DBarray("SELECT * FROM ".$DBTable." WHERE idx='".$dataArr[idx]."'"); //게시판 정보

          	// count overlapping check
          	if($_SESSION[_BBS_COUNT_VIEW] != $view_row[idx]) {

          		@session_register("_BBS_COUNT_VIEW") or die("session_register err");
          	    $_BBS_COUNT_VIEW = $_SESSION["_BBS_COUNT_VIEW"] = $view_row[idx];

          	    @DBquery("update ".$DBTable." set readnum=readnum+1 where idx=$dataArr[idx]");
          	    
          	    
          	    $readnum = $view_row[readnum]+1;
          	    
          	    //글조회시 실시간으로
          	    //ReFresh("$PHP_SELF?bbs=see&data=$data&MainCD=$MainCD&SubCD=$SubCD");
          	    //exit;
          	}


              // 변수가공
              if($view_row[bHtml]==1) $content = $view_row[content];
              else					  $content = str_replace("\n","<br>", $view_row[content]);

              $writeday = explode("-",substr($view_row[writeday],0,11));
              $view_num = $dataArr[present_num];

              if(!empty($view_row[up_file])) $upfile = "<a href='/bbs/bbs_down&data=$data'><b>Download</b></a>";
              else							 $upfile = "<font color='#999999'>Not attachment.</font>";

              $bbs_name = OnlyCut($view_row[name],16);
              $readnum = $view_row[readnum];

             if(!empty($view_row[up_file])) {

             	$imageinfo = @getimagesize($HOMEDIR."bbs/data/".$view_row[up_file]);

				// 확장자별로 구분 자동 View
             	if(eregi("\.jpg",$view_row[up_file])||eregi("\.jpeg",$view_row[up_file])||eregi("\.gif",$view_row[up_file])||eregi("\.png",$view_row[up_file])) {
					$up_file = "<img src=\"/bbs/data/".$view_row[up_file]."\" onclick=\"Popup_pub1('/bbs/orgzoom.php', $imageinfo[0], $imageinfo[1], '$view_row[up_file]');\" style=\"cursor:hand;\">";
				}

			}
			 
			 if(!empty($view_row[img1])) {

				$_sizeimg1 = filesize($HOMEDIR."bbs/data/".$view_row[img1]);
				$sizeimg1 = getfilesize($_sizeimg1);
             	
				$imageinfo = getimagesize($HOMEDIR."bbs/data/".$view_row[img1]);

             	// 확장자별로 구분 자동 View
             	if(eregi("\.jpg",$view_row[img1])||eregi("\.jpeg",$view_row[img1])||eregi("\.gif",$view_row[img1])||eregi("\.png",$view_row[img1])) {

					$viewimg1 = "<img src=\"/bbs/imgview.php?file=image&data=$view_row[img1]\" onLoad=\"sizeModify(this);\" onclick=\"PopupIMG('/bbs/orgzoom.php', $imageinfo[0]+15, $imageinfo[1]+15, '$view_row[img1]');\" style=\"cursor:hand;\"><br>";
				}

				if(eregi("\.asx",$view_row[img1])||eregi("\.asf",$view_row[img1])||eregi("\.wmv",$view_row[img1])||eregi("\.mov",$view_row[img1])) {
			
					$viewimg1 = "<EMBED src=\"/bbs/data/$view_row[img1]\" type=\"video/x-msvideo\" autostart=\"false\" ShowGotoBar=\"false\" ShowDisplay=\"false\" AutoSize=\"false\">";
				}

				if(eregi("\.swf",$view_row[img1])) {
					$viewimg1 = "<embed src=\"/bbs/data/$view_row[img1]\" >";
				}
             }

             else $viewimg1 = "";
             
             
             if(!empty($view_row[img2])) { 

				$_sizeimg2 = filesize($HOMEDIR."bbs/data/".$view_row[img2]);
				$sizeimg2 = getfilesize($_sizeimg2);
             	
				$imageinfo1 = getimagesize($HOMEDIR."bbs/data/".$view_row[img2]);

             	// 확장자별로 구분 자동 View
             	if(eregi("\.jpg",$view_row[img2])||eregi("\.jpeg",$view_row[img2])||eregi("\.gif",$view_row[img2])||eregi("\.png",$view_row[img2])) {

					$viewimg2 = "<img src=\"/bbs/imgview.php?file=image&data=$view_row[img2]\" onLoad=\"sizeModify(this);\" onclick=\"PopupIMG('/bbs/orgzoom.php', $imageinfo1[0]+15, $imageinfo1[1]+15, '$view_row[img2]');\" style=\"cursor:hand;\"><br>";
				}
				if(eregi("\.asx",$view_row[img2])||eregi("\.asf",$view_row[img2])||eregi("\.wmv",$view_row[img2])||eregi("\.mov",$view_row[img2])) {
			
					$viewimg2 = "<EMBED src=\"/bbs/data/$view_row[img2]\" type=\"video/x-msvideo\" autostart=\"false\" ShowGotoBar=\"false\" ShowDisplay=\"false\" AutoSize=\"false\">";
				}
				if(eregi("\.swf",$view_row[img2])) {
					$viewimg2 = "<embed src=\"/bbs/data/$view_row[img2]\" >";
				}
             }

             else $viewimg2 = "";

              
              if(!empty($view_row[up_file])) $upfile = "<a href='/bbs/down.php?file=pds&data=$data'><b>Download</b></a><img src=/bbs/file_img.gif width=11 height=11 align=absmiddle />";
              else			     $upfile = "<font color='#999999'>첨부파일이 없습니다.</font>";
              
              if(!empty($view_row[img1])) $downimg1 = "<a href='/bbs/down.php?file=img1&data=$data'><b>$view_row[img1]</b></a>";
              else			  $downimg1 = "<font color='#999999'>첨부파일이 없습니다.</font>";
              if(!empty($view_row[img2])) $downimg2 = "<a href=/bbs/down.php?file=img2&data=$data'><b>$view_row[img2]</b></a>";
              else			  $downimg2 = "<font color='#999999'>첨부파일이 없습니다.</font>";


			  $replay_link = "$PHP_SELF?bbs=compose&data=$data";
			  $list_link = "$PHP_SELF?bbs=list&data=$data&MainCD=$MainCD&SubCD=$SubCD";
			  
			  $wencode_data = "Sub_No=$dataArr[Sub_No]&BoardKey=$dataArr[BoardKey]&DBTable=$dataArr[DBTable]";
  			  $wdata    = Encode64($wencode_data);
			  $_BBS_Written	=	"$PHP_SELF?bbs=compose&data=$wdata&MainCD=$MainCD&SubCD=$SubCD";

              
			  if($bbspart!=200) {
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
                  		form.action=\"/bbs/module_pw.php?data=$data&BURL=$PHP_SELF&MainCD=$MainCD&SubCD=$SubCD&edit=ok\";
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
                  		form.action=\"/bbs/module_pw.php?data=$data&BURL=$PHP_SELF&MainCD=$MainCD&SubCD=$SubCD&del=ok\";
                  		form.submit();
                  	}
                  }

                  </SCRIPT>
                  ";
			  }

	} elseif($bbs=="compose") {

          	
          	$dataArr=Decode64($data);
	
          	if(!empty($dataArr[idx]))
          	{

          		$bbs_qry="SELECT * FROM ".$DBTable." WHERE idx=$dataArr[idx]";
          		$bbs_result=@DBquery($bbs_qry);
          		$bbs_row=@mysql_fetch_array($bbs_result);
          	}

        if($bbspart!=200) {
		   // 스크립트 추가
           echo "
           <SCRIPT LANGUAGE=\"JavaScript\">
           
           function bbsSendit()
           {
           	var form=document.writeform;           	
           	var content = edt.getHtml();
           
           	if(form.name.value==\"\"){
           		alert(\"이름을 입력해 주십시오.\");
           		form.name.focus();
           	}else if(form.title.value==\"\"){
           		alert(\"제목을 입력해 주십시오.\");
           		form.title.focus();
           ";

           if($bbspart==20){
           	echo "
           	}else if(form.up_file.value==\"\"){
           		alert(\"첨부파일을 선택해 주세요.\");
           		form.up_file.focus();

           	}else if(filehanCheck(form.up_file.value)){
           		alert(\"첨부파일은 영문명으로 등록해 주십시오.\");
           		form.up_file.focus();
           	";
           }

           echo "
           	}else if(form.pwd.value==\"\"){
           		alert(\"비밀번호를 입력해 주십시오.\");
           		form.pwd.focus();
           	}else if(content==\"\"){
	        	alert(\"내용을 입력해 주십시오.\");
	        	edt.focus();
	        }else{
	        	form.submit();	
	        }
           }
           </SCRIPT>
           ";
		}

	} elseif($bbs=="repair") {

          $dataArr=Decode64($data);

            session_register("_BBS_WRITE_LOGIN") or die("session_register err");
          	$_BBS_WRITE_LOGIN = $_SESSION["_BBS_WRITE_LOGIN"] = $BoardKey;
          
          	if($data)
          	{
          	/* 2005 0916일 수정 */
          		$bbs_qry="SELECT * FROM ".$DBTable." WHERE idx=$dataArr[idx]";
          		$bbs_result=@DBquery($bbs_qry);
          		$bbs_row=@mysql_fetch_array($bbs_result);

          	       //echo $PassModule3;
          	       if($_SESSION[_BBS_PASS_LOGIN]!=$bbs_row[pwd]) MsgView("\\n 잘못된 접근입니다. \\n","-1");
          	}

           if($bbspart!=200) {
				// 스크립트 추가
	           echo "
	           <SCRIPT LANGUAGE=\"JavaScript\">
           
	           function bbsSendit()
	           {
	           	var form=document.writeform;
	           	var content = edt.getHtml();

		       	if(form.name.value==\"\"){
	           		alert(\"이름을 입력해 주십시오.\");
	           		form.name.focus();
	           	}else if(form.title.value==\"\"){
	           		alert(\"제목을 입력해 주십시오.\");
	           		form.title.focus();
	           	}else if(form.pwd.value==\"\"){
	           		alert(\"비밀번호를 입력해 주십시오.\");
	           		form.pwd.focus();
	           	}else if(content==\"\"){
	        		alert(\"내용을 입력해 주십시오.\");
	        		edt.focus();
	        	}else{
	           		form.submit();	
	           	}
	           }
	           </SCRIPT>
	           ";
		   }

	} else {

		
	}
	
	   switch($bbs){

		case 'list' : include $HOMEDIR."bbs/skin/$part/list.php"; break;

		case 'see' : include $HOMEDIR."bbs/skin/$part/view.php"; break;

		case 'compose' : include $HOMEDIR."bbs/skin/$part/write.php"; break;

		case 'repair' : include $HOMEDIR."bbs/skin/$part/edit.php"; break;

	   }

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

	var $g_option;			//추가 get 값  ex) &part=$part
			
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
		echo "<a href=".$this->g_pageName."?data=".$data."&category=".$category.">".$this->g_fIcon."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		
		
					
		/*    이전   */
		if($this->g_pageCnt>0){				//이전페이지 있음
			$prepage=$this->g_pageCnt-1;	//이전블럭 시작페이지 설정.
			$pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//이전블럭 시작글 번호 설정
		    $data=Encode64("pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);

	        $pre_str ="<a href='".$this->g_pageName."?data=".$data."&category=".$category."'>".$this->g_pIcon."</a>&nbsp;";

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
			echo "&nbsp;<a href=".$this->g_pageName."?data=".$data."&category=".$category.">".$this->g_p1Icon."</a>&nbsp;";
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
				$mid_str = " [<a href='".$this->g_pageName."?data=".$data."&category=".$category."'>".$lnum."</a>] ";
				
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
			echo "&nbsp;<a href=".$this->g_pageName."?data=".$data."&category=".$category.">".$this->g_n1Icon."</a>&nbsp;";
		}else{
			echo "&nbsp;".$this->g_n1Icon."&nbsp;";
		}
		



		/*    다음   */
		if($this->g_pageCnt!=$chekpage){		//다음페이지 있음
			echo "&nbsp;";
			$newpagecnt=$this->g_pageCnt+1;		//다음 블럭 시작페이지 설정
			$newt=$cu_letter_no-$this->g_limit;	//다음 블럭 시작글 번호 설정
			$data=Encode64("pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);
			$next_str="<a href='".$this->g_pageName."?data=".$data."&category=".$category."'>".$this->g_nIcon."</a>";

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
		
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$this->g_lIcon."</a>";

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

	var $g_option;			//추가 get 값  ex) &part=$part
			
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

	        $pre_str ="<a href='".$this->g_pageName."?data=".$data."&category=".$category."'>".$this->g_pIcon."</a>&nbsp;";

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
				$mid_str = " [<a href='".$this->g_pageName."?data=".$data."&category=".$category."'>".$lnum."</a>] ";
				
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
			$next_str="<a href='".$this->g_pageName."?data=".$data."&category=".$category."'>".$this->g_nIcon."</a>";

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

?>