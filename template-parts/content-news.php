<?php
/**
 * Template part for displaying News releases 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

if ( !empty( get_field('community') ) ) {
    $news_tag = '<div class="tag">' . get_the_title( get_field('community') ) . '</div>';
} else {
    $news_tag = '';
}

?>
<div class="col-md-6 col-lg-4">
    <article id="post-<?php the_ID(); ?>" class="<?php if ( get_field('is_video_post') ) echo "post-has-video"; ?>">
    
        <a class="post-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" aria-hidden="true" tabindex="-1"><?php the_post_thumbnail(); ?></a>

        <div class="content">
            <time><?= get_the_date() ?></time>
            <h5 class="news-title">
                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h5>
            <?= $news_tag; ?>
        </div>

    </article><!-- #post-<?php the_ID(); ?> -->
</div>