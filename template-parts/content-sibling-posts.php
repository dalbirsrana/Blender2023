<?php
/**
 * Template part for displaying Next Posts on Life at Omni Child pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blender2023
 */

?>

<!-- links to other sibling posts -->
<div class="row next-sibling-posts">

<?php 
$child_pages = get_pages( array( 'child_of' => $post->post_parent, 'sort_column' => 'menu_order', 'exclude' =>  '218' ) );

// Life at Omni Sub Pages on Overview page
// Print all sibling pages
if ( $post->post_name == 'overview' ) :

    foreach ( $child_pages as $key => $page ) {
        $page->thumbnail = get_the_post_thumbnail( $page->ID, 'medium');
        $page->link = get_page_link( $page->ID );
        printf (
            '<div class="col-12 col-sm-6"><a class="thumbnail-link" href="%1$s">%2$s<h5 class="title">%3$s</h5></a></div>',  
            $page->link,
            $page->thumbnail,
            $page->post_title
        );
        if ($key == '4') {
            printf(
                '<div class="col-12 col-sm-6"><a class="thumbnail-link" href="%1$s">%2$s<h5 class="title">%3$s</h5></a></div>',  
                get_page_link( '23' ),
                get_the_post_thumbnail( '23', 'medium' ),
                get_the_title( '23' )
            );
        }
    }

// Print Next Two Sibling Pages
else:
    // Get the current page's position among the child pages
    $current_index = array_search( $post, $child_pages );
    // Calculate the index of the next sibling pages
    $next_index_1 = $current_index + 1;
    $next_index_2 = $current_index + 2;

    // find next two pages for navigation
    if ( count( $child_pages ) > 2 ) {
        if ( isset( $child_pages[ $next_index_1 ] ) ) {
            $next_page_1 = $child_pages[ $next_index_1 ];
            $next_page_2 = isset( $child_pages[ $next_index_2 ] ) ?  $child_pages[ $next_index_2 ] : $next_page_2 = $child_pages[ 0 ];
        } else {
            $next_page_1 = $child_pages[ 0 ];
            $next_page_2 = $child_pages[ 1 ];
        }
    } else {
        $next_page_1 = null;
        $next_page_2 = null;
    }

    if ( isset( $next_page_1 ) ) {
        echo '<div class="col-12"><p class="heading-next large">Explore Next:</p></div>';
    }

    // if next page link 1 exists
    if ( isset( $next_page_1 ) ) {
        $next_page_1->thumbnail = get_the_post_thumbnail( $next_page_1->ID, 'medium');
        $next_page_1->link = get_page_link( $next_page_1->ID );
        printf (
            '<div class="col-12 col-sm-6"><a class="thumbnail-link" href="%1$s">%2$s<h5 class="title">%3$s</h5></a></div>',  
            $next_page_1->link, 
            $next_page_1->thumbnail, 
            $next_page_1->post_title 
        );
    }
    // if next page link 2 exists
    if ( isset( $next_page_2 ) ) {
        $next_page_2->thumbnail = get_the_post_thumbnail( $next_page_2->ID, 'medium');
        $next_page_2->link = get_page_link( $next_page_2->ID );
        printf (
            '<div class="col-12 col-sm-6"><a class="thumbnail-link" href="%1$s">%2$s<h5 class="title">%3$s</h5></a></div>',  
            $next_page_2->link, 
            $next_page_2->thumbnail, 
            $next_page_2->post_title 
        );
    }
endif;
?>

</div> 
<!-- End .sibling-posts -->