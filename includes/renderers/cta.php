<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


function get_cta_fields($banner) {
	$bg_image = $banner['background_image'];
	$image_url = '';

	if (is_array($bg_image)) {
		$image_url = $bg_image['url'];
	} else {
		$image_url = wp_get_attachment_image_src($bg_image, 'full');

		if (!empty($image_url)) {
			$image_url = $image_url[0];
		}
	}

	return [
		'title' => isset($banner['title']) ? $banner['title'] : '',
		'heading' => isset($banner['heading']) ? $banner['heading'] : '',
		'sub-heading' => isset($banner['sub-heading']) ? $banner['sub-heading'] : '',
		'button' => get_button($banner['button']),
		'bg_image' => $bg_image,
		'image_url' => $image_url,
		'color_overlay' => $banner['color_overlay']
	];
}


function render_cta_content($fields) {
	$cta = '';

	if (!empty($fields['image_url'])) {
		$cta .= '<div class="banner_bg_img" style="background-image: url(' . $fields['image_url'] . ');"></div>';
	}

	if (!empty($fields['title'])) {
		$cta .= '<h5>' . $fields['title'] . '</h5>';
	}

	if (!empty($fields['heading'])) {
		$cta .= '<h2>' . $fields['heading'] . '</h2>';
	}

	if (!empty($fields['sub-heading'])) {
		$cta .= '<p>' . $fields['sub-heading'] . '</p>';
	}

	$button = $fields['button'];
	$button_color = $fields['color_overlay'] == 'darkened' ? '' : 'inverted';

	if (!empty($button['text'])) {
		if (!$button['opens_popup']) {
			$cta .= '<a href="' . $button['url'] . '" class="button ' . $button_color . '"';
			$cta .= ' target="' . $button['target'] . '">' . $button['text'] . '</a>';
		} else {
			$cta .= '<span class="button opens_popup ' . $button_color . '" data-modal="' . $button['modal_type'] . '"';

			if ($button['modal_type'] == 'download') {
				$cta .= ' data-file="' . $button['file'] . '"';
				$cta .= ' data-file-name="' . $button['file_name'] . '"';
			}

			$cta .= '>' . $button['text'] . '</span>';
		}
	}

	return $cta;
}

function render_cta($banner_type, $content) {
	ob_start();

	if ($banner_type == 'full-width' && $content['full_width']) :
		$fields = get_cta_fields($content['full_width']);
		$classes = get_bg_classes(
			$fields['image_url'],
			$fields['color_overlay'],
			null
		);
	?>
		<div class="cta_banner cta_full bg_overlay_compatible <?= implode(' ', $classes) ?>">
			<?php
				line('v', 'cta_1');
				line('v', 'cta_2', 'white');

				echo render_cta_content($fields);

				if (!empty($fields['button'])) {
					$shortcode = get_modal_shortcode($fields['button']);
					echo do_shortcode($shortcode);
				}

				line('h', 'cta_3', 'white');
				bend('l-u', 'cta_4', 'white');
				line('v', 'cta_5', 'white');
				line('v', 'cta_6', 'white');

				line('h', 'cta_7', 'white');
				bend('r-d', 'cta_8', 'white');
				line('v', 'cta_9', 'white');
				line('h', 'cta_10', 'white');
			?>
			<script>window.hasFullCtaLines = true;</script>
		</div>
    <?php

	elseif ($banner_type == 'split') :

		$banners = [
			'left' => $content['split_left'],
			'right' => $content['split_right']
		];

		$mobile_side = !empty($content['mobile_side']) ? $content['mobile_side'] : 'left';
    ?>
		<div class="cta_split_container mobile_<?= $mobile_side ?>">
			<div class="cta_split_row">
				<?php
					foreach ($banners as $side => $banner) :
						$fields = get_cta_fields($banner);
						$classes = get_bg_classes(
							$fields['image_url'],
							$fields['color_overlay'],
							null
						);
				?>
					<div class="cta_banner cta_split <?= $side ?> bg_overlay_compatible <?= implode(' ', $classes) ?>">
						<div class="cta_banner_content">
							<?php
								echo render_cta_content($fields);

								if (!empty($fields['button'])) {
									$shortcode = get_modal_shortcode($fields['button']);
									echo do_shortcode($shortcode);
								}
							?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php

    elseif ($banner_type == 'installations') :

		$installations = $content['installations'];
		$fields = get_cta_fields($installations);
		$classes = get_bg_classes(
			$fields['image_url'],
			$fields['color_overlay'],
			null
		);

		$title = $fields['heading'];
		$button = $fields['button'];
		$button_color = $fields['color_overlay'] == 'darkened' ? '' : 'inverted';

		$shortcode = '[aila-installation-posts display="featured"';
		if (!empty($title)) $shortcode .= ' title="' . $title . '"';

		$installation_posts = $installations['installation_posts'];
		$ids = '';

		foreach ($installation_posts as $i => $installation_post) {
			if (!is_object($installation_post['installation'])) continue;
			$ids .= $installation_post['installation']->ID;
			if ($i < count($installation_posts) - 1) $ids .= ',';
		}

		$shortcode .= ' post_ids="' . $ids . '"]';
    ?>
		<div class="cta_banner cta_full installations bg_overlay_compatible <?= implode(' ', $classes) ?>">
			<?php if (!empty($fields['image_url'])) : ?>
				<div class="banner_bg_img" style="background-image: url(<?= $fields['image_url'] ?>);"></div>
			<?php endif; ?>
			<div class="page_container">
				<?= do_shortcode($shortcode); ?>
				<?php if (!empty($button['text'])) : ?>
					<div class="button_container">
						<?php
							print_button($button, $button_color);

							$shortcode = get_modal_shortcode($button);
							echo do_shortcode($shortcode);
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php
		endif;
	return ob_get_clean();
}
