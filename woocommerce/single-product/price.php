<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $product;

// Price data
$regular  = $product->get_regular_price();
$sale     = $product->get_sale_price();
$price    = $product->get_price();
$savings  = $regular && $sale ? $regular - $sale : 0;
$percent  = $regular && $sale ? round( ( $savings / $regular ) * 100 ) : 0;

// VAT rate
$tax_rates = WC_Tax::get_rates( $product->get_tax_class() );
$rate      = reset( $tax_rates );
$vat_percent = isset( $rate['rate'] ) ? floatval( $rate['rate'] ) : 0;

// VAT wording dynamic
$prices_include_tax = get_option('woocommerce_prices_include_tax');

if ($prices_include_tax === 'yes') {
    $vat_text = 'incl. VAT' . ' ' . $vat_percent . ' %';
} else {
    $vat_text = 'plus VAT' . ' ' . $vat_percent . ' %';
}

// Discount wording dynamic
$discount_word = 'Discount';
?>

<div class="custom-price-box">

    <div class="price-left">
        <div class="current-price"><?php echo wc_price( $price ); ?></div>
        <div class="vat-line"><?php echo esc_html( $vat_text ); ?></div>
    </div>

    <?php if ( $sale ) : ?>
    <div class="price-right">
        <div class="old-price"><?php echo wc_price( $regular ); ?></div>

        <?php if ( $savings > 0 ) : ?>
            <div class="save-amount">
                <?php echo 'SAVE UP TO'; ?> <?php echo wc_price( $savings ); ?>
            </div>
        <?php endif; ?>

        <?php if ( $percent > 0 ) : ?>
            <div class="sale-badge"><?php echo $percent; ?>% <?php echo $discount_word; ?></div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

</div>
