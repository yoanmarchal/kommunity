<?php get_header(); ?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
			
		<div <?php post_class() ?>>
			
			<h1 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
						
			<?php the_excerpt() ?>
			
		</div>

		<?php endwhile; ?>

		<div class="pagination">
    	   <span class="older"><?php next_posts_link('&laquo; Older Entries') ?></span>
    	   <span class="newer"><?php previous_posts_link('Newer Entries &raquo;') ?></span>
    	</div>

	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2>No posts found.</h2>");
		}
		
	endif;
?>

<?php get_footer(); ?>