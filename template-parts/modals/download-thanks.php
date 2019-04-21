<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */
?>

<div class="modal" id="modal__download_thanks">
    <i class="closer close_modal" aria-hidden="true"></i>
    <h3><?= esc_attr(get_option('aila_download_thank_you_title')) ?></h3>
    <p class="thank_you_message"><?= esc_attr(get_option('aila_download_thank_you_message')) ?></p>

    <div class="button_container">
        <span class="button close_modal">Ok</span>
    </div>

    <iframe id="file_download" width="0" height="0"></iframe>
</div>
