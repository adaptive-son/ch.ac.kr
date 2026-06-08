	<tr>
		<th rowspan="6" style="border:1px solid #000;">교<br/>무<br/>처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">교원인사/학술/전공심화과정</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][1])))?>
		</td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">학적</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][2])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">수업/교무</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][3])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">교수학습 지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][4])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">교육혁신 지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][5])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">교양교육 지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][47])))?></td>
	</tr>
	<tr>
		<th rowspan="3" style="border:1px solid #000;">입<br/>학<br/>처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">입시</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][6])))?>
		</td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">입시홍보</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][7])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">진로입학지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][48])))?></td>
	</tr>
	<tr>
		<th rowspan="8" style="border:1px solid #000;">학<br/>생<br/>처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">장학</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][9])))?>
		</td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">학생</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][10])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">생활관</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][11])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">학생상담센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][12])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">인권센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][13])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">사회공헌센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][14])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">장애학생지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][15])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">보건실</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][16])))?></td>
	</tr>
	<tr>
		<th rowspan="3" style="border:1px solid #000;">기<br/>획<br/>처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">기획,인사</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][17])))?>
		</td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">홍보</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][18])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">IR성과관리센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][19])))?></td>
	</tr>
	<tr>
		<th style="border:1px solid #000;" colspan="3">행정처</th>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][20])))?>
		</td>
	</tr>
	<tr>
		<th rowspan="3" style="border:1px solid #000;">산<br/>학<br/>협<br />력<br />처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">본부</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][21])))?>
		</td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">현장실습지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][22])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">취창업진로지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][23])))?></td>
	</tr>
	<tr>
		<th rowspan="9" style="border:1px solid #000;">산<br/>학<br/>협<br />력<br />단</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">임상시뮬레이션센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][24])))?></td>
	</tr>

	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">기업협업지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][25])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">건강안전지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][26])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">수목진단센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][27])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">늘돌봄지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][28])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">웰니스문화관광센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][29])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">언어치료센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][30])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">AI-DX센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][45])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">AI헬스케어빅데이터센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][46])))?></td>
	</tr>
	<tr>
		<th rowspan="4" style="border:1px solid #000;">국<br/>제<br/>교<br />류<br />처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">공통</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][38])))?>
		</td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">한국어교육센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][39])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">국제개발협력센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][40])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">글로벌센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][41])))?></td>
	</tr>
	<tr>
		<th colspan="3" style="border:1px solid #000;">혁신지원사업단</th>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][31])))?>
		</td>
	</tr>
	<tr>
		<th colspan="3" style="border:1px solid #000;">RISE사업단</th>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][43])))?>
		</td>
	</tr>
	
	<tr>
		<th rowspan="4" style="border:1px solid #000;">평<br/>생<br/>교<br />육<br />원</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">울주군사업</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][33])))?>
		</td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">울산연구원 사업(평생교육연구실)</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][35])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">산림교육전문가(산림청)</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][44])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">평생학습지원(U-RUN)센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][34])))?></td>
	</tr>
	
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">일반업무</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][36])))?></td>
	</tr>
	
	<tr>
		<th colspan="3" style="border:1px solid #000;">정보전산원</th>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][37])))?>
		</td>
	</tr>
	<tr>
		<th colspan="3" style="border:1px solid #000;">도서관</th>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][32])))?>
		</td>
	</tr>
	<tr>
		<th style="border:1px solid #000;">-</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">생명윤리위원회</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][42])))?>
		</td>
	</tr>