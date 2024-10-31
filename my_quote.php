<?php
	/*
		Plugin Name: My Quote
		Plugin URI: http://xhanch.com/wp-plugin-my-quote/
		Description: Random Quote plugin for wordpress
		Author: Susanto BSc (xhanch)
		Author URI: http://xhanch.com
		Version: 1.1.0
	*/

	function my_quote_install () {
		require_once(dirname(__FILE__).'/installer.php');
	}
	register_activation_hook(__FILE__,'my_quote_install');
		
	require_once(dirname(__FILE__).'/my_quote.function.php');	

	//Widget
	
	function widget_my_quote($args) {
		extract($args);

		$quote = my_quote_get_quote();
		if(trim($quote) == '') 
			return;		
		echo $before_widget;
?>
		<?php 
			if (get_option("my_quote_title")!='')
				echo $before_title.get_option("my_quote_title").$after_title;				
		?>
		<div id="xhanch_my_quote">			
			<?php echo $quote; ?>
			<?php if (get_option("my_quote_credit")){ ?>
				<div style="text-align:right"><a href="http://xhanch.com/wp-plugin-my-quote/" rel="section" title="My Quote - A free WordPress plugin to display a random quote" style="text-decoration:none;font-size:10px">My Quote</a>, <a href="http://xhanch.com/" rel="section" title="Developed by Xhanch Studio" style="text-decoration:none;font-size:10px">by Xhanch</a></div>
			<?php }?>
		</div>
<?php		
		echo $after_widget;
	}

	function my_quote_control(){	
		$title = get_option('my_quote_title');
		$credit = get_option('my_quote_credit');

		if ($_POST['my_quote_submit']){
			update_option("my_quote_title", htmlspecialchars($_POST['my_quote_title']));
			update_option("my_quote_credit", intval($_POST['my_quote_credit']));
		}
?>
		<table>
			<tr>
				<td width="150"><label for="my_quote_title">Title</label></td>
				<td><input type="text" id="my_quote_title" name="my_quote_title" value="<?php echo $title; ?>" /></td>
			</tr>
			<tr>
				<td><label for="my_quote_credit">Display Credit</label></td>
				<td><input type="checkbox" id="my_quote_credit" name="my_quote_credit" value="1" <?php echo ($credit?'checked="checked"':''); ?>/></td>
			</tr>
		</table>
		<input type="hidden" id="my_quote_submit" name="my_quote_submit" value="1" />
<?php
	}

	function widget_my_quote_init(){
		register_sidebar_widget('My Quote', 'widget_my_quote');
		register_widget_control('My Quote', 'my_quote_control', 300, 200 );     
	}
	add_action("plugins_loaded", "widget_my_quote_init");
?>