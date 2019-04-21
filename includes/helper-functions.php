<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


require_once('renderers/cta.php');
require_once('renderers/tables.php');
require_once('renderers/lines.php');

function clean_phone_number($number) {
	$number = str_replace('(', '', $number);
	$number = str_replace(')', '', $number);
	$number = str_replace('-', '', $number);
	$number = str_replace('.', '', $number);
	$number = str_replace(' ', '', $number);
	return $number;
}

function printr($var) {
	echo '<pre>';
	echo print_r($var, true);
	echo '</pre>';
}

function get_footer_divider() {
	echo '<div id="footer__divider"><hr></div>';
}

function get_blog_type() {
	global $post;

    if (is_object($post)) {
        $post_type = $post->post_type;
        $slug = $post->post_name;

        $search_type = $post_type == 'page'
            ? ($slug == 'blog' ? 'post' : 'tools')
            : $post_type;
    } else {
        $search_type = get_query_var('post_type');
    }

	return $search_type;
}

function get_modal_shortcode($button) {
	if (empty($button)) return '';

	$shortcode = '[aila-modal ';
	$shortcode .= 'modal_type="' . $button['modal_type'] . '" ';
	$shortcode .= 'form_id="' . $button['form_id'] . '" ';
	$shortcode .= 'modal_title="' . $button['modal_title'] . '" ';
	$shortcode .= 'modal_text="' . $button['modal_text'] . '" ';
	$shortcode .= 'thank_you_title="' . $button['thank_you_title'] . '" ';
	$shortcode .= 'thank_you_text="' . $button['thank_you_text'] . '"]';

	return $shortcode;
}

function get_button($button) {
	$button_text = '';
	$button_link = '';
	$button_url = '';
	$button_target = '';
	$opens_popup = false;
	$modal_type = null;
	$file = null;
	$file_name = '';
	$form_id = '';
	$modal_title = '';
	$modal_text = '';
	$thank_you_title = '';
	$thank_you_text = '';

	if (!empty($button)) {
		$button_text = $button['button_text'];
		$button_link = $button['button_link'];
		$button_url = !empty($button_link) ? $button_link['url'] : '';
		$button_target = !empty($button_link) ? $button_link['target'] : '';
	}

	if (!empty($button['opens_popup'])) {
		$opens_popup = $button['opens_popup'];

		$modal = !empty($button['modal']) ? $button['modal'] : null;

		if ($modal) {
			$modal_type = !empty($modal['modal_type']) ? $modal['modal_type'] : null;
			$form_id = !empty($modal['form_id']) ? $modal['form_id'] : null;
			$modal_title = !empty($modal['modal_title']) ? $modal['modal_title'] : '';
			$modal_text = !empty($modal['modal_text']) ? $modal['modal_text'] : '';
			$thank_you_title = !empty($modal['thank_you_title']) ? $modal['thank_you_title'] : '';
			$thank_you_text = !empty($modal['thank_you_text']) ? $modal['thank_you_text'] : '';

			if ($modal_type == 'download') {
				$file_src = !empty($modal['file_source']) ? $modal['file_source'] : 'media';
				$the_file = null;

				if ($file_src == 'files' && $post_file = $modal['post_file']) {
					$post_id = $post_file->ID;
					$the_file = get_field('file', $post_id);

				} else {
					$the_file = $modal['file'];
				}

				if ($the_file) {
					$file_id = $the_file['ID'];
					$file_name = $the_file['filename'];
					$file = $modal_type == 'download' && !empty($file_id)
						? get_permalink($file_id) . '?attachment_id=' . $file_id . '&download_file=1'
						: null;
				}
			}
		}
	}

	return [
		'text' => $button_text,
		'url' => $button_url,
		'target' => $button_target,
		'opens_popup' => $opens_popup,
		'modal_type' => $modal_type,
		'file' => $file,
		'file_name' => $file_name,
		'form_id' => $form_id,
		'modal_title' => $modal_title,
		'modal_text' => $modal_text,
		'thank_you_title' => $thank_you_title,
		'thank_you_text' => $thank_you_text
	];
}

function print_button($button, $button_color = '', $target = '') {
	if (empty($button['text'])) return;

	if (!$button['opens_popup']) : ?>
		<a
			href="<?= $button['url'] ?>"
			class="button <?= $button_color ?> <?= !empty($target) ? 'scroll_button' : '' ?>"
			target="<?= $button['target'] ?>"
			<?php if (!empty($target)) echo 'data-target="' . $target . '"'; ?>
		>
			<?= $button['text'] ?>
		</a>
	<?php else : ?>
		<span
			class="button <?= $button_color ?>"
			data-modal="<?= $button['modal_type'] ?>"
			data-file="<?= $button['file'] ?>"
			data-file-name="<?= $button['file_name'] ?>"
		>
			<?= $button['text'] ?>
		</span>
	<?php
		$shortcode = get_modal_shortcode($button);
		echo do_shortcode($shortcode);
	endif;
}

function get_icon($name) {
	$filepath = '/assets/icons/'. $name .'.php';
	if (!file_exists(get_template_directory() . $filepath)) return;
	get_template_part('assets/icons/' . $name);
}

function get_bg_classes($has_bg_asset, $color_overlay, $is_full_screen) {
	$classes = [];

    if ($is_full_screen) {
        $classes []= 'full_screen';
    }

    if (!empty($has_bg_asset)) {
        $classes []= 'has_bg_img';
    }

    if ($color_overlay == 'primary' || empty($color_overlay)) {
        $classes []= 'has_primary_overlay';
    } elseif ($color_overlay == 'darkened') {
		$classes []= 'has_darkened_overlay';
	} elseif ($color_overlay == 'grayed') {
		$classes []= 'has_grayed_overlay';
	}

	return $classes;
}

function get_category_list($categories, $separator) {
	$category_name = '';

	if (empty($categories)) return $category_name;

	if (count($categories) > 1) {
        foreach ($categories as $i => $category) {
            $category_name .= $category->slug;
            if ($i < count($categories) - 1) $category_name .= $separator;
        }
    } else {
        $category_name = $categories[0]->slug;
    }

	return $category_name;
}

function order_categories($categories) {
	$products = ['Interactive Kiosk', 'Mobile Imager'];
	$to_move = [];

	foreach ($categories as $i => $cat) {
		if (in_array($cat, $products)) {
			$to_move[$i] = $cat;
		}
	}

	if (count($to_move)) {
		foreach ($to_move as $i => $product) {
			unset($categories[$i]);
			$categories []= $product;
		}
	}

	return $categories;
}

function print_category_link_list($categories, $post_type = 'post') {
	$url = $post_type == 'post' ? '/blog/categories/' : '/tools/products/';

	foreach ($categories as $i => $category) {
		$cat = '<a href="' . $url . $category->slug . '">' . $category->name . '</a>';
		if ($i < count($categories) - 1) $cat .= ', ';
		echo $cat;
	}
}

function get_post_date_url($post_date) {
	return '/blog/' . date('Y', strtotime($post_date)) . '/' . date('m', strtotime($post_date)) . '/';
}

function get_taxonomy_dropdown($taxonomy = 'categories', $id = '') {
	global $post;

	switch ($taxonomy) {
		case 'categories':
			$categories = get_categories();
			$default = 'Categories';
			break;
		case 'tags':
			$categories = get_tags();
			$default = 'Tags';
			break;
		case 'products':
			$categories = get_terms('tools-product');
			$default = 'Products';
			break;
	}

	$current_category = !empty(get_queried_object()) ? get_queried_object()->slug : null;
	$select = '<div class="categories_selector" data-type="' . $taxonomy . '">';
	$select .= '<label><select id="' . $id . '"><option value="">' . $default . '</option>';

	foreach ($categories as $cat) {
		if ($cat->slug == 'uncategorized') continue;
		$select .= '<option value="' . $cat->slug . '"' . ($cat->slug == $current_category ? ' selected="selected">' : '>');
		$select .= $cat->name . '</option>';
	}

	$select .= '</select></label></div>';

	echo $select;
}
