<?php

// Delete from Front-End Link
function wp_delete_post_link($link = 'Supprimer', $before = '', $after = '', $title = 'Mettre ce post à la corbeille', $cssClass = 'ajax_delete_post btn btn-primary')
{
    global $post;
    if ($post->post_type == 'page') {
        if (!current_user_can('delete_pages', $post->ID)) {
            return;
        }
    } else {
        if (!current_user_can('delete_posts', $post->ID)) {
            return;
        }
    }
    $ico = '&times;';
    $delLink = wp_nonce_url(get_bloginfo('wpurl').'/wp-admin/post.php?action=delete&post='.$post->ID, 'delete-post_'.$post->ID);
    $link = '<a type="button" id="'.$post->ID.'" class=" '.$cssClass.'" href="'.$delLink.'"  title="'.$title.'" />'.$ico.' Supprimer</a>';

    return $before.$link.$after;
}
