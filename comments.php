<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finalassignment
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">
	<!-- comment list -->
	<?php
	// You can start editing here -- including this comment!
	if (have_comments()) :
	?>
		<div class="comments-list mt-30">
			<h4 class="comments-title">
				<?php
				$finalassignment_comment_count = get_comments_number();
				if ('1' === $finalassignment_comment_count) {
					echo esc_html__('1 comment', 'finalassignment');
				} else {
					printf(
						/* translators: 1: comment count number, 2: title. */
						esc_html(_nx('%1$s comment 2$s&rdquo;', '%1$s comments', $finalassignment_comment_count, 'comments title', 'finalassignment')),
						number_format_i18n($finalassignment_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						' ',
					);
				}
				?>
			</h4><!-- .comments-title -->

			<?php the_comments_navigation(); ?>

			<ul class="comment-list">
				<?php
				wp_list_comments(
					array(
						'style'      => 'ul',
						'short_ping' => true,
						'avatar_size' => 80, // Corrected 'avatar_size'
						'depth' => 5,
					)
				);
				?>
			</ul><!-- .comment-list -->

			<?php
			the_comments_navigation();

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if (!comments_open()) :
			?>
				<p class="no-comments"><?php esc_html_e('Comments are closed.', 'finalassignment'); ?></p>
			<?php
			endif;

			// Check for have_comments().
			?>
		</div>
	<?php endif; ?>
	<!-- comment area -->
	<div id="respond" class="comments-form mt-30 mb-30 comment-respond">
		<h4>Leave a Reply</h4>
		<?php
		$args = array(
			'label_submit' => 'Comment Now',
			'title_reply' => '',
			'comment_notes_after'  => '',
			'comment_notes_before' => '',
			'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="button-1" value="%4$s">%4$s</button>',
			'id_form'              => 'commentform',
			'class_container' => '',
			'reply_title' => '',
			'title_reply_to ' => '',
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Your Message" aria-required="true"></textarea></p>',
			
		);
		comment_form($args);
		?>
	</div>

</div><!-- #comments -->