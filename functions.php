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
        'container'         => 'ul',
        'menu_class'        => 'nav navbar-nav'
    ));
}

function nth_allow_tags_in_excerpt() {
    // Add custom tags to this string
    return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>,<code>,<pre>,<blockquote>'; 
}

function nth_customize_excerpt($nth_excerpt) {
    global $post;
    $raw_excerpt = $nth_excerpt;

    if ( '' == $nth_excerpt ) {

        $nth_excerpt = get_the_content('');
        $nth_excerpt = strip_shortcodes( $nth_excerpt );
        $nth_excerpt = apply_filters('the_content', $nth_excerpt);
        $nth_excerpt = str_replace(']]>', ']]&gt;', $nth_excerpt);

        // To allow certain tags only. Delete if all tags are allowed
        $nth_excerpt = strip_tags($nth_excerpt, nth_allow_tags_in_excerpt()); 

        // Set the excerpt word count and only break after sentence is complete.
        $excerpt_word_count = 40;
        $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
        $tokens = array();
        $excerptOutput = '';
        $count = 0;

        // Divide the string into tokens; HTML tags, or words, followed by any whitespace
        preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $nth_excerpt, $tokens);

        foreach ($tokens[0] as $token) { 

            if ($count >= $excerpt_word_count && preg_match('/[\?\.\!]\s*$/uS', $token)) { 
                // Limit reached, continue until "." occurs at the end
                $excerptOutput .= trim($token);
                break;
            }

            // Add words to complete sentence
            $count++;

            // Append what's left of the token
            $excerptOutput .= $token;
        }

        $nth_excerpt = trim(force_balance_tags($excerptOutput));
        
        $excerpt_end = '<a  class="read-more" 
                            alt="' . get_the_title() . '" 
                            href="'. esc_url( get_permalink() ) . '"
                        >'
                        . sprintf(__( 'Read more >>' ), get_the_title()) 
                        . '</a>'; 
        $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 
            
        $nth_excerpt .= $excerpt_end; /*Add read more in new paragraph */

        return $nth_excerpt;   
    }

    return apply_filters('nth_customize_excerpt', $nth_excerpt, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'nth_customize_excerpt');

function nth_get_the_archives_link() {
    if(get_page_by_title('Archives')) {
        $page = get_page_by_title('Archives');
        $id = $page->ID;
        echo '<li><a href="' . get_page_link($id) . '" alt="' . get_the_title( $page ) .'">Browse the archives</a></li>';
    }
}

?>