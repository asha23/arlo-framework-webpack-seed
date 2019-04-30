<?php

add_action( 'after_setup_theme', 'seed_ahoy', 16 );

function seed_ahoy() {
    // launching operation header cleanup
    add_action( 'init', 'seed_head_cleanup' );
    add_filter( 'the_generator', 'seed_rss_version' );
    add_filter( 'wp_head', 'seed_remove_wp_widget_recent_comments_style', 1 );
    add_action( 'wp_head', 'seed_remove_recent_comments_style', 1 );
    add_filter( 'gallery_style', 'seed_gallery_style' );
    add_filter( 'widget_text', 'do_shortcode');
    seed_theme_support();
    add_filter('body_class', 'theme_body_class');
    add_filter( 'the_content', 'seed_filter_ptags_on_images' );
    add_filter( 'excerpt_more', 'seed_excerpt_more' );
    add_action('admin_menu', 'remove_admin_menus');
}


function seed_head_cleanup() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	add_filter( 'style_loader_src', 'seed_remove_wp_ver_css_js', 9999 );
	add_filter( 'script_loader_src', 'seed_remove_wp_ver_css_js', 9999 );
}

function seed_rss_version() {
	return '';
}

function seed_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

function seed_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

function seed_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

function seed_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

function seed_theme_support() {

	// wp thumbnails
	add_theme_support( 'post-thumbnails' );

	// Custom thumbnail sizes (add as many as you like) - Or use a plugin. It's easier.

	// add_image_size( 'general-thumb-600', 600, 150, true );
	// add_image_size( 'general-thumb-300', 300, 100, true );

	// wp custom background

	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',  // background image default
	    'default-color' => '', // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus

	// register_nav_menus(
	// 	array(
	// 		'top-menu' => __( 'Top Menu', 'SEEDtheme' ),   // main nav in header
	// 		'footer-links' => __( 'Footer Links', 'SEEDtheme' ) // secondary nav in footer
	// 	)
	// );
}

//==============================================================================
// ASSORTED RANDOM CLEANUP ITEMS
//==============================================================================

function seed_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link and adds a swanky Bootstrap button and icon

function seed_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read', 'SEEDtheme' ) . get_the_title($post->ID).'">'. __( '<p>&nbsp;</p><button class="btn btn-info">Read more <i class="fa fa-angle-double-right"></i></button>', 'SEEDtheme' ) .'</a>';
}

function crunchify_remove_version() {
	return '';
}
add_filter('the_generator', 'crunchify_remove_version');
 
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
 
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );
 
//Disable gutenberg style in Front
function remove_block_css(){
	wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );	

//==============================================================================
// ADD BODY CLASSES
//==============================================================================

function theme_body_class($classes) {
	global $post;
	if (!$post) return $classes;
	$classes[] = 'page-'.$post->post_name;
	if ($post->post_parent) {
		$ppost = get_post($post->post_parent);
		$classes[] = 'section-'.$ppost->post_name;
	}
	return $classes;
}

//==============================================================================
// REMOVE TOP LEVEL ADMIN PAGES FROM SIDE MENU
//==============================================================================

function remove_admin_menus() {
    // remove_menu_page( 'edit.php' ); // posts
    remove_menu_page( 'edit-comments.php' ); // comments
    // remove_menu_page( 'edit.php?post_type=page' ); // pages
}

//==============================================================================
// REMOVE TOP LEVEL ADMIN PAGES FROM NAV BAR
//==============================================================================

function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');

//==============================================================================
// CUSTOMISE TITLE TAG
//==============================================================================

add_filter( 'wp_title', 'rw_title', 10, 3 );
function rw_title( $title, $sep, $seplocation ) {
    global $page, $paged;

    // Don't affect in feeds.

    if ( is_feed() )
            return $title;

    // Add the blog name

    if ( 'right' == $seplocation )
            $title .= get_bloginfo( 'name' );
    else
            $title = get_bloginfo( 'name' ) . $title;

    // Add the blog description for the home/front page.

    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
            $title .= " {$sep} {$site_description}";

    // Add a page number if necessary:

    if ( $paged >= 2 || $page >= 2 )
            $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
            return $title;
}

//==============================================================================
// DASHBOARD WIDGET OVERRIDES
//==============================================================================

function remove_dashboard_meta() {
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}
add_action( 'admin_init', 'remove_dashboard_meta' );

//==============================================================================
// REMOVE SOME USELESS MENU ITEMS UNDER Appearance
//==============================================================================

function remove_menu_items(){
	global $submenu;
	unset($submenu['themes.php'][6]); // remove customize link
}
add_action( 'admin_menu', 'remove_menu_items');
function remove_background_menu_item() {
	remove_theme_support( 'custom-background' );
}
add_action( 'after_setup_theme','remove_background_menu_item', 100 );

//==============================================================================
// CUSTOM ADMIN LOGIN LOGO
//==============================================================================

function custom_login_logo() {
	echo '<style type="text/css">h1 a { background-image: url('.get_bloginfo('template_directory').'/build/images/custom-login-logo.png) !important; height:82px!important; background-size:164px!important; width:200px!important;}</style>';
}
add_action('login_head', 'custom_login_logo');

add_filter('acf/settings/remove_wp_meta_box', '__return_true');


//show_admin_bar( true );

// ADMIN STYLES

add_action('admin_head', 'custom_admin_style');

function custom_admin_style() {
  echo '<style>
  #edittag {
	  width:100%!important;
	  max-width:100%!important;
  }
  </style>';
}

// IMAGE SIZES

add_image_size( 'main-teaser', 600, 380, false );
add_image_size( 'main-teaser-news', 635, 428, false );

// REMOVE PREFIX FROM ARCHIVE TITLE

function my_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
 
add_filter( 'get_the_archive_title', 'my_theme_archive_title' );



function rudr_filter_by_the_author() {
	$params = array(
		'name' => 'author', // this is the "name" attribute for filter <select>
		'show_option_all' => 'All authors' // label for all authors (display posts without filter)
	);
 
	if ( isset($_GET['user']) )
		$params['selected'] = $_GET['user']; // choose selected user by $_GET variable
 
	wp_dropdown_users( $params ); // print the ready author list
}
 
add_action('restrict_manage_posts', 'rudr_filter_by_the_author');



function getFirstPara($string){
    $string = substr($string,0, strpos($string, "</p>")+4);
    $string = str_replace("<p>", "", str_replace("<p/>", "", $string));
    return $string;
}

function limit_text($text, $limit) {
	if (str_word_count($text, 0) > $limit) {
		$words = str_word_count($text, 2);
		$pos = array_keys($words);
		$text = substr($text, 0, $pos[$limit]) . '...';
	}
	return $text;
}

