<?php
defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' );
?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; ?>">

    <?php do_action( 'woocommerce_before_variations_form' ); ?>

    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
    <?php else : ?>

        <!-- Hidden table with selects (required for WooCommerce) -->
        <table class="variations" cellspacing="0" role="presentation" style="display:none;">
            <tbody>
                <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                    <tr>
                        <th class="label">
                            <label for="attribute_<?php echo sanitize_title( $attribute_name ); ?>">
                                <?php echo wc_attribute_label( $attribute_name ); ?>
                            </label>
                        </th>
                        <td class="value">
                            <select name="attribute_<?php echo sanitize_title( $attribute_name ); ?>">
                                <option value="">
                                    <?php echo esc_html( sprintf( __( 'Choose an option', 'woocommerce' ), wc_attribute_label( $attribute_name ) ) ); ?>
                                </option>
                                <?php foreach ( $options as $option ) : ?>
                                    <option value="<?php echo esc_attr( $option ); ?>">
                                        <?php echo esc_html( $option ); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Visible button-style variations -->
        <div class="custom-variation-buttons-wrapper">
            <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                <div class="custom-variation-group" data-attribute_name="<?php echo esc_attr($attribute_name); ?>">
                    <div class="custom-variation-label">
                        <?php echo wc_attribute_label( $attribute_name ); ?>
                    </div>
                    <div class="custom-variation-buttons">
                        <?php foreach ( $options as $option ) : ?>
                            <button type="button" class="variation-option" data-value="<?php echo esc_attr($option); ?>">
                                <?php echo esc_html( $option ); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <div class="reset_variations_alert screen-reader-text" role="alert" aria-live="polite" aria-relevant="all"></div>
        <?php do_action( 'woocommerce_after_variations_table' ); ?>

        <div class="single_variation_wrap">
            <?php
            do_action( 'woocommerce_before_single_variation' );
            do_action( 'woocommerce_single_variation' );
            do_action( 'woocommerce_after_single_variation' );
            ?>
        </div>

    <?php endif; ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>


<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.custom-variation-buttons .variation-option').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const group = button.closest('.custom-variation-group');
            const attribute = group.dataset.attribute_name;
            group.querySelectorAll('.variation-option').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            const select = document.querySelector('select[name="attribute_' + attribute.toLowerCase() + '"]');
            if (select) {
                select.value = button.dataset.value;
                jQuery(select).trigger('change');
            }
        });
    });
});
</script>


