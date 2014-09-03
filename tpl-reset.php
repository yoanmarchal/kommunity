<?php  
/* 
Template Name: reset-password
*/
get_header() ;

?>
<div class="col-md-12">
	<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" id="lostpasswordform" name="lostpasswordform">
		<p class="username">
			<label>Identifiant ou E-mail:</label>
			<input type="text" tabindex="10" size="20" value="" class="input" id="user_login" name="user_login" />
		</p>
		<p class="submit">
			<?php do_action('login_form', 'resetpass'); ?>
			<input type="submit" tabindex="100" value="Obtenir un nouveau mot de passe" class="btn btn-primary" id="wp-submit" name="wp-submit" />
			<input type="hidden" name="redirect_to" value="/" />
			<input type="hidden" name="cookie" value="1" />
		</p>
	</form>
</div>
<?php get_footer(); ?>