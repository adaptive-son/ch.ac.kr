<?php

function iconv8($string){
    return iconv("euc-kr","utf-8", $string);
}

//CMS function
function cms_view($cms_id){

    if(empty($cms_id))	echo "<div style=' text-align:center; padding:100px 0; '>CMS 코드가 없습니다.</div>";

    $CMSQue = " SELECT cms_name, damdang_name, damdang_tel, cms_text1, cms_text2, cms_text3, cms_text4, cms_text5, cms_text6, cms_date FROM cms_category WHERE cms_id='".$cms_id."' ";
    $CMS = DBarray($CMSQue);

    $cmsview = $CMS[cms_text1].$CMS[cms_text2].$CMS[cms_text3].$CMS[cms_text4].$CMS[cms_text5].$CMS[cms_text6];

    if(empty($cmsview))	echo "<div style=' text-align:center; padding:100px 0; '><img src='/make_img/common/page_ready.jpg'></div>";
    else	echo $cmsview;

    if($CMS[cms_date] == "0000-00-00 00:00:00") $cms_date = "";
    else										$cms_date = substr($CMS[cms_date],0,10);

    $damdang_name = $CMS[damdang_name];
    $damdang_tel = $CMS[damdang_tel];



    /*

    <div id="page_inc">
                  <div class="page_com">
                    <p class="page_h"><img src="/make_img/page/txt1.gif" width="115" height="22" alt="페이지담당자 안내입니다."></p>
                    <ul class="page_table">
                      <li class="page_bn1"><img src="/make_img/page/o.gif" width="16" height="13"><strong>담당자</strong> :
                         '.$damdang_name.'
                      </li>
                      <li class="page_bn2"><img src="/make_img/page/o.gif" width="16" height="13"><strong>전화번호</strong> :
                         '.$damdang_tel.'
                      </li>
                      <li class="page_bn3"><img src="/make_img/page/o.gif" width="16" height="13"><strong>최근업데이트</strong> :
                        '.$cms_date.'
                      </li>
                      <li class="page_bn4"><a href="javascript:cms_bookmarksite()"><img src="/make_img/page/add_btn.gif" alt="즐겨찾기" width="68" height="18"></a><a href="javascript:print();"><img src="../../make_img/page/print_btn.gif" alt="프린트" width="72" height="18"></a></li>
                    </ul>
                  </div>
                </div>


    */

    $cms_copy = '
				<!-- 페이지 담당자안내 -->
				 <div class="fdata_wrap"> 
		          <dl> 
		             <dt><img src="/make_img/page/txt1.gif" alt="페이지담당자 안내입니다."/></dt> 
		             <dd> 
		              <ul> 
		                 <li><span class="ctit">담당자 : </span><span class="ctxt">'.$damdang_name.'</span></li> 
		                 <li><span class="ctit">전화번호 : </span><span class="ctxt">'.$damdang_tel.'</span></li> 
		                 <li class="last"><span class="ctit">최근업데이트 : </span><span class="ctxt">'.$cms_date.'</span></li> 
		               </ul> 
		              <div class="btn_print"><a href="#n" onclick="cms_bookmarksite()"/><img src="/make_img/page/add_btn.gif" alt="" /></a> <a href="#n" onclick="print();" ><img src="/make_img/page/print_btn.gif" alt=""/></a> </div> 
		            </dd> 
		           </dl> 
		        </div> 	

		';


    $cms_copy .= '
	  <script language="Javascript">
		function cms_bookmarksite() {
			var url = "http://'.$_SERVER["SERVER_NAME"].''.$_SERVER["REQUEST_URI"].'";
			var title = "춘해보건대학교-'.$CMS[cms_name].'";
		 
			if (window.sidebar && window.sidebar.addPanel){
				window.sidebar.addPanel(sidebartitle, sidebarurl,"");
			} 
			else if ( document.all ) {
				window.external.AddFavorite(url, title); 
			}
			else if (window.opera && window.print) {
				
			}
			else if (navigator.appName=="Netscape") {
				alert("<Ctrl+D>를 입력하시면 즐겨찾기를 추가하실 수 있습니다.");
			}
		 }
	  </script>
	 ';

    if(substr($cms_id,0,2) == "14"){
        $cms_copy = ""; //입학처에서 출력 중지 요청 20131111
    }

    echo $cms_copy;

}



//CMS function
function cms_view_utf8($cms_id){

    if(empty($cms_id))	echo "<div style=' text-align:center; padding:100px 0; '>CMS 코드가 없습니다.</div>";

    $CMSQue = " SELECT cms_name, damdang_name, damdang_tel, cms_text1, cms_text2, cms_text3, cms_text4, cms_text5, cms_text6, cms_date FROM cms_category WHERE cms_id='".$cms_id."' ";
    $CMS = DBarray($CMSQue);

    $cmsview = $CMS[cms_text1].$CMS[cms_text2].$CMS[cms_text3].$CMS[cms_text4].$CMS[cms_text5].$CMS[cms_text6];
    $cmsview = str_replace("<BR>","<BR />",$cmsview);
    //$cmsview = $cmsview;
    $cmsview = iconv("euc-kr","utf-8",$cmsview);

    if(empty($cmsview))	echo "<div style=' text-align:center; padding:100px 0; '><img src='/make_img/common/page_ready.jpg' alt='' /></div>";
    else	echo $cmsview;

    if($CMS[cms_date] == "0000-00-00 00:00:00" || $cms_id=="13101113") $cms_date = "";
    else										$cms_date = substr($CMS[cms_date],0,10);

    //$damdang_name = iconv("euc-kr","utf-8",$CMS[damdang_name]);
    //$damdang_tel = iconv("euc-kr","utf-8",$CMS[damdang_tel]);


    $damdang_name = $CMS[damdang_name];
    $damdang_tel = $CMS[damdang_tel];



    $cms_copy = '
				<!-- 페이지 담당자안내 -->
		         <div class="fdata_wrap"> 
		          <dl> 
		             <dt><img src="/make_img/page/txt1.gif" alt="페이지담당자 안내입니다."/></dt> 
		             <dd> 
		              <ul> 
		                 <li><span class="ctit">담당자 : </span><span class="ctxt">'.$damdang_name.'</span></li> 
		                 <li><span class="ctit">전화번호 : </span><span class="ctxt">'.$damdang_tel.'</span></li> 
		                 <li class="last"><span class="ctit">최근업데이트 : </span><span class="ctxt">'.$cms_date.'</span></li> 
		               </ul> 
		              <div class="btn_print"><a href="#n" onclick="cms_bookmarksite()"><img src="/make_img/page/add_btn.gif" alt="즐겨찾기" /></a> <a href="#n" onclick="print();" /><img src="/make_img/page/print_btn.gif" alt="프린트" /></a> </div> 
		            </dd> 
		           </dl> 
		        </div> 
				<!-- 페이지 담당자안내 -->
		';


    $cms_copy .= '
	  <script language="Javascript">
		function cms_bookmarksite() {
			var url = "http://'.$_SERVER["SERVER_NAME"].''.$_SERVER["REQUEST_URI"].'";
			var title = "춘해보건대학교-'.$CMS[cms_name].'";
		 
			if (window.sidebar && window.sidebar.addPanel){
				window.sidebar.addPanel(sidebartitle, sidebarurl,"");
			} 
			else if ( document.all ) {
				window.external.AddFavorite(url, title); 
			}
			else if (window.opera && window.print) {
				
			}
			else if (navigator.appName=="Netscape") {
				alert("<Ctrl+D>를 입력하시면 즐겨찾기를 추가하실 수 있습니다.");
			}
		 }
	  </script>
	 ';

    $cms_copy = iconv("euc-kr","utf-8",$cms_copy);
    echo $cms_copy;

}

//게시판 생성
function create_bbs($board_key, $category_no="0", $SecAdmin="0", $bbs_userqry="", $bbs_subqry="", $bbs_subcolumnqry="",$encode="euckr"){
    global $bbs;

    $Obj=new Sub_BBSStart();
    $Obj->makebbs($bbs, $board_key, $category_no, $SecAdmin, $bbs_userqry, $bbs_subqry, $bbs_subcolumnqry,$encode);
}




//게시판 최근게시물 값 배열에 담기
function BBS_GetList($board_table , $board_code, $board_type=0, $limit_num=5, $cut_content=0, $debugmod=0){
    mysql_select_db("ch_new");
//BBS_GetList("게시판 테이블명(fullname)", "게시판코드", 보드타입, 배열에 담을 최근게시물 수, 내용글 수:html형식이라 300이상으로 잡아야...);
    /*
        $board_type=0 : 일반
        $board_type=1 : 갤러리
        $board_type=2 : UCC

        [사용방법]
        $newlist1 = BBS_GetList("bbs_com1", "3010", 0, 5, 300);

        for($i=0; $i < count($newlist1); $i++){

            //echo $newlist1[$i][title]."<br>"; //제목

            //echo $newlist1[$i][content]."<br>"; //내용

            //echo $newlist1[$i][linkdata]."<br>"; //링크데이타  <a href='파일명?bbs=see&data=$newlist1[$i][linkdata]'>
            //echo $newlist1[$i][file_src]."<br>"; //파일경로 <img src='$newlist1[$i][file_src]'> width height는 지정

            //echo $newlist1[$i][datetime]."<br>"; //등록일자
            //echo $newlist1[$i][newimg]."<br>"; //새글 아이콘

        }

    */

    if($board_type == 1)
        //$bbs_subcolumnqry = ", (select idx from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx";
        $bbs_subcolumnqry = ", (select idx from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx";
    else if($board_type == 2)
        //$bbs_subcolumnqry = ", (select up_filename from ".$board_table."_file where file_type = 10 and up_file_idx = A.up_file_idx limit 0,1) as up_filename";
        $bbs_subcolumnqry = ", (select up_filename from ".$board_table."_file where up_file_idx = A.up_file_idx limit 0,1) as up_filename";
    else
        $bbs_subcolumnqry = ", (select idx from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx";

    $bbs_qry = "SELECT * ";
    $bbs_qry .= $bbs_subcolumnqry;
    $bbs_qry .= " FROM ".$board_table." A WHERE idx > 0 and code = '$board_code' ";
    $bbs_qry .= " ORDER BY notice ASC, ref DESC, re_step ASC limit $limit_num ";
//print_R($bbs_qry);
    if($debugmod == 1)	echo $bbs_qry;

    $result = DBquery($bbs_qry);

    for($i=0; $row=@mysql_fetch_array($result); $i++){

        $bbslimit[$i][idx] = $row[idx];

        //게시판 제목
        $bbslimit[$i][title] = $row[title];

        //게시판 등록일자
        $bbslimit[$i][datetime] = substr($row[writeday],0,10);

        //게시판 새글
        if(BetweenPeriod($row[writeday],"1") > 0) $bbslimit[$i][newimg] = "<img src='/bbs/images/new.gif' border='0' align='absmiddle' alt='' />";
        else $bbslimit[$i][newimg] = "";

        //링크 데이타
        $encode_str = "pagecnt=0&idx=".$row[idx]."&letter_no=&offset=";
        $encode_str.= "&search=".$search."&searchstring=".$searchstring;
        $encode_str.= "&Boardkey=".$row[code]."&Sub_No=".$row[sub_no]."&DBTable=".$board_table;
        $list_data=Encode64($encode_str);

        $bbslimit[$i][linkdata] = $list_data;

        //타입별 이미지경로
        if($board_type == 1){
            $bbslimit[$i][file_idx] = $row[file_idx];

            $fileencode_str = "Boardkey=".$board_code."&DBTable=".$board_table."&idx=".$row[file_idx]."&download=ok";
            $file_data=Encode64($fileencode_str);
            $bbslimit[$i][file_src] = "/bbs/imageview.php?image=thumnail&data=".$file_data;
            //$bbslimit[$i][file_src] = "/bbs/imageview.php?data=".$file_data;
        }else if($board_type == 2){
            $bbslimit[$i][file_src] = "/bbs/".$row[up_filename];

        }else{
            $bbslimit[$i][file_idx] = $row[file_idx];

            $fileencode_str = "Boardkey=".$board_code."&DBTable=".$board_table."&idx=".$row[file_idx]."&download=ok";
            $file_data=Encode64($fileencode_str);
            $bbslimit[$i][file_src] = "/bbs/imageview.php?image=thumnail&data=".$file_data;
        }


        //내용 출력시
        if($cut_content > 0){
            $bbs_content = str_replace("&nbsp;", "", $row[content]);
            $bbs_content = StringCut(trim(strip_tags($bbs_content)), $cut_content);
            $bbslimit[$i][content] = $bbs_content;

        }

    }

    return $bbslimit;
}


//게시판 최근게시물 값 배열에 담기
function BBS_GetList2($board_table , $board_code, $board_type=0, $limit_num=5, $cut_content=0, $debugmod=0){
    //DB변경
    mysql_select_db("chipsi");
    if($board_type == 1)
        //$bbs_subcolumnqry = ", (select idx from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx";
        $bbs_subcolumnqry = ", (select idx from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx";
    else if($board_type == 2)
        //$bbs_subcolumnqry = ", (select up_filename from ".$board_table."_file where file_type = 10 and up_file_idx = A.up_file_idx limit 0,1) as up_filename";
        $bbs_subcolumnqry = ", (select up_filename from ".$board_table."_file where up_file_idx = A.up_file_idx limit 0,1) as up_filename";
    else
        $bbs_subcolumnqry = ", (select idx from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx";

    $bbs_qry = "SELECT * ";
    $bbs_qry .= $bbs_subcolumnqry;
    $bbs_qry .= " FROM ".$board_table." A WHERE idx > 0 and code = '$board_code' and show_yn='N' ";
    $bbs_qry .= " ORDER BY notice ASC, ref DESC, re_step ASC limit $limit_num ";
//print_R($bbs_qry);
    if($debugmod == 1)	echo $bbs_qry;

    $result = DBquery($bbs_qry);

    for($i=0; $row=@mysql_fetch_array($result); $i++){

        $bbslimit[$i][idx] = $row[idx];

        //게시판 제목
        $bbslimit[$i][title] = $row[title];

        //게시판 등록일자
        $bbslimit[$i][datetime] = substr($row[writeday],0,10);

        //게시판 새글
        if(BetweenPeriod($row[writeday],"1") > 0) $bbslimit[$i][newimg] = "<img src='/bbs/images/new.gif' border='0' align='absmiddle' alt='' />";
        else $bbslimit[$i][newimg] = "";

        //링크 데이타
        $encode_str = "pagecnt=0&idx=".$row[idx]."&letter_no=&offset=";
        $encode_str.= "&search=".$search."&searchstring=".$searchstring;
        $encode_str.= "&Boardkey=".$row[code]."&Sub_No=".$row[sub_no]."&DBTable=".$board_table;
        $list_data=Encode64($encode_str);

        $bbslimit[$i][linkdata] = $list_data;

        //타입별 이미지경로
        if($board_type == 1){
            $bbslimit[$i][file_idx] = $row[file_idx];

            $fileencode_str = "Boardkey=".$board_code."&DBTable=".$board_table."&idx=".$row[file_idx]."&download=ok";
            $file_data=Encode64($fileencode_str);
            $bbslimit[$i][file_src] = "/bbs/imageview.php?image=thumnail&data=".$file_data;
            //$bbslimit[$i][file_src] = "/bbs/imageview.php?data=".$file_data;
        }else if($board_type == 2){
            $bbslimit[$i][file_src] = "/bbs/".$row[up_filename];

        }else{
            $bbslimit[$i][file_idx] = $row[file_idx];

            $fileencode_str = "Boardkey=".$board_code."&DBTable=".$board_table."&idx=".$row[file_idx]."&download=ok";
            $file_data=Encode64($fileencode_str);
            $bbslimit[$i][file_src] = "/bbs/imageview.php?image=thumnail&data=".$file_data;
        }


        //내용 출력시
        if($cut_content > 0){
            $bbs_content = str_replace("&nbsp;", "", $row[content]);
            $bbs_content = StringCut(trim(strip_tags($bbs_content)), $cut_content);
            $bbslimit[$i][content] = $bbs_content;

        }

    }

    return $bbslimit;
}

function getSendMail($to, $from, $subject, $message, $html)
{

    $to_exp   = explode('|', $to);
    $from_exp = explode('|', $from);

    $nameto = $to_exp[0];
    $to = $to_exp[1];
    $namefrom = $from_exp[0];
    $from = $from_exp[1];

    $message = stripcslashes($message);

    /*  your configuration here  */

    // 최종 업데이트 : 2011 07 04 : 엘지 유플러스 smtp 로 변경 (포트, 아이피 열음)

    $smtpServer = "아이피"; //ip accepted as well
    $port = "25"; // should be 25 by default
    $timeout = "30"; //typical timeout. try 45 for slow servers
    $username = "아이디"; //the login for your smtp
    $password = "패스워드"; //the pass for your smtp
    $localhost = "127.0.0.1"; //this seems to work always
    $newLine = "\r\n"; //var just for nelines in MS
    $secure = 0; //change to 1 if you need a secure connect


    /*
        $smtpServer = "smtp.cafe24.com"; //ip accepted as well
        $port = "587"; // should be 25 by default
        $timeout = "30"; //typical timeout. try 45 for slow servers
        $username = "hanwon@mytemple.co.kr"; //the login for your smtp
        $password = "201007"; //the pass for your smtp
        $localhost = "127.0.0.1"; //this seems to work always
        $newLine = "\r\n"; //var just for nelines in MS
        $secure = 0; //change to 1 if you need a secure connect
    */
//smtp 방식 way_nam :: 까페24의 smtp 를 활용하여 보냅니다. (대량메일에는 사용하면 안�?하루 발송제한있음)

    /*  you shouldn't need to mod anything else */

    //connect to the host and port
    $smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
    $smtpResponse = fgets($smtpConnect, 4096);
    if(empty($smtpConnect))
    {
        $output = "Failed to connect: $smtpResponse";
        return $output;
    }
    else
    {
        $logArray['connection'] = "Connected to: $smtpResponse";
    }

    //say HELO to our little friend
    fputs($smtpConnect, "HELO $localhost". $newLine);
    $smtpResponse = fgets($smtpConnect, 4096);
    $logArray['heloresponse'] = "$smtpResponse";

    //start a tls session if needed
    if($secure)
    {
        fputs($smtpConnect, "STARTTLS". $newLine);
        $smtpResponse = fgets($smtpConnect, 4096);
        $logArray['tlsresponse'] = "$smtpResponse";

        //you have to say HELO again after TLS is started
        fputs($smtpConnect, "HELO $localhost". $newLine);
        $smtpResponse = fgets($smtpConnect, 4096);
        $logArray['heloresponse2'] = "$smtpResponse";
    }

    //request for auth login
    fputs($smtpConnect,"AUTH LOGIN" . $newLine);
    $smtpResponse = fgets($smtpConnect, 4096);
    $logArray['authrequest'] = "$smtpResponse";

    //send the username
    fputs($smtpConnect, base64_encode($username) . $newLine);
    $smtpResponse = fgets($smtpConnect, 4096);
    $logArray['authusername'] = "$smtpResponse";

    //send the password
    fputs($smtpConnect, base64_encode($password) . $newLine);
    $smtpResponse = fgets($smtpConnect, 4096);
    $logArray['authpassword'] = "$smtpResponse";

    //email from
    fputs($smtpConnect, "MAIL FROM: $from" . $newLine);
    $smtpResponse = fgets($smtpConnect, 4096);
    $logArray['mailfromresponse'] = "$smtpResponse";

    //email to
    fputs($smtpConnect, "RCPT TO: $to" . $newLine);
    $smtpResponse = fgets($smtpConnect, 4096);
    $logArray['mailtoresponse'] = "$smtpResponse";

    //the email
    fputs($smtpConnect, "DATA" . $newLine);
    $smtpResponse = fgets($smtpConnect, 4096);
    $logArray['data1response'] = "$smtpResponse";

    //construct headers
    $headers = "MIME-Version: 1.0" . $newLine;
    $headers .= "Content-type: text/html; charset=euc-kr" . $newLine;
    $headers .= "To: $nameto <$to>" . $newLine;
    $headers .= "From: $namefrom <$from>" . $newLine;

    //observe the . after the newline, it signals the end of message
    fputs($smtpConnect, "To:<$to>\r\nFrom:$namefrom <$from>\r\nSubject: $subject\r\n$headers\r\n\r\n$message\r\n.\r\n");
    $smtpResponse = fgets($smtpConnect, 4096);
    $logArray['data2response'] = "$smtpResponse";

    // say goodbye
    fputs($smtpConnect,"QUIT" . $newLine);
    $smtpResponse = fgets($smtpConnect, 4096);
    $logArray['quitresponse'] = "$smtpResponse";
    $logArray['quitcode'] = substr($smtpResponse,0,3);
    fclose($smtpConnect);
    //a return value of 221 in $retVal["quitcode"] is a success
    return($logArray);
}

//오토링크
function url_auto_link($str)
{

    // 속도 향상 031011
    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_blank'>\\2</A>", $str);
    $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'>\\2</A>", $str);
    // 이메일 정규표현식 수정 061004
    //$str = preg_replace("/(([a-z0-9_]|\-|\.)+@([^[:space:]]*)([[:alnum:]-]))/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;
}


//페이지 이동함수
function ReFresh($href)
{
    echo("<meta http-equiv='Refresh' content='0; URL=$href'>");
}

function ReFresh_parent($href)
{
    echo("<meta http-equiv='Refresh' content='0; URL=$href' Target='_parent'>");

}

// move page to url
// @param string $url - web url
function redirect($url) {
    echo "<meta http-equiv='refresh' content='0; URL=".$url."'>";
    exit;
}

function go_back($msg) {
    echo "<script>\n";
    echo "alert(\"".$msg."\");\n";
    echo "history.go(-1);\n";
    echo "</script>\n";
    exit;
}

function goto_url($url)
{
    echo "<script language='JavaScript'> location.replace('$url'); </script>";
    exit;
}

function alert($msg) {
    str_replace('\\', '\\\\', $msg);
    echo "<script>\n";
    echo "alert(\"".$msg."\");\n";
    echo "</script>\n";
}

function MsgGo($Msg, $URL)
{
    echo"
		  <script language='javascript'>
		     alert('$Msg');
		     location.href = '$URL';
		  </script>
		  ";

    exit;
}

function MsgView($Msg,$go)
{
    echo"
		  <script language='javascript'>
		     alert('$Msg');
	         history.go($go);
		  </script>
	";
    exit;
    return true;
}

function MsgExit($Msg)
{
    echo"
		  <script language='javascript'>
		     alert('$Msg');
	         window.close();
		  </script>
	";
    exit;
    return true;
}

function OnlyMsgView($Msg)
{
    echo"
		  <script language='javascript'>
		     alert('$Msg');
		  </script>
		  ";
}


//$n 개의 문자열과 '...' 붙이기 함수
function StringCut($string,$n)  //$n : Cutting String Number
{
    if($n%2)
        $n++;
    $len=strlen($string);   //string length
    if($len<$n)
        return $string;
    else
    {
        $OneNextN=$n+1;
        $newstring=substr($string,0,$n);
        $total=0;
        for($i=0;$i<$n;$i++)
        {
            $asc=ord(substr($string,$i,1));
            if($asc>128)
                $total++;
        }
        if($total%2)
        {
            $newstring=substr($string,0,$OneNextN);
        }

        $newstring.="...";
        return $newstring;
    }
}


//$n 개의 문자열과 '...' 없는 함수
function OnlyCut($string,$n)  //$n : Cutting String Number
{
    if($n%2)
        $n++;
    $len=strlen($string);   //string length
    if($len<$n)
        return $string;
    else
    {
        $OneNextN=$n+1;
        $newstring=substr($string,0,$n);
        $total=0;
        for($i=0;$i<$n;$i++)
        {
            $asc=ord(substr($string,$i,1));
            if($asc>128)
                $total++;
        }
        if($total%2)
        {
            $newstring=substr($string,0,$OneNextN);
        }
        return $newstring;
    }
}

// 디렉토리정보 로드
function get_dir_list($dir)
{
    $result_array = array();

    $dirname = $dir;
    $handle = opendir($dirname);
    while ($file = readdir($handle))
    {
        if($file == "."||$file == "..") continue;

        if (is_dir($dirname.$file)) $result_array[] = $file;

    }
    closedir($handle);
    sort($result_array);

    return $result_array;
}


function get_file_list($path, $arr=array()){
    $dir = opendir($path);
    while($file = readdir($dir)){
        if($file == '.' || $file == '..'){
            continue;
        }else if(is_dir($path.'/'.$file)){
            $arr = get_file_list($path.'/'.$file, $arr);
        }else{
            $arr[] = $path.'/'.$file;
        }

    }
    closedir($dir);
    return $arr;
}

//Post, Get방식으로 넘어온 값 쿼리로 변환
function setQuery ($arr, $str) {
    $r_str = '';

    // $arr : $_POST 혹은 $_GET, 배열 반복
    foreach ($arr as $key=>$val) {

        // input name 이 지정한 문자열로 시작되면 적용 하고 그 문자열은 삭제
        //if (@ereg ("^$str", $key)) { // php 5.3이후 디프레케이트 6.0부터삭제
        if(preg_match("/^$str/", $key)) {

            //$key = @ereg_replace ("^$str", "", $key);  // php 5.3이후 디프레케이트 6.0부터삭제
            $key = preg_replace ("/^$str/", "", $key);

            // 문자열을 제거한 키값이 아직 존재하면 리턴해줄 문자열에 연결합니다.
            // 처음은 xxx = 'xxx' 로 두번째 부터는 ,xxx = 'xxx'로 이어줍니다.
            if (!empty($key)) {
                if (!empty($r_str)) {
                    $r_str .= ', ';
                }

                $r_str .= "${key} = '${val}'";
            }
        }
    }

    return $r_str;
}

/********  2007.03. 14 추가 함수 End *****************/
// 파일 사이즈를 kb, mb에 맞추어서 변환해서 리턴
function getfilesize($size) {
    if(!$size) return "0 Byte";
    if($size<1024) {
        return ($size." Byte");
    } elseif($size >1024 && $size< 1024 *1024)  {
        return sprintf("%0.1f KB",$size / 1024);
    }
    else return sprintf("%0.2f MB",$size / (1024*1024));
}

function QStr($str) {
    $qstr = str_replace("'","''",$str);
    return $qstr;
}

// @param string $path - file or directory path
function get_file_perm($path) {
    return substr(sprintf("%o", fileperms($path)),-3);
}

// @param string $str - string formated html
function del_tag($str) {
    $str = str_replace(">", "&gt;", $str);
    $str = str_replace("<", "&lt;", $str);
    return $str;
}

// @param char $value - null return false;
function return_bit($value) {
    $bit = ($value) ? 1 : 0;
    return $bit;
}

// @param integer $num
// @param integer $size
function mk_num($num, $size) {
    if(strlen($num) < $size) {
        $plus = $size - strlen($num);
        for($i=0; $i<$plus; $i++) {
            $num = '0'.$num;
        }
    }
    return $num;
}

// @param array $ar
// @param char $ch
function array_to_str($ar, $ch) {
    for($i=0; $i<count($ar); $i++) {
        $str .= ($i==count($ar)-1) ? $ar[$i] : $ar[$i].$ch;
    }
    return $str;
}

// return file extension
// @param string $file_name
function get_ext($file_name) {
    $tmp = explode(".", $file_name);
    $ext = $tmp[count($tmp)-1];
    return $ext;
}

// return whether it is true or not
// @param string $email - email address
function is_email($email) {
    $url = trim($email);
    if(eregi("^[\xA1-\xFEa-z0-9._-]+@[\xA1-\xFEa-z0-9_-]+\.[a-z0-9._-]+$", $url)) return true;
    else return false;
}


// @param int $size - file size from byte
function convert_size($size) {
    if(!$size) return "0 Byte";
    if($size<1024) {
        return ($size." Byte");
    } elseif($size >1024 && $size< 1024 * 1024)  {
        return sprintf("%0.1f KB",$size / 1024);
    } else {
        return sprintf("%0.2f MB",$size / (1024 * 1024));
    }
}

// @param string $str
function auto_link($str) {
    $homepage_pattern = "/([^\"\'\=\>])(mms|http|HTTP|ftp|FTP|telnet|TELNET)\:\/\/(.[^ \n\<\"\']+)/";
    $str = preg_replace($homepage_pattern,"\\1<a href=\\2://\\3 target=_blank>\\2://\\3</a>", " ".$str);
    return $str;
}

function cut_str($string, $cut, $jum='') {
    if (!$string || strlen($string)<=$cut) return $string;
    $fstr = preg_replace("/(([\x80-\xff].)*)[\x80-\xff]?$/", "\\1", substr($string,0,$cut));
    $fstr = ($jum == '') ? $fstr . '...' : $fstr;
    return $fstr;
}


/********  2007.03. 14 추가 함수 Start ***************/
// Get 방식 변수 암호화 함수
function Encode64($data)
{
    //global $EncoderKey;
    //$data = rand_str(5, 0).$data.rand_str(3, 0)

    //return base64_encode($data.$EncoderKey);
    return base64_encode($data)."||";
}

// Get방식으로 넘어온 변수를 Decode하는 함수
function Decode64($sending_data){

    //global $EncoderKey;

    $vars=explode("&",base64_decode(str_replace("||","",$sending_data)));
    //$vars=explode("&",base64_decode(str_replace($EncoderKey,"",$sending_data)));

    $vars_num=count($vars);
    for($i=0;$i<$vars_num;$i++){
        $elements=explode("=",$vars[$i]);
        $var[$elements[0]]=$elements[1];
        //echo " $elements[0] = $elements[1] <br> ";
    }
    return $var;
}


/*
 * 랜덤 문자열 생성(인수 : 길이, 타입)
 * 지정된 타입의 문자열로 지정된 길이의 랜덤 문자열을 반환한다.
 * 타입 0 : 영문 대소문자(A-Z,a-z), 숫자(0-9)
 * 타입 1 : 영문 대문자(A-Z), 숫자(0-9)
 * 타입 2 : 영문 소문자(a-z), 숫자(0-9)
 * 타입 3 : 영문 대문자(A-Z)
 * 타입 4 : 영문 소문자(a-z)
 * 타입 5 : 숫자(0-9)
 * 디폴트 : false 반환.
*/
function rand_str($length, $type)
{
    switch($type){
        case 0:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
            break;
        case 1:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            break;
        case 2:
            $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
            break;
        case 3:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 4:
            $chars = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 5:
            $chars = '1234567890';
            break;
        default:
            return false;
    }
    $chars_length = (strlen($chars) - 1);
    $string = '';
    for ($i = 0; $i < $length; $i = strlen($string)){
        $string .= $chars{rand(0, $chars_length)};
    }
    return $string;
}

//====================== 페이지 나누기 ======================//
function pageLink($args) {
    //if($args['total_row'] == 0) $args['total_row'] = 1;
    //print_r($args);
    $tp = @floor(($args['total_row']-1)/$args['row_num'] +1 ); //(TotalPage)전체 페이지 수
    if($tp == 0) $tp = 1;
    $sp = (floor(($args['p']-1)/$args['page'])) * $args['page'] + 1; //페이지 숫자 표시 --> 시작
    $ep = $sp + $args['page']; //페이지 숫자 표시 --> 끝
    //echo $tp;

    if($tp < $ep) { //나타낼 리스트 페이지 수가 기본 페이지 표시 수보다 작을 경우
        $ep = $tp + 1;
        $disable_next = 1;
    }
    //$prev ;
    //$prev = $sp - 1;
    $prev = $sp - ($args['page']);	// 이전 페이지 리스트 제일 첫페이지로 가도록 수정(2005.05.18 김창근)
    $next = $sp + $args['page'];
    if($sp != 1) {
        $_prev = $args['url'] . '?' .$args['param']."&p=".$prev;
    }

    if($args['p'] != '1') {
        $go_back = $args['url'] . '?' .$args['param']."&p=".($args['p'] - 1);
    }

    for($i=$sp; $i<$ep; $i++)
    {
        if($i==$args['p']) {
            $page_link[] = array(
                'p'	=> $i,
                'get'	=> ''
            );
        } else {
            $page_link[] = array(
                'p'	=> $i,
                'get'	=> $args['url'] . '?' .$args['param']."&p=".$i
            );
        }
    }

    if(!$disable_next) {
        $_next .= $args['url'] . '?' .$args['param']."&p=".$next;
    }

    if($args['p'] != $tp) {
        $go_next = $args['url'] . '?' .$args['param']."&p=".($args['p'] + 1);
    }
    $page = array (
        'back'		=> $go_back,
        'prev'		=> $_prev,
        'link'	=> $page_link,
        'next'		=> $_next,
        'go'		=> $go_next
    );


    return $page;
}

function script($script) {	// 자바스크립트 실행, 배열이 들어오면 일일이 실행
    echo "<script>\n";
    if(is_array($script)) {
        for($i=0; $i<count($script); $i++) {
            echo $script[$i]."\n";
        }
    } else {
        echo $script."\n";
    }
    echo '</script>'."\n";;
}


//현재시간과 특정일 사이의 기간
function BetweenPeriod($datetime,$periodDay)
{//2003-02-19 11:32:15
    $now = time();
    $timeArr= explode(":",substr($datetime,11,8));
    $dayArr	= explode("-",substr($datetime,0,10));

    $mktime = mktime($timeArr[0],$timeArr[1],$timeArr[2],$dayArr[1],$dayArr[2],$dayArr[0]);
    $period	= $periodDay*24*60*60;		//기간계산

    if($now >$mktime && $now < ($mktime+$period))
        return 1;
    else if( ($mktime-$period) <$now && $now <$mktime)
        return -1;
    else
        return 0;
}

// 계층형 차트 만들기 함수 .. 재귀함수
/*
function mk_tree($chart_no='') {
	global $xdb, $tree_table;
	if($chart_no == '') {
		$sql = "Select * From $tree_table where DEPTH=1 order by order_no asc";
	} else {
		$sql = "Select * From $tree_table Where TREE_NO!=$chart_no AND PARENT=$chart_no order by ORDER_NO asc";	}

	$res = $xdb->query($sql);
	//print_r($res);
	for($i=0; $row = $res->fetchRow(DB_FETCHMODE_ASSOC); $i++) {
		$chart[] = array(
			'no'		=> $row['TREE_NO'],
			'parent'	=> $row['PARENT'],
			'depth'		=> $row['DEPTH'],
			'name'		=> $row['NAME']
		);

		//if($row['tree_type'] == 1) {
			$return_array = mk_chart($row['TREE_NO']);
			if(is_array($return_array)) $chart = array_merge($chart, $return_array);
		//}
	}
	//print_r($chart);
	return $chart;
}
*/

#-----------------------------------------------------------------------------
# @Function 명    : readHtml
# @역할           : HMTL화일을 읽어 변수에 할당
# @parameter
#		$readfile   	: 읽을 화일명
# @Return         : 읽은 화일의 문자열
#-----------------------------------------------------------------------------
function readHtml($readfile)
{
    if( file_exists($readfile) )
    {
        $fobj = fopen($readfile,"r");
        $temStr = fread($fobj,filesize($readfile));
        fclose($fobj);
        return $temStr;
    }
    else
    {
        $rtStr = "<h1>Warning</h1><hr>읽을 화일이 없거나 화일명이 잘못 지정되었습니다.";
        $rtStr .= "<br>화일명을 확인하십시오!";
        $rtStr .= "<hr><font color=red>$readfile</font>";
        return $rtStr;
    }
}
#-----------------------------------------------------------------------------
# @Function 명    : tag2str
# @역할           : tag를 생성한 문자열로 치환
# @parameter
#		$srcStr   	  : 원본 문자열
#		$tagStr   	  : 변환할 tag 명
#		$changeStr   	: 변환할 문자열
# @Return         : 변환한 문자열
#-----------------------------------------------------------------------------
function tag2str_1($srcStr,$tagStr,$changeStr)
{
    $strlen = strlen($srcStr);
    $taglen = strlen($tagStr);
    $pos = strpos($srcStr,$tagStr);
    if( $pos )
    {
        $prevTagStr = substr($srcStr,0,$pos);
        $nextTagStr = substr($srcStr,$pos + $taglen,$strlen - $pos - $taglen);
        return $prevTagStr . $changeStr . $nextTagStr ;
    }
    else
    {
        return $srcStr;
    }
}
#-----------------------------------------------------------------------------
# @Function 명    : tag2str
# @역할           : tag를 생성한 문자열로 치환
# @parameter
#		$srcStr   	  : 원본 문자열
#		$tagStr   	  : 변환할 tag 명
#		$changeStr   	: 변환할 문자열
# @Return         : 변환한 문자열
#-----------------------------------------------------------------------------
function tag2str($srcStr,$tagStr,$changeStr)
{
    $strlen = strlen($srcStr);
    $taglen = strlen($tagStr);
    $pos = strpos($srcStr,$tagStr);

    if( $pos != "" )
    {
        $prevTagStr = substr($srcStr,0,$pos);
        $nextTagStr = substr($srcStr,$pos + $taglen,$strlen - $pos - $taglen);
        $srcStr = $prevTagStr . $changeStr . $nextTagStr;
        $srcStr = tag2str($srcStr,$tagStr,$changeStr) ;

    }

    return $srcStr;
}
#-----------------------------------------------------------------------------
# @Function 명    : initHtmlTable
# @역할           : HTML의 테이블을 초기화
# @parameter
#		$html_ini   	: 초기화할 테이블설정화일
# @Return         : html_table,html_t1,html_2를 전역변수로 할당
#-----------------------------------------------------------------------------
function initHtmlTable($html_ini)
{
    global $html_table,$html_t1,$html_t2;
    $htmlStr = trim(readHtml($html_ini));

    for($i=0;$i<3;$i++)
    {
        $astriquePos = strpos($htmlStr,"*");
        $tempStr = trim(substr($htmlStr,0,$astriquePos));
        $spareStr = trim(substr($htmlStr,$astriquePos+1,strlen($htmlStr)-$astriquePos));
        $equalPos = strpos($tempStr,"=");

        $name = trim(substr($tempStr,0,$equalPos));
        $value = trim(substr($tempStr,$equalPos+1,strlen($tempStr) - $equalPos));

        switch($i)
        {
            case 0:
                $html_table = $value;
                break;
            case 1:
                $html_t1 = $value;
                break;
            case 2:
                $html_t2 = $value;
                break;
        }
        $htmlStr = $spareStr;
    }
}
#-----------------------------------------------------------------------------
# @Function 명    : Thumnail
# @역할           : 썸네일 이미지 만들기
#-----------------------------------------------------------------------------
//썸네일 function
function Thumnail($file, $save_filename, $save_path, $max_width, $max_height)
{
    $img_info = getImageSize($file);
    if($img_info[2] == 1)
    {
        $src_img = ImageCreateFromGif($file);
    }elseif($img_info[2] == 2){
        $src_img = ImageCreateFromJPEG($file);
    }elseif($img_info[2] == 3){
        $src_img = ImageCreateFromPNG($file);
    }else{
        return 0;
    }
    $img_width = $img_info[0];
    $img_height = $img_info[1];


    /*
    while ($img_width > $max_width || $img_height > $max_height)
    {
        if ($img_width > $max_width)
        {
            $temp = $img_width;
            $img_width = $max_width;
            $img_height = ceil(($max_width / $temp) * $img_height);
        }

        if ($img_height > $max_height)
        {
            $temp = $img_height;
            $img_height = $img_height;
            $img_height = ceil(($max_height / $temp) * $img_height);
        }
    }
    */



    if($img_width > $max_width || $img_height > $max_height)
    {
        if($img_width == $img_height)
        {
            $dst_width = $max_width;
            $dst_height = $max_height;
        }elseif($img_width > $img_height){
            $dst_width = $max_width;
            $dst_height = ceil(($max_width / $img_width) * $img_height);
        }else{
            $dst_height = $max_height;
            $dst_width = ceil(($max_height / $img_height) * $img_width);
        }
    }else{
        $dst_width = $img_width;
        $dst_height = $img_height;
    }
    if($dst_width < $max_width) $srcx = ceil(($max_width - $dst_width)/2); else $srcx = 0;
    if($dst_height < $max_height) $srcy = ceil(($max_height - $dst_height)/2); else $srcy = 0;

    if($img_info[2] == 1)
    {
        $dst_img = imagecreate($max_width, $max_height);
    }else{
        $dst_img = imagecreatetruecolor($max_width, $max_height);
    }

    $bgc = ImageColorAllocate($dst_img, 255, 255, 255);
    ImageFilledRectangle($dst_img, 0, 0, $max_width, $max_height, $bgc);
    ImageCopyResampled($dst_img, $src_img, $srcx, $srcy, 0, 0, $dst_width, $dst_height, ImageSX($src_img),ImageSY($src_img));

    if($img_info[2] == 1)
    {
        ImageInterlace($dst_img);
        ImageGif($dst_img, $save_path.$save_filename);
    }elseif($img_info[2] == 2){
        ImageInterlace($dst_img);
        ImageJPEG($dst_img, $save_path.$save_filename, 85);
    }elseif($img_info[2] == 3){
        ImagePNG($dst_img, $save_path.$save_filename);
    }
    ImageDestroy($dst_img);
    ImageDestroy($src_img);
}

function imgResize($file_path,$file,$max_w,$max_h){
    $img_info = getImageSize($file_path);
    $img_width = $img_info[0];
    $img_height = $img_info[1];

    $w = $img_width + 20;
    $h = $img_height + 20;

    if($img_width >= $img_height && $img_width >= $max_w)
        $img = "<img src='$file' width=$max_w style='cursor:hand;' onClick=open('$file','img','width=$w,height=$h')>";
    elseif($img_height >= $img_width && $img_height >= $max_h)
        $img = "<img src='$file' height=$max_h style='cursor:hand;' onClick=open('$file','img','width=$w,height=$h')>";
    else
        $img = "<img src='$file' style='cursor:hand;' onClick=open('$file','img','width=$w,height=$h')>";

    return $img;
}

// 메일전송함수
function mailsend($fromname,$frommail,$tomail,$subject,$msg){
    $headers = "Return-Path: <".$frommail.">\n";
    $headers .= "From: ".$fromname." <".$frommail.">\n";
    $headers .= "X-Sender: <".$frommail.">\n";
    $headers .= "X-Mailer: PHP\n"; // mailer
    $headers .= "X-Priority: 1\n"; // Urgent message!

    // 에러 발생시 반송 주소
    $headers .= "Reply-To: ".$fromname." <".$frommail.">\n";
    $headers .= "MIME-Version: 1.0\n";

    $result = @mail($tomail,$subject,$msg, $headers);
    return $result;
}

function mailsend24($fromname,$frommail,$toname,$tomail,$subject,$msg,$mode){
    $post_data = "toemail=" . urlencode($toname . " <". $tomail . ">");
    $post_data.= "&subject=" . urlencode($subject);
    $post_data.= "&fromemail=" . urlencode($fromname." <".$frommail.">");
    $post_data.= "&content=" . urlencode($msg);


    if($mode==0)
        $header = "POST /sendmail.asp HTTP/1.1\r\n";
    else
        $header = "POST /sendmail_html.asp HTTP/1.1\r\n";
    $header.= "Host: intra.adbank.co.kr\r\n";
    $header .= 'Content-Type: application/x-www-form-urlencoded'."\r\n";
    $header .= 'Connection: close'."\r\n";	// KeepAlive를 허용하지 않음
    $header .= 'Content-Length: ' . strlen($post_data) . "\r\n\r\n";
    $header = $header.$post_data;

    $client_socket = fsockopen("211.175.207.24", 80, &$errno, &$errmsg);
    fwrite($client_socket, $header);
    fclose($client_socket);
}

/********  2007.03. 14 추가 함수 End *****************/
// 파일 사이즈를 kb, mb에 맞추어서 변환해서 리턴
function get_filesize_size($size) {
    if(!$size) return "0 Byte";

    if($size >= 1073741824) {
        $size = sprintf("%0.3f GB",$size / 1073741824);
    } elseif($size >= 1048576) {
        $size = sprintf("%0.2f MB",$size / 1048576);
    } elseif($size >= 1024)  {
        $size = sprintf("%0.1f KB",$size / 1024);
    } else {
        $size = $size." Byte";
    }

    return $size;
}


// 페이지 컷◀ 1 [2][3][4][5] ▶
class PList
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
    function PList($pagename,$pagecnt,$offset,$numrows,$pageblock,$limit,$search,$searchstring,$option){

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

        if ( preg_match("|recruit|", $this->g_pageName) > 0 ) {
            $offset_separate = "&";
        } else {
            $offset_separate = "?";
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

        $lastpagecnt = ceil(($this->g_numRows / $this->g_limit / $this->g_pageBlock)-1);
        $lastt = ceil($this->g_numRows / $this->g_limit);
        $lastoffset = ($lastt*$this->g_limit)-$this->g_limit;
        $lastletter_no=$this->g_numRows-(($lastt-1)*$this->g_limit);


        /*   처음   */
        $data="search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
        if($this->g_pniView)
            echo "<a href=".$this->g_pageName.$offset_separate.$data.">".$this->g_fIcon."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";



        /*    이전   */
        if($this->g_pageCnt>0){				//이전페이지 있음
            $prepage=$this->g_pageCnt-1;	//이전블럭 시작페이지 설정.
            $pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//이전블럭 시작글 번호 설정
            $data="pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

            $pre_str ="<a href='".$this->g_pageName.$offset_separate.$data."'>".$this->g_pIcon."</a>&nbsp;";

            echo "$pre_str"; 	//이전아이콘 링크
        }else{					//이전페이지 없음
            if($this->g_pniView)//아이콘 표시
                $empty_pre_str = $this->g_pIcon."&nbsp;";

            else				//아이콘 비표시
                $empty_pre_str = "&nbsp;";

            echo "$empty_pre_str";
        }




        /*    1개 이전   */
        $p1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)-$this->g_limit;
        $p1letter_no=$this->g_numRows-$p1offset;


        if($onstepcheck == 0)	$p1pageCnt = $this->g_pageCnt-1;
        else					$p1pageCnt = $this->g_pageCnt;

        $data="offset=".$p1offset."&letter_no=".$p1letter_no."&pagecnt=".$p1pageCnt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($p1offset >= 0){
            if($this->g_pniView) echo "&nbsp;<a href=".$this->g_pageName.$offset_separate.$data.">".$this->g_p1Icon."</a>&nbsp;";
        }else{
            if($this->g_pniView) echo "&nbsp;".$this->g_p1Icon."&nbsp;";
        }



        /* 1 [2][3][4][5] */
        $l=0;
        while($l<$pCnt){
            $loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//시작글 지정
            $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//페이지 번호 설정
            $cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//시작글 번호 지정
            $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
            $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $data=$en_str;
            if($lnum==(($this->g_offset/$this->g_limit)+1))	{//현재 페이지 일 경우
                echo " <font size='2'><b>$lnum</b></font> ";
            }else{
                $mid_str = " <span class='nort'>[<a href='".$this->g_pageName.$offset_separate.$data."'>".$lnum."</a>]</span> ";

                echo"$mid_str";
            }
            $l++;
        }




        /*    1개 다음   */
        $n1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)+$this->g_limit;
        $n1letter_no=$this->g_numRows+$n1offset;


        if($onstepcheck == 9)	$n1pageCnt = $this->g_pageCnt+1;
        else					$n1pageCnt = $this->g_pageCnt;

        $data="offset=".$n1offset."&letter_no=".$n1letter_no."&pagecnt=".$n1pageCnt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($n1offset <= $lastoffset){
            if($this->g_pniView) echo "&nbsp;<a href=".$this->g_pageName.$offset_separate.$data.">".$this->g_n1Icon."</a>&nbsp;";
        }else{
            if($this->g_pniView) echo "&nbsp;".$this->g_n1Icon."&nbsp;";
        }




        /*    다음   */
        if($this->g_pageCnt!=$chekpage){		//다음페이지 있음
            echo "&nbsp;";
            $newpagecnt=$this->g_pageCnt+1;		//다음 블럭 시작페이지 설정
            $newt=$cu_letter_no-$this->g_limit;	//다음 블럭 시작글 번호 설정
            $data="pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $next_str="<a href='".$this->g_pageName.$offset_separate.$data."'>".$this->g_nIcon."</a>";

            echo $next_str;			//다음 아이콘 링크
        }else{						//다음페이지 없음
            if($this->g_pniView)	//아이콘 표시
                echo"&nbsp;".$this->g_nIcon;
            //echo"&nbsp;";

            else					//아이콘 비표시
                echo"&nbsp;";
        }


        /*   마지막   */
        $data="pagecnt=".$lastpagecnt."&letter_no=".$lastletter_no."&offset=".$lastoffset."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($this->g_pniView) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$this->g_pageName.$offset_separate.$data."&".$this->g_option."'>".$this->g_lIcon."</a>";

    }//function putList()
}//class



// 페이지 컷◀ 1 [2][3][4][5] ▶
class SList
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
    // SList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
    // SList(페이지명, 현재페이지번호, DB시작offset, 총게시물수, 블럭당페이지수, 페이지당게시물수, 검색컬럼, 검색어, 추가get값)
    //
    function SList($pagename,$pagecnt,$offset,$numrows,$pageblock,$limit,$search,$searchstring,$option){
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
    // putList( 링크되지 않은 아이콘 표시 여부, 이전아이콘, 다음아이콘
    //
    function putList($pniView,$pre_icon,$next_icon){
        $this->g_pniView=$pniView;					//링크되지 않은 아이콘 표시 여부
        if(empty($pre_icon))	$this->g_pIcon="[이전 ".$this->g_pageBlock."개]";			//이전 아이콘 설정
        else			$this->g_pIcon=$pre_icon;

        if(empty($next_icon))	$this->g_nIcon="[다음 ".$this->g_pageBlock."개]";			//다음 아이콘 설정
        else			$this->g_nIcon=$next_icon;

        $this->pniPrint(); //화면 출력
    }
    //
    // 화면 출력
    //
    function pniPrint(){
        /*    이전   */
        if($this->g_pageCnt>0){				//이전페이지 있음
            $prepage=$this->g_pageCnt-1;	//이전블럭 시작페이지 설정.
            $pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//이전블럭 시작글 번호 설정
            $data="pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring;

            $pre_str ="<a href='".$this->g_pageName."?".$data;
            if(!empty($this->g_option))
                $pre_str.="&".$this->g_option;
            $pre_str.="'>".$this->g_pIcon."</a>&nbsp;&nbsp;&nbsp;";

            echo "$pre_str"; 	//이전아이콘 링크
        }else{					//이전페이지 없음
            if($this->g_pniView)//아이콘 표시
                $empty_pre_str = $this->g_pIcon."&nbsp;&nbsp;";
            else				//아이콘 비표시
                $empty_pre_str = "&nbsp;&nbsp;";

            echo "$empty_pre_str";
        }

        /* 1 [2][3][4][5] */
        $chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //현제페이지 체크

        if($chekpage==$this->g_pageCnt){  //마지막 블럭일 경우....
            $pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //마지막 블럭 페이지수 계산
            if(!($this->g_numRows%($this->g_limit))){
                $pCnt--;
            }
        }else{
            $pCnt=$this->g_pageBlock;
        }

        $l=0;
        while($l<$pCnt){
            $loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//시작글 지정
            $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//페이지 번호 설정
            $cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//시작글 번호 지정
            $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
            $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring;
            $data=$en_str;

            if($l != 0 ) echo " | ";

            if($lnum==(($this->g_offset/$this->g_limit)+1))	//현재 페이지 일 경우
                echo" <font size='2' color='#FF9900'><b>$lnum</b></font> ";
            else{
                $mid_str = " <a href='".$this->g_pageName."?".$data;
                if(!empty($this->g_option))
                    $mid_str.="&".$this->g_option;
                $mid_str.="'><font color='#FFFFFF'>".$lnum."</font></a> ";

                echo"$mid_str";
            }
            $l++;
        }

        /*    다음   */
        if($this->g_pageCnt!=$chekpage){		//다음페이지 있음
            echo "&nbsp;&nbsp;&nbsp;";
            $newpagecnt=$this->g_pageCnt+1;		//다음 블럭 시작페이지 설정
            $newt=$cu_letter_no-$this->g_limit;	//다음 블럭 시작글 번호 설정
            $data="pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring;
            $next_str="<a href='".$this->g_pageName."?".$data;
            if(!empty($this->g_option))
                $next_str.="&".$this->g_option;
            $next_str.="'>".$this->g_nIcon."</a>";

            echo $next_str;			//다음 아이콘 링크
        }else{						//다음페이지 없음
            if($this->g_pniView)	//아이콘 표시
                echo"&nbsp;&nbsp;".$this->g_nIcon;
            else					//아이콘 비표시
                echo"&nbsp;&nbsp;";
        }
    }//function putList()
}//class

// 페이지 컷◀ 1 [2][3][4][5] ▶
class RList
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
    function RList($pagename,$pagecnt,$offset,$numrows,$pageblock,$limit,$search,$searchstring,$option,$search_major){

        $this->g_pageName		= $pagename;
        $this->g_pageCnt		= $pagecnt;
        $this->g_offset			= $offset;
        $this->g_numRows		= $numrows;
        $this->g_pageBlock		= $pageblock;
        $this->g_limit			= $limit;
        $this->g_search			= $search;
        $this->g_searchstring	= $searchstring;
        $this->g_option			= $option;
        $this->g_search_major = $search_major;
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

        if ( preg_match("|recruit|", $this->g_pageName) > 0 ) {
            $offset_separate = "&";
        } else {
            $offset_separate = "?";
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

        $lastpagecnt = ceil(($this->g_numRows / $this->g_limit / $this->g_pageBlock)-1);
        $lastt = ceil($this->g_numRows / $this->g_limit);
        $lastoffset = ($lastt*$this->g_limit)-$this->g_limit;
        $lastletter_no=$this->g_numRows-(($lastt-1)*$this->g_limit);


        /*   처음   */
        $data="search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
        if($this->g_pniView)
            echo "<a href=".$this->g_pageName.$offset_separate.$data.">".$this->g_fIcon."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";



        /*    이전   */
        if($this->g_pageCnt>0){				//이전페이지 있음
            $prepage=$this->g_pageCnt-1;	//이전블럭 시작페이지 설정.
            $pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//이전블럭 시작글 번호 설정
            $data="pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

            $pre_str ="<a href='".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major."'>".$this->g_pIcon."</a>&nbsp;";

            echo "$pre_str"; 	//이전아이콘 링크
        }else{					//이전페이지 없음
            if($this->g_pniView)//아이콘 표시
                $empty_pre_str = $this->g_pIcon."&nbsp;";

            else				//아이콘 비표시
                $empty_pre_str = "&nbsp;";

            echo "$empty_pre_str";
        }




        /*    1개 이전   */
        $p1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)-$this->g_limit;
        $p1letter_no=$this->g_numRows-$p1offset;


        if($onstepcheck == 0)	$p1pageCnt = $this->g_pageCnt-1;
        else					$p1pageCnt = $this->g_pageCnt;

        $data="offset=".$p1offset."&letter_no=".$p1letter_no."&pagecnt=".$p1pageCnt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($p1offset >= 0){
            if($this->g_pniView) echo "&nbsp;<a href=".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major.">".$this->g_p1Icon."</a>&nbsp;";
        }else{
            if($this->g_pniView) echo "&nbsp;".$this->g_p1Icon."&nbsp;";
        }



        /* 1 [2][3][4][5] */
        $l=0;
        while($l<$pCnt){
            $loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//시작글 지정
            $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//페이지 번호 설정
            $cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//시작글 번호 지정
            $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
            $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $data=$en_str;
            if($lnum==(($this->g_offset/$this->g_limit)+1))	{//현재 페이지 일 경우
                echo " <font size='2'><b>$lnum</b></font> ";
            }else{
                $mid_str = " <span class='nort'>[<a href='".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major."'>".$lnum."</a>]</span> ";

                echo"$mid_str";
            }
            $l++;
        }




        /*    1개 다음   */
        $n1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)+$this->g_limit;
        $n1letter_no=$this->g_numRows+$n1offset;


        if($onstepcheck == 9)	$n1pageCnt = $this->g_pageCnt+1;
        else					$n1pageCnt = $this->g_pageCnt;

        $data="offset=".$n1offset."&letter_no=".$n1letter_no."&pagecnt=".$n1pageCnt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($n1offset <= $lastoffset){
            if($this->g_pniView) echo "&nbsp;<a href=".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major.">".$this->g_n1Icon."</a>&nbsp;";
        }else{
            if($this->g_pniView) echo "&nbsp;".$this->g_n1Icon."&nbsp;";
        }




        /*    다음   */
        if($this->g_pageCnt!=$chekpage){		//다음페이지 있음
            echo "&nbsp;";
            $newpagecnt=$this->g_pageCnt+1;		//다음 블럭 시작페이지 설정
            $newt=$cu_letter_no-$this->g_limit;	//다음 블럭 시작글 번호 설정
            $data="pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $next_str="<a href='".$this->g_pageName.$offset_separate.$data."'>".$this->g_nIcon."</a>";

            echo $next_str;			//다음 아이콘 링크
        }else{						//다음페이지 없음
            if($this->g_pniView)	//아이콘 표시
                echo"&nbsp;".$this->g_nIcon;
            //echo"&nbsp;";

            else					//아이콘 비표시
                echo"&nbsp;";
        }


        /*   마지막   */
        $data="pagecnt=".$lastpagecnt."&letter_no=".$lastletter_no."&offset=".$lastoffset."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($this->g_pniView) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$this->g_pageName.$offset_separate.$data."&".$this->g_option."'>".$this->g_lIcon."</a>";

    }//function putList()
}//class


function show_data($colu){
    if($colu){
        $str = $colu;
    }else{
        $str = " ";
    }
    return $str;
}



// 쿠키변수 생성
function set_cookie($cookie_name, $value, $expire)
{
    setcookie(md5($cookie_name), base64_encode($value), time() + $expire, '/', $way['cookie_domain']);
}


// 쿠키변수값 얻음
function get_cookie($cookie_name)
{
    return base64_decode($_COOKIE[md5($cookie_name)]);
}
?>