<?php /* Template Name: Voir mes photos */ ?>
<?php get_header(); ?>
<?php if (is_user_logged_in()) {
    ?>

	<!-- #primary BEGIN -->
	<div id="primary" class="col-md-12">
	<h1>Mes photos</h1>
	<a class="btn" id="open-photo-form" href="#primary-form-photo"><i class="fa fa-plus"></i> Ajouter une photo</a>
	<div id="primary-form-photo">
		<form action="<?php echo add_query_arg('do', 'add_photo');
    ?>" id="primaryPostForm" method="POST" enctype="multipart/form-data" role="form" class="add-top">

				<fieldset class="form-group">
					<label for="postTitle">Titre</label>
					<input type="text" name="postTitle" id="postTitle" class="form-control required" value="<?php if (isset($_POST['postTitle'])) {
    echo $_POST['postTitle'];
}
    ?>" placeholder="Titre"/>
				</fieldset>

				<fieldset class="form-group">
					<label for="postcontent" >Description</label>
					<?php 
                    $args = [
                            'wpautop'       => true, // use wpautop?
                            'media_buttons' => false, // show insert/upload button(s)
                            'textarea_name' => 'postcontent', // set the textarea name to something different, square brackets [] can be used here
                            'textarea_rows' => get_option('default_post_edit_rows', 5), // rows="..."
                            'tabindex'      => '',
                            'editor_css'    => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
                            'editor_class'  => '', // add extra class(es) to the editor textarea
                            'teeny'         => false, // output the minimal editor config used in Press This
                            'dfw'           => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                            'tinymce'       => false, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                            'quicktags'     => false, // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                        ];

    if (isset($_POST['postcontent'])) {
        $content = $_POST['postcontent'];
    } else {
        $content = '';
    }

    wp_editor($content, 'postcontent', $args);
    ?>
				</fieldset>

				<?php  /*
                // adjust values here
                $id = "primaryPostForm"; // this will be the name of form field. Image url(s) will be submitted in $_POST using this key. So if $id == “img1” then $_POST[“img1”] will have all the image urls

                $svalue = ""; // this will be initial value of the above form field. Image urls.

                $multiple = true; // allow multiple files upload

                $width = null; // If you want to automatically resize all uploaded images then provide width here (in pixels)

                $height = null; // If you want to automatically resize all uploaded images then provide height here (in pixels)
                ?>

                <label>Upload Images</label>
                <input type="hidden" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo $svalue; ?>" />
                <div class="plupload-upload-uic hide-if-no-js <?php if ($multiple): ?>plupload-upload-uic-multiple<?php endif; ?>" id="<?php echo $id; ?>plupload-upload-ui">
                    <input id="<?php echo $id; ?>plupload-browse-button" type="button" value="<?php esc_attr_e('Select Files'); ?>" class="button" />
                    <span class="ajaxnonceplu" id="ajaxnonceplu<?php echo wp_create_nonce($id . 'pluploadan'); ?>"></span>
                    <?php if ($width && $height): ?>
                            <span class="plupload-resize"></span><span class="plupload-width" id="plupload-width<?php echo $width; ?>"></span>
                            <span class="plupload-height" id="plupload-height<?php echo $height; ?>"></span>
                    <?php endif; ?>
                    <div class="filelist"></div>
                </div>
                <div class="plupload-thumbs <?php if ($multiple): ?>plupload-thumbs-multiple<?php endif; ?>" id="<?php echo $id; ?>plupload-thumbs">
                </div>
                <div class="clear"></div>

                <?php  */ ?>



				<fieldset class="images-field-container row form-group">
					<fieldset class="col-md-4 image-show">
						<label for="thumbnail">Image</label>
						<input type="file" class="preview-img form-control"  name="thumbnail-0" id="thumbnail-0" multiple="multiple" class="required" >
					</fieldset>
					<fieldset class="col-md-4" id="add-image">
							<a class="btn table-cell v-center" href="#" id="add_input_image_field"><i class="fa fa-plus"></i> Ajouter une image</a> 
					</fieldset>

				</fieldset>
				<span class="clear"></span>
	

			<fieldset class="form-group">
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit" class="btn form-control"><i class="fa fa-check"></i> Envoyer</button>
			</fieldset>
		</form>
		<hr>
	</div>


	<ul class="list-unstyled">
		<?php
            $current_user = wp_get_current_user();
    $home_paged = (get_query_var('paged'));
    $arguments = [
            'post_type'      => 'photo',
            'author'         => $current_user->ID,
            'posts_per_page' => '-1',
            'post_status'    => [
                'publish',
                'pending',
                'draft',
                'private', ],
             ];
    query_posts($arguments);
    get_template_part('loop', 'photo');
    ?>
	</ul>

	
	
	</div><!-- #primary END -->
<?php

} else {
    ?>
 <h1 class="col-md-12 ">Vous devez vous connecté pour pouvoir editer quoi que ce soit</h1>
<?php 
} ?>
<?php get_footer(); ?>