<?php

function enqueue_styles() {
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap');
	wp_enqueue_style( 'nth-child-style', get_stylesheet_uri(), 'bootstrap');
}

add_action( 'wp_enqueue_scripts', 'enqueue_styles' );

?>