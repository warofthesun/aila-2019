<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


    use Abraham\TwitterOAuth\TwitterOAuth as Twitter;

    $twitter_feed = get_field('twitter_feed');
    $twitter_user = 'AilaTech';
    $twitter_tweets_number = 3;
    $tweets = [];

    if (!empty($twitter_feed)) {
        $twitter_user = $twitter_feed['twitter_account'];
        $twitter_tweets_number = $twitter_feed['number_of_tweets'];
    }

    $cons_key = 'F8fkQCFgKqCBuyuInCqrr3SxG';
    $cons_secret = 'CX5Cf998MatzRSo2ikPrKTZhGWQZaOPYQPhpUPbLeDmjltp0cz';
    $access_token = '1035209627330338816-sFy2WZYvhHsUFehxhVzTeXfUaFCpMz';
    $access_secret = 'ti0kWnc8opyy2weKkLtUGKBy5FKs4ZLZj2j7QOW8pthNx';

    $connection = new Twitter($cons_key, $cons_secret, $access_token, $access_secret);

    $tweets_array = $connection->get(
        'statuses/user_timeline', [
            'screen_name' => $twitter_user,
            'count' => $twitter_tweets_number,
            'tweet_mode' => 'extended'
        ]
    );

    if (empty($tweets_array->errors)) {
        foreach ($tweets_array as $tweet) {
            $tweets []= $tweet->id;
        }
    }

    get_template_part('/template-parts/global/blog-filter-bar');
?>
    <div id="blog_post__list" class="page_container">
        <?php
            echo do_shortcode('[aila-blog-posts]');
            get_template_part('template-parts/pages/blog/load-more');
        ?>
    </div>
<?php
    include(locate_template('template-parts/pages/blog/twitter-feed.php', false, false));
