<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Virginia_Society_of_Landscape_Designers
 */

get_header();
?>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="blog-listing">
				<?php while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
					the_post_navigation();
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile; // End of the loop. ?>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div>
<?php get_footer();
