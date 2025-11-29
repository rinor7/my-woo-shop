<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Default classes
$classes = 'row row-cols-lg-2 row-cols-xl-4 row-cols-md-2 row-cols-sm-2 row-listing shop-page';

// Change for your specific archive page
if ( is_product_category( )) {
    $classes = 'row row-cols-lg-2 row-cols-xl-3 row-cols-md-2 row-cols-sm-2 row-listing';
}

?>

<div class="<?php echo esc_attr( $classes ); ?>">
