<?php
/* Template for displaying product-en taxonomy archives */

get_header();

// Include the archive-product.php template from the WooCommerce folder
wc_get_template_part('archive', 'product');

get_footer();
?>
