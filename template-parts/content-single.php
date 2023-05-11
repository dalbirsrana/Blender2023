<?php
/**
 * Template part for displaying Single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>

        <?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta"><?php blender2023_posted_on(); ?> </div><!-- .entry-meta -->
		<?php endif; ?>

        <?php if (get_field('downloads')): ?>
            <a class="download" href="<?php echo esc_url(get_field('downloads')['url']) ?>" target="_blank" title="View News in pdf"><span>View </span><i class="fas fa-file-pdf"></i></a>
        <?php endif; ?>

        <div class="divider"><hr></div>
	</header><!-- .entry-header -->


	<?php // blender2023_post_thumbnail(); ?>

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

	<footer class="entry-footer">
		<?php // blender2023_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
