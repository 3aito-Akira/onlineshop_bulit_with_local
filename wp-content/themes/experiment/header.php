<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); // 必要なスタイルシートやスクリプトをWordPressが自動で追加します ?>
</head>
<body <?php body_class(); ?>>
<header>
    <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <p><?php bloginfo( 'description' ); // サイトの説明を表示 ?></p>
</header>
<nav>
    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); // ナビゲーションメニューを表示 ?>
</nav>
