<?php
/*
Template Name: register
*/
?>
<?php get_header(); ?>
<div id="big-login-form" class="col-md-12">
	<h1>Enregistrement</h1>
	<div class="registration-panel">
			<?php
			  if(defined('REGISTRATION_ERROR'))
			    foreach(unserialize(REGISTRATION_ERROR) as $error)
			      echo "<div class=\"error\"><i class='icon-warning-sign'></i> {$error}</div>";
			  // errors here, if any

			  elseif(defined('REGISTERED_A_USER'))
			    echo '<div class="center infos"><i class="icon-ok"></i> Un email contenant votre mot de passe à été envoyé  '.REGISTERED_A_USER.'</div>';
			?>
			<form action="<?php echo add_query_arg('do', 'register'); ?>" method="post" id="register" role="form" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label">identifiant</label>
					<div class="col-sm-10">
						<input type="text" name="user" class="form-control"  placeholder="identifiant" />
						<p class="help-block">Cet identifiant vous permettra de vous connecter par la suite.</p>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" name="email" class="form-control" placeholder="votre@email.com" />
						<p class="help-block">Vos codes d’accès seront envoyés sur votre boîte mail.</p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Valider</button>
						<?php do_action('register_form'); ?>
					</div>
				</div>
			</form>
	</div>
</div>
<?php get_footer();?>