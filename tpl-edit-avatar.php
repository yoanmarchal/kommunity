<?php /*  Template Name: edit thumbnail  */

?>

<?php get_header();
global $user_ID;
if ($user_ID) { //si un utilisateur est connecté
	$user_info = get_userdata($user_ID); // on recupere son id
	$id = $user_info->ID;
}
 ?>

	<?php
		if(defined('ADD_AVATAR_ERROR'))
		    foreach(unserialize(ADD_AVATAR_ERROR) as $error)
		      echo "<div class=\"error\"><i class='icon-warning-sign'></i> {$error}</div>";
		  // errors here, if any

		  elseif(defined('ADD_BONPLAN_LINK'))
		    echo '<div class="center infos"><i class="icon-ok"></i> Bonplan ajouté 
		<a href="'.ADD_AVATAR_MSG.'">Avatar envoyé</a></div>';
	?>

	<?php if(isset($_POST['user_avatar_edit_submit']))
	      {
	           do_action('edit_user_profile_update', $id);
	      }
	?>
	 
	<form id="your-profile" action="" method="post" class="col-md-12">

		<?php

		$myAv = new simple_local_avatars();
		$myAv->edit_user_profile($user_info);
		?>

	    <input type="submit" name="user_avatar_edit_submit" value="OK"/>
	</form>

<?php get_footer(); ?>