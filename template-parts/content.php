<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finalassignment
 */

?>

<?php if (is_single()) : ?>

	<div class="col-lg-12 mb-30">
		<div class="blog-details">
			<div class="blog-item">
				<div class="thumbnail">
					<?php
					$image_url = get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnails');

					if ($image_url) {
						echo '<img alt="..." src="' . esc_url($image_url) . '">';
					}
					?>
				</div>
				<div class="content">
					<div class="meta">
						<span><i class="far fa-calendar-check"></i> <?php echo the_time('j, F  Y'); ?> </span>
						<span><i class="far fa-comment-alt"></i> <?php echo get_comments_number() > 0 ? get_comments_number() : 'No'; ?> Comments</span>
						<?php
						$post_id = get_the_ID(); // Replace with your specific post ID
						$tags = wp_get_post_tags($post_id);

						if ($tags) {
							foreach ($tags as $tag) {
								echo '<span><i class="fas fa-tags"></i> ' . esc_html($tag->name) . '</span>';
							}
						} else {
							echo '';
						}
						?>
					</div>
					<h3><?php echo the_title(); ?></h3>
					<p><?php echo the_content(); ?></p>

				</div>
			</div>

		</div>
	</div>

<?php else : ?>

	<div class="col-lg-12 mb-30">
		<div class="blog-item">
			<div class="thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php
					$image_url = get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnails');

					if ($image_url) {
						echo '<img alt="..." src="' . esc_url($image_url) . '">';
					}
					?>
				</a>
			</div>
			<div class="content">
				<div class="meta">
					<span><i class="far fa-calendar-check"></i> <?php echo the_time('j, F  Y'); ?></span>
					<span><i class="far fa-comment-alt"></i> <?php echo get_comments_number() > 0 ? get_comments_number() : 'No'; ?> Comments</span>
				</div>
				<h3><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p><?php echo wp_trim_words(get_the_excerpt(), 50); ?></p>
				<a class="read-more" href="<?php the_permalink(); ?>">Load More <i class="fas fa-angle-double-right"></i></a>
			</div>
		</div>
	</div>
<?php endif;
