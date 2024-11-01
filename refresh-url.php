<?php

function zhanzhangb_tcdn_publish_url($post_ID) {
    require_once zhanzhangbtcdn_DIR . '/refresh-function.php';
    $settings = get_option('zhanzhangb_tcdn_settings');
    $zhanzhangb_post_ID = $post_ID;

    $zhanzhangb_refresh_urls = array(get_permalink($zhanzhangb_post_ID));
    if ($settings['home_url_option'] != 'no_refresh') {
        $zhanzhangb_refresh_urls[] = get_home_url();
    }
    if ($settings['category_url_option'] != 'no_refresh') {
        if (get_post_type($zhanzhangb_post_ID) != 'page') {
            $categories = get_the_category($zhanzhangb_post_ID);
            foreach ($categories as $category) {
                $zhanzhangb_refresh_urls[] = get_category_link($category->cat_ID);
            }
        }
    }
    if ($settings['tag_url_option'] != 'no_refresh') {
        $tags = get_the_tags($zhanzhangb_post_ID);
        if ($tags) {
            foreach ($tags as $tag) {
                $zhanzhangb_refresh_urls[] = get_tag_link($tag->term_id);
            }
        }
    }

    $zhanzhangb_cache_urls = array();
    if ($settings['article_url_option'] == 'refresh_and_preload') {
        $zhanzhangb_cache_urls[] = get_permalink($zhanzhangb_post_ID);
    }
    if ($settings['home_url_option'] == 'refresh_and_preload') {
        $home_url = get_home_url();
        if (substr($home_url, -1) !== '/') {
            $home_url .= '/';
        }
        $zhanzhangb_cache_urls[] = $home_url;
    }
    if ($settings['category_url_option'] == 'refresh_and_preload') {
        if (get_post_type($zhanzhangb_post_ID) != 'page') {
            $categories = get_the_category($zhanzhangb_post_ID);
            foreach ($categories as $category) {
                $zhanzhangb_cache_urls[] = get_category_link($category->cat_ID);
            }
        }
    }
    if ($settings['tag_url_option'] == 'refresh_and_preload') {
        $tags = get_the_tags($zhanzhangb_post_ID);
        if ($tags) {
            foreach ($tags as $tag) {
                $zhanzhangb_cache_urls[] = get_tag_link($tag->term_id);
            }
        }
    }

    $zhanzhangburls = array("refresh" => $zhanzhangb_refresh_urls, "cache" => $zhanzhangb_cache_urls);
    return zhanzhangb_tcdn_refresh($zhanzhangburls);
}

function zhanzhangb_tcdn_comment_url($comment_id) {
    require_once zhanzhangbtcdn_DIR . '/refresh-function.php';
    $zhanzhangb_post_ID = get_comment($comment_id)->comment_post_ID;
    $zhanzhangb_refresh_urls = array(get_permalink($zhanzhangb_post_ID));
    $zhanzhangburls = array("refresh" => $zhanzhangb_refresh_urls, "cache" => '');
    return zhanzhangb_tcdn_refresh($zhanzhangburls);
}

function zhanzhangb_tcdn_approved_url($comment) {
    require_once zhanzhangbtcdn_DIR . '/refresh-function.php';
    $zhanzhangb_post_ID = $comment->comment_post_ID;
    $zhanzhangb_refresh_urls = array(get_permalink($zhanzhangb_post_ID));
    $zhanzhangburls = array("refresh" => $zhanzhangb_refresh_urls, "cache" => $zhanzhangb_refresh_urls);
    return zhanzhangb_tcdn_refresh($zhanzhangburls);
}

add_action('publish_post', 'zhanzhangb_tcdn_publish_url', 10);
add_action('publish_page', 'zhanzhangb_tcdn_publish_url', 10);
add_action('comment_post', 'zhanzhangb_tcdn_comment_url', 10);
add_action('comment_unapproved_to_approved', 'zhanzhangb_tcdn_approved_url', 3);

?>