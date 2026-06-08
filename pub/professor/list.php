<!doctype html>
<html lang="ko">
<head>
    <?
    if ( $TREE_ID == "" ) $TREE_ID = $_GET['site_id'];
    include("../".$TREE_ID."/include/meta.php");
    if ( $TREE_NO == "" || !$TREE_NO ) go_back("페이지를 찾을 수 없습니다.");
    ?>
    <title><?=$PAGENAME3.$PAGENAME2.$PAGENAME1._TAG_TITLE?></title>
</head>
<body>

<!-- wrapper -->
<div class="wrapper" id="wrapper">
    <!-- header -->
    <? include("../".$TREE_ID."/include/header.php");?>
    <!-- //header -->

    <!-- sub visual -->
    <? include("../".$TREE_ID."/include/sub_visual.php"); ?>
    <!-- sub visual -->

    <!-- container -->
    <section>
        <div class="container" id="container">

            <!-- contents_navi -->
            <? include("../".$TREE_ID."/include/contents_navi.php");?>
            <!-- //contents_navi -->

            <div class="container-wrapper">
                <!-- lnb -->
                <? include("../".$TREE_ID."/include/lnb.php");?>
                <!-- //lnb -->

                <!-- contents -->
                <article>
                    <div class="contents" id="contents">
                        <h3 class="contents-title">
							<?
							$_contents_title = $PAGENAME3;
							if ( $_contents_title == "" || empty($_contents_title) ) $_contents_title = $PAGENAME2;
							echo str_replace("&lt;", "", $_contents_title)
							?>
                            <span class="arrow"></span>
                        </h3>

                        <div class="contents-wrapper">
                            <!-- CMS 시작 -->


                            <div class="professor-wrapper">

                                <?php
                                // 교수 조회
								$subQry = "";
								if ( !empty($_GET["etc1"]) ) {
									$ETC1 = $_GET["etc1"];
									if ( $ETC1 == "4" ) {
									  $subQry = " AND (ETC1 = '".$ETC1."' OR ETC1 = '5') ";
									} else {
									  $subQry = " AND ETC1 = '".$ETC1."' ";
									}
								}
				                $proQuery = "select * from ".TABLE_PROFESSOR." WHERE site_id='".$site_id."' AND del_yn='N' ".$subQry." ORDER BY sort asc ";
                                $result = DBquery($proQuery);
                                for($i=0; $row=@mysql_fetch_array($result); $i++) {
									//교수 이미지 경로
									$file_path = PROFESSOR_LOAD_PATH;
									//교수 사진 있을 경우
									if ($row[file_name]!="") $pro_file_path = $file_path."/".$row[file_name];
									//교수 사진 없을 경우
									else if ($row[file_name]=="") $pro_file_path = "../_common/img/common/noimage01.jpg";
                                    ?>
                                    <div class="professor-list-area">
                                        <div class="image center-crop">
											<img src="<?=$pro_file_path?>" alt="<?=$row[name]?>" />
                                        </div>

                                        <ul>
											<li>
                                                <strong>
                                                    성명
                                                </strong>
												<?php
													//전임교수이고 직위를 작성한 경우
													if($row['etc1']=="1" && $row[position] != "") echo $row[name]." ".$row[position];
													//전임교수이고 직위를 작성하지 않은 경우
													else if ($row['etc1']=="1" && $row[position] == "") echo $row[name];
													//겸임교수인 경우
													else if ($row['etc1']=="2") echo $row[name]." 겸임교수";
													//외래교수인 경우
													else if ($row['etc1']=="3") echo $row[name]." 외래교수";
													//조교인 경우
													else if ($row['etc1']=="4") {
														echo $row["name"];
														if ( !empty($row["position"]) ) {
															echo " ".$row["position"];
														} else {
															echo " 조교";
														}
														//echo $row[name]." 조교";
													} else if ($row['etc1']=="5") echo $row[name]." 계장";
												?>
                                            </li>
                                            <li>
                                                <strong>
													<?
														if ($row['etc1']=="4") echo "담당업무";
														else echo "담당과목";
													?>
                                                </strong>
												<?php
													//1학기 담당과목만 있을 경우
													if($row[responsibility1] != "" && $row[responsibility2] == "") echo $row[responsibility1];
													//1학기, 2학기 담당과목 둘 다 있고 조교가 아닌 경우
													else if ($row[responsibility1] != "" && $row[responsibility2] != "" && $row['etc1']!="4") echo $row[responsibility1]."<br>".$row[responsibility2];
													//2학기 담당과목만 있고 조교가 아닌 경우
													else if ($row[responsibility1] == "" && $row[responsibility2] != "" && $row['etc1']!="4") echo $row[responsibility2];
												?>
                                            </li>
											<?php if($row['etc1'] == "1" || $row['etc1'] == "4") { //전임교수,조교만 보여짐?>
                                            <li>
                                                <strong>
                                                    전화번호
                                                </strong>
												<?=$row[tel];?>
                                            </li>
											<li>
                                                <strong>
                                                    전자우편
                                                </strong>
												<?=$row[email];?>

                                            </li>
                                            <li>
                                                <strong>
                                                    <?
														if ($row['etc1']=="4") echo "사무실";
														else echo "연구실";
													?>
                                                </strong>
												<?=$row[office];?>
                                            </li>
											<?php } ?>
                                        </ul>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
						</div>
                    </div>
                </article>
                <!-- //contents -->
            </div>
        </div>
    </section>
    <!-- //container -->

    <script type="text/javascript">
        menuOn(<?=$PAGEINDEX1?>, <?=$PAGEINDEX2?>, <?=($PAGEINDEX3=="")?'0':$PAGEINDEX3?>);
    </script>

    <!-- footer -->
    <? include("../_common/footer.php");?>
    <!-- //footer -->
</div>
<!-- //wrapper -->



</body>
</html>
