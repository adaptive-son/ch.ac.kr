		<!-- sub visual -->
		<div class="sub-visual">
			<img src="../img/sub01/img_subvisual_pc.jpg" alt="" class="pc" />
			<img src="../img/sub01/img_subvisual_mobile.jpg" alt="" class="mobile" />
			<div class="word-slogan-wrapper">
				<p class="title">
					국제교류처
				</p>
				<div class="contents-navigation-wrapper">
					<div class="contents-navigation">
						<?php
						$pageName1 = str_replace("&lt;", "", $PAGENAME1);
						$pageName2 = str_replace("&lt;", "", $PAGENAME2);
						?>
						<span class="icon-home">
							Home
						</span>
						<?php if ($pageName2) { ?>
						<span class="icon-gt">
							&gt;
						</span>
						<span class="location">
							<?php echo $pageName1 ?>
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<?php } ?>
						<strong>
							<?php echo $pageName2 ? $pageName2 : $pageName1 ?>
						</strong>
					</div>
				</div>
			</div>
		</div>
		<!-- //sub visual -->