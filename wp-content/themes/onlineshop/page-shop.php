<?php
/*
 * Template Name: Shop Page
 */

get_header('shop');
?>

<?php

set_query_var('price', get_field('price', get_the_ID()));
set_query_var('color', get_field('color', get_the_ID()));
set_query_var('size', get_field('size', get_the_ID()));
set_query_var('item_number', get_field('item_number', get_the_ID()));

?>

    <main id="main" class="site-main">
        <div>akira::::::::::::::::::::::</div>
        <?php
        // Check if WooCommerce is active
        if ( class_exists( 'WooCommerce' ) ) {
            // Load WooCommerce product archive template
            echo '<div>Product information section loaded</div>';
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
