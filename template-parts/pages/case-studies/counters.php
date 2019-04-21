<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($counters = get_field('counters_group')) :
        $title = $counters['title'];
        $counts = $counters['counts'];
?>
    <div id="case_studies__counters" class="page_container page_section">
        <h2><?= $title ?></h2>

        <?php if (!empty($counts)) : ?>
            <script>window.counters = [];</script>
            <?php
                foreach ($counts as $i => $counter) :
                    $label = $counter['label'];
                    $starting = $counter['starting_number'];
                    $ending = $counter['ending_number'];
                    $prefix = $counter['prefix'];
                    $suffix = $counter['suffix'];
            ?>
                <div class="counter">
                    <div class="counter__number">
                        <?php
                            if (!empty($prefix)) {
                                echo '<span class="prefix">' . $prefix . '</span>';
                            }
                        ?><span id="counter_<?= $i ?>"><?= $ending ?></span><?php
                            if (!empty($suffix)) {
                                echo '<span class="suffix">' . $suffix . '</span>';
                            }
                        ?>
                    </div>
                    <h5><?= $label ?></h5>
                </div>
                <?php if (isset($starting) && isset($ending)) : ?>
                <script>
                    window.counters.push({
                        id: 'counter_<?= $i ?>',
                        startingNumber: <?= $starting ?>,
                        endingNumber: <?= $ending ?>
                    });
                </script>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php
    endif;
