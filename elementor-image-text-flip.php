<?php
/*
 * Plugin Name: Elementor Image Text Flip
 * Plugin URI: https://w4dev.com
 * Description: Custom widget for image text flip
 * Version: 5.0
 * Author: Shazzad Hossain Khan
 * Author URI: https://shazzad.me
*/


add_action( 'elementor/init', 'eitf_load');

function eitf_load() {
	// Here its safe to include our action class file
	add_action( 'elementor/widgets/widgets_registered', 'eitf_register_elementor_widgets' );
	add_action( 'elementor/frontend/after_register_scripts', 'eitf_widget_scripts' );
}

function eitf_widget_scripts() {
	wp_register_script( 'elementor-image-text-flip', plugins_url( 'frontend.js', __FILE__ ), ['jquery'] );
	wp_enqueue_script( 'elementor-image-text-flip' );
}

function eitf_register_elementor_widgets($widgets_manager) {
	include_once( dirname(__FILE__) . '/class-elementor-image-text-flip.php' );
	$widgets_manager->register_widget_type( new Elementor_Image_Text_Flip_Widget());
}
