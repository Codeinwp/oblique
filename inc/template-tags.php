<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Oblique
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function the_posts_navigation() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'oblique' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'oblique' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'oblique' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function the_post_navigation() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'oblique' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
			</div><!-- .nav-links -->
			</nav><!-- .navigation -->
			<?php
	}
endif;

if ( ! function_exists( 'oblique_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function oblique_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

			$posted_on = sprintf(
				/* translators: Post date */
				_x( '%s', 'post date', 'oblique' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

		$category = get_the_category();
		if ( $category ) {
			$cat = '<a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . esc_attr( $category[0]->cat_name ) . '</a>';
		}

		$byline = sprintf(
			/* translators: Post author */
			_x( '%s', 'post author', 'oblique' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		if ( ! is_singular() ) {
			echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span><span class="cat-link">' . $cat . '</span>';
		} elseif ( ! get_theme_mod( 'meta_singles' ) ) {
			echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
			if ( 'post' == get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'oblique' ) );
				if ( $categories_list ) {
					/* translators: Categories list */
					printf( '<span class="cat-links">' . __( '%1$s', 'oblique' ) . '</span>', $categories_list );
				}
			}
		}
	}
endif;

if ( ! function_exists( 'oblique_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function oblique_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() && ! get_theme_mod( 'meta_singles' ) ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'oblique' ) );
			if ( $tags_list ) {
				/* translators: Tags list */
				printf( '<span class="tags-links">' . apply_filters( 'oblique_post_tags_message', __( 'Tagged %1$s', 'oblique' ) ) . '</span>', $tags_list );
			}
		}

	}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function the_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			/* translators: Categories list */
			$title = sprintf( __( 'Category: %s', 'oblique' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			/* translators: Tags list */
			$title = sprintf( __( 'Tag: %s', 'oblique' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			/* translators: Author */
			$title = sprintf( __( 'Author: %s', 'oblique' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			/* translators: Year */
			$title = sprintf( __( 'Year: %s', 'oblique' ), get_the_date( _x( 'Y', 'yearly archives date format', 'oblique' ) ) );
		} elseif ( is_month() ) {
			/* translators: Month */
			$title = sprintf( __( 'Month: %s', 'oblique' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'oblique' ) ) );
		} elseif ( is_day() ) {
			/* translators: Day */
			$title = sprintf( __( 'Day: %s', 'oblique' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'oblique' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title', 'oblique' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'oblique' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'oblique' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'oblique' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'oblique' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'oblique' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'oblique' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'oblique' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'oblique' );
			}
		} elseif ( is_post_type_archive() ) {
			/* translators: archives title */
			$title = sprintf( __( 'Archives: %s', 'oblique' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'oblique' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = __( 'Archives', 'oblique' );
		}// End if().

			/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
			$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;
		}
	}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after  Optional. Content to append to the description. Default empty.
	 */
	function the_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( ! empty( $description ) ) {
			/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
			echo $before . $description . $after;
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function oblique_categorized_blog() {

	$all_the_cool_cats = get_transient( 'oblique_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'oblique_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so oblique_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so oblique_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in oblique_categorized_blog.
 */
function oblique_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'oblique_categories' );
}
add_action( 'edit_category', 'oblique_category_transient_flusher' );
add_action( 'save_post',     'oblique_category_transient_flusher' );
