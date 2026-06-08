	<tbody>
	<?php if(in_array($_SESSION['ID'],$교무처['member'])){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th rowspan="6">교무처</th>
		<th style="padding:0px 10px;">교원인사/학술/전공심화과정</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="1" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][1]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">학적</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="2" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][2]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">수업/교무</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="3" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][3]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">교수학습<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="4" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][4]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">교육혁신<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="5" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][5]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">교양교육<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="47" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][47]?></textarea>
		</td>
	</tr>
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$입학처['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$입학처['member'])==false){?>style="display:none;"<?php } ?>>
		<th rowspan="3">입학처</th>
		<th style="padding:0px 10px;">입시</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="6" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][6]?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$입학처['member'])==false){?>style="display:none;"<?php } ?>>
		<th style="padding:0px 10px;">입시홍보</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="7" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][7]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$입학처['member'])==false){?>style="display:none;"<?php } ?>>
		<th style="padding:0px 10px;">진로입학지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="48" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][48]?></textarea>
		</td>
	</tr>
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$학생처['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
		<th rowspan="8">학생처</th>
		<th style="padding:0px 10px;">장학</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="9" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][9]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">학생</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="10" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][10]?></textarea>
		</td>
	</tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
            <th style="padding:0px 10px;">생활관</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="11" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][11]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
            <th style="padding:0px 10px;">학생상담센터</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="12" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][12]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
            <th style="padding:0px 10px;">인권센터</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="13" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][13]?></textarea>
            </td>
        </tr>
			<tr height="34" bgcolor="FAFAFA"<?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">사회공헌센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="14" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][14]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA"<?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">장애학생지원센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="15" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][15]?></textarea>
			</td>
		</tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
            <th style="padding:0px 10px;">보건실</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="16" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][16]?></textarea>
            </td>
        </tr>
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$기획처['member'])==true){?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기획처['member'])==false){?>style="display:none"<?php }?>>
			<th rowspan="3">기획처</th>
			<th style="padding:0px 10px;">기획,인사</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="17" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][17]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기획처['member'])==false){?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">홍보</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="18" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][18]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기획처['member'])==false){?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">IR성과관리센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="19" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][19]?></textarea>
			</td>
		</tr>
	
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$행정처['member'])==true){ ?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$행정처['member'])==false){ ?>style="display:none"<?php } ?>>
			<th colspan="2">행정처</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="20" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][20]?></textarea>
			</td>
		</tr>
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$산학협력['member'])==true){ ?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th rowspan="3">산학협력처</th>
			<th style="padding:0px 10px;">본부</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="21" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][21]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">현장실습<br/>지원센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="22" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][22]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">취창업진로<br/>지원센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="23" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][23]?></textarea>
			</td>
		</tr>	
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th rowspan="9">산학협력단</th>
			<th style="padding:0px 10px;">임상시뮬<br/>레이션센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="24" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][24]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">기업협업<br/>지원센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="25" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][25]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">건강안전<br/>지원센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="26" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][26]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">수목진단<br/>센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="27" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][27]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">늘돌봄<br/>지원센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="28" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][28]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">웰니스문화<br/>관광센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="29" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][29]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">언어치료<br/>센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="30" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][30]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">AI-DX<br/>센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="45" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][45]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">AI헬스케어<br/>빅데이터센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="46" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][46]?></textarea>
			</td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$국제교류원['member'])==true){?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$국제교류원['member'])==false){?>style="display:none"<?php }?>>
			<th rowspan="4">국제교류처</th>
			<th style="padding:0px 10px;">공통</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="38" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][38]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$국제교류원['member'])==false){?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">한국어교육센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="39" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][39]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$국제교류원['member'])==false){?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">국제개발협력센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="40" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][40]?></textarea>
			</td>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$국제교류원['member'])==false){?>style="display:none"<?php }?>>
			<th style="padding:0px 10px;">글로벌센터</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="41" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][41]?></textarea>
			</td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$혁신지원사업단['member'])==true){	?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$혁신지원사업단['member'])==false){ ?>style="display:none"<?php }?>>
			<th colspan="2">혁신지원사업단</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="31" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][31]?></textarea>
			</td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$RISE사업단['member'])==true){	?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$RISE사업단['member'])==false){ ?>style="display:none"<?php }?>>
			<th colspan="2">RISE사업단</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="43" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][43]?></textarea>
			</td>
		</tr>
		<?php } ?>
		
		<?php if(in_array($_SESSION['ID'],$평생교육원['member'])==true){	?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
			<th rowspan="4">평생교육원</th>
			<th style="padding:0px 10px;">울주군사업</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="33" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][33]?></textarea>
			</td>
		</tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">울산연구원 사업(평생교육연구실)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="35" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][35]?></textarea>
            </td>
        </tr>		
		<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">산림교육전문가(산림청)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="44" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][44]?></textarea>
            </td>
        </tr-->
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">평생학습지원(U-RUN)센터</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="34" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][34]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">일반업무</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="36" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][36]?></textarea>
            </td>
        </tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$전산소['member'])==true){?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$전산소['member'])==false){?>style="display:none"<?php }?>>
			<th>정보전산원</th>
			<th style="padding:0px 10px;">-</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="37" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][37]?></textarea>
			</td>
		</tr>
		<?php } ?>
		
		<?php if(in_array($_SESSION['ID'],$도서관['member'])==true){?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$도서관['member'])==false){?>style="display:none"<?php }?>>
			<th colspan="2">도서관</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="32" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][32]?></textarea>
			</td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$기타['member'])==true){ ?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기타['member'])==false){ ?>style="display:none"<?php }?>>
			<th>기타</th>
			<th style="padding:0px 10px;">생명윤리위원회</th>
			<td style="padding:5px">
				<input type="hidden" name="m_order[]" value="42" />
				<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][42]?></textarea>
			</td>
		</tr>
		<?php } ?>
	</tbody>
	  