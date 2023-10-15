<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package finalassignment
 */

get_header();
?>

<section class="blog-area pt-100 pb-100">
	<div class="container">

		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<!-- Single -->
					<?php
					if (have_posts()) :
						/* Start the Loop */
						while (have_posts()) :
							the_post();

							/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
							get_template_part('template-parts/content', get_post_type());

						endwhile;
						wp_reset_postdata();

					else :

						get_template_part('template-parts/content', 'none');

					endif;
					?>
				</div>
				<!-- sidebar -->
			</div>
			<div class="col-lg-4">
				<!-- Single -->
				<?php get_sidebar('sidebar-1'); ?>
			</div>
		</div>
</section>

<?php
get_footer();
