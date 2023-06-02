<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package blender2023
 */

get_header();

$categories = get_the_category();
if ( ! empty( $categories ) ) {
	// get the current taxonomy term
	$term = 'term_' . $categories[0]->term_id;
	// vars
	$hero_image = get_field('background_image', $term);
}

?>
	<main id="primary" class="site-main two-column">

		<header class="page-header">
			<?php
				if ( ! empty( $categories ) ) {
					echo '<div class="mobile-back-link"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><i class="fa fa-chevron-left"></i></a></div>';
				}
			?>
			<div class="background">
                <img src="<?php echo $hero_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" >
            </div>
			<div class="container hidden">
                <h1 class="page-title"><?php echo esc_html( $categories[0]->name ); ?></h1>
			</div>
		</header><!-- .page-header -->


		<div class="layout-col-2 container">
			<div class="row">
				<aside class="col-lg-3 side-bar">
					<?php
						if ( ! empty( $categories ) ) {
							$category_name = $categories[0]->slug == 'news' ? 'All News' :  $categories[0]->name;
							echo '<a class="link-parent-cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><i class="fa fa-chevron-left"></i> <span>' . esc_html( $category_name ) . '</span></a>';
						}
					?>
				</aside>
				<div class="col-12 col-lg-9 main-content post-content">
					<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'single' );

						endwhile; // End of the loop.
					?>
				</div>
			</div>
		</div>

		<footer>
			<?php
				get_template_part( 'template-parts/content', 'latest-news' );
			?>
    	</footer>

	</main><!-- #main -->

<?php
get_footer();
