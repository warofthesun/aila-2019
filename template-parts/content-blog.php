<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

	global $post;
	$slug = $post->post_name;
?>
	<article id="<?= $slug ?>" <?php post_class(); ?>>
		<?php get_template_part('template-parts/pages/page-blog'); ?>
	</article>
<?php
	get_template_part('template-parts/global/cta');
