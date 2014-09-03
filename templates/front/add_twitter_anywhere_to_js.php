<?php
/*
todo faire un apple plus propre du script
*/



// Add twitter anywhere
function add_twitter_anywhere() {
	if (!is_admin()) {
     	function add_twitter_any() { 
		?>
		<script src="http://platform.twitter.com/anywhere.js?id=dL7FT7DEdPwf1eZeMUcuVA&v=1" type="text/javascript"></script>
		<script type="text/javascript">
		twttr.anywhere(function (T) {
		    T.hovercards();
		  });
		</script>

	    <?php
	    }
	}
}
add_action('init', 'add_twitter_anywhere');