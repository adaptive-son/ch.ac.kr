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
/*
    if($sel_date1==$sel_date2) {
        $sql = " select * from page_view where pt_date between '$sel_date1' and '$sel_date2' and pt_un = '$sel_uni' ";
        $row = @mysql_fetch_array(mysql_query($sql));

        for($i=0;$i<24;$i++) {
            $x_line[] = $i."시";
            $pt_txt = "pt_".$i;
            $y_line[] = $row[$pt_txt];
            $sum += $row[$pt_txt];
        }
    } else {
        $sql = " select * from page_view where pt_date between '$sel_date1' and '$sel_date2' and pt_un = '$sel_uni' ";
        $result = @mysql_query($sql) or die (@mysql_error());
        while($row=@mysql_fetch_array($result)){
            $x_line[] = substr($row[pt_date],5,5);
            for($i=0;$i<24;$i++) {
                $pt_txt = "pt_".$i;
                $sum += $row[$pt_txt];
            }
            $y_line[] = $sum;
            $sum2 += $sum;
        }
        $sum = $sum2;
    }*/

$new_date = date("Y-m-d", strtotime("-1 day", strtotime($sel_date1)));
while(true) {
    $new_date = date("Y-m-d", strtotime("+1 day", strtotime($new_date)));
    $x_line[] = $new_date;

    $sql = "select sum(vi_hits) as cnt from visiter_ip where vi_date = '$new_date' and vi_un='$sel_uni' ";
    $row = @mysql_fetch_array(mysql_query($sql));

    $y_line[] = $row['cnt'];
    $sum += $row['cnt'];

    //내부아이피를 분리한다.
    $interCnt = @mysql_fetch_array(@mysql_query("select sum(vi_hits) as cnt from visiter_ip where vi_date = '$new_date' and vi_un='$sel_uni' and vi_ip='123.140.250.254'"));
    $z_line[] = $interCnt['cnt'];
    $remain[] = $row['cnt'] - $interCnt['cnt'];

    if($new_date == $sel_date2) {
        break;
    }
}
/*
    $sql = "select * from visiter_ip vi_date between '$sel_date1' and '$sel_date2' and pt_un='$sel_uni' ";
    $row = @mysql_fetch_array(mysql_query($sql));
    while($row=@mysql_fetch_array($result)){
        $x_line[] = $row['vi_date'];
    }
*/
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
            <div class="contents-area" style="width:800px">
				<h2 class="title0201">일자별 접속자수</h2>
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
					<table style="width:100%">
						<colgroup>
							<col width="80px" />
							<col width="220px" />
							<col width="220px" />
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>일시</th>
								<th>접속자수(내부/외부)</th>
								<th>비율</th>
							</tr>
						</thead>
						<tbody>
							<?php
                                for($r=0;$r<count($y_line);$r++) {
                                    ?>
							<tr class=tdsright <?php echo $mouseover ?>>
								<td align=center><?php echo $r+1?></td>
								<td align=center><?php echo $x_line[$r]?></td>
								<td align=center><?php
                                            if($y_line[$r]) {
                                                echo number_format($y_line[$r])." (".number_format($z_line[$r])."/".number_format($remain[$r]).")";
                                                $round_y = round($y_line[$r]/$sum*100, 2);
                                            } else {
                                                $y_line[$r] = "0";
                                                echo $y_line[$r];
                                                $round_y = "0";
                                            }
                                    ?></td>
								<td align=center><?php echo $round_y?>%</td>
							</tr>
							<?php
                                }
?>
						</tbody>
						<tfoot>
							<tr>
								<td align=center></td>
								<td align=center><b>합계</b></td>
								<td align=center><b><?=number_format($sum)?></b></td>
								<td align=center></td>
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