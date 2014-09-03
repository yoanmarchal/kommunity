<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="alert">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<div class="left-content">
	<h3 id="comments"><?php comments_number('pas de commentaires', 'un Commentaire', '% commentaires' );?></h3>

	<ol class="commentlist">
	   <?php wp_list_comments('type=comment'); ?>
	</ol>

	<?php previous_comments_link() ?>  <?php next_comments_link() ?>

	</div>
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
	
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
	 
		<!-- If comments are closed. -->
		<p class="nocomments">Les commentaires sont fermés.</p>

	<?php endif; ?>
	
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

	<h3><?php comment_form_title( 'Faire un commentaire', 'Répondre à %s' ); ?></h3>

	<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	
	   <p>vous devez être <a href="<?php echo wp_login_url( get_permalink() ); ?>">connecté</a> pour poster un commentaire.</p>
	   
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) : ?>

		<p class="fz15">Connecté sous <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Se déconnecter &raquo;</a></p>

		<?php else : ?>

		<div class="inline-row">
		  <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		  <label for="author"><small>Nom <?php if ($req) echo "*"; ?></small></label>
        </div>

		<div class="inline-row">
		  <input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		  <label for="email"><small>Email <?php if ($req) echo "*"; ?> (ne seras pas publié) </small></label>
        </div>

		<div class="inline-row">
		  <input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
		  <label for="url"><small>Site web</small></label>
        </div>

		<?php endif; ?>
        
        <div>
		  <textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
        </div>
        
        <div class="add-top">
		  <input class="btn btn-primary" name="submit" type="submit" id="submit" tabindex="5" value="envoyer" />
		</div>
		
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>