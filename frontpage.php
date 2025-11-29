<?php
/* Template Name: Home */
global $header_type; // required to access global variable
include("includes/headers/{$header_type}.php");
?>

<main id="primary" class="site-main">

<?php get_template_part('includes/blocks/block-banner-all', null, array()); ?>

<?php get_template_part('includes/blocks/block-small-swiper', null, array()); ?>

<div class="product-collection">
    <div class="container">
        <?php 
        $title = get_field('products_section_title'); // single text field
        if ($title) {
            echo '<div class="section-header"><div class="section-header-title">' . esc_html($title) . '</div></div>';
        }

        $content = get_field('products_shortcode');
        if ($content) {
            echo do_shortcode($content);
        }

        $button = get_field('products_btn');
        if (is_array($button)) {
            $url = esc_url($button['url']);
            $text = esc_html($button['title']);
            $target = !empty($button['target']) ? ' target="_blank"' : '';

            echo '<div class="section-button"><a class="btn" href="'.$url.'"'.$target.'>'.$text.'</a></div>';
        }


        ?>
    </div>
</div>

<?php get_template_part('includes/blocks/block-banner-all-second', null, array()); ?>

<div class="product-collection product-collection_two">
    <div class="container">
        <?php 
        $title = get_field('products_section2_title'); // single text field
        if ($title) {
            echo '<div class="section-header"><div class="section-header-title">' . esc_html($title) . '</div></div>';
        }

        $content = get_field('products_shortcode2');
        if ($content) {
            echo do_shortcode($content);
        }

        $button = get_field('products_btn2');
        if (is_array($button)) {
            $url = esc_url($button['url']);
            $text = esc_html($button['title']);
            $target = !empty($button['target']) ? ' target="_blank"' : '';

            echo '<div class="section-button"><a class="btn" href="'.$url.'"'.$target.'>'.$text.'</a></div>';
        }

        ?>
    </div>
</div>

<?php get_template_part('includes/blocks/block-image-with-text', null, array()); ?>

<div class="product-collection product-collection_three">
    <div class="container">
        <?php 
        $title = get_field('products_section3_title'); // single text field
        if ($title) {
            echo '<div class="section-header"><div class="section-header-title">' . esc_html($title) . '</div></div>';
        }

        $content = get_field('products_shortcode3');
        if ($content) {
            echo do_shortcode($content);
        }

        $button = get_field('products_btn3');
        if (is_array($button)) {
            $url = esc_url($button['url']);
            $text = esc_html($button['title']);
            $target = !empty($button['target']) ? ' target="_blank"' : '';

            echo '<div class="section-button"><a class="btn" href="'.$url.'"'.$target.'>'.$text.'</a></div>';
        }

        ?>
    </div>
</div>

</main>

<?php include("includes/footers/default.php");  ?>