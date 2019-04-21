<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */
?>

<form role="search" action="<?= home_url('/'); ?>" method="get" id="search_form">
    <input type="search" name="s" value="<?= get_search_query(); ?>" placeholder="Search...">
    <input type="hidden" name="post_type" value="<?= get_blog_type() ?>">
</form>
