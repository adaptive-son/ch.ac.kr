
<div class="rule-book-wrapper">
	<ul>
		<?
			$bbs_qry1 = "SELECT * FROM af_category WHERE DEPTH='0' ORDER BY ORDER_NO ASC";
			$bbs_result=DBquery($bbs_qry1);
			while($bbs_row=mysql_fetch_array($bbs_result)) {
		?>
		<li>
			<button type="button" class="depth1">
				<?=$bbs_row['NAME'];?>
				<span class="arrow"></span>
			</button>
			<ul>
				<?
					$bbs_qry2 = "SELECT * FROM af_category, bbs_main WHERE bbs_main.etc_char1='".$bbs_row['TREE_NO']."' AND bbs_main.code='2616' AND af_category.DEPTH='1' AND bbs_main.del_yn='N' ORDER BY af_category.ORDER_NO ASC;";
					$bbs_result2=DBquery($bbs_qry2);
					while($bbs_row2=mysql_fetch_array($bbs_result2)) {
						if($bbs_row2['etc_char2']=="") {
				?>
				<li>
					<p class="title">
						<?=$bbs_row2['title'];?>
					</p>

					<div class="right">
						<dl>
							<dt>
								<span>공포일 :</span> <?=$bbs_row2['etc_char3'];?>
							</dt>
							<dd>
								<a href="#" class="btn download">
									<span class="name">
										다운로드
									</span>
									<span class="icon">
										<img alt=" 다운로드" src="/pub/_common/img02/icon/icon_download@2x.png">
									</span>
								</a>
							</dd>
						</dl>
					</div>
				</li>
				<? } else if($bbs_row2['etc_char2']!="" && $bbs_row2['etc_char2'] == $bbs_row2['TREE_NO']) { ?>
				<li>
					<button type="button" class="depth2">
						<?=$bbs_row2['NAME'];?>
						<span class="arrow"></span>
					</button>

					<ul>
						<li>
							<p class="title">
								<?=$bbs_row2['title'];?>
							</p>
							<div class="right">
								<dl>
									<dt>
										<span>공포일 :</span> <?=$bbs_row2['etc_char3'];?>
									</dt>
									<dd>
										<a href="#" class="btn download">
											<span class="name">
												다운로드
											</span>
											<span class="icon">
												<img alt=" 다운로드" src="/pub/_common/img02/icon/icon_download@2x.png">
											</span>
										</a>
									</dd>
								</dl>
							</div>
						</li>
					</ul>
				</li>
				<? } // if문 끝 ?>
				<? } //2차 카테고리 while 끝 ?>
			</ul>
		</li>
		<? } //1차 카테고리 while 끝?>
	</ul>
</div>


<script>
	$(function() {
		$(".depth1").on("click", function() {
			if($(this).hasClass('active') != true) {
				$(this).addClass('active');
				$(this).next().slideDown(75);
			} else {
				$(this).removeClass('active');
				$(this).next().slideUp(75);
			}
		});

		$(".depth2").on("click", function() {
			if($(this).hasClass('active') != true) {
				$(this).addClass('active');
				$(this).next().slideDown(75);
			} else {
				$(this).removeClass('active');
				$(this).next().slideUp(75);
			}
		});
	});
</script>
