<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($working = get_field('working_with_aila')) :
        $heading = $working['heading'];
        $statements = $working['statements'];
?>
    <div id="partners__working_with_aila">
        <?php if (!empty($heading)) { ?><h4><?= $heading ?></h4><?php } ?>
        <ul>
            <?php foreach ($statements as $statement) : ?>
            <li><?= $statement['statement'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php
    endif;
