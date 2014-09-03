<?php
function show_edit_button() {
  global $post,$current_user;
  wp_get_current_user();
  get_currentuserinfo();
  if ($post->post_author == $current_user->ID) {
  ?>
  <span class="link_admin">

  




    




  


	<?php echo wp_delete_post_link($post->ID); ?>
	<a class="btn btn-primary" href="<?php the_permalink() ?>" >
	 Voir
	</a>
  </span>
<?php
  }
  return false;
}
