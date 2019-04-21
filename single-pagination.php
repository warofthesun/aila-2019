<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 * Template Name: single-pagination
 */

	global $pagename;

    $args = [
        'post_type' => 'post',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_status' => 'publish'
    ];

    if (!empty($_POST['postsPerPage'])) $args['posts_per_page'] = $_POST['postsPerPage'];
    if (!empty($_POST['s'])) $args['s'] = $_POST['s'];
    if (!empty($_POST['ids'])) $args['post__not_in'] = explode(',', $_POST['ids']);
    if (!empty($_POST['category'])) $args['cat'] = (int)$_POST['category'];
    if (!empty($_POST['tag'])) $args['tag'] = $_POST['tag'];
    if (!empty($_POST['author'])) $args['author'] = (int)$_POST['author'];
    if (!empty($_POST['date']['year']) && !empty($_POST['date']['month'])) {
        $args['date_query'] = [
            'year' => $_POST['date']['year'],
            'month' => $_POST['date']['month']
        ];
    }

    $posts = new WP_Query($args);

	if (isset($pagename) && $pagename == 'single-pagination') {
		echo '<html><head><meta name="robots" content="noindex"></head><body>';
	}

	if ($posts->have_posts()) {
		echo get_blog_posts_table($posts);
	}

	if (isset($pagename) && $pagename == 'single-pagination') {
		echo '</body></html>';
	}