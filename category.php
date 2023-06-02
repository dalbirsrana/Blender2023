<?php
/**
 * The template for displaying Category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

get_header();

// get the current taxonomy term
$term = get_queried_object();
// vars
$hero_image = get_field('background_image', $term);
?>
	<main id="primary" class="site-main">
        
        <header class="page-header">
			<div class="background">
                <img src="<?php echo $hero_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" >
            </div>
			<div class="container">
                <?php single_term_title( '<h1 class="page-title">', '</h1>' ); ?>
			</div>
		</header><!-- .page-header -->


		<section class="posts">
            <div class="container">
                <div class="row">
                    <?php
                        if ( have_posts() ) :
                            /* Start the Loop */
                            while ( have_posts() ) : 
                                the_post();
                                get_template_part( 'template-parts/content', 'category' );
                            endwhile;
                        else : 
                            get_template_part( 'template-parts/content', 'none' );
                        endif;
                    ?>
                </div>
            </div>
        </section>

	</main><!-- #main -->

<?php
get_footer();
