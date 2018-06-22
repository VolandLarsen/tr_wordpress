<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tr_theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
            <div class="footer-container">
                <div class="container">
                    <ul class="footer-info-container">
                        <li class="adress-container">
                            <p class="content-head"><?php echo get_theme_mod('footer_address_head'); ?></p>
                            <p class="content-text"><?php echo get_theme_mod('footer_address'); ?></p>
                        </li>
                        <li class="footer-social">
                            <ul class="footer-social-list">
                                <li class="footer-social-item">
                                    <a href="<?php echo get_theme_mod('footer_facebook_link'); ?>" class="footer-social-link"><?php echo get_theme_mod('footer_facebook_icon'); ?></a>
                                </li>
                                <li class="footer-social-item">
                                    <a href="<?php echo get_theme_mod('footer_twitter_link'); ?>" class="footer-social-link"><?php echo get_theme_mod('footer_twitter_icon'); ?></a>
                                </li>
                                <li class="footer-social-item">
                                    <a href="<?php echo get_theme_mod('footer_linkedin_link'); ?>" class="footer-social-link"><?php echo get_theme_mod('footer_linkedin_icon'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="about-footer-container">
                            <p class="content-head"><?php echo get_theme_mod('footer_about_head'); ?></p>
                            <p class="content-text"><?php echo get_theme_mod('footer_about_text'); ?></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-copyright-container">
                <div class="container">
                    <p class="copyright-text">Copyright © 2015 Template. All Rights Reserved</p>
                    <p class="copyright-text">Made with <a href="#" class="copy-link"><span class="copy-link-heart">♥</span> by Kamal Chaneman</a></p>
                </div>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
