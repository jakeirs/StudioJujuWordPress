<?php

if ( ! function_exists( 'juju_breadcrumb' ) ) {
	function juju_breadcrumb( $showhome = true, $separatorclass = false ) {
		// Settings
		$separator  = '/';
		$id         = 'breadcrumbs';
		$class      = 'breadcrumbs';
		$home_title = 'jujustudio.co.uk';

		// Get the query & post information
		global $post,$wp_query;
		$category = get_the_category();
		// Build the breadcrums
		echo '<ul id="' . $id . '" class="' . $class . '">';
		// Do not display on the homepage
		if ( ! is_front_page() ) {
			// Home page
			echo '<li class="breadcrumbs__item"><a class="breadcrumbs__link" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
			if ( $separatorclass ) {
				echo '<li class="breadcrumbs__item"> ' . $separator . ' </li>';
			}
			if ( is_single() && ! is_attachment() ) {
				// Single post (Only display the first category)
				echo '<li class="breadcrumbs__item"><a class="breadcrumbs__link" href="' . get_category_link($category[0]->term_id) . '" title="' . $category[0]->cat_name . '">' . $category[0]->cat_name . '</a></li>';
				if ( $separatorclass ) {
					echo '<li class="breadcrumbs__item breadcrumbs--separator"> ' . $separator . ' </li>';
				}
				echo '<li class="breadcrumbs__item breadcrumbs__item--current">' . get_the_title() . '</li>';
			} elseif ( is_category() ) {
				// Category page
				// Get the current category
				$current_category = $wp_query->queried_object;
				echo '<li class="breadcrumbs__item breadcrumbs__item--current">' . get_the_title() . '</li>';
			} elseif ( is_tax() ) {
				// Tax archive page
				$queried_object = get_queried_object();
				$name = $queried_object->name;
				$slug = $queried_object->slug;
				$tax = $queried_object->taxonomy;
				$term_id = $queried_object->term_id;
				$parent = $queried_object->parent;
				if( $parent ) {
					$parents = [];
					// Loop through all term ancestors
					while ( $parent ) {
						$parent_term = get_term($parent, $tax);
						// The output will be reversed, so separator goes first
						if ( $separatorclass ) {
							$parents[] = '<li class="breadcrumbs__item breadcrumbs--separator"> ' . $separator . ' </li>';
						}
						$parents[] = '<li class="breadcrumbs__item"><a class="breadcrumbs__link" href="' . get_term_link($parent) . '" title="' . $parent_term->name . '">' . $parent_term->name . '</a></li>';
						$parent = $parent_term->parent;
					}
					echo implode( array_reverse( $parents ) );
				}
				echo '<li class="breadcrumbs__item">' . $name . '</li>';
		} elseif ( is_page() ) {
				// Standard page
				if ( $post->post_parent ) {
					// If child page, get parents
					$anc = get_post_ancestors( $post->ID );
					// Get parents in the right order
					$anc = array_reverse( $anc );
					// Parent page loop
					$parents = '';
					foreach ( $anc as $ancestor ) {
						$parents .= '<li class="breadcrumbs__item"><a class="breadcrumbs__link" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
						if ( $separatorclass ) {
							$parents .= '<li class="breadcrumbs__item breadcrumbs--separator"> ' . $separator . ' </li>';
						}
					}
					// Display parent pages
					echo $parents;
					// Current page
					echo '<li class="breadcrumbs__item breadcrumbs__item--current">' . get_the_title() . '</li>';
				} else {
					// Just display current page if not parents
					echo '<li class="breadcrumbs__item breadcrumbs__item--current"> ' . get_the_title() . '</li>';
				}
			} elseif ( is_tag() ) {
				// Tag page
				// Get tag information
				$term_id = get_query_var('tag_id');
				$taxonomy = 'post_tag';
				$args = 'include=' . $term_id;
				$terms = get_terms($taxonomy, $args);
				// Display the tag name
				echo '<li class="breadcrumbs__item breadcrumbs__item--current">' . $terms[0]->name . '</li>';			
			} elseif ( is_author() ) {
				// Auhor archive
				// Get the author information
				global $author;
				$userdata = get_userdata($author);
				// Display author name
				echo '<li class="breadcrumbs__item breadcrumbs__item--current">Author: ' . $userdata->display_name . '</li>';
			} elseif ( get_query_var('paged') ) {
				// Paginated archives
				echo '<li class="breadcrumbs__item breadcrumbs__item--current">' . __('Page', 'foundationpress' ) . ' ' . get_query_var('paged') . '</li>';
			} elseif ( is_search() ) {
				// Search results page
				echo '<li class="breadcrumbs__item breadcrumbs__item--current">Search results for: ' . get_search_query() . '</li>';
			} elseif ( is_post_type_archive() ) {
				
				// Custom Post Type Archive Page
				echo '<li class="breadcrumbs__item breadcrumbs__item--current">' . post_type_archive_title( '', false ) . '</li>';
				
			} elseif ( is_404() ) {
				// 404 page
				echo '<li>Error 404</li>';
			} // End if().
		} else {
			if ( $showhome ) {
				echo '<li class="breadcrumbs__item breadcrumbs__item--current">' . $home_title . '</li>';
			}
		} // End if().
		echo '</ul>';
	}
} // End if().