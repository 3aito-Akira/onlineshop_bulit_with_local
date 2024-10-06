<?php
/*
 * Template Name: shop
 */
defined( 'ABSPATH' ) || exit;

get_header('shop');
?>


<?php
set_query_var('price', get_field('price', get_the_ID()));
set_query_var('color', get_field('color', get_the_ID()));
set_query_var('size', get_field('size', get_the_ID()));
set_query_var('item_number', get_field('item_number', get_the_ID()));
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

get_footer('shop');
?>
