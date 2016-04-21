<?php
/*
Template Name: formulaires
*/
?>
<?php
/**
 * New Post Form for Custom Post Types for the Frontend of Your Site
 * By Jared Williams - http://new2wp.com.
 *
 * Last Updated: 8/30/2010
 */

// Check if the form was submitted
if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action'])) {

    // Do some minor form validation to make sure there is content
    if (isset($_POST['title'])) {
        $title = $_POST['title'];
    } else {
        echo 'Please enter a title';
    }
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        echo 'Please enter the content';
    }
    $tags = $_POST['post_tags'];

    // Add the content of the form to $post as an array
    $post = [
        'post_title'       => $title,
        'post_content'     => $description,
        'post_category'    => $_POST['cat'],  // Usable for custom taxonomies too
        'tags_input'       => $tags,
        'post_status'      => 'publish',            // Choose: publish, preview, future, etc.
        'post_type'        => $_POST['evenements'],  // Use a custom post type if you want to
    ];
    wp_insert_post($post);  // Pass  the value of $post to WordPress the insert function
                            // http://codex.wordpress.org/Function_Reference/wp_insert_post
    wp_redirect(home_url()); // redirect to home page after submit
} // end IF
// Do the wp_insert_post action to insert it
do_action('wp_insert_post', 'wp_insert_post');
?>






<?php get_header(); ?>
    <?php if (have_posts()) : ?>  
    	<?php while (have_posts()) : the_post(); ?>
		<article id="formulaire">
			<div class="article-content">
			 <h1><?php the_title(); ?></h1>
			<!-- New Post Form -->
			<div id="postbox">
				<form id="new_post" name="new_post" method="post" action="">
					<p><label for="title">Title</label><br />
					<input type="text" id="title" value="" tabindex="1" size="20" name="title" />
					</p>
					<p><label for="description">Description</label><br />
					<textarea id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
					</p>
					<p><?php wp_dropdown_categories('show_option_none=Category&tab_index=4&taxonomy=category'); ?></p>
					<p><label for="post_tags">Tags</label>
						<input type="text" value="" tabindex="5" size="16" name="post_tags" id="post_tags" /></p>
					<p align="right"><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>
					
					<input type="hidden" name="post_type" id="post_type" value="post" />
					<input type="hidden" name="action" value="post" />
					<?php wp_nonce_field('new-post'); ?>
				</form>
			</div>
			<!--// New Post Form -->
    		</div>
    		
		</article>
    	<?php endwhile; ?>
        
    <?php else : ?>
    
        <h1>Uh oh...</h1>
    
    <?php endif; ?>
<?php get_footer(); ?>