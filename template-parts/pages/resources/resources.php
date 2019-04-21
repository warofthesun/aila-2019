<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


    $questions_text = get_field('questions_text');
    if (!empty($questions_text)) echo '<p class="questions_text">' . $questions_text . '</p>';

    $resource_blocks = [];
    $modals = [];

    if (have_rows('resource_groups')) :
        $i = 0;

        while (have_rows('resource_groups')) {
            the_row();
            $id = 'group_' . $i;
            $title = get_sub_field('title');

            $resource_blocks []= [
                'id' => $id,
                'icon' => get_sub_field('icon'),
                'title' => $title,
                'opens_popup' => get_sub_field('open_modal'),
                'resource_type' => get_sub_field('resource_type'),
                'link' => get_sub_field('link'),
                'file' => get_sub_field('file')
            ];

            $modals []= [
                'id' => $id,
                'block_title' => $title,
                'files' => get_sub_field('resource_files')
            ];

            $i++;
        }

        if (count($resource_blocks) % 3 == 1) {
            $resource_blocks = array_merge($resource_blocks, [
                ['spacer' => false],
                ['spacer' => false]
            ]);
        } elseif (count($resource_blocks) % 3 == 2) {
            $resource_blocks []= ['spacer' => false];
        } else {
            $resource_blocks []= ['spacer' => true];
        }
?>
    <div id="resource__container">
        <?php foreach ($resource_blocks as $block) : ?>
            <?php
                if (!isset($block['spacer'])) :
                    $opens_popup = $block['opens_popup'];
            ?>
                <div class="resource__block" <?= $opens_popup ? 'data-block="' . $block['id'] . '"' : '' ?>>
                    <?php
                        if (!$opens_popup) {
                            $resource_type = !empty($block['resource_type']) ? $block['resource_type'] : null;
                            $target = '_blank';
                            $url = null;

                            if ($resource_type == 'link') {
                                $link = $block['link'];
                                $url = !empty($link) ? $link['url'] : null;
                                $target = !empty($link) ? $link['target'] : '_blank';

                            } else if ($resource_type === 'file') {
                                $the_file = null;

                                if ($post_file = $block['file']) {
                                    $post_file_id = $post_file->ID;
                                    $the_file = get_field('file', $post_file_id);
                                }

                                if ($the_file) {
                                    $url = $the_file['url'];
                                }
                            }

                            if (!empty($url)) {
                                echo '<a href="' . $url . '" target="' . $target . '" class="no_popup"></a>';
                            }
                        }

                        $icon = isset($block['icon']) ? $block['icon'] : '';
                        get_icon($icon);
                    ?>
                    <h4><?= $block['title'] ?></h4>
                    <h5>View</h5>
                </div>
            <?php else : ?>
                <div class="resource__block spacer <?= $block['spacer'] ? 'mobile' : 'desktop' ?>"></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div id="resource__overlay" class="modal_overlay">
        <div class="modal" id="resource__modal">
            <i class="closer close_modal" aria-hidden="true"></i>
            <?php foreach ($modals as $modal) : ?>
                <div class="resource__modal_content" data-modal="<?= $modal['id'] ?>">
                    <h4><?= $modal['block_title'] ?></h4>
                    <?php if (!empty($modal['files'])) : ?>
                    <ul class="modal_resources">
                        <?php
                            foreach ($modal['files'] as $f) {

                                switch ($f['type']) {

                                    case 'file':
                                        $file_src = $f['file_source'];
                                        $url = null;

                                        if ($file_src == 'files') {
                                            $the_file = null;

                                            if ($post_file = $f['post_file']) {
                                                $post_file_id = $post_file->ID;
                                                $the_file = get_field('file', $post_file_id);
                                            }

                                            if ($the_file) {
                                                $url = $the_file['url'];
                                            }
                                        } else {
                                            $file = $f['file'];
                                            $url = !empty($file) ? $file['url'] : null;
                                        }

                                        if (!empty($url)) {
                                            ?>
                                                <li>
                                                    <a href="<?= $url ?>" target="_blank">
                                                        <?= $f['title'] ?>
                                                    </a>
                                                </li>
                                            <?php
                                        }
                                        break;

                                    case 'image':
                                        if ($image = $f['image']) {
                                            $title = $f['title'];
                                            $url = $image['url'];
                                            $add_bg = $f['add_image_background'];
                                            ?>
                                                <li class="photo">
                                                    <a href="<?= $url ?>" target="_blank">
                                                        <span
                                                            <?php if ($add_bg) echo 'class="bg"'; ?>
                                                        >
                                                            <span
                                                                class="image_container"
                                                                style="background-image: url(<?= $url ?>);"
                                                            >
                                                                <span class="download_hover">
                                                                    <span>
                                                                        <?php get_icon('download'); ?>
                                                                        Download
                                                                    </span>
                                                                </span>
                                                                <!-- <img src="<?= $url ?>" alt="<?= $title ?>"> -->
                                                            </span>
                                                            <?php
                                                                if (!empty($title)) {
                                                                    echo '<label>' . $title . '</label>';
                                                                }
                                                            ?>
                                                        </span>
                                                    </a>
                                                </li>
                                            <?php
                                        }
                                        break;

                                    case 'link':
                                        if ($link = $f['link']) {
                                            ?>
                                                <li>
                                                    <a
                                                        href="<?= $link['url'] ?>"
                                                        target="<?= $link['target'] ?>"
                                                    >
                                                        <?= $f['title'] ?>
                                                    </a>
                                                </li>
                                            <?php
                                        }
                                        break;

                                    case 'html':
                                        if ($html = $f['html']) {
                                            echo '<li class="html">' . $html . '</li>';
                                        }
                                        break;
                                }
                            }
                        ?>
                    </ul>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
    endif;
