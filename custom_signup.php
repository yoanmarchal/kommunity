<?php
/*
Template Name: Custom Wordpress Signup Page
*/

global $wpdb, $user_ID;
//Check whether the user is already logged in
if (!$user_ID) {

		if($_POST){
			//We shall SQL escape all inputs
			$username = $wpdb->escape($_POST['username']);
			if(empty($username)) { 
				echo "Le nom dois être remplit.";
				exit();
			}
			$email = $wpdb->escape($_POST['email']);
			if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) { 
				echo "Merci de'indiquer une adresse mail valide.";
				exit();
			}		
		
				$random_password = wp_generate_password( 12, false );
				$status = wp_create_user( $username, $random_password, $email );
				if ( is_wp_error($status) ) 
					echo "Le nom d'utilisateur ou le mail existe déjà. Veuillez en choisir un autre.";
				else {
					$from = get_option('admin_email');
					$headers = 'From: '.$from . "\r\n";
					$subject = "Enregistrement effectué";
					$msg = "Enregistrement effectué avec succès .\nVotre login details\nUsername: $username\nPassword: $random_password";
					wp_mail( $email, $subject, $msg, $headers );

					echo "Veuillez consultez votre email un mot de passe vous as été envoyé.";
				}

			exit();
			
		} else { 
			get_header();			
			?>
			
			
			<div id="container">
			<div id="content">
			
			<?php 					
			if(get_option('users_can_register')) { //Check whether user registration is enabled by the administrator
			?>
			
			<h1><?php the_title(); ?></h1>
			<div id="result"></div> <!-- To hold validation results -->
			<form id="wp_signup_form" action="" method="post">
			
			<label>Nom</label><br />
			<input type="text" name="username" class="text" value="" /><br />
			<label>Email</label><br />
			<input type="text" name="email" class="text" value="" /> <br />
			<br /><br />
			<input type="submit" id="submitbtn" name="submit" value="SignUp" />
			
			</form>
			

			
			<?php 
				}
	
			else echo "L'enregistrement est tempotairement désactivé veuillez reessayer plus tard.";
			?>
			
			</div>
			</div>
			<?php
			
			get_footer();
			
			
			
		} //end of if($_post)
	
}
else {
	wp_redirect( home_url() ); exit;
}
?>
			<script type="text/javascript">  						
			$("#submitbtn").click(function() {
			
			$('#result').html('<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" class="loader" />').fadeIn();
			var input_data = $('#wp_signup_form').serialize();
			$.ajax({
			type: "POST",
			url:  "<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",
			data: input_data,
			success: function(msg){
			$('.loader').remove();
			$('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');
			}
			});
			return false;
			
			});
			</script>