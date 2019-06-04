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
<?php


if(is_user_logged_in()){
?>
    <?php wp_nav_menu( array( 'theme_location' => 'page-members-menu',
                        'menu_class'=> 'page-members-menu' ) ); ?>
                        
</div>

<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
               <div class="title-section">
                    <h1><?php 
                    if(is_page('members-page') == false ){
                       the_title();
                       ?><hr><?php
                    }
                    ;?></h1>
               </div>
               

				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
		
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
    </div><!-- #primary -->
    <?php
}else{
  
    // $default_attributes = array( 'show_title' => false );
    // $attributes = shortcode_atts( $default_attributes, $attributes );
		// render_login_form($attributes, $content = null);
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="entry-content">
					<?php echo do_shortcode('[custom_login_form]'); ?>
				</div>
			</main><!-- #main -->
		</div><!-- #primary -->
<?php
}
get_footer();