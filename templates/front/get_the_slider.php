<?php 
function get_the_slider()
{
    global $post;
    $attachments = get_children(['post_parent' => $post->ID,
                            'post_status'      => 'inherit',
                            'post_type'        => 'attachment',
                            'post_mime_type'   => 'image',
                            'order'            => 'ASC',
                            'orderby'          => 'menu_order ID', ]);
    $nbImg = count($attachments); //on compte le nombre de photos attaché au post
    if ($nbImg > 1) { // si le nombre d'images attaché au post est superieur a 1 alors un affiche le slider
    echo '<div class="wrap"><div class="scrollbar"><div class="handle"><div class="mousearea"></div></div></div><div class="frame oneperframe" id="frame"><ul class="clearfix">';
        foreach ($attachments as $att_id => $attachment) {
            $full_img_url = wp_get_attachment_image($attachment->ID, 'large');
            ?>
			<li>
				<?php echo $full_img_url;
            ?>
			</li>
		<?php

        }
        echo '</ul><div class="controls center"><button class="btn prev"><i class="icon-chevron-left"></i> prev</button><button class="btn next">next <i class="icon-chevron-right"></i></button></div></div>';
    } else {
        the_post_thumbnail('large');
    }
}
