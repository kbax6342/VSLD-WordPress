<?php
/**
 * The main template file
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

<div class="wrapper">
  <div id="primary" class="content-area">
    <main id="main" class="site-main blog-main">
      <section class="blog-listing">
        <?php if ( have_posts() ) :
          /* Start the Loop */
          while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-tile'); ?>>
              <?php vsld_post_thumbnail(); ?>
              <div class="entry-content">
                <?php the_title( '<h3>', '</h3>' ); ?>
                <?php the_excerpt(); ?>
                <a href="<?php echo get_page_uri(); ?>" class="btn btn-primary">Read more</a>
              </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->
          <?php endwhile;
          the_posts_navigation();
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif; ?>
      </section>
      <aside class="blog-sidebar-area">
        <?php if ( is_active_sidebar( 'blog-sidebar' ) ) :
          dynamic_sidebar( 'blog-sidebar' );
        endif; ?>
      </aside>
    </main><!-- #main -->
  </div><!-- #primary -->
  <?php get_sidebar(); ?>
</div>
<?php get_footer();
