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
        $sub_heading = $features['sub-heading'];
        $technologies = $features['technology_bubbles'];
        $scenes = $features['scenes'];
        $button = get_button($features['button']);
        $display_heading_with_scenes = $features['display_heading_with_features'];

        $class_list = ['page_section'];

        if (!empty($scenes)) {
            // $class_list []= 'underline';
        } else {
            $class_list []= 'no_features';
        }

        if ($display_heading_with_scenes) {
            $class_list []= 'display_heading_with_features';
        }

        function print_feature_heading($sub_heading, $technologies) {
            if (!empty($sub_heading)) { ?><p><?= $sub_heading ?></p><?php } ?>
            <?php if (!empty($technologies) && count($technologies) > 0) : ?>
                <ul class="technology_bubbles">
                <?php foreach ($technologies as $technology) : ?>
                    <li><?= $technology ?></li>
                <?php endforeach; ?>
                </ul>
            <?php endif;
        }
?>

    <div id="product__features__wrapper" class="<?= $slug ?>">
        <div id="product__features" class="<?= implode(' ', $class_list) ?>">
            <h5 class="section_title"><?= $title ?></h5>
            <h2><?= $heading ?></h2>
            <?php
                if (!$display_heading_with_scenes) {
                    print_feature_heading($sub_heading, $technologies);
                } else {
                    echo '<div class="show_on_tablet sub_heading">';
                        print_feature_heading($sub_heading, $technologies);
                    echo '</div>';
                }
            ?>

            <?php if (!empty($scenes)) : ?>
                <div id="product__features__container">
                    <?php if ($display_heading_with_scenes) print_feature_heading($sub_heading, $technologies); ?>

                    <?php foreach ($scenes as $i => $scene) : ?>
                        <?php
                            $image = $scene['product_image'];
                            $image_url = '';
                            if (!empty($image)) $image_url = $image['url'];
                            $captions = $scene['captions'];
                            $transition = $scene['transition'];
                        ?>
                        <div
                            id="product_scene_<?= $i ?>"
                            class="product__features__scene"
                            style="<?= $image_url ? 'background-image: url(' . $image_url . ');' : '' ?>"
                            data-transition="<?= $transition ?>"
                        >
                        <?php
                            if (!empty($captions)) :
                                foreach ($captions as $i => $caption) :
                                    $has_detail_images = $caption['has_detail_images'];
                                    $detail_images = $caption['detail_images'];

                                    if ($has_detail_images && !empty($detail_images)) :
                                        foreach ($detail_images as $i => $img) :
                                            $id = $img['id'];
                                            $title = $img['title'];
                                            $image = $img['image'];
                                            $image_url = !empty($image) ? $image['url'] : null;
                                ?>
                                        <div class="features_option" id="<?= $id ?>">
                                            <img
                                                src="<?= $image_url ?>"
                                                class="detailed_image"
                                            >
                                            <h5><?= $title ?></h5>
                                            <div class="features_option__colors">
                                                <img src="<?= get_template_directory_uri() ?>/images/swatch-spacer.png">
                                            </div>
                                        </div>
                                <?php
                                        endforeach;
                                    endif;
                                ?>
                                <i id="<?= $caption['id'] ?>__pointer" class="features_caption__pointer">
                                    <i class="bar"></i>
                                </i>
                                <div class="features_caption" id="<?= $caption['id'] ?>">
                                    <h4><?= $caption['title'] ?></h4>
                                    <p><?= $caption['text'] ?></p>
                                </div>
                        <?php
                                endforeach;
                            endif;
                        ?>
                        </div>
                    <?php endforeach; ?>

                    <!-- <div id="product__features__controlls">
                        <ul id="product_scenes">
                        <?php
                            $scene_count = count($scenes);
                            $i = 1;

                            while ($i <= $scene_count) {
                                echo '<li data-slide-index="' . $i . '">' . $i . '</li>';
                                $i++;
                            }
                        ?>
                        </ul>
                        <span id="product_skip">skip</span>
                    </div> -->
                </div>

                <div id="product__features__mobile_container">
                    <?php
                        $mobile_captions = [];
                        $mobile_images = [];
                        $mobile_slides = [];
                        $mobile_image = null;
                        $mobile_url = '';

                        foreach ($scenes as $scene) {
                            $captions = $scene['captions'] ? $scene['captions'] : [];
                            $image = $scene['product_image_mobile']
                                ? $scene['product_image_mobile']
                                : ($scene['product_image']
                                        ? $scene['product_image']
                                        : []);

                            $mobile_slides []= [
                                'caption' => count($captions) ? $captions[0] : null,
                                'image' => $image
                            ];

                            // if ($scene['use_as_mobile_image']) {
                            //     $mobile_image = $scene['product_image'];
                            // }
                        }

                        // if (!$mobile_image) $mobile_image = $scenes[0]['product_image'];
                        // if (!empty($mobile_image)) {
                        //     $mobile_url = $mobile_image['url'];
                        //     echo '<img src="' . $mobile_url . '">';
                        // }

                        if (!empty($mobile_slides)) :
                    ?>
                    <ul id="product__features__mobile_slider">
                    <?php foreach ($mobile_slides as $slide) : ?>
                        <li>
                            <?php if ($slide['image']) : ?>
                            <img
                                src="<?= $slide['image']['url'] ?>"
                                alt="<?= $slide['caption']['title'] ?>"
                            >
                            <?php endif; ?>
                            <?php if ($slide['caption']) : ?>
                            <h4><?= $slide['caption']['title'] ?></h4>
                            <p><?= $slide['caption']['text'] ?></p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>

                <script>window.hasFeaturedProducts = true;</script>
            <?php endif; ?>
            <div id="product__features_button_container">
                <?php print_button($button); ?>
            </div>
        </div>
    </div>

<?php
    endif;
