<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'contact_form';
?>

<div id="admin_page">
    <h1>Aila Theme Settings</h1>
    <?php settings_errors(); ?>
    <div class="wrap">
        <form method="post" action="options.php">
            <h2 class="nav-tab-wrapper">
                <a
                    href="?page=aila_settings&tab=modal"
                    class="nav-tab <?= $active_tab == 'contact_form' ? 'nav-tab-active' : '' ?>"
                >
                    Contact Form Options
                </a>
            </h2>
            <?php
                settings_fields('aila-modal-options');
                do_settings_sections('aila_settings');

                submit_button();
            ?>
        </form>
    </div>
</div>
