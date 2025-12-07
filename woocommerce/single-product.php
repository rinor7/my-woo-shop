<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<?php
// Open container wrapping everything inside WooCommerce hooks
echo '<div class="container">';
echo '<div class="custom-woocommerce-single-product">';
do_action( 'woocommerce_before_main_content' ); // breadcrumbs + wrapper start

while ( have_posts() ) : the_post();
    wc_get_template_part( 'content', 'single-product' );
endwhile;

do_action( 'woocommerce_after_main_content' ); // wrapper end

do_action( 'woocommerce_sidebar' ); // sidebar inside container

echo '</div>'; // close custom-woocommerce-single-product
echo '</div>'; // close container
?>

<?php
// Footer
include get_template_directory() . "/includes/footers/default.php";
