<?php

defined( 'ABSPATH' ) || exit; // セキュリティ対策のためにコメントアウトしない

get_header( 'shop' );

/*
do_action( 'woocommerce_shop_loop_header' );


if ( class_exists( 'WooCommerce' ) ) {
    // 商品リストの表示
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 8,
        'paged'          => $paged,
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => 'plugins',
            ),
        ),
    );

    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) {
        do_action( 'woocommerce_before_shop_loop' );
        woocommerce_product_loop_start();

        while ( $loop->have_posts() ) {
            $loop->the_post();
            //echo "<div>取得したpost " . get_the_title() . "</div>";
            do_action( 'woocommerce_shop_loop' );
            wc_get_template_part( 'content', 'product' ); // 商品のテンプレートを取得
        }

        woocommerce_product_loop_end();
        do_action( 'woocommerce_after_shop_loop' );
    } else {
        echo '商品が見つかりませんでした。'; // より具体的なメッセージにしても良いかもしれません
    }

    wp_reset_postdata(); // 投稿データをリセット
} else {
    echo 'WooCommerceが有効ではありません。';
}

do_action( 'woocommerce_after_main_content' );
do_action( 'woocommerce_sidebar' );
*/

?>

    <main id="main" class="site-main">
        <?php
        if ( file_exists( get_template_directory() . '/woocommerce/archive-product.php' ) ) {
            include( get_template_directory() . '/woocommerce/archive-product.php' );
        } else {
            wc_get_template( '/woocommerce/archive-product.php' );
        }
        ?>
    </main>

<?php
get_footer( 'shop' );
