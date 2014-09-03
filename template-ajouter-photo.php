<?php 
/* Template Name:ajouter une photo */

	$postTitleError = '';

	if(isset($_POST['submitted']) && isset($_POST['post_photo_nonce_field']) && wp_verify_nonce($_POST['post_photo_nonce_field'], 'post_nonce')) {

		if(trim($_POST['postTitle']) === '') {
			$postTitleError = 'Please enter a title.';
			$hasError = true;
		} else {
			$postTitle = trim($_POST['postTitle']);
		}

		$post_information = array(
			'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
			'post_content' => esc_attr(strip_tags($_POST['postContent'])),
			'post_type' => 'photo',
			'post_status' => 'publish'
		);

		$post_id = wp_insert_post($post_information);


		if($post_id)
		{
		
		}

			// IMAGE VALIDATION - CHECK IF THERE IS AN IMAGE AND THAT ITS THE RIGHT FILE TYPE AND RIGHT SIZE
		if ($_FILES) {
			foreach ($_FILES as $file => $array) {
				//Check if the $_FILES is set and if the size is > 0 (if =0 it's empty)

				if(isset($_FILES[$file]) && ($_FILES[$file]['size'] > 0)) {

					$tmpName = $_FILES[$file]['tmp_name'];
					list($width, $height, $type, $attr) = getimagesize($tmpName);

				if($width!=630 || $height!=580)
				{
					$error .= "Image is to small<br />";
					unlink($_FILES[$file]['tmp_name']); 
				}

				// Get the type of the uploaded file. This is returned as "type/extension"
                $arr_file_type = wp_check_filetype(basename($_FILES[$file]['name']));
                $uploaded_file_type = $arr_file_type['type'];

                 // Set an array containing a list of acceptable formats
                $allowed_file_types = array('image/jpg','image/jpeg','image/gif','image/png');

                 // If the uploaded file is the right format
                if(in_array($uploaded_file_type, $allowed_file_types)) {

				} else { // wrong file type
   	 			$error .= "Please upload a JPG, GIF, or PNG file<br />";
                   	 }

				} else {
				$error .= "Please add an image<br />";
				}
			} // end for each
		} // end if
	
	if (!function_exists('wp_generate_attachment_metadata')){
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	}
	if ($_FILES) {
		foreach ($_FILES as $file => $array) {
			if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
				return "upload error : " . $_FILES[$file]['error'];
			}
			$attach_id = media_handle_upload( $file, $post_id );
		}   
	}
	
	//and if you want to set that image as Post  then use:
	update_post_meta($post_id,'_thumbnail_id',$attach_id);

	
	//rediriger vers le post une fois sauvegardé
	$link = get_permalink( $post_id );
	wp_redirect( $link );

} ?>

<?php get_header(); ?>

	<!-- #primary BEGIN -->
	<div id="primary">
		<h1>Ajouter un bon plan</h1>

		<form action="" id="primaryPostForm" method="POST" enctype="multipart/form-data">

			<fieldset>

				<label for="postTitle">Titre</label>
				<input type="text" name="postTitle" id="postTitle" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" class="required" placeholder="titre"/>

			</fieldset>

			<?php if($postTitleError != '') { ?>
				<span class="error"><?php echo $postTitleError; ?></span>
				<div class="clearfix"></div>
			<?php } ?>

			<fieldset>
						
				<label for="postContent" class="ib">Description</label>
				<?php 
            			wp_editor($_POST['postContent'], 'postContent', array(     		
			                'wpautop' => true, // use wpautop?
						    'media_buttons' => true, // show insert/upload button(s)
						    'textarea_name' => postContent, // set the textarea name to something different, square brackets [] can be used here
						    'textarea_rows' => get_option('default_post_edit_rows', 5), // rows="..."
						    'tabindex' => '',
						    'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
						    'editor_class' => '', // add extra class(es) to the editor textarea
						    'teeny' => true, // output the minimal editor config used in Press This
						    'dfw' => true, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
						    'tinymce' => array(
						        'theme_advanced_buttons1' => 'bold,italic,underline,blockquote,|,undo,redo,|,fullscreen',
						        'theme_advanced_buttons2' => '',
						        'theme_advanced_buttons3' => '',
						        'theme_advanced_buttons4' => ''
   							), // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
						    'quicktags' => false // load Quicktags, can be used to pass settings directly to Quicktags using an array()
			            ));
			        ?>

			</fieldset>

			
			<fieldset class="images-field-container">

				<label for="thumbnail">Image</label>
				<input type="file" name="thumbnail" id="thumbnail" multiple="multiple">
				<a class="push_button" href="#" id="add_input_image_field"><i class="icon-plus"></i>ajouter une image</a>

			</fieldset>

			

			<fieldset>
				
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit">Envoyer</button>

			</fieldset>

		</form>

	</div><!-- #primary END -->


<?php get_footer(); ?>