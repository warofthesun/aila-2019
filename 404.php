<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


get_header(); ?>
	<div id="not_found" class="page_container">
		<p><?php esc_html_e('It looks like nothing was found at this location.', 'hex'); ?></p>
		<?php get_search_form(); ?>
	</div>
<?php
get_footer();
