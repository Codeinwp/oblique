<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Oblique
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<?php do_action( 'oblique_comments_title' ); ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : /* are there comments to navigate through */ ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'oblique' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'oblique' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'oblique' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; /* check for comment navigation */ ?>

		<ol class="comment-list">
			<?php do_action( 'oblique_comments_list' ); ?>
		</ol><!-- .comment-list -->

		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through
		?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'oblique' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'oblique' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'oblique' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // check for comment navigation
		?>

	<?php endif; ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'oblique' ); ?></p>
	<?php
	endif;
	?>

	<?php
		$args = array(
			'comment_notes_after' => '',
		);
		comment_form( apply_filters( 'oblique_comments_args', $args ) );
	?>

</div><!-- #comments -->
