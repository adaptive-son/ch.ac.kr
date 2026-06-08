
<div class="contents-wrapper">
	<div class="rule-book-wrapper">
		<ul>

		<?
			// 1차 카테고리
			$bbs_qry1 = "
				SELECT *
				FROM af_category
				WHERE DEPTH='0'
				ORDER BY ORDER_NO ASC
			";

			$bbs_result = DBquery($bbs_qry1);

			while($bbs_row = mysql_fetch_array($bbs_result)) {

				$current_depth2 = '';
		?>

			<li>

				<button type="button" class="depth1">
					<?=$bbs_row['NAME'];?>
					<span class="arrow"></span>
				</button>

				<ul>

				<?
					// 게시글 조회
					$bbs_qry2 = "
						SELECT *
						FROM bbs_main
						WHERE
							code='2616'
							AND del_yn='N'
							AND etc_char1='".$bbs_row['TREE_NO']."'
						ORDER BY etc_char2+0 ASC, etc_char4+0 ASC
					";
//echo $bbs_qry2;
					$bbs_result2 = DBquery($bbs_qry2);

					while($bbs_row2 = mysql_fetch_array($bbs_result2)) {

						// 파일 처리
						$down_data = '';

						if($bbs_row2['up_file'] > 0) {

							$file_result = DBquery("
								SELECT *
								FROM bbs_main_file
								WHERE up_file_idx='".$bbs_row2['up_file_idx']."'
								LIMIT 1
							");

							$file_row = mysql_fetch_array($file_result);

							$encode_str =
								"Boardkey=".$BoardKey.
								"&DBTable=".$configBBS['board_id'].
								"&idx=".$file_row['idx'].
								"&download=ok";

							$down_data = Encode64($encode_str);
						}

						// =========================
						// depth2 없는 경우
						// =========================
						if($bbs_row2['etc_char2'] == '') {

							// 열려있는 depth2 닫기
							if($current_depth2 != '') {
								echo "</ul></li>";
								$current_depth2 = '';
							}
				?>

						<li>
							<p class="title">
								<?=$bbs_row2['title'];?>
							</p>

							<div class="right">
								<dl>
									<dt>
										<span>공포일 :</span>
										<?=$bbs_row2['etc_char3'];?>
									</dt>

									<dd>

									<?
										if($bbs_row2['up_file'] > 0) {
									?>
										<a href="/adframe/bbs/download.php?data=<?=$down_data?>" class="btn download">
									<?
										} else {
									?>
										<a href="#" class="btn download" style="display:none;">
									<?
										}
									?>

											<span class="name">
												다운로드
											</span>

											<span class="icon">
												<img
													alt="다운로드"
													src="/_common/img02/icon/icon_download@2x.png"
												>
											</span>
										</a>

									</dd>
								</dl>
							</div>
						</li>

				<?
						}
						// =========================
						// depth2 있는 경우
						// =========================
						else {

							// depth2 변경 시
							if($current_depth2 != $bbs_row2['etc_char2']) {

								// 이전 depth2 닫기
								if($current_depth2 != '') {
									echo "</ul></li>";
								}

								$current_depth2 = $bbs_row2['etc_char2'];

								// 카테고리명 조회
								$cate_result = DBquery("
									SELECT *
									FROM af_category
									WHERE TREE_NO='".$bbs_row2['etc_char2']."'
									LIMIT 1
								");

								$cate_row = mysql_fetch_array($cate_result);
				?>

						<li>

							<button type="button" class="depth2">
								<?=$cate_row['NAME'];?>
								<span class="arrow"></span>
							</button>

							<ul>

				<?
							}
				?>

								<li>

									<p class="title">
										<?=$bbs_row2['title'];?>
									</p>

									<div class="right">
										<dl>
											<dt>
												<span>공포일 :</span>
												<?=$bbs_row2['etc_char3'];?>
											</dt>

											<dd>

											<?
												if($bbs_row2['up_file'] > 0) {
											?>
												<a href="/adframe/bbs/download.php?data=<?=$down_data?>" class="btn download">
											<?
												} else {
											?>
												<a href="#" class="btn download" style="display:none;">
											<?
												}
											?>

													<span class="name">
														다운로드
													</span>

													<span class="icon">
														<img
															alt="다운로드"
															src="/_common/img02/icon/icon_download@2x.png"
														>
													</span>

												</a>

											</dd>
										</dl>
									</div>

								</li>

				<?
						}
					}

					// 마지막 depth2 닫기
					if($current_depth2 != '') {
						echo "</ul></li>";
					}
				?>

				</ul>

			</li>

		<?
			}
		?>

		</ul>
	</div>
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
