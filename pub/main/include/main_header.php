<?
@session_start();

?>

<header>
	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">콘텐츠 바로가기</a>
	</p>
	<!-- //skip navigation -->

	<!-- gnb wrapper -->
	<div class="gnb-wrapper">
		<div class="left">
			<ul>
				<li>
					<a href="../main/index.php" target="_self">
						대학메인
					</a>
				</li>
				<li>
					<a href="http://ipsiw.ch.ac.kr/page/main/index.php" target="_blank" title="새창열림">
						입학홈페이지
					</a>
				</li>
				<li>
					<a href="https://edu.ch.ac.kr/main/main.php" target="_blank" title="새창열림">
						평생교육원
					</a>
				</li>
				<li>
					<a href="http://lms.ch.ac.kr/" target="_blank" title="새창열림">
						e클래스
					</a>
				</li>
				<li>
					<a href="#">
						ENGLISH
					</a>
				</li>
			</ul>
		</div>
		<button type="button" class="btn-popup">
			<span>
				POPUP
			</span>
		</button>
	</div>
	<!-- //gnb wrapper -->

	<div class="header">
		<div class="header-wrapper">
			<div class="header-area">
				<h1>
					<a href="http://bv.ch.ac.kr/pub/main/main/index.php">
						춘해보건대학교
					</a>
				</h1>

				<div class="top-menu-wrapper">
					<? include "../include/main_menu.php" ?>
				</div>


				<div class="right-side-menu-wrapper">
					<div class="side-menu-area">
						<button type="button" class="btn-option">
							<strong>
								옵션
							</strong>
						</button>
						<div class="side-menu-area01">
							<img src="../main/img/common/bubble_tail01@2x.png" class="bubble-tail" />
							<ul>
								<li>
									<a href="#">
										홈
									</a>
								</li>
								<li>
									<? if($_SESSION['MEMBER_ID']!='' || $_SESSION['ID'] != ''){?>
										<a href="javascript:;" id="btnLogout">
											<span>
												로그아웃
											</span>
										</a>
									<?} else {
										?>
										<a href="/login/sso/business.php">
											<span>
												로그인
											</span>
										</a>
									<?}?>
								</li>
							</ul>
							<button type="button" class="btn-clsoe">
								닫기
							</button>
						</div>
					</div>

					<div class="total-menu-search-wrapper">
						<div class="total-search-wrapper">
							<button type="button" class="btn-total-search">
								통합검색
							</button>
							<div class="total-search-area">
								<form action="" method="">
									<fieldset>
										<legend class="blind">
											통합검색
										</legend>
										<input type="search" name="" value="" placeholder="검색어를 입력해주세요." />

										<input type="button" name="" value="검색" onClick="location.href='http://bv.ch.ac.kr/pub/main/totalsearch/totalsearch.php'">
										<!--<input type="submit" name="" value="검색" />-->

										<button type="button" class="btn-close">
											창닫기
										</button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>

					<button type="button" title="사이트맵 열기" class="btn-totalmenu" onClick="location.href='http://bv.ch.ac.kr/pub/main/sitemap/sitemap.php'">
						<span class="menu">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="mask-totalmenu"></div>
	<div class="totalmenu-wrapper">
		<div class="mobile-gnb-wrapper">
			<ul>
				<li>
					<a href="#">
						<img src="/pub/main/img/common/icon_mobile_gnb0101.png" alt="홈으로" />

						<strong>
							홈으로
						</strong>
					</a>
				</li>

				<li>
					<a href="#">
						<img src="/pub/main/img/common/icon_mobile_gnb0102.png" alt="홈으로" />
						<strong>
							로그인
						</strong>
					</a>
				</li>

				<li>
					<a href="#">
						<img src="/pub/main/img/common/icon_mobile_gnb0103.png" alt="대학메인" />
						<strong>
							ENGLISH
						</strong>
					</a>
				</li>
				<ul>
		</div>


		<div class="totalmenu-area">
			<div class="totalmenu-depth1">
				<ul>
					<? 
						foreach ( $menu_1depth as $k => $v ) {
						// 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
						if ( $v[cnt] > 0 && ( $v[ETC1] == "MENU" ) )
						$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][0][LINK_URL];
						$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][0][LINK_TARGET];

						// 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
						if($menu_2depth[$v[TREE_NO]][0][cnt] > 0 && ($menu_2depth[$v[TREE_NO]][0][ETC1] == "MENU")){
							$v[LINK_URL] = $menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][LINK_URL];

						}

						//입학메뉴에서 입학홈페이지 링크 말고 입학상담 링크주소를 가지고옴
						if($menu_2depth[$v[TREE_NO]][0][ETC1] == "LINK" && $menu_2depth[$v[TREE_NO]][0][LINK_TARGET] == "1"){
							$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][1][LINK_TARGET];
							$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][1][LINK_URL];
						}
					?>
						<li>
							<button type="button" class="topmenu<?=$k+1?>">
								<span>
									<?=$v[NAME]?>
								</span>
							</button>
						</li>
					<? } ?>
				</ul>
			</div>


			<div class="totalmenu-depth2-wrapper">
				<div class="totalmenu-depth2-area">
					<div class="totalmenu-depth2-box">
						<?
							foreach ( $menu_1depth as $k => $v ) {
						?>
						<div class="totalmenu-depth2-group topmenu<?=$k+1?>">
							<h2>
								<?=$v[NAME]?>
							</h2>
							<ul>
							<?
								foreach ( $menu_2depth[$menu_1depth[$k][TREE_NO]] as $k2 => $v2 ) {
							?>
								<li>
									<a href="<?=$v2[LINK_URL]?>" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
										<span class="title">
											<?=$v2[NAME]?>
										</span>
										<span class="arrow"></span>
									</a>
								</li>
								<? } ?>
							</ul>
						</div>
						<? } ?>
					</div>
					<?
						foreach ( $menu_1depth as $k => $v ) {
						foreach ( $menu_2depth[$v[TREE_NO]] as $k2 => $v2 ) {
							if($v2[cnt]>0) {
					?>
					<div class="totalmenu-depth2-box">
						
						<div class="totalmenu-depth3-group topmenu<?=$k+1?>-<?=$k2+1?>">
							<h3>
								<button type="button">
									<?=$v2[NAME]?>
								</button>
							</h3>

							<ul class="topmenu<?=$k+1?>-<?=$k2+1?>">
								<?
									foreach ( $menu_3depth[$v2[TREE_NO]] as $k3 => $v3 ) {
									if ( $v2[cnt] > 0 && ( $v2[ETC1] == "MENU" ) ) $v2[LINK_URL] = $menu_3depth[$v2[TREE_NO]][0][LINK_URL];
								?>
								<li>
									<a href="<?=$v3[LINK_URL]?>" <?=$v3[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>-<?=$k3+1?>">
										<?=$v3[NAME]?>
										<?
											if($v3[cnt]>0) {
										?>
										<span class="arrow"></span>
										<? } ?>
									</a>
									<?
										if($v3[cnt]>0) {
									?>
									<ul class="topmenu<?=$k+1?>-<?=$k2+1?>-<?=$k3+1?>">
										<?
											foreach ( $menu_4depth[$v3[TREE_NO]] as $k4 => $v4 ) {
										?>
										<li>
											<a href="<?=$v4[LINK_URL]?>" <?=$v4[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>-<?=$k3+1?>-<?=$k4+1?>">
												<?=$v4[NAME]?>
											</a>
										</li>
										<? } ?>
									</ul>
									<? } ?>
								</li>
								<? } ?>
							</ul>
						</div>
						<? } } } ?>
					</div>
				</div>
			</div>
		</div>

		<button type="button" class="btn-mobile-close">
			<img src="/pub/main/img/common/btn_close_mobile.png" alt="전체메뉴 닫기" />
		</button>
	</div>
</header>
<script>
    $(document).ready(function() {
        $('#btnLogout').bind('click', function() {
            if(confirm('로그아웃 하시겠습니까?')) {
                location.replace('/login/sso/logout.php');
            }
        })
    });
</script>