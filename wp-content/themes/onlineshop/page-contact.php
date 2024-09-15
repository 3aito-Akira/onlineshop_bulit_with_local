<?php

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <img src="<?php echo get_template_directory_uri(); ?>/okinawa-blue.jpg?<?php echo date("YmdHis");?>" alt="" />

    <?php echo do_shortcode('[contact-form-7 id="9152b54" title="お問い合わせ"]');?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
