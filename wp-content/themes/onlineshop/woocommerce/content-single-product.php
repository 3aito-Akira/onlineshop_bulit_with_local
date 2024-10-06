<?php

defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

<?php
// 商品のIDを取得
$product_id = get_the_ID();

// 商品に設定されているタクソノミー（カスタムタクソノミーなど）を取得
$terms = get_the_terms($product_id, 'softs');

// タクソノミーが設定されている場合
if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        // タクソノミー情報を表示
        //echo '<div>タクソノミー名: ' . esc_html($term->name) . ', ID: ' . esc_html($term->term_id) . '</div>';

        // タクソノミーIDを使って画像を取得（ACFのカスタムフィールド名に合わせて変更）
        $image_id = get_field('icon', 'softs_' . $term->term_id);

        // 画像IDが取得できたか確認
        if ($image_id) {
            // 画像が ID の場合は画像 URL を取得
            if (is_numeric($image_id)) {
                $image_url = wp_get_attachment_image_url($image_id, 'full');
            } else {
                // 画像がすでに URL である場合
                $image_url = esc_url($image_id);
            }
			$product_name = $product->get_name();
			$name_array = explode(' ', $product_name);
	
			$name_the_rest = "";

			$name_array = explode(' ', $product_name);

			$name_the_rest = implode(' ', array_slice($name_array, 2));

            // 画像URLの確認
            if ($image_url) {
                echo '
				<div class="product-intro-wrapper">
					<div class="product-icon-wrapper">
						<img src="' . esc_url($image_url) . '" alt="' . esc_attr($term->name) . '">
					</div>
					<h1>
						<div>' . esc_html($name_array[0]) . ' ' . esc_html($name_array[1]) . '</div>
						<div>' . esc_html($name_array[2]) . ' ' . esc_html($name_array[3]) . ' ' . esc_html($name_array[4]) . '</div>
					</h1>
				</div>';
            } else {
                echo '<div>画像URLが無効です。</div>';
            }
        } else {
            echo '<div>画像IDが取得できませんでした。</div>';
        }
    }
} else {
    $product_name = $product->get_name();
	$name_array = explode(' ', $product_name);
	
	$name_the_rest = "";

	$name_array = explode(' ', $product_name);

	$name_the_rest = implode(' ', array_slice($name_array, 2));

	echo '
	<div class="product-intro-wrapper">
		<h1>
			<div>' . (isset($name_array[0]) && $name_array[0] !== null ? esc_html($name_array[0]) : '') . ' ' . (isset($name_array[1]) && $name_array[1] !== null ? esc_html($name_array[1]) : '') . '</div>
			<div>' . (isset($name_the_rest) && $name_the_rest !== null && $name_the_rest !== "" ? esc_html($name_the_rest) : '') . '</div>
		</h1>
	</div>';

	}
?>


	<div class="product-summary-wrapper">
		<div class="product-summary-sub-wrapper">
			<?php
			
			do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary">
				<?php
				
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
			<div class="product-cart-form-wrapper">
				<form id="product-cart-submit-form" class="cart" action="https://onlineshop.local/product/am-special-power-grade-pack-colors/" method="post" enctype="multipart/form-data">
					<div class="quantity">
						<label class="screen-reader-text" for="quantity_66fd090b63ca7">AM SPECIAL POWER GRADE PACK Colors個</label>
						<input type="number" id="quantity_66fd090b63ca7" class="input-text qty text" name="quantity" value="1" aria-label="商品数量" size="4" min="1" max="" step="1" placeholder="" inputmode="numeric" autocomplete="off">
					</div>
					<div class="product-order-section">
					<button type="submit" name="add-to-cart" value="212" class="single_add_to_cart_button button alt">Buy now</button>
					<div class="product-order-arrow">
						<img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow_single_product.png" alt="">
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="product-image-wrapper">
		<div class="product-image-sub-wrapper">
			<img src="<?php echo get_template_directory_uri(); ?>/img/page/product_top_left.jpg" alt="">
			<img src="<?php echo get_template_directory_uri(); ?>/img/page/product_top_right.jpg" alt="">
			<img src="<?php echo get_template_directory_uri(); ?>/img/page/product_bottom_left.jpg" alt="">
			<img src="<?php echo get_template_directory_uri(); ?>/img/page/product_bottom_right.jpg" alt="">
		</div>
	</div>

	<div class="product-info">
		<h2>AM POWER GRADEとは？</h2>
		<div>2つのPowerGradeを提供します。デジタル・フィルム風の両方を楽しむカラーシステムです。</div>
		<div>Log撮影に挑戦したけどカラー編集がイマイチ上手く出来ない、もっと手軽で時短したい。</div>
		<div>そんなお悩みを解決します。</div>
		<br>
		<div>美しい”カラーと”フィルム風”カラーの２つの手法を提供します。</div>
		<div>AM POWER GARDE PACKは４種類のオリジナルLUTを格納しています。</div>
		<div>オリジナルLUTをインストールの上、ご利用ください。</div>
	</div>

	<div class="product-effect-info product-effect-info-background-black">
		<img src="<?php echo get_template_directory_uri(); ?>/img/page/product_power_grade.jpg" alt=""> 
		<h2>Aesthetic Color（エステティック・カラー）</h2>
		<div>Aesthetic Colorは言葉の通り、映像素材の本来の色を活かした、”美的な”カラーを引き出します。
			デジタルカメラで撮影した映像をより綺麗に仕上げるためのPOWER GRADEです。
		</div>
		<br>
		<h3>各ノード説明</h3>
		<br>
		<ul>
			<li>① NR - 動画素材のノイズ処理を行います。必要に応じてご使用ください。</li>
			<li>② CST - 撮影したカメラデータをもとにカラースペース変換を行います。Log素材を本来のカラーへと変換します。
				デフォルト設定ではS-Log3になっています。
				他カメラをお使いの方は入力カラースペース・入力ガンマのみを再設定してください。
			</li>
			<li>③ CamWB - ホワイトバランスを調整します。</li>
			<li>④ Con - コントラストを調整します。</li>
			<li>⑤ Sat - 彩度を調整します。（デフォルト設定は少し強めです。お好みに調整してください）</li>
			<li>⑥ Skin - 被写体のスキン補正を行います。使用時はクオリファイで適用範囲を選択し、ご使用ください。</li>
			<li>⑦ LUT - 4つのLUTを用意しました。ここでメインカラーを決定します。それぞれを混合させることも可能です。
				　※よりナチュラルな色を求める場合は使用しないことをお勧めします。
			</li>
			<li>⑨⑩⑪⑫ パラレルエリア - ４つの色彩調整をお楽しみいただけます。
				それぞれをONにし、使用したいものを選んでお使いください。
				複数適用可能。さらに、それらのパラメータは各ツールで再調整可能です。
				AKIYA本人が普段から行うカラー調整の方向性をお楽しみいただけます。
			</li>
			<li>⑭ Sharp - 映像にシャープネスを追加します。お好みで調整可能です。</li>
			<li>⑮ Adj - その他追加したい項目はこちらで可能です。</li>
		</ul>
	</div>

	<div class="product-effect-info product-effect-info-background-white">
		<img src="<?php echo get_template_directory_uri(); ?>/img/page/product_film_emulation.jpg" alt=""> 
		<h2>Film Emulation （フィルム・エミュレーション）</h2>
		<div>Film Emulationは言葉の通り、フィルムを模倣する。
			デジタルデータを手軽にフィルムのような世界へと転換させます。
			昨今の”フィルム風”というトレンドを映像でも楽しむことができます。
		</div>
		<br>
		<h3>各ノード説明</h3>
		<br>
		<ul>
			<li>① CamWB - ホワイトバランスを調整します。</li>
			<li>② Exp - 露出を調整します。</li>
			<li>③ Sat - 彩度を調整します。（デフォルト設定は少し強めです。お好みに調整してください）</li>
			<li>④ Con - コントラストを調整します。</li>
			<li>⑤ HUE - 色相・彩度の調整が可能です、あらかじめ用意したパラレルノードをお好みで使用してください。
				世界観にあったものだけを使用することもできます。
				それらのパラメーターは各ツールで再調整可能です。
			</li>
			<li>⑥ Looks - ３つのLookを用意しました。お好みでONにして調整することが可能です。複数適用も可能です。
				それらのパラメータは各ツールで再調整可能です。
			</li>
			<li>⑧ CST - フィルムカラーに近づけるためのノードです。撮影したカメラデータをもとにカラースペース変換を行います。
				デフォルト設定ではS-Log3になっていますので、他カメラをお使いの方は入力カラースペース・入力ガンマのみを再設定してください。
			</li>
			<li>⑨ Film LUT - メインのフィルムの方向性を決めるノードです。複合ノード内のFilm LUTをひとつ選んでください。
			オリジナルLUTで付属の４つのLUTのうち一つを使用することも可能です。
			</li>
			<li>⑩ Grain - 映像にノイズを追加します。お好みで再調整可能です。</li>
			<li>⑪ HARATION - フィルム特有の現象を再現し、映像を少しぼやかせます。お好みで再調整可能です。</li>
			<li>⑫ Pro-Mist - ハイライト部分にミストフィルターのような効果を出します。お好みで再調整可能です。</li>
		</ul>
	</div>

	<div class="dropdown_menu_wrapper">
	<h1>Q&A</h1>
	<nav>
		<h2>どの編集ソフト・アプリで使用できますか。</h2>
		<div class="dropdown_menu_sub_wrapper">
			<div class="product_arrow_down_wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
					<path d="M10.8203 0.910156L5.91016 5.82031L1 0.910156" stroke="white"/>
				</svg>
			</div>
			<li class="gnavi__list">
				<ul class="dropdown__lists">
					<li class="dropdown__list">メニュー1</li>
					<li class="dropdown__list">メニュー2</li>
					<li class="dropdown__list">メニュー3</li>
				</ul>
			</li>
		</div>
	</nav>
	<nav>
		<h2>iPad版DaVinci Resolveに対応していますか？</h2>
		<div class="dropdown_menu_sub_wrapper">
			<div class="product_arrow_down_wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
					<path d="M10.8203 0.910156L5.91016 5.82031L1 0.910156" stroke="white"/>
				</svg>
			</div>
			<li class="gnavi__list">
				<ul class="dropdown__lists">
					<li class="dropdown__list">メニュー1</li>
					<li class="dropdown__list">メニュー2</li>
					<li class="dropdown__list">メニュー3</li>
				</ul>
			</li>
		</div>
	</nav>
	<h1>ご購入に関する質問</h1>
	<nav>
		<h2>返金はできますか？</h2>
		<div class="dropdown_menu_sub_wrapper">
			<div class="product_arrow_down_wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
					<path d="M10.8203 0.910156L5.91016 5.82031L1 0.910156" stroke="white"/>
				</svg>
			</div>
			<li class="gnavi__list">
				<ul class="dropdown__lists">
					<li class="dropdown__list">メニュー1</li>
					<li class="dropdown__list">メニュー2</li>
					<li class="dropdown__list">メニュー3</li>
				</ul>
			</li>
		</div>
	</nav>
	<nav>
		<h2>請求書/領収書が欲しいです。</h2>
		<div class="dropdown_menu_sub_wrapper">
			<div class="product_arrow_down_wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
					<path d="M10.8203 0.910156L5.91016 5.82031L1 0.910156" stroke="white"/>
				</svg>
			</div>
			<li class="gnavi__list">
				<ul class="dropdown__lists">
					<li class="dropdown__list">メニュー1</li>
					<li class="dropdown__list">メニュー2</li>
					<li class="dropdown__list">メニュー3</li>
				</ul>
			</li>
		</div>
	</nav>
	</div>


	<?php
	
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
