<?php

/*

	Plugin Name: Custom Plugin For Elementor
	Description: Add Custom block in Elementor.
	Author: Aryan Maurya
	Author URI: http://www.aryanmaurya.com/
	Version: 1.0.0

*/

namespace CUSTOM;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('elementor/widgets/widgets_registered', function(){
	require_once('widget.php');

	$custom_block = new Custom_block_Widget();

	Plugin::instance()->widgets_manager->register_widget_type($custom_block);
});

?>