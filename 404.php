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

	<main id="primary" class="site-main inner-page">
		<header class="hero">
			<div class="background">
				<img src="<?php  echo esc_url( get_stylesheet_directory_uri() );  ?>/images/intro_banner_lg.jpg" alt="banner 404">
			</div>
			<div class="container">
				<h1 class="page-title"><?php esc_html_e( '404 error!', 'carbonneutral' ); ?></h1>
			</div>
		</header><!-- .page-header -->

		<section class="error-404 not-found">
			<div class="container page-content">
				<h4><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'carbonneutral' ); ?></h4>
				<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'carbonneutral' ); ?></p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

		<aside class="latest-posts">
			<div class="container">
				<div class="press">
					<header>
						<h4 class="title">Press Releases</h4>
					</header>
					<div class="row">
					<?php
						$args = array( 'cat' => 4, 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date', 'showposts' => 4 );
						$press = new WP_Query( $args );
						if( $press->have_posts() ) :
							while( $press->have_posts() ): $press->the_post();
								printf(	'<article class="col-sm-6 col-xl-3"><time>%1$s</time><h6 class="title"><a href="%2$s">%3$s</a></h6></article>',	get_the_date(), get_permalink(), get_the_title(),);
							endwhile;
						wp_reset_postdata();
						else :
							printf( '<div class="col-12"><h6>No Post Found</h6></div>' );
						endif;
					?>
					</div>
				</div>

			</div>
		</aside>



	</main><!-- #main -->

<?php
get_footer();
