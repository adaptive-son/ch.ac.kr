<?
/*======================================================================================================
////////////   /////                 ///////////     /////    ///////
///////////  ////  //            ////       //   /// //   //  ///
////////// ///           ///     ////////////    ///  //  //   ///
///////// ////////////    ///             ///   // //    ///
//////// ///                ///..///.............///.... ////....///
======================================================================================================*/

class Calendar
{
        var $Year;                                                        ## 년
        var $Month;                                                        ## 월
        var $TotalDays;                                                ## 토탈데이
        var $FirstDay;                                                ## 첫째날
        var $Col                = 0;                                ## colspace
		var $week = array();
		var $weekNum = 1;
		var $weekKey = array('sun','mon','tue','wed','thu','fri','sat');
		var $script = '';

        /*--------------------------------------------------------------------------------------------------
        @@함수명        : main
        @@사용함수        : script_name

        ## 메인
        ---------------------------------------------------------------------------------------------------*/
        function main($year,$month,$day)
        {
			$this->Year              = $year;
			$this->Month             = $month;
			$this->TotalDays        .=$this->getTotaldays($month,$year);
			$this->FirstDay         .=$this->firstDay($month,$day,$year);			
        }

        /*--------------------------------------------------------------------------------------------------
        @@함수명        : getTotaldays

        ## 이번달 이번년의 총 날 수를 구한다.
        ---------------------------------------------------------------------------------------------------*/
        function getTotaldays($month,$year)
        {
            $result = date("t",mktime(0,0,1,$month,1,$year));
	        return $result;
        }

        /*--------------------------------------------------------------------------------------------------
        @@함수명        : getTotaldays

        ## 이번달 이번년의 총 날 수를 구한다.
        ---------------------------------------------------------------------------------------------------*/
        function firstDay($month,$day,$year)
        {
		    $result = date('w', mktime(0,0,0,$month,1,$year));        
			return $result;
        }

        /*--------------------------------------------------------------------------------------------------
        @@함수명        : colOpenTd

        ## 첫번째 1일을 만나기 전까지 null 값 대입
        ---------------------------------------------------------------------------------------------------*/
        function colOpenTd()
        {                
			for($i=$this->Col; $i<$this->FirstDay; $i++)
			{					
				$this->week[$this->weekNum][$this->weekKey[$this->Col]] = null;
				$this->Col++;
			}
        }

        /*--------------------------------------------------------------------------------------------------
        @@함수명        : dayTd    

        ## 1부터 마지막날(28,29,30,31) 까지 출력
        ---------------------------------------------------------------------------------------------------*/
        function dayTd($id, $data)
        {
			$this->colOpenTd();
			for($j=1; $j <= $this->TotalDays; $j++)
			{	
				
				if($this->Year.'-'.$this->Month.'-'.mk_num($j,2) == date('Y-m-d')) {
					$d = '<span style="background-color:rgb(232,252,156);"><B>'.mk_num($j,2).'</B></span>';
					
				} else {
					$d = mk_num($j,2);
				}
				if($data[$this->Year.'-'.$this->Month.'-'.mk_num($j,2)] != '') {
					$this->week[$this->weekNum][$this->weekKey[$this->Col]] = "<b onClick=\"go_date('{$id}','".$data[$this->Year.'-'.mk_num($this->Month,2).'-'.mk_num($j,2)]."')\" style=\"cursor:hand\"><U>".$d.'</U></b>';
				} else {					
					if($this->script != '') {
						$d = "<a href=\"javascript:".$this->script."('".$this->Year.'-'.mk_num($this->Month,2).'-'.mk_num($j,2)."')\" style='cursor:hand'>".$d."</a>";
					} 
					$this->week[$this->weekNum][$this->weekKey[$this->Col]] = $d;
				}
				$this->Col++;

				if($this->Col==7)
				{
					$this->weekNum++;					                       
					$this->Col        = 0;
				}				
			}
			$this->colCloseTd();
        return $this->week;
        }

        
        /*--------------------------------------------------------------------------------------------------
        @@함수명        : colCloseTd

        ## 마지막 (28,29,30,31)일을 만나기 전까지 null 값 대입
        ---------------------------------------------------------------------------------------------------*/
        function colCloseTd()
        {
			while($this->Col > 0 && $this->Col < 7)
			{
				$this->week[$this->weekNum][$this->weekKey[$this->Col]] = null;
				$this->Col++;
			}
        }
}
?> 
