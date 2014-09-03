<?php 


function get_video_thumbnail_front($class) {

	global $post;
	$directory = get_template_directory_uri();
	// recuperation de l'url
	$video_url = get_post_meta($post->ID, '_url_video', true);
    // dectection youtube ou vimeo
    $video = parseVideos($video_url);
    

    if (empty($video)) { //si la transformation echoue on affiche une image standart
        $video_thumb_url = $directory.'/assets/images/base/kommunity-banner.svg';
    } else {
        $video_thumb_url = $video[0]['fullsize'];
    }
	$title = get_the_title() ;
	
	if ( $video_thumb_url ) { // if there is a video URL
		echo '<figure class="' . $class . '">';
		echo '<img src="' . $video_thumb_url . '" ';
		echo ' title="'. $title.' " ';
		echo ' alt="video '. $title.' " ';
		echo '></figure>';
	} else { // else use the standard featured image
		echo '<figure class="' . $class . '">';
		the_post_thumbnail('thumb'); 
		echo '</figure>';
	}

}


function get_the_thumbnail_front($class) {
	global $post;
	if(has_post_thumbnail()) 	{
		// il y a une miniature on l'affiche
		echo '<figure class="' . $class . '">';
		the_post_thumbnail('full');
		echo '</figure>';
	} else {

		if (get_post_type() == 'video' && is_archive()) {

			// il n'y a  pas de miniature on l'a genere ou on affiche l'image de base
			$directory = get_template_directory_uri();
			// recuperation de l'url
			$video_url = get_post_meta($post->ID, '_url_video', true);
		    // dectection youtube ou vimeo
		    $video = parseVideos($video_url);
		    

		    if (empty($video)) { 
		    	//si la transformation echoue on affiche une image standart
		        $video_thumb_url = $directory.'/assets/images/base/kommunity-banner.svg';
		    } else {
		        $video_thumb_url = $video[0]['fullsize'];
		    }
			$title = get_the_title() ;

			if ( $video_thumb_url ) { // if there is a video URL
				echo '<figure class="' . $class . '">';
				echo '<img src="' . $video_thumb_url . '" ';
				echo ' title="'. $title.' " ';
				echo ' alt="video '. $title.' " ';
				echo '></figure>';
			}
		}
	}
}