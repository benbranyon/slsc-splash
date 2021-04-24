<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */
get_header();

?>
	<!--<?php the_post_thumbnail();;?>-->
	<div
	class="site-palette-yin-2-color site-palette-yang-1-background-color height-100vh width-100vw"
	data-layout="column"
	data-layout-align="center center">

		<div class="typo-size-xxxxlarge font-weight-200">
			<span class="text-shadow-1 typo-size-xxxxlarge">404</span>
		</div>
		<div class="padding-top-20 typo-size-xxxlarge font-weight-200">
			<?php esc_html_e('Page not found.', 'narratium');?>
		</div>

		<div class="padding-top-40 typo-size-small font-weight-400">
			<a href="<?php echo esc_url(home_url("/"));?>">
				<i class="material-icons">call_missed</i> <?php echo sprintf(esc_html__('Go back to %s.', 'narratium'), get_bloginfo('name'));?>
			</a>
		</div>
	</div>



<?php
wp_link_pages(  );
get_footer();
