<?php

defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); 
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

<?php

$product_categories = get_the_terms( get_the_ID(), 'product_cat' );

if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) {

	echo '<div class="product-category-icons-wrapper">'; // <div>で囲む開始

	foreach($product_categories as $category) {
		
		$term = get_term( $category->term_id );

		$icon_image = get_field( 'product_icons', 'product_cat_' . $category->term_id );

		if ( $icon_image ) {
			echo '<img class="product-icon-image" src="' . esc_url( $icon_image['url'] ) . '" alt="' . esc_attr( $icon_image['alt'] ) . '">';
		}
	}

	echo '</div>';
}
?>


<?php
	
	//$product_name = get_field('product_name');
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
?>


<?php

$background_image = get_field('product_background_image');

if ($background_image) {
    $background_image_url = $background_image['url'];
} else { 
    $background_image_url = get_template_directory_uri() . '/img/default-background.jpg';
}

$custom_background_class = 'custom-background-' . get_the_ID();


?>
<?php

echo '<style>';
echo '.' . esc_attr($custom_background_class) . ' {';
echo '    background-image: url("' . esc_url($background_image_url) . '");';
echo '    background-position: center;';
echo '    background-size: cover;';
echo '    background-repeat: no-repeat;';
echo '}';
echo '</style>';
?>

	<div class="product-summary-wrapper <?php echo esc_attr($custom_background_class); ?>">
		<div class="product-summary-sub-wrapper">
			<?php
			
			do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary">
				<?php
				
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
			<div class="product-cart-form-wrapper ">
				<form id="product-cart-submit-form" class="cart" action="https://onlineshop.local/product/am-special-power-grade-pack-colors/" method="post" enctype="multipart/form-data">
					<div class="quantity">
						<label class="screen-reader-text" for="quantity_66fd090b63ca7">AM SPECIAL POWER GRADE PACK Colors</label>
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
		<?php
        
        $top_left_image = get_field('product_intro_image_top_left');
        $top_right_image = get_field('product_intro_image_top_right');
        $bottom_left_image = get_field('product_intro_image_bottom_left');
        $bottom_right_image = get_field('product_intro_image_bottom_right');

        ?>
        
        <?php if ($top_left_image): ?>
            <img src="<?php echo esc_url($top_left_image['url']); ?>" alt="Top Left Image">
        <?php else: ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/default-top-left.jpg" alt="Default Top Left Image">
        <?php endif; ?>

        <?php if ($top_right_image): ?>
            <img src="<?php echo esc_url($top_right_image['url']); ?>" alt="Top Right Image">
        <?php else: ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/default-top-right.jpg" alt="Default Top Right Image">
        <?php endif; ?>

        <?php if ($bottom_left_image): ?>
            <img src="<?php echo esc_url($bottom_left_image['url']); ?>" alt="Bottom Left Image">
        <?php else: ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/default-bottom-left.jpg" alt="Default Bottom Left Image">
        <?php endif; ?>

        <?php if ($bottom_right_image): ?>
            <img src="<?php echo esc_url($bottom_right_image['url']); ?>" alt="Bottom Right Image">
        <?php else: ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/default-bottom-right.jpg" alt="Default Bottom Right Image">
        <?php endif; ?>
		</div>
	</div>

	<div class="product-info">
		<?php
        
        $product_intro_info_title = get_field('product_intro_info_title');
        $product_intro_info_content_top = get_field('product_intro_info_content_top');
        $product_intro_info_content_bottom = get_field('product_intro_info_content_bottom');
        ?>
		<?php 
			echo'
				<h2>'.esc_html($product_intro_info_title).'</h2>
				<div>'.esc_html($product_intro_info_content_top).'</div>
				<br>
				<div>'.esc_html($product_intro_info_content_bottom).'</div>
			';
		?>
	</div>

	<div class="product-effect-info product-effect-info-background-black">
		<?php
        $effect_info_image = get_field('product_effect_info_image');
        ?>
		<img src="<?php echo esc_url($effect_info_image['url']); ?>" alt="Top Left Image">

		<?php
        $effect_info_title = get_field('product_effect_info_title');
		$effect_info_summary = get_field('product_effect_info_summary');
		$effect_info_detail_title = get_field('product_effect_info_detail_title');
		echo'
				<h2>'.esc_html($effect_info_title).'</h2>
				<div>'.esc_html($effect_info_summary).'</div>
				<br>
				<h3>'.esc_html($effect_info_detail_title).'</h3>
				<br>
			';
        ?>
		<?php
		$related_products = get_post_meta(get_the_ID(), 'related_products', true);

		if (!empty($related_products) && is_array($related_products)) {
			
			echo '<ul>';
			foreach ($related_products as $product_new) {
				if (is_array($product_new) && array_key_exists('description', $product_new)) {
					echo '<li>' . esc_html($product_new['description']) . '</li>';
				}
			}
			echo '</ul>';
		}
		?>
	</div>

	<div class="product-effect-info product-effect-info-background-white">
		<?php
        $effect_info_image_1 = get_field('product_effect_info_image_1');
        ?>
		<img src="<?php echo esc_url($effect_info_image['url']); ?>" alt="Top Left Image">

		<?php
        $effect_info_title_1 = get_field('product_effect_info_title_1');
		$effect_info_summary_1 = get_field('product_effect_info_summary_1');
		$effect_info_detail_title_1 = get_field('product_effect_info_detail_title_1');
		echo'
				<h2>'.esc_html($effect_info_title_1).'</h2>
				<div>'.esc_html($effect_info_summary_1).'</div>
				<br>
				<h3>'.esc_html($effect_info_detail_title_1).'</h3>
				<br>
			';
        ?>

		<?php
		$related_products_another = get_post_meta(get_the_ID(), 'related_products_another', true);

		if (!empty($related_products_another) && is_array($related_products_another)) {
			echo '<ul>';
			foreach ($related_products_another as $product_new_another) {
				if (is_array($product_new_another) && array_key_exists('description', $product_new_another)) {
					echo '<li>' . esc_html($product_new_another['description']) . '</li>';
				}
			}
			echo '</ul>';
		}
		?>
	</div>

	<div class="accordion_area_wrapper">
	<h1>Q&A</h1>
	<nav>
		<ul class="accordion_area">
			<div class="accordion_area_sub_title_div vol1">
				<h2 class="accordion_area_sub_title">どの編集ソフト・アプリで使用できますか。</h2>
				<div class="accordion_area_arrow_wrapper">
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
						<path d="M10.8203 0.910156L5.91016 5.82031L1 0.910156" stroke="white"/>
					</svg>
				</div>
			</div>
			<li>
				<div class="accordion_area_sub_div_box vol1 accordion_box_close">
					<div class="accordion-area-sub-div-content">
						<p>answer 1</p>
					</div>
				</div>
			</li>
			<li>
				<div class="accordion_area_sub_div_box vol1 accordion_box_close">
					<div class="accordion_area_sub_div_content">
						<p>answer 2</p>
					</div>
				</div>
			</li>
		</ul>
	</nav>
	<nav>
	<ul class="accordion_area">
			<div class="accordion_area_sub_title_div vol2">
				<h2 class="accordion_area_sub_title">iPad版DaVinci Resolveに対応していますか？</h2>
				<div class="accordion_area_arrow_wrapper">
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
						<path d="M10.8203 0.910156L5.91016 5.82031L1 0.910156" stroke="white"/>
					</svg>
				</div>
			</div>
			<li>
				<div class="accordion_area_sub_div_box vol2 accordion_box_close">
					<div class="accordion_area_sub_div_content">
						<p>answer 1</p>
					</div>
				</div>
			</li>
			<li>
				<div class="accordion_area_sub_div_box vol2 accordion_box_close">
					<div class="accordion_area_sub_div_content">
						<p>answer 2</p>
					</div>
				</div>
			</li>
		</ul>
	</nav>
	<h1>ご購入に関する質問</h1>
	<nav>
		<ul class="accordion_area">
			<div class="accordion_area_sub_title_div vol3">
				<h2 class="accordion_area_sub_title">返金はできますか？</h2>
				<div class="accordion_area_arrow_wrapper">
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
						<path d="M10.8203 0.910156L5.91016 5.82031L1 0.910156" stroke="white"/>
					</svg>
				</div>
			</div>
			<li>
				<div class="accordion_area_sub_div_box vol3 accordion_box_close">
					<div class="accordion_area_sub_div_content">
						<p>answer 1</p>
					</div>
				</div>
			</li>
			<li>
				<div class="accordion_area_sub_div_box vol3 accordion_box_close">
					<div class="accordion_area_sub_div_content">
						<p>answer 2</p>
					</div>
				</div>
			</li>
		</ul>
	</nav>
	<nav>
		<ul class="accordion_area">
			<div class="accordion_area_sub_title_div vol4">
				<h2 class="accordion_area_sub_title">請求書/領収書が欲しいです。</h2>
				<div class="accordion_area_arrow_wrapper">
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
						<path d="M10.8203 0.910156L5.91016 5.82031L1 0.910156" stroke="white"/>
					</svg>
				</div>
			</div>
			<li>
				<div class="accordion_area_sub_div_box vol4 accordion_box_close">
					<div class="accordion_area_sub_div_content">
						<p>answer 1</p>
					</div>
				</div>
			</li>
			<li>
				<div class="accordion_area_sub_div_box vol4 accordion_box_close">
					<div class="accordion_area_sub_div_content">
						<p>answer 2</p>
					</div>
				</div>
			</li>
			<li>
				<div class="accordion-area_sub_div_box vol4 accordion_box_close">
					<div class="accordion_area_sub_div_content">
						<p>answer 3</p>
					</div>
				</div>
			</li>
		</ul>
	</nav>
	</div>

	<?php
	
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
