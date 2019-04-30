<?php
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}


// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
	//var_dump($args);
	if ( isset( $args->sub_menu ) ) {
		
		$root_id = 0;
		// find the current menu item

		foreach ( $sorted_menu_items as $menu_item ) {
			// /var_dump($menu_item);
			if ( $menu_item->current ) {
				// set the root id based on whether the current menu item has a parent or not
				$root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;


				
				break;
			}
		}
		// find the top level parent
		if ( ! isset( $args->direct_parent ) ) {
			$prev_root_id = $root_id;

			while ( $prev_root_id != 0 ) {
				foreach ( $sorted_menu_items as $menu_item ) {
					if ( $menu_item->ID == $prev_root_id ) {
						$prev_root_id = $menu_item->menu_item_parent;
						// don't set the root_id to 0 if we've reached the top of the menu
						if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
						break;
					}
				}
			}
		}

		$menu_item_parents = array();
		
		foreach ( $sorted_menu_items as $key => $item ) {
			// init menu_item_parents
			if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;

				if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
					// part of sub-tree: keep!
					$menu_item_parents[] = $item->ID;
					
				} else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
					// not part of sub-tree: away with it!
					unset( $sorted_menu_items[$key] );
				
				}
			}
				//var_dump($sorted_menu_items);
				return $sorted_menu_items;
			} else {
				//var_dump($sorted_menu_items);
				return $sorted_menu_items;
		}
}




//==============================================================================
// MENUS & NAVIGATION
//==============================================================================


register_nav_menus(
	array(
		'top-menu' => __( 'Top Menu', 'SEEDtheme' ),   // main nav in header
		'footer-links' => __( 'Footer Menu', 'SEEDtheme' ), // secondary nav in footer
		'language-links' => __( 'Language Menu', 'SEEDtheme' ), // Languages nav
		'sub-nav' => __( 'Sub Nav', 'SEEDtheme' ), // Languages nav
		'homepage_blast_off' => __( 'Homepage Blast Off', 'SEEDtheme' ), // Languages nav
		'custom-work-menu' => __( 'Custom Work Sub Menu', 'SEEDtheme' ), // Languages nav
	)
);

// the main menu
function seed_main_nav_no_dropdown() {
	// display the wp3 menu if available - Suppress errors.
	if ( has_nav_menu( "top-menu" ) ) {
	    wp_nav_menu(array(
	    	'theme_location'  => 'top',
			'depth'	          => 1, // 1 = no dropdowns, 2 = with dropdowns.
			'container'       => '',
			'container_class' => 'collapse navbar-collapse',
			'container_id'    => 'main-nav-no-dropdown',
			'menu_class'      => 'navbar-nav nav-pad ',
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new WP_Bootstrap_Navwalker(),
		
		));
	};
}

function seed_main_nav() {
	// display the wp3 menu if available - Suppress errors.
	if ( has_nav_menu( "top-menu" ) ) {
	    wp_nav_menu(array(
	    	'theme_location'  => 'top-menu',
			'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
			'container'       => '',
			'container_class' => 'collapse navbar-collapse',
			'container_id'    => 'main-nav-collapser',
			'menu_class'      => 'navbar-nav nav-pad',
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new WP_Bootstrap_Navwalker(),
		
		));
	};
}



// the footer menu (should you choose to use one)
function seed_footer_links() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Footer Links', 'SEEDtheme' ),   	// nav name
    	'menu_class' => 'footer-nav clearfix',      // adding custom nav class
    	'theme_location' => 'footer-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'seed_footer_links_fallback', 	// fallback function
	));
}


function seed_language_links() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => '',                              // remove nav container
    	'container_class' => 'language-links',   // class of container (should you choose to use it)
    	'menu' => __( 'Language Links', 'SEEDtheme' ),   	// nav name
    	'menu_class' => 'nav-language clearfix',      // adding custom nav class
    	'theme_location' => 'language-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'seed_footer_links_fallback', 	// fallback function
	));
}

// this is the fallback for header menu
function seed_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => 'nav top-nav clearfix',      	// adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // before each link
        'link_after' => ''                             	// after each link
	) );
}