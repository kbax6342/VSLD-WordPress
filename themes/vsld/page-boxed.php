<?php
/**
 * Template Name: Boxed Page
 * The template for displaying boxed pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Virginia_Society_of_Landscape_Designers
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="wrapper">
				<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
				
				<?php // If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile; // End of the loop. ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
