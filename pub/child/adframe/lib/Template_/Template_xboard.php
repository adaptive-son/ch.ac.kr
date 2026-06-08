<?php

// Custmize

require_once(dirname(__file__).'/Template_.class.php'); 

class Template extends Template_ { 

	

	var $compile_check = true; 

	var $compile_dir   = ''; 

	var $skin          = ''; 

	var $template_dir  = ''; 

	var $prefilter     = 'adjustPath';



	function Template($skin='') {

		$this->compile_dir = dirname(__FILE__).'/../../xvar/_compile';

		$this->template_dir = dirname(__FILE__).'/../../xvar/skin';		

		$this->skin = $skin;

		
	}

}

?>
