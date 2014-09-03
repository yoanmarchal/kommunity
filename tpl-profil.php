<?php 
/* Template Name: editer son profile */ 
?>
<?php

global $user_ID, $user_identity, $user_level, $wpdb;
if ($user_ID) {

	if($_POST) 	{
		/* esc_textarea */
		$message = "Modifications effectuées avec succès.";

		$first = esc_sql($_POST['first_name']);
		$last = esc_sql($_POST['last_name']);
		$email = esc_sql($_POST['email']);
		
		$telephone = esc_sql($_POST['tel']);
		$user_url = esc_sql($_POST['website']);

		$description = esc_sql($_POST['desc']);
		


		$facebook = esc_sql($_POST['facebook']);
		$twitter = esc_sql($_POST['twitter']);
		$google = esc_sql($_POST['google']);

		$password = esc_sql($_POST['pwd']);
		$confirm_password = esc_sql($_POST['confirm']);

		$address = $_POST['address'];
		$city = $_POST['city'];
		$postalcode = $_POST['postalcode'];
		$region = $_POST['region'];




		 // update all meta
		update_user_meta( $user_ID, 'first_name', $first );
		update_user_meta( $user_ID, 'last_name', $last );
		update_user_meta( $user_ID, 'description', $description );
		update_user_meta( $user_ID, 'tel', $telephone );

		wp_update_user( array ('ID' => $user_ID, 'user_url' => $user_url) );


		update_user_meta( $user_ID, 'facebook', $facebook );
		update_user_meta( $user_ID, 'twitter', $twitter );
		update_user_meta( $user_ID, 'google', $google );


		update_user_meta( $user_ID, 'address', $_POST['address'] );
		update_user_meta( $user_ID, 'city', $_POST['city'] );
		update_user_meta( $user_ID, 'postalcode', $_POST['postalcode'] );
		update_user_meta( $user_ID, 'region', $_POST['region'] );


		/* horaires */
		update_user_meta($user_ID, 'lundi_matin_ouverture', sanitize_text_field($_POST['lundi_matin_ouverture']));
		update_user_meta($user_ID, 'lundi_matin_fermeture', sanitize_text_field($_POST['lundi_matin_fermeture']));
		update_user_meta($user_ID, 'lundi_aprem_ouverture', sanitize_text_field($_POST['lundi_aprem_ouverture']));
		update_user_meta($user_ID, 'lundi_aprem_fermeture', sanitize_text_field($_POST['lundi_aprem_fermeture']));
		
		update_user_meta($user_ID, 'mardi_matin_ouverture', sanitize_text_field($_POST['mardi_matin_ouverture']));
		update_user_meta($user_ID, 'mardi_matin_fermeture', sanitize_text_field($_POST['mardi_matin_fermeture']));
		update_user_meta($user_ID, 'mardi_aprem_ouverture', sanitize_text_field($_POST['mardi_aprem_ouverture']));
		update_user_meta($user_ID, 'mardi_aprem_fermeture', sanitize_text_field($_POST['mardi_aprem_fermeture']));
		
		update_user_meta($user_ID, 'mercredi_matin_ouverture', sanitize_text_field($_POST['mercredi_matin_ouverture']));
		update_user_meta($user_ID, 'mercredi_matin_fermeture', sanitize_text_field($_POST['mercredi_matin_fermeture']));
		update_user_meta($user_ID, 'mercredi_aprem_ouverture', sanitize_text_field($_POST['mercredi_aprem_ouverture']));
		update_user_meta($user_ID, 'mercredi_aprem_fermeture', sanitize_text_field($_POST['mercredi_aprem_fermeture']));
		
		update_user_meta($user_ID, 'jeudi_matin_ouverture', sanitize_text_field($_POST['jeudi_matin_ouverture']));
	    update_user_meta($user_ID, 'jeudi_matin_fermeture', sanitize_text_field($_POST['jeudi_matin_fermeture']));
		update_user_meta($user_ID, 'jeudi_aprem_ouverture', sanitize_text_field($_POST['jeudi_aprem_ouverture']));
		update_user_meta($user_ID, 'jeudi_aprem_fermeture', sanitize_text_field($_POST['jeudi_aprem_fermeture']));
		
		update_user_meta($user_ID, 'vendredi_matin_ouverture', sanitize_text_field($_POST['vendredi_matin_ouverture']));
		update_user_meta($user_ID, 'vendredi_matin_fermeture', sanitize_text_field($_POST['vendredi_matin_fermeture']));
		update_user_meta($user_ID, 'vendredi_aprem_ouverture', sanitize_text_field($_POST['vendredi_aprem_ouverture']));
		update_user_meta($user_ID, 'vendredi_aprem_fermeture', sanitize_text_field($_POST['vendredi_aprem_fermeture']));
		
		update_user_meta($user_ID, 'samedi_matin_ouverture', sanitize_text_field($_POST['samedi_matin_ouverture']));
		update_user_meta($user_ID, 'samedi_matin_fermeture', sanitize_text_field($_POST['samedi_matin_fermeture']));
		update_user_meta($user_ID, 'samedi_aprem_ouverture', sanitize_text_field($_POST['samedi_aprem_ouverture']));
		update_user_meta($user_ID, 'samedi_aprem_fermeture', sanitize_text_field($_POST['samedi_aprem_fermeture']));
		
		update_user_meta($user_ID, 'dimanche_matin_ouverture', sanitize_text_field($_POST['dimanche_matin_ouverture']));
		update_user_meta($user_ID, 'dimanche_matin_fermeture', sanitize_text_field($_POST['dimanche_matin_fermeture']));
		update_user_meta($user_ID, 'dimanche_aprem_ouverture', sanitize_text_field($_POST['dimanche_aprem_ouverture']));
		update_user_meta($user_ID, 'dimanche_aprem_fermeture', sanitize_text_field($_POST['dimanche_aprem_fermeture']));




		


		if(isset($email)) {

			if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){ 

				wp_update_user( array ('ID' => $user_ID, 'user_email' => $email) ) ;

			}

			else { $message = "<div class='error col-md-12'>Veuillez rentrer une adresse mail valide.</div>"; }

		}


		if($password) {

			if (strlen($password) < 5 || strlen($password) > 15) {

				$message = "<div class='error col-md-12'>La longueur de votre mot de passe doit être compris entre 5 et 15 caractères.</div>";

				}

			//elseif( $password == $confirm_password ) {

			elseif(isset($password) && $password != $confirm_password) {

				$message = "<div class='error col-md-12'>Les deux mots de passe sont different</div>";

			} elseif ( isset($password) && !empty($password) ) {

				$update = wp_set_password( $password, $user_ID );

				$message = "<div class='infos col-md-12'>Modifications effectuées avec succès.</div>";

			}

		}
		$message = "<div class='infos col-md-12'>Modifications effectuées avec succès.</div>";


	}

}

if ($user_ID) {

	$user_info = get_userdata($user_ID);

	get_header();	?>


			   <h1 class="margin col-md-12">Editer votre compte utilisateur</h1>

			   <?php if($_POST) { 
				echo "<div id='result'><div class='message'>".$message."</div></div>";
				} ?>			
					
				<div id="profile_image" class="editor col-md-12 form-group">
					<figure>
					<?php 
					$id = $user_info->ID;
					echo get_avatar( $id, $size = '120' );
					?>
					<a href="<?php echo home_url(); ?>/edit-avatar" class="edit-img-profil">changer l'avatar</a>
					</figure>
				</div>
				<?php 
					/*
				$address = $user_info->address;
				$city = $user_info->city;
				$postalcode = $user_info->postalcode;
				$region = $user_info->address;

				if ( $address && $postalcode && $city && $region) {
				?>

				<iframe width="100%" height="310" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=<?php echo $address,"+".$city,"+".$postalcode ; ?>&amp;aq=0&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $address,"+".$city,"+".$postalcode ; ?>&amp;t=m&amp;z=14&amp;output=embed"></iframe>

				
				<?php 	
				}
				*/
				 ?>
				<form id="file-form" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" autocomplete="on">
					
					<div class="col-md-6 form-group">
						<fieldset class="form-group">
							<label>Nom:</label>
							<input type="text" name="first_name" class="text form-control" value="<?php echo $user_info->first_name; ?>" maxlength="30" 
							placeholder="Dupond"/> 
						</fieldset>

						<fieldset class="form-group">
							<label>Prénom:</label>
							<input type="text" name="last_name" class="text form-control" value="<?php echo $user_info->last_name; ?>" maxlength="30" 
							placeholder="Pierre"/>
						</fieldset>

						<fieldset class="form-group">
							<label>Email:</label>
							<input type="text" name="email" class="email form-control" value="<?php echo $user_info->user_email; ?>" maxlength="30" 
							placeholder="pierre.dupond@gmail.com" autocomplete="off"/>
						</fieldset>

						<fieldset class="form-group">
							<label>Téléphone:</label>
							<input type="text" name="tel" class="text form-control" value="<?php echo $user_info->tel; ?>"
							placeholder=""/>
						</fieldset>
					</div>

					<div class="col-md-6 form-group">
						<fieldset class="form-group">
							<label>Site web:</label>
							<input type="url" name="website" class="text form-control" value="<?php echo $user_info->user_url; ?>" 
							placeholder="http://pierre-dupond.fr"/> 
						</fieldset>

						<fieldset class="form-group">
							<label>Twitter:</label>
							<input type="text" name="twitter" class="text twitter-search form-control" value="<?php echo $user_info->twitter; ?>" maxlength="30" placeholder="Indiquez uniquement votre identifiant twitter sans @" />
						</fieldset>

						<fieldset class="form-group">
							<label for="facebook">Facebook:</label>
							<input type="text" name="facebook" class="text form-control" value="<?php echo $user_info->facebook; ?>" maxlength="40" placeholder="Indiquez uniquement votre identifiant facebook" /> 
						</fieldset>


						<fieldset class="form-group">
							<label for="google">Google + :</label>
							<input type="text" name="google" class="text form-control" value="<?php echo $user_info->google; ?>" maxlength="30" placeholder="Indiquez uniquement votre identifiant google +" /> 
							<span class="grey">Ex : <b>117921345090839524338</b> </span>
						</fieldset>


						
					</div>

					<div class="col-md-12">
					<fieldset class="form-group">
						<label>Description:</label>
						<?php 
						$editor_id = 'desc';
						$args = array(     		
				                'wpautop' => true, // use wpautop?
							    'media_buttons' => false, // show insert/upload button(s)
							    'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
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
				            );


	            			wp_editor(stripslashes( $user_info->description ), $editor_id, $args);
				        ?>

					</fieldset>
					</div>
					<hr>

					<!-- Localitée -->
					<h2 class="col-md-12 form-group"><?php _e('Localite', 'Kommunity'); ?></h2>
					<div class="col-md-6 ">
						<fieldset class="form-group">
							<label for="address"><?php _e("Adresse", 'Kommunity'); ?></label>
							<input type="text" name="address" id="address" value="<?php echo $user_info->address; ?>" class="regular-text form-control" 
							placeholder="25, rue du puit" />
							<p class="help-block"><?php _e("Veuillez saisir votre adresse.", 'Kommunity'); ?></p>
						</fieldset>

						<fieldset class="form-group">
							<label for="city" class=""><?php _e("Ville", 'Kommunity'); ?></label>
							<input type="text" name="city" id="city" value="<?php echo $user_info->city; ?>" class="regular-text form-control" placeholder="Paris"/>
							<p class="help-block"><?php _e("Veuillez saisir votre ville.", 'Kommunity'); ?></p>
						</fieldset>
					</div>


					<div class="col-md-6">				
						<fieldset class="form-group">
							<label for="postalcode"><?php _e("Code postal", 'Kommunity'); ?></label>
							<input type="text" name="postalcode" id="postalcode" value="<?php echo $user_info->postalcode; ?>" class="regular-text form-control" placeholder="75000"/>
							<p class="help-block"><?php _e("Veuillez saisir votre code postal.", 'Kommunity'); ?></p>
						</fieldset>

						<fieldset class="form-group">
							<label for="region"><?php _e("Region", 'Kommunity'); ?></label>
							<input type="text" name="region" id="region" value="<?php echo $user_info->region; ?>" class="regular-text form-control" placeholder="Ile de France" />
							<p class="help-block"><?php _e("Veuillez saisir votre region.", 'Kommunity'); ?></p>
						</fieldset>
					</div>
					<!-- end : Localitée -->

					<h2 class="col-md-12"><?php _e("Horaires", 'Kommunity'); ?></h2>
					<div class="col-md-6">

						<fieldset class="form-group ">
					  	<!--lundi-->
							<label class="">Lundi</label>
							<div class="form-inline">
								<div class="form-group">
									<input type="text" name="lundi_matin_ouverture" id="lundi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr( get_the_author_meta( 'lundi_matin_ouverture', $user_ID ) ); ?>" class="col-md-3" />
									<input type="text" name="lundi_matin_fermeture" id="lundi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr( get_the_author_meta( 'lundi_matin_fermeture', $user_ID ) ); ?>" class="col-md-3" />

							  
									<input type="text" name="lundi_aprem_ouverture" id="lundi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr( get_the_author_meta( 'lundi_aprem_ouverture', $user_ID ) ); ?>" class="col-md-3" />
									<input type="text" name="lundi_aprem_fermeture" id="lundi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr( get_the_author_meta( 'lundi_aprem_fermeture', $user_ID ) ); ?>" class="col-md-3" />
								</div>
							</div>
						</fieldset>

						  
						<fieldset class="form-group">
						  <!--mardi-->
						  	<label class="">Mardi</label>
						  	<div class="form-inline">
								<div class="form-group">
									<input type="text" name="mardi_matin_ouverture" id="mardi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr( get_the_author_meta( 'mardi_matin_ouverture', $user_ID ) ); ?>" class="col-md-3" />
									<input type="text" name="mardi_matin_fermeture" id="mardi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr( get_the_author_meta( 'mardi_matin_fermeture', $user_ID ) ); ?>" class="col-md-3" />
						  
									<input type="text" name="mardi_aprem_ouverture" id="mardi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr( get_the_author_meta( 'mardi_aprem_ouverture', $user_ID ) ); ?>" class="col-md-3" />
									<input type="text" name="mardi_aprem_fermeture" id="mardi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr( get_the_author_meta( 'mardi_aprem_fermeture', $user_ID ) ); ?>" class="col-md-3" />
								</div>
							</div>
						</fieldset>

						<fieldset class="form-group">						  
							<!--mercredi-->
							<label class="">Mercredi</label>
						  	<div class="form-inline">
								<div class="form-group">
								<input type="text" name="mercredi_matin_ouverture" id="mercredi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr( get_the_author_meta( 'mercredi_matin_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="mercredi_matin_fermeture" id="mercredi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr( get_the_author_meta( 'mercredi_matin_fermeture', $user_ID ) ); ?>" class="col-md-3" />
						  
								<input type="text" name="mercredi_aprem_ouverture" id="mercredi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr( get_the_author_meta( 'mercredi_aprem_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="mercredi_aprem_fermeture" id="mercredi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr( get_the_author_meta( 'mercredi_aprem_fermeture', $user_ID ) ); ?>" class="col-md-3" />
								</div>
							</div>
						</fieldset>

						<fieldset class="form-group">						  
							<!--jeudi-->
							<label class="">Jeudi</label>
							<div class="form-inline">
								<div class="form-group">
								<input type="text" name="jeudi_matin_ouverture" id="jeudi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr( get_the_author_meta( 'jeudi_matin_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="jeudi_matin_fermeture" id="jeudi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr( get_the_author_meta( 'jeudi_matin_fermeture', $user_ID ) ); ?>" class="col-md-3" />
						  
								<input type="text" name="jeudi_aprem_ouverture" id="jeudi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr( get_the_author_meta( 'jeudi_aprem_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="jeudi_aprem_fermeture" id="jeudi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr( get_the_author_meta( 'jeudi_aprem_fermeture', $user_ID ) ); ?>" class="col-md-3" />
								</div>
							</div>
						</fieldset>
					</div>

					<div class="col-md-6">
						<fieldset class="form-group">						  
							<!--vendredi-->
							<label class="">Vendredi</label>
							<div class="form-inline">
								<div class="form-group">
								<input type="text" name="vendredi_matin_ouverture" id="vendredi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr( get_the_author_meta( 'vendredi_matin_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="vendredi_matin_fermeture" id="vendredi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr( get_the_author_meta( 'vendredi_matin_fermeture', $user_ID ) ); ?>" class="col-md-3" />
						  
								<input type="text" name="vendredi_aprem_ouverture" id="vendredi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr( get_the_author_meta( 'vendredi_aprem_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="vendredi_aprem_fermeture" id="vendredi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr( get_the_author_meta( 'vendredi_aprem_fermeture', $user_ID ) ); ?>" class="col-md-3" />
								</div>
							</div>
						</fieldset>

						<fieldset class="form-group">						  
							<!--samedi-->
							<label class="">Samedi</label>
							<div class="form-inline">
								<div class="form-group">
								<input type="text" name="samedi_matin_ouverture" id="samedi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr( get_the_author_meta( 'samedi_matin_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="samedi_matin_fermeture" id="samedi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr( get_the_author_meta( 'samedi_matin_fermeture', $user_ID ) ); ?>" class="col-md-3" />

								<input type="text" name="samedi_aprem_ouverture" id="samedi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr( get_the_author_meta( 'samedi_aprem_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="samedi_aprem_fermeture" id="samedi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr( get_the_author_meta( 'samedi_aprem_fermeture', $user_ID ) ); ?>" class="col-md-3" />
								</div>
							</div>
						</fieldset>

						<fieldset class="form-group">						  
							<!--dimanche-->
							<label class="">Dimanche</label>
							<div class="form-inline">
								<div class="form-group">
								<input type="text" name="dimanche_matin_ouverture" id="dimanche_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr( get_the_author_meta( 'dimanche_matin_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="dimanche_matin_fermeture" id="dimanche_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr( get_the_author_meta( 'dimanche_matin_fermeture', $user_ID ) ); ?>" class="col-md-3" />

								<input type="text" name="dimanche_aprem_ouverture" id="dimanche_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr( get_the_author_meta( 'dimanche_aprem_ouverture', $user_ID ) ); ?>" class="col-md-3" />
								<input type="text" name="dimanche_aprem_fermeture" id="dimanche_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr( get_the_author_meta( 'dimanche_aprem_fermeture', $user_ID ) ); ?>" class="col-md-3" />
								</div>
							</div>
						</fieldset>
					</div>


					<fieldset class="form-group col-md-12">
						<div class="row">
							<div class="col-md-6">
								<fieldset>
									<label>Changez le mot de passe *</label>
									<input type="password" name="pwd" class="text form-control" maxlength="15" value="" autocomplete ="off"/>
								</fieldset>
							</div>

							<div class="col-md-6">
								<fieldset>
									<label>Retapez le mot de passe</label>
									<input type="password" name="confirm" class="text form-control" maxlength="15" value="" autocomplete ="off"/>
								</fieldset>
							</div>
							<p class="help-block"> *Uniquement si vous voulez changer votre mot de passe, sinon laissez les deux champs "mot de passe" vides.</p>
						</div>
					</fieldset>

					<div class="col-md-12">
						<button type="submit" class="btn" id="submit"><i class="fui-checkmark-16"></i> Valider</button>
					</div>

				</form>


<?php get_footer();
} else { 
	$redirect_to = home_url()."/login";//si non connecté -> page login
	wp_safe_redirect($redirect_to);
	exit;	
}

?>
		
<?php get_footer(); ?>