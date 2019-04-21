<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($products = get_field('products')) :
        $title = $products['title'];
        $heading = $products['heading'];
        $sub_heading = $products['sub-heading'];
        $featured_products = $products['products'];

        $half_count = 0;
?>

<div id="home_products__wrapper" class="page_section">
    <?php
        line('h', 'home_5');
        bend('l-d', 'home_6');
        line('v', 'home_7');
        line('h', 'home_8');
    ?>
    <div id="home_products" class="page_container">
        <?php
            if ($title) echo '<h5>' . $title . '</h5>';
            if ($heading) echo '<h2>' . $heading . '</h2>';
            if ($sub_heading) echo '<p class="sub_heading">' . $sub_heading . '</p>';
        ?>

        <div id="home_products__container" class="float_clear">
            <?php
                foreach ($featured_products as $i => $featured_product) :
                    $product_link = $featured_product['product_link'];
                    $product_url = !empty($product_link) ? $product_link['url'] : null;

                    $product_title = $featured_product['product_title'];

                    $image = $featured_product['image'];
                    $image_url = !empty($image) ? $image['url'] : null;

                    $caption = $featured_product['caption'];
                    $button = get_button($featured_product['button']);
                    $width = $featured_product['width'];

                    if ($width == 'half') $half_count++;
            ?>
                <div class="featured_product <?= $width ?> float_left">
                    <?php if ($image_url) : ?>
                        <div class="featured_product__image">
                            <?php if ($product_url) echo '<a href="' . $product_url . '">'; ?>
                                <img
                                    src="<?= $image_url ?>"
                                    alt="Aila Technologies, Inc. | <?= strip_tags($product_title) ?>"
                                    title="Aila Technologies, Inc. | <?= strip_tags($product_title) ?>"
                                >
                            <?php if ($product_url) echo '</a>'; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($product_url) echo '<a href="' . $product_url . '">'; ?>
                        <h4><?= $product_title ?></h4>
                    <?php if ($product_url) echo '</a>'; ?>
                    <p><?= $caption ?></p>
                    <?php
                        if ($features = $featured_product['features']) {
                            $features_icon = $features['icon'];
                            $features_title = $features['title'];
                            $features_bullets = $features['bullet_points'];

                            get_icon($features_icon);

                            if ($features_title) echo '<h5>' . $features_title . '</h5>';

                            if (is_array($features_bullets) && count($features_bullets) > 0) {
                                $split = true;

                                echo '<div class="bullet_points float_clear">';
                                echo '<ul' . (count($features_bullets) > 3 ? ' class="split">' : '>');
                                foreach ($features_bullets as $j => $bullet) {
                                    echo '<li>' . $bullet['feature'] . '</li>';

                                    if ( // split into 2 columns if more than 3 bullet points
                                        $split &&
                                        count($features_bullets) > 3 &&
                                        $j + 1 >= ceil(count($features_bullets) / 2)
                                    ) {
                                        echo '</ul><ul class="split">';
                                        $split = false;
                                    }
                                }
                                echo '</ul>';
                                echo '</div>';
                            }
                        }

                        echo '<div class="button_container">';
                        print_button($button, 'inverted outline');
                        echo '</div>';
                    ?>
                </div>
            <?php
                    if ($i < count($featured_products) - 1) {
                        $next_width = $featured_products[$i + 1]['width'];

                        if (
                            $width == 'full' ||
                            $next_width == 'full' ||
                            $half_count == 2
                        ) {
                            echo '<hr class="spacer">';
                            $half_count = 0;
                        }
                    }

                endforeach;
            ?>
        </div>
    </div>
</div>
<script>window.hasHomeLines = true;</script>

<?php
    endif;
