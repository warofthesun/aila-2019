<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($quote_section = get_field('quote')) :
        $quote = $quote_section['quote'];
        $quote_credit = $quote_section['quote_citation'];
?>

<div id="case_study__quote" class="quote_section">
    <div class="quote_section__content">
        <q><?= $quote ?></q>
        <cite><?= $quote_credit ?></cite>
    </div>
</div>

<?php
    endif;
