<?php
/**
 * Template file to display page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */
get_header();
?>
	<main id="primary" class="site-main two-column">
        <header class="page-header">
			<div class="background"><img src="<?php echo esc_url( get_the_post_thumbnail_url( $post->post_parent ) ); ?>" alt="Banner Image"> </div>
			<div class="container">
                    <?php if ( $post->post_parent ) : ?>
                        <h1 class="page-title"><?php echo get_the_title( $post->post_parent ); ?></h1>
                        <p class="page-sub-title"><?php single_post_title(); ?></p>
                    <?php else: ?>
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    <?php endif; ?>
			</div>
        </header>

        <div class="layout-col-2 container">
            <div class="row">
                <?php get_sidebar(); ?>
                
                <div class="col-12 col-lg-9 main-content page-content">
                    <article class="hidden">
                    <?php 
                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();
                            the_content();
                        endwhile;

                        if ( $post->post_parent == '9' ) {
                            get_template_part( 'template-parts/content', 'sibling-posts' ); 
                        }
                            
                        //Explore Next Post links on Corporate Values page
                        if ( $post->post_name == 'corporate-values' || $post->ID == '41' ) {
                            $explore_next_posts = [45, 47];
                            echo '<div class="row next-sibling-posts">';
                            foreach ( $explore_next_posts as $next_post ) {
                                printf(
                                    '<div class="col-12 col-sm-6"><a class="thumbnail-link" href="%1$s">%2$s<h5 class="title">%3$s</h5></a></div>',  
                                    get_page_link( $next_post ),
                                    get_the_post_thumbnail( $next_post, 'medium' ),
                                    get_the_title( $next_post )
                                );
                            }
                            echo '</div>';
                        }
                    ?>

                    </article>
                </div>
            </div>
        </div><!-- .layout-col-2 -->

        <footer class="page-footer container">
            <div class="row">
                <div class="col-12 col-md-6 image"><img src="<?php echo get_template_directory_uri() ?>/graphics/page-footer.jpg" alt="CTA: Explore Communities"></div>
                <div class="col-12 col-md-6 align-self-center text">
                    <h4>Learn more about life at Omni Communities</h4>
                    <a class="button wide" href="<?php echo esc_url( bloginfo('url') ); ?>/communities/">Explore Communities</a>
                </div>
            </div>
        </footer>

	</main><!-- #main -->

<?php
get_footer();