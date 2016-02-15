<?php

/* THEME SETUP */
function nth_enqueue_styles() {
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/css/bootstrap.min.css');
    wp_enqueue_style( 'bootstrap');
    wp_enqueue_style( 'nth-child-style', get_stylesheet_uri(), 'bootstrap');
}
add_action( 'wp_enqueue_scripts', 'nth_enqueue_styles' );

function nth_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'excerpt-thumb', 1000, 200, true );
    add_image_size( 'post-image', 800, 800, false );
    register_nav_menu('main', 'Main menu'); // This theme uses wp_nav_menu() in one location
}
add_action( 'after_setup_theme', 'nth_theme_setup');

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

function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'excerpt-thumb' => __('Excerpt Thumb'),
        'post-image' => __('Post Image')
    ) );
}
add_filter( 'image_size_names_choose', 'my_custom_sizes' );



/* HELPER METHODS */
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
    return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<video>,<audio>,<code>,<pre>,<blockquote>,<strong>'; 
}

function nth_get_the_archives_link() {
    if(get_page_by_title('Archives')) {
        $page = get_page_by_title('Archives');
        $id = $page->ID;
        echo '<li><a href="' . get_page_link($id) . '" alt="' . get_the_title( $page ) .'">Browse the archives</a></li>';
    }
}

function nth_get_footer_widgets() {
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

function nth_get_featured_image_caption() {
    if (has_post_thumbnail()) {
        $featured_image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
    }

    if ($featured_image_caption != "") {
        echo '<span class="feat-caption">' . $featured_image_caption . '</span>';
    }
}

function nth_get_site_title() {
    if (is_home()) {
        echo '<h1 class="navbar-brand"><a href="' . get_bloginfo('url') . '" title="' . get_bloginfo('name') . '">' . get_bloginfo('name') . '</a></h1>';
    }
    else {
        echo '<div class="navbar-brand"><a href="' . get_bloginfo('url') . '" title="' . get_bloginfo('name') . '">' . get_bloginfo('name') . '</a></div>';
    }
}

function nth_get_post_title() {

    // h2 for home and archive
    if (is_home() || is_archive()) {
        echo '<h2>';
            if (is_sticky()) {
                echo 'Featured: ';
            }
            
            echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
        echo '</h2>';
    }
    else {
        echo '<h1>';
            if (is_sticky()) {
                echo 'Featured: ';
            }
            
            echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
        echo '</h1>';

    }
}

function nth_get_featured_image() {
    if(is_single() || is_page()) {
        the_post_thumbnail();
        nth_get_featured_image_caption();
    }
    else {
        the_post_thumbnail('excerpt-thumb');
    }
}

function nth_get_the_date() {

    $html_datetime = get_the_date( 'Y-m-d' );
    $ui_date = get_the_date( 'D, M j Y' );
    $anchor_title_date = get_the_date( 'M Y' );
    $post_year  = get_the_time('Y');
    $post_month = get_the_time('m');
            
    echo 'Posted on <time datetime="'. $html_datetime . '">';
    echo '<a href="' . get_month_link( $post_year, $post_month ) . '" title="See all posts from ' . $anchor_title_date  . '">' . trim($ui_date) . '</a>';
    echo '</time>';
}

function nth_get_the_category() {

    $categories = get_the_category();
    $separator = ', ';
    $output = 'in ';

    if($categories){
 
        foreach($categories as $category) {
            $output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in \"%s\"" ), $category->name ) ) . '"><span class="nth-category">'.$category->cat_name.'</span></a>'.$separator;
        }
 
        echo trim($output, $separator);

    }
}
?>