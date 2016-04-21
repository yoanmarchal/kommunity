<?php get_header(); ?>
<div class="error-404 col-md-12"></div>
<div class="link-home col-md-12">
<a href="<?php echo home_url(); ?>">retour à la page d'accueil</a>
<form id="search-box" name="searchform" method="get" action="<?php bloginfo('url'); ?>">
		<section id="searchMain">
			<input type="search" id="s" name="s" title="Recherchez" placeholder="rechercher" />
			<button type="submit" value="search" id="searchsubmit" class="icon-search"></button>
			
		</section>
	</form>
</div>
<?php 
echo '<pre>';
print_r($wp_query);
echo '</pre>';
 ?>

	
<?php get_footer(); ?>