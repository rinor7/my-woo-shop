<?php
/**
 * Template Name: Shop Custom
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Header
global $header_type;
include get_template_directory() . "/includes/headers/{$header_type}.php";

echo '<div class="custom-shop-page">';
echo '<div class="container">';
echo '<div class="custom-woocommerce-archive-product">';

do_action( 'woocommerce_before_main_content' );
// do_action( 'woocommerce_shop_loop_header' );

// LEFT sidebar
echo '<div class="row listing-row">';
echo '<div class="col-lg-3 mb-3"><div class="widget-wrapper">';
if ( class_exists('WC_Widget_Layered_Nav') ) {
    the_widget('WC_Widget_Attribute_Filter');
    the_widget('WC_Widget_Product_Tag_Cloud');
    the_widget('WC_Widget_Product_Categories');
}
echo '</div></div>';

// RIGHT product grid
echo '<div class="col-lg-9">';

// echo '<div class="row mb-3"><div class="col-12">';
// woocommerce_catalog_ordering();
// echo '</div></div>';

// Query products normally
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => get_option('posts_per_page'),
    'paged'          => $paged,
);
$products = new WP_Query( $args );

if ( $products->have_posts() ) {
    woocommerce_product_loop_start();
    while ( $products->have_posts() ) {
        $products->the_post();
        do_action( 'woocommerce_shop_loop' );
        wc_get_template_part( 'content', 'product' );
    }
    woocommerce_product_loop_end();
    do_action( 'woocommerce_after_shop_loop' );
} else {
    do_action( 'woocommerce_no_products_found' );
}

wp_reset_postdata();

echo '</div>'; // right column
echo '</div>'; // listing-row

do_action( 'woocommerce_after_main_content' );

echo '</div>'; // wrapper
echo '</div>'; // container
echo '</div>';

// Footer
include get_template_directory() . "/includes/footers/default.php";
