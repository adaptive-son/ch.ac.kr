								<div class="board-area">
									<form action="" method="">
										<fieldset>
											<legend class="blind">
												회원정보 입력
											</legend>
											
											<div class="board-write">
												<div class="one-box">
													<dl>
														<dt>
															<label for="type">
																분류
															</label>
														</dt>
														<dd>
															<select id="type" name="">
																<option value="">
																	선택
																</option>
															</select>
														</dd>
													</dl>
												</div>

												<div class="one-box">
													<dl>
														<dt>
															<label>
																공지여부
															</label>
														</dt>
														<dd>
															<div class="checked-notice">
																<input type="checkbox" id="notice-checked" name="" value="" />
																<label for="notice-checked">
																	공지여부 선택
																</label>
															</div>
															<div class="input-period-wrapper">
																<div class="input-period-area">
																	<input type="text" id="sdate" name="sdate" class="sdate" value="" size="15" maxlength="10" readonly="readonly" />
																</div>
																<span class="word-unit">
																	~
																</span>
																<div class="input-period-area">
																	<input type="text" id="edate" name="edate" class="edate" readonly="readonly" />
																</div>
															</div>
														</dd>
													</dl>
												</div>

																

												<div class="one-box">
													<dl>
														<dt>
															<label for="writer">
																작성자
															</label>
														</dt>
														<dd>
															<input type="text" id="writer" name="" />
														</dd>
													</dl>
												</div>
												<div class="one-box">
													<dl>
														<dt>
															<label for="title">
																제목
															</label>
														</dt>
														<dd>
															<input type="text" id="title" name="" />
														</dd>
													</dl>
												</div>

												<div class="one-box">
													<dl>
														<dt>
															<label for="title">
																첨부파일
															</label>
														</dt>
														<dd>
															<div class="attached-file-wrapper">
																<input type="text" class="upload_text" readonly="readonly">
																<div class="upload-btn_wrap">
																	<button type="button" title="파일찾기">
																		<span>파일찾기</span>  
																	</button>
																	<input type="file" class="input_file" title="파일찾기">
																</div>
															</div>

															<div class="attached-file-wrapper">
																<input type="text" class="upload_text" readonly="readonly">
																<div class="upload-btn_wrap">
																	<button type="button" title="파일찾기">
																		<span>파일찾기</span>  
																	</button>
																	<input type="file" class="input_file" title="파일찾기">
																</div>
															</div>
														</dd>
													</dl>
												</div>

												<div class="one-box">
													<div class="editer-wrapper">
														<textarea id="submit" name="" cols="50" rows="50"></textarea>
													</div>
												</div>
												<div class="one-box">
													<dl>
														<dt>
															<label for="password">
																비밀번호
															</label>
														</dt>
														<dd>
															<input type="password" id="password02" name="" />
														</dd>
													</dl>
												</div>
											</div>

											<div class="btns-area">
												<a href="../sub04/sub01.php" class="btn-m02 btns-color04 depth2">
													취소
												</a>
												<button type="submit" class="btn-m02 btns-color01 depth2">
													작성
												</button>
											</div>				
										</fieldset>
									</form>

			
								</div> 