<?php
	function my_quote_get_dir($type) {
		if ( !defined('WP_CONTENT_URL') )
			define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
		if ( !defined('WP_CONTENT_DIR') )
			define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
		if ($type=='path') { return WP_CONTENT_DIR.'/plugins/'.plugin_basename(dirname(__FILE__)); }
		else { return WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)); }
	}

	function my_quote_get_quote(){
		$sel_quote = '';
		$dir = dir(dirname(__FILE__).'/db/');
		$list_dir = array();
		while($db_file = $dir->read()){
			if(substr($db_file, -6) == 'db.php')
				$list_dir[] = $db_file;	
		}
		$dir->close();

		$sel_col_id = array_rand($list_dir);
		$sel_col = $list_dir[$sel_col_id];
		
		$db = array();
		@include(dirname(__FILE__).'/db/'.$sel_col);
		
		if(count($db)){
			$sel_quote_id = array_rand($db);
			$sel_quote = utf8_encode($db[$sel_quote_id]);		
		}
		return $sel_quote;
	}
?>