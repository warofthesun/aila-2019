<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */
?>

<footer class="float_clear">
    <?php
        wp_nav_menu([
            'theme_location' => 'footer-menu',
            'menu_id' => 'main_menu_bottom',
            'menu_class' => 'main_menu bottom',
            'container' => null,
            'fallback_cb' => false,
        ]);
    ?>

    <div id="footer_logo_container" class="float_right float_clear">
        <a href="/" id="footer_logo">
            <img
                src="<?= get_template_directory_uri() ?>/images/aila-logo-footer.png"
                alt="Aila Technologies, Inc."
                title="Aila Technologies, Inc."
            >
        </a>

        <?php
            wp_nav_menu([
                'theme_location' => 'social-menu',
                'menu_id' => 'social_menu_bottom',
                'menu_class' => 'social_menu bottom',
                'container' => null,
                'fallback_cb' => false,
            ]);
        ?>
    </div>

    <div id="footer_policies">
        <div id="footer_copy">
            &copy; <?= date('Y') ?> Aila Technologies, Inc.
            <span class="all_rights">All rights reserved.</span>
        </div>
        <?php
            wp_nav_menu([
                'theme_location' => 'policy-menu',
                'menu_id' => 'policy_menu',
                'container' => null,
                'fallback_cb' => false,
            ]);
        ?>
    </div>
</footer>

<?php
    line('h', 'footer_1');
    bend('l-d', 'footer_2');
    line('v', 'footer_3');
?>
<script>window.hasFooterLines = true;</script>

<iframe id="file_download" width="0" height="0"></iframe>

<div id="file_download_form">
    <?php
        $download_form_id = esc_attr(get_option('aila_download_shortcode'));
        echo do_shortcode('[aila-modal modal_type="download" form_id="' . $download_form_id . '"]');
    ?>
</div>
