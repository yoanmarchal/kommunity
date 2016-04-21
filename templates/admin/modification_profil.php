<?php

/* ajoute des champs a la page profil  -> backend */
function add_contact_field_methods()
{

    /* Ajouter des champs */
    $contact['tel'] = 'Téléphone';
    $contact['twitter'] = 'Twitter @';
    $contact['facebook'] = 'Facebook @';
    $contact['gplus'] = 'Google Plus';

    return $contact;
}

add_filter('user_contactmethods', 'add_contact_field_methods', 75, 1);

function add_adress_to_profil($user)
{
    ?>

		<h3><?php _e('Adresse', 'Kommunity');
    ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="address"><?php _e('Addresse', 'Kommunity');
    ?></label></th>
				<td>
					<input type="text" name="address" id="address" value="<?php echo esc_attr(get_the_author_meta('address', $user->ID));
    ?>" class="regular-text" /><br />
					<span class="description"><?php _e('Veuillez saisir votre adresse.', 'Kommunity');
    ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="city"><?php _e('Ville', 'Kommunity');
    ?></label></th>
				<td>
					<input type="text" name="city" id="city" value="<?php echo esc_attr(get_the_author_meta('city', $user->ID));
    ?>" class="regular-text" /><br />
					<span class="description"><?php _e('Veuillez saisir votre ville.', 'Kommunity');
    ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="postalcode"><?php _e('Code Postal', 'Kommunity');
    ?></label></th>
				<td>
					<input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr(get_the_author_meta('postalcode', $user->ID));
    ?>" class="regular-text" /><br />
					<span class="description"><?php _e('Veuillez saisir votre code postal.', 'Kommunity');
    ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="region"><?php _e('Region', 'Kommunity');
    ?></label></th>
				<td>
					<input type="text" name="region" id="region" value="<?php echo esc_attr(get_the_author_meta('region', $user->ID));
    ?>" class="regular-text" /><br />
					<span class="description"><?php _e('Veuillez saisir votre region.', 'Kommunity');
    ?></span>
				</td>
			</tr>
		</table>
<?php 
}

add_action('show_user_profile', 'add_adress_to_profil', 76, 1); //Add Some Action
add_action('edit_user_profile', 'add_adress_to_profil', 76, 1);

function wp_save_adress_profil($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    } //User Auth

        update_user_meta($user_id, 'address', $_POST['address']);
    update_user_meta($user_id, 'city', $_POST['city']);
    update_user_meta($user_id, 'postalcode', $_POST['postalcode']);
    update_user_meta($user_id, 'region', $_POST['region']);
}

add_action('personal_options_update', 'wp_save_adress_profil');
add_action('edit_user_profile_update', 'wp_save_adress_profil');

function add_horaires_to_profil($user)
{
    ?>
		<h3><?php _e('Horaire', 'Kommunity');
    ?></h3>

		  <!--lundi-->
<label class="h-ind">Lundi</label>
<input type="text" name="lundi_matin_ouverture" id="lundi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr(get_the_author_meta('lundi_matin_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="lundi_matin_fermeture" id="lundi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr(get_the_author_meta('lundi_matin_fermeture', $user->ID));
    ?>" style="width:50px;" />

<input type="text" name="lundi_aprem_ouverture" id="lundi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr(get_the_author_meta('lundi_aprem_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="lundi_aprem_fermeture" id="lundi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr(get_the_author_meta('lundi_aprem_fermeture', $user->ID));
    ?>" style="width:50px;" /><br>


<!--mardi-->
<label class="h-ind">Mardi</label>
<input type="text" name="mardi_matin_ouverture" id="mardi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr(get_the_author_meta('mardi_matin_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="mardi_matin_fermeture" id="mardi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr(get_the_author_meta('mardi_matin_fermeture', $user->ID));
    ?>" style="width:50px;" />

<input type="text" name="mardi_aprem_ouverture" id="mardi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr(get_the_author_meta('mardi_aprem_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="mardi_aprem_fermeture" id="mardi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr(get_the_author_meta('mardi_aprem_fermeture', $user->ID));
    ?>" style="width:50px;" /><br>

<!--mercredi-->
<label class="h-ind">Mercredi</label>
<input type="text" name="mercredi_matin_ouverture" id="mercredi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr(get_the_author_meta('mercredi_matin_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="mercredi_matin_fermeture" id="mercredi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr(get_the_author_meta('mercredi_matin_fermeture', $user->ID));
    ?>" style="width:50px;" />

<input type="text" name="mercredi_aprem_ouverture" id="mercredi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr(get_the_author_meta('mercredi_aprem_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="mercredi_aprem_fermeture" id="mercredi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr(get_the_author_meta('mercredi_aprem_fermeture', $user->ID));
    ?>" style="width:50px;" /><br>

<!--jeudi-->
<label class="h-ind">Jeudi</label>
<input type="text" name="jeudi_matin_ouverture" id="jeudi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr(get_the_author_meta('jeudi_matin_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="jeudi_matin_fermeture" id="jeudi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr(get_the_author_meta('jeudi_matin_fermeture', $user->ID));
    ?>" style="width:50px;" />

<input type="text" name="jeudi_aprem_ouverture" id="jeudi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr(get_the_author_meta('jeudi_aprem_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="jeudi_aprem_fermeture" id="jeudi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr(get_the_author_meta('jeudi_aprem_fermeture', $user->ID));
    ?>" style="width:50px;" /><br>

<!--vendredi-->
<label class="h-ind">Vendredi</label>
<input type="text" name="vendredi_matin_ouverture" id="vendredi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr(get_the_author_meta('vendredi_matin_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="vendredi_matin_fermeture" id="vendredi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr(get_the_author_meta('vendredi_matin_fermeture', $user->ID));
    ?>" style="width:50px;" />

<input type="text" name="vendredi_aprem_ouverture" id="vendredi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr(get_the_author_meta('vendredi_aprem_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="vendredi_aprem_fermeture" id="vendredi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr(get_the_author_meta('vendredi_aprem_fermeture', $user->ID));
    ?>" style="width:50px;" /><br>

<!--samedi-->
<label class="h-ind">Samedi</label>
<input type="text" name="samedi_matin_ouverture" id="samedi_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr(get_the_author_meta('samedi_matin_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="samedi_matin_fermeture" id="samedi_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr(get_the_author_meta('samedi_matin_fermeture', $user->ID));
    ?>" style="width:50px;" />

<input type="text" name="samedi_aprem_ouverture" id="samedi_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr(get_the_author_meta('samedi_aprem_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="samedi_aprem_fermeture" id="samedi_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr(get_the_author_meta('samedi_aprem_fermeture', $user->ID));
    ?>" style="width:50px;" /><br>

<!--dimanche-->
<label class="h-ind">Dimanche</label>
<input type="text" name="dimanche_matin_ouverture" id="dimanche_matin_ouverture" placeholder="08:00" value="<?php echo esc_attr(get_the_author_meta('dimanche_matin_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="dimanche_matin_fermeture" id="dimanche_matin_fermeture" placeholder="12:00" value="<?php echo esc_attr(get_the_author_meta('dimanche_matin_fermeture', $user->ID));
    ?>" style="width:50px;" />

<input type="text" name="dimanche_aprem_ouverture" id="dimanche_aprem_ouverture" placeholder="14:00" value="<?php echo esc_attr(get_the_author_meta('dimanche_aprem_ouverture', $user->ID));
    ?>" style="width:50px;" />
<input type="text" name="dimanche_aprem_fermeture" id="dimanche_aprem_fermeture" placeholder="18:00" value="<?php echo esc_attr(get_the_author_meta('dimanche_aprem_fermeture', $user->ID));
    ?>" style="width:50px;" /><br>

<?php 
}

add_action('show_user_profile', 'add_horaires_to_profil', 76, 1); //Add Some Action
add_action('edit_user_profile', 'add_horaires_to_profil', 76, 1);

function wp_save_horaires_profil($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    } //User Auth

        update_user_meta($user_id, 'lundi_matin_ouverture', sanitize_text_field($_POST['lundi_matin_ouverture']));
    update_user_meta($user_id, 'lundi_matin_fermeture', sanitize_text_field($_POST['lundi_matin_fermeture']));
    update_user_meta($user_id, 'lundi_aprem_ouverture', sanitize_text_field($_POST['lundi_aprem_ouverture']));
    update_user_meta($user_id, 'lundi_aprem_fermeture', sanitize_text_field($_POST['lundi_aprem_fermeture']));

    update_user_meta($user_id, 'mardi_matin_ouverture', sanitize_text_field($_POST['mardi_matin_ouverture']));
    update_user_meta($user_id, 'mardi_matin_fermeture', sanitize_text_field($_POST['mardi_matin_fermeture']));
    update_user_meta($user_id, 'mardi_aprem_ouverture', sanitize_text_field($_POST['mardi_aprem_ouverture']));
    update_user_meta($user_id, 'mardi_aprem_fermeture', sanitize_text_field($_POST['mardi_aprem_fermeture']));

    update_user_meta($user_id, 'mercredi_matin_ouverture', sanitize_text_field($_POST['mercredi_matin_ouverture']));
    update_user_meta($user_id, 'mercredi_matin_fermeture', sanitize_text_field($_POST['mercredi_matin_fermeture']));
    update_user_meta($user_id, 'mercredi_aprem_ouverture', sanitize_text_field($_POST['mercredi_aprem_ouverture']));
    update_user_meta($user_id, 'mercredi_aprem_fermeture', sanitize_text_field($_POST['mercredi_aprem_fermeture']));

    update_user_meta($user_id, 'jeudi_matin_ouverture', sanitize_text_field($_POST['jeudi_matin_ouverture']));
    update_user_meta($user_id, 'jeudi_matin_fermeture', sanitize_text_field($_POST['jeudi_matin_fermeture']));
    update_user_meta($user_id, 'jeudi_aprem_ouverture', sanitize_text_field($_POST['jeudi_aprem_ouverture']));
    update_user_meta($user_id, 'jeudi_aprem_fermeture', sanitize_text_field($_POST['jeudi_aprem_fermeture']));

    update_user_meta($user_id, 'vendredi_matin_ouverture', sanitize_text_field($_POST['vendredi_matin_ouverture']));
    update_user_meta($user_id, 'vendredi_matin_fermeture', sanitize_text_field($_POST['vendredi_matin_fermeture']));
    update_user_meta($user_id, 'vendredi_aprem_ouverture', sanitize_text_field($_POST['vendredi_aprem_ouverture']));
    update_user_meta($user_id, 'vendredi_aprem_fermeture', sanitize_text_field($_POST['vendredi_aprem_fermeture']));

    update_user_meta($user_id, 'samedi_matin_ouverture', sanitize_text_field($_POST['samedi_matin_ouverture']));
    update_user_meta($user_id, 'samedi_matin_fermeture', sanitize_text_field($_POST['samedi_matin_fermeture']));
    update_user_meta($user_id, 'samedi_aprem_ouverture', sanitize_text_field($_POST['samedi_aprem_ouverture']));
    update_user_meta($user_id, 'samedi_aprem_fermeture', sanitize_text_field($_POST['samedi_aprem_fermeture']));

    update_user_meta($user_id, 'dimanche_matin_ouverture', sanitize_text_field($_POST['dimanche_matin_ouverture']));
    update_user_meta($user_id, 'dimanche_matin_fermeture', sanitize_text_field($_POST['dimanche_matin_fermeture']));
    update_user_meta($user_id, 'dimanche_aprem_ouverture', sanitize_text_field($_POST['dimanche_aprem_ouverture']));
    update_user_meta($user_id, 'dimanche_aprem_fermeture', sanitize_text_field($_POST['dimanche_aprem_fermeture']));
}

add_action('personal_options_update', 'wp_save_horaires_profil');
add_action('edit_user_profile_update', 'wp_save_horaires_profil');

/* fin profil */
