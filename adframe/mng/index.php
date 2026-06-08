<? include_once("_common.php"); ?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="<?=CHAR_TYPE?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" href="./css/lnb.css"  />
    <link rel="stylesheet" href="./css/common.css" />
    <link rel="stylesheet" href="./css/board.css" />
    <script src="./js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="./js/basic.js"></script>
    <!--[if lt IE 9]>
    <script src="./js/html5.js"></script>
    <script src="./js/modernizr-1.7.min.js"></script>
    <script src="./js/respond.min.js"></script>
    <script src="./js/IE7.js"></script>
    <![endif]-->
    <title>관리자페이지 &lt; <?=HEAD_TITLE?></title>
    <script>
        $(document).ready(function() {
            $('#btnLogout').bind('click', function() {
                if(confirm('로그아웃 하시겠습니까?')) {
                    location.replace("./login_ok.php?command=logoutAction");
                }
            })
        });
    </script>
</head>
<body>
<!-- wrapper -->
<div class="wrapper" id="wrapper" style="overflow: hidden; background-color: #fff;">
    <div class="header-wrapper">
        <div class="header-area">
            <div class="selsite-area">
                <form name="frm_selsite" id="frm_selsite" action="/adframe/mng/site_manager/selectSite.proc.php" method="post">
                    <?php
                    $selSite_sql ="SELECT * FROM  ".TABLE_SITE_MNG." mng ";
                    if($_SESSION['ADMIN_GROUP']=="S"||$_SESSION['ADMIN_GROUP']=="A")  $selSite_sql .=" INNER JOIN site_admin adm ON adm.site_id = mng.site_id ";
                    $selSite_sql .=" WHERE mng.use_yn ='Y' ";
                    if($_SESSION['ADMIN_GROUP']=="S"||$_SESSION['ADMIN_GROUP']=="A")  $selSite_sql .=" AND adm.id = '".$_SESSION['MEMBER_ID']."' ";
                    if($_SESSION['ADMIN_GROUP']=="F" || $_SESSION['ADMIN_GROUP']=="E")  $selSite_sql .=" AND mng.site_id = 'main' ";

                    $selSite_sql .=" ORDER BY mng.site_no asc ";

                    $selSite_result = mysql_query($selSite_sql) or die (mysql_error());
                    ?>
                    <select id="selSiteId" name="selSiteId" class="select">
                        <?php if($_SESSION['ADMIN_GROUP']=="T"){?> <option value="">통합 관리</option><? }?>
                        <?php while($selSite=mysql_fetch_array($selSite_result)) {?>
                            <option value="<?=$selSite['site_id']?>" <?php if($_SESSION['sel_site_id']==$selSite['site_id']) echo "selected";?>><?=$selSite['site_name']?></option>
                        <?php }?>
                    </select>
                    <button type="submit" class="btnSearch" id="fn_btn_search_website">선택</button>
                </form>
            </div>

            <a href="javascript:;" id="btnLogout" class="logout">
                <img src="./make_img/common/icon01.png" alt="로그아웃" />
                <?/*=$_SESSION['MEMBER_UNAME']*/?> Logout
            </a>

            <a href="/adframe/mng/member/change.myinfo.php" target="ifrm_index" class="logout">
                개인정보수정
            </a>

            <span class="user-name"><?=iconv("euckr","utf8",$_SESSION['MEMBER_UNAME'])?></span>
        </div>
    </div>
    <?
    // 좌측메뉴
    if($_SESSION['ADMIN_GROUP']=="T" && $_SESSION['sel_site_id']=="") include("_lnb.php"); //통합관리자
    if($_SESSION['ADMIN_GROUP']=="T" && $_SESSION['sel_site_id']!="" ) include("_cms_lnb.php"); //통합관리자
	if($_SESSION['ADMIN_GROUP']=="E" && $_SESSION['sel_site_id']!="" ) include("_cms_lnb.php"); //통합관리자
	if($_SESSION['ADMIN_GROUP']=="F" && $_SESSION['sel_site_id']!="" ) include("_cms_lnb.php"); //통합관리자
    if($_SESSION['ADMIN_GROUP']=="S"||$_SESSION['ADMIN_GROUP']=="A") include("_cms_lnb.php"); //사이트관리자



	//print_R($_SESSION);
    ?>
    <!-- Contents -->
    <iframe name="ifrm_index" id="ifrm_index" style="width: 100%; height: 100%; overflow-y: scroll;" frameborder="0" src="./include/index.php"> </iframe>
    <!-- Contents -->
</div>
<!-- //wrapper -->
<? include_once("./include/__footer.php"); ?>
</body>
</html>
