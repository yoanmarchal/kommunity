<?php /* Template Name: Voir mes videos */ ?>
<?php get_header(); ?>
<?php if ( is_user_logged_in() ) { ?>

	<!-- #primary BEGIN -->
	<div id="primary" class="col-md-12">
		<h1>Mes vidéos</h1>
		<a id="open-video-form" class="btn" href="#"><i class="fa fa-plus"></i> Ajouter une vidéo</a>

		<?php
		if(defined('ADD_VIDEO_ERROR'))
		    foreach(unserialize(ADD_VIDEO_ERROR) as $error)
		      echo "<div class=\"error\"><i class='icon-warning-sign'></i> {$error}</div>";
		  // errors here, if any

		  elseif(defined('ADD_VIDEO_LINK'))
		    echo '<div class="center infos"><i class="icon-ok"></i> Vidéo envoyée  
		<a href="'.ADD_VIDEO_LINK.'">Voir ma vidéo</a></div>';
		?>
		<?php
		/* Url */ 
		$url = "http://youtu.be/NW0H04iUxtsf";
		/* detection si url youtube */
		detectUrl($url);

		/* detection via pase */
		$VideoObject =  parseVideos($url);
		echo '<pre>';
		print_r($VideoObject);
		echo '</pre>';
		print $VideoObject[0]['url'];
		print $VideoObject[0]['thumbnail'];
		$bigThumb = $VideoObject[0]['fullsize'];

		$json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/". getYoutubeId($url) ."?v=2&alt=jsonc"));
		echo '<img src="' . $json->data->thumbnail->sqDefault . '">';

		?>
		<img src="<?php echo $bigThumb; ?>" />

	<!-- #primary BEGIN -->
	<div id="primary-form-video" class="add-top">
		<form action="<?php echo add_query_arg('do', 'add_video'); ?>" id="primaryPostForm" method="POST" role="form">
				<fieldset class="form-group">
					<label for="postTitle">Titre</label>
					<input type="text" name="postTitle" id="postTitle" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" class="form-control required" placeholder="Titre"/>
				</fieldset>

				<fieldset class="form-group">
					<label for="videoUrl">Vidéo</label>
					<input type="url" name="videoUrl" id="videoUrl" class="form-control required" placeholder="http://youtu.be/i3Jv9fNPjgk" value="<?php if(isset($_POST['videoUrl'])) echo $_POST['videoUrl'];?>" />
					<span class="help-block">Lien youtube ou vimeo</span>
				</fieldset>

				<fieldset class="form-group">
					<label for="postcontent" >Description</label>
					<?php 
					$args = array(     		
			                'wpautop' => true, // use wpautop?
						    'media_buttons' => false, // show insert/upload button(s)
						    'textarea_name' => 'postcontent', // set the textarea name to something different, square brackets [] can be used here
						    'textarea_rows' => get_option('default_post_edit_rows', 5), // rows="..."
						    'tabindex' => '',
						    'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
						    'editor_class' => '', // add extra class(es) to the editor textarea
						    'teeny' => false, // output the minimal editor config used in Press This
						    'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
						    'tinymce' => false, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
						    'quicktags' => false // load Quicktags, can be used to pass settings directly to Quicktags using an array()
			            );

						if(isset($_POST['postcontent'])){
							$content = $_POST['postcontent'];
						} else {
							$content = '';
						}

            			wp_editor($content, 'postcontent', $args);
			        ?>
				</fieldset>


			<fieldset class="form-group">
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit" class="btn"><i class="fui-checkmark-16"></i> Envoyer</button>
			</fieldset>
		</form>
		<hr>
	</div><!-- #primary END -->
	<ul class="list-unstyled">
		<?php
			$current_user = wp_get_current_user();
			$home_paged = (get_query_var('paged'));
			$arguments = array(
			'post_type' => 'video',
			'author' => $current_user->ID,
			'posts_per_page' =>'-1',
			'post_status' => array(
				'publish',
				'pending',
				'draft',
				'private')
			 );
			query_posts($arguments);
			get_template_part( 'loop', 'video' );
		?>
	</ul>		
</div>
<?php
}else {	?>
 <h1 class="col-md-12 ">Vous devez vous connecté pour pouvoir editer quoi que ce soit</h1>
<?php } ?>
<?php get_footer(); ?>