<?php
ini_set("display_errors", 1);
include_once("../_common.php");

if(!$sel_uni) {
    $sel_uni = "main";
}
if(!$sel_date1) {
    $sel_date1 = $curdate;
}
if(!$sel_date2) {
    $sel_date2 = $curdate;
}

if($page < 1) {
    $page = 1;
}

$total_count_query = mysql_fetch_array(mysql_query("select count(*) as cnt, sum(vi_hits) as hits from visiter_ip where vi_date between '$sel_date1' and '$sel_date2' and vi_un = '$sel_uni'"));

$total_count = $total_count_query['cnt'];

$end = "20";

$total_page = ceil($total_count/$end);

$start = ($page-1) * $end;

$num = $start+1;
$PAGEBLOCK	= 10;

//$sql = " select * from visiter_ip where vi_date between '$sel_date1' and '$sel_date2' and vi_un = '$sel_uni' order by vi_hits desc limit 0, 20 ";
$sql = " select sum(vi_hits) as vi_hits, vi_ip from visiter_ip where vi_date between '$sel_date1' and '$sel_date2' and vi_un = '$sel_uni' GROUP BY vi_ip ORDER BY SUM(vi_hits) desc LIMIT $start,$end";

$result = @mysql_query($sql) or die(mysql_error());

while($row=@mysql_fetch_array($result)) {
    $x_line[] = $row['vi_ip'];
    $y_line[] = $row['vi_hits'];
    $sum += $row['vi_hits'];

}
?>
<!doctype html>
<html lang="ko">
<head>
    <?php include_once("../include/__meta.php"); ?>
</head>
<body style="background-color: #fff;">
<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; min-height: 550px;">
    <!-- container -->
    <div class="container" id="container" style="background: none;">
        <!-- contents -->
        <div class="contents" id="contents">
            <!-- contents area -->
            <div class="contents-area">
				<h2 class="title0201">아이피별 방문자수</h2>
				<p style="color:red;font-weight:bold">** 접속자수는 상위 50위까지만 노출이 됩니다.</p>
				<div class="board-search-area">						
					<form name=frm_sel_date method=get action='<?=$PHP_SELF?>'>
						<div class="board-search-box">
							<input type="hidden" name="sel_uni" value="main" />
							시작일 : <INPUT TYPE="text" id="startDate" NAME="sel_date1" value="<?=$sel_date1?>"  style="width:100px">
							종료일 : <INPUT TYPE="text" id="endDate" NAME="sel_date2" value="<?=$sel_date2?>"  style="width:100px"> 
							<INPUT TYPE="submit" value="검색" class="btn-search"  /> 
						</div>
					</form>
				</div>
				<div class="board-list">
					<table style="width: 100%">
						<colgroup>
							<col width="80px" />
							<col width="*" />
							<col width="120px" />
							<col width="120px" />
						</colgroup>
						<thead>
							<tr>
								<th>순위</th>
								<th>접속아이피</th>
								<th>카운트</th>
								<th>비율</th>
							</tr>
						</thead>
						<tbody>
							<?php
                                for($r=0;$r<count($x_line);$r++) {
                                    $ipMode = "(외부)";
                                    $fontColor = "";
                                    ?>
							<tr>
								<td><?php echo $num?></td>
								<td style="text-align:left">
								<?php
                                            if($x_line[$r]=="123.140.250.254") {
                                                $ipMode = "(내부)";
                                                $fontColor = "color:red";
                                            }

                                            echo "<span style='".$fontColor."'>".$ipMode." ".$x_line[$r]."</span>";
                                    ?>
								</td>
								<td>
								<?php
                                        if($y_line[$r]) {
                                            echo number_format($y_line[$r]);
                                            $round_y = round($y_line[$r]/$total_count_query['hits']*100, 2);
                                        } else {
                                            $y_line[$r] = "0";
                                            echo $y_line[$r];
                                            $round_y = "0";
                                        }
                                    ?>
								</td>
								<td><?php echo $round_y?>%</td>

							</tr>
							<?php
                                        $num++;
                                }
?>
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td><b>합계</b></td>
								<td><b><?=number_format($sum)?></b></td>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<p class="paging-navigation">
                <?php
                $search_etc = "&sel_uni=".$_GET['sel_uni']."&sel_date1=".$sel_date1."&sel_date2=".$sel_date2;
$Obj=new PList($PHP_SELF, '0', $start, $total_count, $PAGEBLOCK, $end, $search, $searchstring, $search_etc);
echo $Obj->putList(true, "이전 페이지로 이동", "다음 페이지로 이동"); ?>
            </p>
            <!-- //contents area -->
		</div>
        <!-- //contents -->
	</div>
    <!-- //container -->

</div>
<!-- //wrapper -->
<?php include_once("../include/__footer.php"); ?>
</body>
</html>