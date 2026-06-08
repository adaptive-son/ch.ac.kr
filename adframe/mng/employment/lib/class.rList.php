<?

// 페이지 컷◀ 1 [2][3][4][5] ▶
class RList
{
    var $g_pageName;		//설정파일명 ex) ****.php, OOOO.php

    var $g_pageCnt;			//현재페이지 번호
    var $g_offset;			//데이타베이스 시작 포인트 번호
    var $g_numRows;			//총게시물 수
    var $g_pageBlock;		//블럭당 페이지 수 ex) 5 : [1][2][3][4][5]
    var $g_limit;			//페이지당 출력 게시물 수
    var $g_search;			//검색 컬럼 ex)name,title,...
    var $g_searchstring;	//검색어

    var $g_option;			//추가 get 값  ex) &part=$part

    var $g_pniView;			//링크되지 않은 아이콘 표시 여부 ex) true,1 : 표시  false,0 : 미표시
    var $g_pIcon;			//이전 아이콘
    var $g_nIcon;			//다음 아이콘

    //
    // 생성자
    // CList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
    // CList(페이지명, 현재페이지번호, DB시작offset, 총게시물수, 블럭당페이지수, 페이지당게시물수, 검색컬럼, 검색어, 추가get값)
    //
    function RList($pagename,$pagecnt,$offset,$numrows,$pageblock,$limit,$search,$searchstring,$option,$search_major){

        $this->g_pageName		= $pagename;
        $this->g_pageCnt		= $pagecnt;
        $this->g_offset			= $offset;
        $this->g_numRows		= $numrows;
        $this->g_pageBlock		= $pageblock;
        $this->g_limit			= $limit;
        $this->g_search			= $search;
        $this->g_searchstring	= $searchstring;
        $this->g_option			= $option;
        $this->g_search_major = $search_major;
    }
    //
    // 아이콘 설정
    // putList( BOOL pniView, char* pre_icon, char* next_icon)
    // putList( 링크되지 않은 아이콘 표시 여부, 이전아이콘, 다음아이콘, 처음, 마지막, 한칸이전, 한칸다음
    //
    function putList($pniView,$pre_icon,$next_icon,$first_icon,$last_icon,$pre1_icon,$next1_icon){
        $this->g_pniView=$pniView;					//링크되지 않은 아이콘 표시 여부
        if(empty($pre_icon))	$this->g_pIcon="<<";			//이전 아이콘 설정
        else					$this->g_pIcon=$pre_icon;

        if(empty($next_icon))	$this->g_nIcon=">>";			//다음 아이콘 설정
        else					$this->g_nIcon=$next_icon;

        if(empty($first_icon))	$this->g_fIcon="처음으로";		//처음 아이콘 설정
        else					$this->g_fIcon=$first_icon;

        if(empty($last_icon))	$this->g_lIcon="마지막으로";	//마지막 아이콘 설정
        else					$this->g_lIcon=$last_icon;


        if(empty($pre1_icon))	$this->g_p1Icon="<";			//한칸이전 아이콘 설정
        else					$this->g_p1Icon=$pre1_icon;

        if(empty($next1_icon))	$this->g_n1Icon=">";			//한칸다음 아이콘 설정
        else					$this->g_n1Icon=$next1_icon;

        $this->pniPrint(); //화면 출력
    }
    //
    // 화면 출력
    //
    function pniPrint(){

        if ( preg_match("|recruit|", $this->g_pageName) > 0 ) {
            $offset_separate = "&";
        } else {
            $offset_separate = "?";
        }

        $chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //현제페이지 체크

        if($chekpage==$this->g_pageCnt){  //마지막 블럭일 경우....
            $pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //마지막 블럭 페이지수 계산
            if(!($this->g_numRows%($this->g_limit))){
                $pCnt--;
            }
        }else{
            $pCnt=$this->g_pageBlock;
        }


        $onstepcheck = ($this->g_offset/$this->g_limit)-($this->g_pageBlock*$this->g_pageCnt);

        $lastpagecnt = ceil(($this->g_numRows / $this->g_limit / $this->g_pageBlock)-1);
        $lastt = ceil($this->g_numRows / $this->g_limit);
        $lastoffset = ($lastt*$this->g_limit)-$this->g_limit;
        $lastletter_no=$this->g_numRows-(($lastt-1)*$this->g_limit);


        /*   처음   */
        $data="search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
        if($this->g_pniView)
            echo "<a href=".$this->g_pageName.$offset_separate.$data.">".$this->g_fIcon."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";



        /*    이전   */
        if($this->g_pageCnt>0){				//이전페이지 있음
            $prepage=$this->g_pageCnt-1;	//이전블럭 시작페이지 설정.
            $pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//이전블럭 시작글 번호 설정
            $data="pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

            $pre_str ="<a href='".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major."'>".$this->g_pIcon."</a>&nbsp;";

            echo "$pre_str"; 	//이전아이콘 링크
        }else{					//이전페이지 없음
            if($this->g_pniView)//아이콘 표시
                $empty_pre_str = $this->g_pIcon."&nbsp;";

            else				//아이콘 비표시
                $empty_pre_str = "&nbsp;";

            echo "$empty_pre_str";
        }




        /*    1개 이전   */
        $p1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)-$this->g_limit;
        $p1letter_no=$this->g_numRows-$p1offset;


        if($onstepcheck == 0)	$p1pageCnt = $this->g_pageCnt-1;
        else					$p1pageCnt = $this->g_pageCnt;

        $data="offset=".$p1offset."&letter_no=".$p1letter_no."&pagecnt=".$p1pageCnt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($p1offset >= 0){
            if($this->g_pniView) echo "&nbsp;<a href=".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major.">".$this->g_p1Icon."</a>&nbsp;";
        }else{
            if($this->g_pniView) echo "&nbsp;".$this->g_p1Icon."&nbsp;";
        }



        /* 1 [2][3][4][5] */
        $l=0;
        while($l<$pCnt){
            $loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//시작글 지정
            $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//페이지 번호 설정
            $cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//시작글 번호 지정
            $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
            $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $data=$en_str;
            if($lnum==(($this->g_offset/$this->g_limit)+1))	{//현재 페이지 일 경우
                echo " <font size='2'><b>$lnum</b></font> ";
            }else{
                $mid_str = " <span class='nort'>[<a href='".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major."'>".$lnum."</a>]</span> ";

                echo"$mid_str";
            }
            $l++;
        }




        /*    1개 다음   */
        $n1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)+$this->g_limit;
        $n1letter_no=$this->g_numRows+$n1offset;


        if($onstepcheck == 9)	$n1pageCnt = $this->g_pageCnt+1;
        else					$n1pageCnt = $this->g_pageCnt;

        $data="offset=".$n1offset."&letter_no=".$n1letter_no."&pagecnt=".$n1pageCnt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($n1offset <= $lastoffset){
            if($this->g_pniView) echo "&nbsp;<a href=".$this->g_pageName.$offset_separate.$data."&apply_major=".$this->g_search_major.">".$this->g_n1Icon."</a>&nbsp;";
        }else{
            if($this->g_pniView) echo "&nbsp;".$this->g_n1Icon."&nbsp;";
        }




        /*    다음   */
        if($this->g_pageCnt!=$chekpage){		//다음페이지 있음
            echo "&nbsp;";
            $newpagecnt=$this->g_pageCnt+1;		//다음 블럭 시작페이지 설정
            $newt=$cu_letter_no-$this->g_limit;	//다음 블럭 시작글 번호 설정
            $data="pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $next_str="<a href='".$this->g_pageName.$offset_separate.$data."'>".$this->g_nIcon."</a>";

            echo $next_str;			//다음 아이콘 링크
        }else{						//다음페이지 없음
            if($this->g_pniView)	//아이콘 표시
                echo"&nbsp;".$this->g_nIcon;
            //echo"&nbsp;";

            else					//아이콘 비표시
                echo"&nbsp;";
        }


        /*   마지막   */
        $data="pagecnt=".$lastpagecnt."&letter_no=".$lastletter_no."&offset=".$lastoffset."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($this->g_pniView) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$this->g_pageName.$offset_separate.$data."&".$this->g_option."'>".$this->g_lIcon."</a>";

    }//function putList()
}//class

?>