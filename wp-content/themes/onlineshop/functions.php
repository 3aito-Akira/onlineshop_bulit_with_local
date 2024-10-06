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
    $user = get_user_by('login', 'akiya'); // 'username' はユーザー名
    $user_id = $user->ID;
    
    // ユーザーIDを指定してユーザーオブジェクトを取得
    $user = new WP_User( $user_id ); // $user_id にユーザーIDを指定
    
    // 'publish_posts' 権限を追加
    if($user) {
        $user->add_cap('publish_posts');
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

function get_shop_page_id() {
    if ( is_page_template( 'page-shop.php' ) ) {
        // ここでページIDを取得
        $page_id = get_queried_object_id();
        echo "<script>console.log('Shop Page ID: " . esc_js( $page_id ) . "');</script>";
    }
}
add_action( 'wp', 'get_shop_page_id' );
function custom_shop_page_title_and_toggleButton() {
    if (is_shop()) {  // ショップページのみ適用
        echo '<h1 class="shop-page-title">Store</h1>';
        
        echo '
            <div class="switch-button-section">
                <div class="switch-button-container">
                    <div id="category-filter" class="switch-button">
                        <button class="switch-button-case left active-case">All</button>
                        <button class="switch-button-case center ">Plugins</button>
                        <button class="switch-button-case right">Colors</button>
                    </div>
                </div>
            </div>';
    }
}
add_action('woocommerce_before_main_content', 'custom_shop_page_title_and_toggleButton', 10);

/*
add_action( 'woocommerce_before_shop_loop', 'remove_woocommerce_before_shop_loop_functions', 1 );

function remove_woocommerce_before_shop_loop_functions() {
    remove_all_actions( 'woocommerce_before_shop_loop' );
}
    */
    //remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    



//woocommerce_template_loop_product_titleのオーバーライド
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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


//pluginsページ



/*
各商品ページ
------------------*/
//関連商品をカスタマイズするための翻訳ファイル作成
function my_theme_setup() {
    load_theme_textdomain( 'onlineshop', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'my_theme_setup' );













