<?php

function iconv8($string){
	return iconv("euc-kr","utf-8", $string);
}

//CMS function
function cms_view($cms_id){
	
	if(empty($cms_id))	echo "<div style=' text-align:center; padding:100px 0; '>CMS ÄÚµå°¡ ¾ø½À´Ï´Ù.</div>";

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
		            <p class="page_h"><img src="/make_img/page/txt1.gif" width="115" height="22" alt="ÆäÀÌÁö´ã´çÀÚ ¾È³»ÀÔ´Ï´Ù."></p> 
		            <ul class="page_table"> 
		              <li class="page_bn1"><img src="/make_img/page/o.gif" width="16" height="13"><strong>´ã´çÀÚ</strong> :
		                 '.$damdang_name.'
		              </li> 
		              <li class="page_bn2"><img src="/make_img/page/o.gif" width="16" height="13"><strong>ÀüÈ­¹øÈ£</strong> :
		                 '.$damdang_tel.'
		              </li> 
		              <li class="page_bn3"><img src="/make_img/page/o.gif" width="16" height="13"><strong>ÃÖ±Ù¾÷µ¥ÀÌÆ®</strong> :
		                '.$cms_date.'
		              </li> 
		              <li class="page_bn4"><a href="javascript:cms_bookmarksite()"><img src="/make_img/page/add_btn.gif" alt="Áñ°ÜÃ£±â" width="68" height="18"></a><a href="javascript:print();"><img src="../../make_img/page/print_btn.gif" alt="ÇÁ¸°Æ®" width="72" height="18"></a></li> 
		            </ul> 
		          </div> 
		        </div> 
		        
	
	*/

		$cms_copy = '
				<!-- ÆäÀÌÁö ´ã´çÀÚ¾È³» -->
				 <div class="fdata_wrap"> 
		          <dl> 
		             <dt><img src="/make_img/page/txt1.gif" alt="ÆäÀÌÁö´ã´çÀÚ ¾È³»ÀÔ´Ï´Ù."/></dt> 
		             <dd> 
		              <ul> 
		                 <li><span class="ctit">´ã´çÀÚ : </span><span class="ctxt">'.$damdang_name.'</span></li> 
		                 <li><span class="ctit">ÀüÈ­¹øÈ£ : </span><span class="ctxt">'.$damdang_tel.'</span></li> 
		                 <li class="last"><span class="ctit">ÃÖ±Ù¾÷µ¥ÀÌÆ® : </span><span class="ctxt">'.$cms_date.'</span></li> 
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
			var title = "ÃáÇØº¸°Ç´ëÇÐ±³-'.$CMS[cms_name].'";
		 
			if (window.sidebar && window.sidebar.addPanel){
				window.sidebar.addPanel(sidebartitle, sidebarurl,"");
			} 
			else if ( document.all ) {
				window.external.AddFavorite(url, title); 
			}
			else if (window.opera && window.print) {
				
			}
			else if (navigator.appName=="Netscape") {
				alert("<Ctrl+D>¸¦ ÀÔ·ÂÇÏ½Ã¸é Áñ°ÜÃ£±â¸¦ Ãß°¡ÇÏ½Ç ¼ö ÀÖ½À´Ï´Ù.");
			}
		 }
	  </script>
	 ';
	 
	if(substr($cms_id,0,2) == "14"){
		$cms_copy = ""; //ÀÔÇÐÃ³¿¡¼­ Ãâ·Â ÁßÁö ¿äÃ» 20131111
	}

	 echo $cms_copy;
	
}



//CMS function
function cms_view_utf8($cms_id){
	
	if(empty($cms_id))	echo "<div style=' text-align:center; padding:100px 0; '>CMS ÄÚµå°¡ ¾ø½À´Ï´Ù.</div>";

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
				<!-- ÆäÀÌÁö ´ã´çÀÚ¾È³» -->
		         <div class="fdata_wrap"> 
		          <dl> 
		             <dt><img src="/make_img/page/txt1.gif" alt="ÆäÀÌÁö´ã´çÀÚ ¾È³»ÀÔ´Ï´Ù."/></dt> 
		             <dd> 
		              <ul> 
		                 <li><span class="ctit">´ã´çÀÚ : </span><span class="ctxt">'.$damdang_name.'</span></li> 
		                 <li><span class="ctit">ÀüÈ­¹øÈ£ : </span><span class="ctxt">'.$damdang_tel.'</span></li> 
		                 <li class="last"><span class="ctit">ÃÖ±Ù¾÷µ¥ÀÌÆ® : </span><span class="ctxt">'.$cms_date.'</span></li> 
		               </ul> 
		              <div class="btn_print"><a href="#n" onclick="cms_bookmarksite()"><img src="/make_img/page/add_btn.gif" alt="Áñ°ÜÃ£±â" /></a> <a href="#n" onclick="print();" /><img src="/make_img/page/print_btn.gif" alt="ÇÁ¸°Æ®" /></a> </div> 
		            </dd> 
		           </dl> 
		        </div> 
				<!-- ÆäÀÌÁö ´ã´çÀÚ¾È³» -->
		';
		
	
	$cms_copy .= '
	  <script language="Javascript">
		function cms_bookmarksite() {
			var url = "http://'.$_SERVER["SERVER_NAME"].''.$_SERVER["REQUEST_URI"].'";
			var title = "ÃáÇØº¸°Ç´ëÇÐ±³-'.$CMS[cms_name].'";
		 
			if (window.sidebar && window.sidebar.addPanel){
				window.sidebar.addPanel(sidebartitle, sidebarurl,"");
			} 
			else if ( document.all ) {
				window.external.AddFavorite(url, title); 
			}
			else if (window.opera && window.print) {
				
			}
			else if (navigator.appName=="Netscape") {
				alert("<Ctrl+D>¸¦ ÀÔ·ÂÇÏ½Ã¸é Áñ°ÜÃ£±â¸¦ Ãß°¡ÇÏ½Ç ¼ö ÀÖ½À´Ï´Ù.");
			}
		 }
	  </script>
	 ';
	 
	 $cms_copy = iconv("euc-kr","utf-8",$cms_copy);
	 echo $cms_copy;
	
}

//°Ô½ÃÆÇ »ý¼º
function create_bbs($board_key, $category_no="0", $SecAdmin="0", $bbs_userqry="", $bbs_subqry="", $bbs_subcolumnqry="",$encode="euckr"){
	global $bbs;
	
	$Obj=new Sub_BBSStart();
	$Obj->makebbs($bbs, $board_key, $category_no, $SecAdmin, $bbs_userqry, $bbs_subqry, $bbs_subcolumnqry,$encode);
}




//°Ô½ÃÆÇ ÃÖ±Ù°Ô½Ã¹° °ª ¹è¿­¿¡ ´ã±â
function BBS_GetList($board_table , $board_code, $board_type=0, $limit_num=5, $cut_content=0, $debugmod=0){
	mysql_select_db("ch_new");
//BBS_GetList("°Ô½ÃÆÇ Å×ÀÌºí¸í(fullname)", "°Ô½ÃÆÇÄÚµå", º¸µåÅ¸ÀÔ, ¹è¿­¿¡ ´ãÀ» ÃÖ±Ù°Ô½Ã¹° ¼ö, ³»¿ë±Û ¼ö:htmlÇü½ÄÀÌ¶ó 300ÀÌ»óÀ¸·Î Àâ¾Æ¾ß...);
/*
	$board_type=0 : ÀÏ¹Ý
	$board_type=1 : °¶·¯¸®
	$board_type=2 : UCC

	[»ç¿ë¹æ¹ý]
	$newlist1 = BBS_GetList("bbs_com1", "3010", 0, 5, 300);
	
	for($i=0; $i < count($newlist1); $i++){
		
		//echo $newlist1[$i][title]."<br>"; //Á¦¸ñ
		
		//echo $newlist1[$i][content]."<br>"; //³»¿ë
		
		//echo $newlist1[$i][linkdata]."<br>"; //¸µÅ©µ¥ÀÌÅ¸  <a href='ÆÄÀÏ¸í?bbs=see&data=$newlist1[$i][linkdata]'>
		//echo $newlist1[$i][file_src]."<br>"; //ÆÄÀÏ°æ·Î <img src='$newlist1[$i][file_src]'> width height´Â ÁöÁ¤
		
		//echo $newlist1[$i][datetime]."<br>"; //µî·ÏÀÏÀÚ
		//echo $newlist1[$i][newimg]."<br>"; //»õ±Û ¾ÆÀÌÄÜ
	
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
		
		//°Ô½ÃÆÇ Á¦¸ñ
		$bbslimit[$i][title] = $row[title];
		
		//°Ô½ÃÆÇ µî·ÏÀÏÀÚ
		$bbslimit[$i][datetime] = substr($row[writeday],0,10);
		
		//°Ô½ÃÆÇ »õ±Û
		if(BetweenPeriod($row[writeday],"1") > 0) $bbslimit[$i][newimg] = "<img src='/bbs/images/new.gif' border='0' align='absmiddle' alt='' />";
		else $bbslimit[$i][newimg] = "";
		
		//¸µÅ© µ¥ÀÌÅ¸
		$encode_str = "pagecnt=0&idx=".$row[idx]."&letter_no=&offset=";
		$encode_str.= "&search=".$search."&searchstring=".$searchstring;
		$encode_str.= "&Boardkey=".$row[code]."&Sub_No=".$row[sub_no]."&DBTable=".$board_table;
		$list_data=Encode64($encode_str);
		
		$bbslimit[$i][linkdata] = $list_data;
		
		//Å¸ÀÔº° ÀÌ¹ÌÁö°æ·Î
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
		
		
		//³»¿ë Ãâ·Â½Ã
		if($cut_content > 0){
			$bbs_content = str_replace("&nbsp;", "", $row[content]);
			$bbs_content = StringCut(trim(strip_tags($bbs_content)), $cut_content);
			$bbslimit[$i][content] = $bbs_content;
			
		}
		
	}
	
	return $bbslimit;
}


//°Ô½ÃÆÇ ÃÖ±Ù°Ô½Ã¹° °ª ¹è¿­¿¡ ´ã±â
function BBS_GetList2($board_table , $board_code, $board_type=0, $limit_num=5, $cut_content=0, $debugmod=0){
	//DBº¯°æ
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
		
		//°Ô½ÃÆÇ Á¦¸ñ
		$bbslimit[$i][title] = $row[title];
		
		//°Ô½ÃÆÇ µî·ÏÀÏÀÚ
		$bbslimit[$i][datetime] = substr($row[writeday],0,10);
		
		//°Ô½ÃÆÇ »õ±Û
		if(BetweenPeriod($row[writeday],"1") > 0) $bbslimit[$i][newimg] = "<img src='/bbs/images/new.gif' border='0' align='absmiddle' alt='' />";
		else $bbslimit[$i][newimg] = "";
		
		//¸µÅ© µ¥ÀÌÅ¸
		$encode_str = "pagecnt=0&idx=".$row[idx]."&letter_no=&offset=";
		$encode_str.= "&search=".$search."&searchstring=".$searchstring;
		$encode_str.= "&Boardkey=".$row[code]."&Sub_No=".$row[sub_no]."&DBTable=".$board_table;
		$list_data=Encode64($encode_str);
		
		$bbslimit[$i][linkdata] = $list_data;
		
		//Å¸ÀÔº° ÀÌ¹ÌÁö°æ·Î
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
		
		
		//³»¿ë Ãâ·Â½Ã
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
	
	// ÃÖÁ¾ ¾÷µ¥ÀÌÆ® : 2011 07 04 : ¿¤Áö À¯ÇÃ·¯½º smtp ·Î º¯°æ (Æ÷Æ®, ¾ÆÀÌÇÇ ¿­À½)

	$smtpServer = "¾ÆÀÌÇÇ"; //ip accepted as well
	$port = "25"; // should be 25 by default
	$timeout = "30"; //typical timeout. try 45 for slow servers
	$username = "¾ÆÀÌµð"; //the login for your smtp
	$password = "ÆÐ½º¿öµå"; //the pass for your smtp
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
//smtp ¹æ½Ä way_nam :: ±îÆä24ÀÇ smtp ¸¦ È°¿ëÇÏ¿© º¸³À´Ï´Ù. (´ë·®¸ÞÀÏ¿¡´Â »ç¿ëÇÏ¸é ¾È‰?ÇÏ·ç ¹ß¼ÛÁ¦ÇÑÀÖÀ½)
	
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

//¿ÀÅä¸µÅ©
function url_auto_link($str)
{

    // ¼Óµµ Çâ»ó 031011
    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_blank'>\\2</A>", $str);
    $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'>\\2</A>", $str);
    // ÀÌ¸ÞÀÏ Á¤±ÔÇ¥Çö½Ä ¼öÁ¤ 061004
    //$str = preg_replace("/(([a-z0-9_]|\-|\.)+@([^[:space:]]*)([[:alnum:]-]))/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;
}


//ÆäÀÌÁö ÀÌµ¿ÇÔ¼ö
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


//$n °³ÀÇ ¹®ÀÚ¿­°ú '...' ºÙÀÌ±â ÇÔ¼ö
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


//$n °³ÀÇ ¹®ÀÚ¿­°ú '...' ¾ø´Â ÇÔ¼ö 
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

// µð·ºÅä¸®Á¤º¸ ·Îµå
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

//Post, Get¹æ½ÄÀ¸·Î ³Ñ¾î¿Â °ª Äõ¸®·Î º¯È¯
function setQuery ($arr, $str) {
	$r_str = '';

	// $arr : $_POST È¤Àº $_GET, ¹è¿­ ¹Ýº¹
	foreach ($arr as $key=>$val) {

		// input name ÀÌ ÁöÁ¤ÇÑ ¹®ÀÚ¿­·Î ½ÃÀÛµÇ¸é Àû¿ë ÇÏ°í ±× ¹®ÀÚ¿­Àº »èÁ¦ 
		//if (@ereg ("^$str", $key)) { // php 5.3ÀÌÈÄ µðÇÁ·¹ÄÉÀÌÆ® 6.0ºÎÅÍ»èÁ¦
		if(preg_match("/^$str/", $key)) {
			
			//$key = @ereg_replace ("^$str", "", $key);  // php 5.3ÀÌÈÄ µðÇÁ·¹ÄÉÀÌÆ® 6.0ºÎÅÍ»èÁ¦
			$key = preg_replace ("/^$str/", "", $key);

			// ¹®ÀÚ¿­À» Á¦°ÅÇÑ Å°°ªÀÌ ¾ÆÁ÷ Á¸ÀçÇÏ¸é ¸®ÅÏÇØÁÙ ¹®ÀÚ¿­¿¡ ¿¬°áÇÕ´Ï´Ù.
			// Ã³À½Àº xxx = 'xxx' ·Î µÎ¹øÂ° ºÎÅÍ´Â ,xxx = 'xxx'·Î ÀÌ¾îÁÝ´Ï´Ù.
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

/********  2007.03. 14 Ãß°¡ ÇÔ¼ö End *****************/
// ÆÄÀÏ »çÀÌÁî¸¦ kb, mb¿¡ ¸ÂÃß¾î¼­ º¯È¯ÇØ¼­ ¸®ÅÏ
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


/********  2007.03. 14 Ãß°¡ ÇÔ¼ö Start ***************/
// Get ¹æ½Ä º¯¼ö ¾ÏÈ£È­ ÇÔ¼ö
function Encode64($data)
{
	//global $EncoderKey;
	//$data = rand_str(5, 0).$data.rand_str(3, 0)
	
	//return base64_encode($data.$EncoderKey);
	return base64_encode($data)."||";
}

// Get¹æ½ÄÀ¸·Î ³Ñ¾î¿Â º¯¼ö¸¦ DecodeÇÏ´Â ÇÔ¼ö
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
 * ·£´ý ¹®ÀÚ¿­ »ý¼º(ÀÎ¼ö : ±æÀÌ, Å¸ÀÔ) 
 * ÁöÁ¤µÈ Å¸ÀÔÀÇ ¹®ÀÚ¿­·Î ÁöÁ¤µÈ ±æÀÌÀÇ ·£´ý ¹®ÀÚ¿­À» ¹ÝÈ¯ÇÑ´Ù. 
 * Å¸ÀÔ 0 : ¿µ¹® ´ë¼Ò¹®ÀÚ(A-Z,a-z), ¼ýÀÚ(0-9) 
 * Å¸ÀÔ 1 : ¿µ¹® ´ë¹®ÀÚ(A-Z), ¼ýÀÚ(0-9) 
 * Å¸ÀÔ 2 : ¿µ¹® ¼Ò¹®ÀÚ(a-z), ¼ýÀÚ(0-9) 
 * Å¸ÀÔ 3 : ¿µ¹® ´ë¹®ÀÚ(A-Z) 
 * Å¸ÀÔ 4 : ¿µ¹® ¼Ò¹®ÀÚ(a-z) 
 * Å¸ÀÔ 5 : ¼ýÀÚ(0-9) 
 * µðÆúÆ® : false ¹ÝÈ¯. 
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

//====================== ÆäÀÌÁö ³ª´©±â ======================//
function pageLink($args) {
	//if($args['total_row'] == 0) $args['total_row'] = 1;
	//print_r($args);
	$tp = @floor(($args['total_row']-1)/$args['row_num'] +1 ); //(TotalPage)ÀüÃ¼ ÆäÀÌÁö ¼ö
	if($tp == 0) $tp = 1;
	$sp = (floor(($args['p']-1)/$args['page'])) * $args['page'] + 1; //ÆäÀÌÁö ¼ýÀÚ Ç¥½Ã --> ½ÃÀÛ
	$ep = $sp + $args['page']; //ÆäÀÌÁö ¼ýÀÚ Ç¥½Ã --> ³¡
	//echo $tp;

	if($tp < $ep) { //³ªÅ¸³¾ ¸®½ºÆ® ÆäÀÌÁö ¼ö°¡ ±âº» ÆäÀÌÁö Ç¥½Ã ¼öº¸´Ù ÀÛÀ» °æ¿ì
		$ep = $tp + 1;	
		$disable_next = 1;
	}
	//$prev ; 
	//$prev = $sp - 1;
	$prev = $sp - ($args['page']);	// ÀÌÀü ÆäÀÌÁö ¸®½ºÆ® Á¦ÀÏ Ã¹ÆäÀÌÁö·Î °¡µµ·Ï ¼öÁ¤(2005.05.18 ±èÃ¢±Ù)
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

function script($script) {	// ÀÚ¹Ù½ºÅ©¸³Æ® ½ÇÇà, ¹è¿­ÀÌ µé¾î¿À¸é ÀÏÀÏÀÌ ½ÇÇà
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


//ÇöÀç½Ã°£°ú Æ¯Á¤ÀÏ »çÀÌÀÇ ±â°£
function BetweenPeriod($datetime,$periodDay)
{//2003-02-19 11:32:15
	$now = time();
	$timeArr= explode(":",substr($datetime,11,8));
	$dayArr	= explode("-",substr($datetime,0,10));

	$mktime = mktime($timeArr[0],$timeArr[1],$timeArr[2],$dayArr[1],$dayArr[2],$dayArr[0]);
	$period	= $periodDay*24*60*60;		//±â°£°è»ê

	if($now >$mktime && $now < ($mktime+$period))
		return 1;
	else if( ($mktime-$period) <$now && $now <$mktime)
		return -1;
	else
		return 0;
}

// °èÃþÇü Â÷Æ® ¸¸µé±â ÇÔ¼ö .. Àç±ÍÇÔ¼ö
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
# @Function ¸í    : readHtml
# @¿ªÇÒ           : HMTLÈ­ÀÏÀ» ÀÐ¾î º¯¼ö¿¡ ÇÒ´ç
# @parameter
#		$readfile   	: ÀÐÀ» È­ÀÏ¸í
# @Return         : ÀÐÀº È­ÀÏÀÇ ¹®ÀÚ¿­
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
		$rtStr = "<h1>Warning</h1><hr>ÀÐÀ» È­ÀÏÀÌ ¾ø°Å³ª È­ÀÏ¸íÀÌ Àß¸ø ÁöÁ¤µÇ¾ú½À´Ï´Ù.";
		$rtStr .= "<br>È­ÀÏ¸íÀ» È®ÀÎÇÏ½Ê½Ã¿À!";
		$rtStr .= "<hr><font color=red>$readfile</font>";
		return $rtStr;
	}
}
#-----------------------------------------------------------------------------
# @Function ¸í    : tag2str
# @¿ªÇÒ           : tag¸¦ »ý¼ºÇÑ ¹®ÀÚ¿­·Î Ä¡È¯
# @parameter
#		$srcStr   	  : ¿øº» ¹®ÀÚ¿­
#		$tagStr   	  : º¯È¯ÇÒ tag ¸í
#		$changeStr   	: º¯È¯ÇÒ ¹®ÀÚ¿­
# @Return         : º¯È¯ÇÑ ¹®ÀÚ¿­
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
# @Function ¸í    : tag2str
# @¿ªÇÒ           : tag¸¦ »ý¼ºÇÑ ¹®ÀÚ¿­·Î Ä¡È¯
# @parameter
#		$srcStr   	  : ¿øº» ¹®ÀÚ¿­
#		$tagStr   	  : º¯È¯ÇÒ tag ¸í
#		$changeStr   	: º¯È¯ÇÒ ¹®ÀÚ¿­
# @Return         : º¯È¯ÇÑ ¹®ÀÚ¿­
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
# @Function ¸í    : initHtmlTable
# @¿ªÇÒ           : HTMLÀÇ Å×ÀÌºíÀ» ÃÊ±âÈ­
# @parameter
#		$html_ini   	: ÃÊ±âÈ­ÇÒ Å×ÀÌºí¼³Á¤È­ÀÏ
# @Return         : html_table,html_t1,html_2¸¦ Àü¿ªº¯¼ö·Î ÇÒ´ç
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
# @Function ¸í    : Thumnail
# @¿ªÇÒ           : ½æ³×ÀÏ ÀÌ¹ÌÁö ¸¸µé±â
#-----------------------------------------------------------------------------
//½æ³×ÀÏ function
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

// ¸ÞÀÏÀü¼ÛÇÔ¼ö
function mailsend($fromname,$frommail,$tomail,$subject,$msg){
	$headers = "Return-Path: <".$frommail.">\n"; 
	$headers .= "From: ".$fromname." <".$frommail.">\n";
	$headers .= "X-Sender: <".$frommail.">\n"; 
	$headers .= "X-Mailer: PHP\n"; // mailer
	$headers .= "X-Priority: 1\n"; // Urgent message!

	// ¿¡·¯ ¹ß»ý½Ã ¹Ý¼Û ÁÖ¼Ò
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
	$header .= 'Connection: close'."\r\n";	// KeepAlive¸¦ Çã¿ëÇÏÁö ¾ÊÀ½
	$header .= 'Content-Length: ' . strlen($post_data) . "\r\n\r\n";
	$header = $header.$post_data;

	$client_socket = fsockopen("211.175.207.24", 80, &$errno, &$errmsg);
	fwrite($client_socket, $header);
	fclose($client_socket);	
}

/********  2007.03. 14 Ãß°¡ ÇÔ¼ö End *****************/
// ÆÄÀÏ »çÀÌÁî¸¦ kb, mb¿¡ ¸ÂÃß¾î¼­ º¯È¯ÇØ¼­ ¸®ÅÏ
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


// ÆäÀÌÁö ÄÆ¢¸ 1 [2][3][4][5] ¢º				
class PList
{
	var $g_pageName;		//¼³Á¤ÆÄÀÏ¸í ex) ****.php, OOOO.php

	var $g_pageCnt;			//ÇöÀçÆäÀÌÁö ¹øÈ£
	var $g_offset;			//µ¥ÀÌÅ¸º£ÀÌ½º ½ÃÀÛ Æ÷ÀÎÆ® ¹øÈ£
	var $g_numRows;			//ÃÑ°Ô½Ã¹° ¼ö
	var $g_pageBlock;		//ºí·°´ç ÆäÀÌÁö ¼ö ex) 5 : [1][2][3][4][5]
	var $g_limit;			//ÆäÀÌÁö´ç Ãâ·Â °Ô½Ã¹° ¼ö
	var $g_search;			//°Ë»ö ÄÃ·³ ex)name,title,...
	var $g_searchstring;	//°Ë»ö¾î

	var $g_option;			//Ãß°¡ get °ª  ex) &part=$part
			
	var $g_pniView;			//¸µÅ©µÇÁö ¾ÊÀº ¾ÆÀÌÄÜ Ç¥½Ã ¿©ºÎ ex) true,1 : Ç¥½Ã  false,0 : ¹ÌÇ¥½Ã
	var $g_pIcon;			//ÀÌÀü ¾ÆÀÌÄÜ
	var $g_nIcon;			//´ÙÀ½ ¾ÆÀÌÄÜ

	//
	// »ý¼ºÀÚ
	// CList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
	// CList(ÆäÀÌÁö¸í, ÇöÀçÆäÀÌÁö¹øÈ£, DB½ÃÀÛoffset, ÃÑ°Ô½Ã¹°¼ö, ºí·°´çÆäÀÌÁö¼ö, ÆäÀÌÁö´ç°Ô½Ã¹°¼ö, °Ë»öÄÃ·³, °Ë»ö¾î, Ãß°¡get°ª)
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
	// ¾ÆÀÌÄÜ ¼³Á¤
	// putList( BOOL pniView, char* pre_icon, char* next_icon)
	// putList( ¸µÅ©µÇÁö ¾ÊÀº ¾ÆÀÌÄÜ Ç¥½Ã ¿©ºÎ, ÀÌÀü¾ÆÀÌÄÜ, ´ÙÀ½¾ÆÀÌÄÜ, Ã³À½, ¸¶Áö¸·, ÇÑÄ­ÀÌÀü, ÇÑÄ­´ÙÀ½
	//
	function putList($pniView,$pre_icon,$next_icon,$first_icon,$last_icon,$pre1_icon,$next1_icon){
		$this->g_pniView=$pniView;					//¸µÅ©µÇÁö ¾ÊÀº ¾ÆÀÌÄÜ Ç¥½Ã ¿©ºÎ
		if(empty($pre_icon))	$this->g_pIcon="<<";			//ÀÌÀü ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_pIcon=$pre_icon;

		if(empty($next_icon))	$this->g_nIcon=">>";			//´ÙÀ½ ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_nIcon=$next_icon;
		
		if(empty($first_icon))	$this->g_fIcon="Ã³À½À¸·Î";		//Ã³À½ ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_fIcon=$first_icon;

		if(empty($last_icon))	$this->g_lIcon="¸¶Áö¸·À¸·Î";	//¸¶Áö¸· ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_lIcon=$last_icon;
		
		
		if(empty($pre1_icon))	$this->g_p1Icon="<";			//ÇÑÄ­ÀÌÀü ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_p1Icon=$pre1_icon;

		if(empty($next1_icon))	$this->g_n1Icon=">";			//ÇÑÄ­´ÙÀ½ ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_n1Icon=$next1_icon;

		$this->pniPrint(); //È­¸é Ãâ·Â
	}
	//
	// È­¸é Ãâ·Â
	//
	function pniPrint(){

		if ( preg_match("|recruit|", $this->g_pageName) > 0 ) {
			$offset_separate = "&";
		} else {
			$offset_separate = "?";
		}

		$chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //ÇöÁ¦ÆäÀÌÁö Ã¼Å©

	    if($chekpage==$this->g_pageCnt){  //¸¶Áö¸· ºí·°ÀÏ °æ¿ì....
			$pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //¸¶Áö¸· ºí·° ÆäÀÌÁö¼ö °è»ê
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
		

		/*   Ã³À½   */
		$data="search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
		if($this->g_pniView)
			echo "<a href=".$this->g_pageName.$offset_separate.$data.">".$this->g_fIcon."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		
		
					
		/*    ÀÌÀü   */
		if($this->g_pageCnt>0){				//ÀÌÀüÆäÀÌÁö ÀÖÀ½
			$prepage=$this->g_pageCnt-1;	//ÀÌÀüºí·° ½ÃÀÛÆäÀÌÁö ¼³Á¤.
			$pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//ÀÌÀüºí·° ½ÃÀÛ±Û ¹øÈ£ ¼³Á¤
		    $data="pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

	        $pre_str ="<a href='".$this->g_pageName.$offset_separate.$data."'>".$this->g_pIcon."</a>&nbsp;";

		    echo "$pre_str"; 	//ÀÌÀü¾ÆÀÌÄÜ ¸µÅ©
		}else{					//ÀÌÀüÆäÀÌÁö ¾øÀ½
			if($this->g_pniView)//¾ÆÀÌÄÜ Ç¥½Ã
				$empty_pre_str = $this->g_pIcon."&nbsp;";
				
		    else				//¾ÆÀÌÄÜ ºñÇ¥½Ã
			    $empty_pre_str = "&nbsp;";
	   
		    echo "$empty_pre_str";
		}

		
		

		/*    1°³ ÀÌÀü   */
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
			$loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//½ÃÀÛ±Û ÁöÁ¤
		    $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//ÆäÀÌÁö ¹øÈ£ ¼³Á¤
			$cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//½ÃÀÛ±Û ¹øÈ£ ÁöÁ¤
		    $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
		    $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
			$data=$en_str;
			if($lnum==(($this->g_offset/$this->g_limit)+1))	{//ÇöÀç ÆäÀÌÁö ÀÏ °æ¿ì
				echo " <font size='2'><b>$lnum</b></font> ";
			}else{
				$mid_str = " <span class='nort'>[<a href='".$this->g_pageName.$offset_separate.$data."'>".$lnum."</a>]</span> ";
				
				echo"$mid_str";
			}
			$l++;
	    }
	    
	    
	    
	    
	    /*    1°³ ´ÙÀ½   */
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
		



		/*    ´ÙÀ½   */
		if($this->g_pageCnt!=$chekpage){		//´ÙÀ½ÆäÀÌÁö ÀÖÀ½
			echo "&nbsp;";
			$newpagecnt=$this->g_pageCnt+1;		//´ÙÀ½ ºí·° ½ÃÀÛÆäÀÌÁö ¼³Á¤
			$newt=$cu_letter_no-$this->g_limit;	//´ÙÀ½ ºí·° ½ÃÀÛ±Û ¹øÈ£ ¼³Á¤
			$data="pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
			$next_str="<a href='".$this->g_pageName.$offset_separate.$data."'>".$this->g_nIcon."</a>";

			echo $next_str;			//´ÙÀ½ ¾ÆÀÌÄÜ ¸µÅ©
		}else{						//´ÙÀ½ÆäÀÌÁö ¾øÀ½
			if($this->g_pniView)	//¾ÆÀÌÄÜ Ç¥½Ã
				echo"&nbsp;".$this->g_nIcon;
				//echo"&nbsp;";
				
			else					//¾ÆÀÌÄÜ ºñÇ¥½Ã
				echo"&nbsp;";
		}
		
		
		/*   ¸¶Áö¸·   */
		$data="pagecnt=".$lastpagecnt."&letter_no=".$lastletter_no."&offset=".$lastoffset."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
		
		if($this->g_pniView) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$this->g_pageName.$offset_separate.$data."&".$this->g_option."'>".$this->g_lIcon."</a>";
		
	}//function putList()
}//class



// ÆäÀÌÁö ÄÆ¢¸ 1 [2][3][4][5] ¢º				
class SList
{
	var $g_pageName;		//¼³Á¤ÆÄÀÏ¸í ex) ****.php, OOOO.php

	var $g_pageCnt;			//ÇöÀçÆäÀÌÁö ¹øÈ£
	var $g_offset;			//µ¥ÀÌÅ¸º£ÀÌ½º ½ÃÀÛ Æ÷ÀÎÆ® ¹øÈ£
	var $g_numRows;			//ÃÑ°Ô½Ã¹° ¼ö
	var $g_pageBlock;		//ºí·°´ç ÆäÀÌÁö ¼ö ex) 5 : [1][2][3][4][5]
	var $g_limit;			//ÆäÀÌÁö´ç Ãâ·Â °Ô½Ã¹° ¼ö
	var $g_search;			//°Ë»ö ÄÃ·³ ex)name,title,...
	var $g_searchstring;	//°Ë»ö¾î

	var $g_option;			//Ãß°¡ get °ª  ex) &part=$part
			
	var $g_pniView;			//¸µÅ©µÇÁö ¾ÊÀº ¾ÆÀÌÄÜ Ç¥½Ã ¿©ºÎ ex) true,1 : Ç¥½Ã  false,0 : ¹ÌÇ¥½Ã
	var $g_pIcon;			//ÀÌÀü ¾ÆÀÌÄÜ
	var $g_nIcon;			//´ÙÀ½ ¾ÆÀÌÄÜ

	//
	// »ý¼ºÀÚ
	// SList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
	// SList(ÆäÀÌÁö¸í, ÇöÀçÆäÀÌÁö¹øÈ£, DB½ÃÀÛoffset, ÃÑ°Ô½Ã¹°¼ö, ºí·°´çÆäÀÌÁö¼ö, ÆäÀÌÁö´ç°Ô½Ã¹°¼ö, °Ë»öÄÃ·³, °Ë»ö¾î, Ãß°¡get°ª)
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
	// ¾ÆÀÌÄÜ ¼³Á¤
	// putList( BOOL pniView, char* pre_icon, char* next_icon)
	// putList( ¸µÅ©µÇÁö ¾ÊÀº ¾ÆÀÌÄÜ Ç¥½Ã ¿©ºÎ, ÀÌÀü¾ÆÀÌÄÜ, ´ÙÀ½¾ÆÀÌÄÜ
	//
	function putList($pniView,$pre_icon,$next_icon){
		$this->g_pniView=$pniView;					//¸µÅ©µÇÁö ¾ÊÀº ¾ÆÀÌÄÜ Ç¥½Ã ¿©ºÎ
		if(empty($pre_icon))	$this->g_pIcon="[ÀÌÀü ".$this->g_pageBlock."°³]";			//ÀÌÀü ¾ÆÀÌÄÜ ¼³Á¤
		else			$this->g_pIcon=$pre_icon;

		if(empty($next_icon))	$this->g_nIcon="[´ÙÀ½ ".$this->g_pageBlock."°³]";			//´ÙÀ½ ¾ÆÀÌÄÜ ¼³Á¤
		else			$this->g_nIcon=$next_icon;

		$this->pniPrint(); //È­¸é Ãâ·Â
	}
	//
	// È­¸é Ãâ·Â
	//
	function pniPrint(){
		/*    ÀÌÀü   */
		if($this->g_pageCnt>0){				//ÀÌÀüÆäÀÌÁö ÀÖÀ½
			$prepage=$this->g_pageCnt-1;	//ÀÌÀüºí·° ½ÃÀÛÆäÀÌÁö ¼³Á¤.
			$pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//ÀÌÀüºí·° ½ÃÀÛ±Û ¹øÈ£ ¼³Á¤
		    $data="pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring;

	        $pre_str ="<a href='".$this->g_pageName."?".$data;
		    if(!empty($this->g_option))
				$pre_str.="&".$this->g_option;
		    $pre_str.="'>".$this->g_pIcon."</a>&nbsp;&nbsp;&nbsp;";

		    echo "$pre_str"; 	//ÀÌÀü¾ÆÀÌÄÜ ¸µÅ©
		}else{					//ÀÌÀüÆäÀÌÁö ¾øÀ½
			if($this->g_pniView)//¾ÆÀÌÄÜ Ç¥½Ã
				$empty_pre_str = $this->g_pIcon."&nbsp;&nbsp;";
		    else				//¾ÆÀÌÄÜ ºñÇ¥½Ã
			    $empty_pre_str = "&nbsp;&nbsp;";
	   
		    echo "$empty_pre_str";
		}

		/* 1 [2][3][4][5] */
		$chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //ÇöÁ¦ÆäÀÌÁö Ã¼Å©

	    if($chekpage==$this->g_pageCnt){  //¸¶Áö¸· ºí·°ÀÏ °æ¿ì....
			$pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //¸¶Áö¸· ºí·° ÆäÀÌÁö¼ö °è»ê
			if(!($this->g_numRows%($this->g_limit))){
	 			$pCnt--;
			}
		}else{
			$pCnt=$this->g_pageBlock;
		}

		$l=0;
		while($l<$pCnt){
			$loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//½ÃÀÛ±Û ÁöÁ¤
		    $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//ÆäÀÌÁö ¹øÈ£ ¼³Á¤
			$cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//½ÃÀÛ±Û ¹øÈ£ ÁöÁ¤
		    $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
		    $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring;
			$data=$en_str;
			
			if($l != 0 ) echo " | ";
			
			if($lnum==(($this->g_offset/$this->g_limit)+1))	//ÇöÀç ÆäÀÌÁö ÀÏ °æ¿ì
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

		/*    ´ÙÀ½   */
		if($this->g_pageCnt!=$chekpage){		//´ÙÀ½ÆäÀÌÁö ÀÖÀ½
			echo "&nbsp;&nbsp;&nbsp;";
			$newpagecnt=$this->g_pageCnt+1;		//´ÙÀ½ ºí·° ½ÃÀÛÆäÀÌÁö ¼³Á¤
			$newt=$cu_letter_no-$this->g_limit;	//´ÙÀ½ ºí·° ½ÃÀÛ±Û ¹øÈ£ ¼³Á¤
			$data="pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring;
			$next_str="<a href='".$this->g_pageName."?".$data;
			if(!empty($this->g_option))
				$next_str.="&".$this->g_option;
			$next_str.="'>".$this->g_nIcon."</a>";

			echo $next_str;			//´ÙÀ½ ¾ÆÀÌÄÜ ¸µÅ©
		}else{						//´ÙÀ½ÆäÀÌÁö ¾øÀ½
			if($this->g_pniView)	//¾ÆÀÌÄÜ Ç¥½Ã
				echo"&nbsp;&nbsp;".$this->g_nIcon;
			else					//¾ÆÀÌÄÜ ºñÇ¥½Ã
				echo"&nbsp;&nbsp;";
		}
	}//function putList()
}//class

// ÆäÀÌÁö ÄÆ¢¸ 1 [2][3][4][5] ¢º				
class RList
{
	var $g_pageName;		//¼³Á¤ÆÄÀÏ¸í ex) ****.php, OOOO.php

	var $g_pageCnt;			//ÇöÀçÆäÀÌÁö ¹øÈ£
	var $g_offset;			//µ¥ÀÌÅ¸º£ÀÌ½º ½ÃÀÛ Æ÷ÀÎÆ® ¹øÈ£
	var $g_numRows;			//ÃÑ°Ô½Ã¹° ¼ö
	var $g_pageBlock;		//ºí·°´ç ÆäÀÌÁö ¼ö ex) 5 : [1][2][3][4][5]
	var $g_limit;			//ÆäÀÌÁö´ç Ãâ·Â °Ô½Ã¹° ¼ö
	var $g_search;			//°Ë»ö ÄÃ·³ ex)name,title,...
	var $g_searchstring;	//°Ë»ö¾î

	var $g_option;			//Ãß°¡ get °ª  ex) &part=$part
			
	var $g_pniView;			//¸µÅ©µÇÁö ¾ÊÀº ¾ÆÀÌÄÜ Ç¥½Ã ¿©ºÎ ex) true,1 : Ç¥½Ã  false,0 : ¹ÌÇ¥½Ã
	var $g_pIcon;			//ÀÌÀü ¾ÆÀÌÄÜ
	var $g_nIcon;			//´ÙÀ½ ¾ÆÀÌÄÜ

	//
	// »ý¼ºÀÚ
	// CList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
	// CList(ÆäÀÌÁö¸í, ÇöÀçÆäÀÌÁö¹øÈ£, DB½ÃÀÛoffset, ÃÑ°Ô½Ã¹°¼ö, ºí·°´çÆäÀÌÁö¼ö, ÆäÀÌÁö´ç°Ô½Ã¹°¼ö, °Ë»öÄÃ·³, °Ë»ö¾î, Ãß°¡get°ª)
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
	// ¾ÆÀÌÄÜ ¼³Á¤
	// putList( BOOL pniView, char* pre_icon, char* next_icon)
	// putList( ¸µÅ©µÇÁö ¾ÊÀº ¾ÆÀÌÄÜ Ç¥½Ã ¿©ºÎ, ÀÌÀü¾ÆÀÌÄÜ, ´ÙÀ½¾ÆÀÌÄÜ, Ã³À½, ¸¶Áö¸·, ÇÑÄ­ÀÌÀü, ÇÑÄ­´ÙÀ½
	//
	function putList($pniView,$pre_icon,$next_icon,$first_icon,$last_icon,$pre1_icon,$next1_icon){
		$this->g_pniView=$pniView;					//¸µÅ©µÇÁö ¾ÊÀº ¾ÆÀÌÄÜ Ç¥½Ã ¿©ºÎ
		if(empty($pre_icon))	$this->g_pIcon="<<";			//ÀÌÀü ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_pIcon=$pre_icon;

		if(empty($next_icon))	$this->g_nIcon=">>";			//´ÙÀ½ ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_nIcon=$next_icon;
		
		if(empty($first_icon))	$this->g_fIcon="Ã³À½À¸·Î";		//Ã³À½ ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_fIcon=$first_icon;

		if(empty($last_icon))	$this->g_lIcon="¸¶Áö¸·À¸·Î";	//¸¶Áö¸· ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_lIcon=$last_icon;
		
		
		if(empty($pre1_icon))	$this->g_p1Icon="<";			//ÇÑÄ­ÀÌÀü ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_p1Icon=$pre1_icon;

		if(empty($next1_icon))	$this->g_n1Icon=">";			//ÇÑÄ­´ÙÀ½ ¾ÆÀÌÄÜ ¼³Á¤
		else					$this->g_n1Icon=$next1_icon;

		$this->pniPrint(); //È­¸é Ãâ·Â
	}
	//
	// È­¸é Ãâ·Â
	//
	function pniPrint(){

		if ( preg_match("|recruit|", $this->g_pageName) > 0 ) {
			$offset_separate = "&";
		} else {
			$offset_separate = "?";
		}

		$chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //ÇöÁ¦ÆäÀÌÁö Ã¼Å©

	    if($chekpage==$this->g_pageCnt){  //¸¶Áö¸· ºí·°ÀÏ °æ¿ì....
			$pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //¸¶Áö¸· ºí·° ÆäÀÌÁö¼ö °è»ê
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
		

		/*   Ã³À½   */
		$data="search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
		if($this->g_pniView)
			echo "<a href=".$this->g_pageName.$offset_separate.$data.">".$this->g_fIcon."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		
		
					
		/*    ÀÌÀü   */
		if($this->g_pageCnt>0){				//ÀÌÀüÆäÀÌÁö ÀÖÀ½
			$prepage=$this->g_pageCnt-1;	//ÀÌÀüºí·° ½ÃÀÛÆäÀÌÁö ¼³Á¤.
			$pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//ÀÌÀüºí·° ½ÃÀÛ±Û ¹øÈ£ ¼³Á¤
		    $data="pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

	        $pre_str ="<a href='".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major."'>".$this->g_pIcon."</a>&nbsp;";

		    echo "$pre_str"; 	//ÀÌÀü¾ÆÀÌÄÜ ¸µÅ©
		}else{					//ÀÌÀüÆäÀÌÁö ¾øÀ½
			if($this->g_pniView)//¾ÆÀÌÄÜ Ç¥½Ã
				$empty_pre_str = $this->g_pIcon."&nbsp;";
				
		    else				//¾ÆÀÌÄÜ ºñÇ¥½Ã
			    $empty_pre_str = "&nbsp;";
	   
		    echo "$empty_pre_str";
		}

		
		

		/*    1°³ ÀÌÀü   */
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
			$loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//½ÃÀÛ±Û ÁöÁ¤
		    $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//ÆäÀÌÁö ¹øÈ£ ¼³Á¤
			$cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//½ÃÀÛ±Û ¹øÈ£ ÁöÁ¤
		    $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
		    $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
			$data=$en_str;
			if($lnum==(($this->g_offset/$this->g_limit)+1))	{//ÇöÀç ÆäÀÌÁö ÀÏ °æ¿ì
				echo " <font size='2'><b>$lnum</b></font> ";
			}else{
				$mid_str = " <span class='nort'>[<a href='".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major."'>".$lnum."</a>]</span> ";
				
				echo"$mid_str";
			}
			$l++;
	    }
	    
	    
	    
	    
	    /*    1°³ ´ÙÀ½   */
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
		



		/*    ´ÙÀ½   */
		if($this->g_pageCnt!=$chekpage){		//´ÙÀ½ÆäÀÌÁö ÀÖÀ½
			echo "&nbsp;";
			$newpagecnt=$this->g_pageCnt+1;		//´ÙÀ½ ºí·° ½ÃÀÛÆäÀÌÁö ¼³Á¤
			$newt=$cu_letter_no-$this->g_limit;	//´ÙÀ½ ºí·° ½ÃÀÛ±Û ¹øÈ£ ¼³Á¤
			$data="pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
			$next_str="<a href='".$this->g_pageName.$offset_separate.$data."'>".$this->g_nIcon."</a>";

			echo $next_str;			//´ÙÀ½ ¾ÆÀÌÄÜ ¸µÅ©
		}else{						//´ÙÀ½ÆäÀÌÁö ¾øÀ½
			if($this->g_pniView)	//¾ÆÀÌÄÜ Ç¥½Ã
				echo"&nbsp;".$this->g_nIcon;
				//echo"&nbsp;";
				
			else					//¾ÆÀÌÄÜ ºñÇ¥½Ã
				echo"&nbsp;";
		}
		
		
		/*   ¸¶Áö¸·   */
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

	

// ÄíÅ°º¯¼ö »ý¼º
function set_cookie($cookie_name, $value, $expire)
{
    setcookie(md5($cookie_name), base64_encode($value), time() + $expire, '/', $way['cookie_domain']);
}


// ÄíÅ°º¯¼ö°ª ¾òÀ½
function get_cookie($cookie_name)
{
    return base64_decode($_COOKIE[md5($cookie_name)]);
}
?>