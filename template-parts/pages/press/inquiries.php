<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


    if ($inquiries = get_field('inquiries')) :
        $heading = $inquiries['heading'];
        $contact_1 = $inquiries['contact_1'];
        $contact_2 = $inquiries['contact_2'];

        $both_contacts = !empty($contact_1) && !empty($contact_2);
?>
    <div id="press__inquiries" class="cta_banner">
        <?php
            line('v', 'cta_1');
            line('v', 'cta_2', 'white');
        ?>
        <?php if (!empty($heading)) { ?><h2><?= $heading ?></h2><?php } ?>
        <div class="inquiries float_clear">
            <?php if (!empty($contact_1)) : ?>
            <div class="inquiry float_left <?= !$both_contacts ? 'single' : '' ?>"><?= $contact_1 ?></div>
            <?php endif; if (!empty($contact_2)) : ?>
            <div class="inquiry float_left <?= !$both_contacts ? 'single' : '' ?>"><?= $contact_2 ?></div>
            <?php endif; ?>
        </div>
        <?php
            line('h', 'cta_3', 'white');
            bend('l-u', 'cta_4', 'white');
            line('v', 'cta_5', 'white');
            line('v', 'cta_6', 'white');

            line('h', 'cta_7', 'white');
            bend('r-d', 'cta_8', 'white');
            line('v', 'cta_9', 'white');
            line('h', 'cta_10', 'white');
        ?>
        <script>window.hasFullCtaLines = true;</script>
    </div>
<?php
    endif;
