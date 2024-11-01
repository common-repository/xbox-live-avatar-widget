<?php
/*
Plugin Name: XBOX Live Avatar
Description: Adds your XBOX Live Avatar to your sidebar.
Author: William Patton
Version: 0.9
Author URI: http://www.pattonwebz.com/xbox/xbox-live-avatar-wordpress-plugin
*/

function widget_xboxavatar_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_xboxavatar($args) {
		extract($args);
		$options = get_option('widget_xboxavatar');
		$title = $options['title'];
		$avatar = $options['avatar'];
		echo $before_widget . $before_title . $title . $after_title;
		echo '<br><iframe src="http://avatar.xboxlive.com/avatar/'.$avatar.'/avatar-body.png" scrolling="no" frameBorder="0" height="280" width="150">'.$avatar.'</iframe>';
		echo $after_widget;
	}

	function widget_xboxavatar_control() {

		$options = get_option('widget_xboxavatar');
		if ( !is_array($options) )
			$options = array('title'=>'XBOX Avatar', 'avatar'=>'Williampatton');
		if ( $_POST['xboxavatar-submit'] ) {
			$options['title'] = strip_tags(stripslashes($_POST['xboxavatar-title']));
			$options['avatar'] = strip_tags(stripslashes($_POST['xboxavatar-avatar']));
			update_option('widget_xboxavatar', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$avatar = htmlspecialchars($options['avatar'], ENT_QUOTES);
		echo '<p style="text-align:right;"><label for="xboxavatar-title">Title: <input style="width: 200px;" id="xboxavatar-title" name="xboxavatar-title" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:right;"><label for="xboxavatar-avatar">Avatar: <input style="width: 200px;" id="xboxavatar-avatar" name="xboxavatar-avatar" type="text" value="'.$avatar.'" /></label></p>';
		echo '<input type="hidden" id="xboxavatar-submit" name="xboxavatar-submit" value="1" />';
	}

	register_sidebar_widget('XBOX Avatar', 'widget_xboxavatar');
	register_widget_control('XBOX Avatar', 'widget_xboxavatar_control', 300, 100);

}
add_action('plugins_loaded', 'widget_xboxavatar_init');

?>