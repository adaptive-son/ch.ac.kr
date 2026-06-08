<?
define("__AF__", TRUE);
include_once(dirname(__FILE__) . "/../../adframe/af_common.php");
?>
<!doctype html>
<html lang="ko">
<head>
    <?
    if($TREE_ID=="") $TREE_ID = $_GET['site_id'];
    define(TREE_ID,$TREE_ID);
    include("../".$TREE_ID."/include/meta.php");
    if ( $TREE_NO == "" || !$TREE_NO ) go_back("페이지를 찾을 수 없습니다.");

	$sql = '';

	//검색조건
	$search = $_POST[search];
	//검색어
    $searchStr = $_POST[searchstring];
    //카테고리(행정부서 or 학과)
    $type = $_GET[type];
    if($type == ''){
        $type = 1;
    }

    $sql = "Select * From tel Where use_yn='Y' ";

    //검색내용
    if($searchStr != ''){
        if( $search == "category2"){ //소속검색
            $sql .= "AND t_category2 =".$searchStr;
        } else if( $search == 'position' ){ //직위검색
            $sql .= "AND t_position =".$searchStr;
        } else if( $search == 'telnum' ){ //전화번호검색
            $sql .= "AND t_telnum =".$searchStr;
        } else { //통합검색
            $sql .= "AND (t_category1 like '%".$searchStr."%') OR (t_category2 like '%".$searchStr."%') OR (t_position like '%".$searchStr."%') OR (t_descript like '%".$searchStr."%') OR (t_telnum like '%".$searchStr."%') OR (t_fax like '%".$searchStr."%')";
        }
    }

    if( $search == '' && $searchStr == '' ){
        if($type == 1){
            $sql .= "AND t_category1='행정부서' order by t_sort asc";
            //echo "<script>$('#tabmenu2').removeClass('active'); $('#tabmenu1').addClass('active');</script>";
        } else {
            $sql .= "AND t_category1='학과' order by t_sort asc";
            //echo "<script>$('#tabmenu1').removeClass('active'); $('#tabmenu2').addClass('active');</script>";
        }
    }

    $data = DBquery($sql);
	$row_num= mysql_num_rows($data);

    if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
        //print_r2($_POST);
        //echo $type;
        //echo $sql;
        //echo $row_num;
    }
    ?>

    <title><?=$PAGENAME4.$PAGENAME3.$PAGENAME2.$PAGENAME1._TAG_TITLE?></title>
</head>
<body>
	<?
		if($TREE_ID=="main") include "../_common/top_popup.php"
	?>

	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">본문 바로가기</a>
	</p>
	<!-- //skip navigation -->



<!-- wrapper -->
<div class="wrapper" id="wrapper">
    <!-- header -->
    <? include("../".$TREE_ID."/include/header.php");?>
    <!-- //header -->

	<!-- quick menu -->
	<? 
		if($TREE_ID=="main") {
	?>
			<div class="aside-quickmenu-wrapper" id="public-quickmenu">
				<button>
					<span>
						QUICK<br />
						MENU
					</span>

					<img src="/_common/img02/quickmenu/icon_arrow01.png" alt="" />
				</button>

				<!-- 퀵메뉴는 추후 학과들에게도 큇메뉴가 추가된다고 하여 assets쪽에 작업을 하였습니다 -->
				<? include "../_common/quickmenu.php" ?>
				<!-- //퀵메뉴는 추후 학과들에게도 큇메뉴가 추가된다고 하여 assets쪽에 작업을 하였습니다 -->
			</div>
	<? } ?>
	<!-- //quick menu -->

    <!-- sub visual -->
    <? include("../".$TREE_ID."/include/sub_visual.php"); ?>
    <!-- sub visual -->

    <!-- container -->
    <section>
        <div class="container" id="container">
            <? include("../".$TREE_ID."/include/contents_navi.php");?>
            <div class="container-wrapper">
                <!-- lnb -->
                <? include("../".$TREE_ID."/include/lnb.php");?>
                <!-- //lnb -->

                <!-- contents -->
                <article>
                    <div class="contents" id="contents">
                        <h3 class="contents-title">
                            <?=${"find_".$DEPTH."depth"}[$TREE_NO][NAME]?>
                            <span class="arrow"></span>
                        </h3>

                        <!-- contents-wrapper -->
                        <div class="contents-wrapper">
							
							<!-- CMS 시작 -->
							<div class="phone-search-wrapper">
								<div class="phone-search-area">
									<p>
										소속, 직위, 연락처 등으로 전화번호를 찾으실 수 있습니다.
									</p>

									<form name="searchForm" method="post" action="<?=$PHP_SELF?>?site_id=<?=$TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>&type=<?=$type?>">
										<input type="hidden" name="mode" value="list">
										<fieldset>
											<legend class="blind">
												교직원 및 교내전화번호 검색 폼
											</legend>
											<div class="phone-search-box">
												<select name="search" title="검색 조건 선택창">
													<option value="" selected="">전체</option>
													<option value="t_category2" <? if($search=="t_category2") echo "selected"; ?>>소속</option>
													<option value="t_position" <? if($search=="t_position") echo "selected"; ?>>직위</option>
													<option value="t_telnum" <? if($search=="t_telnum") echo "selected"; ?>>전화번호</option>
												</select>
												<input type="search" name="searchstring" id="searchstring" title="검색할 내용을 입력하세요" value="<?=$searchstring?>">
												<button type="submit">
													<img src="../_common/img02/icon/icon_search03.png" alt="">
													<span class="only-pc">
														검색
													</span>
												</button>
											</div>
										</fieldset>
									</form>
								</div>
								<div class="phone-search-area02">
									<h4>
										대표전화
										<span>
											(지역번호 052)
										</span>
									</h4>

									<div class="phone-search-box02">
										<dl>
											<dt>
												전화번호
											</dt>
											<dd>
												052) 270-0100
											</dd>
											
											<!--<dt>
												경비실
											</dt>
											<dd>
												052) 2700-168
											</dd>-->
											<dt>
												팩스번호
											</dt>
											<dd>
												052) 225-9889
											</dd>
										</dl>

										<p class="word-type01">
											※ 1000 이화관 / 2000 홍익관 / 3000 창의관 / 5000 이영선기념관 / 6000 도생관 / 7000 해악관 / 8000 명덕관
										</p>
									</div>
								</div>
							</div>

							<!-- Tab -->
							<div class="tabmenu-wrapper ratio no-mobile-title">
								<ul class="depth2">
									<li id="tabmenu1">
										<a href="<?=$PHP_SELF?>?site_id=<?=$TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>&type=1">
											행정부서 및 부속, 부설기관
										</a>
									</li>
									<li id="tabmenu2">
										<a href="<?=$PHP_SELF?>?site_id=<?=$TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>&type=2">
											학과사무실
										</a>
									</li>
								</ul>
							</div>

							<!-- table -->
							<div class="contents-area" id="tab1">
								<div class="table-type01">
									<table>
										<caption>
											<span class="blind">
												<? if($type == 1){?>
													행정부서 및 부속, 부설기관 전화번호 목록으로 소속(과), 직위, 담당업무, 전화번호, 위치 제공
												<?} else {?>
													학과사무실 전화번호 안내 : 학과(과), 직위, 전화번호, 위치에 관한 정보 제공표
												<?}?>
											</span>
										</caption>
										<colgroup>
											<? if($type == 1){?>
												<col style="width: 20%">
												<col style="width: 15%">
												<col style="width: 30%">
												<col style="width: 20%">
												<col style="width: 15%">
											<?} else {?>
												<col style="width: 25%">
												<col style="width: 25%">
												<col style="width: 25%">
												<col style="width: 25%">
											<?}?>
										</colgroup>
										<thead>
											<tr>
												<? if($type == 1){?>
													<th scope="col">소속(과)</th>
													<th scope="col">직위</th>
													<th scope="col">담당업무</th>
													<th scope="col">전화번호</th>
													<th scope="col">위치</th>
												<?} else {?>
													<th scope="col">학과(과)</th>
													<th scope="col">직위</th>
													<th scope="col">전화번호</th>
													<th scope="col">위치</th>
												<?}?>
											</tr>
										</thead>
										<tbody id="telInfo1">
										<? if($row_num == 0){ ?>
											<tr><td colspan="5">검색된 결과가 없습니다.</td></tr>
										<? }
											for( $i=0; $rows = mysql_fetch_array($data); $i++ ){
											?>
											<tr>
												<td><?=$rows[t_category2]?></td>
												<td><?=$rows[t_position]?></td>
												<? if($type == 1){?>
													<td><?=$rows[t_descript]?></td>
												<?}?>
												<td>
													<?=$rows[t_telnum]?>
													<? if($rows[t_fax]!="") { ?>
													<br><?=$rows[t_fax]?>
													<? } ?>
												</td>
												<td><?=$rows[t_location]?></td>
											</tr>	
										<? } ?>
										</tbody>
									</table>
								</div>
							</div>

							<div class="contents-area" id="tab2" style="display:none;">
								<div class="table-type01">
									<table>
										<caption>
											학과사무실 전화번호 안내 : 학과(과), 직위, 전화번호, 위치에 관한 정보 제공표
										</caption>
										<colgroup>
											<col style="width: 25%">
											<col style="width: 25%">
											<col style="width: 25%">
											<col style="width: 25%">
										<colgroup>
										<thead>
											<tr>
												<th scope="col">
													학과(과)
												</th>
												<th scope="col">
													직위
												</th>
												<th scope="col">
													전화번호
												</th>
												<th scope="col">
													위치
												</th>
											</tr>
										</thead>
										<tbody id="telInfo2">
											<?

												for( $i=0; $rows = mysql_fetch_array($data); $i++ ){
											?>
												<tr>
													<td><?=$rows[t_category2]?></td>
													<td><?=$rows[t_position]?></td>
													<td><?=$rows[t_telnum]?></td>
													<td><?=$rows[t_location]?></td>
												</tr>
											<? } ?>
										</tbody>
									</table>
								</div>
							</div>
							
							<!-- //CMS 끝 -->
						</div>
						<!-- //contents-wrapper -->
						
						<!-- page information -->
						<div class="manager-information-wrapper">
							<dl>
								<dt>
									담당부서 :
								</dt>
								<dd>
									<?=${"find_".$DEPTH."depth"}[$TREE_NO][ETC2]?>
								</dd>
							</dl>

							<!--<dl>
								<dt>
									담당자 :
								</dt>
								<dd>
									<?=${"find_".$DEPTH."depth"}[$TREE_NO][ETC3]?>
								</dd>
							</dl>

							<dl>
								<dt>
									이메일 :
								</dt>
								<dd>
									<?=${"find_".$DEPTH."depth"}[$TREE_NO][ETC4]?>
								</dd>
							</dl>-->

							<dl>
								<dt>
									전화번호 :
								</dt>
								<dd>
									<?=${"find_".$DEPTH."depth"}[$TREE_NO][ETC5]?>
								</dd>
							</dl>
						</div>
						<!-- //page information -->
					</div>
                </article>
                <!-- //contents -->
            </div>
        </div>
    </section>
    <!-- //container -->

    <script type="text/javascript">
        /*menuOn(<?=$PAGEINDEX1?>, <?=$PAGEINDEX2?>, <?=($PAGEINDEX3=="")?'0':$PAGEINDEX3?>, <?=$PAGEINDEX4?>);*/	

        /*
        * 같은 값이 있는 열을 병합함
        * 사용법 : $('#테이블 ID').rowspan(0);
        */
        $.fn.rowspan = function(colIdx, isStats) {
            return this.each(function(){
                var that;
                $('tr', this).each(function(row) {
                    $('td:eq('+colIdx+')', this).filter(':visible').each(function(col) {
                        if (!fnIsEmpty($(this).html()) && $.trim($(this).html()) !="&nbsp;" && $(this).html() == $(that).html()
                            && (!isStats || isStats && $(this).prev().html() == $(that).prev().html())
                        ) {
                            rowspan = $(that).attr("rowspan") || 1;
                            rowspan = Number(rowspan)+1;

                            $(that).attr("rowspan",rowspan);
                            $(this).hide();
                        } else {
                            that = this;
                        }
                        // set the that if not already set
                        that = (that == null) ? this : that;
                    });
                });
            });
        };

        /*
         * 문자열이 빈 문자열인지 체크하여 결과값을 리턴한다.
         * @param str       : 체크할 문자열
         ** undefined으로 확인되는 객체 체크 **
         */
        function fnIsEmpty( str ) {
            if(typeof str == "undefined" || str == null || str == "" || str =="undefined")
                return true;
            else
                return false ;
        }

        //같은 값 병합
        $("#telInfo1").rowspan(0);
        $("#telInfo2").rowspan(0);

        console.log(<?=$type?>);

        if( <?=$type?> == 1 ){
            $("#tabmenu2").removeClass('active');
            $("#tabmenu1").addClass('active');
        } else {
            $("#tabmenu1").removeClass('active');
            $("#tabmenu2").addClass('active');
        }

        /*
        $("#tabmenu1").on("click", function () {
            $("#tab1").show();
            $("#tab2").hide();
        });

        $("#tabmenu2").on("click", function () {
            $("#tab1").hide();
            $("#tab2").show();
        });
        */

    </script>

    <!-- footer -->
    <?
        include("../_common/main_footer.php");
    ?>
    <!-- //footer -->
</div>
<!-- //wrapper -->



</body>
</html>