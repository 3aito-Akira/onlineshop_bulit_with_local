<?php
/* Template Name: My Account Custom */
get_header();

if ( ! is_user_logged_in() ) {
    // ユーザーがログインしていない場合、ログインフォームを表示
    echo do_shortcode('[woocommerce_my_account]');
    echo '<div>page-my-account</div>';
} else {
    // ユーザーがログインしている場合、ダッシュボードを表示
    woocommerce_account_content();
}

get_footer();
