<?php
/**
 * The template for displaying Category News pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

get_header();

// get the current taxonomy term
$term = get_queried_object();
// vars
$hero_image = get_field('background_image', $term);
?>
	<main id="primary" class="site-main">
        
        <header class="page-header">
			<div class="background">
                <img src="<?php echo $hero_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" >
            </div>
			<div class="container">
                <?php single_term_title( '<h1 class="page-title">', '</h1>' ); ?>
			</div>
		</header><!-- .page-header -->


		<section class="posts">
            <div class="container">

                <div class="filter">
                    <h5>Filter by:</h5>
                    <form action="" method="GET">
                        <div class="select-wrapper">
                            <select name="community_id" id="id_community" onchange="javascript:this.form.submit()">
                                <option value="">Community</option>
                                <?php
                                    $community_posts = new WP_Query( [ 'post_type' => 'community', 'post_status' => 'publish' ] );
                                    $community_ids = [];
                                    while ( $community_posts->have_posts() ) {
                                        $community_posts->the_post();
                                        
                                        $community_ids[] = $id = get_the_ID();
                                        $name = get_the_title();
                                        if ( $_GET['community_id'] == $id )
                                        echo "<option selected value=\"{$id}\">{$name}</option>";
                                        else
                                        echo "<option value=\"{$id}\">{$name}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>

                <?php
                    $args = array( 'cat' => 7, 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date' );
                    if ( isset( $_GET['community_id'] ) ) {
                        $id_raw = sanitize_text_field( $_GET['community_id'] );
                        if ( in_array( $id_raw, $community_ids )) { $community_id = $id_raw; }
                        $args += [ 'meta_key' => 'community', 'meta_value' => $community_id, 'meta_compare' => '='  ];
                    }
                    $news = new WP_Query( $args );

                    if ( $news->have_posts() ) :
                        /* Start the Loop */
                        echo '<div class="row">';
                        while ( $news->have_posts() ) : 
                            $news->the_post();
                            get_template_part( 'template-parts/content', 'news' );
                        endwhile;
                        echo '</div>';
                    else:
                        echo '<p>No News post found!</p>';
                    endif;
                ?>
            </div>
        </section>

	</main><!-- #main -->

<?php
get_footer();
