<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */
?>
<div class="col-md-6 col-lg-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php 
            if ( get_field('external_link') ) {
                $link = get_field('external_link');
                $target = "_blank";
            } else {
                $link = get_permalink();
                $target = "";
            }
        ?>

        <a class="post-thumbnail" href="<?php echo esc_url($link); ?>" target="<?php echo $target; ?>" aria-hidden="true" tabindex="-1"><?php the_post_thumbnail(); ?></a>

        <?php if ( 'post' === get_post_type() ): blender2023_posted_on(); endif; ?>

        <h6 class="entry-title">
            <a href="<?php echo esc_url($link); ?>" rel="bookmark" target="<?php echo $target; ?>" >
                <?php if (strlen($post->post_title) > 70): echo substr( the_title($before = '', $after = '', FALSE), 0, 120 ) . '...'; 
                else: the_title();
                endif; ?>
            </a>
        </h6> 

    </article><!-- #post-<?php the_ID(); ?> -->
</div>