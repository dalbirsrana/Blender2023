<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="hero">
		<div class="background"><?php the_post_thumbnail(); ?></div>
		<div class="container hidden">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <?php echo get_field('hero-content'); ?>
        </div>
	</header><!-- .hero -->

	<section class="intro">
		<div class="container entry-content hidden">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	</section>
		
	<?php $values = get_field('two_column_grid'); ?>
	<?php if ( $values ) : ?>
		<div class="container"><div class="divider"><hr></div></div>
		<section class="layout-2xn pt-0">
			<div class="container">
			<?php if ($values['section_heading']) : ?>
				<h4><?php echo $values['section_heading']; ?></h4>
			<?php endif; ?>

				<div class="row items hidden">
					<?php if ($values['item_1']) : ?><div class="col-sm-6 item"><div><?php echo $values['item_1']; ?></div></div><?php endif; ?>
					<?php if ($values['item_2']) : ?><div class="col-sm-6 item"><div><?php echo $values['item_2']; ?></div></div><?php endif; ?>
					<?php if ($values['item_3']) : ?><div class="col-sm-6 item"><div><?php echo $values['item_3']; ?></div></div><?php endif; ?>
					<?php if ($values['item_4']) : ?><div class="col-sm-6 item"><div><?php echo $values['item_4']; ?></div></div><?php endif; ?>
				</div>

				<?php if ( (49 === get_the_ID()) ) : ?>
					<div class="aligncenter"><a href="<?php  echo esc_url( bloginfo('url') );  ?>/contact/" class="button">Connect with Us</a></div>
				<?php endif; ?>

			</div>
		</section>
	<?php endif ?>


	<?php $quote_text = get_field('quote_text'); ?>
	<?php if ( get_the_ID() == '49') : ?>

	<section class="testimonials pt-0 ">
		<div class="container">
		<header><h4>Our Partner Testimonials</h4></header>
		<?php
			$args = array( 'post_type' => 'partners', 'post_status' => 'publish', 'order' => 'ASC' );
			$partners = new WP_Query( $args );

			if( $partners->have_posts() ) : ?>
				<div class="row slider-testimonials">
				<?php
					while( $partners->have_posts() ): $partners->the_post();
						printf(	'<div class="item col-lg-6">
									<div class="item__preview">
										<div class="image">%1$s</div>
										<div class="text">
											<div>%4$s</div>
											<div>
												<h6>%2$s</h6>
												<p>%3$s</p>
											</div>
											
										</div>
									</div>
								</div>',
								get_the_post_thumbnail(),
								get_the_title(), 
								get_field('sub_title'),
								get_field('testimonials'),
							);
					endwhile;
				?>
				</div>
				<?php
				wp_reset_postdata();
			endif;
		?>
		</div>
	</section>

	<?php endif ?>



</article><!-- #post-<?php the_ID(); ?> -->
