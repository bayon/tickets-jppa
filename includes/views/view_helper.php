<?php
function build_view($view='',$data='',$view_type=''){
	
	if($view != ''){
		include_once('NAV.php');
		include_once($view);	
	}else{
		include_once('main.view.php');
	}
	//include_once('FOOT.php');
}
/*
function build_view($view='',$view_type='',$data=''){
	include_once('HEAD.php');
	if($view != ''){
		include_once('NAV.php');
		include_once($view);	
	}else{
		include_once('main.view.php');
	}
	include_once('FOOT.php');
}
 * 
 */
?>