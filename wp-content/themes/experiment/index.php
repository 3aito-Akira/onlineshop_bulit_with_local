<?php
// WordPressテーマのindex.phpファイルの最低限の構成
get_header(); // ヘッダーを読み込む

if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
        // 投稿やページの内容を表示
        the_title('<h1>', '</h1>');  // 投稿のタイトルを表示
        the_content();  // 投稿の本文を表示
    endwhile;
else : 
    // 投稿がない場合のメッセージ
    echo '<p>No posts found.</p>';
endif;

get_footer(); // フッターを読み込む
