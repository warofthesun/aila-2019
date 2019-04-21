<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if (!empty($tweets)) :
        // twitter widget script //
        echo '<script>window.twttr=(function(f,b,g){var e,c=f.getElementsByTagName(b)[0],a=window.twttr||{};if(f.getElementById(g)){return a}e=f.createElement(b);e.id=g;e.src="https://platform.twitter.com/widgets.js";c.parentNode.insertBefore(e,c);a._e=[];a.ready=function(d){a._e.push(d)};return a}(document,"script","twitter-wjs"));</script>';
?>
    <div id="twitter__container" class="page_section">
        <h2>
            Tweets <small>by <a href="https://twitter.com/<?= $twitter_user ?>" target="_blank">@<?= $twitter_user ?></a></small>
        </h2>
        <div id="twitter__tweets" class="page_container">
            <?php foreach ($tweets as $i => $tweet) : ?>
            <div id="tweet_<?= $i ?>" class="tweet"></div>
            <script>
                twttr.ready(function (twttr) {
                    twttr.widgets.createTweet('<?= $tweet ?>', document.getElementById('tweet_<?= $i ?>'));
                });
            </script>
            <?php endforeach; ?>
        </div>
    </div>
<?php
    endif;
