<?
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 교원채용리스트_연구실적포함.xls" );
header( "Content-Description: PHP4 Generated Data" );

// adframe 공통 인클루드 파일
include_once "../_common.php";

//error_reporting( E_ALL );
//ini_set( "display_errors", 1 );

//print_r(dirname(__FILE__));
// 접속로그
include_once( dirname(__FILE__)."/lib/log.access.forPrivate.php" );
// 개인정보 접근로그
if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-applist-downloadExcel");

//$resume_num = $_GET['resume_gubun'];

$DBTable = "recruit_copy";

/*
if($searchstring) {
    $search_qry = " AND $search LIKE '%".$searchstring."%' ";
}
*/
$pg_qry = "SELECT * FROM ".$DBTable." WHERE  wr_id > 0 AND resume_num='$resume_num' $search_qry ORDER BY wr_id asc ";
$pg_result = mysql_query($pg_qry);

?>
<table border=1 cellspacing=0 cellpadding=0 width=100% >

    <tr align="center" height="30" >

        <td>번호</td>
        <td>지원학과명</td>
        <td>성명</td>
        <td>발표년월</td>
        <td>게재지명</td>
        <td>연구실적 제목</td>
		<td>발표자수</td>
        <td>연구실적 저자</td>
    </tr>

    <?

    $pg_result=DBquery($pg_qry);

    $k =1;
    while($pg_row=mysql_fetch_array($pg_result)){

        $date = mysql_fetch_array(mysql_query("SELECT * FROM recruit1 WHERE parent='$pg_row[wr_id]'"));
		
		// 2023.11.09 추가 - 석박사 학위 논문
		for ( $i = 1; $i < 3 ; $i++ ) {
			if ( $date["thesis".$i."_subject"] != "" ) {
				?>
				<tr align="center" height="30">
					<td> <?=$k?> </td>
					<td> <?=$pg_row["apply_major"]?> </td>
					<td> <?=$pg_row["kor_name"]?> </td>
					<td> </td>
					<td> 
						<?
						if ( $i == 1 ) echo "석사학위 논문"; 
						else if ( $i == 2 ) echo "박사학위 논문"; 
						?>
					</td>
					<td> <?=$date["thesis".$i."_subject"]?> </td>
					<td><?=$date['study'.$i.'_mem']?></td>
					<td> 지도 교수 및 논문심사 위원 : <?=$date["thesis".$i."_tutor"]?> </td>
				</tr>
				<?
				$k++;
			}
		}


        for($i=1; $i<=20; $i++){

          if($date['study'.$i.'_subject'] != "") {
        ?>
        <tr align="center" height="30">
            <td><?=$k?></td>
            <td><?=$pg_row['apply_major']?></td>
            <td><?=$pg_row['kor_name']?></td>
            <td><?=$date['study'.$i.'_date']?></td>
            <td><?=$date['study'.$i.'_book']?></td>
            <td><?=$date['study'.$i.'_subject']?></td>
			<td><?=$date['study'.$i.'_mem']?></td>
            <td><?=$date['study'.$i.'_author']?></td>
        </tr>
        <?

          $k++;
          }
        }

    }


    ?>
</table>
