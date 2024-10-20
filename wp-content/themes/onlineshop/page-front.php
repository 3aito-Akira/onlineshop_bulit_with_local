<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 * @since Your_Theme_Version
 */

get_header(); ?>

<?php 

function get_products_sorted_by_categories(int $posts_per_page  , string $category) {
    $args = array(
        'post_type' => 'product', 
        'posts_per_page' => $posts_per_page,    
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat', 
                'field' => 'slug',           
                'terms' => $category,        
            ),
        ),
    );

    $query = new WP_Query($args);
    
    $products = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID()); 

            $product_image_id = $product->get_image_id();
            $product_image_url = wp_get_attachment_image_url($product_image_id, 'full'); 

            $categories = wp_get_post_terms($product->get_id(), 'product_cat');
            $category_images = array();
            foreach ($categories as $category) {
                $category_image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $category_image_url = wp_get_attachment_image_url($category_image_id, 'full');
                if ($category_image_url) {
                    $category_images[] = $category_image_url;  
                }
            }

            $products[] = array(
                'id' => $product->get_id(),
                'name' => $product->get_name(),
                'price' => $product->get_price(),
                'permalink' => $product->get_permalink(),
                'product_image_url' => $product_image_url, 
                'category_image_urls' => $category_images, 
            );
        }
        wp_reset_postdata(); 
    }

    return $products;
}

?>

    <main>
        <section class="fv">
            <div class="fv01">
                <div class="swiper">
                    <div class="swiper-wrapper">
                            <?php 
                            $plugins_products = get_products_sorted_by_categories(2,'plugins');
                            foreach($plugins_products as $product){
                                echo ' 
                                <div class="swiper-slide">
                                    <div class="box">
                                        <div class="box_item">';
                                            foreach($product['category_image_urls'] as $category_image_url){
                                                echo '
                                                    <div class="softwareIcon">
                                                        <img src="' . esc_url($category_image_url) . '" alt="DavinciResolve">
                                                    </div>
                                                ';
                                            }
                                echo        '<p class="name">' . esc_html($product['name']) . '</p>';
                                echo        '<div class="btnarea">
                                                <a class="btn01" href="'. esc_url($product['permalink']) .'">Show All</a>
                                            </div>
                                        </div>
                                        <div class="box_visual">
                                            <img src='.esc_url($product['product_image_url']). 'alt="">
                                            <img src='.esc_url($product['product_image_url']). ' alt="">
                                        </div>
                                    </div>
                                </div>';
                            } 
                            ?>
                            <?php 
                            $plugins_products = get_products_sorted_by_categories(2,'colors');
                            foreach($plugins_products as $product){
                                echo ' 
                                <div class="swiper-slide">
                                    <div class="box">
                                        <div class="box_item">
                                            <div class="softwareIcon">';
                                                foreach($product['category_image_urls'] as $category_image_url){
                                                    echo '
                                                        <img src="' . esc_url($category_image_url) . '" alt="DavinciResolve">
                                                    ';
                                                }
                                echo        '</div>
                                            <p class="name">' . esc_html($product['name']) . '</p>';
                                echo        '<div class="btnarea">
                                                <a class="btn01" href="'. esc_url($product['permalink']) .'">Show All</a>
                                            </div>
                                        </div>
                                        <div class="box_visual">
                                            <img src='.esc_url($product['product_image_url']). 'alt="">
                                            <img src='.esc_url($product['product_image_url']). ' alt="">
                                        </div>
                                    </div>
                                </div>';
                            } 
                            ?>
<!-- -->
                        <div class="swiper-slide">
                            <div class="box">
                                <div class="box_item">
                                    <div class="softwareIcon">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
                                    </div>
                                    <p class="name">AM SPECIAL POWER GRADE PACK</p>
                                    <div class="btnarea">
                                        <a class="btn01" href="#">Show All</a>
                                    </div>
                                </div>
                                <div class="box_visual">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/page/fv_dummy.jpg" alt="">
                                </div>
                            </div>
                        </div>
<!-- -->
                        <div class="swiper-slide">
                            <div class="box">
                                <div class="box_item">
                                    <div class="softwareIcon">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
                                    </div>
                                    <p class="name">item02</p>
                                    <div class="btnarea">
                                        <a class="btn01" href="#">Show All</a>
                                    </div>
                                </div>
                                <div class="box_visual">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/page/top_sec_visual.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div><!-- /swiper-wrapper -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <section id="top_store" class="sec">
            <div class="inner">
                <h2 class="sec_ttl01">Store</h2>
                <div class="box">
                    <div class="box_hd">
                        <h3 id="plugins_in_store" class="sec_ttl02">Plugins</h3>
                        <div class="btnarea">
                            <a class="btn01" href="<?php echo home_url('/product-category/plugins'); ?>">Show All</a>
                        </div>
                    </div>
                    <div class="box_item">
                        <ul class="item_list">
                            <?php 
                            $plugins_products = get_products_sorted_by_categories(3, 'plugins');
                            foreach($plugins_products as $product){
                                echo '<li>';
                                echo '<a href="#">';
                                
                                foreach($product['category_image_urls'] as $category_image_url){
                                    echo '
                                        <div class="softwareIcon">
                                            <img src="' . esc_url($category_image_url) . '" alt="DavinciResolve">
                                        </div>
                                    ';
                                }
                            
                                echo '
                                    <div class="tmb">
                                        <img src="' . esc_url($product['product_image_url']) . '" alt="">
                                    </div>
                                    <p class="name">' . esc_html($product['name']) . '</p>
                                ';
                            
                                echo '</a>';
                                echo '</li>';
                            } 
                            ?>                           
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="box_hd">
                        <h3 id="colors_in_store" class="sec_ttl02">Colors</h3>
                        <div class="btnarea">
                            <a class="btn01" href="<?php echo home_url('/product-category/colors'); ?>">Show All</a>
                        </div>
                    </div>
                    <div class="box_item">
                        <ul class="item_list">
                        <?php 
                            $plugins_products = get_products_sorted_by_categories(3,'colors');
                            foreach($plugins_products as $product){
                                echo '<li>';
                                echo '<a href="#">';
                                
                                foreach($product['category_image_urls'] as $category_image_url){
                                    echo '
                                        <div class="softwareIcon">
                                            <img src="' . esc_url($category_image_url) . '" alt="DavinciResolve">
                                        </div>
                                    ';
                                }
                            
                                echo '
                                    <div class="tmb">
                                        <img src="' . esc_url($product['product_image_url']) . '" alt="">
                                    </div>
                                    <p class="name">' . esc_html($product['name']) . '</p>
                                ';
                            
                                echo '</a>';
                                echo '</li>';
                            } 
                            ?>                    
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div id="top_sec_visual"></div>

        <?php echo do_shortcode('[contact-form-7 id="4be5d8b" title="akiya お問い合わせフォーム"]');?>

    </main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
