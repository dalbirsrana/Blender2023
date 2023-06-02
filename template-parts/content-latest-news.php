<section class="latest-news">
		<div class="container">

			<header class="section-title">
				<h3>Latest News</h3>
				<a href="/news/" class="view-all">View All News</a>
			</header>

			<div class="row">
			<?php
				$args = array( 'cat' => 7, 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date', 'showposts' => 3  );
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
							echo get_field('community');
					endwhile;
				wp_reset_postdata();
				else :
					printf( '<div class="col-12"><h6>No Post Found</h6></div>' );
					// esc_html_e( '');
				endif;
			?>
			</div>

			<footer>
                <a href="/news/" class="mobile_view-all">View All News</a>
            </footer>

		</div>
	</section>