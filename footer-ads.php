<?php 
/*  footer-ads  */ ?> 
<section class="col-md-12 add-top hidden-xs">
	<section class="pubfull">
		<?php if (of_get_option('pub_bottom_sidebar')) {
    ?>
        	<img src="<?php echo of_get_option('pub_bottom_sidebar');
    ?>" />
        <?php 
} else {
    ?>
        	<img src="http://placehold.it/1140x180" alt="pub">
        <?php

} ?>
	</section>
</section>