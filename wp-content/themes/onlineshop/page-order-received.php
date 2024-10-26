<?php
/*
Template Name: Order Received JA
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // 直接アクセス禁止
}

if ( is_user_logged_in() ) {
    // 現在のユーザーの注文を取得
    $customer_orders = wc_get_orders( array(
        'customer_id' => get_current_user_id(),
        'limit'       => 1, // 最新の注文を取得
        'orderby'     => 'date',
        'order'       => 'DESC',
    ) );

    if ( !empty( $customer_orders ) ) {
        // 最新の注文IDを取得
        $order_id = $customer_orders[0]->get_id();
    } else {
        // 注文がない場合のエラーハンドリング
        wp_die( '注文が見つかりませんでした。' );
    }
} else {
    // 非ログインユーザーの場合のエラーハンドリング
    wp_die( 'このページにアクセスするにはログインが必要です。' );
}

// URLに order_id パラメータが無ければリダイレクト
if ( !isset( $_GET['order_id'] ) || empty( $_GET['order_id'] ) ) {
    // リダイレクトURLを生成
    $redirect_url = home_url( '/order-received-ja/?order_id=' . $order_id );
    
    // リダイレクト処理
    wp_redirect( $redirect_url );
    exit; // リダイレクト後に処理を終了
}

get_header(); ?>

<div class="order-received">
    <?php
    // 注文IDが有効な場合にThank Youページのテンプレートを表示
    $order_id = sanitize_text_field( $_GET['order_id'] );
    $order = wc_get_order( $order_id );

    if ( $order ) {
        // WooCommerceのThank Youページテンプレートを読み込む
        wc_get_template( 'checkout/thankyou.php', array( 'order' => $order ) );
    } else {
        echo '<p>無効な注文IDです。</p>';
    }
    ?>
</div>

<?php get_footer(); ?>
