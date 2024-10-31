<?php
	require_once(ABSPATH . 'wp-admin/upgrade.php');

	global $wpdb;

	$cur_ver = get_option("my_quote_version");
	if($cur_ver == ''){
		add_option("my_quote_title", "Quote of The Day");
		add_option("my_quote_credit", 1);

		$cur_ver = '1.0.0';
		add_option("my_quote_version", $cur_ver);
	}

	update_option("my_quote_credit", 1);
?>