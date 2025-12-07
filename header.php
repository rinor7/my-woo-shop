<?php
/**
 * @package Base Theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Change this to "noindex, nofollow" when you go live -->
    <meta name="robots" content="noindex, nofollow"> 
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
     <!-- Open Graph Description (for social media platforms like Facebook, LinkedIn, etc.) -->
     <?php 
    // Get values from options page
    $og_description = get_field('og_description', 'option'); 
    $og_image = get_field('og_image', 'option');
    if (!$og_description) {
        $og_description = get_theme_mod('base_theme_og_description', get_bloginfo('name')); // fallback to site title
    }
    if (!$og_image) {
        $og_image = ''; // fallback
    }
    ?>
    <meta property="og:description" content="<?php echo esc_attr($og_description); ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
    <?php if (is_singular()) : ?>
        <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>" />
    <?php endif; ?>
    <meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>" />
    <?php if ($og_image): ?>
    <link rel="image_src" href="<?php echo esc_url($og_image); ?>" />
    <?php endif; ?>
    
    <!-- Profile link for XFN (XHTML Friends Network), used for linking to profiles -->
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Apple touch icon (for iOS devices) -->
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/apple-touch-icon.png">

    <!-- Preloading font for performance improvement -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">

    <!-- Optional: Helps the browser connect to fonts.googleapis.com earlier for performance improvement -->
        <!-- <link rel="dns-prefetch" href="//fonts.googleapis.com"> -->

    <!-- Optional: Preload Google Font stylesheets to make fonts load faster -->
        <!-- <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'"> -->
        <!-- <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"></noscript> -->
     
    <!-- Adding a canonical URL tag to prevent duplicate content issues -->
     <link rel="canonical" href="<?php echo esc_url(home_url()); ?>" />

    <?php wp_head(); ?>
</head>

<body <?php $filename = basename(__FILE__, '.php'); body_class( array( wp_is_mobile() ? 'wp-is-mobile' : 'wp-is-desktop', $filename ) ); ?>>
    <!-- <div class="modal-backdrop"></div> -->
    <div id="navbarNav" class="collapse navbar-nav-mobile">
        <div class="button-wrapper">
            <span>Menu</span>
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <div class="menu-m">
                    <span class="menu-global menu-top"></span>
                    <span class="menu-global menu-middle"></span>
                    <span class="menu-global menu-bottom"></span>
                </div>
            </button>
        </div>

        <?php wp_nav_menu(
            array(
                'theme_location'  => 'menu-6',
                'menu_id'         => 'center-menu',
                'menu_class'      => 'navbar-nav',
                'container'       => 'div',
                'container_class' => 'main-nav-toggle',
                'container_id'    => '' // important: remove duplicate ID
            )
        ); ?>
    </div>



    <div id="page" class="site">
        <!-- Announcement NAV -->
        <div class="top-bar" id="announcementbar">
            <div class="container">
                <div class="flex top-bar-wrapper">
                    <?php if(is_active_sidebar('widget-2') ) { ?>
                    <div class="top-bar-wrapper--left">
                        <ul>
                            <?php dynamic_sidebar('widget-2');?>
                        </ul>
                    </div>
                    <?php } ?>
                    <div class="top-bar-wrapper--right">
                        <?php if(is_active_sidebar('widget-3') ) { ?>
                            <div class="language-switcher">
                                <ul>
                                    <?php dynamic_sidebar('widget-3');?>
                                </ul>
                            </div>
                        <?php } ?>
                        <ul>
                            <li class="menu-item-custom-wishlist flex">
                                <a href="/wishlist/" aria-current="page">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/svg/heart.svg' ); ?>" alt="<?php esc_attr_e( 'Wishlist', 'base-theme' ); ?>">
                                    <span>Wunschliste</span>
                                </a>
                            </li>
                        </ul>
                        <?php
                        if ( class_exists( 'WooCommerce' ) ) {

                            // Get default My Account page ID
                            $myaccount_id = wc_get_page_id( 'myaccount' );

                            // Get permalink, fallback to home if missing
                            $myaccount_url = $myaccount_id ? get_permalink( $myaccount_id ) : home_url( '/' );

                            // Link text depends on login state
                            if ( is_user_logged_in() ) {
                                $link_text = __( 'Mein Konto', 'base-theme' );
                            } else {
                                $link_text = __( 'anmelden', 'base-theme' );
                            }
                            ?>
                            <li class="header-myaccount flex">
                                <a href="<?php echo esc_url( $myaccount_url ); ?>" aria-label="<?php echo esc_attr( $link_text ); ?>">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/svg/avatar.svg' ); ?>" alt="<?php esc_attr_e( 'Wunschliste', 'base-theme' ); ?>">
                                    <span><?php echo esc_html( $link_text ); ?></span>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- Header with Logo in Center -->
        <header class="header-bar" id="headerbar">
            <!-- <div class="header-bar" id="headerbar"> -->
                <div class="container">
                        <nav class="header-bar-wrapper navbar navbar-expand-lg navbar-light navbar-center">

                            <button class="navbar-toggler navbar-toggler-desktop" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <div class="menu-m">
                                    <span class="menu-global menu-top"></span>
                                    <span class="menu-global menu-middle"></span>
                                    <span class="menu-global menu-bottom"></span>
                                </div>
                            </button>

                            <?php wp_nav_menu(
                                array(
                                'theme_location'    => 'menu-4',
                                'menu_id'        => 'navbarNavLeft',
                                'menu_class'        => 'navbar-nav navbar-collapse-menu',
                                'container_class'  => 'collapse navbarNavLeft navbar-collapse navbar-collapse-desktop main-nav-toggle',
                                'container_id'    => 'navbarNav',
                                )
                                ); 
                            ?>

                            <?php if ( is_active_sidebar('widget-1') ) { ?>
                                <a aria-label="logo" class="logo_header" href="<?php echo esc_url( home_url('/') ); ?>">
                                    <ul>
                                        <?php dynamic_sidebar('widget-1'); ?>
                                    </ul>
                                </a>
                            <?php } else { ?>
                                <a aria-label="logo" class="logo_header" href="<?php echo esc_url( home_url('/') ); ?>">
                                    <?php bloginfo('name'); ?> <!-- Blog Title -->
                                </a>
                            <?php } ?>

                            <?php wp_nav_menu(
                                array(
                                'theme_location'    => 'menu-5',
                                'menu_id'        => 'right-menu',
                                'menu_class'        => 'navbar-nav navbar-collapse-menu',
                                'container_class'  => 'd-none-mobile collapse navbarNavRight navbar-collapse navbar-collapse-desktop main-nav-toggle',
                                'container_id'    => 'navbarNav',
                                )
                                ); 
                            ?>

                            <?php
                            // WooCommerce cart link (uses theme SVG if present, otherwise a small inline SVG)
                            if ( class_exists( 'WooCommerce' ) ) :

                                // cart url (safe fallback)
                                if ( function_exists( 'wc_get_cart_url' ) ) {
                                    $cart_url = wc_get_cart_url();
                                } elseif ( function_exists( 'wc_get_page_id' ) ) {
                                    $page_id  = wc_get_page_id( 'cart' );
                                    $cart_url = $page_id ? get_permalink( $page_id ) : home_url( '/' );
                                } else {
                                    $cart_url = home_url( '/' );
                                }

                                // cart counts/totals (guarded)
                                $cart_count = 0;
                                $cart_total = '';
                                if ( WC()->cart && is_object( WC()->cart ) ) {
                                    if ( method_exists( WC()->cart, 'get_cart_contents_count' ) ) {
                                        $cart_count = intval( WC()->cart->get_cart_contents_count() );
                                    }
                                    if ( method_exists( WC()->cart, 'get_cart_total' ) ) {
                                        $cart_total = WC()->cart->get_cart_total();
                                    }
                                }

                                $cart_svg_file = get_template_directory() . '/assets/img/svg/trolley.svg';
                                $cart_svg_url  = get_template_directory_uri() . '/assets/img/svg/trolley.svg';
                                ?>
                                <li class="menu-item-custom-cart flex">
                                    <a class="cart-contents" href="<?php echo esc_url( $cart_url ); ?>" aria-label="<?php esc_attr_e( 'View your shopping cart', 'base-theme' ); ?>">
                                        <?php
                                        if ( file_exists( $cart_svg_file ) && is_readable( $cart_svg_file ) ) {
                                            // inline theme SVG for easier styling
                                            echo file_get_contents( $cart_svg_file );
                                        } else {
                                            // fallback: small, safe inline SVG cart icon
                                            echo '<svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M7 4h-2l-1 2h2l3.6 7.59L9.24 16c-.4.72.08 1.6.98 1.6h9.48v-2H11.1l.9-1.6h6.45c.75 0 1.41-.41 1.75-1.03l2.58-4.72A1 1 0 0 0 22.7 5H6.21L5.27 4H3V2h4v2z"/></svg>';
                                        }
                                        ?>
                                        <span class="cart-count" aria-hidden="true"><?php echo $cart_count; ?></span>
                                        <span class="screen-reader-text">
                                            <?php
                                            /* Visible text is the count; we also expose the cart total to screen readers if available */
                                            printf( esc_html__( '%1$s items in your cart', 'base-theme' ), $cart_count );
                                            if ( $cart_total ) {
                                                echo ' — ' . wp_strip_all_tags( $cart_total );
                                            }
                                            ?>
                                        </span>
                                    </a>
                                </li>

                                <?php
                            endif; // end if WooCommerce
                            ?>

                        </nav>
                </div>
            <!-- </div> -->
        </header>