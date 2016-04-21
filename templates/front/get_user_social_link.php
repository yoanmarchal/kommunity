<?php
function get_user_social_link($curauth)
{
    $FacebookID = $curauth->facebook;
    $TwitterID = $curauth->twitter;
    $GoogleID = $curauth->google;

    $facebookUrl = 'http://www.facebook.com/';
    $twitterUrl = 'http://twitter.com/';
    $googlePlusUrl = 'http://plus.google.com/';

    if ($GoogleID || $FacebookID || $TwitterID) {
        ?>
	<div class="ib">
		<?php if ($GoogleID) {
    ?>
		<i class="icon-google-plus"> </i>
		<span class="ib" >
			<a href="<?php echo $googlePlusUrl, $GoogleID;
    ?>?rel=author"><?php echo $googlePlusUrl, $GoogleID;
    ?></a>
		</span><br>
		<?php 
}
        ?>

		<?php if ($FacebookID) {
    ?>
		<i class="icon-facebook"> </i>
		<span class="ib" >
			<a href="<?php echo $facebookUrl, $FacebookID;
    ?>">  <?php echo $facebookUrl, $FacebookID;
    ?></a>
		</span><br>
		<?php 
}
        ?>

		<?php if ($TwitterID) {
    ?>
	    <i class="icon-twitter"> </i>
	    <span class="ib" >
	    	@<?php echo $TwitterID;
    ?>
	    </span>
	    <?php 
}
        ?>

	</div>
	<?php 
    }
}
