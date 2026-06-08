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

if($sel_date1==$sel_date2) {
    $sql = " select * from visiter_count where vc_date between '$sel_date1' and '$sel_date2' and vc_un = '$sel_uni' ";
    $row = @mysql_fetch_array(mysql_query($sql));

    for($i=0;$i<24;$i++) {
        $x_line[] = $i."시";
        $vc_txt = "vc_".$i;
        $y_line[] = $row[$vc_txt];
        $sum += $row[$vc_txt];
    }
} else {
    $sql = " select * from visiter_count where vc_date between '$sel_date1' and '$sel_date2' and vc_un = '$sel_uni' ";
    $result = @mysql_query($sql) or die(@mysql_error());
    while($row=@mysql_fetch_array($result)) {
        $x_line[] = substr($row[pt_date], 5, 5);
        for($i=0;$i<24;$i++) {
            $vc_txt = "vc_".$i;
            $sum += $row[$vc_txt];
        }
        $y_line[] = $sum;
        $sum2 += $sum;
    }
    $sum = $sum2;
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
				<h2 class="title0201">방문자 수</h2>
				<div class="board-search-area">						
					<form name=frm_sel_date method=post action='<?=$PHP_SELF?>'>
						<div class="board-search-box">
							<input type="hidden" name="sel_uni" value="main" />
							시작일 : <INPUT TYPE="text" NAME="sel_date1" value="<?=$sel_date1?>"  style="width:100px">
							종료일 : <INPUT TYPE="text" NAME="sel_date2" value="<?=$sel_date2?>"  style="width:100px"> 
							<INPUT TYPE="submit" value="검색" class="btn-search"  /> 
						</div>
					</form>
				</div>
				<div class="board-list">
					<table style="width: 100%">
						<colgroup>
							<col width="80px" />
							<col width="120px" />
							<col width="120px" />
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>일시</th>
								<th>카운트</th>
								<th>비율</th>
							</tr>
						</thead>
						<?php
                            for($r=0;$r<count($y_line);$r++) {
                                ?>
						<tr class=tdsright>
							<td align=center><?php echo $r+1?></td>
							<td align=center><?php echo $x_line[$r]?></td>
							<td align=center><?php
                                        if($y_line[$r]) {
                                            echo number_format($y_line[$r]);
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
						<tr>
							<td align=center></td>
							<td align=center><b>합계</b></td>
							<td align=center><b><?=number_format($sum)?></b></td>
							<td align=center></td>
						</tr>
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
<script src="/js/Highcharts/highcharts.js"></script>
<script src="/js/Highcharts/highcharts-3d.js"></script>
<script src="/js/Highcharts/highcharts-more.js"></script>
<script src="/js/Highcharts/exporting.js"></script>


<style type="text/css">
    #container {
        min-width: 310px;
        max-width: 800px;
        margin: 0 auto;
    }
</style>

<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column',
                margin: 75,
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 0,
                    depth: 40
                }
            },
            title: {
                text: '페이지 뷰'
            },
            subtitle: {
                text: 'Page View'
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            xAxis: {
                categories: <?php
                    if(count($y_line)>0) {
                        echo "[";

                        for($r=0;$r<count($y_line);$r++) {
                            echo "'".$x_line[$r]."'";

                            if($r!=count($y_line)-1) {
                                echo ", ";
                            } else {
                                echo "] ";
                            }
                        }
                    }
?>
            },

            yAxis: {
                title: {
                    text: 'view count'
                }
            },
            series: [{
                name: '페이지뷰',
                data:
                <?php
                if(count($y_line)>0) {
                    echo "[";

                    for($r=0;$r<count($y_line);$r++) {
                        if($y_line[$r]) {
                            echo number_format($y_line[$r]);
                            $round_y = round($y_line[$r]/$sum*100, 2);
                        } else {
                            $y_line[$r] = "0";
                            echo $y_line[$r];
                            $round_y = "0";
                        }

                        if($r!=count($y_line)-1) {
                            echo ", ";
                        } else {
                            echo "] ";
                        }
                    }
                }
?>

            }]
        });
    });
</script>
</body>
</html>