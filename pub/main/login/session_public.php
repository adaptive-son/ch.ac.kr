<?
	session_start();

	// PHP7: mysql_escape_string() undefined here (no bootstrap include in this file,
	// and $_POST/$_GET aren't used in any DB query below) -> array_map() silently
	// warned and nulled out $_POST/$_GET, breaking $_GET["jsoncallback"] below. Removed.

	header("Content-type: application/json");
    
    //��������
    //if(strpos($_SERVER['HTTP_REFERER'], $_GET["SessionHost"]) == false)  exit;

	/* 
	 * ���� ���ڿ� ����(�μ� : ����, Ÿ��) 
	 * ������ Ÿ���� ���ڿ��� ������ ������ ���� ���ڿ��� ��ȯ�Ѵ�. 
	 * Ÿ�� 0 : ���� ��ҹ���(A-Z,a-z), ����(0-9) 
	 * Ÿ�� 1 : ���� �빮��(A-Z), ����(0-9) 
	 * Ÿ�� 2 : ���� �ҹ���(a-z), ����(0-9) 
	 * Ÿ�� 3 : ���� �빮��(A-Z) 
	 * Ÿ�� 4 : ���� �ҹ���(a-z) 
	 * Ÿ�� 5 : ����(0-9) 
	 * ����Ʈ : false ��ȯ. 
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


    //���ǰ� ��ȣȭ
    $Session_CallBack = "mem_group=".$_SESSION['MEMBER_GROUP']."&mem_uid=".$_SESSION['MEMBER_UID']."&mem_name=".$_SESSION['MEMBER_UNAME'];
    $Session_CallBack = encode_rand_str(7, 0).base64_encode($Session_CallBack).encode_rand_str(3, 0)."==".encode_rand_str(3, 0)."==".encode_rand_str(4, 0)."==".encode_rand_str(3, 0)."==||";
    //$Session_CallBack = base64_encode($Session_CallBack)."||";
    
    
    if($_SESSION['MEMBER_UID'])
    	$json = $_GET["jsoncallback"] . "({\"session_key\": \"" . $Session_CallBack . "\"})";
    else
		$json = $_GET["jsoncallback"] . "({\"session_key\": \"false\"})";
?>
<?=$json?>