<?php

if (!defined('ABSPATH')) {
    exit;
}

$custom_description = get_field('custom_short_description');

if ($custom_description) : ?>
    <div class="woocommerce-product-details__short-description">
        <?php echo wp_kses_post($custom_description); ?>
    </div>
<?php endif; ?>
