<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($logos_section = get_field('logos')) :
        $title = $logos_section['title'];
        $logos = $logos_section['logos'];

        if (!empty($logos) && is_array($logos)) :
?>

<div id="home_logos__wrapper">
    <div id="home_logos" class="page_container">
        <div id="home_logos__content">
            <?php
                if (!empty($title)) { echo '<h4 class="title">' . $title . '</h4>'; }

                echo '<ul>';

                foreach ($logos as $logo) :
                    $image = $logo['image'];
                    $src = !empty($image) ? $image['url'] : null;
                    if ($src) { echo '<li><img src="' . $src . '" alt=""></li>' ; }
                endforeach;

                echo '</ul>';
            ?>
        </div>
    </div>
</div>

<?php
        endif;
    endif;
