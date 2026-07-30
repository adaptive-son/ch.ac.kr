<?

/******************************************************************************************************
 //��뿹��
 $Obj=new Sub_BBSStart();
 $Obj->makebbs($bbs,1,1,"iuk_board_6","iuk_bbs",20,1);


 $Obj=new Sub_BBSStart();

 $bbs		- Default
 $BoardKey	- Int�� ������
 $sub_No	- Int�� ������
 DB			- Database Table��
 SKIN		- ��Ų��
 LISTNUM	- ����Ʈ ����

 ADMIN		- INT�� (0:�Ϲ� , 1:�������)

 $Obj->makebbs(
	 $bbs(���絿�ۻ���ǥ��),
	 $BoardKey(int),
	 $sub_No(int),
	 "�����ͺ��̽�",
	 �Խ��ǽ�Ų,
	 ����Ʈ����(int),
	 ���α���(int)

	 $bbs_userqry(userid���� ���̵� �˻�)
	 bbs_subqry (and ���� db�߰��˻�)
 );


 �����÷����� ����
 �������Խ��� ����Ʈ�̹��� : , (select idx from [[BBSDBTABLE]]_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx
 UCC�Խ��� ����Ʈ�̹��� : , (select up_filename from [[BBSDBTABLE]]_file where file_type = 10 and up_file_idx = A.up_file_idx limit 0,1) as up_filename

*******************************************************************************************************/

// BBS Make Module
class Sub_BBSStart {

    var $bbs;
	var $c_BoardKey;
	var $c_Sub_No;
	var $c_SecAdmin;

	function makebbs($bbs, $BoardKey, $Sub_No="0", $SecAdmin="0", $bbs_userqry="", $bbs_subqry="", $bbs_subcolumnqry="",$encode="euckr") {
		//mysql_query("set names utf8");
		global $PHP_SELF, $_SESSION, $data, $search, $searchstring, $major;
		global $UCC_SIZE_WIDTH, $UCC_SIZE_HEIGHT;

		$_POST = array_map('mysql_escape_string', $_POST);
		$_GET = array_map('mysql_escape_string', $_GET);

		$this->bbs			= $bbs;

		$this->c_BoardKey	= $BoardKey;
		$this->c_Sub_No		= $Sub_No;

		$this->c_SecAdmin	= $SecAdmin;

		$configBBS = DBarray("SELECT * FROM abbs_manager WHERE board_key='".$BoardKey."'"); //�Խ��� �����ε�
		if($_SESSION[s_id]=="admin"){$SecAdmin=1;}
		//function makebbs($bbs, $BoardKey, $Sub_No, $DBTable, $bbspart, $Listcount, $SecAdmin, $bbs_userqry="", $bbs_subqry="") {

		/*
		$configBBS[board_id];	//������̺�
		$configBBS[board_name];	//�Խ��� �̸�

		$configBBS[board_skin];	//�Խ��ǽ�Ų
		$configBBS[module_editor];	//�Խ��� ��Ƽ�� ���
		$configBBS[module_uploader]; //�Խ��� ���ε� ���

		$configBBS[board_category]; //ī�װ��� ��뿩��

		$configBBS[board_commentuse]; //��� ��뿩��

		$configBBS[board_listnum]; //�������� ��¼�
		$configBBS[board_listview]; //�Խ��� ���⿡�� ����Ʈ�ε�

		$configBBS[board_width]; //�Խ��� ������
		$configBBS[board_titlecut]; //����Ʈ �������


		$configBBS[board_checkcolumn]; //���&������ �ʼ�üũ
		$configBBS[board_checktitle]; //���&������ �ʼ�üũ

		$configBBS[board_secure]; //��б� �ۼ�


		$configBBS[board_viewimg]; //���������� �̹��� �ڵ�����
		$configBBS[board_viewimgwidth]; //���������� �̹�������ũ��


		$configBBS[board_upfile]; //���ε� ���ϰ���
		$configBBS[board_upfilesize]; //���ε� ���� ���ϻ�����

		$configBBS[board_topinclude]; //��� ��ũ���
		$configBBS[board_bottominclude]; //�ϴ� ��ũ���
		*/

		//���Ѹ��� ����
		include $_SERVER["DOCUMENT_ROOT"]."/bbs/auth_config.php";


		//�۾���� �ڵ� �̸�, �н����� �ڵ����
		// $auto_bbs_input ����
		// true  �� ��� input�� textŸ������ ���
		// false �� ��� input�� hiddenŸ�� & $auto_bbs_username���
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
		$configBBS[auth_admin];	//�� ������ Y�� ��� �����Խ��� (�����ڸ� ���ۼ��� ������)

		$configBBS[auth_list_use];	//����Ʈ���� ��뿩��
		$configBBS[auth_read_use];	//������� ��뿩��
		$configBBS[auth_write_use];	//������� ��뿩��
		$configBBS[auth_reply_use];	//��۱��� ��뿩��
		$configBBS[auth_comment_use];	//��۱��� ��뿩��
		$configBBS[auth_upload_use];	//���ε���� ��뿩��
		$configBBS[auth_download_use];	//�ٿ�ε���� ��뿩��



		$configBBS[auth_list];	//����Ʈ���� ���Ǻ񱳰�
		$configBBS[auth_read];	//������� ���Ǻ񱳰�
		$configBBS[auth_write];	//������� ���Ǻ񱳰�
		$configBBS[auth_reply];	//��۱��� ���Ǻ񱳰�
		$configBBS[auth_comment];	//��۱��� ���Ǻ񱳰�
		$configBBS[auth_upload];	//���ε���� ���Ǻ񱳰�
		$configBBS[auth_download];	//�ٿ�ε���� ���Ǻ񱳰�
		*/

		//������ ������ ��� �ٸ� ������ �����ϰ� ����������������
		if($configBBS[auth_admin] == "Y"){
			$configBBS[auth_list_use] = "N";	//����Ʈ���� ��뿩��
			$configBBS[auth_read_use] = "N";	//������� ��뿩��
			$configBBS[auth_write_use] = "Y";	//������� ��뿩��
			$configBBS[auth_reply_use] = "Y";	//��۱��� ��뿩��
			$configBBS[auth_comment_use] = "Y";	//��۱��� ��뿩��
			$configBBS[auth_upload_use] = "Y";	//���ε���� ��뿩��
			$configBBS[auth_download_use] = "N";	//�ٿ�ε���� ��뿩��



			$configBBS[auth_list] = "";	//����Ʈ���� ���Ǻ񱳰�
			$configBBS[auth_read] = "";	//������� ���Ǻ񱳰�
			$configBBS[auth_write] = "OnlyAdmin";	//������� ���Ǻ񱳰�
			$configBBS[auth_reply] = "OnlyAdmin";	//��۱��� ���Ǻ񱳰�
			$configBBS[auth_comment] = "OnlyAdmin";	//��۱��� ���Ǻ񱳰�
			$configBBS[auth_upload] = "OnlyAdmin";	//���ε���� ���Ǻ񱳰�
			$configBBS[auth_download] = "";	//�ٿ�ε���� ���Ǻ񱳰�
		}

		if($_SESSION["ID"]=="2049" || $_SESSION["ID"]=="2071"){
			$bbs_authgroup = "GS";
			$SecAdmin = "1";
		}

		//�������� ��� ��ܿ� �Խ��� �̸� ���
		if($SecAdmin == 1){

			echo "
				<table border=0 cellpadding=0 cellspacing=0 width=100%>
				 <tr>
				   <td height=50 align=center><strong>[".$configBBS[board_name]."]</strong></td>
				 </tr>
				</table>
			";

		}




		//��ġ ������ ��������
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


		//���ε� ��������
		if($configBBS[module_uploader] == "InnoAP.php"){

			$ScrpitUploadCheck = " if(InnoAPSubmit(form)) form.submit(); ";
			$ScrpitUploadCheckModify = " StartUpload(form); ";

		}else if($configBBS[module_uploader] == "MakeUCC.php"){

			//MAKE UCC��� �ε�
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

		//�Խ��� ����ũ����
		if($configBBS[board_width] > 100)	$configBBS[board_width] = $configBBS[board_width]."px";
		else								$configBBS[board_width] = $configBBS[board_width]."%";


		//ī�װ����� ���� ��� ������ �迭�� ���
      	if($configBBS[board_category])	$board_category = explode("|", $configBBS[board_category]);
      	//print_R($board_category);
      	//��б��� ���� �� ���
      	if($configBBS[board_secure] != "N")	$board_secure = $configBBS[board_secure];
      	if($board_secure == "E") $board_secure_style = " style='display:none'";


		//�Խ��� �׼� ������ ������ ����Ʈ��
	    if(!$bbs) $bbs = "list";



		// �Խ��� Depth ��������
		/*
		if(!$Sub_No) $Sub_Que = "";
		else		 $Sub_Que = "Sub_No='$Sub_No' AND ";
		*/
		if(!$BoardKey && !$Sub_No)		$Code_Que = "";
		else if($BoardKey && !$Sub_No)	$Code_Que = " and code='$BoardKey'";
		else if(!$BoardKey && $Sub_No)	$Code_Que = " and sub_no='$Sub_No'";
		else if($BoardKey && $Sub_No)	$Code_Que = " and code='$BoardKey' and sub_no='$Sub_No'";
		else	$Code_Que = "";


		//�߰����� ó��
		if($bbs_userqry)	$Code_Que .= $Code_Que." and userid='$bbs_userqry' and re_step = '0' and re_level = '0' ";
		if($bbs_subqry)		$Code_Que .= $Code_Que." ".$bbs_subqry;

		if($bbs_subcolumnqry)	$bbs_subcolumnqry = str_replace("[[BBSDBTABLE]]", $configBBS[board_id], $bbs_subcolumnqry);

///*** �۾��� ���� ���� ���� by jhko 2018-09-07
		$division = "NN";
		/*
		if($_SESSION['USER_KIND']=="3"){
			$division = "JW";
			$_SESSION['MEMBER_GROUP']="JW";
		}
		*/


		if($_SESSION['USER_KIND']=="2"){
			$division = "GS";
		}else if($_SESSION['USER_KIND']=="3"){
			$division = "JK";
		}else if($_SESSION['USER_KIND']=="0"){
			$division = "HS";
		}
		$_SESSION['MEMBER_GROUP'] = $division;
		///*** �۾��� ���� ���� ���� by jhko 2018-09-07

	if($bbs=="list") {

			unset($_SESSION["_BBS_DELETE_CONN"]); // PHP7: session_unregister removed

			$dataArr=Decode64($data);

            $pagecnt=$dataArr[pagecnt];
            $letter_no=$dataArr[letter_no];
            $offset=$dataArr[offset];

            if(!$searchstring){ //�˻�
          	  $search=$dataArr[search];
          	  $searchstring=$dataArr[searchstring];
            }

            if($searchstring) $numresults=DBquery("SELECT idx FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%'"); //�˻�
            else $numresults=DBquery("SELECT idx FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." ");
//print_R("SELECT idx FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." ");

            //�� ���ڵ��
			$numrows=mysql_num_rows($numresults);

            //�������� �� ��
			$LIMIT = $configBBS[board_listnum];

			//������ ������ ��
			$PAGEBLOCK	= 10;

            //������ ��ȣ
			if($pagecnt==""){$pagecnt=0;}

			//�� �������� ���� ��
			if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;}

			//�۹�ȣ
			if(!$letter_no) $letter_no=$numrows;
			else			$letter_no=$letter_no;

			//��ü������ ��
			$TotalPage = ceil($numrows / $LIMIT);

			//����������
			$NowPage = ($offset/$LIMIT)+1;



            //�˻��� ����Ʈ����
            if($searchstring){
          	  $bbs_qry = "SELECT ";
          	  $bbs_qry .= " * ";
          	  $bbs_qry .= $bbs_subcolumnqry;
          	  $bbs_qry .= " FROM ".$configBBS[board_id]." A WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%' ";
			  if($configBBS['board_id']=="bbs_ipsi6" && $BoardKey=="1515"){
				  $bbs_qry .= " AND idx !='58608' ";
			  }
          	  $bbs_qry.= " ORDER BY ref DESC,re_step ASC LIMIT $offset,$LIMIT";
            }else{
          	  $bbs_qry = "SELECT * ";
          	  $bbs_qry .= $bbs_subcolumnqry;
          	  //$bbs_qry .= " FROM ".$configBBS[board_id]." A WHERE idx > 0 ".$Code_Que." ORDER BY  notice ASC, writeday DESC, ref DESC,re_step ASC LIMIT $offset,$LIMIT";
			  //��� ���� ������ writeday desc ���� ( 2016-11-07 )
			  $bbs_qry .= " FROM ".$configBBS[board_id]." A WHERE idx > 0 ".$Code_Que;
			  if($configBBS['board_id']=="bbs_ipsi6" && $BoardKey=="1515"){ //����
				  $bbs_qry .= " AND idx !='58608' ";
			  }
			  $bbs_qry .= " ORDER BY  notice ASC, ref DESC,re_step ASC LIMIT $offset,$LIMIT";
            }


			//echo "<!--".$bbs_qry."-->";
			if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
				//print_R($configBBS[auth_write_use]);
				//print_R($_SESSION);
				//print_R($bbs_qry);
			}
			//�۽��� ��������
			if($configBBS[auth_write_use] = 'Y' && !$_SESSION['division']){ //�α����� ���� ������ �Խ��� ��� ����
				echo $_BBS_Written = "";
			}else{
				if($SecAdmin != 1 && $configBBS[auth_write] && @strpos(",".$configBBS[auth_write], $bbs_authgroup) == false){
					$_BBS_Written = "";
				}else{
					//�۾��� ��ũ
					$encode_data = "Sub_No=$Sub_No&Boardkey=$BoardKey&DBTable=$configBBS[board_id]";
					$data    = Encode64($encode_data);
					if($major){
						$_BBS_Written	=	"$PHP_SELF?bbs=compose&major=$major&data=$data";
					}else{
						$_BBS_Written	.=	"$PHP_SELF?bbs=compose&data=$data";
					}
					//echo $_BBS_Written;
				}
			}



		   // �˻��� ��ũ��Ʈ �߰�
		   echo "
                  <SCRIPT Language=\"JavaScript\">
                  function XSS_Check(strTemp, level) {
					if ( level == undefined || level == 0 ) {
						strTemp = strTemp.replace(/\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-/g,'');
					}
					else if (level != undefined && level == 1 ) {
						strTemp = strTemp.replace(/\</g, '&lt;');
						strTemp = strTemp.replace(/\>/g, '&gt;');
					}
					return strTemp;
				}
                  function searchSendit()
                  {
                  	var form=document.searchForm;

                  	if(form.searchstring.value==\"\"){
                  		alert(\"�˻� ������ �Է��� �ֽʽÿ�.\");
                  		form.searchstring.focus();
                  		return false;
                  	}else{
						form.searchstring.value=XSS_Check(form.searchstring.value,0);
                  		return true;
                  	}
                  }

                  </SCRIPT>
		    ";


	} elseif($bbs=="compose") {

      	$dataArr=Decode64($data);
      	//print_R($dataArr);
      	unset($_SESSION["_BBS_DELETE_CONN"]); // PHP7: session_unregister removed
	    $_BBS_WRITE_CONN = $_SESSION["_BBS_WRITE_CONN"] = $BoardKey; // PHP7: session_register removed, $_SESSION assign above is sufficient

	    //�������� ����
	    if($SecAdmin == 1){
	    	$_BBS_SecAdmin = $_SESSION["_BBS_SecAdmin"] = $SecAdmin; // PHP7: session_register removed
	    }

      	if(!empty($dataArr[idx]))
      	{
      		$bbs_qry="SELECT * FROM ".$configBBS[board_id]." WHERE idx=$dataArr[idx]";
      		$bbs_result=@DBquery($bbs_qry);
      		$bbs_row=@mysql_fetch_array($bbs_result);
      	}


      	//��� ��������
      	if($bbs_row[idx]) {

			if($SecAdmin != 1 && $configBBS[auth_reply_use] == "Y" && $configBBS[auth_reply] && @strpos(",".$configBBS[auth_reply], $bbs_authgroup) == false){
				go_back("��۾��� ������ �����ϴ�.");
				exit;
			}

		//�۾��� ��������
      	}else{
			if($SecAdmin != 1 && $configBBS[auth_write_use] == "Y" && $configBBS[auth_write] && @strpos(",".$configBBS[auth_write], $bbs_authgroup) == false){
				go_back("�۾��� ������ �����ϴ�.");
				exit;
			}
      	}


      	//��Ͻ� üũ���� �迭�� ����
		$checkcolumn = explode(",",$configBBS[board_checkcolumn]);
		$checktitle = explode(",",$configBBS[board_checktitle]);

		// ��Ͻ� ��ũ��Ʈ �߰�
		echo "
		<SCRIPT LANGUAGE=\"JavaScript\">

			function bbsSendit()
			{
			var form=document.writeform;
			$ScrpitBodyCheck
		";
       if($BoardKey=="1419"){
				 echo "
				if(form.agreement.checked==false){
					alert('����������޹�ħ�� ������ �ֽʽÿ�');
					form.agreement.focus();
			 }
				 else if(form.fm_name.value==''){
					 alert('�ۼ��ڸ� �Է��� �ֽʽÿ�');
					 form.fm_name.focus();
					}
					else if(form._mail.value==''){
						alert('�̸����� �Է��� �ֽʽÿ�');
						form._mail.focus();
					}
					else if(form._tel.value==''){
						alert('����ó�� �Է��� �ֽʽÿ�');
						form._tel.focus();
					}
					else if(form._zip.value==''){
						alert('�ּҸ� �Է��� �ֽʽÿ�');
						form._zip.focus();
					}
					else if(form._addr2.value==''){
						alert('�ּҸ� �Է��� �ֽʽÿ�');
						form._addr2.focus();
					}
					else if(form.fm_title.value==''){
						alert('������ �Է��� �ֽʽÿ�');
						form.fm_title.focus();
					}
					else if(form.fm_pwd.value==''){
						alert('��й�ȣ�� �Է��� �ֽʽÿ�');
						form.fm_pwd.focus();
					}
					else if(content==''){
						alert('������ �Է��� �ֽʽÿ�');
						edt.focus();
					}else{
					form.submit();
			 }
				 ";
			 }else{
		for($i=0; $i < count($checkcolumn); $i++){

			$input_column = "fm_".trim($checkcolumn[$i]);
			$input_title = trim($checktitle[$i]);

			if($i == 0)	$checkaddcon = "";
			else		$checkaddcon = "else ";

			if($checkcolumn[$i] == "content"){
				echo $checkaddcon."if(content==\"\"){
		       			alert(\"".$input_title."��(��) �Է��� �ֽʽÿ�.\");
		       			edt.focus();
					}
				";
			}else{
				echo $checkaddcon."if(form.$input_column.value==\"\"){
		       			alert(\"".$input_title."��(��) �Է��� �ֽʽÿ�.\");
		       			form.$input_column.focus();
					}
				";
			}
    	}

       echo "
		       else{
		        	".$ScrpitUploadCheck."
		        }";
			 }
       echo "}
       </SCRIPT>
       ";


	} elseif($bbs=="see") {


		//�������� ����
	    if($SecAdmin == 1){
	    	$_BBS_SecAdmin = $_SESSION["_BBS_SecAdmin"] = $SecAdmin; // PHP7: session_register removed
	    }

		//���뺸�� ��������
		if($SecAdmin != 1 && $configBBS[auth_read_use] == "Y" && $configBBS[auth_read] && @strpos(",".$configBBS[auth_read], $bbs_authgroup) == false){
			go_back("���뺸�� ������ �����ϴ�.");
			exit;
		}
			  $dataArr = Decode64($data);

			  $_BBS_DELETE_CONN = $_SESSION["_BBS_DELETE_CONN"] = $dataArr[idx]; // PHP7: session_register removed

              //$check=DBarray("SELECT COUNT(*) FROM ".$configBBS[board_id]." WHERE code='".$BoardKey."' AND idx='".$dataArr[idx]."'");
              $check=DBarray("SELECT COUNT(*) FROM ".$configBBS[board_id]." WHERE idx='".$dataArr[idx]."'");

			  if($check[0]<1) go_back("�Խù��� �������� �ʽ��ϴ�. ");

			  //$view_row = DBarray("SELECT * FROM ".$configBBS[board_id]." WHERE code='".$BoardKey."' AND idx='".$dataArr[idx]."'"); //�Խ��� ����
			  $view_row = DBarray("SELECT * FROM ".$configBBS[board_id]." WHERE idx='".$dataArr[idx]."'"); //�Խ��� ����

			  //��б� ��������
			  if($view_row[view_secret] == "Y" && $SecAdmin != 1){

			  	if($bbs_userid){
			  		if($view_row[userid] != $bbs_userid)	go_back("��б��� ���� �̿ܿ��� ���� �� �����ϴ�. ");
			  	}else if($bbs_adminid){
			  		if($view_row[adminid] != $bbs_adminid)	go_back("��б��� ���� �̿ܿ��� ���� �� �����ϴ�. ");
			  	}else{
			  		if($_SESSION["_BBS_VIEW_LOGIN"] != $view_row[pwd]){
			  			go_back("��б��� ���� �ۼ��Ͻ� �� �̿ܿ��� ���� �� �����ϴ�.");
			  		}
			  	}
			  }


          	// count overlapping check
          	if($_SESSION[_BBS_COUNT_VIEW] != $view_row[idx]) {

          	    $_SESSION["_BBS_COUNT_VIEW"] = $view_row[idx]; // PHP7: session_register removed

          	    @DBquery("update ".$configBBS[board_id]." set readnum=readnum+1 where idx=$dataArr[idx]");
          	    $readnum = $view_row[readnum]+1;

          	}else{
          		$readnum = $view_row[readnum];
          	}

			// ��������
			if($configBBS[module_editor] == "None.php" || $configBBS[module_editor] == ""){
				$content = str_replace("\n","<br>", $view_row[content]);
			}else{
				$content = $view_row[content];
			}
			$writeday = explode("-",substr($view_row[writeday],0,11));
			$writeday2 = str_replace("-",".",$view_row['writeday']);
			$bbs_name = $view_row[name];

			$up_file_count = $view_row[up_file];
	      	$up_file_idx = $view_row[up_file_idx];


		    //÷�������� ������
		    if($up_file_count > 0){

			    $filev = 0;
				// 2019.07.10 By.Son ÷������ ���� �߰�
				$file_sql = "SELECT * FROM ".$configBBS[board_id]."_file WHERE up_file_idx='".$up_file_idx."'";
				$file_sql .= " order by up_filename asc ";
			    $file_result = DBquery($file_sql);
			    while($file_row=mysql_fetch_array($file_result)){

					//�Ϲ� ÷������ �� ���
					if ($file_row[up_filepath] && $file_row[file_type] < 10){

						$encode_str = "Boardkey=".$BoardKey."&DBTable=".$configBBS[board_id]."&idx=".$file_row[idx]."&download=ok";
						$down_data=Encode64($encode_str);

						//$upfile_link[$filev] .=  $file_row[up_filepath];
						//$upfile_link[$filev] .=  "<a href='/bbs/download.php?data=".$down_data."'>".$file_row[up_filename]."</a> ";

						//����üũ ����
						if(file_exists($_SERVER["DOCUMENT_ROOT"]."/bbs/".$file_row[up_filepath])){
							//�����ʿ��� �ø� ���� ������.
							$upfile_link[$filev] .=  "<a href='/bbs/download.php?data=".$down_data."'>".$file_row[up_filename]."</a>";
						}else{
							//���п� ������ �а��� ����
							$upfile_link[$filev] .=  "<a href='http://nurs.ch.ac.kr/bbs/download.php?data=".$down_data."'>".$file_row[up_filename]."</a> ";
						}

						$filev = $filev+1;

						if($configBBS[board_viewimg] == "Y" && $file_row[file_type] > 0 && $file_row[file_type] < 5){
							$upfile_imgview .= "<div id='bbs_imageview'><img src='/bbs/imageview.php?data=".$down_data."' onload=sizeModify(this);></div>";
						}
					}

					//UCC�� ���
					if($file_row[up_filepath] && $file_row[file_type] == 10) {
						$upfile_uccview .= "<embed src='http://".$_SERVER['HTTP_HOST']."/bbs/Extention/Uploader/MakeUCC/makeucc.swf' quality='high' wmode='transparent' devicefont='true' bgcolor='#ffffff' width='".$UCC_SIZE_WIDTH."' height='".$UCC_SIZE_HEIGHT."' id='bbsucc_".time()."' name='bbsucc_".time()."' align='middle' allowScriptAccess='always' allowfullscreen='true' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' ";
						$upfile_uccview .= " flashvars='ComURL=http://".$_SERVER['HTTP_HOST']."/bbs/Extention/Uploader/MakeUCC/&ComSrv_ID=iuk&MovieID=".$file_row[idx]."&playicon=null&WatermarkURL=null&BannerURL=null&ComSrv_AdText=null&ViewerParam1=".$configBBS[board_id]."&ViewerParam2=' /> ";
					}
					//<embed src='/bbs/Extention/Uploader/MakeUCC/makeucc.swf' quality='high' wmode='transparent' devicefont='true' bgcolor='#ffffff' width='600' height='400' id='bbsucc_".time()."' name='bbsucc_".time()."' align='middle' allowScriptAccess='always' allowfullscreen='true' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer'
					//flashvars='ComURL=http://".$_SERVER['HTTP_HOST']."/bbs/Extention/Uploader/MakeUCC/&ComSrv_ID=iuk&MovieID=".$file_row[idx]."&playicon=null&WatermarkURL=null&BannerURL=null&ComSrv_AdText=null&ViewerParam1=".$configBBS[board_id]."&ViewerParam2=' />

			    }

				//�ۺ��⿡�� �̹������
				$content = $upfile_uccview.$upfile_imgview.$content;
			}

			//$content = url_auto_link($content);

			//�ٿ�ε� ��������
			if($SecAdmin != 1 && $configBBS[auth_download_use] == "Y" && $configBBS[auth_download] && @strpos(",".$configBBS[auth_download], $bbs_authgroup) == false){

				$upfile_view = "<span style='font-size:11px; color:#BBBBBB;'>�ٿ�ε� ������ �����ϴ�.</span>";

			}else{

				if($filev > 0){
					$upfile_view = "<div onclick=\"DisplayDetail('div_filedown',1)\" style='cursor:hand'>";
					$upfile_view .= "<span style='font-size:11px; color:#8c8b8b;'>÷������</span><span style='font-size:11px; color:#005D79;'>(".$up_file_count.")</span> <img src='/bbs/skin/".$configBBS[board_skin]."/images/filedown.gif' align='absmiddle' alt='filedown' />";
					$upfile_view .= "</div>";
				}else{

					$upfile_view = "<span style='font-size:11px; color:#BBBBBB;'>÷�������� �����ϴ�.</span>";
				}
			}


			//�ڸ�Ʈ ��������
			if($SecAdmin != 1 && $configBBS[auth_comment] && @strpos(",".$configBBS[auth_comment], $bbs_authgroup) == false){
				$_BBS_commented = "";
			}else{
				$_BBS_commented = "OK";
			}


			//�۾��� ��������
			if($SecAdmin != 1 && $configBBS[auth_write] && @strpos(",".$configBBS[auth_write], $bbs_authgroup) == false){
				$_BBS_Written = "";

				$_BBS_Modified = "";
				$_BBS_Deleted = "";

				$_BBS_Password = "";

			}else{
				//���⿡�� �۾��� ��ũ
				$wencode_data = "Boardkey=$dataArr[Boardkey]&Sub_No=$dataArr[Sub_No]&DBTable=$dataArr[DBTable]";
  			  	$wdata    = Encode64($wencode_data);
  			  if($major){
						$_BBS_Written	=	"$PHP_SELF?bbs=compose&major=$major&data=$wdata";
					}else{
			  		$_BBS_Written	=	"$PHP_SELF?bbs=compose&data=$wdata";
			  	}
			  	$_BBS_Modified = "javascript:bbsEdit();";
				$_BBS_Deleted = "javascript:bbsDel();";


				//�н����� �ڵ�ǥ�� ����
				if($SecAdmin == 1){
					$_BBS_Password = "<input type='hidden' name='pwd' value='".$view_row[pwd]."'>";
				}else if($view_row[userid] != "" && $view_row[userid] == $bbs_userid){
					$_BBS_Password = "<input type='hidden' name='pwd' value='".$view_row[pwd]."'>";
				}else if($view_row[adminid] != "" && $view_row[adminid] == $bbs_adminid){
					$_BBS_Password = "<input type='hidden' name='pwd' value='".$view_row[pwd]."'>";
				}else{
					if($_SESSION[USER_KIND]>2){
						$_BBS_Password = "<input type='hidden' name='pwd' value='".$view_row[pwd]."'>";
					}else{
						$_BBS_Password = "<input type='password' name='pwd' value='' style='width:80px;'>&nbsp;";
					}
				}
			}


			//�亯���� ��������
			if($SecAdmin != 1 && $configBBS[auth_reply] && @strpos(",".$configBBS[auth_reply], $bbs_authgroup) == false){
				$_BBS_Replied = "";
			}else{
			  	$_BBS_Replied	=	"$PHP_SELF?bbs=compose&data=$data";
			}

			//var_dump($configBBS);

			$list_link = "$PHP_SELF?bbs=list&data=$data"; //��ϸ�ũ


			  // ��ũ��Ʈ �߰�
              echo "
              <SCRIPT Language=\"JavaScript\">

              function bbsEdit()
              {
              	var form=document.pwdForm;
              	if(form.pwd.value==\"\"){
              		alert(\"��й�ȣ�� �Է��� �ֽʽÿ�.\");
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
              		alert(\"��й�ȣ�� �Է��� �ֽʽÿ�.\");
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

	        unset($_SESSION["_BBS_DELETE_CONN"]); // PHP7: session_unregister removed
	      	$_BBS_WRITE_CONN = $_SESSION["_BBS_WRITE_CONN"] = $dataArr[idx]; // PHP7: session_register removed

	      	if($dataArr[idx]) {

	      		$bbs_row = DBarray("SELECT * FROM ".$configBBS[board_id]." WHERE idx='".$dataArr[idx]."'");

	      	    if($_SESSION[_BBS_PASS_LOGIN]!=$bbs_row[pwd]) go_back("\\n �߸��� �����Դϴ�. \\n");
	      	}else{
	      		go_back("\\n �߸��� �����Դϴ�. \\n");
	      	}

	      	$up_file_count = $bbs_row[up_file];
	      	$up_file_idx = $bbs_row[up_file_idx];


	      	//��Ͻ� üũ���� �迭�� ����
			$checkcolumn = explode(",",$configBBS[board_checkcolumn]);
			$checktitle = explode(",",$configBBS[board_checktitle]);

			// ��Ͻ� ��ũ��Ʈ �߰�
			echo "
			<SCRIPT LANGUAGE=\"JavaScript\">

				function bbsSendit()
				{
				var form=document.writeform;
				".$ScrpitBodyCheck."
			";
	       if($BoardKey=="1419"){
				 echo "
				 if(form.fm_name.value==''){
					 alert('�ۼ��ڸ� �Է��� �ֽʽÿ�');
					 form.fm_name.focus();
					}
					else if(form._mail.value==''){
						alert('�̸����� �Է��� �ֽʽÿ�');
						form._mail.focus();
					}
					else if(form._tel.value==''){
						alert('����ó�� �Է��� �ֽʽÿ�');
						form._tel.focus();
					}
					else if(form._zip.value==''){
						alert('�ּҸ� �Է��� �ֽʽÿ�');
						form._zip.focus();
					}
					else if(form._addr2.value==''){
						alert('�ּҸ� �Է��� �ֽʽÿ�');
						form._addr2.focus();
					}
					else if(form.fm_title.value==''){
						alert('������ �Է��� �ֽʽÿ�');
						form.fm_title.focus();
					}
					else if(form.fm_pwd.value==''){
						alert('��й�ȣ�� �Է��� �ֽʽÿ�');
						form.fm_pwd.focus();
					}
					else if(content==''){
						alert('������ �Է��� �ֽʽÿ�');
						edt.focus();
					}
				 ";
			 }else{
			for($i=0; $i < count($checkcolumn); $i++){

				$input_column = "fm_".trim($checkcolumn[$i]);
				$input_title = trim($checktitle[$i]);

				if($i == 0)	$checkaddcon = "";
				else		$checkaddcon = "else ";

				if($checkcolumn[$i] == "content"){
					echo $checkaddcon."if(content==\"\"){
			       			alert(\"".$input_title."��(��) �Է��� �ֽʽÿ�.\");
			       			edt.focus();
						}
					";
				}else{
					echo $checkaddcon."if(form.$input_column.value==\"\"){
			       			alert(\"".$input_title."��(��) �Է��� �ֽʽÿ�.\");
			       			form.$input_column.focus();
						}
					";
				}
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

		//$bbs �׼��� ���°��

	}



	   if($configBBS[board_topinclude]) include $_SERVER["DOCUMENT_ROOT"].$configBBS[board_topinclude];	//��� ��Ŭ���

	   switch($bbs){

		case 'list' :

			//����Ʈ ��������
			if($SecAdmin != 1 && $configBBS[auth_list_use] == "Y" && $configBBS[auth_list] && @strpos(",".$configBBS[auth_list], $bbs_authgroup) == false){

				echo "����Ʈ ���� ������ �����ϴ�.";

			}else{

				if (($BoardKey == "1911" || $BoardKey == "1912" ||$BoardKey == "1913")&& $SecAdmin == "1"){
					include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/list_admin.php";
				}else {
					include $_SERVER["DOCUMENT_ROOT"]."/bbs/skin/".$configBBS[board_skin]."/list.php";
				}

			}



			break;

		case 'see' :
			if (( $BoardKey == "1911" || $BoardKey == "1912" ||$BoardKey == "1913")&& $SecAdmin == "1"){
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

	            if(!$searchstring){ //�˻�
	          	  $search=$dataArr[search];
	          	  $searchstring=$dataArr[searchstring];
	            }

	            if($searchstring) $numresults=DBquery("SELECT idx FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%'"); //�˻�
	            else $numresults=DBquery("SELECT idx FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." ");


	            //�� ���ڵ��
				$numrows=mysql_num_rows($numresults);

	            //�������� �� ��
				$LIMIT = $configBBS[board_listnum];

				//������ ������ ��
				$PAGEBLOCK	= 10;

	            //������ ��ȣ
				if($pagecnt==""){$pagecnt=0;}

				//�� �������� ���� ��
				if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;}

				//�۹�ȣ
				if(!$letter_no) $letter_no=$numrows;
				else			$letter_no=$letter_no;

				//��ü������ ��
				$TotalPage = ceil($numrows / $LIMIT);

				//����������
				$NowPage = ($offset/$LIMIT)+1;

	            //�˻��� ����Ʈ����
	            if($searchstring){
	          	  $bbs_qry = "SELECT * FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." AND $search LIKE '%$searchstring%' ";
	          	  $bbs_qry.= " ORDER BY ref DESC,re_step ASC LIMIT $offset,$LIMIT";
	            }else{
	          	  $bbs_qry = "SELECT * FROM ".$configBBS[board_id]." WHERE idx > 0 ".$Code_Que." ORDER BY notice ASC, ref DESC,re_step ASC LIMIT $offset,$LIMIT";
	            }

				//echo $bbs_qry;

				$encode_data = "Sub_No=$Sub_No&Boardkey=$BoardKey&DBTable=$configBBS[board_id]";
	  			$data    = Encode64($encode_data);

				//�۾��� ��ư
				if($major){
					$_BBS_Written	=	"$PHP_SELF?bbs=compose&major=$major&data=$data";
				}else{
					$_BBS_Written	=	"$PHP_SELF?bbs=compose&data=$data";
				}
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
	   if($configBBS[board_bottominclude]) include $_SERVER["DOCUMENT_ROOT"].$configBBS[board_bottominclude];	//�ϴ� ��Ŭ���

	}

}





// ������ �Ƣ� 1 [2][3][4][5] ��
class BList
{
	var $g_pageName;		//�������ϸ� ex) ****.php, OOOO.php

	var $g_pageCnt;			//���������� ��ȣ
	var $g_offset;			//����Ÿ���̽� ���� ����Ʈ ��ȣ
	var $g_numRows;			//�ѰԽù� ��
	var $g_pageBlock;		//������ ������ �� ex) 5 : [1][2][3][4][5]
	var $g_limit;			//�������� ��� �Խù� ��
	var $g_search;			//�˻� �÷� ex)name,title,...
	var $g_searchstring;	//�˻���

	var $g_option;			//�߰� get ��  ex) &getdata=$getdata

	var $g_pniView;			//��ũ���� ���� ������ ǥ�� ���� ex) true,1 : ǥ��  false,0 : ��ǥ��
	var $g_pIcon;			//���� ������
	var $g_nIcon;			//���� ������

	//
	// ������
	// BList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
	// BList(��������, ������������ȣ, DB����offset, �ѰԽù���, ��������������, ��������Խù���, �˻��÷�, �˻���, �߰�get��)
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
	// ������ ����
	// putList( BOOL pniView, char* pre_icon, char* next_icon)
	// putList( ��ũ���� ���� ������ ǥ�� ����, ����������, ����������, ó��, ������, ��ĭ����, ��ĭ����
	//
	function putList($pniView,$pre_icon,$next_icon,$first_icon,$last_icon,$pre1_icon,$next1_icon){
		$this->g_pniView=$pniView;					//��ũ���� ���� ������ ǥ�� ����
		if(empty($pre_icon))	$this->g_pIcon="<<";			//���� ������ ����
		else					$this->g_pIcon=$pre_icon;

		if(empty($next_icon))	$this->g_nIcon=">>";			//���� ������ ����
		else					$this->g_nIcon=$next_icon;

		if(empty($first_icon))	$this->g_fIcon="ó������";		//ó�� ������ ����
		else					$this->g_fIcon=$first_icon;

		if(empty($last_icon))	$this->g_lIcon="����������";	//������ ������ ����
		else					$this->g_lIcon=$last_icon;


		if(empty($pre1_icon))	$this->g_p1Icon="<";			//��ĭ���� ������ ����
		else					$this->g_p1Icon=$pre1_icon;

		if(empty($next1_icon))	$this->g_n1Icon=">";			//��ĭ���� ������ ����
		else					$this->g_n1Icon=$next1_icon;

		$this->pniPrint(); //ȭ�� ���
	}


	//
	// ȭ�� ���
	//
	function pniPrint(){
		global $category;

		$chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //���������� üũ

	    if($chekpage==$this->g_pageCnt){  //������ ������ ���....
			$pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //������ ���� �������� ���
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


		/*   ó��   */
		$data=Encode64("search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);
		echo "<a href=".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option.">".$this->g_fIcon."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";



		/*    ����   */
		if($this->g_pageCnt>0){				//���������� ����
			$prepage=$this->g_pageCnt-1;	//�������� ���������� ����.
			$pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//�������� ���۱� ��ȣ ����
		    $data=Encode64("pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);

	        $pre_str ="<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$this->g_pIcon."</a>&nbsp;";

		    echo "$pre_str"; 	//���������� ��ũ
		}else{					//���������� ����
			if($this->g_pniView)//������ ǥ��
				$empty_pre_str = $this->g_pIcon."&nbsp;";
				//$empty_pre_str = "&nbsp;";

		    else				//������ ��ǥ��
			    $empty_pre_str = "&nbsp;";

		    echo "$empty_pre_str";
		}




		/*    1�� ����   */
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
			$loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//���۱� ����
		    $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//������ ��ȣ ����
			$cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//���۱� ��ȣ ����
		    $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
		    $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
			$data=Encode64($en_str);
			if($lnum==(($this->g_offset/$this->g_limit)+1))	{//���� ������ �� ���
				echo " <font size='2'><b>$lnum</b></font> ";
				//echo $en_str;
			}else{
				$mid_str = " [<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$lnum."</a>] ";

				echo"$mid_str";
			}

			//echo $en_str;
			$l++;
	    }




	    /*    1�� ����   */
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




		/*    ����   */
		if($this->g_pageCnt!=$chekpage){		//���������� ����
			echo "&nbsp;";
			$newpagecnt=$this->g_pageCnt+1;		//���� ���� ���������� ����
			$newt=$cu_letter_no-$this->g_limit;	//���� ���� ���۱� ��ȣ ����
			$data=Encode64("pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);
			$next_str="<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$this->g_nIcon."</a>";

			echo $next_str;			//���� ������ ��ũ
		}else{						//���������� ����
			if($this->g_pniView)	//������ ǥ��
				echo"&nbsp;".$this->g_nIcon;
				//echo"&nbsp;";

			else					//������ ��ǥ��
				echo"&nbsp;";
		}


		/*   ������   */
		$data=Encode64("pagecnt=".$lastpagecnt."&letter_no=".$lastletter_no."&offset=".$lastoffset."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);

		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."&".$this->g_option."'>".$this->g_lIcon."</a>";

	}//function putList()
}//class



// ������ �Ƣ� 1 [2][3][4][5] ��
class CList
{
	var $g_pageName;		//�������ϸ� ex) ****.php, OOOO.php

	var $g_pageCnt;			//���������� ��ȣ
	var $g_offset;			//����Ÿ���̽� ���� ����Ʈ ��ȣ
	var $g_numRows;			//�ѰԽù� ��
	var $g_pageBlock;		//������ ������ �� ex) 5 : [1][2][3][4][5]
	var $g_limit;			//�������� ��� �Խù� ��
	var $g_search;			//�˻� �÷� ex)name,title,...
	var $g_searchstring;	//�˻���

	var $g_option;			//�߰� get ��  ex) &getdata=$getdata

	var $g_pniView;			//��ũ���� ���� ������ ǥ�� ���� ex) true,1 : ǥ��  false,0 : ��ǥ��
	var $g_pIcon;			//���� ������
	var $g_nIcon;			//���� ������

	//
	// ������
	// CList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
	// CList(��������, ������������ȣ, DB����offset, �ѰԽù���, ��������������, ��������Խù���, �˻��÷�, �˻���, �߰�get��)
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
	// ������ ����
	// putList( BOOL pniView, char* pre_icon, char* next_icon)
	// putList( ��ũ���� ���� ������ ǥ�� ����, ����������, ����������, ó��, ������, ��ĭ����, ��ĭ����
	//
	function putList($pniView,$pre_icon,$next_icon){
		$this->g_pniView=$pniView;					//��ũ���� ���� ������ ǥ�� ����
		if(empty($pre_icon))	$this->g_pIcon="<<";			//���� ������ ����
		else					$this->g_pIcon=$pre_icon;

		if(empty($next_icon))	$this->g_nIcon=">>";			//���� ������ ����
		else					$this->g_nIcon=$next_icon;

		$this->pniPrint(); //ȭ�� ���
	}


	//
	// ȭ�� ���
	//
	function pniPrint(){
		global $category;

		$chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //���������� üũ

	    if($chekpage==$this->g_pageCnt){  //������ ������ ���....
			$pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //������ ���� �������� ���
			if(!($this->g_numRows%($this->g_limit))){
	 			$pCnt--;
			}
		}else{
			$pCnt=$this->g_pageBlock;
		}


		$onstepcheck = ($this->g_offset/$this->g_limit)-($this->g_pageBlock*$this->g_pageCnt);



		/*    ����   */
		if($this->g_pageCnt>0){				//���������� ����
			$prepage=$this->g_pageCnt-1;	//�������� ���������� ����.
			$pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//�������� ���۱� ��ȣ ����
		    $data=Encode64("pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);

	        $pre_str ="<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$this->g_pIcon."</a>&nbsp;";

		    echo "$pre_str"; 	//���������� ��ũ
		}else{					//���������� ����
			if($this->g_pniView)//������ ǥ��
				$empty_pre_str = $this->g_pIcon."&nbsp;";
				//$empty_pre_str = "&nbsp;";

		    else				//������ ��ǥ��
			    $empty_pre_str = "&nbsp;";

		    echo "$empty_pre_str";
		}


		/* 1 [2][3][4][5] */
		$l=0;
		while($l<$pCnt){
			$loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//���۱� ����
		    $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//������ ��ȣ ����
			$cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//���۱� ��ȣ ����
		    $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
		    $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
			$data=Encode64($en_str);
			if($lnum==(($this->g_offset/$this->g_limit)+1))	{//���� ������ �� ���
				echo " <font size='2'><b>$lnum</b></font> ";
				//echo $en_str;
			}else{
				$mid_str = " [<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$lnum."</a>] ";

				echo"$mid_str";
			}

			//echo $en_str;
			$l++;
	    }



		/*    ����   */
		if($this->g_pageCnt!=$chekpage){		//���������� ����
			echo "&nbsp;";
			$newpagecnt=$this->g_pageCnt+1;		//���� ���� ���������� ����
			$newt=$cu_letter_no-$this->g_limit;	//���� ���� ���۱� ��ȣ ����
			$data=Encode64("pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option);
			$next_str="<a href='".$this->g_pageName."?data=".$data."&category=".$category."&".$this->g_option."'>".$this->g_nIcon."</a>";

			echo $next_str;			//���� ������ ��ũ
		}else{						//���������� ����
			if($this->g_pniView)	//������ ǥ��
				echo"&nbsp;".$this->g_nIcon;
				//echo"&nbsp;";

			else					//������ ��ǥ��
				echo"&nbsp;";
		}

	}//function putList()
}//class


//�Խ��ǿ� ��ũ����
function BBSButtonLink($BLINK, $BSRC, $VIEWOPT=""){

	// $VIEWOPT ������ ������ $BSRC ������ ���ϰ��� ���� 1�̸� ���̱�

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
