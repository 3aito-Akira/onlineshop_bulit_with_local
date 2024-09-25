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

    <main>
        <section class="fv">
            <div class="fv01">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="box">
                                <div class="box_item">
                                    <div class="softwareIcon"><img
                                            src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
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
                        <div class="swiper-slide">
                            <div class="box">
                                <div class="box_item">
                                    <div class="softwareIcon"><img
                                            src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
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
                        <div class="swiper-slide">
                            <div class="box">
                                <div class="box_item">
                                    <div class="softwareIcon"><img
                                            src="</*?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
                                    </div>
                                    <p class="name">AM SPECIAL POWER GRADE PACK2</p>
                                    <div class="btnarea">
                                        <a class="btn01" href="#">Show All</a>
                                    </div>
                                </div>
                                <div class="box_visual">
                                    <img src="<?php echo get_template_directory_uri(); ?>/okinawa-blue.jpg" alt="">
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
                            <a class="btn01" href="<?php echo home_url('/shop-plugins/'); ?>">Show All</a>
                        </div>
                    </div>
                    <div class="box_item">
                        <ul class="item_list">
                            <li>
                                <a href="<?php echo home_url('/product/am-special-power-grade-pack'); ?>">
                                    <div class="softwareIcon"><img
                                            src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
                                    </div>
                                    <div class="tmb">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/page/item01.png" alt="">
                                    </div>
                                    <p class="name">AM SPECIAL POWER GRADE PACK</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo home_url('/product/am-special-preset-pack'); ?>">
                                    <div class="softwareIcon"><img
                                            src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
                                    </div>
                                    <div class="tmb">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/page/item02.png" alt="">
                                    </div>
                                    <p class="name">AM SPECIAL PRESET PACK</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo home_url('/product/am-special-lut-pack-2-0'); ?>">
                                    <div class="softwareIcon"><img
                                            src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
                                    </div>
                                    <div class="tmb">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/page/item03.png" alt="">
                                    </div>
                                    <p class="name">AM SPECIAL LUT PACK 2.0</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="box_hd">
                        <h3 id="colors_in_store" class="sec_ttl02">Colors</h3>
                        <div class="btnarea">
                            <a class="btn01" href="<?php echo home_url('/shop-colors/'); ?>">Show All</a>
                        </div>
                    </div>
                    <div class="box_item">
                        <ul class="item_list">
                            <li>
                                <a href="<?php echo home_url('/product/am-special-power-grade-pack-colors'); ?>">
                                    <div class="softwareIcon"><img
                                            src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
                                    </div>
                                    <div class="tmb">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/page/item01.png" alt="">
                                    </div>
                                    <p class="name">AM SPECIAL POWER GRADE PACK</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo home_url('/product/am-special-preset-pack-colors'); ?>">
                                    <div class="softwareIcon"><img
                                            src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
                                    </div>
                                    <div class="tmb">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/page/item02.png" alt="">
                                    </div>
                                    <p class="name">AM SPECIAL PRESET PACK</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo home_url('/product/am-special-lut-pack-2-0-colors'); ?>">
                                    <div class="softwareIcon"><img
                                            src="<?php echo get_template_directory_uri(); ?>/img/common/softwareIcon_DavinciResolve.png" alt="DavinciResolve">
                                    </div>
                                    <div class="tmb">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/page/item03.png" alt="">
                                    </div>
                                    <p class="name">AM SPECIAL LUT PACK 2.0</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div id="top_sec_visual"></div>

        <?php echo do_shortcode('[contact-form-7 id="b8f260f" title="akiyaさん お問い合わせフォーム English"]');?>

    </main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
