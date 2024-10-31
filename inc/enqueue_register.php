<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function oswald_enqueue_register(){
	$pluginPath = implode('/', array_slice(explode('/', plugin_dir_url(__FILE__)), 0, -2)) . '/libs/';

	wp_register_script('owl-js', $pluginPath . 'owl/owl.carousel.min.js', array('jquery'), '2.1.6', true);
	wp_register_style('owl-style', $pluginPath . 'owl/owl.carousel.min.css', array(), '2.1.6');
	wp_register_style('owl-theme', $pluginPath . 'owl/owl.theme.default.min.css', array(), '2.1.6');
	wp_register_script('lazy-load', $pluginPath . 'lazyLoad.js', array('jquery'), '1.9.3');

	wp_register_style('font-awesome', $pluginPath . 'font-awesome/css/font-awesome.min.css', array(), '4.6.3');
}
add_action('wp_enqueue_scripts', 'oswald_enqueue_register');