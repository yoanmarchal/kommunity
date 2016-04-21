<?php
/**
 * The template for displaying search forms in Twenty Eleven.
 *
 * @since Twenty Eleven 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
		<label for="s" class="assistive-text"><?php _e('Search', 'Kommunity'); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'Kommunity'); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'Kommunity'); ?>" />
	</form>