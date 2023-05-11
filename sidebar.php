<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blender2023
 */

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


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

			if ( $children ) : ?>
				<h2><?php echo $title; ?></h2>
				<ul>
					<?php echo $children; ?>
				</ul>
			<?php endif; ?>

	<?php dynamic_sidebar( 'left-sidebar' ); ?>


	
</aside><!-- #secondary -->
