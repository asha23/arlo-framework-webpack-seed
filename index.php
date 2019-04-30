<?php

get_header(); 

if(!isset($archive_type)) {
	$archive_type = "index";
}

$page_id = get_option( 'page_for_posts' );
$page_title = "";
$this_is_blog_index = "";
$post_page = get_option( 'show_on_front' ) == 'page' ? get_permalink( get_option('page_for_posts' ) ) : bloginfo('url');

$post = $posts[0];// Hack. Set $post so that the_date() works
if($this_is_blog_index == "search") {
	$page_id = "blogsearch" . preg_replace("/[^A-z0-9]/", "", $_GET['s']);
	$page_title = "Searching for &#39;" . htmlspecialchars($_GET['s']) . "&#39;";
} else if(is_category()) {
	$page_id = "blogcat" . get_query_var('cat');
	$page_title = single_cat_title('', false);
} else if(is_tag()) {
	$page_id = "blogtag" . get_query_var('tag_id');
	$page_title = single_tag_title('', false);
} else if(is_day()) {
	$page_id = "blogdate" . get_the_time('jmY');
	$page_title = "Archive for " . get_the_time('F jS, Y');
} else if(is_month()) {
	$page_id = "blogdate" . get_the_time('mY');
	$page_title = "Archive for " . get_the_time('F, Y');
} else if(is_year()) {
	$page_id = "blogdate" . get_the_time('Y');
	$page_title = "Archive for " . get_the_time('Y');
} else if(is_author()) {
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$page_id = "blogauthor" . $author->ID;
	$page_title = "Author Archive";
} else if(isset($_GET['paged']) && !empty($_GET['paged'])) {
	$page_id = "blogarchive";
	$page_title = "Blog Archives";
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$page_id .= "_$paged";

$newer = "";
$link = get_previous_posts_link( __( 'Newer &gt;' ) );
preg_match("/href=\"([^\"]+)\"/i", $link, $match);
if(sizeof($match)) {
	$newer = $match[1];
}
?>


	
				<?php
				include( locate_template( 'views/loops/loop-news-teasers.php', false, false ) );
				?>
	


<?php get_footer(); ?>



