<!-- // 전학과용 Footer 2024.02.15 -->
<footer>
    <div class="footer">
        <div class="footer-wrapper">

            <div class="footer-left-wrapper">
                <ul>
                    <li>
                        <a href="https://www.ch.ac.kr/doumi/05/08.php" target="_blank" title="새 창 열림">
                            교내연락처
                            <span class="line"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.ch.ac.kr/07_etc/email.html" target="_blank" title="새 창 열림">
                            이메일무단수집거부
                            <span class="line"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.ch.ac.kr/sub01/sub09_02.php?pid=9_2" target="_blank" title="새 창 열림">
                            오시는길
                            <span class="line"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.ch.ac.kr/information/sub/sub01_01.php" target="_blank" title="새 창 열림">
                            정보공개
                            <span class="line"></span>
                        </a>
                    </li>
                    <li>
                        <a href="/adframe/mng" target="_blank" title="새 창 열림">
                            관리자모드
                            <span class="line"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.ch.ac.kr/contents/contents_view.php?site_id=main&TREE_NO=16214&DEPTH=2" target="_blank" title="새 창 열림" class="word-privacy">
                            개인정보처리방침
                            <span class="line"></span>
                        </a>
                    </li>
					
                </ul>

                <div class="footer-information">
                    <address>
                        <?=get_site_info('site_addr',$_REQUEST['site_id'])?>
                    </address>
                    <p class="customer-information">
                        TEL : <?=get_site_info('site_phone',$_REQUEST['site_id'])?>  FAX : <?=get_site_info('site_fax',$_REQUEST['site_id'])?>
                    </p>

                    <p class="copyright">
                        <?=get_site_info('site_copyright',$_REQUEST['site_id'])?>
                    </p>
                </div>
            </div>

            <div class="footer-select-wrapper">
                <dl>
                    <dt>
                        <button type="button" id="selected01">
                            학과홈페이지
                            <span class="arrow"></span>
                        </button>
                    </dt>
                    <dd class="selected-list01">
                        <ul>
							<li>
								<strong>4년제 학과</strong>
								<ul>
									<li>
										<a href="https://nurs.ch.ac.kr" target="_blank" title="새창열림_간호학부">간호학부</a>
									</li>
									<li>
										<a href="https://pt.ch.ac.kr/" target="_blank" title="새창열림_물리치료학과">물리치료학과</a>
									</li>
								</ul>
							</li>
							
							<li>
								<strong>3년제 학과</strong>
								<ul>
									<li>
										<a href="https://dent.ch.ac.kr" target="_blank" title="새창열림_치위생과">치위생과</a>
									</li>
									<li>
										<a href="https://ot.ch.ac.kr" target="_blank" title="새창열림_작업치료과">작업치료과</a>
									</li>
									<li>
										<a href="https://eh.ch.ac.kr" target="_blank" title="새창열림_응급구조과">응급구조과</a>
									</li>
									<li>
										<a href="https://radi.ch.ac.kr" target="_blank" title="새창열림_방사선과">방사선과</a>
									</li>
									<li>
										<a href="https://slt.ch.ac.kr" target="_blank" title="새창열림_언어치료과">언어치료과</a>
									</li>
									<li>
										<a href="https://child.ch.ac.kr/" target="_blank" title="새창열림_유아교육과">유아교육과</a>
									</li>
								</ul>
							</li>
							
							<li><strong>2년제 학과</strong>
								<ul class="pb0">
									<li>
										<a href="https://hadm.ch.ac.kr" target="_blank" title="새창열림_보건행정과">보건행정과</a>
									</li>
									<li>
										<a href="https://yoga.ch.ac.kr" target="_blank" title="새창열림_요가과">요가과</a>
									</li>
									<li>
										<a href="https://op.ch.ac.kr" target="_blank" title="새창열림_안경광학과">안경광학과</a>
									</li>
									<li>
										<a href="https://welf.ch.ac.kr" target="_blank" title="새창열림_사회복지케어과">사회복지케어과</a>
									</li>
                                    <li>
                                        <a href="https://flab.ch.ac.kr" target="_blank" title="새창열림_산림조경비즈니스과">산림조경비즈니스과 </a>
                                    </li>
                                    <li>
                                        <a href="https://wellness.ch.ac.kr" target="_blank" title="새창열림_웰니스문화관광과">웰니스문화관광과 </a>
                                    </li>
									<li>
                                        <a href="https://lifelong.ch.ac.kr" target="_blank" title="새창열림_평생교육상담과">평생교육상담과</a>
                                    </li>
									<li>
                                        <a href="https://glocare.ch.ac.kr/main/index.php" target="_blank" title="새창열림_글로벌케어과">글로벌케어과 </a>
                                    </li>
									<li>
                                        <a href="https://g-beauty.ch.ac.kr" target="_blank" title="새창열림_글로벌뷰티과">글로벌뷰티과</a>
                                    </li>
								</ul>
							</li>
						</ul> 
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <button type="button" id="selected02">
                            대학교 관련링크
                            <span class="arrow"></span>
                        </button>
                    </dt>
                    <dd class="selected-list02">
                        <ul>
							<li><a href="https://eclass.ch.ac.kr" target="_blank" title="새창열림_e클래스">e클래스</a></li>
							<li><a href="https://lib.ch.ac.kr/" target="_blank" title="새창열림_도서관">도서관</a></li>
							<li><a href="https://edu.ch.ac.kr/" target="_blank" title="새창열림_평생교육원">평생교육원</a></li>
                            <!--<li><a href="https://chslc.ch.ac.kr" target="_blank" title="새창열림_언어치료센터">언어치료센터</a></li>-->
                            <li><a href="https://rise.ch.ac.kr/" target="_blank" title="새창열림_RISE 사업단">RISE 사업단</a></li>
						</ul>
                    </dd>
                </dl>
            </div>

        </div>

        <!-- 상단으로 이동 -->
        <a href="#btn-top-go" class="btn-top-go" title="상단으로 이동" style="display: inline;">
            TOP
        </a>

        <a href="javascript:history.back(-1)" class="btn-mobile-back" title="뒤로 이동" style="display: inline;">
            BACK
        </a>
        <!-- //상단으로 이동 -->
    </div>
</footer>