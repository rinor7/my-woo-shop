<?php
defined( 'ABSPATH' ) || exit;

global $product;

$post_thumbnail_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();

$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--with-images',
        'images',
    )
);
?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>">

    <!-- MAIN IMAGE -->
    <div class="single-product-main-image">
        <?php
        if ( $post_thumbnail_id ) {

            // Get HTML WooCommerce generates
            $html = wc_get_gallery_image_html( $post_thumbnail_id, true );

            // Remove the <a ...> wrapper completely
            $html = preg_replace('/<a[^>]*>(.*?)<\/a>/is', '$1', $html);

            echo $html;

        } else {
            echo '<div class="woocommerce-product-gallery__image--placeholder">';
            echo sprintf(
                '<img src="%s" alt="%s" class="wp-post-image" />',
                esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ),
                esc_html__( 'Awaiting product image', 'woocommerce' )
            );
            echo '</div>';
        }
        ?>
    </div>

    <!-- GALLERY THUMBNAILS -->
    <?php if ( ! empty( $gallery_image_ids ) ) : ?>
        <div class="single-product-thumbnails">
            <?php
            foreach ( $gallery_image_ids as $gallery_id ) {

                // Get default HTML
                $thumb_html = wc_get_gallery_image_html( $gallery_id );

                // Remove anchor tag
                $thumb_html = preg_replace('/<a[^>]*>(.*?)<\/a>/is', '$1', $thumb_html);

                echo $thumb_html;
            }
            ?>
        </div>
    <?php endif; ?>

</div>
