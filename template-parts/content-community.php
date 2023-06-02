<?php
/**
 * Template part for displaying Communities
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

?>
<div class="col-md-6 col-lg-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
        <a class="post-thumbnail" href="<?php echo esc_url($link); ?>" target="<?php echo $target; ?>" aria-hidden="true" tabindex="-1">
            <?php the_post_thumbnail('thumbnail'); ?>
        </a>

        <h5 class="entry-title">
            <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" target="<?php echo $target; ?>" >
                <?php  the_title(); ?>
            </a>
        </h5> 

    </article><!-- #post-<?php the_ID(); ?> -->
</div>
