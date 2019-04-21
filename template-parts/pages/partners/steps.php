<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($steps_group = get_field('steps_group')) :
        $heading = $steps_group['heading'];
        $steps = $steps_group['steps'];

        if (!empty($steps)) :
?>

        <div id="partners__steps">
            <h2><?= $heading ?></h2>
            <?php print_hover_tables($steps); ?>
        </div>

<?php
        endif;
    endif;
