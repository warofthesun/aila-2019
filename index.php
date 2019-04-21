<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


get_header(); ?>
	<main id="main" class="site-main" role="main">
	<?php
		while (have_posts()) : the_post();
			get_template_part('template-parts/content', get_post_format());
		endwhile;
	?>
	</main>
<?php get_footer(); ?>
