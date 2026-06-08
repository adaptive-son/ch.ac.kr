<?
	session_start();
	
	$_POST = array_map('mysql_escape_string', $_POST);
	$_GET = array_map('mysql_escape_string', $_GET);

	header("Content-type: application/json");
    
    //변조방지
    //if(strpos($_SERVER['HTTP_REFERER'], $_GET["SessionHost"]) == false)  exit;

	/* 
	 * 랜덤 문자열 생성(인수 : 길이, 타입) 
	 * 지정된 타입의 문자열로 지정된 길이의 랜덤 문자열을 반환한다. 
	 * 타입 0 : 영문 대소문자(A-Z,a-z), 숫자(0-9) 
	 * 타입 1 : 영문 대문자(A-Z), 숫자(0-9) 
	 * 타입 2 : 영문 소문자(a-z), 숫자(0-9) 
	 * 타입 3 : 영문 대문자(A-Z) 
	 * 타입 4 : 영문 소문자(a-z) 
	 * 타입 5 : 숫자(0-9) 
	 * 디폴트 : false 반환. 
	*/ 
	function encode_rand_str($length, $type)
	{
	    switch($type){ 
	        case 0: 
	            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890'; 
	            break; 
	        case 1: 
	            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'; 
	            break; 
	        case 2: 
	            $chars = 'abcdefghijklmnopqrstuvwxyz1234567890'; 
	            break; 
	        case 3: 
	            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	            break; 
	        case 4: 
	            $chars = 'abcdefghijklmnopqrstuvwxyz'; 
	            break; 
	        case 5: 
	            $chars = '1234567890'; 
	            break; 
	        default: 
	            return false; 
	    } 
	    $chars_length = (strlen($chars) - 1); 
	    $string = ''; 
	    for ($i = 0; $i < $length; $i = strlen($string)){ 
	        $string .= $chars{rand(0, $chars_length)}; 
	    } 
	    return $string; 
	}


    //세션값 암호화
    $Session_CallBack = "mem_group=".$_SESSION['MEMBER_GROUP']."&mem_uid=".$_SESSION['MEMBER_UID']."&mem_name=".$_SESSION['MEMBER_UNAME'];
    $Session_CallBack = encode_rand_str(7, 0).base64_encode($Session_CallBack).encode_rand_str(3, 0)."==".encode_rand_str(3, 0)."==".encode_rand_str(4, 0)."==".encode_rand_str(3, 0)."==||";
    //$Session_CallBack = base64_encode($Session_CallBack)."||";
    
    
    if($_SESSION['MEMBER_UID'])
    	$json = $_GET["jsoncallback"] . "({\"session_key\": \"" . $Session_CallBack . "\"})";
    else
		$json = $_GET["jsoncallback"] . "({\"session_key\": \"false\"})";
?>
<?=$json?>