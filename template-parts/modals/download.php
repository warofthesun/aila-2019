<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */
?>

<div class="modal" id="modal__download">
    <i class="closer close_modal" aria-hidden="true"></i>
    <h3><?= esc_attr(get_option('aila_download_title')) ?></h3>
    <p><?= esc_attr(get_option('aila_download_sub_title')) ?></p>

    <div class="modal_content contact_form__container">
        <?php $id = esc_attr(get_option('aila_download_shortcode')); ?>
        <?= do_shortcode('[contact-form-7 id="' . $id . '"]') ?>
    </div>
</div>
