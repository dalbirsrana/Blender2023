<?php
/**
 * Template Name: Our Team
 * The template for displaying Our Team Page
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package carbonneutral
 */

get_header();
?>
<main id="primary" class="site-main inner-page page-our-team">

	<?php while ( have_posts() ) : the_post(); ?>
		<header class="hero">
			<div class="background"><?php the_post_thumbnail(); ?></div>
			<div class="container hidden">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php echo get_field('hero-content'); ?>
			</div>
		</header>
		<section class="intro">
			<div class="container entry-content hidden fadeInUp">
				<?php the_content(); ?>
			</div>
		</section>
		<div class="container"><hr></div>
	<?php endwhile; // End of the loop. ?>
	<?php wp_reset_postdata(); ?>


    <section class="team leadership">
        <div class="container">
            <h4>Team and Leadership</h4>
            <?php 
                //get template with arguments
	            $args = array( 'team_type' => 'team-and-leadership', 'order' => 'ASC' );
	            get_template_part( 'template-parts/content', 'team', $args ); 
            ?>
        </div>
    </section>
	
	<section class="team directors">
        <div class="container">
            <h4>Board of Directors</h4>
            <?php 
                //get template with arguments
	            $args = array( 'team_type' => 'board-of-directors', 'order' => 'ASC' );
	            get_template_part( 'template-parts/content', 'team', $args ); 
            ?>
        </div>
    </section>

	<section class="team advisors">
        <div class="container">
            <h4>Advisors</h4>
            <?php 
                //get template with arguments
	            $args = array( 'team_type' => 'advisors', 'order' => 'ASC' );
	            get_template_part( 'template-parts/content', 'team', $args ); 
            ?>
        </div>
    </section>








	<section class="where-to-start">
		<div class="container hidden fadeInUp">
		<?php
			$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'order' => 'ASC',
				'meta_key' => 'featured_portfolio',
				'meta_value' => '1'
			);
			
			$portfolio = new WP_Query( $args );
			if( $portfolio->have_posts() ) : ?>
				<div class="slider-portfolio">
				<?php
					while( $portfolio->have_posts() ) :
						$portfolio->the_post();
						printf( 
							'<div class="slide"><header>%1$s</header><div class="text"><p>%2$s</p><footer><a href="%3$s%4$s">Read more</a></footer></div></div>',
							get_the_post_thumbnail(),
							get_the_excerpt(),
							get_field('page_link'),
							get_field('section_link_tag')
						);
					endwhile;
				?>
				</div>
				<?php
				wp_reset_postdata();
			else :
				esc_html_e( 'No Post Found');
			endif;
			?>

		<div class="foot"><a class="button" href="/our-portfolio/overview/">Explore Our Portfolio</a></div>

		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();