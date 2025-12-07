<?php
/* Template Name: Contact */
get_header();
?>

<main id="primary" class="site-main site-contact">

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
    <section class="banner-in__contact">
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

    </section>
</div>
<?php endif; ?>


<?php 
// Three Boxes Section
$three_boxes = get_field('group_three_boxes_contact') ?: [];
if (empty($three_boxes['disable_section']) && !empty($three_boxes['boxes'])): 
?>
<section class="three-box-contact__section">
    <div class="container">
        <div class="row">
            <?php foreach ($three_boxes['boxes'] as $box): ?>
                <div class="box col-12 col-md-4">
                    <div class="box__wrap">
                        <div class="upside">
                        <?php if (!empty($box['image'])): ?>
                            <div class="img">
                                <img src="<?php echo esc_url($box['image']); ?>" alt="<?php echo esc_attr($box['title'] ?? ''); ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($box['title'])): ?>
                            <span class="box__title"><?php echo esc_html($box['title']); ?></span>
                        <?php endif; ?>
                        </div>
                        <?php if (!empty($box['subtitle'])): ?>
                            <div class="box__subtitle"><?php echo wp_kses_post($box['subtitle']); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>




<?php 
$banner = get_field('group_banner_one-contact') ?: [];

if (!($banner['disable_section'] ?? false)):

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

    // Background image
    if (!empty($banner['image'])) {
        $inline_style .= 'background-image:url(' . esc_url($banner['image']) . ');';
    }
?>
<div class="container">
<section class="banner-contact-form__section"
    <?php if (!empty($inline_style)): ?>style="<?php echo $inline_style; ?>"<?php endif; ?>
    aria-label="Banner">
    <div class="container">
        <div class="center">
            <h2><?php echo ($banner['title-form'] ?? ''); ?></h2>
            <?php echo ($banner['form'] ?? ''); ?>
        </div>
    </div>
</section>

</div>
<?php endif; ?>

<?php get_template_part('includes/blocks/block-reviews', null, array()); ?>

<?php get_template_part('includes/blocks/block-infinite-swiper', null, array()); ?>

</main>

<?php include("includes/footers/default.php");  ?>