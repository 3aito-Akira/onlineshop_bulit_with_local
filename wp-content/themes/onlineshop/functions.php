<?php 

function my_theme_enqueue_styles() {
    // テーマディレクトリ内の/css/style.cssを読み込む
    wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );



add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}


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


add_action('woocommerce_checkout_after_order_review', 'log_after_order_review', 10);
function log_after_order_review() {
    echo '<pre>After Order Review: ' . pll_current_language() . '</pre>';
}

add_filter( 'woocommerce_get_price_suffix', 'custom_woocommerce_price_suffix', 10, 4 );
function custom_woocommerce_price_suffix( $suffix, $product, $price, $qty ) {

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

//管理画面の左側にメニューを作る
add_action('admin_menu', function(){
    add_menu_page('カスタムメニュー', 'カスタムメニュー','manage_options', 'my_exam_settings',
    function(){
    ?>
    <div class="wrap">
        <h2>サンプル設定</h2>
    </div>
    <?php
},'dashicons-admin-generic');
});

//特定のユーザーに権限を付与する
function add_publish_posts_capability_to_user() {
    // ユーザー 'akiya' を取得
    $user = get_user_by('login', 'akiya');
    
    // ユーザーが見つかったか確認
    if ($user && isset($user->ID)) {
        $user_id = $user->ID;

        // ユーザーIDを指定してWP_Userオブジェクトを取得
        $user = new WP_User($user_id);

        // 'publish_posts' 権限を追加
        if ($user) {
            $user->add_cap('publish_posts');
        }
    } else {
        // ユーザーが見つからない場合の処理
        error_log('User "akiya" not found.');
    }
}
add_action('init', 'add_publish_posts_capability_to_user');

// 設定の初期化
function myplugin_settings_init() {
    // 設定オプションの登録（グループ名とオプション名）
    register_setting('myplugin_options_group', 'myplugin_option_name');

    // セクションの追加
    add_settings_section(
        'myplugin_section', // セクションID
        'セクションタイトル', // セクションタイトル
        'myplugin_section_callback', // セクションの説明コールバック
        'myplugin' // ページID
    );

    // 設定フィールドの追加
    add_settings_field(
        'myplugin_field', // フィールドID
        'フィールド名', // フィールドタイトル
        'myplugin_field_callback', // フィールド出力のコールバック
        'myplugin', // ページID
        'myplugin_section' // セクションID
    );
}
add_action('admin_init', 'myplugin_settings_init');

// セクションの説明コールバック
function myplugin_section_callback() {
    echo '<p>このセクションの説明です。</p>';
}

// フィールド出力のコールバック
function myplugin_field_callback() {
    // 現在のオプション値を取得
    $option = get_option('myplugin_option_name');
    // フィールドを出力
    echo "<input type='text' name='myplugin_option_name' value='" . esc_attr($option) . "' />";
}

// 設定ページを追加する関数
function myplugin_add_admin_menu() {
    add_menu_page(
        'My Plugin Settings', // ページタイトル
        'My Plugin',          // メニュー名
        'edit_posts',      //　権限
        'myplugin',           // ページID（スラッグ）
        'myplugin_options_page' // 表示するコールバック関数
    );
}
add_action('admin_menu', 'myplugin_add_admin_menu');

// 設定ページの内容を表示するコールバック関数
function myplugin_options_page() {
    ?>
    <form action="options.php" method="post">
        <?php
        settings_fields('myplugin_options_group'); // 設定オプションのグループ
        do_settings_sections('myplugin'); // 設定セクションとフィールドの出力
        submit_button(); // 送信ボタン
        ?>
    </form>
    <?php
}
/*----------------------------------*/

// カスタム管理メニューを追加
function custom_admin_menu() {
    add_menu_page(
        'Sample Page Editor',      // ページタイトル
        '案内文編集',                    // メニュータイトル
        'edit_pages',              // 権限（ページ編集が可能なユーザー）
        'sample-page-editor',      // スラッグ
        'sample_page_editor_callback', // コールバック関数
        'dashicons-edit',          // アイコン
        6                          // メニューの表示順
    );
}
add_action('admin_menu', 'custom_admin_menu');

// 設定ページのコールバック関数
function sample_page_editor_callback() {
    if (!current_user_can('edit_pages')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    // 編集対象の固定ページの ID を設定
    $post_id = 2; // 編集対象の固定ページの ID に変更

    // 固定ページのカスタムメタデータを取得
    $page_content = get_post_meta($post_id, 'sample_page_content', true);

    ?>
    <div class="wrap">
        <h1>案内文編集</h1>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="save_sample_page_content">
            <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>">
            <textarea name="sample_page_content" rows="10" cols="50"><?php echo esc_textarea($page_content); ?></textarea>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// データの保存処理
function save_sample_page_content() {
    if (!current_user_can('edit_pages')) {
        wp_die(__('You do not have sufficient permissions to perform this action.'));
    }

    // フォームから送信されたデータを取得
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $content = isset($_POST['sample_page_content']) ? sanitize_textarea_field($_POST['sample_page_content']) : '';

    // 固定ページのメタデータを更新
    if ($post_id) {
        update_post_meta($post_id, 'sample_page_content', $content);
    }

    // 保存後にリダイレクト
    wp_redirect(admin_url('admin.php?page=sample-page-editor'));
    exit;
}
add_action('admin_post_save_sample_page_content', 'save_sample_page_content');


function register_sample_page_settings() {
    // 設定グループとオプションを登録
    register_setting('sample_page_options_group', 'sample_page_content');
    
    // 設定セクションを追加
    add_settings_section(
        'sample_page_section', // セクションID
        '', // セクションタイトル
        null, // コールバック関数
        'sample-page-editor' // ページスラッグ
    );

    // 設定フィールドを追加
    add_settings_field(
        'sample_page_content', // フィールドID
        'Sample Page Content', // フィールドラベル
        'sample_page_content_callback', // コールバック関数
        'sample-page-editor', // ページスラッグ
        'sample_page_section' // セクションID
    );
}
add_action('admin_init', 'register_sample_page_settings');

//sample-pageにどのように表示されるかを決めている
function sample_page_content_callback() {

    // 固定ページの ID を指定
    $post_id = 2; // 編集したい固定ページの ID に変更
    $content = get_post_meta($post_id, 'sample_page_content', true);
    echo '<textarea name="sample_page_content" rows="10" cols="50">' . esc_textarea($content) . '</textarea>';
}


/*商品ページの設定
-----------*/
function get_shop_page_id() {
    if ( is_page_template( 'page-shop.php' ) ) {
        // ここでページIDを取得
        $page_id = get_queried_object_id();
        echo "<script>console.log('Shop Page ID: " . esc_js( $page_id ) . "');</script>";
    }
}
add_action( 'wp', 'get_shop_page_id' );

//商品ページのtoggle buttonのhtml構造を作り上げる
function custom_shop_page_title_and_toggleButton() {
    if (is_shop() || is_product_category()) {  

        $categories = get_terms([
            'taxonomy' => 'product_cat', // WooCommerceの商品カテゴリタクソノミー
            'hide_empty' => false, // 空のカテゴリーも表示
        ]);

        $plugins_url = "";
        $colors_url = "";
        
        foreach ($categories as $category) {
            $slug = $category->slug;

            if($slug === 'plugins'){
                $plugins_url = get_term_link($category);
            }
            else if($slug === 'colors'){
                $colors_url = get_term_link($category);
            }
        }

        echo '<h1 class="shop-page-title">Store</h1>';
        
        echo '
            <div class="switch-button-section">
                <div class="switch-button-container">';
            if (is_product_category('plugins')) {
                echo '
                    <div id="category-filter" class="switch-button cursor-center">
                    <a class="switch-button-case left" href="'. home_url('/shop/') .'">All</a>
                    <a class="switch-button-case center active-case" href="'. esc_url($plugins_url) .'">Plugins</a>
                    <a class="switch-button-case right" href="'. esc_url($colors_url) .'">Colors</a>
                ';
            }
            else if (is_product_category('colors')) {
                echo '
                    <div id="category-filter" class="switch-button cursor-right">
                    <a class="switch-button-case left" href="'. home_url('/shop/') .'">All</a>
                    <a class="switch-button-case center" href="'. esc_url($plugins_url) .'">Plugins</a>
                    <a class="switch-button-case right active-case" href="'. esc_url($colors_url) .'">Colors</a>
                ';
            }
            else {
                echo '
                    <div id="category-filter" class="switch-button cursor-left">
                    <a class="switch-button-case left active-case" href="'. home_url('/shop/') .'">All</a>
                    <a class="switch-button-case center" href="'. esc_url($plugins_url) .'">Plugins</a>
                    <a class="switch-button-case right" href="'. esc_url($colors_url) .'">Colors</a>
                ';
            }
        echo '
                    </div>
                </div>
            </div>
        ';
    }
}

add_action('woocommerce_before_main_content', 'custom_shop_page_title_and_toggleButton', 10);

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    
//woocommerce_template_loop_product_titleのオーバーライド
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>'; 
	}
}

function custom_scroll_script() {
    wp_enqueue_script('custom-scroll', get_template_directory_uri() . '/js/custom-scroll.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'custom_scroll_script');

// 商品一覧の表示件数を8件に設定

function custom_woocommerce_product_per_page( $query ) {
    
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        $query->set( 'posts_per_page', 8 );
    }
}

add_action( 'pre_get_posts', 'custom_woocommerce_product_per_page' );

// 1行に表示する商品の列数を4つに設定
add_filter( 'loop_shop_columns', 'custom_loop_shop_columns', 999 );
function custom_loop_shop_columns() {
    return 4;
}

// ページネーションを表示
add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

/*
各商品ページ
------------------*/
//関連商品をカスタマイズするための翻訳ファイル作成
function my_theme_setup() {
    load_theme_textdomain( 'onlineshop', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'my_theme_setup' );

// ACFからカスタム背景画像を取得
function set_product_background() {
    global $product_background_class, $background_image_url;

    $background_image = get_field('product_background_image');
    if ($background_image) {
        $background_image_url = $background_image['url'];
    } else {
        // デフォルトの背景画像
        $background_image_url = get_template_directory_uri() . '/img/default-background.jpg';
    }

    // ユニークなクラス名を作成（商品IDを使用）
    $product_background_class = 'product-background-' . get_the_ID();
}
add_action('wp', 'set_product_background');

// フッターにスタイルを追加
add_action('wp_footer', function () {
    global $product_background_class, $background_image_url;

    if (is_product()) {
        echo '<style>';
        echo '.' . esc_attr($product_background_class) . ' {';
        echo '    background-image: url("' . esc_url($background_image_url) . '");';
        echo '    background-position: center;';
        echo '    background-size: cover;';
        echo '    background-repeat: no-repeat;';
        echo '}';
        echo '</style>';
    }
});


add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_script( 'custom-field-related-product', plugin_dir_url( __FILE__ ) . 'custom-field-related-product.js', ['jquery'], '0.1.0', true );

    wp_localize_script( 'custom-field-related-product', 'relatedProducts', [
        'nonce' => wp_create_nonce( 'related_products_nonce' ),
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ] );
});

/*
-------- my-account page
----------*/

// 新規ユーザー登録フォームに住所フィールドを追加
add_action( 'woocommerce_register_form', 'custom_add_billing_fields' );
function custom_add_billing_fields() {
    ?>
    <p class="form-row form-row-wide">
        <label for="billing_address_1">請求先住所 <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_address_1" id="billing_address_1" required />
    </p>
    <p class="form-row form-row-wide">
        <label for="billing_city">市区町村 <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_city" id="billing_city" required />
    </p>
    <p class="form-row form-row-wide">
        <label for="billing_postcode">郵便番号 <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_postcode" id="billing_postcode" required />
    </p>
    <p class="form-row form-row-wide">
        <label for="billing_country">国 <span class="required">*</span></label>
        <select name="billing_country" id="billing_country" required>
            <option value="JP">日本</option>
            <option value="US">アメリカ</option>
            <!-- 他の国を追加 -->
        </select>
    </p>
    <div>akira is editing show billing fields</div>
    <?php
}

// ユーザーが登録したときに住所情報を保存
/*
add_action( 'woocommerce_created_customer', 'custom_save_billing_fields' );
function custom_save_billing_fields( $customer_id ) {
    if ( isset( $_POST['billing_address_1'] ) ) {
        update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );
    }
    if ( isset( $_POST['billing_city'] ) ) {
        update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
    }
    if ( isset( $_POST['billing_postcode'] ) ) {
        update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );
    }
    if ( isset( $_POST['billing_country'] ) ) {
        update_user_meta( $customer_id, 'billing_country', sanitize_text_field( $_POST['billing_country'] ) );
    }
}
    */

// User Registrationでカスタムフィールドを保存
add_action( 'user_registration_after_register_user_action', 'save_user_registration_and_billing_fields', 10, 3 );
function save_user_registration_and_billing_fields( $user_id, $form_data, $data ) {
    
    // WooCommerceの請求先住所フィールドを保存
    if ( isset( $_POST['billing_address_1'] ) ) {
        update_user_meta( $user_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );
    }
    if ( isset( $_POST['billing_city'] ) ) {
        update_user_meta( $user_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
    }
    if ( isset( $_POST['billing_postcode'] ) ) {
        update_user_meta( $user_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );
    }
    if ( isset( $_POST['billing_country'] ) ) {
        update_user_meta( $user_id, 'billing_country', sanitize_text_field( $_POST['billing_country'] ) );
    }
}


// マイアカウントページで住所情報を表示
add_action( 'woocommerce_edit_account_form', 'custom_show_billing_fields' );
function custom_show_billing_fields() {
    $user_id = get_current_user_id();
    $billing_address_1 = get_user_meta( $user_id, 'billing_address_1', true );
    $billing_city = get_user_meta( $user_id, 'billing_city', true );
    $billing_postcode = get_user_meta( $user_id, 'billing_postcode', true );
    $billing_country = get_user_meta( $user_id, 'billing_country', true );

    ?>
    <p class="form-row form-row-wide">
        <label for="billing_address_1">請求先住所</label>
        <input type="text" class="input-text" name="billing_address_1" id="billing_address_1" value="<?php echo esc_attr( $billing_address_1 ); ?>" />
    </p>
    <p class="form-row form-row-wide">
        <label for="billing_city">市区町村</label>
        <input type="text" class="input-text" name="billing_city" id="billing_city" value="<?php echo esc_attr( $billing_city ); ?>" />
    </p>
    <p class="form-row form-row-wide">
        <label for="billing_postcode">郵便番号</label>
        <input type="text" class="input-text" name="billing_postcode" id="billing_postcode" value="<?php echo esc_attr( $billing_postcode ); ?>" />
    </p>
    <p class="form-row form-row-wide">
        <label for="billing_country">国</label>
        <select name="billing_country" id="billing_country">
            <option value="JP" <?php selected( $billing_country, 'JP' ); ?>>日本</option>
            <option value="US" <?php selected( $billing_country, 'US' ); ?>>アメリカ</option>
        </select>
    </p>
    <?php
}

add_action('woocommerce_login_form_end', 'add_register_button_to_login_form');
function add_register_button_to_login_form() {
    // 現在のページからの相対URLを生成
    $registration_url = esc_url( home_url('/registration') );
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <a class="button" href="<?php echo $registration_url; ?>">
            新規登録はこちら
        </a>
    </p>
    <?php
}










