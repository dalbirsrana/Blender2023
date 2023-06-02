<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package blender2023
 */

get_header();
?>

	<main id="primary" class="site-main inner-page">

		<header class="page-header">
			<div class="background">
				<img src="<?php  echo esc_url( get_stylesheet_directory_uri() );  ?>/graphics/default-image.jpg" alt="banner search">
			</div>
			<div class="container">
				<h1 class="page-title"><?php esc_html_e( 'Search', 'blender2023' ); ?></h1>
			</div>
		</header><!-- .page-header -->

		<section>
			<div class="container">
			<?php if ( have_posts() ) : ?>
				<h4>
				<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'blender2023' ), '<span>' . get_search_query() . '</span>' );
				?>
				</h4>
			<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;
			else : get_template_part( 'template-parts/content', 'none' );
			endif;
			?>

			</div>
		</section>


	</main><!-- #main -->

<?php
get_footer();
