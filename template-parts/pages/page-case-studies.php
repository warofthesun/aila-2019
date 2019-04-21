<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


get_template_part('template-parts/pages/case-studies/counters');
get_template_part('template-parts/global/quote');

?>
<div id="case_studies__posts">
    <div class="page_container page_section">
    <?php
        get_template_part('template-parts/pages/case-studies/case-studies');
        get_template_part('template-parts/pages/case-studies/installations');
    ?>
    </div>
    <?php
        line('v', 'studies_1');
        line('h', 'studies_2');
        bend('r-u', 'studies_3');
        line('v', 'studies_4');
    ?>
    <script>window.hasCaseStudiesLines = true;</script>
</div>
<?php
