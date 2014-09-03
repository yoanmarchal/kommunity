			<!--
			@todo :
			-faire un deuxieme menu  dynamique dans le footer
			-->
		</div>
	</div>
</section>
<footer id="footer" class="primary-color-background add-top">
	<section class="container">
		<section class="row">
			<section class="col-md-2">
				<section class="d-table">
					<section class="table-cell v-center">
						<a class="logo tooltips-b" title="Retour à la page d'acceuil" href="<?php echo home_url(); ?>" rel="home">
				            <?php if ( of_get_option('logo_custom') ) { ?>
				            	<img src="<?php echo of_get_option('logo_custom'); ?>" class="logo" />
				            <?php } else { ?>
				            	<img src="<?php bloginfo('template_directory'); ?>/assets/images/kommunity-logo.gif" alt="logo" class="logo">
				            <?php
				            } ?>
						</a>
					</section>
				</section>	
			</section>
			<section class="col-md-10">
				<span><?php bloginfo('name'); ?> © <?php echo date('Y');  ?> </span>
				<section class="share-box white-color ">
					<ul>
						<li><a href="<?php if ( of_get_option('facebook_url') ) {echo of_get_option('facebook_url');} ?>"><i class="icon-facebook-sign"></i>Facebook</a></li>
						<li><a href="<?php if ( of_get_option('twitter_url') ) {echo of_get_option('twitter_url');} ?>"><i class="icon-twitter-sign"></i></a>Twitter</li>
						<li><a href="<?php if ( of_get_option('pinterest_url') ) {echo of_get_option('pinterest_url');} ?>"><i class="icon-pinterest-sign"></i>Pinterest</a></li>
						<li><a href="<?php if ( of_get_option('google_plus_url') ) {echo of_get_option('google_plus_url');} ?>" rel="publisher"><i class="icon-google-plus-sign"></i>Google plus</a></li>
					</ul>
				</section>
			</section>
		</section>
	</section>
</footer> 

<!--end wrapper-->
<div id="fb-root"></div>

<!-- livereload -->
<script src="//localhost:35729/livereload.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.8.2.js"><\/script>')</script>

<!-- plugins -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/plugins.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/js/main.min.js"></script>


<?php wp_footer(); ?>



<!-- end concatenated and minified scripts-->

<!--[if lt IE 7 ]>
<script src="js/libs/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
<![endif]-->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-000000-0']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	</body>
</html>