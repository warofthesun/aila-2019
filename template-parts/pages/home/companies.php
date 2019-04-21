<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($companies = get_field('companies')) :
        $heading = $companies['heading'];
        $logos = $companies['logos'];
?>

<div id="home__companies" class="page_container page_section">
    <?php if (!empty($heading)) { ?><h2><?= $heading ?></h2><?php } ?>
    <ul>
    <?php
        foreach ($logos as $logo) :
            $image = $logo['logo'];
            if (!empty($image)) :
    ?>
        <li>
            <img src="<?= $image['url'] ?>">
        </li>
    <?php endif; endforeach; ?>
    </ul>
</div>

<?php
    endif;
