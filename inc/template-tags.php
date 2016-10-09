<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RAVE
 */

if ( ! function_exists( 'r_a_v_e_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function r_a_v_e_posted_on( $echo = true ) {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'r_a_v_e' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'By %s', 'post author', 'r_a_v_e' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$html = '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	if ( $echo ) {
		echo $html;
	} else {
		return $html;
	}
}
endif;

if ( ! function_exists( 'r_a_v_e_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function r_a_v_e_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ' ', 'r_a_v_e' ) );
		if ( $categories_list && r_a_v_e_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="fa fa-folder" aria-hidden="true"></i>' . esc_html__( ' %1$s', 'r_a_v_e' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'r_a_v_e' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tags" aria-hidden="true"></i>' . esc_html__( ' %1$s', 'r_a_v_e' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	/*if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title *
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'r_a_v_e' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}*/

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'r_a_v_e' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function r_a_v_e_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'r_a_v_e_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'r_a_v_e_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so r_a_v_e_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so r_a_v_e_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in r_a_v_e_categorized_blog.
 */
function r_a_v_e_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'r_a_v_e_categories' );
}
add_action( 'edit_category', 'r_a_v_e_category_transient_flusher' );
add_action( 'save_post',     'r_a_v_e_category_transient_flusher' );


/*
 * Post navigation
 */
function rave_post_navigation( $echo = true ) {
	$args = array(
    	'prev_text'          => '&laquo; %title',
        'next_text'          => '%title &raquo;',
        'in_same_term'       => false,
        'excluded_terms'     => '',
        'taxonomy'           => 'category',
        'screen_reader_text' => __( 'Post navigation' ),
    );
 
    $navigation = '';
 
    $previous = get_previous_post_link(
        '<div class="nav-previous"><h4>Previous Article</h4><h3>%link</h3></div>',
        $args['prev_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );
 
    $next = get_next_post_link(
        '<div class="nav-next"><h4>Next Article</h4><h3>%link</h3></div>',
        $args['next_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );
 
    // Only add markup if there's somewhere to navigate to.
    if ( $previous || $next ) {
        $navigation = _navigation_markup( $previous . $next, 'post-navigation', $args['screen_reader_text'] );
    }

    if ( $echo ) {
    	echo $navigation;
    }
    return $navigation;
}

/*
 * Posts navigation
 */
function rave_posts_navigation( $echo = true ) {
	$navigation = '';
 
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
        $args = wp_parse_args( $args, array(
            'prev_text'          => __( '&laquo; Older articles' ),
            'next_text'          => __( 'Newer articles &raquo;' ),
            'screen_reader_text' => __( 'Posts navigation' ),
        ) );
 
        $next_link = get_previous_posts_link( $args['next_text'] );
        $prev_link = get_next_posts_link( $args['prev_text'] );
 
        if ( $prev_link ) {
            $navigation .= '<div class="nav-previous">' . $prev_link . '</div>';
        }
 
        if ( $next_link ) {
            $navigation .= '<div class="nav-next">' . $next_link . '</div>';
        }
 
        $navigation = _navigation_markup( $navigation, 'posts-navigation', $args['screen_reader_text'] );
    }
 
    if ( $echo ) {
    	echo $navigation;
    }
    return $navigation;
}