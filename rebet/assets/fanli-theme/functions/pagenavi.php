<?php
function of_pagenavi( $settings ) {
	$s = wp_parse_args( $settings, array(
		'range' => '5',
		'before' => '',
		'after' => '',
	) );
	$range = intval( $s['range'] );
	global $paged, $wp_query;
	if ( ! $max_page ) {
		$max_page = $wp_query->max_num_pages;
	}
	if( $max_page > 1 ) {
		echo $s['before'];
		echo '<ul class="pagination">';
		echo '';
		if( ! $paged ) {
			$paged = 1;
		}
		if( $paged != 1 ) {
			echo '<li><a href="' . get_pagenum_link(1) . '" class="extend first"> &laquo; </a></li>';
		}
		// echo '<li>';
		// previous_posts_link( ' &lsaquo; ' );
		// echo '</li>';
		if( $max_page > $range ) {
			if( $paged < $range ) {
				for( $i = 1; $i <= ( $range + 1 ); $i++ ) {
					$classes = array( 'page' );
					$href = get_pagenum_link($i);
					if( $i == $paged )
						$classes[] = 'active';
					printf( '<li><a href="%s" class="%s">%s</a></li>', $href, implode( ' ', $classes ), $i );
				}
				echo '<li class="disable"><a href="javascript:;">...</a></li>';
			} elseif( $paged >= ( $max_page - ceil( ( $range/2 ) ) ) ) {
				echo '<li class="disable"><a href="javascript:;">...</a></li>';
				for( $i = $max_page - $range; $i <= $max_page; $i++ ) {
					$classes = array( 'page' );
					$href = get_pagenum_link($i);
					if( $i == $paged )
						$classes[] = 'active';
					printf( '<li><a href="%s" class="%s">%s</a></li>', $href, implode( ' ', $classes ), $i );
				}
			} elseif( $paged >= $range && $paged < ( $max_page - ceil( ( $range/2 ) ) ) ) {
				echo '<li class="disable"><a href="javascript:;">...</a></li>';
				for( $i = ( $paged - ceil( $range/2 ) ); $i <= ( $paged + ceil( ( $range/2 ) ) ); $i++ ) {
					$classes = array( 'page' );
					$href = get_pagenum_link($i);
					if( $i == $paged )
						$classes[] = 'active';
					printf( '<li><a href="%s" class="%s">%s</a></li>', $href, implode( ' ', $classes ), $i );
				}
				echo '<li class="disable"><a href="javascript:;">...</a></li>';
			}
		} else {
			for( $i = 1; $i <= $max_page; $i++ ) {
				$classes = array( 'page' );
				$href = get_pagenum_link($i);
				if( $i == $paged )
					$classes[] = 'active';
				printf( '<li><a href="%s" class="%s">%s</a></li>', $href, implode( ' ', $classes ), $i );
			}
		}
		// echo '<li>';
		// next_posts_link(' &rsaquo; ');
		// echo '</li>';
		if( $paged != $max_page ) {
			echo '<li><a href="' . get_pagenum_link($max_page) . '" class="extend last"> &raquo; </a></li>';
		}
		echo '</ul><!-- .wp-pagenavi -->';
		echo $s['after'];
	}
}

function of_previous_posts_link_attributes() {
	return 'class="previouspostslink"';
}
add_filter( 'previous_posts_link_attributes', 'of_previous_posts_link_attributes' );

function of_next_posts_link_attributes() {
	return 'class="nextpostslink"';
}
add_filter( 'next_posts_link_attributes', 'of_next_posts_link_attributes' );