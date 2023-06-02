<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blender2023
 */
?>

<aside id="secondary" class="col-lg-3 side-bar">

	<?php
		if ( $post->post_parent ) {
			$children = wp_list_pages( array(
				'title_li' => '',
				'child_of' => $post->post_parent,
				'echo'     => 0
			) );
			$title = get_the_title( $post->post_parent );
		} else {
			$children = wp_list_pages( array(
				'title_li' => '',
				'child_of' => $post->ID,
				'echo'     => 0
			) );
			$title = get_the_title( $post->ID );
		}
	?>

	<h6><?php echo $title; ?></h6>
	<?php if ( $children ) : ?>
		<ul class="side-nav"><?php echo $children; ?></ul>
	<?php endif; ?>

	<?php
		if ( is_active_sidebar( 'left-sidebar' ) ) { dynamic_sidebar( 'left-sidebar' ); }
	?>

</aside><!-- #secondary -->