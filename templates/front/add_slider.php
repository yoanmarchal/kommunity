<?php
// Add superzised
function super_zised() {
	if (!is_admin()) {
     	function add_supaslider() { 
		?>
	    	<script type="text/javascript">
	    	jQuery(document).ready(function() {
		    	$("#slider").responsiveSlides({
				auto: false,
				pager: false,
				nav: true,
				speed: 500,
			  });
		    });

    		</script><?php
	    }
	}
}
add_action('init', 'super_zised');

// Add superzised
function gallerie_responsive() {
	if (!is_admin()) {
     	function add_home_slider() { 
		?>
	    	<script type="text/javascript">
	    	jQuery(document).ready(function() {
		    	$("#slider").responsiveSlides({
				auto: true,
				pager: false,
				nav: true,
				speed: 500,
			  });
		    });

    		</script><?php
	    }
	}
}
add_action('init', 'gallerie_responsive');