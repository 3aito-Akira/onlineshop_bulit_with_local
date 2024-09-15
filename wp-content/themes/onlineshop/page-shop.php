<?php
/*
 * Template Name: Shop Page
 */

get_header('shop');
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        // Check if WooCommerce is active
        if ( class_exists( 'WooCommerce' ) ) {
            // Load WooCommerce product archive template
            wc_get_template_part( 'archive-product' );
        } else {
            echo 'WooCommerce is not active.';
        }
        ?>
    </main>
</div>

<?php

get_footer('shop');
?>
