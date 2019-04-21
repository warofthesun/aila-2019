<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


    if ($product_sections = get_field('scrolling_section')) :

        function section_1_lines() {
            line('v', 'products_5');
            line('v', 'products_6');
            bend('l-d', 'products_7');
            line('h', 'products_8');
            bend('l-u', 'products_9');
            line('v', 'products_10');
        }

        function section_2_lines() {
            line('v', 'products_11');
            line('v', 'products_12');
            bend('l-u', 'products_13');
            line('h', 'products_14');
        }

        function section_3_lines() {
            line('v', 'products_15');
            line('v', 'products_16');
            bend('l-d', 'products_17');
            line('h', 'products_18');
        }

        function render_product_section($section, $id, $alignment, $draw_lines) {
            // printr($section);
            $heading = $section['heading'];
            $title = $section['title'];
            $text = $section['text'];
            $button = get_button($section['button']);

            $technologies = !empty($section['technology_bubbles']) ? $section['technology_bubbles'] : [];

            $image = $section['image'];
            $image_url = !empty($image) ? $image['url'] : null;

            $features = [
                $section['feature_1'],
                $section['feature_2']
            ];

            ob_start();
            ?>
            <div id="<?= $id ?>" class="product_section float_clear <?= $alignment ?>">
                <img
                    src="<?= $image_url ?>"
                    alt="<?= strip_tags($title) ?>"
                    title="<?= strip_tags($title) ?>"
                    class="mobile"
                >
                <div class="product_section__content">
                    <?php if (!empty($heading)) { ?><h3><?= $heading ?></h3><?php } ?>
                    <?php if (!empty($title)) { ?><h4><?= $title ?></h4><?php } ?>
                    <?php if (!empty($text)) { ?><p><?= $text ?></p><?php } ?>
                    <?php if (!empty($technologies)) : ?>
                        <ul class="product_section__technologies">
                        <?php foreach ($technologies as $technology) : ?>
                            <li><?= $technology ?></li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="product_section__features float_clear">
                    <?php
                        foreach ($features as $feature) :
                            $icon = $feature['icon'];
                            $title = $feature['title'];
                            $bullets = $feature['bullets'];
                    ?>
                        <div class="float_left">
                            <?php get_icon($icon); ?>
                            <h5><?= $title ?></h5>
                            <ul>
                            <?php foreach ($bullets as $bullet) : ?>
                                <li>
                                    <span><?= $bullet['text'] ?></span>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <div class="button_container">
                        <?php print_button($button); ?>
                    </div>
                </div>
                <img
                    src="<?= $image_url ?>"
                    alt="<?= strip_tags($title) ?>"
                    title="<?= strip_tags($title) ?>"
                    class="desktop"
                >

                <?php $draw_lines(); ?>
            </div>
            <?php
            return ob_get_clean();
        }
?>
    <div id="product_sections">
        <?php
            line('h', 'products_1');
            bend('l-u', 'products_2');
            line('v', 'products_3');

            line('h', 'products_4');
        ?>
        <div class="page_container page_section">
            <?php
                echo render_product_section(
                    $product_sections['section_1'],
                    'product__imager',
                    'right',
                    'section_1_lines'
                );

                echo render_product_section(
                    $product_sections['section_2'],
                    'product__kisok',
                    'left',
                    'section_2_lines'
                );

                echo render_product_section(
                    $product_sections['section_3'],
                    'product__truescan',
                    'right',
                    'section_3_lines'
                );
            ?>
        </div>
    </div>
    <script>window.hasProductsAnimation = true;</script>
<?php
    endif;
