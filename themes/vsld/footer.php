<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Virginia_Society_of_Landscape_Designers
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'footer' ) ) : ?>
			<div id="upper-footer" class="upper-footer widget-area" role="complementary" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/footer-bg.png);">
				<div class="wrapper">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			</div><!-- #upper-footer -->
		<?php endif; ?>
		<div class="site-info">
			<div class="wrapper">
				<div>
					<span>&copy; <?php echo date("Y"); ?> VSLD.</span>
					<span>All Rights Are Reserved.</span>
				</div>
				<div>
					<span>WEBSITE DESIGNED BY <a href="https://spectrumnetdesigns.com">SPECTRUM NET DESIGNS</a></span>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
