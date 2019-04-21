<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $text = get_field('text');
    $questions = get_field('existing_deployments_and_questions');
?>

    <div id="contact__content" class="page_container page_section">
        <?php if (!empty($text)) { ?><p class="contact_text"><?= $text ?></p><?php } ?>
        <?php if (!empty($questions)) { ?><p class="contact_questions"><?= $questions ?></p><?php } ?>
        <?php if (have_rows('contact_info')) : ?>
            <ul>
            <?php
                while (have_rows('contact_info')) :
                    the_row();
                    $title = get_sub_field('title');
                    $text = get_sub_field('text');
            ?>

                <li>
                    <?php if (!empty($title)) { ?><h4><?= $title ?></h4><?php } ?>
                    <?php if (!empty($text)) { ?><p><?= $text ?></p><?php } ?>
                </li>
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php
