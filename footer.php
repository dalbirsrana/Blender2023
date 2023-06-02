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
			<div class="sign-up" id="newsletter_signup">
				<h3>Subscribe to our newsletter</h3>
				<div class="wrapper">
					<form action="" method="post" name="newsletter" class="signup-form">
						<div class="form-group">
							<input required placeholder="Name" type="text" name="name" id="id-name" />
						</div>
						<div class="form-group">
							<input required placeholder="Email" type="text" name="email" id="id-email" />
						</div>
						<div class="form-group submit">
							<button name="submit" type="submit"  id="nl-submit" class="button">Submit</button>
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
						<img width="125" height="109" src="<?php echo esc_url(get_template_directory_uri()); ?>/graphics/branding/omni_logo_white.svg?v=1" alt="logo Omni Quality Living">
					</a>
				</div>

				<nav class="col-5 footer-menu">
					<?php
						wp_nav_menu(
							array(
								'theme_location'	=> 'menu-2',
								'menu_id'			=> 'footer-menu',
								'container'			=>  false,
								'depth'				=> 1
							)
						);
					?>
				</nav>

				<div class="col-12 col-lg-4 social">
					<div>
						<h6>Follow Us</h6>
						<div class="social__links">
							<a aria-label="Follow Us on Facebook" target="_blank" href="http://www.facebook.com/OMNIHealthCare"><i class="fa fa-facebook" aria-hidden="true"></i></a>
							<a aria-label="Follow Us on Twitter" target="_blank" href="http://twitter.com/omnihealthcare"><i class="fa fa-twitter" aria-hidden="true"></i></a>
							<a aria-label="Follow Us on Vimeo" target="_blank" href="https://vimeo.com/theomniway"><i class="fa fa-vimeo" aria-hidden="true"></i></a>
							<a aria-label="Follow Us on Linked In" target="_blank" href="https://www.linkedin.com/company/omniway"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>


			</div>
		</div>

		<div class="site-info">
			<div class="container">

				<div class="hold">
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
window.addEventListener("load",function(){window.cookieconsent.initialise({palette:{popup:{background:"#fdfbf6",text:"#000000"},button:{background:"#f47f72",text:"#ffffff"}},theme:"edgeless",content:{message:"We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.",dismiss:"Got it!",link:"Learn more",href:"<?php echo esc_url( bloginfo('url') ); ?>/privacy-policy/",target:"_self"}})});
</script>

<!-- RECAPTCHA -->
<script src="//www.google.com/recaptcha/api.js?render=6Ld8eVImAAAAAHuZ1iYYxi7S-u-1uznzTVnFPrNx"></script>
<script> var $recaptcha_site_key = "6Ld8eVImAAAAAHuZ1iYYxi7S-u-1uznzTVnFPrNx"; </script>


</body>
</html>
