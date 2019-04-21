<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


    function render_press_table($articles, $mobile) {
        ob_start();
        ?>
            <table class="press_articles <?= $mobile ? 'mobile' : '' ?>">
                <thead></thead>
        		<tbody>
                    <tr>
                    <?php
                        foreach ($articles as $i => $article) :
                            $logo = $article['logo'];
                            $excerpt = $article['excerpt'];
                            $link = $article['url'];
                            $link_url = '';
                            $target = '';

                            $logo_url = !empty($logo) ? $logo['url'] : '';

                            if (!empty($link)) {
                                $link_url = $link['url'];
                                $target = $link['target'];
                            }
                    ?>
                        <td>
                            <div class="background"></div>
                            <div class="press_articles__content">
                                <img src="<?= $logo_url ?>">
                                <p><?= $excerpt ?></p>
                                <a
                                    href="<?= $link_url ?>"
                                    target="<?= $target ?>"
                                >
                                    <h5>Read More</h5>
                                </a>
                            </div>
                        </td>
                    <?php
                            new_table_row($articles, $i, $mobile);
                        endforeach;
                    ?>
                    </tr>
                </tbody>
            </table>
        <?php
        return ob_get_clean();
    }

    if ($articles = get_field('press_articles')) {
        echo '<div class="page_container page_section">';
            echo render_press_table($articles, false);
            echo render_press_table($articles, true);
            echo '<script>window.hasHoverTableBlocks = true;</script>';
        echo '</div>';
    }
