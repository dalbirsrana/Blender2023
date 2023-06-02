<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package blender2023
 */

get_header();
?>

	<main id="primary" class="site-main">
		<header class="page-header">
			<div class="background">
				<img src="<?php  echo esc_url( get_stylesheet_directory_uri() );  ?>/graphics/default-image.jpg" alt="banner 404">
			</div>
			<div class="container">
				<h1 class="page-title"><?php esc_html_e( '404 error!', 'blender2023' ); ?></h1>
			</div>
		</header><!-- .page-header -->

		<section class="error-404 not-found">
			<div class="container page-content">
				<h4><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'blender2023' ); ?></h4>
				<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'blender2023' ); ?></p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

		<?php
			get_template_part( 'template-parts/content', 'latest-news' );
		?>

	</main><!-- #main -->

<?php
get_footer();
