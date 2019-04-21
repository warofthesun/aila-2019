<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


add_filter('show_admin_bar', '__return_false');

require_once('includes/theme-setup.php');
require_once('includes/helper-functions.php');
require_once('includes/enqueues.php');

require_once('plugins/acf/acf.php');

require 'vendor/autoload.php';
