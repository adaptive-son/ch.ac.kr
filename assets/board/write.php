
							<script>
								$.datepicker.setDefaults({
									dateFormat: 'yy-mm-dd',
									prevText: '이전 달',
									nextText: '다음 달',
									monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
									monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
									dayNames: ['일', '월', '화', '수', '목', '금', '토'],
									dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
									dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
									showMonthAfterYear: true,
									yearSuffix: '년'
								});

								$(function() {
									$(".input-datepicker").datepicker();
								});
							</script>
							
							<div class="board-area">


								<form action="" method="">
									<fieldset>
										<legend class="blind">글쓰기</legend>

										<div class="board-write">
											<dl>
												<dt>
													<label for="textfield01">
														제목
													</label>
												</dt>
												<dd>
													<input type="text" id="textfield01" name="" value="" />
												</dd>
											</dl>


											<dl>
												<dt>
													<label for="type">
														비밀글
													</label>
												</dt>
												<dd>
													<div class="radio-checkbox-depth">
														<input type="radio" id="radio0201" name="radio02" value="Y" />
														<label for="radio0201">
															공개
														</label>
													</div>
													<div class="radio-checkbox-depth">
														<input type="radio" id="radio0202" name="radio02" value="N" />
														<label for="radio0202">
															비공개
														</label>
													</div>
												</dd>
											</dl>

											<dl>
												<dt>
													<label for="type">
														내용
													</label>
												</dt>
												<dd>
													<textarea id="type" cols="50" rows="5"></textarea>
												</dd>
											</dl>



											
											<dl>
												<dt>
													<label for="textfield01">
														작성자
													</label>
												</dt>
												<dd>
													<input type="text" id="textfield01" name="" value="" class="w30" />
												</dd>
											</dl>

											<dl>
												<dt>
													<label for="password01">
														비밀번호
													</label>
												</dt>
												<dd>
													<input type="password" id="password01" name="" value="" class="w30" />
												</dd>
											</dl>

										</div>
										
										<div class="btns-area">
											<a href="#" class="btns02 btns-color03 w45 btns-2nd btns-mr">
												<span>
													저장
												</span>
											</a>

											<a href="#" class="btns02 btns-color04 w45 btns-2nd btns-ml">
												<span>
													취소
												</span>
											</a>
										</div>

									</fieldset>
								</form>									
							</div>
