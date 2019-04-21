<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($cs_and_ps = get_field('customers_and_partners')) :
        $customers = $cs_and_ps['customers'];
        $partners = $cs_and_ps['partners'];

        if (!empty($customers) || !empty($partners)) :
?>
        <div id="solutions__cs_and_ps" class="float_clear">
            <?php
                if (!empty($customers)) :
                    $title = $customers['title'];
                    $logos = $customers['logos'];
            ?>
            <div class="float_left" id="solutions__customers">
                <h6><?= $title ?></h6>
                <div class="solutions__logos">
                    <?php
                        foreach ($logos as $logo) :
                            $image = $logo['logo'];
                            $url = !empty($image) ? $image['url'] : '';
                            $logo_title = $logo['title'];

                            if (!empty($url)) :
                    ?>
                    <img
                        src="<?= $url ?>"
                        alt="<?= $logo_title ?>"
                        title="<?= $logo_title ?>"
                    >
                <?php endif; endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php
                if (!empty($partners)) :
                    $title = $partners['title'];
                    $logos = $partners['logos'];
            ?>
            <div class="float_left" id="solutions__partners">
                <h6><?= $title ?></h6>
                <div class="solutions__logos">
                    <?php
                        foreach ($logos as $logo) :
                            $image = $logo['logo'];
                            $url = !empty($image) ? $image['url'] : '';
                            $logo_title = $logo['title'];

                            if (!empty($url)) :
                    ?>
                    <img
                        src="<?= $url ?>"
                        alt="<?= $logo_title ?>"
                        title="<?= $logo_title ?>"
                    >
                <?php endif; endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
<?php
        endif;
    endif;
