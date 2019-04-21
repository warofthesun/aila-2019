<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($contact_form = get_field('contact_form')) :
        $heading = $contact_form['heading'];
        $sub_heading = $contact_form['sub-heading'];
        $shortcode = $contact_form['contact_form_shortcode'];

        if ($shortcode) :
?>

<div id="contact_form__container">
    <?php
        line('v', 'contact_1');
        bend('r-d', 'contact_2');
        line('h', 'contact_3');
    ?>

    <div id="contact_form" class="contact_form page_container page_section">
        <h2><?= $heading ?></h2>
        <p><?= $sub_heading ?></p>

        <div class="contact_form__container">
            <?= do_shortcode($shortcode) ?>
        </div>
    </div>

    <?php
        line('v', 'contact_4');
        line('h', 'contact_5');
        bend('r-u', 'contact_6');
        line('v', 'contact_7');
    ?>
    <script>window.hasContactFormLines = true;</script>
</div>

<?php
        endif;
    endif;
