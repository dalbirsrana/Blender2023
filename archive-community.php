<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

get_header();

$care_tags = get_tags();
?>

<main id="primary" class="site-main find-community">

    <header class="page-header">
        <div class="background">
        <?php if ( get_header_image() ) : ?>
            <img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        <?php endif; ?>
        </div>
        <div class="container">
            <h1 class="page-title">
                <?php esc_html_e('Find a Residence', 'blender2023'); ?>
            </h1>
        </div>
    </header><!-- .page-header -->

    <section class="communities">

        <div class="container">

        
            <div class="filter">
                <h5>Filter by:</h5>

                <form action="" method="GET">
                    <div class="select-wrapper">
                        <select name="province" id="id_province" onchange="javascript:this.form.submit()">
                            <option value="">Province</option>
                            <?php
                                $provinces = ['on' => 'Ontario', 'nb' => 'New Brunswick'];
                                foreach ( $provinces as $code => $province ) {
                                    if ( $_GET['province'] == $code ) {
                                        echo "<option selected value=\"{$code}\">{$province}</option>";
                                    } else {
                                        echo "<option value=\"{$code}\">{$province}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="select-wrapper">
                        <select name="care_type" id="id_care_type" onchange="javascript:this.form.submit()">
                            <option value="">Type of Care</option>
                            <?php
                                foreach ( $care_tags as  $tag) {
                                    if ( $_GET['care_type'] == $tag->slug ) {
                                        echo "<option selected value=\"{$tag->slug}\">{$tag->name}</option>";
                                     } else {
                                        echo "<option value=\"{$tag->slug}\">{$tag->name}</option>";
                                     }
                                }
                            ?>
                        </select>
                    </div>
                </form>

                <?php if ( isset( $_GET['care_type'] ) || isset( $_GET['province'] ) ) : ?>
                <div class="clear-filters"><a href="<?php echo home_url( $wp->request ); ?>">Clear Filters <i class="fal fa-times"></i></a></div>
                <?php endif; ?>
            </div>


            <div class="row">
                <?php
                    $province = '';
                    $care_type = '';
                    $args = [];

                    if ( !empty( $_GET['province'] ) ) {
                        $province_raw = sanitize_key( $_GET['province'] );
                        $province_list = ['nl', 'pe', 'ns', 'nb', 'qc', 'on', 'mb', 'sk', 'ab', 'bc', 'yt', 'nt', 'nu'];
                        if ( in_array( $province_raw, $province_list ) ) {
                            $province = $province_raw;
                        }
                        $args += array( 
                            'meta_key' =>  'contact_info_province',
                            'meta_value' => $province,
                            'meta_compare' => 'LIKE'
                        );
                    }
                    
                    if ( !empty( $_GET['care_type'] )  ) {
                        $care_type_raw = sanitize_key( $_GET['care_type'] );
                        $care_type_list = [];
                        foreach ( $care_tags as  $tag) { $care_type_list[] = $tag->slug; }
                        if ( in_array( $care_type_raw, $care_type_list ) ) { $care_type = $care_type_raw; }
                        $args += array(
                            'tax_query' => array( array('taxonomy' => 'post_tag', 'field' => 'slug', 'terms' => array( $care_type )) )
                        );
                    } 
                        
                    $args += array( 'post_type' => 'community', 'post_status' => 'publish', 'order' => 'ASC' );
            
                    $communities = new WP_Query( $args );
                    if( $communities->have_posts() ) :
                        while( $communities->have_posts() ):
                            $communities->the_post();

                            $post_tags = get_the_tags();
                            $post_tags_list = '';
                            if ( ! empty( $post_tags ) ) {
                                foreach( $post_tags as $post_tag ) { $post_tags_list .= '<li class="tag-'. $post_tag->term_id .'">' . $post_tag->name . '</li>'; }
                            }

                            printf(	'<div class="col-sm-6 col-xl-4">
                                        <article>
                                            <a href="%2$s" class="figure">%1$s</a>
                                            <div class="content">
                                                <h5 class="news-title"><a href="%2$s">%3$s</a></h5>
                                                <address>%4$s %5$s</address>
                                                <ul class="tags">%6$s</ul>
                                            </div>
                                        </article>
                                    </div>', 
                                    get_the_post_thumbnail(), get_permalink(), get_the_title(),
                                    get_field('contact_info')['city'], get_field('contact_info')['province']['label'], $post_tags_list
                                );
                        endwhile;
                    wp_reset_postdata();
                    else :
                        printf( '<div class="col-12"><h6>No Post Found</h6></div>' );
                        // esc_html_e( '');
                    endif;
                ?>

            </div>
        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();