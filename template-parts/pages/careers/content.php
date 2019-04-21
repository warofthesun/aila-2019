<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $heading = get_field('heading');
    $text = get_field('text');
    $columns = get_field('columns');
    $openings_type = get_field('openings');
    $breezy_src = get_field('breezy_script_src');
    $postions_heading = get_field('postions_heading');
    $positions_footer = get_field('positions_footer');
?>
    <div id="careers" class="page_container page_section">
        <?php if ($heading) { ?><h2><?= $heading ?></h2><?php } ?>
        <?php if ($text) { ?><p class="sub-heading"><?= $text ?></p><?php } ?>
        <?php
            if (is_array($columns) && count($columns) > 0) {
                echo '<ul id="careers__columns" class="float_clear">';

                foreach ($columns as $column) {
                    $icon = $column['icon'];
                    $title = $column['title'];
                    $text = $column['text'];

                    echo '<li>';
                        get_icon($icon);
                        if ($title) echo '<h4>' . $title . '</h4>';
                        if ($text) echo '<p>' . $text . '</p>';
                    echo '</li>';
                }

                echo '</ul>';
            }

            if ($postions_heading) echo '<h2 id="careers__position_heading">' . $postions_heading . '</h2>';

            if ($openings_type === 'breezy') {
                if (empty($breezy_src)) $breezy_src = 'https://aila-technologies.breezy.hr/embed/js?inline=true&group_by=none';
            ?>
                <div id="bzOpeningsContainer"></div>
                <script src="<?= $breezy_src ?>"></script>
            <?php
            } else {
                echo do_shortcode('[aila-career-posts]');
            }

            if ($positions_footer) echo '<p id="careers__position_footer">' . $positions_footer . '</p>';
        ?>
    </div>
<?php
