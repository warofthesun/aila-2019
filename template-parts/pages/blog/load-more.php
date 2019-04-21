<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    global $blog_posts;
    $total_pages = $blog_posts->max_num_pages;

    if ($total_pages > 1) :
        $category = get_category(get_query_var('cat'));
        $tag = get_queried_object();
        $author = get_query_var('author');
        $year = get_query_var('year');
        $month = get_query_var('monthnum');
        $search = get_search_query();
?>

<div id="blog_post__load_more">
    <span class="button" id="load_more_posts">Load More <?php get_icon('down-arrow'); ?></span>
</div>
<script>
    jQuery(function ($) {
        var pagesLeft = <?= $total_pages ?> - 1,
            isCategory = <?= is_category() ? 1 : 0 ?>,
            isTag = <?= is_tag() ? 1 : 0 ?>,
            isAuthor = <?= is_author() ? 1 : 0 ?>,
            isSearch = <?= is_search() ? 1 : 0 ?>,
            button = $('#load_more_posts'),
            buttonContent = button.html(),
            postsPerPage = parseInt(<?= get_option('posts_per_page') ?>, 10) * 2;

        button.on('click', function (e) {
            var ids = '';

            e.preventDefault();

            // $('.blog_post').each(function (i, post) {
            //     ids += $(this).data('post-id') + ',';
            // });

            $(this).html('Loading...');

            setTimeout(function () {
                var options = {
                    // ids: ids,
                    postsPerPage: postsPerPage,
                    date: {
                        year: '<?= !empty($year) ? $year : '' ?>',
                        month: '<?= !empty($month) ? $month : '' ?>'
                    }
                };

                if (isCategory) {
                    options['category'] = '<?= !$category->errors ? $category->cat_ID : '' ?>';
                } else if (isTag) {
                    options['tag'] = '<?= is_object($tag) ? $tag->slug : '' ?>';
                } else if (isAuthor) {
                    options['author'] = '<?= !empty($author) ? $author : '' ?>';
                } else if (isSearch) {
                    options['s'] = '<?= !empty($search) ? $search : '' ?>';
                }

                $.post('/single-pagination/',
                options,
                function (data) {
                    $('#blog_posts').remove();
                    $('#blog_posts__container').append(data);
                    $('#load_more_posts').html(buttonContent);

                    postsPerPage += parseInt(<?= get_option('posts_per_page') ?>, 10);
                    pagesLeft--;

                    if (pagesLeft <= 0) {
                        $('#load_more_posts').hide();
                    }
                });
            }, 300);
        });
    });
</script>

<?php
    endif;
