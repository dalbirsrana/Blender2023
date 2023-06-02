<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blender2023
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

<!-- Google Tag Manager -->
<!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TQV7MPR');</script> -->
<!-- End Google Tag Manager -->

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-2QPW1WPCX7"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-2QPW1WPCX7');
	</script>


	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Facebook Meta Tags -->
	<meta property="og:url" content="<?php echo esc_url( bloginfo('url') ); ?>">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php bloginfo('name'); ?>">
	<meta property="og:description" content="<?php if ( is_single() ) { single_post_title('', true); } else { bloginfo('description'); } ?>">
	<meta property="og:image" content="<?php echo get_template_directory_uri() ?>/graphics/og.jpg">

	<!-- Twitter Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta property="twitter:domain" content="<?php echo esc_url( bloginfo('url') ); ?>">
	<meta property="twitter:url" content="<?php echo esc_url( bloginfo('url') ); ?>">
	<meta name="twitter:title" content="<?php bloginfo('name'); ?>">
	<meta name="twitter:description" content="<?php if ( is_single() ) { single_post_title('', true); } else { bloginfo('description'); } ?>">
	<meta name="twitter:image" content="<?php echo get_template_directory_uri() ?>/graphics/og.jpg">
	
	<?php wp_head(); ?>

	<!-- HTML Meta Tags -->
	<meta name="description" content="<?php if ( is_single() ) {  echo get_the_excerpt();  } else { bloginfo('description'); } ?>" />
	
	<!-- WEB FONT FAMILIES -->
	<!-- font-family: p22-mackinac-pro, serif; font-family: poppins, sans-serif; -->
	<link rel="stylesheet" href="https://use.typekit.net/tsm6wfi.css">

	<script src="https://kit.fontawesome.com/13b689b085.js" crossorigin="anonymous"></script>

</head>



<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TQV7MPR" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'blender2023' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="site-branding">
				<div class="logo">
					<a href="/"><img src="<?php echo get_template_directory_uri(); ?>/graphics/branding/omni_logo.svg?v=1" alt="Omni Quality Living Logo"></a>
				</div>
				<div class="logo-white">
					<a href="/"><img src="<?php echo get_template_directory_uri(); ?>/graphics/branding/omni_logo_white.svg?v=1" alt="Omni Quality Living Logo"></a>
				</div>
			</div>
			<nav class="main-navigation">
						
				<input id="menu-toggle" aria-controls="primary-menu" aria-expanded="false" type="checkbox" />
				<label class='menu-button-container' for="menu-toggle"><div class='menu-button'></div></label>

				<div class="menu-container">
					<div class="hold">
						<?php
							wp_nav_menu(
								array(
									'theme_location'	=> 'menu-1',
									'menu_id'			=> 'primary-menu',
									'menu_class'		=> 'main-menu top',
									'container'      	=> false,
								)
							);
						?>

						<div class="spacer"><hr></div>
						
						<?php
							wp_nav_menu(
								array(
									'theme_location'	=> 'menu-2',
									'menu_id'			=> 'primary-menu-mobile',
									'menu_class'		=> 'main-menu bottom',
									'container'      	=> false,
								)
							);
						?>
					</div>
				</div>
				
			</nav><!-- #site-navigation -->


			<div class="search-nav">
				<div class="hold">
					<div class="lang-buttons"><a href="#" class="eng active">EN</a><a href="#" class="fra">FR</a></div>
					<a href="#" class="search popup-link" data-popup="search-popup"><i class="fas fa-search"></i></a>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
