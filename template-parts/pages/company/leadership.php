<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */
    $bg_img_1 = get_field('image_1');
    $bg_img_2 = get_field('image_2');

    $class_list = ['page_container', 'page_section'];
    if (empty($bg_img_1)) $class_list []= 'no_top_banner';
    if (empty($bg_img_2)) $class_list []= 'no_bottom_banner';

    if (have_rows('leadership')) :
        $title = get_field('leadership_title');
?>
    <div id="company__leadership">
        <?php
            line('h', 'company_5');
            bend('r-d', 'company_6');
            line('v', 'company_7');

            line('h', 'company_8');
        ?>
        <div class="<?= implode(' ', $class_list) ?>">
            <div id="company__leadership__container">
                <?php
                    if (!empty($title)) echo '<h2>' . $title . '</h2>';

                    while (have_rows('leadership')) : the_row();
                        $name = get_sub_field('name');
                        $title = get_sub_field('title');
                        $contact = get_sub_field('contact_info');
                        $bio = get_sub_field('bio');
                        $email = $contact['email_address'];
                        $linkedin_id = $contact['linkedin_id'];

                        $image = get_sub_field('image');
                        $image_style = 'background-color: #c9c9c9;';
                        $image_url = null;

                        if (!empty($image)) {
                            $image_style = 'background-image: url(' . $image['url'] . ');';
                            $image_url = $image['url'];
                        }
                ?>
                <div class="company__leader">
                    <div class="company__leader_image" style="<?= $image_style ?>"></div>
                    <div class="company__leader_info">
                        <h4><?= $name ?></h4>
                        <h5><?= $title ?></h5>

                        <?php if (!empty($email) || !empty($linkedin_id)) : ?>
                        <ul class="contact_info">
                            <?php if ($email) : ?>
                                <li class="email">
                                    <a href="mailto:<?= $email ?>">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($linkedin_id) : ?>
                                <li class="linkedin">
                                    <a href="https://www.linkedin.com/in/<?= $linkedin_id ?>/" target="_blank">
                                        <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <?php endif; ?>

                        <span
                            class="view_bio"
                            data-name="<?= str_replace(' ', '-', strtolower($name)) ?>"
                        >View Bio</span>
                    </div>
                </div>
                <?php
                        $modal_shortcode = '[aila-modal modal_type="text"';
                        $modal_shortcode .= ' modal_title="' . $name . '"';
                        $modal_shortcode .= ' modal_text="' . $bio . '"';

                        if ($image_url) {
                            $modal_shortcode .= ' modal_image="' . $image_url . '"';
                        }

                        $modal_shortcode .= ']';

                        echo do_shortcode($modal_shortcode);

                    endwhile;
                ?>
            </div>
        </div>
    </div>
<?php
    endif;
