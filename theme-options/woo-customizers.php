<?php 
// Remove default thumbnail in the loop
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

// Add gallery thumbnails inside one wrapper
add_action('woocommerce_before_shop_loop_item_title', 'show_gallery_in_loop', 10);
function show_gallery_in_loop() {
    global $product;
    $gallery_ids = $product->get_gallery_image_ids();

    echo '<div class="product-thumbnails-wrapper">'; // wrapper div starts

    if (!empty($gallery_ids)) {
        // Show first image as main
        echo wp_get_attachment_image($gallery_ids[0], 'woocommerce_thumbnail');

        // Show rest as thumbnails
        if (count($gallery_ids) > 1) {
            echo '<div class="product-gallery-thumbs">';
            foreach ($gallery_ids as $key => $id) {
                if ($key === 0) continue; // skip first, already shown
                echo wp_get_attachment_image($id, 'thumbnail');
            }
            echo '</div>';
        }
    } else {
        // fallback to featured image if no gallery
        echo get_the_post_thumbnail($product->get_id(), 'woocommerce_thumbnail');
    }

    echo '</div>'; // wrapper div ends
}




// // Remove default WooCommerce add-to-cart placement
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Add your custom wrapper with ONLY Woo add-to-cart button
add_action('woocommerce_after_shop_loop_item', 'custom_loop_buttons_wrapper', 10);
function custom_loop_buttons_wrapper() {
    echo '<div class="product-actions-wrapper">';
    woocommerce_template_loop_add_to_cart();
    echo '</div>';
}


// Enable WooCommerce support in the theme
add_action( 'after_setup_theme', function() {
    add_theme_support( 'woocommerce' );
});


add_action('woocommerce_after_add_to_cart_form', function() {
    if (is_product()) {

        // hide titles only during this sidebar render
        add_filter('widget_title', 'luna_hide_widget_titles_temp');

        dynamic_sidebar('footer-4');

        // restore normal widget title behavior
        remove_filter('widget_title', 'luna_hide_widget_titles_temp');
    }
});

function luna_hide_widget_titles_temp($title) {
    return '';
}

// Remove the WooCommerce product meta block
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);



// Disable default YITH wishlist output
add_filter('yith_wcwl_positions', function($positions) {
    return []; // remove all default positions
});

add_action('woocommerce_before_add_to_cart_button', function() {
    $button = function_exists('YITH_WCWL') ? do_shortcode('[yith_wcwl_add_to_wishlist]') : '';
    if ($button) {
        echo '<div class="custom-wishlist-wrapper">'.$button.'</div>';
    }
}, 15);


//Remove Default Excerpt on Product Page
add_action('admin_head', function() {
    echo '<style>#postexcerpt { display: none !important; }</style>';
});


//Remove H2 from from tabs on Product Page
add_filter('woocommerce_product_description_heading', '__return_empty_string');
add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');
add_filter('woocommerce_product_reviews_heading', '__return_empty_string');


//Disable default gallery Woo
add_action('wp_enqueue_scripts', function() {
    wp_dequeue_script('zoom');
    wp_dequeue_script('flexslider');
    wp_dequeue_script('photoswipe-ui-default');
    wp_dequeue_style('photoswipe-default-skin');
});

