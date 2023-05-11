<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

?>

<?php if ( 'post' === get_post_type() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>

			<div class="entry-meta">
				<?php blender2023_posted_on(); ?>
			</div><!-- .entry-meta -->
			
		</header><!-- .entry-header -->
		<div class="entry-summary"><?php the_excerpt(); ?></div><!-- .entry-summary -->
	</article><!-- #post-<?php the_ID(); ?> -->
<?php endif; ?>