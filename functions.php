<?php

add_theme_support( 'post-thumbnails' );

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

//Below are the widget areas
function nth_initialize_widgets(){

    register_sidebar (array(
        'name' => __('Footer Widget Area 1', 'nth-child'),
        'id' => 'footer1', 
        'description' => __('Appears in the footer section of the site. Takes up the full width of the footer area. If Footer Widget Area 2 is being used, both areas will take up half of the footer each. On smaller screens, if both footers are active, Footer Widget Area 1 will stack on top of Footer Widget Area 2.', 'nth-child'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
        )
    );
    
    register_sidebar (array(
        'name' => __('Footer Widget Area 2', 'nth-child'),
        'id' => 'footer2', 
        'description' => __('Appears in the footer section of the site. If Footer Widget Area 2 is being used, it will split the footer area with Footer Widget Area 1. On smaller screens, if both footers are active, Footer Widget Area 1 will stack on top of Footer Widget Area 2. NOTE: This widget area will only show if Footer Widget Area 1 is active.', 'nth-child'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
        )
    );

    register_sidebar (array(
        'name' => __('Sidebar Widget Area', 'nth-child'),
        'id' => 'blog-sidebar',
        'description' => __('The theme sidebar. Sits to the right of the main content area on large screens (limited to 300px in this case). Moves under the main content area on smaller screens (will dynamically resize in this case).', 'nth-child'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
        )
    );
}
add_action('widgets_init', 'nth_initialize_widgets');

function get_footer_widgets() {
    if (is_active_sidebar( 'footer1' )) {
        echo '<div class="footer-widget-area">';
        echo '<div class="container"> <!-- footer content container -->';
        echo '<div class="row footer-widgets"> <!-- footer widget row -->';

        if (is_active_sidebar( 'footer2' )) {
            
            echo '<div class="col-sm-6">';
                dynamic_sidebar( 'footer1' );
            echo '</div>';

            echo '<div class="col-sm-6">';
                dynamic_sidebar( 'footer2' );
            echo '</div>';
        
        }
        else {

            echo '<div class="col-md-12">';
                dynamic_sidebar( 'footer1' );
            echo '</div>';

        }

        echo '</div> <!-- footer widget row -->';
        echo '</div> <!-- footer widget container -->';
        echo '</div> <!-- footer widget area -->';

    }              
}

function get_featured_image_caption() {
    if (has_post_thumbnail()) {
        $featured_image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
    }

    if ($featured_image_caption != "") {
        echo '<span class="feat-caption">' . $featured_image_caption . '</span>';
    }
}

function get_site_title() {
    if (is_home()) {
        echo '<h1 class="navbar-brand"><a href="' . get_bloginfo('url') . '" title="' . get_bloginfo('name') . '">' . get_bloginfo('name') . '</a></h1>';
    }
    else {
        echo '<div class="navbar-brand"><a href="' . get_bloginfo('url') . '" title="' . get_bloginfo('name') . '">' . get_bloginfo('name') . '</a></div>';
    }
}

?>