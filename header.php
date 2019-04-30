<!DOCTYPE html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>
      class="no-js">
<!--<![endif]-->

<?php get_template_part('views/global/main', 'head'); 

global $post;
//global $sub_menu;
$id = get_the_ID();


?>

<?php if(is_page('our-processes') || is_page('mission-control')): ?>
    <body <?php body_class(); ?> onLoad="init()">
<?php else: ?>
    <body <?php body_class(); ?>>
<?php endif; ?>

        <!-- <div class="loader-outer">
            <div class="loader-container">
                <span class="loader loader-quart-1"></span>
            </div>
        </div> -->



        <?php get_template_part( 'views/global/main', 'analytics' ); ?>

        <?php // Header ?>

        <?php get_template_part( 'views/global/main', 'header' ); ?>


<?php if(is_page('our-processes') || is_page('mission-control')): ?>
        <div class="wrap" id="page_holder">

<?php else: ?>
        <div class="wrap">
<?php endif; ?>