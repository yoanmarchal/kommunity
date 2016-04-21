<?php
/*
Template Name: Contact Form
*/

?>

<?php 

if (isset($_REQUEST['submitted'])):

        $admin_email = 'contact@pro87.com';

        $admin_subject = 'publicite';

        $headers = 'MIME-Version: 1.0'."\r\n";

        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

        $headers .= 'From: contact@pro87.com'."\r\n";

        $body = '<blockquote>
            Name: '.$_REQUEST['contactName'].'<br/>
            Email: '.$_REQUEST['email'].'<br/>
            Message:<br/>'.$_REQUEST['comments'].'<br/>
            <hr/>
            Remote Address: '.$_SERVER['REMOTE_ADDR'].'<br/>
            Browser: '.$_SERVER['HTTP_USER_AGENT'].'
            <hr/>
        </blockquote>';

        mail($admin_email, $admin_subject, $body, $headers);

endif;

//si le formulaire est soumis

if (isset($_POST['submitted'])) {

    //Check to see if the honeypot captcha field was filled in

    if (trim($_POST['checking']) !== '') {
        $captchaError = true;
    } else {

        //Check to make sure that the name field is not empty

        if (trim($_POST['contactName']) === '') {
            $nameError = 'Indiquez votre nom.';

            $hasError = true;
        } else {
            $name = trim($_POST['contactName']);
        }

        //Check to make sure sure that a valid email address is submitted

        if (trim($_POST['email']) === '') {
            $emailError = 'Indiquez une adresse e-mail valide.';

            $hasError = true;
        } elseif (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
            $emailError = 'Adresse e-mail invalide.';

            $hasError = true;
        } else {
            $email = trim($_POST['email']);
        }

        //Check to make sure comments were entered

        if (trim($_POST['comments']) === '') {
            $commentError = 'Entrez votre message.';

            $hasError = true;
        } else {
            if (function_exists('stripslashes')) {
                $comments = stripslashes(trim($_POST['comments']));
            } else {
                $comments = trim($_POST['comments']);
            }
        }

        //If there is no error, send the email

        if (!isset($hasError)) {
            $emailTo = 'publicite@pro87.com';

            $subject = 'Formulaire de contact de '.$name;

            @$sendCopy = trim($_POST['sendCopy']);

            $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";

            $headers = 'De : mon site <'.$emailTo.'>'."\r\n".'R&eacute;pondre &agrave; : '.$email;

            wp_mail($emailTo, $subject, $body, $headers);

            if ($sendCopy == true) {
                $subject = 'Formulaire de contact publicité';

                $headers = 'De : <publicite@pro87.com>';

                wp_mail($email, $subject, $body, $headers);
            }

            $emailSent = true;
        }
    }
} ?>


<?php get_header(); ?>

<?php 

/* si l'email as été envoyé  et ok */

if (isset($emailSent) && $emailSent == true) {
    ?>

	<div class="thanks">
		<h1>Merci, <?php $name;
    ?></h1>
		<p>Votre e-mail a &eacute;t&eacute; envoy&eacute; avec succ&egrave;s. Vous recevrez une r&eacute;ponse sous peu.</p>
	</div>

<?php 
} else {
    ?>

	<?php if (have_posts()) : ?>
	
	<?php while (have_posts()) : the_post();
    ?>
		<h1><?php the_title();
    ?></h1>
		<?php the_content();
    ?>
		
		<?php 

        /* si il y as des erreur ou un probleme de captcha */

        if (isset($hasError) || isset($captchaError)) {
            ?>
			<p class="error">Une erreur est survenue lors de l'envoi du formulaire.<p>
		<?php 
        }
    ?>

			
		<form action="<?php the_permalink();
    ?>" id="contactForm" method="post">
			<div class="ib half-width">
				<fieldset>
					<label for="contactName">Nom</label>
					<input type="text" name="contactName" id="contactName" value="<?php if (isset($_POST['contactName'])) {
    echo $_POST['contactName'];
}
    ?>" class="requiredField" />
					<?php if (isset($nameError)) {
    ?>
						<span class="error"><?php $nameError;
    ?></span> 
					<?php 
}
    ?>
				</fieldset>
			</div> 
	
			<div class="ib half-width right">
				<fieldset >
					<label for="email">E-mail</label>
					<input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) {
    echo $_POST['email'];
}
    ?>" class="requiredField email" />
					<?php if (isset($emailError)) {
    ?>
						<span class="error"><?php $emailError;
    ?></span>
					<?php 
}
    ?>
				</fieldset>
			</div>
					
			<fieldset>
				<label for="commentsText">Message</label>
				<textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField"><?php if (isset($_POST['comments'])) {
    if (function_exists('stripslashes')) {
        echo stripslashes($_POST['comments']);
    } else {
        echo $_POST['comments'];
    }
}
    ?></textarea>
				<?php if (isset($commentError)) {
    ?>
					<span class="error"><?php $commentError;
    ?></span> 
				<?php 
}
    ?>
			</fieldset>
				
			
			<fieldset>
				<input class="v-middle"  type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if (isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) {
    echo ' checked="checked"';
}
    ?> />
				<label class="ib" for="sendCopy">Recevoir une copie du message</label>
			</fieldset>

			<fieldset class="ivfield">
				<label for="checking" class="screenReader">Pour envoyer ce formulaire, ne saisissez RIEN dans ce champ</label>
				<input type="text" name="checking" id="checking" class="screenReader" value="<?php if (isset($_POST['checking'])) {
    echo $_POST['checking'];
}
    ?>" />
			</fieldset>
				
			<fieldset>
				<input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit">Envoyer</button>
			</fieldset>

		</form>
	
		<?php endwhile;
    ?>
	<?php endif;
    ?>
<?php 
} ?>

<?php get_footer(); ?>