<?php

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

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
