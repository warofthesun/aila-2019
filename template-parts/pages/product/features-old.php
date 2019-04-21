<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    global $post;
    $slug = $post->post_name;


    if ($features = get_field('features')) :
        $title = $features['title'];
        $heading = $features['heading'];

        $image = $features['product_image'];
        $image_url = !empty($image) ? $image['url'] : null;

        $captions = $features['captions'];

        $button = get_button($features['button']);
?>

    <div id="product__features__wrapper">
        <div id="product__features" class="page_container page_section">
            <h5 class="section_title"><?= $title ?></h5>
            <h2><?= $heading ?></h2>
            <?php if (!empty($captions)) : ?>
            <div
                id="product__features_container"
                class="<?= $slug ?>"
                style="<?= $image_url ? 'background-image: url(' . $image_url . ');' : '' ?>"
            >
                <?php foreach ($captions as $caption) : ?>
                    <i id="<?= $caption['id'] ?>__pointer" class="features_caption__pointer">
                        <i class="bar"></i>
                    </i>
                    <div class="features_caption" id="<?= $caption['id'] ?>">
                        <h4><?= $caption['title'] ?></h4>
                        <p><?= $caption['text'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <script>window.hasFeaturedProducts = true;</script>
            <?php endif; ?>
            <div id="product__features_button_container">
                <a href="<?= $button['url'] ?>" target="<?= $button['target'] ?>" class="button">
                    <?= $button['text'] ?>
                </a>
            </div>
        </div>
    </div>

<?php
    endif;
