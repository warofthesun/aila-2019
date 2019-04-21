<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


    if ($script = get_field('shopify_script')) {
        echo '<div id="purchase__script" class="page_section page_container">' . $script . '</div>';
    }
