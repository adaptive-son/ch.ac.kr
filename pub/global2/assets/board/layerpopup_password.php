				<div class="mask"></div>
				<div class="layerpopup-password-wrapper">
					<form action="" method="">
						<fieldset>
							<legend class="blind">
								비밀글보기
							</legend>

							<div class="layerpopup-password-area">
								<h2>
									비밀글보기
								</h2>

								<p class="word-information">
									이 글은 비밀글입니다. 
									<span>
										비밀번호를 입력하여 주세요.
									</span>
								</p>

								<dl>
									<dt>
										<label for="layerpopup-password">
											비밀번호
										</label>
									</dt>
									<dd>
										<input type="password" id="layerpopup-password" name="" value="" />
										<input type="submit" id="" name="" value="확인" />
									</dd>
								</dl>

								<button type="button" class="btn-close">
									창닫기
								</button>
							</div>				
						</fieldset>
					</form>
				</div>
				
				<!-- 비밀글보기 -->
				<script type="text/javascript">
					$(function() {
						$(".open-password").click(function() {
							$("body").addClass("fixed-body");
							$(".mask").fadeIn(150, function() {
								$(".layerpopup-password-wrapper").show();
							});
						});

						$(".mask, .layerpopup-password-wrapper .btn-close").click(function() {
							$(".layerpopup-password-wrapper").hide();
							$(".mask").fadeOut(150);
							$("body").removeClass("fixed-body");
						});
					});
				</script>
				<!-- //비밀글보기 -->