<?php /* Template Name: voir mes bons plans */ ?>
<?php get_header(); ?>
<?php if ( is_user_logged_in() ) { ?>
	<!-- #primary BEGIN -->
	<div id="primary" class="col-md-12">
	<h1>Mes bons plans</h1>
	<div class="row">
		<nav class="form col-md-3 hidden-xs" >
			<div class="add-top" data-spy="affix" data-offset-top="60" data-offset-bottom="200">
				<ul class="list-unstyled">
					<li class="add-top"><a id="open-bp-form" class="btn" href="#"><i class="fa fa-plus"></i> Ajouter un bon plan</a></li>
					<li class="add-top">
						<label class="share-label" for="showhoraire"><i class="fa fa-clock-o"></i></label>
						<input type="checkbox" class="js-switch" id="showhoraire" />
					</li>
					<li class="add-top">
						<label class="share-label" for="showadress"><i class="fa fa-map-marker"></i></label>
						<input type="checkbox" class="js-switch" id="showadress"  />
					</li>
				</ul>
			</div>
		</nav>


		<div id="primary-form-bp" class="col-md-9 col-xs-12">
			<form action="<?php echo add_query_arg('do', 'add_bonplan'); ?>" id="primaryPostForm" method="POST" role="form" enctype="multipart/form-data">
				<fieldset class="form-group">
					<label for="postTitle">Titre</label>
					<input type="text" name="postTitle" id="postTitle" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" class="form-control required" placeholder="Titre"/>
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
						    'editor_class' => 'form-control', // add extra class(es) to the editor textarea
						    'teeny' => false, // output the minimal editor config used in Press This
						    'dfw' => true, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
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

				

				<fieldset class="images-field-container row form-group">
					<fieldset class="col-md-4 ">
						<label for="thumbnail">Image</label>
						<input type="file" class="preview-img" name="thumbnail-0" id="thumbnail-0" multiple="multiple" class="required" >
					</fieldset>
					<fieldset class="col-md-4" id="add-image">
							<a class="btn table-cell v-center" href="#" id="add_input_image_field"><i class="fa fa-plus"></i> Ajouter une image</a> 
					</fieldset>

				</fieldset>
				<span class="clear"></span>



				<div id="localisation-box">
					<h2>Localité</h2>
					<fieldset class="form-group">
						<label for="rue">Rue</label>
						<input type="text" name="rue" id="rue" placeholder="Entrez ici nom et numéro de rue " value="<?php if(isset($_POST['rue'])) echo $_POST['rue'];?>" class="form-control" />
					</fieldset>
					
					<fieldset class="form-group">
						<label for="postal-code">Code postal</label>
						<input type="number" step="1"  name="postal-code" id="postal-code" placeholder="87000" value="<?php if(isset($_POST['postal-code'])) echo $_POST['postal-code'];?>" class="form-control"/>
					</fieldset>


					<fieldset class="form-group">
						<label for="ville">Ville</label>
						<input type="text" name="ville" id="ville" placeholder="Entrez ici le nom de la ville" value="<?php if(isset($_POST['ville'])) echo $_POST['ville'];?>" class="form-control" />
					</fieldset>
					
					<fieldset class="form-group">
						<label for="region_selection">Indiquez votre région :</label>
						<select data-template="#dropdown" id="region_selection" name="region_selection" class="form-control">
							<option value="alsace">Alsace</option>
							<option value="aquitaine">Aquitaine</option>
							<option value="auvergne">Auvergne</option>
							<option value="bourgogne">Bourgogne</option>
							<option value="bretagne">Bretagne</option>
							<option value="centre">Centre</option>
							<option value="champagne-ardenne">Champagne-Ardenne</option>
							<option value="corse">Corse</option>
							<option value="franche-comte">Franche-Comté</option>
							<option value="guadeloupe">Guadeloupe</option>
							<option value="guyane">Guyane</option>
							<option value="ile-de-france">Île-de-France</option>
							<option value="languedoc-roussillon">Languedoc-Roussillon</option>
							<option value="limousin">Limousin</option>
							<option value="lorraine">Lorraine</option>
							<option value="martinique">Martinique</option>
							<option value="mayotte">Mayotte</option>
							<option value="midi-Pyrenees">Midi Pyrénées</option>
							<option value="nord-pas-de-calais">Nord-Pas-de-Calais</option>
							<option value="basse-normandie">Basse-Normandie</option>
							<option value="haute-normandie">Haute-Normandie</option>
							<option value="pays-de-la-loire">Pays de la Loire</option>
							<option value="picardie">Picardie</option>
							<option value="poitou-charentes">Poitou-Charentes</option>
							<option value="provence-alpes-cote-d-azur">Provence-Alpes-Côte d\'Azur</option>
							<option value="la-reunion">La Réunion</option>
							<option value="rhone-alpes">Rhône-Alpes</option>
						</select>
					</fieldset>
				</div>

				<div id="horaire-box">
					<div class="row">
						<h2 class="col-md-12">Horaires du bon plan</h2>
						<fieldset class="form-group col-md-6">
							<label for="startDate">Début date</label>
							<input type="date" name="startDate" id="startDate" class="date form-control" value="<?php if(isset($_POST['startDate'])) echo $_POST['startDate'];?>" />
						</fieldset>

						<fieldset class="form-group col-md-6">
							<label for="startHour">Début heure</label>
							<input type="time" name="startHour" id="startHour" placeholder="12:00" value="<?php if(isset($_POST['startHour'])) echo $_POST['startHour'];?>" class="form-control" />
						</fieldset>

						<fieldset class="form-group col-md-6">
							<label for="endDate">Fin date</label>
							<input type="date" name="endDate" id="endDate" class="date form-control" value="<?php if(isset($_POST['endDate'])) echo $_POST['endDate'];?>" />
						</fieldset>

						<fieldset class="form-group col-md-6">
							<label for="endHour">Fin heure</label>
							<input type="time" name="endHour" id="endHour" class="form-control" placeholder="12:00" value="<?php if(isset($_POST['endHour'])) echo $_POST['endHour'];?>" />
						</fieldset>
					</div>
				</div>
				
				<fieldset class="form-group">
					<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
					<input type="hidden" name="submitted" id="submitted" value="true" />
					<button type="submit" class="btn btn-large"><i class="fa fa-check"></i> Envoyer</button>
				</fieldset>

			</form>
			<hr>
			<div class="clearfix"></div>
				<ul class="list-unstyled">
					<?php
						$current_user = wp_get_current_user();
						$home_paged = (get_query_var('paged'));
						$arguments = array(
						'post_type' => 'bonplan',
						'author' => $current_user->ID,
						'posts_per_page' =>'-1',
						'post_status' => array(
							'publish',
							'pending',
							'draft',
							'private')
						 );
						query_posts($arguments);
						get_template_part( 'loop', 'bonplan' );
					?>
				</ul>
			</div>
		</div>
	
	</div><!-- #primary END -->
<?php
}else {	?>
 <h1 class="col-md-12">Vous devez vous connecté pour pouvoir editer quoi que ce soit</h1>
<?php } ?>
<?php get_footer(); ?>