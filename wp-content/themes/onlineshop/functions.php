<?php 

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}

/*
add_filter( 'template_include', function( $template ) {
    $default_file = WC_Template_Loader::get_default_file();
    
    if ( is_null( $default_file ) ) {
        echo "<p>\$default_file is null</p>";
    } elseif ( $default_file === '' ) {
        echo "<p>\$default_file is an empty string</p>";
    } else {
        echo "<p>default_file: $default_file</p>";
    }

    return $template;
});
*/

function custom_woocommerce_checkout_before_customer_details() {
    $current_language = pll_current_language();
    $default_language = pll_default_language();
    echo ('checkout_before_customer_details current: '. $current_language . " default:  ". $default_language.  "<br>");
}
add_action( 'woocommerce_checkout_before_customer_details', 'custom_woocommerce_checkout_before_customer_details', 10 );


// 既存のフックを解除する
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review' );

// カスタム関数をフックする
// フックに登録する際、引数の数を指定する
add_action('woocommerce_checkout_order_review', 'custom_woocommerce_order_review', 10, 1);
// 引数を受け取る関数
function custom_woocommerce_order_review($current_language) {
    echo ($current_language . " order_review <br>");
    global $call_count;
    
    $call_count++;
    echo 'custom_order_review was called - Current Language: ' . $current_language . ' - Call Count: ' . $call_count. "<br>";

    $permalink = get_permalink();
    echo "*****get_permalink(): " . $permalink . "<br>";

    wc_get_template('checkout/review-order.php', array('current_languages' => $current_language,
    'permalink' => $permalink));
}

/*
function custom_woocommerce_order_review_ajax() {

    echo 'custom_woocommerce_order_review_ajax was called-------------------- ' ;
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        return;
    }
    $current_languages = 'en'; // または適切な言語コードを設定
    echo 'custom_woocommerce_order_review_ajax was called ' . $current_languages;
    wc_get_template( 'checkout/review-order.php', array( 'current_languages' => $current_languages ) );
}
add_action( 'woocommerce_checkout_order_review', 'custom_woocommerce_order_review_ajax', 1 );
*/


/*
add_action( 'woocommerce_checkout_order_review', function () {
    echo 'woocommerce_checkout_order_review hook triggered';
}, 10 ); 
*/


/*
// グローバル変数を定義
$current_languages = 'en'; // 例として 'en' を設定

function custom_woocommerce_order_review() {
    // グローバル変数を利用
    global $current_languages;
    echo 'Inside custom_woocommerce_order_review: current_languages = ' . $current_languages;
    wc_get_template( 'checkout/review-order.php', array( 'current_languages' => $current_languages ) );
}

// WooCommerce の checkout order review フックに関数を追加
add_action( 'woocommerce_checkout_order_review', 'custom_woocommerce_order_review', 1);

// グローバル変数のデバッグ出力
echo 'Global current_languages: ' . $current_languages;
*/

/*
add_action('woocommerce_checkout_before_order_review', 'log_before_order_review', 0);
function log_before_order_review() {
    echo '<pre>Before Order Review: ' . pll_current_language() . '</pre>';
}
*/

/*
add_action('woocommerce_checkout_before_order_review', 'change_language_to_en_for_checkout', 1);
function change_language_to_en_for_checkout() {
    if ( function_exists('PLL') ) {
        $english_language = PLL()->model->get_language('en');
        if ($english_language) {
            PLL()->curlang = $english_language;
            pll_save_cache();
            echo '<pre>Language changed to: ' . pll_current_language() . '</pre>';
        }
    }
}
*/

add_action('woocommerce_checkout_after_order_review', 'log_after_order_review', 10);
function log_after_order_review() {
    echo '<pre>After Order Review: ' . pll_current_language() . '</pre>';
}
/*
function pll_save_cache() {
    global $polylang;
    if ( ! empty( $polylang ) ) {
        $polylang->model->clean_languages_cache();
        $polylang->options['cache'] = array();
    }
}
*/




add_filter( 'woocommerce_get_price_suffix', 'custom_woocommerce_price_suffix', 10, 4 );
function custom_woocommerce_price_suffix( $suffix, $product, $price, $qty ) {
    //$suffix = ' <small class="woocommerce-price-suffix"> 税込 </small>';
    //$suffix = ' <small class="woocommerce-price-suffix"> tax included </small>';
    //return $suffix;

    // Polylangを使って現在の言語を取得
    $current_language = pll_current_language();

    // 現在の言語に基づいてサフィックスを設定
    if ( $current_language == 'en' ) {
        $suffix = ' <small class="woocommerce-price-suffix"> tax included </small>';
    } else {
        $suffix = ' <small class="woocommerce-price-suffix"> 税込 </small>';
    }

    return $suffix;
}

/*
global $wp_filter;
var_dump( $wp_filter['woocommerce_checkout_order_review'] );

add_action( 'wp_footer', 'debug_woocommerce_hooks' );
function debug_woocommerce_hooks() {
    global $wp_filter;
    if ( isset( $wp_filter['woocommerce_checkout_order_review'] ) ) {
        echo '<pre>';
        var_dump( $wp_filter['woocommerce_checkout_order_review'] );
        echo '</pre>';
    } else {
        echo 'woocommerce_checkout_order_review hook not found.';
    }
}
*/
/*
add_action('woocommerce_checkout_order_review', 'debug_current_language_checkout');
function debug_current_language_checkout() {
    if (function_exists('pll_current_language')) {
        $current_language = pll_current_language();
        echo('Current language in checkout order review: ' . $current_language);
    }
}
*/

/*
add_action('wp_footer', 'add_language_change_script');
function add_language_change_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ajaxComplete(function() {
            <?php if ( function_exists('PLL') ) : ?>
                PLL()->curlang = PLL()->model->get_language('en');
            <?php endif; ?>
        });
    </script>
    <?php
}
*/

/*
add_action('all', 'log_specific_hooks');
function log_specific_hooks($hook_name) {
    $hooks_to_log = array(
        'woocommerce_checkout_order_review',
        'woocommerce_locate_template',
        'pll_language_defined',
        'pll_after_language_switch'
        // 他にログに記録したいフックを追加
    );

    if (in_array($hook_name, $hooks_to_log)) {
        echo ('Hook fired: ' . $hook_name);
    }
}
*/

/*
add_filter( 'woocommerce_locate_template', 'debug_woocommerce_locate_template', 10, 3 );

function debug_woocommerce_locate_template( $template, $template_name, $template_path ) {
    echo( 'Template being loaded: ' . $template );
    echo( 'Template name: ' . $template_name );
    echo( 'Template path: ' . $template_path );

    // デバッグ用にフィルターを通過するテンプレートをそのまま返す
    return $template;
}
*/
/*
function enqueue_custom_script() {
    if (is_page() || is_single()) {  // 任意の条件に基づいてスクリプトを読み込む
        wp_enqueue_script('element-order', get_template_directory_uri() . '/js/element-order.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');
*/

/*
function enqueue_custom_script() {
    if (is_checkout()) {  // チェックアウトページに限定してスクリプトを読み込む
        wp_enqueue_script('element-order', get_template_directory_uri() . '/js/element-order.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');
*/

/*
add_action('wp_footer', function() {
    global $wp_filter;
    if (isset($wp_filter['woocommerce_checkout_order_review'])) {
        echo(print_r($wp_filter['woocommerce_checkout_order_review'], true));
    }
});
*/

/*
global $wp_filter;
echo("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@");
var_dump($wp_filter['woocommerce_checkout_order_review']);
*/












