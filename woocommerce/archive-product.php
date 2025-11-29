<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Custom Header
global $header_type;
include get_template_directory() . "/includes/headers/{$header_type}.php";

// Open container wrapping everything
echo '<div class="container">';
echo '<div class="custom-woocommerce-archive-product">';

do_action( 'woocommerce_before_main_content' ); // breadcrumbs + wrapper start

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );

if ( woocommerce_product_loop() ) {

    // ------------------------------------------------
    // MAIN CONTENT ROW: Left filters, right product grid
    // ------------------------------------------------
    echo '<div class="row listing-row">';

        // LEFT: WooCommerce layered nav / filters
        echo '<div class="col-lg-3 mb-3">';
        echo '<div class="widget-wrapper">';
        // if ( is_active_sidebar( 'widget-6' ) ) {
        //     dynamic_sidebar( 'widget-6' );
        // }
        // WooCommerce filter widgets (price, attributes, etc.)
       if ( class_exists('WC_Widget_Layered_Nav') ) {

            $widgets = [
                'WC_Widget_Layered_Nav',
                'WC_Widget_Layered_Nav_Filters',
                'WC_Widget_Price_Filter',
                'WC_Widget_Attribute_Filter',
                'WC_Widget_Product_Tag_Cloud',
                'WC_Widget_Product_Categories',
                // 'WC_Widget_Product_Search',
            ];

            foreach ( $widgets as $widget ) {
                ob_start();
                // suppress warnings inside widget output
                @$the_widget_output = the_widget( $widget, array(), array( 'widget_id' => 'temp', 'widget_name' => 'temp' ) );
                $content = trim( ob_get_clean() );

                if ( ! empty( $content ) ) {
                    echo $content;
                }
            }
        }

        echo '</div>';
        echo '</div>';

        // RIGHT: Product grid + catalog ordering
        echo '<div class="col-lg-9">';

        // Catalog ordering row at the top inside right column
        echo '<div class="row mb-3 sorting-filter">';
        echo '<div class="col-12">';
        woocommerce_catalog_ordering();
        echo '</div>';
        echo '</div>';

        // Product grid start
        woocommerce_product_loop_start(); // outputs your row wrapper

        if ( wc_get_loop_prop( 'total' ) ) {
            while ( have_posts() ) {
                the_post();
                do_action( 'woocommerce_shop_loop' );
                wc_get_template_part( 'content', 'product' );
            }
        }

        woocommerce_product_loop_end(); // closes row wrapper

        do_action( 'woocommerce_after_shop_loop' ); // pagination

        echo '</div>'; // close right column

    echo '</div>'; // close main content row

} else {
    do_action( 'woocommerce_no_products_found' );
}

do_action( 'woocommerce_after_main_content' ); // wrapper end

echo '</div>'; // close custom-woocommerce-archive-product
echo '</div>'; // close container

// Custom Footer
include get_template_directory() . "/includes/footers/default.php";