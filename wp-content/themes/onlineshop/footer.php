<footer class="footer">
        <div class="inner">
            <div class="logo">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/logo.svg" alt="AMmotion">
            </div>
            <?php
                $current_lang = pll_current_language();
                if ( $current_lang === 'ja' ) : 
                    echo 
                    '<ul class="menu">
                        <li><a href="#top_contact">お問い合わせ</a></li>
                        <li><a href="' . home_url('/terms-and-conditions/') . '">利用規約</a></li>
                        <li><a href="' . home_url('/notice-pursuant-to-the-act-on-specified-commercial-transactions-and-others/') . '">特定商取引法に基づく表記</a></li>
                        <li><a href="' . home_url('/privacy-policy/') . '">プライバシーポリシー</a></li>
                    </ul>';
                else:
                    echo 
                    '<ul class="menu">
                        <li><a href="#top_contact">Contact us</a></li>
                        <li><a href="' . home_url('/terms-and-conditions-en/') . '">Terms and Conditions</a></li>
                        <li><a href="' . home_url('/notice-pursuant-to-the-act-on-specified-commercial-transactions-and-others-en/') . '">NOTICE PURSUANT TO THE ACT ON SPECIFIED COMMERCIAL TRANSACTIONS & OTHERS</a></li>
                        <li><a href="' . home_url('/privacy-policy-en/') . '">Privacy Policy</a></li>
                    </ul>';
                endif;
            ?>
            <ul class="sns">
                <li><a href="https://www.youtube.com/@AKIYAMOVIE" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/common/snsIcon_youtube.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/akiya0104/?hl=ja" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/common/snsIcon_instagram.svg" alt=""></a></li>
                <li><a href="https://www.twitter.com/akiyaspin" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/common/snsIcon_x.svg" alt=""></a></li>
            </ul>
            <p class="copy">Copyright © 2024 AM MOTION All Rights Reserved</p>
        </div>
    </footer>

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/vendor/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>

<?php wp_footer(); ?>
</body>
</html>
