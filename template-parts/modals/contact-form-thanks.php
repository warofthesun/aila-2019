<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */
?>

<div class="modal" id="modal__contact_thanks">
    <i class="closer close_modal" aria-hidden="true"></i>
    <h3><?= esc_attr(get_option('aila_contact_form_thank_you_title')) ?></h3>
    <p class="thank_you_message"><?= esc_attr(get_option('aila_contact_form_thank_you_message')) ?></p>

    <div class="button_container">
        <span class="button close_modal">Ok</span>
    </div>
</div>
