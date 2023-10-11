<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package finalassignment
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<!-- Start Header Area -->
	<header class="header">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-md-6 align-self-center">
						<div class="top-info">
							<span><i class="fas fa-phone-alt"></i> <?php echo get_theme_mod('header_phone'); ?></span>
							<span><i class="far fa-envelope"></i> <?php echo get_theme_mod('header_email'); ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="top-social">
							<ul>
								<li><a href="<?php echo get_theme_mod('header_social_facebook') ?>"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="<?php echo get_theme_mod('header_social_twitter') ?>"><i class="fab fa-twitter"></i></a></li>
								<li><a href="<?php echo get_theme_mod('header_social_instagram') ?>"><i class="fab fa-instagram"></i></a></li>
								<li><a href="<?php echo get_theme_mod('header_social_linkedin') ?>"><i class="fab fa-linkedin"></i></a></li>
								<li><a href="<?php echo get_theme_mod('header_social_vimeo') ?>"><i class="fab fa-vimeo-v"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 align-self-center">
						<div class="logo">
							<h2><a href="index.html">Logo</a></h2>
						</div>
						<div class="canvas_open">
							<a href="javascript:void(0)"><i class="fas fa-bars"></i></a>
						</div>
					</div>
					<div class="col-lg-10">
						<div class="right-btn-m align-self-center">
							<a class="button-1" href="quote.html">Quote Now</a>
						</div>
						<div class="menu">
							<nav>
								<ul>
									<li><a href="index.html">Home</a></li>
									<li><a href="about.html">About Us</a></li>
									<li><a href="#">Page</a>
										<ul>
											<li><a href="team.html">Team</a></li>
											<li><a href="about.html">About Us</a></li>
										</ul>
									</li>
									<li><a href="services.html">Services</a>
										<ul>
											<li><a href="services.html">Services</a></li>
											<li><a href="services-details.html">Services Details</a></li>
										</ul>
									</li>
									<li><a href="portfolio.html">Portfolio</a>
										<ul>
											<li><a href="portfolio.html">Portfolio</a></li>
											<li><a href="portfolio-details.html">Portfolio Details</a></li>
										</ul>
									</li>
									<li><a href="blog.html">Blog</a>
										<ul>
											<li><a href="blog.html">Blog</a></li>
											<li><a href="single.html">Blog Details</a></li>
										</ul>
									</li>
									<li><a href="contact.html">Contact us</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- End Header Area -->
	<!-- Start Mobile Menu Area -->
	<div class="mobile-menu-area">

		<!--offcanvas menu area start-->
		<div class="off_canvars_overlay">

		</div>
		<div class="offcanvas_menu">
			<div class="offcanvas_menu_wrapper">
				<div class="canvas_close">
					<a href="javascript:void(0)"><i class="fas fa-times"></i></a>
				</div>
				<div class="mobile-logo">
					<h2><a href="index.html">Logo</a></h2>
				</div>
				<div id="menu" class="text-left ">
					<ul class="offcanvas_main_menu">
						<li class="menu-item-has-children">
							<a href="index.html"> Home</a>
						</li>
						<li class="menu-item-has-children">
							<a href="about.html">About Us</a>
						</li>
						<li class="menu-item-has-children">
							<a href="#">Page</a>
							<ul class="sub-menu">
								<li><a href="team.html">Team</a></li>
								<li><a href="about.html">About Us</a></li>
							</ul>
						</li>
						<li class="menu-item-has-children">
							<a href="#">Services</a>
							<ul class="sub-menu">
								<li><a href="services.html">Services</a></li>
								<li><a href="services-details.html">Services Details</a></li>
							</ul>
						</li>
						<li class="menu-item-has-children">
							<a href="#">Portfolio</a>
							<ul class="sub-menu">
								<li><a href="portfolio.html">Portfolio</a></li>
								<li><a href="portfolio-details.html">Portfolio Details</a></li>
							</ul>
						</li>
						<li class="menu-item-has-children">
							<a href="#">Blog</a>
							<ul class="sub-menu">
								<li><a href="blog.html">Blog</a></li>
								<li><a href="single.html">Blog Details</a></li>
							</ul>
						</li>
						<li class="menu-item-has-children">
							<a href="contact.html"> Contact Us</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--offcanvas menu area end-->