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
$google_map = get_field('google_map');
?>
	<main id="primary" class="site-main page-community">

        <div class="container">
            <div class="breadcrumb"><a href="/communities/"><i class="fa fa-chevron-left"></i> <span>View all communities</span></a></div>
        </div>

        <?php
            $total_pictures = has_post_thumbnail() ? count(array_filter($property_pictures)) + 1 : count(array_filter($property_pictures));
        ?>

        <!-- Slider on mobile Screen -->
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
                        <span class="address">
                        <?php if ($google_map): ?>
                            <i class="fas fa-external-link-square-alt"></i>
                            <a href="https://maps.google.com/?q=<?php echo esc_attr($google_map['location']['lat']); ?>,<?php echo esc_attr($google_map['location']['lng']); ?>" target="_blank">
                        <?php else: ?> 
                            <a href="#">
                        <?php endif; ?>
                            <?php echo $contact_info['street'].', '.$contact_info['city'].', '.$contact_info['province']['label']; ?>
                            </a>
                        </span>
                        <span class="phone"><i class="fas fa-phone-alt"></i>
                            <a href="tel:<?php echo esc_html($contact_info['phone']);?>">
                            <?php echo $contact_info['phone']; ?>
                            </a>
                        </span>
                    </div>
                    <?php if ( !empty($contact_info['contact_person_email']) ): ?>
                    <div class="inquire">
                        <a href="mailto:<?php echo esc_html($contact_info['contact_person_email']); ?>" class="button mailto"><i class="fas fa-envelope"></i> Inquire</a>
                    </div>
                    <?php endif; ?>
                </div>

                
                <div id="gallery_wrap" class="property-pictures <?php if ( $total_pictures > 4 ) {echo 'gallery';} else {echo 'single';} ?>">
                    <?php 
                    $button_show_all_photos = '<button class="button white"><i class="fas fa-th"></i> Show all photos</button>';
                    if ( has_post_thumbnail() ) {
                        echo '<a data-fancybox="gallery" href="'. esc_url( get_the_post_thumbnail_url() ) .'">';
                        the_post_thumbnail( 'medium', array( 'class' => 'featured-image' ) );
                        echo $button_show_all_photos . '</a>';
                        // Don't display show_all_photos button if already displayed on featured Image.
                        $button_show_all_photos = "";
                    }

                    foreach ($property_pictures as $field => $image) {
                        if ( !empty($image) ) {
                            printf( '<a data-fancybox="gallery" href="%2$s">%1$s%3$s</a>', 
                                wp_get_attachment_image( $image, 'medium', "", array( "class" => $field ) ), 
                                wp_get_attachment_url( $image ),
                                $button_show_all_photos
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

                    $post_tags = get_the_tags();

                    // Sorting tags Object Array - Asc sort (>), Desc sort (<)
                    usort($post_tags, function ($a, $b) {return $a->term_id > $b->term_id;} );

                    if ( ! empty( $post_tags ) ) {
                        echo '<ul class="tags">';
                        foreach( $post_tags as $post_tag ) {
                            echo '<li class="tag-'. $post_tag->term_id .'">' . $post_tag->name . '</li>';
                        }
                        echo '</ul>';
                    }
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
                wp_reset_postdata();
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
        



        <section class="learn-more">
            <div class="container">
                <div class="row space-between">
                    <div class="col-12 col-md-6">
                    <?php if ( $google_map ) : ?>
                        <div class="acf-map" data-zoom="18">
                            <div class="marker" data-lat="<?php echo esc_attr($google_map['location']['lat']); ?>" data-lng="<?php echo esc_attr($google_map['location']['lng']); ?>"></div>
                        </div>
                        <div class="direction" ><i class="fas fa-external-link-square-alt"></i> <a target="_blank" href="https://maps.google.com/?q=<?php echo esc_attr($google_map['location']['lat']); ?>,<?php echo esc_attr($google_map['location']['lng']); ?>">Get direction</a></div>
                    <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-6 col-lg-5">
                    <?php if ( !empty( $contact_info['contact_person'] ) ): ?>
                        <h3>Learn more about us!</h3>
                        <p class="large">If you have any questions about this Community or to book a tour, contact:</p>
                        <p class="large"><?php echo $contact_info['contact_person']; ?><br><?php echo $contact_info['contact_person_title']; ?></p>
                        <p><a href="mailto:<?php echo $contact_info['contact_person_email']; ?>" class="button wide"><i class="fas fa-envelope"></i> Email Us</a></p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>



        <section class="contact-info">
            <div class="container">
            <h3>Contact Information</h3>
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-4">
                        <?php
                            printf('<h5>%1$s</h5><p>%2$s<br>%3$s, %4$s %5$s</p>', 
                                $contact_info['company_name'], 
                                $contact_info['street'], 
                                $contact_info['city'], 
                                $contact_info['province']['label'], 
                                $contact_info['postal_code']
                            );
                        ?>

                        <p>
                            <?php
                            if ( !empty( $contact_info['phone'] ) ) echo "Phone: {$contact_info['phone']} <br>";
                            if ( !empty( $contact_info['fax'] ) ) echo "Fax: {$contact_info['fax']}";
                            ?>
                        </p>
                    </div>
                    <div class="col-12 col-md-7 col-lg-8 contacts">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <?php
                                    printf('<h5>%1$s</h5> <p>%2$s<br><a href="mailto:%3$s">%3$s</a></p>',
                                        $contact_info['contact_person'],
                                        $contact_info['contact_person_title'],
                                        $contact_info['contact_person_email']
                                    );
                                ?>
                            </div>
                    
                            <?php 
                                if ( !empty( $contact_info['contact_person_2'] ) ) { 
                                    printf('<div class="col-12 col-sm-6">%1$s</div>', $contact_info['contact_person_2']); 
                                }  

                                if ( !empty( $contact_info['contact_person_3'] ) ) { 
                                    printf('<div class="col-12 col-sm-6">%1$s</div>', $contact_info['contact_person_3']); 
                                } 

                                if ( !empty( $contact_info['contact_person_4'] ) ) { 
                                    printf('<div class="col-12 col-sm-6">%1$s</div>', $contact_info['contact_person_4']); 
                                }
                            ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-8">
                        <?php
                        $agreement_file = get_template_directory_uri() . "/documents/lsaa-celhin-homes-2016-9.pdf";
                        if ( !empty( get_field( 'agreement' ) ) ) $agreement_file = get_field('agreement');
                        ?>
                        <a href="<?php echo $agreement_file; ?>" target="_blank" class="agreement-download">
                            Long Term Care Community Service Accountability Agreement
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                    <div class="col-12 col-md-4">
                        <a href="mailto:<?php echo $contact_info['contact_person_email']; ?>" class="button wide">Volunteer with us</a>
                    </div>
                </div>
            </div>
        </section>


    <?php
        $post_id = get_the_ID();  // get the current post ID

        $args = array( 
            'cat'           => 7, 
            'post_status'   => 'publish', 
            'order'         => 'DESC', 
            'orderby'       => 'date',
            'showposts'     => 3,
            'meta_key'      => 'community',
            'meta_value'    => $post_id,
            'meta_compare'  => '='
        );
        // Query for current community page latest News
        $news = new WP_Query( $args );
        $total_posts = $news->found_posts;
    ?>
    <section class="latest-news">
		<div class="container">

			<header class="section-title">
                <?php 
                    if ( $total_posts ) { 
                        the_title( '<h3>', ' News</h3>' );
                    } else {
                        echo '<h3>Recent News</h3>';
                    } 
                ?>
				<a href="/news/" class="view-all">View All News</a>
			</header>

			<div class="row">
			<?php
				if( $news->have_posts() ) :
					while( $news->have_posts() ):
						$news->the_post();

                        if ( !empty( get_field('community') ) ) {
							$news_tag = '<div class="tag">' . get_the_title( get_field('community') ) . '</div>';
						} else {
							$news_tag = '';
						}

						printf(	'<div class="col-sm-6 col-lg-4">
									<article>
										<figure>%1$s</figure>
										<div class="content">
											<time>%2$s</time>
											<h5 class="news-title"><a href="%3$s">%4$s</a></h5>
											%5$s
										</div>
									</article>
								</div>', 
								get_the_post_thumbnail(), get_the_date(), get_permalink(), get_the_title(), $news_tag
							);
					endwhile;
				wp_reset_postdata();
				endif;



                if ( $total_posts < 3 ) {
                    $extra_posts = 3 -  $total_posts;
                    $args = array( 
                        'cat' => 7, 
                        'post_status' => 'publish', 
                        'order' => 'DESC', 
                        'orderby' => 'date',
                        'showposts' => $extra_posts,
                        'meta_query' => [
                            'relation' => 'OR',
                            array (
                                'key' => 'community',
                                'value' => $post_id,
                                'compare' => "NOT EXISTS"
                            ),
                            array (
                                'key' => 'community',
                                'value' => $post_id,
                                'compare' => "!="
                            )
                        ]
                    );

                    $news = new WP_Query( $args );
                    if( $news->have_posts() ) :
                        while( $news->have_posts() ):
                            $news->the_post();

                            if ( !empty( get_field('community') ) ) {
                                $news_tag = '<div class="tag">' . get_the_title( get_field('community') ) . '</div>';
                            } else {
                                $news_tag = '';
                            }

                            printf(	'<div class="col-sm-6 col-lg-4">
                                        <article>
                                            <figure>%1$s</figure>
                                            <div class="content">
                                                <time>%2$s</time>
                                                <h5 class="news-title"><a href="%3$s">%4$s</a></h5>
                                                %5$s
                                            </div>
                                        </article>
                                    </div>', 
                                    get_the_post_thumbnail(), get_the_date(), get_permalink(), get_the_title(), $news_tag
                                );
                        endwhile;
                    wp_reset_postdata();
                    endif;
                }

                // If no Community Post to show
                if ( $total_posts + $extra_posts == 0 ) { printf( '<div class="col-12"><h6>No News</h6></div>' ); }
			?>
			</div>

            <footer>
                <a href="/news/" class="mobile_view-all">View All News</a>
            </footer>

		</div>
	</section>
        

	</main><!-- #main -->
    
    
    <script src="https://maps.googleapis.com/maps/api/js?key=API_KEY&callback=Function.prototype"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/property-map.js"></script>


<?php
get_footer();
