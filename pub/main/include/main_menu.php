<ul>
	<? foreach ( $menu_1depth as $k => $v ) {
		// 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
		if ( $v[cnt] > 0 && ( $v[ETC1] == "MENU" ) )
		$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][0][LINK_URL];
		$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][0][LINK_TARGET];

		// 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
		if($menu_2depth[$v[TREE_NO]][0][cnt] > 0 && ($menu_2depth[$v[TREE_NO]][0][ETC1] == "MENU")){
			$menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][LINK_URL];
		} 

		// 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
		if($menu_3depth[$v2[TREE_NO]][0][cnt] > 0 && ($menu_3depth[$v2[TREE_NO]][0][ETC1] == "MENU")){
			$menu_4depth[$menu_3depth[$v2[TREE_NO]][0][TREE_NO]][0][LINK_URL];
		} 

		//입학메뉴에서 입학홈페이지 링크 말고 입학상담 링크주소를 가지고옴
		if($menu_2depth[$v[TREE_NO]][0][ETC1] == "LINK" && $menu_2depth[$v[TREE_NO]][0][LINK_TARGET] == "1"){
			$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][1][LINK_TARGET];
			$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][1][LINK_URL];
		}
		
		// 취업정보 링크주소 가져오기
		if($menu_2depth[$v[TREE_NO]][0][ETC1] == "LINK" && $menu_2depth[$v[TREE_NO]][0][LINK_TARGET] == "1"){
			$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][1][LINK_TARGET];
			$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][1][LINK_URL];
		}

		
        ?>

		<li>
			<a href="<?=$v[LINK_URL]?>" class="topmenu<?=$k+1?>" <?=$v[LINK_TARGET]?>>
				<span class="title">
					<span data-hover="<?=$v[NAME]?>">
						<?=$v[NAME]?>
					</span>
				</span>
			</a>
			<div class="top-submenu">
				<? if($v[NAME]=="입학안내") { ?>
				<div class="top-submenu-wrapper" style="display: none;">
				<? } else { ?>
				<div class="top-submenu-wrapper">
				<? } ?>
					<div class="top-submenu-area">
						<div class="word-menu-slogan">
							<h2>
								<?=$v[NAME]?>
							</h2>
							<? if($k+1 =="1") {?>
							<p>
								세계적 수준의 보건의료교육<br />
								전문인재를 양성하는 직업교육<br />
								선도대학
							</p>
							<? } else if($k+1 =="2") {?>
							<p>
								우리 대학은 역사와 전통을<br />
								바탕으로 꾸준히 발전해 왔으며<br />
								앞으로의 100년의 비상을<br />
								준비하고 있습니다.
							</p>
							<? } else if($k+1 =="4") {?>
							<p>
								진실, 인내, 봉사, 관철의 정신을<br />
								바탕으로 전인적 인재양성에<br />
								앞장서고 있습니다.
							</p>
							<? } else if($k+1 =="5") {?>
							<p>
								시대의 변화를 적극적으로 이끌며<br />
								학생들이 미래의 꿈을 당당히<br />
								펼쳐 높이 비상할 수 있도록<br />
								최선을 다하겠습니다.
							</p>
							<? } else if($k+1 =="6") {?>
							<p>
								글로벌 시대를 선도하는 세계적인<br />
								보건의료 특성화대학으로<br />
								도약하고 있습니다.
							</p>
							<? } ?>
						</div>
						<img src="../img/common/bg_totalmenu_pc.png" alt="" class="bg">
						<? include "../_common/lnb.php" ?>
						<h2>
							<a class="topmenu<?=$k+1?>" <?=$v[LINK_TARGET]?>>
								<?=$v[NAME]?>
								<span class="arrow"></span>
							</a>
						</h2>
						<ul>
							<?
							foreach ( $menu_2depth[$menu_1depth[$k][TREE_NO]] as $k2 => $v2 ) {
								if ( $v2[cnt] > 0 && ( $v2[ETC1] == "MENU" ) ) {
									$v2[LINK_URL] = $menu_3depth[$v2[TREE_NO]][0][LINK_URL];
									//2차가 MENU이고 3차가 하이퍼링크이고 3차 링크 타겟이 새창 열림일 경우 - 20.12.10 shlee
									$v2[LINK_TARGET] = $menu_3depth[$v2[TREE_NO]][0][LINK_TARGET];
								}
								if ( $v2[cnt] > 0 && ( $v2[ETC1] == "MENU" ) && ( $v2[TREE_NO] == "15997" ) ) $v2[LINK_URL] = $menu_4depth[$v3[TREE_NO]][0][LINK_URL];
								?>
								<li>
									<a href="<?=$v2[LINK_URL]?>" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
										<span class="title"><?=$v2[NAME]?></span>
										<span class="bg"></span>
										<span class="arrow depth2"></span>
										<?php if(strpos($v2[LINK_TARGET],"blank")){?><?}?>
										<ul>
									</a>
											<? foreach ( $menu_3depth[$v2[TREE_NO]] as $k3 => $v3 ) { 
											if ($v3[cnt] > 0 ) $v3[LINK_URL] = $menu_4depth[$v3[TREE_NO]][0][LINK_URL];
											?>
												<li>
													<a href="<?=$v3[LINK_URL]?>" <?=$v3[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=($k2+1)?>-<?=$k3+1?>">
														<?=$v3[NAME]?>
														<span class="bg"></span>
														<?=$window_icon?>
													</a>
												</li>
											<? } ?>
										</ul>

								</li>
							<?								
							}
							?>
						</ul> 
						<button type="button" class="btn-totalmenu-close">
							<img src="../img/common/btn_close_pc.png" alt="전체메뉴 닫기" />
						</button>
					</div>
				</div>
			</div>
		</li>
	<?}?>
</ul>