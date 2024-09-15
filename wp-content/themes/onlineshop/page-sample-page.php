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
        // Include the cart template from WooCommerce
        if ( file_exists( get_template_directory() . '/woocommerce/cart/cart.php' ) ) {
            include( get_template_directory() . '/woocommerce/cart/cart.php' );
        } else {
            // Fallback to WooCommerce plugin template if custom template doesn't exist
            wc_get_template( 'cart/cart.php' );
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
