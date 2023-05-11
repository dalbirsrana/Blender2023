<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blender2023
 */

?>

	<footer id="colophon" class="site-footer">

		<div class="container">
			<div class="signup">
				<h4>Subscribe to our newsletter</h4>
				<div>
					<form action="" method="post" name="newsletter" class="signup-form">
						<div class="form-group">
							<input required placeholder="Name" type="text" name="name" id="id-name" />
						</div>
						<div class="form-group">
							<input required placeholder="Email" type="text" name="email" id="id-email" />
						</div>
						<div class="form-group">
							<button name="submit" type="submit"  id="nl-submit" class="button blue">Submit</button>
						</div>
						<input type="hidden" name="g-recaptcha-response" id="recaptchaResponse1">
					</form>
					<div class="signup-message"></div>
				</div>

			</div>
		</div>



		<div class="container footer-nav">
			<div class="row">

				<div class="col-3 logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo">
						<img width="124" height="124" src="<?php echo esc_url(get_template_directory_uri()); ?>/graphics/branding/omni_logo_white.svg" alt="logo Omni Quality Living">
					</a>
				</div>

				<div class="col-6 menu">
					<?php
						wp_nav_menu(
							array(
								'theme_location'	=> 'menu-2',
								'menu_id'			=> 'footer-menu',
								'container'			=> 'nav',
								'container_class'	=> 'menu-container',
							)
						);
					?>
				</div>

				<div class="col-12 col-md-3 social">
					<h6>Follow Us</h6>
					<div class="social__links">
						<a aria-label="Follow Us on Twitter" target="_blank" href="https://twitter.com/carbonneutraltd"><i class="fab fa-twitter" aria-hidden="true"></i></a>
						<a aria-label="Follow Us on Linked In" target="_blank" href="https://www.linkedin.com/company/carbonneutralroyalty/"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
					</div>
				</div>


			</div>
		</div>

		<div class="site-info">

			<div class="container">
				<ul>
					<li class="copy">
						<a href="<?php echo esc_url( home_url() ); ?>"><?php printf( esc_html__( '&copy; Omni Health Care ' ) ); ?><?php echo date('Y'); ?></a>
					</li>
					<li>
						<a href="<?php echo esc_attr( esc_url( get_permalink(3) ) ); ?>"><?php esc_html_e( 'Privacy', 'blender2023' ) ?></a>
					</li>
					<li>
						<a href="https://www.blendermedia.com" target="_blank">Designed & Powered by <strong>BLENDER</strong></a>
					</li>
				</ul>
				
			</div>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->


<dialog id="search-popup">
	<button class="close" data-close-modal>X</button>  
	<form action="/" method="get">
		<input type="text" placeholder="Search" name="s" id="search" value="<?php the_search_query(); ?>" />
		<input type="submit" value="Submit" />
	</form>
</dialog>

<?php wp_footer(); ?>

<!-- Cookie Consent -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
<script>
window.addEventListener("load",function(){window.cookieconsent.initialise({palette:{popup:{background:"#eaf0f6",text:"#000000"},button:{background:"#106eac",text:"#ffffff"}},theme:"edgeless",content:{message:"We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.",dismiss:"Got it!",link:"Learn more",href:"<?php echo esc_url( bloginfo('url') ); ?>/privacy-policy/",target:"_self"}})});
</script>


</body>
</html>