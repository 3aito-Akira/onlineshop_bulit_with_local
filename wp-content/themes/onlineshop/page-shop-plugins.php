<?php
/*
 * Template Name: Shop Page
 */

get_header('shop-plugins');
?>

<main id="main" class="site-main">
        <div>shop plugins</div>
        <?php
// Check if WooCommerce is active
if ( class_exists( 'WooCommerce' ) ) {
    // Display WooCommerce notices
    woocommerce_output_all_notices();

    // Set up WooCommerce product query
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12, // 表示する商品数を設定
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat', // WooCommerceのカテゴリは 'product_cat'
                'field'    => 'slug',        // スラッグでフィルタリング
                'terms'    => 'plugins',     // 表示したいカテゴリのスラッグ
            ),
        ),
    );
    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) {
        // Display WooCommerce product archive
        woocommerce_product_loop_start();

        while ( $loop->have_posts() ) {
            $loop->the_post();

            /**
             * Hook: woocommerce_shop_loop.
             */
            do_action( 'woocommerce_shop_loop' );

            wc_get_template_part( 'content', 'product' );
        }

        woocommerce_product_loop_end();
    } else {
        // If no products found
        do_action( 'woocommerce_no_products_found' );
    }

    // Reset the global post object to the main query loop.
    wp_reset_postdata();

} else {
    echo 'WooCommerce is not active.';
}
?>

    </main>
</div>

<?php

get_footer('shop');
?>
