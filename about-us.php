<?php /* Template Name: About Us */
get_header();
?>

<main id="primary" class="site-main site-about-us">

<?php 
$banner = get_field('group_banner') ?: [];
if (empty($banner['disable_section'])): 
    $image_url = $banner['image'] ?? '';
    $background_color = $banner['background_color'] ?? '#000000';
    $content_color_theme = $banner['content_color_theme'] ?? 'light';
    $vertical_alignment = $banner['vertical_alignment'] ?? 'center';

    // Height logic
    $min_height = $banner['min_height_desktop'] ?? '';
    if (wp_is_mobile() && !empty($banner['min_height_mobile'])) {
        $min_height = $banner['min_height_mobile'];
    }
    if (is_numeric($min_height)) {
        $min_height .= 'px';
    }

    // Inline style
    $inline_style = '';
    if (!empty($min_height)) {
        $inline_style .= 'min-height:' . esc_attr($min_height) . ';';
    }

    // Determine background
    if ($image_url) {
        $inline_style .= 'background-image:url(' . esc_url($image_url) . ');';
    } else {
        $inline_style .= 'background-color:' . esc_attr($background_color) . ';';
    }

    // Add color theme class
    $theme_class = 'content-' . esc_attr($content_color_theme);
    
    // Add vertical alignment class
    $alignment_class = 'align-' . esc_attr($vertical_alignment);
?>
<div class="container parent-container-about-hero__section">
    <section class="banner-in__two_columns">
        <div class="banner-about-hero__section"
            <?php if (!empty($inline_style)): ?>style="<?php echo $inline_style; ?>"<?php endif; ?>
            aria-label="Banner">

            <div class="container <?php echo $alignment_class; ?>">
                <div class="row">
                    <div class="center col-lg-12 <?php echo $theme_class; ?>">
                        <h1><?php echo wp_kses_post( preg_replace('/<\/?p>/', '', $banner['title']) ); ?></h1>
                        
                        <?php if (!empty($banner['button_name_1']) || !empty($banner['button_name_2'])): ?>
                            <div class="buttons">
                                <?php if (!empty($banner['button_name_1']) && !empty($banner['button_link_1'])): ?>
                                    <div class="default-btn">
                                        <a href="<?php echo esc_url($banner['button_link_1']); ?>" class="link-btn">
                                            <?php echo esc_html($banner['button_name_1']); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($banner['button_name_2']) && !empty($banner['button_link_2'])): ?>
                                    <div class="default-btn two-btns">
                                        <a href="<?php echo esc_url($banner['button_link_2']); ?>" class="link-btn">
                                            <?php echo esc_html($banner['button_name_2']); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php 
        // Features section connected to banner
        $features = get_field('group_features') ?: [];
        if (empty($features['disable_section']) && !empty($features['items'])): 
            $item_count = count($features['items']);
            // Calculate column class based on number of items
            $col_classes = [
                1 => 'col-12',
                2 => 'col-6 col-md-6',
                3 => 'col-6 col-md-4',
                4 => 'col-6 col-md-3'
            ];
            $col_class = $col_classes[$item_count] ?? 'col-6 col-md-3';
        ?>
            <div class="banner-features__section">
                <div class="container">
                    <div class="row justify-content-center">
                        <?php foreach ($features['items'] as $item): ?>
                            <div class="<?php echo $col_class; ?>">
                                <div class="feature-item">
                                    <?php if (!empty($item['image'])): ?>
                                        <div class="feature-image">
                                            <img src="<?php echo esc_url($item['image']); ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($item['text'])): ?>
                                        <span class="feature-text"><?php echo esc_html($item['text']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</div>
<?php endif; ?>

<?php get_template_part('includes/blocks/block-three-box', null, array()); ?>

<?php get_template_part('includes/blocks/block-banner-all-second', null, array()); ?>

<?php get_template_part('includes/blocks/block-reviews', null, array()); ?>

<?php get_template_part('includes/blocks/block-infinite-swiper', null, array()); ?>

</main>

<?php get_footer(); ?>