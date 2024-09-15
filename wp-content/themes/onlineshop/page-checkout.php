<?php
/**
 * Template Name: Checkout Page
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Ensure WooCommerce functions are loaded
        if ( class_exists( 'WooCommerce' ) ) {
            // Display the WooCommerce Checkout form
            echo do_shortcode('[woocommerce_checkout]');
        } else {
            echo '<p>WooCommerce plugin is not activated. Please activate it to use the checkout page.</p>';
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
