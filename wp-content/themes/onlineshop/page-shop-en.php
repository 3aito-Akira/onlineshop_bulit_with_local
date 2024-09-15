<?php
/**
 * Template Name: shop-en
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

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
add_action('woocommerce_before_main_content', 'custom_before_main_content_check');
function custom_before_main_content_check() {
    if ( function_exists('woocommerce_output_content_wrapper') ) {
        echo '<p>woocommerce_output_content_wrapper exists and will be called.</p>';
    } else {
        echo '<p>woocommerce_output_content_wrapper does not exist.</p>';
    }
}

do_action( 'woocommerce_before_main_content' );

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );


if ( woocommerce_product_loop() ) {


	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );


	woocommerce_product_loop_start();

    // WooCommerceのメインクエリをカスタマイズ
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'english-products',
        ),
    ),
);

$loop = new WP_Query($args);

if ($loop->have_posts()) {
    //woocommerce_product_loop_start();
    wc_set_loop_prop( 'total', $loop->found_posts );


    while ($loop->have_posts()) : $loop->the_post();
        wc_get_template_part('content', 'product');
    endwhile;

    woocommerce_product_loop_end();
} else {
    echo __('No products found');
}

wp_reset_postdata();

$total_products = wc_get_loop_prop( 'total', 0 );
echo '<p>***********wc_get_loop_prop( total, 0 ): ' . $total_products . '</p>';    
echo '<p>'.'in total '.$total_products . ' items are shown'.'</p>';

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );

?>

