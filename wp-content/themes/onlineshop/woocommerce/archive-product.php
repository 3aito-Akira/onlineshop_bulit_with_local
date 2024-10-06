<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );

do_action( 'woocommerce_shop_loop_header' );

if ( woocommerce_product_loop() ) {

    do_action( 'woocommerce_before_shop_loop' );

    woocommerce_product_loop_start();

    if ( wc_get_loop_prop( 'total' ) ) {
        while ( have_posts() ) {
            the_post();
            do_action( 'woocommerce_shop_loop' );

            wc_get_template_part( 'content', 'product' ); 
        }
    } else {
        echo '<div>商品が見つかりませんでした (WooCommerce 標準ループ)。</div>';
    }

    woocommerce_product_loop_end();

    do_action( 'woocommerce_after_shop_loop' );


} else {
    echo '<div>woocommerce_product_loop() は false を返しました。</div>'; 
}

do_action( 'woocommerce_after_main_content' );


do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
