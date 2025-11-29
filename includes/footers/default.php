<?php
/**
 * @package Base Theme
 */
?>

<footer id="footer-site" class="site-footer">
    
    <?php get_template_part('includes/blocks/newsletter-or-form', null, array()); ?>

    <div class="site-footer-columns">
        <div class="container" id="foooter">
            <div class="row">
                <div class="col-lg-3 footer-column footer-1">
                    <a aria-label="logo" class="logo_footer" href="<?php echo esc_url(home_url('/')); ?>">
                        <ul>
                            <?php dynamic_sidebar('footer-1');?>
                        </ul>
                    </a>
                    <ul>
                        <?php dynamic_sidebar('footer-11');?>
                    </ul>
                </div>
                <div class="col-lg-3 footer-column footer-2">
                    <ul>
                        <?php dynamic_sidebar('footer-2');?>
                    </ul>
                </div>
                <div class="col-lg-2 footer-column footer-3">
                    <ul>
                        <?php dynamic_sidebar('footer-3');?>
                    </ul>
                </div>
                <div class="col-lg-2 footer-column footer-4">
                    <ul>
                        <?php dynamic_sidebar('footer-4');?>
                    </ul>
                </div>
                <div class="col-lg-2 footer-column footer-5">
                    <ul>
                        <?php dynamic_sidebar('footer-5');?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer-copyrights">
        <div class="container">
            <div class="wrapper">
                <p>&copy;<?php echo date(' Y  ') ;?>All rights Reserved. <a href="/">Base Theme</a> </p>
                <div class="bottom-footer-menu">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'menu-7',
                        'menu_id'        => 'footer-menu',
                        'container'      => false,
                    ) ); ?>
                </div>
            </div>
        </div>
    </div>
</footer>


</div><!-- #page -->


<?php wp_footer(); ?>
</body>

</html>