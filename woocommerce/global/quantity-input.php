<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$min = isset( $min_value ) ? $min_value : 1;
$max = isset( $max_value ) ? $max_value : false;
$step = isset( $step ) ? $step : 1;
?>

<div class="quantity-wrapper">

    <button type="button" class="qty-btn minus">-</button>

    <input
        type="number"
        id="<?php echo esc_attr( $input_id ); ?>"
        class="qty"
        step="<?php echo esc_attr( $step ); ?>"
        min="<?php echo esc_attr( $min ); ?>"
        <?php if ( $max ) : ?>
            max="<?php echo esc_attr( $max ); ?>"
        <?php endif; ?>
        name="<?php echo esc_attr( $input_name ); ?>"
        value="<?php echo esc_attr( $input_value ); ?>"
    />

    <button type="button" class="qty-btn plus">+</button>

</div>
