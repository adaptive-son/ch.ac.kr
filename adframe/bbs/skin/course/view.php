<script language="JavaScript">
    function bluringIMG(){
        if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
    }
    document.onfocusin=bluringIMG;

    function sizeModify(img){
        if (img.width > <?=$configBBS[board_viewimgwidth]?>){
            img.width = <?=$configBBS[board_viewimgwidth]?> ;
        }
    }
    function PopupIMG(FURL,WIDTH,HEIGHT,VALUED){
        window.open(FURL+'?data='+VALUED,'popup','width='+WIDTH+',height='+HEIGHT+',scrollbars=no,stauts=no');
    }

    function DisplayDetail(divname,state) {
        if(state == 1) {
            document.getElementById(divname).style.display = "";
        }
        else {
            document.getElementById(divname).style.display = "none";
        }
    }
</script>

<div class="board-area">

    <? global $TREE_NO, $DEPTH; // 메뉴 설정을 위한 변수 정의 ?>

    <div class="board-view">
        <div class="title-area">
            <h4>
                <?=$view_row[title]?>
            </h4>
        </div>

        <div class="board-view-information">
            <dl>
                <dt>
                    번호
                </dt>
                <dd>
                    <?=$view_row[idx]?>
                </dd>
            </dl>

            <dl>
                <dt>
                    작성자
                </dt>
                <dd>
                    <?=$bbs_name?>
                </dd>
            </dl>

            <dl class="board-view-date">
                <dt>
                    등록일
                </dt>
                <dd>
                    <?=$writeday[0]?>-<?=$writeday[1]?>-<?=$writeday[2]?>
                </dd>
            </dl>

            <dl>
                <dt>
                    조회수
                </dt>
                <dd>
                    <?=$view_row[readnum]?>
                </dd>
            </dl>
        </div>

        <dl class="attached-file-wrapper">
            <dt>
                첨부파일
            </dt>
            <dd>
                <?
                for($i=0; $i < $filev; $i++) {
                    echo "<p>".$upfile_link[$i]."</p>";
                }
                ?>
            </dd>
        </dl>

        <div class="board-contents">

            <?
            // 2016.08.23 에디터에서 이미지 첨부 시에 경로가 중복되는 경우가 생겨서 adframe/bbs 가 아닌 것만 치환하도록 변경. 
            if (strpos($content, "adframe/bbs/") === false) {
                $content = str_replace("bbs/", "adframe/bbs/", $content);
            }
            $content = str_replace("http://cis.iuk.ac.kr", "", $content);
            $content = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]'  \\2 \\3", $content);
            echo stripslashes(htmlspecialchars_decode($content));
            ?>

        </div>

        <? include("../board/preNext.php");?>
    </div>


    <div class="btns-area">
        <div class="btns-left">
            <form method="POST" name="<? if($permEdit == 1 || $SecAdmin == 1) { echo "pwdForm"; }?>">
                <input type="hidden" id="secAdmin" name="secAdmin" value="<?=$SecAdmin?>">
                <input type="hidden" id="permEdit" name="permEdit" value="<?=$permEdit?>">
                <input type="hidden" name="site_id" id="site_id" value="<?=TREE_ID?>">
                <input type="hidden" name="TREE_NO" id="TREE_NO" value="<?=$TREE_NO?>">
                <input type="hidden" name="DEPTH" id="DEPTH" value="<?=$DEPTH?>">
                <input type="hidden" name="CHILD" id="CHILD" value="<?=$CHILD?>">
                <input type="hidden" name="data" id="data" value="">
                <input type="hidden" id="pwd" name="pwd" value="<?if($permEdit == 1){echo $view_row[pwd];}?>">
                <input type="hidden" id="chk" name="chk" value="ok"/>
                <?
                //echo $_BBS_Password;
                /*BBSButtonLink($_BBS_Modified, "수정", "", "btn-m02 btns-color03 depth4");
                BBSButtonLink($_BBS_Deleted, "삭제", "", "btn-m02 btns-color02 depth4");*/
                ?>
            </form>
        </div>

        <div class="btns-right">
            <a href="<?=$PHP_SELF?>?site_id=<?=TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>&bbs=list&data=<?=$data?>" class="btn-m02 btns-color01 depth4">
                목록
            </a>
        </div>
    </div>
</div>

<div class="mask-layerpopup" style="display: none;"></div>
<? if($permEdit != 1 && $SecAdmin != 1) {
    include("../board/check_password.php");
}?>
