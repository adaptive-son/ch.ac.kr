<?php
	//include "../_common.php";
	$conn=mysql_connect('localhost', 'root', 'se130901'); //db ����κ�
	$db=mysql_select_db("ch_2020", $conn);

	$_idx = (int)$_GET['idx'];
	$parent = mysql_fetch_array(mysql_query("SELECT * FROM teamjang_meeting WHERE idx='{$_idx}'"));

	$sql = "SELECT
						*
					FROM
						teamjang_meeting_content_new
					WHERE
						m_idx='{$_idx}'";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$result['m_content'][$row['m_order']] = $row['m_content'];
	}


$title = $row['m_gubun']." �ְ���������";
//if($_SERVER['REMOTE_ADDR']!="112.217.216.250"){
header( "Content-type: application/vnd.ms-excel; charset=euc-kr");
header( "Content-Disposition: attachment; filename = ".$title."_".date("Y-m-d").".xls" );
header( "Content-Description: PHP4 Generated Data" );
//}
?>
<style>
	table{
		border-collapse:collapse;
	}
	br{
	mso-data-placement:same-cell;
	}
	th{
		font-size:0.8em;
	}
	td{
		font-size:0.8em;
		padding:3px;
	}
</style>
<table style="width:800px;">
	<tr>
		<td style="text-align:center;max-height:50px"></td>
		<td><img src="https://www.ch.ac.kr/adframe/mng/teamjang_meeting/logo.png" style="margin:0;padding0"/></td>
		<td colspan="6" style="text-align:center;"><h1>�� �� �� ȸ �� ��</h1></td>
		<td><img src="https://www.ch.ac.kr/adframe/mng/teamjang_meeting/logo.png" style="margin:0;padding0"/></td>
		<td ></td>
	</tr>
	<tr>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:2px solid #000;border-left:2px solid #000;">����</th>
		<td colspan="9" style="border-left:1px solid #000;border-top:2px solid #000;border-right:2px solid #000"><?php echo $parent['m_gubun']?></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:2px solid #000;">�Ͻ�</th>
		<td colspan="9" style="border-left:1px solid #000;border-top:1px solid #000;border-right:2px solid #000"><?php echo $parent['m_date']?></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:2px solid #000;">���</th>
		<td colspan="4" style="border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000"><?php echo $parent['m_place']?></td>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:1px solid #000;">���</th>
		<td colspan="4" style="border-left:1px solid #000;border-top:1px solid #000;border-right:2px solid #000"><?php echo $parent['m_record']?></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:2px solid #000;">����</th>
		<td colspan="9" style="border-left:1px solid #000;border-top:1px solid #000;border-right:2px solid #000"><?php echo $parent['m_memo']?></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:2px solid #000;border-bottom:2px solid #000">�������</th>
		<td colspan="9" style="border-left:1px solid #000;border-top:1px solid #000;border-right:2px solid #000;border-bottom:2px solid #000"><?php echo $parent['m_member']?></td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td colspan="4" style="height:30px;line-height:30px;background:#D0EAED;text-align:center;padding:0;"><div style="border:1px solid #000">�μ��� ���޻���</div></td>
		<td colspan="6" style="border-top:0;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<th colspan="3" style="height:30xp;border:1px solid #000;">����</th>
		<td colspan="7" style="text-align:center;border:1px solid #000;">��������</td>
	</tr>
	<?php 
	if($_GET['idx']<165){
	?>
	<tr>
		<th rowspan="5" style="border:1px solid #000;">��<br/>��<br/>ó</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">�����λ�/�м�/������ȭ����</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][1])))?>
		</td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">������ȭ����</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][2])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">����</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][3])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">����/����</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][4])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�����н���������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][5])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">���ݱ�����������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][39])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">â�Ǳ����������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][38])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">����������������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][6])))?></td>
	</tr>
	<tr>
		<th style="border:1px solid #000;" rowspan="3">��<br/>��<br/>ó</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">�Ϲ�</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][7])))?></td>
	</tr>

	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�Խ�ȫ��</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][42])?></td>
	</tr>

	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�Խ��Ϲ�</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][42])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�����������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][41])))?></td>
	</tr>
	<tr>
		<th rowspan="9" style="border:1px solid #000;">��<br/>��<br/>ó</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">����</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][8])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�л�</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][9])))?></td>
	</tr>
    <tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">��Ȱ��</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][53])))?></td>
    </tr>
    <tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">��Ʈ�Ͻ� ����</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][54])))?></td>
    </tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�����������¼���</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][12])?></td>
	</tr-->
    <tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">���ǽ�</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][36])))?></td>
    </tr>
    
    <tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">�л���㼾��</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][50])))?></td>
    </tr>
	<tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">�αǼ���</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][50])))?></td>
    </tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">��ȸ���弾��</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][11])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">����л���������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][44])))?></td>
	</tr>
	<tr>
		<th rowspan="3" style="border:1px solid #000;">��<br/>ȹ<br/>ó</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">��ȹ,�λ�</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][13])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�ϻ�ȸ��������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][10])?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�αǼ���</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][36])?></td>
	</tr>

	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�λ�</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][14])?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�Խ�ȫ��</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][15])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">IR������������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][16])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�۷ι�����</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][17])?></td>
	</tr-->
	<tr>
		<th style="border:1px solid #000;">����ó</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][18])))?></td>
	</tr>
	<tr>
		<th rowspan="8" style="border:1px solid #000;">��<br/>��<br/>��<br/>��<br />(ó)<br />��</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">����</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][19])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">LINC 3.0�����</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][21])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">����ǽ���������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][22])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">��â��������������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][23])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�ٸ����ùķ��̼Ǽ���</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][24])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�ӻ�ùķ��̼Ǽ���</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][25])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">���������������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][26])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�ǰ����� ��������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][46])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�������ܼ���</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][47])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�õ��� ��������</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][48])))?></td>
	</tr>

	<tr>
		<th colspan="3" style="border:1px solid #000;">�������������</th>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][20])))?></td>
	</tr>
	<!--tr>
		<th colspan="3" style="border:1px solid #000;">�����������������������(HiVE)��</th>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][43])))?></td>
	</tr-->
	<tr>
		<th style="border:1px solid #000;">������</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][34])))?></td>
	</tr>
	<!--tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">�αǼ���</td>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][36])))?></td>
    </tr-->
	<tr>
		<th rowspan="<?php if ( $_GET["idx"] > 133 ) {echo "5";}else{echo "5";}?>" style="border:1px solid #000;">��<br/>��<br/>��<br/>��<br />��</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">���ֱ����</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				$content = $result['m_content'][29];
				$content = str_replace("<","(",$content);
				$content = str_replace(">",")",$content);
				echo nl2br($content);
				//echo nl2br(str_replace("(","<",$result['m_content'][29]))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">����ũ�������� 2�� ���� �ù����(�����������)</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][45])?></td>
	</tr-->
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">����û ���<br />(�б��������忬��)</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][45])?></td>
	</tr-->
    <!--
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">������� �ǽ� ���</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][30])?></td>
	</tr>
    -->
    <?
    // 20204.02.17 ���� ���泻�� ���� :: �������� �� �ű��׸� �߰�
    if ( $_GET["idx"] > 133 ) {
    ?>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">LiFE 2.0 ���(�����н�����������)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][28])))?></td>
        </tr>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">��꿬���� ���(�������������)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][27])))?></td>
        </tr>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">���������� ��������(���ѹ�缱����ȸ)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][52])?></td>
        </tr>
    <? } else { ?>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">��꿬���� ���(���������������)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][27])))?></td>
        </tr>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">LiFE 2.0 ���(�����н�����������)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][28])))?></td>
        </tr>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">��걤���� ����û ���</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][51])))?></td>
        </tr>
    <? } ?>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�Ϲݾ���</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][31])))?></td>
	</tr>

	<tr>
		<th style="border:1px solid #000;">���������</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][32])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�����ͼ���</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][33])))?></td>
	</tr-->
	<tr>
		<th rowspan="3" style="border:1px solid #000;">����������</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">����</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][49])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�����������¼���</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][12])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">�۷ι�����</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][17])))?></td>
	</tr>

	<!--tr>
		<th style="border:1px solid #000;">�л�<br/>���<br />������</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][35])?></td>
	</tr>
	<tr>
		<th style="border:1px solid #000;">�α�<br/>����</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][36])?></td>
	</tr-->
	<tr>
		<th style="border:1px solid #000;">��Ÿ</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">������������ȸ</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][37])))?></td>
	</tr>
	<?php 
		}else{ 
		include "meeting_xls_202501.php";
		} 
	?>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td colspan="4" style="height:30px;line-height:30px;background:#D0EAED;text-align:center;padding:0;"><div style="border:1px solid #000">�а��� �ְ����</div></td>
		<td colspan="6" style="border-top:0;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<th colspan="2" style="border:1px solid #000;">����</th>
<!--
		<th colspan="2" style="height:30px;border:1px solid #000;">���� �� �а����</td>
		<th colspan="3" style="height:30px;border:1px solid #000;">�̹� �� �а����</td>
		<th colspan="3" style="height:30px;border:1px solid #000;">���� �� �а����</td>
-->
		<th colspan="8" style="height:30px;border:1px solid #000;">�а� �ְ���� �� �μ����� ����</td>
	</tr>
	<?php
	$part2_member_sql = "SELECT * FROM teamjang_meeting_member where m_part_gubun='2' order By idx asc";
	$part2_member_res = mysql_query($part2_member_sql);
	$num = 32;
	WHILE($part2_member=mysql_fetch_array($part2_member_res)){
	    // 2024.02.17 ����, ��ȸ������ ����
	    if ( $_idx > 133 && $part2_member["idx"] == 22 ) continue;
		$part2_member_data = $part2_member['m_member'];
		$part2_member_data_array = explode(",",$part2_member_data);
		$part_data = mysql_fetch_array(mysql_query("SELECT * FROM teamjang_meeting_class_content_new WHERE m_idx='{$_idx}' and m_part='".addslashes($part2_member['m_part'])."'"));
	?>
	
<!--
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3" style="border:1px solid #000"><?php echo $part2_member['m_part']?></th>
			<th style="border:1px solid #000">���� ��<br />�а����</th>
			<td colspan="8" style="height:100;padding:5px;border:1px solid #000"><?php echo nl2br($part_data['m_content_past'])?></td>
		</tr>
			<?
				$num++;
			?>
		
-->
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="2" style="border:1px solid #000"><?php echo $part2_member['m_part']?></th>
			<th style="border:1px solid #000">�̹� ��<br />�а����</th>
			<td colspan="8" style="height:100;padding:5px;border:1px solid #000"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$part_data['m_content_this'])))?></td>
			<?
				$num++;
			?>
		</tr>
		<tr height="34" bgcolor="FAFAFA">
			<th style="border:1px solid #000">���� ��<br />�а����</th>
			<td colspan="8" style="height:100;padding:5px;border:1px solid #000"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$part_data['m_content_next'])))?></td>
			<?
				$num++;
			?>
		</tr>
	<?php
	}
	?>
</table>
