<?php
/* Template Name: My Account Custom */
get_header();

if ( ! is_user_logged_in() ) {
    echo do_shortcode('[user_registration_form id="354"]');
} else {
    woocommerce_account_content();
}

get_footer();
