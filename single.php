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
	$hero_image = get_field('bg_image', $term);
}

?>
	<main id="primary" class="site-main inner-page">

		<header class="hero">
			<div class="background">
                <img src="<?php echo $hero_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" >
            </div>
			<div class="container hidden">
                <h1 class="page-title"><?php echo esc_html( $categories[0]->name ); ?></h1>
			</div>
		</header><!-- .page-header -->

		<section class="single-post">
            <div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'single' );

				endwhile; // End of the loop.
				?>
			</div>
		</section>

	</main><!-- #main -->

<?php
get_footer();
