<?php
/**
 *Template Name: Members Template 
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Virginia_Society_of_Landscape_Designers
 */

get_header();
?>
<div class="nav-container">

<?php wp_nav_menu( array( 'theme_location' => 'page-members-menu',
                        'menu_class'=> 'page-members-menu' ) ); ?>
                        
</div>

<?php get_footer();