<?php
/**
 * The template for displaying Front Page (Home Page)
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

get_header();
?>
<main id="primary" class="site-main home-page">
	
	<section class="hero">	
		<div class="background">
			<img class="mobile-banner" src="<?php the_field('mobile_hero_banner') ?>" alt="Banner Omni">
			<?php the_post_thumbnail(); ?>
		</div>

		<div class="container">
			<div class="content">
				<h1 class="page-title"><?php bloginfo('description'); ?></h1>
				<div class="hero-links">
					<a href="/communities" class="button white wide">Find a Community</a>
					<a href="#newsletter_signup" class="button white wide">Get Informed</a>
				</div>
			</div>
		</div>

	</section>			
		
	<?php 
		// while ( have_posts() ) : the_post(); 
		// the_content(); 
		// endwhile; // End of the loop. 
		// wp_reset_query(); 
	?>


	<?php $about = get_field('about'); ?>
	<?php if ( $about ) : ?>
	<section class="intro">
		<div class="container">
			<div class="row space-between">
				<div class="col-12 col-md-6">
					<img src=<?php echo esc_url( $about['image']['url'] ); ?>" alt="about us">
				</div>
				<div class="col-12 col-md-6 col-xl-5 text">
					<p class="large"><?php echo $about['text']; ?></p>
					<a href="<?php echo $about['view_more']; ?>" class="button">View our Communities</a>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>


	<?php $slider = get_field('slider'); ?>
	<?php if ( $slider ) : ?>
	<section class="discover">
		<div class="container">
			<div class="row space-between">
				<div class="col-12 col-md-5 col-lg-4 left">
					<h3><?php echo $slider['heading']; ?></h3>
					<ul id="slider-discover-links">
					<?php
						for ($i=1; $i<=6; $i++) {
							$s_title = "slide_" . $i . "_title";
							echo  "<li><span></span>" . $slider[$s_title] . "</li>";
						}
					?>
					</ul>

				</div>
				<div class="col-12 col-md-7">
					<div class="slider-hold">
						<div id="slider-discover">
						<?php
							for ($i=1; $i<=6; $i++) {
								$s_title = "slide_" . $i . "_title";
								$s_text = "slide_" . $i . "_text";
								printf(
									'<div class="slide"><h4 class="title-%3$s">%1$s</h4><div>%2$s</div></div>', $slider[$s_title], $slider[$s_text], $i
								);
							}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>




	<?php $where_to_start = get_field('where_to_start'); ?>
	<?php if ( $where_to_start ) : ?>
	<section class="where-to-start">
		<div class="container">

			<header>
				<?php echo $where_to_start['heading']; ?>
			</header>

			<div class="row flex-center">
				<div class="col-12 col-md-6 col-xl-5">
					<div class="tab">
						<figure>
							<img height="634" width="1046" src="<?php echo $where_to_start['tab_1_image']['url']; ?>" alt="">
						</figure>
						<div class="content">
							<h5><?php echo $where_to_start['tab_1_title']; ?></h5>
							<a href="<?php echo $where_to_start['tab_1_link']; ?>" class="button">Learn More</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-xl-5">
					<div class="tab">
						<figure>
							<img height="634" width="1046" src="<?php echo $where_to_start['tab_2_image']['url']; ?>" alt="">
						</figure>
						<div class="content">
							<h5><?php echo $where_to_start['tab_2_title']; ?></h5>
							<a href="<?php echo $where_to_start['tab_2_link']; ?>" class="button">View Our Communities</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>


	<?php $career = get_field('career'); ?>
	<?php if ( $career ) : ?>
	<section class="career">
		<div class="container">
			<div class="row row-reverse">
				<div class="col-12 col-md-6 image">
					<img src="<?php echo $career['image']['url']; ?>" alt="Caregiving Career">
				</div>
				<div class="col-12 col-md-6 col-lg-5 text">
					<div><?php echo $career['text']; ?></div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>


	<?php
		get_template_part( 'template-parts/content', 'latest-news' );
	?>

</main><!-- #main -->

<?php
get_footer();