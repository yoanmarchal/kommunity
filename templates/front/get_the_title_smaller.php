<?php
/* genere un titre plus court pour les besoin du design */
function the_titlesmall($before = '', $after = '', $echo = true, $length = false) { $title = get_the_title();
	if ( $length && is_numeric($length) ) {
		$title = substr( $title, 0, $length );
	}

	if ( strlen($title)> 0 ) {
		$title = apply_filters('the_titlesmall', $before . $title . $after, $before, $after);
		if ( $echo )
			echo $title;
		else
			return $title;
	}
}
