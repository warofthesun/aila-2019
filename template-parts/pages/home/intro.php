<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($intro = get_field('intro')) :
        $media_type = $intro['media_type'];
        $image = $intro['image'];
        $video_title = $intro['video_title'];
        $video = $intro['video'];
        $cover_image = $intro['cover_image'];
        $title = $intro['title'];
        $heading = $intro['heading'];
        $text = $intro['text'];
        $button = get_button($intro['button']);

        $companies_obj = $intro['companies'];
        $companies = [
            'title' => '',
            'logos' => []
        ];

        if (!empty($companies_obj)) {
            $companies = [
                'title' => $companies_obj['companies_title'],
                'logos' => $companies_obj['companies_logos']
            ];
        }
?>

<div id="home_intro__wrapper" class="page_section">
    <div id="home_intro" class="page_container">
        <div class="columns">
            <div id="home_intro__image" class="col_half">
                <?php if ($media_type === 'image' && !empty($image)) : ?>
                    <img
                        src="<?= $image['url'] ?>"
                        alt="Aila Technologies, Inc. | <?= $heading ?>"
                        title="Aila Technologies, Inc. | <?= $heading ?>"
                    >
                <?php endif; ?>
                <?php if ($media_type === 'video' && !empty($cover_image) && !empty($video)) : ?>
                    <div class="video_cover_image">
                        <img src="<?= get_template_directory_uri() . '/images/video-play.png' ?>" class="video_play_button">
                        <img
                            src="<?= $cover_image['url'] ?>"
                            alt="Aila Technologies, Inc. | <?= $heading ?>"
                            title="Aila Technologies, Inc. | <?= $heading ?>"
                        >
                    </div>
                    <div class="modal_overlay">
                        <div class="modal video <?= $video_title ? 'has_title' : '' ?>">
                            <i class="closer close_modal" aria-hidden="true"></i>
                            <?php if ($video_title) { ?><h3><?= $video_title ?></h3><?php } ?>
                            <video controls>
                                <source src="<?= $video['url'] ?>" type="video/mp4">
                            </video>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div id="home_intro__content" class="col_half">
                <?php
                    if ($title) echo '<h5>' . $title . '</h5>';
                    if ($heading) echo '<h2>' . $heading . '</h2>';
                    if ($text) echo '<p class="sub_heading">' . $text . '</p>';
                ?>

                <div class="button_container">
                    <?php print_button($button); ?>
                </div>

                <div class="home_companies">
                    <p class="home_companies__title"><?= $companies['title'] ?></p>

                    <?php
                        function render_company_logos($logos, $mobile) {
                            ob_start();
                            ?>
                            <table class="home_companies__logos <?= $mobile ? 'mobile' : '' ?>">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                    <?php
                                        foreach ($logos as $i => $company_logo) :
                                            $logo = $company_logo['logo'];
                                            $logo_url = !empty($logo) ? $logo['url'] : null;
                                            $title = $company_logo['title'];
                                    ?>
                                        <td class="home_companies__logo">
                                            <img
                                                src="<?= $logo_url ?>"
                                                alt="<?= $title ?>"
                                                title="<?= $title ?>"
                                            >
                                        </td>
                                    <?php
                                            new_table_row($logos, $i, $mobile);
                                        endforeach;
                                    ?>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                            return ob_get_clean();
                        }

                        echo render_company_logos($companies['logos'], false); // desktop
                        echo render_company_logos($companies['logos'], true); // mobile
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        line('h', 'home_1');
        bend('l-d', 'home_2');
        line('v', 'home_3');
        line('v', 'home_4');
    ?>
</div>

<?php
    endif;
