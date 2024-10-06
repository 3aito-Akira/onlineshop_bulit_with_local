<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">

		<?php
		//$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Other products', 'onlineshop' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 4, // 表示する商品の数
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => 'recommended', // おすすめ商品カテゴリーのスラッグ
				),
			),
		);

		$recommended_products = new WP_Query( $args );

		// おすすめ商品を表示
		if ( $recommended_products->have_posts() ) {
			woocommerce_product_loop_start();
			
			while ( $recommended_products->have_posts() ) {
				$recommended_products->the_post();
				
				wc_get_template_part( 'content', 'product' );
			}
			
			woocommerce_product_loop_end();
		}
		?>
	</section>
	<?php
endif;

wp_reset_postdata();
