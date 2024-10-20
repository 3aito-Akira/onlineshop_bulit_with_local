<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Schibsted+Grotesk:wght@400..900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery.mb.YTPlayer.min.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/common.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/page.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/vendor/swiper.min.css">
    <?php wp_head(); ?>
</head>
<body <?php 
    if ( !is_front_page() && !is_page('contact')  ) {
        echo 'id="page-fixed" '; 
    }

    //body_class();
    body_class('woocommerce'); 
?>>

<header class="<?php echo is_shop() || is_product() || is_product_category() ? 'header-white' : 'header'; ?>">
        <div class="header_wrap">
            <h1 class="logo">
                <a href="<?php echo home_url('//'); ?>">
                <?php 
                    if ( is_shop() || is_product() || is_product_category()) {
                        echo "<img src=\"" . get_template_directory_uri() . "/img/common/logo-white.svg\" alt=\"AMmotion\">";
                    }
                    else {
                        echo "<img src=\"" . get_template_directory_uri() . "/img/common/logo.svg\" alt=\"AMmotion\">";
                    }
                ?>
                </a>
            </h1>
            <nav class="gnav">
                <ul class="gnav_main">
                    <?php echo is_front_page() ? 
                        '<li><a id="scroll-to-plugins" href="#">Plugins</a></li>
                        <li><a id="scroll-to-colors" href="#">Colors</a></li>' 
                        : 
                        '<li><a href="' . home_url('product-category/plugins') . '") >Plugins</a></li>
                        <li><a href="' . home_url('product-category/colors') . '")>Colors</a></li>'; 
                    ?>
                    <?php
                    $current_lang = pll_current_language();
                    if ( $current_lang === 'ja' ) : 
                        echo '<li><a href="' . home_url('/about-me/') . '">About</a></li>';
                    else:
                        echo '<li><a href="' . home_url('/about-me-en/') . '">About</a></li>';
                    endif; ?>
                </ul>
                <div class="gnav_sub">
                    <div class="gnav_sub-cart">

                        <?php
                            $current_lang = pll_current_language();

                            if(is_shop() || is_product() || is_product_category()):
                                if ( $current_lang === 'ja' ) : 
                                    echo '<a href="' . home_url('/cart/') . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27" fill="none">
                                    <path d="M8.04816 26.0338C7.46814 26.0338 6.97932 25.835 6.58172 25.4374C6.18434 25.0398 5.98566 24.5511 5.98566 23.9713C5.98566 23.3913 6.18434 22.9025 6.58172 22.5049C6.97932 22.1075 7.46814 21.9088 8.04816 21.9088C8.62818 21.9088 9.11687 22.1075 9.51425 22.5049C9.91185 22.9025 10.1107 23.3913 10.1107 23.9713C10.1107 24.5511 9.91185 25.0398 9.51425 25.4374C9.11687 25.835 8.62818 26.0338 8.04816 26.0338ZM20.9518 26.0338C20.3718 26.0338 19.8831 25.835 19.4858 25.4374C19.0881 25.0398 18.8893 24.5511 18.8893 23.9713C18.8893 23.3913 19.0881 22.9025 19.4858 22.5049C19.8831 22.1075 20.3718 21.9088 20.9518 21.9088C21.5319 21.9088 22.0207 22.1075 22.4183 22.5049C22.8157 22.9025 23.0143 23.3913 23.0143 23.9713C23.0143 24.5511 22.8157 25.0398 22.4183 25.4374C22.0207 25.835 21.5319 26.0338 20.9518 26.0338ZM6.08603 4.5625L9.75625 12.2838H18.8787C19.0375 12.2838 19.1786 12.2441 19.3018 12.1645C19.4254 12.0852 19.5311 11.9751 19.6191 11.8342L23.2154 5.30294C23.3211 5.10906 23.3299 4.93719 23.2419 4.78731C23.1537 4.63744 23.0038 4.5625 22.7923 4.5625H6.08603ZM5.41434 3.1875H23.3158C23.9135 3.1875 24.363 3.43122 24.6643 3.91866C24.9659 4.40609 24.9819 4.90808 24.7121 5.42463L20.7827 12.5849C20.5836 12.92 20.3248 13.1827 20.0065 13.3732C19.6884 13.5636 19.339 13.6588 18.9581 13.6588H9.1375L7.46619 16.7261C7.32525 16.9376 7.3209 17.1668 7.45312 17.4136C7.58535 17.6604 7.7837 17.7838 8.04816 17.7838H23.0143V19.1588H8.04816C7.24607 19.1588 6.6476 18.8208 6.25275 18.1448C5.8579 17.4687 5.84816 16.7896 6.22353 16.1073L8.29119 12.4213L3.23566 1.8125H0.75V0.4375H4.10809L5.41434 3.1875Z" fill="#222222"/>
                                    </svg>
                                    </a>';
                                else:
                                    echo '<a href="' . home_url('/cart-en/') . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27" fill="none">
                                    <path d="M8.04816 26.0338C7.46814 26.0338 6.97932 25.835 6.58172 25.4374C6.18434 25.0398 5.98566 24.5511 5.98566 23.9713C5.98566 23.3913 6.18434 22.9025 6.58172 22.5049C6.97932 22.1075 7.46814 21.9088 8.04816 21.9088C8.62818 21.9088 9.11687 22.1075 9.51425 22.5049C9.91185 22.9025 10.1107 23.3913 10.1107 23.9713C10.1107 24.5511 9.91185 25.0398 9.51425 25.4374C9.11687 25.835 8.62818 26.0338 8.04816 26.0338ZM20.9518 26.0338C20.3718 26.0338 19.8831 25.835 19.4858 25.4374C19.0881 25.0398 18.8893 24.5511 18.8893 23.9713C18.8893 23.3913 19.0881 22.9025 19.4858 22.5049C19.8831 22.1075 20.3718 21.9088 20.9518 21.9088C21.5319 21.9088 22.0207 22.1075 22.4183 22.5049C22.8157 22.9025 23.0143 23.3913 23.0143 23.9713C23.0143 24.5511 22.8157 25.0398 22.4183 25.4374C22.0207 25.835 21.5319 26.0338 20.9518 26.0338ZM6.08603 4.5625L9.75625 12.2838H18.8787C19.0375 12.2838 19.1786 12.2441 19.3018 12.1645C19.4254 12.0852 19.5311 11.9751 19.6191 11.8342L23.2154 5.30294C23.3211 5.10906 23.3299 4.93719 23.2419 4.78731C23.1537 4.63744 23.0038 4.5625 22.7923 4.5625H6.08603ZM5.41434 3.1875H23.3158C23.9135 3.1875 24.363 3.43122 24.6643 3.91866C24.9659 4.40609 24.9819 4.90808 24.7121 5.42463L20.7827 12.5849C20.5836 12.92 20.3248 13.1827 20.0065 13.3732C19.6884 13.5636 19.339 13.6588 18.9581 13.6588H9.1375L7.46619 16.7261C7.32525 16.9376 7.3209 17.1668 7.45312 17.4136C7.58535 17.6604 7.7837 17.7838 8.04816 17.7838H23.0143V19.1588H8.04816C7.24607 19.1588 6.6476 18.8208 6.25275 18.1448C5.8579 17.4687 5.84816 16.7896 6.22353 16.1073L8.29119 12.4213L3.23566 1.8125H0.75V0.4375H4.10809L5.41434 3.1875Z" fill="#222222"/>
                                    </svg>
                                    </a>';
                                endif; 
                            else:
                                if ( $current_lang === 'ja' ) : 
                                    echo '<a href="' . home_url('/cart/') . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 25 27">
                                        <path class="cls-1"
                                            d="M8,26c-.6,0-1.1-.2-1.5-.6-.4-.4-.6-.9-.6-1.5s.2-1.1.6-1.5c.4-.4.9-.6,1.5-.6s1.1.2,1.5.6c.4.4.6.9.6,1.5s-.2,1.1-.6,1.5c-.4.4-.9.6-1.5.6ZM21,26c-.6,0-1.1-.2-1.5-.6-.4-.4-.6-.9-.6-1.5s.2-1.1.6-1.5.9-.6,1.5-.6,1.1.2,1.5.6c.4.4.6.9.6,1.5s-.2,1.1-.6,1.5c-.4.4-.9.6-1.5.6ZM6.1,4.6l3.7,7.7h9.1c.2,0,.3,0,.4-.1.1,0,.2-.2.3-.3l3.6-6.5c.1-.2.1-.4,0-.5,0-.1-.2-.2-.4-.2H6.1ZM5.4,3.2h17.9c.6,0,1,.2,1.3.7.3.5.3,1,0,1.5l-3.9,7.2c-.2.3-.5.6-.8.8-.3.2-.7.3-1,.3h-9.8l-1.7,3.1c-.1.2-.1.4,0,.7.1.2.3.4.6.4h15v1.4h-15c-.8,0-1.4-.3-1.8-1-.4-.7-.4-1.4,0-2l2.1-3.7L3.2,1.8H.8V.4h3.4l1.3,2.8Z" />
                                    </svg>
                                    </a>';
                                else:
                                    echo '<a href="' . home_url('/cart-en/') . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 25 27">
                                        <path class="cls-1"
                                        d="M8,26c-.6,0-1.1-.2-1.5-.6-.4-.4-.6-.9-.6-1.5s.2-1.1.6-1.5c.4-.4.9-.6,1.5-.6s1.1.2,1.5.6c.4.4.6.9.6,1.5s-.2,1.1-.6,1.5c-.4.4-.9.6-1.5.6ZM21,26c-.6,0-1.1-.2-1.5-.6-.4-.4-.6-.9-.6-1.5s.2-1.1.6-1.5.9-.6,1.5-.6,1.1.2,1.5.6c.4.4.6.9.6,1.5s-.2,1.1-.6,1.5c-.4.4-.9.6-1.5.6ZM6.1,4.6l3.7,7.7h9.1c.2,0,.3,0,.4-.1.1,0,.2-.2.3-.3l3.6-6.5c.1-.2.1-.4,0-.5,0-.1-.2-.2-.4-.2H6.1ZM5.4,3.2h17.9c.6,0,1,.2,1.3.7.3.5.3,1,0,1.5l-3.9,7.2c-.2.3-.5.6-.8.8-.3.2-.7.3-1,.3h-9.8l-1.7,3.1c-.1.2-.1.4,0,.7.1.2.3.4.6.4h15v1.4h-15c-.8,0-1.4-.3-1.8-1-.4-.7-.4-1.4,0-2l2.1-3.7L3.2,1.8H.8V.4h3.4l1.3,2.8Z" />
                                    </svg>
                                    </a>';
                                endif; 
                            endif;
                        ?>
                        <span class="<?php echo is_shop() || is_product() || is_product_category() ? 'count-white' : 'count'; ?>"><?php $cart_item_count = WC()->cart->get_cart_contents_count(); echo $cart_item_count; ?></span>
                    </div>
                    <div class="gnav_sub-member">
                        <?php
                            $current_lang = pll_current_language();
                            if(is_shop() || is_product() || is_product_category()):
                                if ( $current_lang === 'ja' ) : 
                                    echo 
                                    '<a href="' . home_url('/my-account/') . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="24" viewBox="0 0 26 24" fill="none">
                                    <path d="M13 10.9229C11.5562 10.9229 10.3203 10.4088 9.29219 9.38066C8.26406 8.35254 7.75 7.1166 7.75 5.67285C7.75 4.2291 8.26406 2.99316 9.29219 1.96504C10.3203 0.936914 11.5562 0.422852 13 0.422852C14.4437 0.422852 15.6797 0.936914 16.7078 1.96504C17.7359 2.99316 18.25 4.2291 18.25 5.67285C18.25 7.1166 17.7359 8.35254 16.7078 9.38066C15.6797 10.4088 14.4437 10.9229 13 10.9229ZM0.75 23.5771V20.6962C0.75 19.9737 0.960292 19.2978 1.38087 18.6684C1.80175 18.0392 2.36773 17.5507 3.07881 17.2027C4.73023 16.4109 6.38267 15.8169 8.03613 15.4208C9.68958 15.025 11.3442 14.8271 13 14.8271C14.6558 14.8271 16.3104 15.025 17.9639 15.4208C19.6173 15.8169 21.2698 16.4109 22.9212 17.2027C23.6323 17.5507 24.1982 18.0392 24.6191 18.6684C25.0397 19.2978 25.25 19.9737 25.25 20.6962V23.5771H0.75ZM2.5 21.8271H23.5V20.6962C23.5 20.308 23.3749 19.9434 23.1246 19.6024C22.8747 19.2615 22.5286 18.9731 22.0864 18.7375C20.6462 18.0398 19.1612 17.5053 17.6314 17.134C16.1016 16.7627 14.5578 16.5771 13 16.5771C11.4422 16.5771 9.89842 16.7627 8.36863 17.134C6.83883 17.5053 5.35381 18.0398 3.91356 18.7375C3.4714 18.9731 3.12533 19.2615 2.87538 19.6024C2.62513 19.9434 2.5 20.308 2.5 20.6962V21.8271ZM13 9.17285C13.9625 9.17285 14.7865 8.83014 15.4719 8.14473C16.1573 7.45931 16.5 6.63535 16.5 5.67285C16.5 4.71035 16.1573 3.88639 15.4719 3.20098C14.7865 2.51556 13.9625 2.17285 13 2.17285C12.0375 2.17285 11.2135 2.51556 10.5281 3.20098C9.84271 3.88639 9.5 4.71035 9.5 5.67285C9.5 6.63535 9.84271 7.45931 10.5281 8.14473C11.2135 8.83014 12.0375 9.17285 13 9.17285Z" fill="#222222"/>
                                    </svg>
                                    </a>';
                                else:
                                    echo 
                                    '<a href="' . home_url('/my-account-en/') . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="24" viewBox="0 0 26 24" fill="none">
                                    <path d="M13 10.9229C11.5562 10.9229 10.3203 10.4088 9.29219 9.38066C8.26406 8.35254 7.75 7.1166 7.75 5.67285C7.75 4.2291 8.26406 2.99316 9.29219 1.96504C10.3203 0.936914 11.5562 0.422852 13 0.422852C14.4437 0.422852 15.6797 0.936914 16.7078 1.96504C17.7359 2.99316 18.25 4.2291 18.25 5.67285C18.25 7.1166 17.7359 8.35254 16.7078 9.38066C15.6797 10.4088 14.4437 10.9229 13 10.9229ZM0.75 23.5771V20.6962C0.75 19.9737 0.960292 19.2978 1.38087 18.6684C1.80175 18.0392 2.36773 17.5507 3.07881 17.2027C4.73023 16.4109 6.38267 15.8169 8.03613 15.4208C9.68958 15.025 11.3442 14.8271 13 14.8271C14.6558 14.8271 16.3104 15.025 17.9639 15.4208C19.6173 15.8169 21.2698 16.4109 22.9212 17.2027C23.6323 17.5507 24.1982 18.0392 24.6191 18.6684C25.0397 19.2978 25.25 19.9737 25.25 20.6962V23.5771H0.75ZM2.5 21.8271H23.5V20.6962C23.5 20.308 23.3749 19.9434 23.1246 19.6024C22.8747 19.2615 22.5286 18.9731 22.0864 18.7375C20.6462 18.0398 19.1612 17.5053 17.6314 17.134C16.1016 16.7627 14.5578 16.5771 13 16.5771C11.4422 16.5771 9.89842 16.7627 8.36863 17.134C6.83883 17.5053 5.35381 18.0398 3.91356 18.7375C3.4714 18.9731 3.12533 19.2615 2.87538 19.6024C2.62513 19.9434 2.5 20.308 2.5 20.6962V21.8271ZM13 9.17285C13.9625 9.17285 14.7865 8.83014 15.4719 8.14473C16.1573 7.45931 16.5 6.63535 16.5 5.67285C16.5 4.71035 16.1573 3.88639 15.4719 3.20098C14.7865 2.51556 13.9625 2.17285 13 2.17285C12.0375 2.17285 11.2135 2.51556 10.5281 3.20098C9.84271 3.88639 9.5 4.71035 9.5 5.67285C9.5 6.63535 9.84271 7.45931 10.5281 8.14473C11.2135 8.83014 12.0375 9.17285 13 9.17285Z" fill="#222222"/>
                                    </svg>
                                    </a>';
                                endif; 
                            else:
                                if ( $current_lang === 'ja' ) : 
                                    echo 
                                    '<a href="' . home_url('/my-account/') . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 42 42">
                                    <path class="cls-1"
                                        d="M20.8,19c-2.4,0-4.6-.9-6.3-2.6s-2.6-3.9-2.6-6.3.9-4.6,2.6-6.3,3.9-2.6,6.3-2.6,4.6.9,6.3,2.6,2.6,3.9,2.6,6.3-.9,4.6-2.6,6.3-3.9,2.6-6.3,2.6ZM0,40.7v-5c0-1.2.3-2.4,1-3.4.7-1,1.7-1.9,2.9-2.6,2.9-1.4,5.6-2.4,8.5-3.1,2.9-.7,5.6-1,8.5-1s5.6.3,8.5,1,5.6,1.7,8.5,3.1c1.2.5,2.2,1.4,2.9,2.6.7,1,1,2.2,1,3.4v5H0ZM2.9,37.6h35.9v-1.9c0-.7-.2-1.4-.7-1.9-.3-.5-1-1-1.7-1.5-2.4-1.2-5-2-7.7-2.7-2.6-.7-5.3-1-7.9-1s-5.3.3-7.9,1-5.1,1.5-7.7,2.7c-.7.3-1.4.9-1.7,1.5-.5.5-.7,1.2-.7,1.9v1.9ZM20.8,16.1c1.7,0,3.1-.5,4.3-1.7s1.7-2.6,1.7-4.3-.5-3.1-1.7-4.3-2.6-1.7-4.3-1.7-3.1.5-4.3,1.7-1.7,2.6-1.7,4.3.5,3.1,1.7,4.3,2.6,1.7,4.3,1.7Z" />
                                    </svg>
                                    </a>';
                                else:
                                    echo 
                                    '<a href="' . home_url('/my-account-en/') . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 42 42">
                                    <path class="cls-1"
                                        d="M20.8,19c-2.4,0-4.6-.9-6.3-2.6s-2.6-3.9-2.6-6.3.9-4.6,2.6-6.3,3.9-2.6,6.3-2.6,4.6.9,6.3,2.6,2.6,3.9,2.6,6.3-.9,4.6-2.6,6.3-3.9,2.6-6.3,2.6ZM0,40.7v-5c0-1.2.3-2.4,1-3.4.7-1,1.7-1.9,2.9-2.6,2.9-1.4,5.6-2.4,8.5-3.1,2.9-.7,5.6-1,8.5-1s5.6.3,8.5,1,5.6,1.7,8.5,3.1c1.2.5,2.2,1.4,2.9,2.6.7,1,1,2.2,1,3.4v5H0ZM2.9,37.6h35.9v-1.9c0-.7-.2-1.4-.7-1.9-.3-.5-1-1-1.7-1.5-2.4-1.2-5-2-7.7-2.7-2.6-.7-5.3-1-7.9-1s-5.3.3-7.9,1-5.1,1.5-7.7,2.7c-.7.3-1.4.9-1.7,1.5-.5.5-.7,1.2-.7,1.9v1.9ZM20.8,16.1c1.7,0,3.1-.5,4.3-1.7s1.7-2.6,1.7-4.3-.5-3.1-1.7-4.3-2.6-1.7-4.3-1.7-3.1.5-4.3,1.7-1.7,2.6-1.7,4.3.5,3.1,1.7,4.3,2.6,1.7,4.3,1.7Z" />
                                    </svg>    
                                    </a>';
                                endif; 
                            endif;
                        ?>
                    </div>
                    <div class="<?php echo is_shop() || is_product() || is_product_category() ? 'gnav_sub-lang-black' : 'gnav_sub-lang'; ?>">
                        <div>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.99996 17.5834C8.95621 17.5834 7.97357 17.3858 7.05204 16.9905C6.13051 16.5952 5.32524 16.053 4.63621 15.3638C3.94704 14.6748 3.40482 13.8695 3.00954 12.948C2.61427 12.0265 2.41663 11.0438 2.41663 10.0001C2.41663 8.94772 2.61427 7.96293 3.00954 7.04571C3.40482 6.12848 3.94704 5.32536 4.63621 4.63633C5.32524 3.94716 6.13051 3.40494 7.05204 3.00967C7.97357 2.61439 8.95621 2.41675 9.99996 2.41675C11.0523 2.41675 12.0371 2.61439 12.9543 3.00967C13.8716 3.40494 14.6747 3.94716 15.3637 4.63633C16.0529 5.32536 16.5951 6.12848 16.9904 7.04571C17.3857 7.96293 17.5833 8.94772 17.5833 10.0001C17.5833 11.0438 17.3857 12.0265 16.9904 12.948C16.5951 13.8695 16.0529 14.6748 15.3637 15.3638C14.6747 16.053 13.8716 16.5952 12.9543 16.9905C12.0371 17.3858 11.0523 17.5834 9.99996 17.5834ZM9.99996 16.4615C10.3002 16.1614 10.5818 15.6724 10.8445 14.9945C11.1073 14.3165 11.3093 13.5609 11.4504 12.7276H8.54954C8.70135 13.5823 8.906 14.3486 9.1635 15.0265C9.42086 15.7045 9.69968 16.1828 9.99996 16.4615ZM8.65704 16.3574C8.39315 15.9407 8.15489 15.4162 7.94225 14.7838C7.72961 14.1513 7.5667 13.4659 7.4535 12.7276H4.10579C4.54593 13.6902 5.16746 14.4902 5.97038 15.1276C6.77329 15.7648 7.66885 16.1747 8.65704 16.3574ZM11.3429 16.3574C12.3311 16.1747 13.2266 15.7648 14.0295 15.1276C14.8325 14.4902 15.454 13.6902 15.8941 12.7276H12.5464C12.4064 13.4712 12.2301 14.1592 12.0175 14.7917C11.805 15.4242 11.5801 15.9461 11.3429 16.3574ZM3.72746 11.6442H7.34621C7.30774 11.3484 7.28364 11.0586 7.27392 10.7749C7.26433 10.4913 7.25954 10.2191 7.25954 9.95842C7.25954 9.69772 7.26433 9.43251 7.27392 9.16279C7.28364 8.89293 7.30774 8.62397 7.34621 8.35592H3.72746C3.64732 8.62508 3.5894 8.89855 3.55371 9.17633C3.51788 9.45411 3.49996 9.72869 3.49996 10.0001C3.49996 10.2715 3.51788 10.5461 3.55371 10.8238C3.5894 11.1016 3.64732 11.3751 3.72746 11.6442ZM8.45017 11.6442H11.5498C11.5881 11.3345 11.6121 11.0474 11.6218 10.783C11.6314 10.5186 11.6362 10.2576 11.6362 10.0001C11.6362 9.74258 11.6314 9.47814 11.6218 9.20675C11.6121 8.93536 11.5881 8.65175 11.5498 8.35592H8.45017C8.41183 8.65175 8.38781 8.93536 8.37808 9.20675C8.3685 9.47814 8.36371 9.74258 8.36371 10.0001C8.36371 10.2576 8.3685 10.522 8.37808 10.7934C8.38781 11.0648 8.41183 11.3484 8.45017 11.6442ZM12.6537 11.6442H16.2725C16.3526 11.3751 16.4105 11.1016 16.4462 10.8238C16.482 10.5461 16.5 10.2715 16.5 10.0001C16.5 9.72869 16.482 9.45064 16.4462 9.16592C16.4105 8.88119 16.3526 8.61119 16.2725 8.35592H12.6537C12.6922 8.65175 12.7163 8.94154 12.726 9.22529C12.7356 9.5089 12.7404 9.78105 12.7404 10.0417C12.7404 10.3024 12.7356 10.5677 12.726 10.8374C12.7163 11.1072 12.6922 11.3762 12.6537 11.6442ZM12.5464 7.27258H15.8941C15.4487 6.29925 14.8312 5.49925 14.0416 4.87258C13.252 4.24605 12.3525 3.83342 11.3429 3.63467C11.6068 4.078 11.8423 4.61196 12.0495 5.23654C12.2569 5.86098 12.4225 6.53967 12.5464 7.27258ZM8.54954 7.27258H11.4504C11.2986 6.42314 11.09 5.65279 10.8245 4.96154C10.559 4.27029 10.2841 3.79598 9.99996 3.53862C9.71579 3.79598 9.44093 4.27029 9.17538 4.96154C8.90996 5.65279 8.70135 6.42314 8.54954 7.27258ZM4.10579 7.27258H7.4535C7.57739 6.53967 7.74301 5.86098 7.95038 5.23654C8.1576 4.61196 8.39315 4.078 8.65704 3.63467C7.64204 3.83342 6.74114 4.24744 5.95433 4.87675C5.16739 5.50592 4.55121 6.30453 4.10579 7.27258Z" />
                            </svg>

                            Language
                        </div>
                        <ul>
                        <?php
                        $languages = pll_the_languages(array(
                            'raw' => 1,  // 配列として出力
                            'hide_if_empty' => 0, // 翻訳がない場合でも表示
                        ));

                        foreach ($languages as $lang) {
                            // 現在表示している言語の場合、リンクを強調表示（例: class="active" などを追加）
                            $active_class = $lang['current_lang'] ? ' class="active"' : '';
                            
                            echo '<li' . $active_class . '>';
                            echo '<a href="' . esc_url($lang['url']) . '">' . esc_html($lang['name']) . '</a>';
                            echo '</li>';
                        }
                        ?>
                        </ul>
                    </div>
                    <a href="#top_contact" class="<?php echo is_shop() || is_product() || is_product_category() ? 'gnav_sub-contact-black' : 'gnav_sub-contact'; ?>">Contact</a>
                </div>
            </nav>
            <a class="menubtn"><span></span><span></span></a>
            <nav class="sp-gnav">
                <ul class="sp-gnav_main">
                    <li><a id="scroll-to-plugins_sp" href="#">Plugins</a></li>
                    <li><a id="scroll-to-colors_sp" href="#">Colors</a></li>
                    <?php
                    $current_lang = pll_current_language();
                    if ( $current_lang === 'ja' ) : 
                        echo '<li><a href="' . home_url('/about-me/') . '">About</a></li>';
                    else:
                        echo '<li><a href="' . home_url('/about-me-en/') . '">About</a></li>';
                    endif; ?>
                </ul>
                <div class="gnav_sub">
                    <div class="gnav_sub-lang">
                        <div>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.99996 17.5834C8.95621 17.5834 7.97357 17.3858 7.05204 16.9905C6.13051 16.5952 5.32524 16.053 4.63621 15.3638C3.94704 14.6748 3.40482 13.8695 3.00954 12.948C2.61427 12.0265 2.41663 11.0438 2.41663 10.0001C2.41663 8.94772 2.61427 7.96293 3.00954 7.04571C3.40482 6.12848 3.94704 5.32536 4.63621 4.63633C5.32524 3.94716 6.13051 3.40494 7.05204 3.00967C7.97357 2.61439 8.95621 2.41675 9.99996 2.41675C11.0523 2.41675 12.0371 2.61439 12.9543 3.00967C13.8716 3.40494 14.6747 3.94716 15.3637 4.63633C16.0529 5.32536 16.5951 6.12848 16.9904 7.04571C17.3857 7.96293 17.5833 8.94772 17.5833 10.0001C17.5833 11.0438 17.3857 12.0265 16.9904 12.948C16.5951 13.8695 16.0529 14.6748 15.3637 15.3638C14.6747 16.053 13.8716 16.5952 12.9543 16.9905C12.0371 17.3858 11.0523 17.5834 9.99996 17.5834ZM9.99996 16.4615C10.3002 16.1614 10.5818 15.6724 10.8445 14.9945C11.1073 14.3165 11.3093 13.5609 11.4504 12.7276H8.54954C8.70135 13.5823 8.906 14.3486 9.1635 15.0265C9.42086 15.7045 9.69968 16.1828 9.99996 16.4615ZM8.65704 16.3574C8.39315 15.9407 8.15489 15.4162 7.94225 14.7838C7.72961 14.1513 7.5667 13.4659 7.4535 12.7276H4.10579C4.54593 13.6902 5.16746 14.4902 5.97038 15.1276C6.77329 15.7648 7.66885 16.1747 8.65704 16.3574ZM11.3429 16.3574C12.3311 16.1747 13.2266 15.7648 14.0295 15.1276C14.8325 14.4902 15.454 13.6902 15.8941 12.7276H12.5464C12.4064 13.4712 12.2301 14.1592 12.0175 14.7917C11.805 15.4242 11.5801 15.9461 11.3429 16.3574ZM3.72746 11.6442H7.34621C7.30774 11.3484 7.28364 11.0586 7.27392 10.7749C7.26433 10.4913 7.25954 10.2191 7.25954 9.95842C7.25954 9.69772 7.26433 9.43251 7.27392 9.16279C7.28364 8.89293 7.30774 8.62397 7.34621 8.35592H3.72746C3.64732 8.62508 3.5894 8.89855 3.55371 9.17633C3.51788 9.45411 3.49996 9.72869 3.49996 10.0001C3.49996 10.2715 3.51788 10.5461 3.55371 10.8238C3.5894 11.1016 3.64732 11.3751 3.72746 11.6442ZM8.45017 11.6442H11.5498C11.5881 11.3345 11.6121 11.0474 11.6218 10.783C11.6314 10.5186 11.6362 10.2576 11.6362 10.0001C11.6362 9.74258 11.6314 9.47814 11.6218 9.20675C11.6121 8.93536 11.5881 8.65175 11.5498 8.35592H8.45017C8.41183 8.65175 8.38781 8.93536 8.37808 9.20675C8.3685 9.47814 8.36371 9.74258 8.36371 10.0001C8.36371 10.2576 8.3685 10.522 8.37808 10.7934C8.38781 11.0648 8.41183 11.3484 8.45017 11.6442ZM12.6537 11.6442H16.2725C16.3526 11.3751 16.4105 11.1016 16.4462 10.8238C16.482 10.5461 16.5 10.2715 16.5 10.0001C16.5 9.72869 16.482 9.45064 16.4462 9.16592C16.4105 8.88119 16.3526 8.61119 16.2725 8.35592H12.6537C12.6922 8.65175 12.7163 8.94154 12.726 9.22529C12.7356 9.5089 12.7404 9.78105 12.7404 10.0417C12.7404 10.3024 12.7356 10.5677 12.726 10.8374C12.7163 11.1072 12.6922 11.3762 12.6537 11.6442ZM12.5464 7.27258H15.8941C15.4487 6.29925 14.8312 5.49925 14.0416 4.87258C13.252 4.24605 12.3525 3.83342 11.3429 3.63467C11.6068 4.078 11.8423 4.61196 12.0495 5.23654C12.2569 5.86098 12.4225 6.53967 12.5464 7.27258ZM8.54954 7.27258H11.4504C11.2986 6.42314 11.09 5.65279 10.8245 4.96154C10.559 4.27029 10.2841 3.79598 9.99996 3.53862C9.71579 3.79598 9.44093 4.27029 9.17538 4.96154C8.90996 5.65279 8.70135 6.42314 8.54954 7.27258ZM4.10579 7.27258H7.4535C7.57739 6.53967 7.74301 5.86098 7.95038 5.23654C8.1576 4.61196 8.39315 4.078 8.65704 3.63467C7.64204 3.83342 6.74114 4.24744 5.95433 4.87675C5.16739 5.50592 4.55121 6.30453 4.10579 7.27258Z" />
                            </svg>

                            Language
                        </div>
                        <ul>
                        <?php
                        $languages = pll_the_languages(array(
                            'raw' => 1,  // 配列として出力
                            'hide_if_empty' => 0, // 翻訳がない場合でも表示
                        ));

                        foreach ($languages as $lang) {
                            // 現在表示している言語の場合、リンクを強調表示（例: class="active" などを追加）
                            $active_class = $lang['current_lang'] ? ' class="active"' : '';
                            
                            echo '<li' . $active_class . '>';
                            echo '<a href="' . esc_url($lang['url']) . '">' . esc_html($lang['name']) . '</a>';
                            echo '</li>';
                        }
                        ?>
                        </ul>
                    </div>
                    <a href="#top_contact" class="gnav_sub-contact">Contact</a>
                </div>
            </nav>
            <div class="sp-gnav_shop">
                <div class="sp-gnav_sub-cart">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 25 27">
                            <path class="cls-1"
                                d="M8,26c-.6,0-1.1-.2-1.5-.6-.4-.4-.6-.9-.6-1.5s.2-1.1.6-1.5c.4-.4.9-.6,1.5-.6s1.1.2,1.5.6c.4.4.6.9.6,1.5s-.2,1.1-.6,1.5c-.4.4-.9.6-1.5.6ZM21,26c-.6,0-1.1-.2-1.5-.6-.4-.4-.6-.9-.6-1.5s.2-1.1.6-1.5.9-.6,1.5-.6,1.1.2,1.5.6c.4.4.6.9.6,1.5s-.2,1.1-.6,1.5c-.4.4-.9.6-1.5.6ZM6.1,4.6l3.7,7.7h9.1c.2,0,.3,0,.4-.1.1,0,.2-.2.3-.3l3.6-6.5c.1-.2.1-.4,0-.5,0-.1-.2-.2-.4-.2H6.1ZM5.4,3.2h17.9c.6,0,1,.2,1.3.7.3.5.3,1,0,1.5l-3.9,7.2c-.2.3-.5.6-.8.8-.3.2-.7.3-1,.3h-9.8l-1.7,3.1c-.1.2-.1.4,0,.7.1.2.3.4.6.4h15v1.4h-15c-.8,0-1.4-.3-1.8-1-.4-.7-.4-1.4,0-2l2.1-3.7L3.2,1.8H.8V.4h3.4l1.3,2.8Z" />
                        </svg>
                        <span class="count">0</span>
                    </a>
                </div>
                <div class="sp-gnav_sub-member">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 42 42">
                            <path class="cls-1"
                                d="M20.8,19c-2.4,0-4.6-.9-6.3-2.6s-2.6-3.9-2.6-6.3.9-4.6,2.6-6.3,3.9-2.6,6.3-2.6,4.6.9,6.3,2.6,2.6,3.9,2.6,6.3-.9,4.6-2.6,6.3-3.9,2.6-6.3,2.6ZM0,40.7v-5c0-1.2.3-2.4,1-3.4.7-1,1.7-1.9,2.9-2.6,2.9-1.4,5.6-2.4,8.5-3.1,2.9-.7,5.6-1,8.5-1s5.6.3,8.5,1,5.6,1.7,8.5,3.1c1.2.5,2.2,1.4,2.9,2.6.7,1,1,2.2,1,3.4v5H0ZM2.9,37.6h35.9v-1.9c0-.7-.2-1.4-.7-1.9-.3-.5-1-1-1.7-1.5-2.4-1.2-5-2-7.7-2.7-2.6-.7-5.3-1-7.9-1s-5.3.3-7.9,1-5.1,1.5-7.7,2.7c-.7.3-1.4.9-1.7,1.5-.5.5-.7,1.2-.7,1.9v1.9ZM20.8,16.1c1.7,0,3.1-.5,4.3-1.7s1.7-2.6,1.7-4.3-.5-3.1-1.7-4.3-2.6-1.7-4.3-1.7-3.1.5-4.3,1.7-1.7,2.6-1.7,4.3.5,3.1,1.7,4.3,2.6,1.7,4.3,1.7Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>