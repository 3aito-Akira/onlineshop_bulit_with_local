<?php

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <img src="<?php echo get_template_directory_uri(); ?>/sea.jpeg?<?php echo date("YmdHis");?>" alt="" />

    <?php echo do_shortcode('[contact-form-7 id="885e141" title="Contact Us"]');?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
