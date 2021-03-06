<?php

//Modification liste commentaires

// commentaires

function show_portfolio_comments($post_ID)
{
    // NOT approved
    $comments_unapproved = get_comments(['status' => 'hold', 'post_id' => $post_ID]);
    foreach ($comments_unapproved as $comments) {
        if (current_user_can('edit_published_posts')) {
            ?>
      <div class="comment">
         <h4>Unapproved Comments on your portfolio</h4>
         <div class="comment-author"><?php echo $comment->comment_author;
            ?></div>
         <div class="comment-content"><?php echo $comment->comment_content;
            ?></div>
      </div>
      <?php

        } // endif; - current_user_can( 'edit_published_posts' )
    }

    // ALREADY approved
    $comments_approved = get_comments(['status' => 'approve', 'post_id' => $post_ID]);
    foreach ($comments_approved as $comments) {
        ?>
      <div class="comment">
      <?php if (current_user_can('edit_published_post')) {
    ?>
         <h4>Approved Comments on your portfolio</h4>
      <?php 
}  // endif; - current_user_can( 'edit_published_posts' )?>
         <div class="comment-author"><?php echo $comment->comment_author;
        ?></div>
         <div class="comment-content"><?php echo $comment->comment_content;
        ?></div>
      </div>
      <?php

    }
}

// change la composition des commentaires
function mytheme_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif;
    ?>
    <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) {
    echo get_avatar($comment, $args['avatar_size']);
}
    ?>
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
    </div>
<?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'Kommunity') ?></em>
    <br />
<?php endif;
    ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
      <?php

        printf(__('%1$s at %2$s', 'Kommunity'), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'Kommunity'), '  ', '');
    ?>
    </div>

    <?php comment_text() ?>

    <div class="reply">
    <?php comment_reply_link(array_merge($args, ['add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']])) ?>
    </div>
    <?php if ('div' != $args['style']) : ?>
    </div>
    <?php endif;
    ?>
<?php

}
