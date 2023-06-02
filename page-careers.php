<?php
/**
 * Template Name: Careers
 * The template for displaying Careers Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */
get_header();
?>
	<main id="primary" class="site-main page-careers">
        <header class="page-header">
			<div class="background"><?php the_post_thumbnail(); ?></div>
			<div class="container">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</div>
        </header>

        <article class="hidden">
            <div class="container">
            <?php 
                /* Start the Loop */
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            ?>
            </div>
        </article>
       
        <?php if ( get_field('testimonials') ) : ?>
        <article class="testimonials">
            <div class="container">
                <div class="slider-wrap">
                    <div id="slider_testimonials" class="slider">
                        <?php the_field('testimonials'); ?>
                    </div>
                </div>
            </div>
        </article>
        <?php endif; ?>

        <?php if ( get_field('bursaries') ) : ?>
        <section class="bursaries">
            <div class="container">
                <div class="row row-reverse space-between">
                    <div class="col-12 col-md-6">
                        <figure class="wp-block-image">
                            <img src="<?php the_field('bursaries_image'); ?>" alt="Bursaries and education programs">
                        </figure>
                    </div>
                    <div class="col-12 col-md-6 col-xl-5">
                        <?php the_field('bursaries_text_content'); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>


        <?php if ( get_field('open_roles_cta') ) : ?>
        <section class="open-roles-cta">
            <div class="container">
                <div class="row space-between ">
                    <div class="col-12 col-md-6">
                        <figure class="wp-block-image">
                            <img src="<?php the_field('open_roles_cta_image'); ?>" alt="Open Roles CTA">
                        </figure>
                    </div>
                    <div class="col-12 col-md-6 col-xl-5 align-self-center text">
                        <?php the_field('open_roles_cta_text_content'); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>



	</main><!-- #main -->

<?php
get_footer();