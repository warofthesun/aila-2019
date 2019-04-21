<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

 function new_table_row($list, $i, $mobile) {
 	if (
 		((!$mobile && $i % 3 == 2) || ($mobile && $i % 2 == 1)) &&
 		$i < count($list) - 1
 	) echo '</tr><tr>';
 }

function get_blog_posts_table($posts) {
	$i = 0;
	ob_start();
	?>
		<table id="blog_posts">
	        <thead><thead>
	        <tbody>
	        <?php while ($posts->have_posts()) : $posts->the_post(); ?>
	            <?php
	                $post_url = get_the_permalink();
                    $post_type = get_post_type();
	                $cats = $post_type == 'post' ? get_the_category() : wp_get_post_terms(get_the_ID(), ['tools-product']);

	                // $image = get_field('background_image');
	                $image_url = get_the_post_thumbnail_url();

	                $author = get_post_field('post_author');
	                $author_name = get_the_author_meta('display_name', $author);
	                $author_nicename = get_the_author_meta('nicename', $author);

	                $post_date = get_the_date('m.d.y');
	                $post_date_url = get_the_time('Y/m');

	                if (!$i % 2) echo '<tr>';
	            ?>
	            <td class="blog_post" data-post-id="<?= get_the_ID(); ?>">
	                <div class="blog_post__img">
	                    <a href="<?= $post_url ?>" class="blog_post__image">
	                        <?php if ($image_url) : ?>
	                            <div style="background-image: url(<?= $image_url ?>);"></div>
	                        <?php endif; ?>
	                    </a>
	                </div>
	                <div class="blog_post__categories">
	                    <?php print_category_link_list($cats, $post_type); ?>
	                </div>
	                <a href="<?= $post_url ?>" class="blog_post__title">
	                    <h4><?php the_title(); ?></h4>
	                </a>
	                <?php if (!empty($author_name) && $post_type == 'post') : ?>
	                    <p class="blog_post__author">
	                        By <a href="/blog/author/<?= $author_nicename ?>"><?= $author_name ?></a>
	                        <span class="author_pipe">|</span>
	                        <a href="/blog/<?= $post_date_url ?>"><?= $post_date ?></a>
	                    </p>
	                <?php endif; ?>
	                <p class="blog_post__blurb"><?= wp_trim_words(get_the_content(), 35); ?></p>
	                <a class="blog_post__read_more" href="<?= $post_url ?>">
	                    <h5>Read More</h5>
	                </a>
	            </td>
	            <?php
	                $count = $posts->post_count;

	                if ($count % 2 && $i == $count - 1) echo '<td class="spacer"></td>';
	                if ($i % 2) echo '</tr>';
	                $i++;
	            ?>
	        <?php endwhile; wp_reset_postdata(); ?>
	        </tbody>
	    </table>
	<?php
	return ob_get_clean();
}


function get_hover_table($cells, $mobile) {
	ob_start();
	?>
	<table class="hover_table <?= $mobile ? 'mobile' : '' ?>">
		<thead></thead>
		<tbody>
			<tr>
			<?php
				foreach ($cells as $i => $cell) :
					$title = $cell['title'];
					$text = $cell['text'];
			?>
				<td>
					<div class="background"></div>
					<div class="hover_table__content">
						<h4><?= $title ?></h4>
						<p><?= $text ?></p>
					</div>
				</td>
			<?php
					new_table_row($cells, $i, $mobile);
				endforeach;
			?>
			</tr>
		</tbody>
	</table>
	<?php
	return ob_get_clean();
}

function print_hover_tables($cells) {
	echo get_hover_table($cells, false);
	echo get_hover_table($cells, true);
    echo '<script>window.hasHoverTableBlocks = true;</script>';
}
