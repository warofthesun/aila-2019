<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $logo_url = wp_get_attachment_image_src(get_theme_mod('custom_logo') , 'full')[0];
    $post_type = get_post_type();
    $is_case_study = $post_type == 'case-study';

    function print_logo($id, $logo_url, $is_case_study) {
        if (!empty($logo_url) && !$is_case_study) {
            ?>
                <a href="/" id="<?= $id ?>" class="logo_container float_left">
                    <img
                        src="<?= $logo_url ?>"
                        alt="Aila Technologies, Inc."
                        title="Aila Technologies, Inc."
                    >
                </a>
            <?php
        } elseif ($is_case_study) {
            ?>
                <a href="/" id="<?= $id ?>" class="logo_container float_left">
                    <img
                        src="<?= get_template_directory_uri() ?>/images/aila-logo-primary.svg"
                        alt="Aila Technologies, Inc."
                        title="Aila Technologies, Inc."
                    >
                </a>
            <?php
        }
    }
?>
    <div id="top_nav__container">
        <nav id="top_nav" class="float_clear <?= $is_case_study ? 'inverted' : '' ?>">
            <?php
                line('h', 'nav_1', 'white');
                print_logo('top_nav_aila_logo', $logo_url, $is_case_study);
            ?>

            <i class="hotdogs" id="hotdogs_main"></i>

            <div id="top_nav_overlay"></div>
            <div id="top_nav_drawer">
        		<div class="page_container">
        			<i id="top_nav_close" class="closer" aria-hidden="true"></i>

        			<a href="/" id="top_nav_drawer_logo">
        				<img
        					src="<?= get_template_directory_uri() ?>/images/aila-logo-black.svg"
        					alt="Aila Technologies, Inc."
        					title="Aila Technologies, Inc."
        				>
        			</a>

        			<?php
        				wp_nav_menu([
        					'theme_location' => 'main-menu',
        					'menu_id' => 'main_menu_top',
        					'menu_class' => 'main_menu top',
        					'container' => null,
        					'fallback_cb' => false,
        				]);
        			?>

        			<?php
        				wp_nav_menu([
        					'theme_location' => 'social-menu',
        					'menu_id' => 'social_menu_top',
        					'menu_class' => 'social_menu top',
        					'container' => null,
        					'fallback_cb' => false,
        				]);
        			?>
        		</div>
        	</div>
        </nav>
    </div>

    <nav id="top_nav_sticky" class="inverted">
        <div class="page_container float_clear">
            <?php
                print_logo('top_nav_sticky_logo', $logo_url, true);
                wp_nav_menu([
                    'theme_location' => 'main-menu',
                    'menu_id' => 'main_menu_sticky',
                    'menu_class' => 'main_menu top',
                    'container' => null,
                    'fallback_cb' => false,
                ]);
                wp_nav_menu([
                    'theme_location' => 'social-menu',
                    'menu_id' => 'social_menu_sticky',
                    'menu_class' => 'social_menu top',
                    'container' => null,
                    'fallback_cb' => false,
                ]);
            ?>
            <i class="hotdogs" id="hotdogs_sticky"></i>
        </div>
    </nav>
<?php
