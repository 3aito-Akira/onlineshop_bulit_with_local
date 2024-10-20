<?php

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        
        <div>akiyaさんが編集可能な箇所の実験箇所</div>
        <div>akiyaさんが編集したい文章</div>
        <?php
        // 固定ページの ID を指定
        $post_id = 2; // 編集したい固定ページの ID に変更

        // 固定ページのカスタムメタデータを取得
        $content = get_post_meta($post_id, 'sample_page_content', true);

        // データが存在する場合は表示、存在しない場合はメッセージを表示
        if ($content) {
            echo '<div>' . esc_html($content) . '</div>';
        } else {
            echo '<div>データがありません。</div>';
        }
        ?>

<?php
// 現在の投稿の ID を取得
$post_id = get_the_ID();

// 保存された「関連ページ」を取得
$related_pages = get_post_meta($post_id, 'related_pages', true);

if (!empty($related_pages)): ?>
    <div class="related-pages">
        <h3>関連ページ</h3>
        <ul>
            <?php foreach ($related_pages as $page): ?>
                <li>
                    <a href="<?php echo esc_url($page['url']); ?>" target="_blank">
                        <?php echo esc_html($page['label']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
