<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

	$slug = get_post_type();
?>

<article id="<?= $slug ?>" <?php post_class(); ?>>
	<?php get_template_part('template-parts/pages/page', $slug); ?>
</article>

<?php
	get_template_part('template-parts/global/cta');
