<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($solutions_blocks = get_field('solutions_blocks')) :
        $heading = $solutions_blocks['heading'];
        $customer = $solutions_blocks['customer_solutions'];
        $partner = $solutions_blocks['partner_solutions'];

        $title_blocks = [
            'customer' => $customer['title_block'],
            'partner' => $partner['title_block']
        ];

        $detail_blocks = [
            'customer' => $customer['blocks'],
            'partner' => $partner['blocks']
        ];

        function get_products_label($products) {
            $products_label = '';

            foreach ($products as $i => $product) {
                switch ($product) {
                    case 'tablet':
                        $products_label .= 'Interactive Kiosk';
                        break;
                    case 'mobile':
                        $products_label .= 'Mobile Imager';
                        break;
                }

                if ($i < count($products) - 1) $products_label .= '/';
            }

            return $products_label;
        }

        function get_col_class($i, $mobile) {
            if (!$mobile && $i % 3 == 2 || $mobile && $i % 2) {
                return 'last_col';
            } else {
                return '';
            }
        }

        function render_title_block($title_block, $type, $mobile) {
            ob_start();
            ?>
            <div class="solutions__title__block <?= $mobile ? 'mobile' : 'desktop' ?>" data-block-type="<?= $type ?>">
                <?php get_icon($title_block['icon']); ?>
                <h4><?= $title_block['title'] ?></h4>
                <p><?= $title_block['text'] ?></p>
                <h5 class="view_solutions_blocks hover_color">View</h5>
            </div>
            <?php
            return ob_get_clean();
        }

        function render_detail_blocks($blocks_list, $type, $title_blocks, $mobile) {
            ob_start();
            ?>

            <div class="solutions__blocks <?= $mobile ? 'mobile' : 'desktop' ?>">
                <h2><?= $title_blocks[$type]['title'] ?></h2>
                <table>
                    <thead></thead>
                    <tbody>
                        <tr>
                        <?php foreach ($blocks_list as $i => $block) : ?>
                            <td class="solutions__blocks__block <?= get_col_class($i, $mobile) ?>">
                                <div class="block__background"></div>
                                <div class="block__content">
                                    <h3><?= $block['title'] ?></h3>
                                    <p><?= $block['description'] ?></p>

                                    <?php if (!empty($block['product'])) : ?>
                                        <div class="solutions__blocks__block__products">
                                            <h5><?= get_products_label($block['product']) ?></h5>
                                            <?php
                                                foreach ($block['product'] as $product) {
                                                    $icon = 'mobile';

                                                    switch ($product) {
                                                        case 'mobile':
                                                            $icon = 'mobile-imager';
                                                            break;
                                                        case 'tablet':
                                                            $icon = 'kiosk';
                                                            break;
                                                        default:
                                                            $icon = 'mobile';
                                                    }

                                                    get_icon($icon);
                                                }
                                            ?>
                                        </div>
                                    <?php
                                        endif;

                                        $button = get_button($block['button']);

                                        if (!empty($button['text'])) {
                                            echo '<div class="solutions__blocks__block__link">';
                                                print_button($button, 'download_button');
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                            </td>
                        <?php
                                new_table_row($blocks_list, $i, $mobile);
                            endforeach;
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
            return ob_get_clean();
        }

        function render_block_video($blocks, $type) {
            $video = $blocks[$type . '_solutions']['video'];
            $title = '';
            $video_id = '';

            if (!empty($video)) {
                $title = $video['title'];
                $video_id = $video['youtube_video_id'];
            }

            if (empty($video_id)) return '';

            ob_start();
            ?>
            <div class="solutions__blocks__video">
                <?php if (!empty($title)) { ?><h2><?= $title ?></h2><?php } ?>
                <div class="embedded_video_container">
                    <div>
                        <iframe
                            src="https://www.youtube.com/embed/<?= $video_id ?>?rel=0&amp;showinfo=0"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
            </div>
            <?php
            return ob_get_clean();
        }
?>

    <div id="solutions__blocks">
        <h3><?= $heading ?></h3>

        <div class="solutions__blocks__desktop">
            <div id="solutions__blocks__title_blocks">
                <?php
                    foreach ($title_blocks as $type => $title_block) {
                        echo render_title_block($title_block, $type, false);
                    }
                ?>
                <i class="closer section_closer" aria-hidden="true"></i>
            </div>
            <?php foreach ($detail_blocks as $type => $blocks) : ?>
                <div class="solutions__blocks__container" data-type="<?= $type ?>">
                    <?php
                        echo render_detail_blocks($blocks, $type, $title_blocks, false);
                        echo render_detail_blocks($blocks, $type, $title_blocks, true);
                        echo render_block_video($solutions_blocks, $type);
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="solutions__blocks__mobile">
            <div class="solutions__blocks__title_blocks">
                <?= render_title_block($title_blocks['customer'], 'customer', true) ?>
            </div>
            <div class="solutions__blocks__container mobile" data-type="customer">
                <?php
                    echo render_detail_blocks($detail_blocks['customer'], 'customer', $title_blocks, true);
                    echo render_block_video($solutions_blocks, 'customer');
                ?>
            </div>

            <div class="solutions__blocks__title_blocks">
                <?= render_title_block($title_blocks['partner'], 'partner', true) ?>
            </div>
            <div class="solutions__blocks__container mobile" data-type="partner">
                <?php
                    echo render_detail_blocks($detail_blocks['partner'], 'partner', $title_blocks, true);
                    echo render_block_video($solutions_blocks, 'partner');
                ?>
            </div>
        </div>
    </div>

<?php
    endif;
