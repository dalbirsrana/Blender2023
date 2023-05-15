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

        <div class="slider-wrap">
            <div id="property_pictures_counter"><span class="cur-slide">1</span>/<?php echo count(array_filter($property_pictures)); ?></div>
            <div id="slider_property_pictures">
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
                        <span class="address"><?php echo $contact_info['street'].', '.$contact_info['city'].', '.$contact_info['province']['label']; ?></span>
                        <span class="phone"><?php echo $contact_info['phone']; ?></span>
                    </div>
                    <div class="inquire">
                        <a href="mailto:<?php echo $contact_info['contact_person_email']; ?>" class="button inquire">Inquire</a>
                    </div>
                </div>

                
                <div id="gallery_wrap" class="property-pictures <?php if ( count(array_filter($property_pictures)) > 4 ) {echo 'gallery';} else {echo 'single';} ?>">
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
