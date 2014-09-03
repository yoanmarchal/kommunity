<?php
/* ajoute un jquery scrool down sur l'erreur faite */

function add_scrool_to_error(){ 
?>
	<script type="text/javascript">
	//<![CDATA[
		$('html, body').animate(
		{
			scrollTop: $(".error").position().top
		}, 'slow');

	//]]>
	</script>
	<style type="">	#primary-form-video, #primary-form-bp, #primary-form-photo {display: block;}
	</style>
<?php
}

function add_scrool_to_infos(){ //ajoute un jquery scrool down sur l'erreur faite
?>
<script type="text/javascript">
//<![CDATA[
	$('html, body').animate(
	{
		scrollTop: $(".infos").offset().top
	}, 'slow');
//]]>
</script>
<?php
}


function notify_error($errors){ //ajoute une notification d'erreur
if(defined('SUBMISSION_ERROR'))
	foreach(unserialize(SUBMISSION_ERROR) as $error)
	    echo "<script type='text/javascript'>$(window).load(function() { toastr.error('{$error}');});</script>";
		echo "<style>#primary-form-video, #primary-form-bp, #primary-form-photo {display: block;}</style>";
}


function notify_succes($succes){ //ajoute une notification success
if(defined('SUBMISSION_LINK'))
	foreach(unserialize(SUBMISSION_LINK) as $succes)
	    echo "<script type='text/javascript'>$(window).load(function() { toastr.success('{$succes}');});</script>";
}