<?php
/*
Template Name: connection
*/
$error = false;
if (!empty($_POST)) {
    $user = wp_signon($_POST);
    if (is_wp_error($user)) {
        $error = $user->get_error_message();
    } else {
        $redirect_to = home_url().'/profil'; //si non connecté -> page login
        wp_safe_redirect($redirect_to);
        exit;
        /*

        header('location:profil');
        */
    }
} else {
    $user = wp_get_current_user();
    if ($user->ID != 0) {
        header('location:profil');
    }
}
?>

<?php get_header(); ?>
<section class="col-md-12">
	<h1>Connexion</h1>

	<?php if ($error) :?>
		<div class="error">
			<?php echo $error; ?>
		</div>
	<?php endif ?>
	<div class="login-form">
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" role="form" class="form-inline">

			<fieldset class="form-group">
				<label for="user_login" class="login-field-icon fui-man-16 col-sm-2 control-label"></label>
				<div class="col-sm-10">
					<input type="text" name="user_login" id="user_login" class="login-field form-control" placeholder="Votre login">
				</div>
			</fieldset>

			<fieldset class="form-group">
				<label for="user_password" class="login-field-icon fui-lock-16 col-sm-2 control-label"></label>
				<div class="col-sm-10">
					<input type="password" name="user_password" class="login-field form-control" id="user_password" placeholder="Mot de passe">
				</div>
			</fieldset>
			<fieldset class="form-group">
				<a class="login-link" href="<?php echo wp_lostpassword_url(get_permalink()); ?>" title="Lost Password">Mot de passe oublié ?</a>
			</fieldset>

			<fieldset class="form-group">
				<button class="btn btn-primary " type="submit" >Sign in</button>
			</fieldset>
		</form>
	</div>
</section>
<?php get_footer(); ?>