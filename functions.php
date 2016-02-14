<?php

function nth_enqueue_styles() {
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap');
	wp_enqueue_style( 'nth-child-style', get_stylesheet_uri(), 'bootstrap');
}

add_action( 'wp_enqueue_scripts', 'nth_enqueue_styles' );

//This theme uses wp_nav_nemu() in one location
function nth_register_menu() {
	register_nav_menu('main', 'Main menu');
}
add_action( 'after_setup_theme', 'nth_register_menu');

function nth_get_menu() {
	wp_nav_menu( array(
        'menu'              => 'main',
        'theme_location'    => 'main',
        'depth'             => 1,
        'container'         => 'div',
        'container_class'   => 'collapse navbar-collapse',
        'container_id'		=> 'myNavbar',
        'menu_class'        => 'nav navbar-nav'
    ));
}

?>