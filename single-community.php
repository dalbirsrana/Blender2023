<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package blender2023
 */
get_header();

//ACF Fields
$contact_info = get_field('contact_info');
$property_pictures = get_field('gallery');
?>
	<main id="primary" class="site-main page-community">

        <div class="container">
            <div class="breadcrumb"><a href="/communities/"><i class="fa fa-chevron-left"></i> <span>View all communities</span></a></div>
        </div>

        <?php
            $total_pictures = has_post_thumbnail() ? count(array_filter($property_pictures)) + 1 : count(array_filter($property_pictures));
        ?>

        <div class="slider-wrap">
            <div id="property_pictures_counter" class="slide-counter"><span class="cur-slide">1</span> / <?php echo $total_pictures; ?></div>
            <div id="slider_property_pictures">
                <?php the_post_thumbnail( 'medium', array( 'class' => 'featured-image' ) ); ?>
                <?php
                    foreach ($property_pictures as $field => $image) {
                        echo wp_get_attachment_image( $image, 'medium', "", array( "class" => $field ) );
                    }
                ?>
            </div>
        </div>

		<header class="entry-header">
			<div class="container hold">
                <div class="title-content">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <div class="contact">
                        <span class="address"><i class="fas fa-external-link-square-alt"></i>
                            <a href="#">
                                <?php echo $contact_info['street'].', '.$contact_info['city'].', '.$contact_info['province']['label']; ?>
                            </a>
                        </span>
                        <span class="phone"><i class="fas fa-phone-alt"></i>
                            <a href="tel:<?php echo $contact_info['phone']; ?>">
                                <?php echo $contact_info['phone']; ?>
                            </a>
                        </span>
                    </div>
                    <div class="inquire">
                        <a href="mailto:<?php echo $contact_info['contact_person_email']; ?>" class="button mailto"><i class="fas fa-envelope"></i> Inquire</a>
                    </div>
                </div>

                
                <div id="gallery_wrap" class="property-pictures <?php if ( $total_pictures > 4 ) {echo 'gallery';} else {echo 'single';} ?>">

                <?php 
                    if ( has_post_thumbnail() ) {
                        echo '<a data-fancybox="gallery" href="'. esc_url( get_the_post_thumbnail_url() ) .'">';
                        the_post_thumbnail( 'medium', array( 'class' => 'featured-image' ) );
                        echo '</a>';
                    }
                 ?>

                <?php
                    foreach ($property_pictures as $field => $image) {
                        if ( !empty($image) ) {
                            printf(
                                '<a data-fancybox="gallery" href="%2$s">%1$s</a>', 
                                wp_get_attachment_image( $image, 'medium', "", array( "class" => $field ) ), 
                                wp_get_attachment_url( $image )
                            );
                        }
                    }
                ?>
                </div>
                
			</div>
		</header><!-- .page-header -->


		<section class="property-intro">
            <div class="container">
			    <?php
                    while ( have_posts() ) : 
                    the_post();
                ?>
                    <div class="entry-content">
                        <?php
                            the_content(
                                sprintf(
                                    wp_kses(
                                        /* translators: %s: Name of current post. Only visible to screen readers */
                                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blender2023' ),
                                        array(
                                            'span' => array(
                                                'class' => array(),
                                            ),
                                        )
                                    ),
                                    wp_kses_post( get_the_title() )
                                )
                            );
                        ?>
                    </div><!-- .entry-content -->
                <?php
				endwhile; // End of the loop.
				?>
			</div>
		</section>




        <?php $what_to_expect = get_field('what_to_expect'); ?>
        <?php if ( $what_to_expect ) : ?>
            <section class="what-to-expect">
                <div class="container">
                    <?php echo $what_to_expect; ?>
                </div>
            </section>
        <?php endif; ?>





	</main><!-- #main -->

<?php
get_footer();
