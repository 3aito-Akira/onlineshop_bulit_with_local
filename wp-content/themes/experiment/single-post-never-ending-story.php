<?php
get_header();


echo("<div>Never Ending Story</div>");

$args = array(
    'category_name' => 'diary', // カテゴリースラッグを指定
    'posts_per_page' => 10, // 表示する投稿の数
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        // 投稿データを表示
        echo "<div>the first query</div>";
        the_title('<h1>', '</h1>'); // 投稿タイトルを表示
        the_content(); // 投稿本文を表示
    }
    wp_reset_postdata(); // クエリをリセット
}

echo "<div>the second query</div>";
$args = array(
    'tax_query' => array(
    array(
        'taxonomy' => 'post_tag', // タクソノミー名を指定
        'field'    => 'slug', // タームをスラッグで指定
        'terms'    => 'fantasy', // タームスラッグを指定
    ),
    ),
    'posts_per_page' => 10, // 表示する投稿の数
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        // 投稿データを表示
        the_title('<h1>', '</h1>'); // 投稿タイトルを表示
        the_content(); // 投稿本文を表示
    }
    wp_reset_postdata(); // クエリをリセット
}

echo "<div>the third query</div>";
$args = array(
    'post_type' => 'post', // カスタム投稿タイプを指定
    'tax_query' => array(
    array(
        'taxonomy' => 'category', // タクソノミー名を指定
        'field'    => 'slug', // タームをスラッグで指定
        'terms'    => 'diary', // タームスラッグを指定
    ),
    ),
    'posts_per_page' => 10, // 表示する投稿の数
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        // 投稿データを表示
        the_title('<h1>', '</h1>'); // 投稿タイトルを表示
        the_content(); // 投稿本文を表示
    }
    wp_reset_postdata(); // クエリをリセット
}




get_footer();

?>
