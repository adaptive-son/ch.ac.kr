				<div class="sub-visual">
					<?
						if($PAGEINDEX1=="7") $PAGEINDEX1="1";
						if($PAGEINDEX1=="") $PAGEINDEX1 = '0';
					?>
					<img src="../img02/sub0<?=$PAGEINDEX1?>/img_subvisual_pc.jpg" alt="" class="pc" />
					<img src="../img02/sub0<?=$PAGEINDEX1?>/img_subvisual_mobile.jpg" alt="" class="mobile" />
					<p>
						<strong>
							<? 
								if ( strlen(str_replace("&lt;", "", $PAGENAME1)) > 30 ) { 
									echo str_replace("&lt;", "", $PAGENAME1);
								} else {
									echo str_replace("&lt;", "", $PAGENAME1);
								} 
							?>
						</strong>
						<span>
							58년 전통의 보건의료 특성화 대학
						</span>
					</p>
				</div>