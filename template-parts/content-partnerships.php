    <section class="portfolio">
		<div class="container hidden">
			<header><h3>Our Partnerships</h3></header>
			<?php
				$args = array( 	
					'post_type' => 'portfolio',
					'post_status' => 'publish',
					'order' => 'ASC',
					'meta_key' => 'featured_portfolio',
					'meta_value' => '1'
				);			
				$portfolio = new WP_Query( $args ); 
			?>
				<?php if( $portfolio->have_posts() ) : ?>

					<div class="slider-portfolio">
					<?php 
					    $post_name = "/" . $post->post_name;
						while( $portfolio->have_posts() ) : $portfolio->the_post();

							$p_link = get_field('page_link');
							$pos = false;
							$pos = strpos( $p_link, $post_name );
							if ($pos === false) {
								printf( '<div class="slide"><a href="%2$s">%1$s</a></div>', get_the_post_thumbnail(), $p_link);
							}

						endwhile; 
						wp_reset_postdata();
					?>
					</div>
				<?php else : esc_html_e( 'No Post Found'); ?>
				<?php endif;  ?>
		</div>
	</section>