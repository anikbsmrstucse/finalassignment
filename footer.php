<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package finalassignment
 */

?>

<!-- Start Footer Area -->
<section class="footer">
	<div class="footer-top pt-70">
		<div class="container">
			<div class="row">
				<!-- Single -->
					<?php if (is_active_sidebar('footer')) 
					 dynamic_sidebar('footer');
					?>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="footer-bottom-text">
						<p>Copyrights © 2021 <a target="__blank" href="https://codepopular.com/">CodePopular</a> All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Footer Area -->
<div class="scroll-area">
	<i class="fa fa-angle-up"></i>
</div>

<?php wp_footer(); ?>

</body>

</html>