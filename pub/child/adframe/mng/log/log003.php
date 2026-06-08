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

$sql = "SELECT sum(ip_hits) AS hits, ip_url FROM interest_page WHERE ip_date BETWEEN '{$sel_date1}' AND '{$sel_date2}' and ip_url !='' GROUP BY ip_url ORDER BY SUM(ip_hits) desc";
$res = @mysql_query($sql) or die(mysql_error());


while($row = @mysql_fetch_array($res)) {
    $ip_url_arr = explode("?", $row['ip_url']);
    $data = explode("&", $ip_url_arr[1]);
    $TREE_NO = explode("=", $data[1]);
    $DEPTH = explode("=", $data[2]);

    $ip_url = str_replace("http://www.drbs.or.kr", "", $row['ip_url']);
    $ip_url = str_replace("http://drbs.or.kr", "", $ip_url);

    if($ip_url) {
        $x_line[] = $ip_url;
        $y_line[] = $row['hits'];
        $sum += $row['hits'];

        $url_name[] = $ip_url;
    }
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
				<h2 class="title0201">페이지별 방문자수</h2>
				<div class="board-search-area">						
					<form name=frm_sel_date method=post action='<?=$PHP_SELF?>'>
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
								<th>인기페이지</th>
								<th>카운트</th>
								<th>비율</th>
							</tr>
						</thead>
						<tbody>
							<?php
                                for($r=0;$r<count($x_line);$r++) {
                                    ?>
							<tr>
								<td><?php echo $r+1?></td>
								<td style="text-align:left;word-break:break-all">
								<?php
                                        echo $url_name[$r];
                                    ?>
								</td>
								<td>
								<?php
                                        if($y_line[$r]) {
                                            echo number_format($y_line[$r]);
                                            $round_y = round($y_line[$r]/$sum*100, 2);
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