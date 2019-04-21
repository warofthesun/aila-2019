<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

	global $post;

	$detect = new Mobile_Detect;
	$is_mobile = $detect->isMobile() || $detect->isTablet();

	$post_type = get_post_type();
	$classes = get_field('main_color') ? get_field('main_color') : 'blue';
	if ($is_mobile) $classes .= ' mobile';

	if (is_object($post) && post_password_required($post)) {
		$classes .= ' modal_open';
	}
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->
	<script>dataLayer = [];</script>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5D7B36N');</script>
	<!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if (is_singular() && pings_open(get_queried_object())) : ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<script>history.scrollRestoration = 'manual';</script>
</head>

<body <?php body_class($classes); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5D7B36N"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<div id="page_wrapper">
		<?php get_template_part('template-parts/template-header'); ?>
		<?php
			switch ($post_type) {
				case 'post':
				case 'tools':
					if (is_archive() || is_search() || is_404()) {
						get_template_part('template-parts/pages/blog/archive-hero');
					} else {
						get_template_part('template-parts/pages/blog/single-hero');
					}
					break;
				case 'case-study':
					get_template_part('template-parts/pages/case-study/hero');
					break;
				default:
					get_template_part('template-parts/global/hero');
			}
