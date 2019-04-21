<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


    if ($in_the_wild = get_field('in_the_wild')) :
        $heading = $in_the_wild['heading'];
        $text = $in_the_wild['text'];
        $locations = $in_the_wild['locations'];
?>
    <div id="resources__at_a_glance" class="section_border_top">
        <?php if (!empty($heading)) { ?><h2><?= $heading ?></h2><?php } ?>
        <?php if (!empty($text)) { ?><p class="sub_heading"><?= $text ?></p><?php } ?>

        <?php if (!empty($locations)) : ?>
        <div id="resources__at_a_glance__blocks" class="float_clear">
            <?php
                foreach ($locations as $location) :
                    $title = $location['title'];
                    $address = $location['address'];
                    $url = $location['google_maps_url'];
                    $image = $location['image'];
                    $image_url = !empty($image) ? $image['url'] : '';
                    $image_style = 'background-color: #c9c9c9;';

                    if (!empty($image_url)) {
                        $image_style = 'background-image: url(' . $image_url . ');';
                    }
            ?>
            <div class="resources__location float_left">
                <a
                    href="<?= $url ?>"
                    class="resources__location_image__container"
                    target="_blank"
                >
                    <div
                        class="resources__location_image"
                        style="<?= $image_style ?>"
                    ></div>
                </a>
                <a href="<?= $url ?>" target="_blank">
                    <h4><?= $title ?></h4>
                </a>
                <p><?= $address ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
<?php
    endif;
