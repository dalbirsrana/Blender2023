<?php
/**
 * Template part for displaying News releases
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('news'); ?>>
        <?php if ( 'post' === get_post_type() ): blender2023_posted_on(); endif; ?>

        <div class="entry-content">
            <?php the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
            <?php 
                $content = get_the_content();
                $content = strip_tags($content);
                    if (strlen($content) > 250) :
                        echo '<p>' . substr( $content, 0, 250 ) . '...</p>';
                    else :
                        echo '<p>' . $content . '</p>';
                    endif;
            ?>
        </div>

        <?php if (get_field('downloads')): ?>
            <a class="download" href="<?php echo esc_url(get_field('downloads')['url']) ?>" target="_blank" title="View News in pdf"><span>Download</span><i class="fas fa-file-pdf"></i></a>
        <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->