<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$oo = get_option('oswald_options');

function oswald_enqueue(){
	global $oo;
	if(isset($oo)):
		if($oo['owl_js'])
			wp_enqueue_script('owl-js');

		if($oo['owl_css']){
			wp_enqueue_style('owl-style');
			wp_enqueue_style('owl-theme');
		}

		if($oo['fa'])
			wp_enqueue_style('font-awesome');

		if($oo['lazyLoad'])
			wp_enqueue_script('lazy-load');
	endif;

}
add_action('wp_enqueue_scripts','oswald_enqueue');

function oswald_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

if($oo['emoji'])
	add_action('init', 'oswald_disable_emojis');