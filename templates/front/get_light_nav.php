<?php
function get_light_nav() {
global $post;
?>
<nav class="navbar navbar-default full no-radius primary-color-background ">
		<ul class="nav navbar-nav">
			<?php include (TEMPLATEPATH . '/share.php'); ?>
			<li>
				<a href="#" class="btn">
					<i class="fa fa-line-chart"> <?php 
						/* incrementation du nombre de vue*/
						wpb_set_post_views(get_the_ID());
						echo wpb_get_post_views(get_the_ID());
					?></i>
					
				</a>
					
			</li>
			<li>
				<a class="btn" href="mailto:support@pubforyou.com?subject=pubforyou.com | Erreur dans l'article '<?php the_title_attribute(); ?>'&body=Bonjour :) %0AVoici l'erreur que j'ai trouvé...%0A%0A%0A%0A%0A-------%0ALien de l'article : <?php the_permalink() ?>" title="Signaler une erreur dans l'article '<?php the_title_attribute(); ?>'">
					<i class="fa fa-exclamation-triangle"> </i><span>	Signaler une erreur</span>
				</a>
			</li>
		</ul>	
</nav>
<?php
}