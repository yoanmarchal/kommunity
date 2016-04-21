<?php
function get_the_video()
{
    global $post;
            // Get the video URL and put it in the $video variable
            $video_url = get_post_meta($post->ID, '_url_video', true);
            // Check if there is in fact a video URL
            if ($video_url) {
                echo '<span id="video">';
                // Echo the embed code via oEmbed
                echo wp_oembed_get($video_url, ['width' => 848]);
                echo '</span>';
            }
    ?>
		<meta itemprop="thumbnail" content="<?php wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>">
		<?php

}
