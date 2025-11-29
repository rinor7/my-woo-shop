<?php 
$banner = get_field('group_banner_second') ?: [];
if (empty($banner['disable_section'])): 
    $video_url = $banner['video'] ?? '';
    $image_url = $banner['image'] ?? '';
    $overlay_color = $banner['video_overlay_color'] ?? get_field('video_overlay_color') ?? '#000000a1';
    $bg_overlay_color = $banner['background_overlay_color'] ?? get_field('background_overlay_color') ?? '#000000a1';
    $background_color = $banner['background_color'] ?? '#000000';
    $content_color_theme = $banner['content_color_theme'] ?? 'light';
    $max_width = $banner['content_max_width'] ?? '';

    // New fields for LEFTS
    $background_left_color = $banner['background_left_color'] ?? '';
    $padding_desktop = $banner['padding_desktop'] ?? '';
    $padding_mobile = $banner['padding_mobile'] ?? '';

    // Height logic
    $min_height = $banner['min_height_desktop'] ?? '';
    if (wp_is_mobile() && !empty($banner['min_height_mobile'])) {
        $min_height = $banner['min_height_mobile'];
    }
    if (is_numeric($min_height)) {
        $min_height .= 'px';
    }

    // Inline style for section
    $inline_style = '';
    if (!empty($min_height)) {
        $inline_style .= 'min-height:' . esc_attr($min_height) . ';';
    }

    // Determine background for section
    if ($video_url) {
        // video background
    } elseif ($image_url) {
        $inline_style .= 'background-image:url(' . esc_url($image_url) . ');';
    } else {
        $inline_style .= 'background-color:' . esc_attr($background_color) . ';';
    }

    // Container option for entire section
    $background_container = $banner['background_container'] ?? 'without_container';
?>

<?php if ($background_container === 'with_container'): ?>
<div class="container parent-container-banner-all__section">
<?php endif; ?>

<section class="banner__section banner-all__section banner-all__section-second"
    <?php if (!empty($inline_style)): ?>style="<?php echo $inline_style; ?>"<?php endif; ?>
    aria-label="Banner">

    <?php if ($video_url): ?>
        <div class="video-wrapper">
            <video autoplay muted loop playsinline preload="auto" class="banner-video">
                <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="overlay" style="background-color: <?php echo esc_attr($overlay_color); ?>;"></div>
        </div>
    <?php elseif ($image_url): ?>
        <div class="image-overlay" style="background-color: <?php echo esc_attr($bg_overlay_color); ?>;"></div>
    <?php endif; ?>

    <div class="container">
        <div class="row align-items-center">
            <?php
            $content_width = $banner['content_width'] ?? 'two_columns';

            switch ($content_width) {
                case 'two_columns':
                    $col_class = 'col-lg-6';
                    break;
                case 'wide':
                    $col_class = 'col-lg-7';
                    break;
                case 'full_width':
                default:
                    $col_class = 'col-lg-12';
                    break;
            }

            $alignment_desktop = $banner['content_alignment'] ?? 'center';
            $alignment_mobile  = $banner['content_alignment_mobile'] ?? 'center';

            $alignment_class = '';
            if ($col_class === 'col-lg-12') {
                $alignment_class .= ' align-desktop-' . $alignment_desktop;
            }
            $alignment_class .= ' align-mobile-' . $alignment_mobile;

            $theme_class = 'content-' . esc_attr($content_color_theme);

            $max_width_style = '';
            if (!empty($max_width)) {
                $max_width_style = 'max-width:' . esc_attr($max_width) . ';';
            }

            // Inline styles for lefts
            $lefts_inline = '';
            if (!empty($background_left_color)) {
                $lefts_inline .= 'background-color:' . esc_attr($background_left_color) . ';';
            }
            if (!empty($padding_desktop)) {
                $lefts_inline .= 'padding:' . esc_attr($padding_desktop) . ';';
            }
            ?>
            <div class="lefts <?php echo esc_attr($col_class . ' ' . $alignment_class . ' ' . $theme_class); ?>" 
                <?php if (!empty($lefts_inline)): ?>style="<?php echo esc_attr($lefts_inline); ?>"<?php endif; ?>>
                <style>
                    @media (max-width: 767px) {
                        .banner-all__section-second .lefts {
                            <?php if (!empty($padding_mobile)): ?>
                                padding: <?php echo esc_attr($padding_mobile); ?> !important;
                            <?php endif; ?>
                        }
                    }
                </style>

                <?php if (!empty($banner['title'])): ?>
                    <h2 <?php if ($max_width_style): ?>style="<?php echo $max_width_style; ?>"<?php endif; ?>><?php echo wp_kses_post($banner['title']); ?></h2>
                <?php endif; ?>

                <?php if (!empty($banner['subtitle'])): ?>
                    <p <?php if ($max_width_style): ?>style="<?php echo $max_width_style; ?>"<?php endif; ?>><?php echo $banner['subtitle']; ?></p>
                <?php endif; ?>

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

            <?php 
            if (in_array($content_width, ['two_columns', 'wide'])) {
                $right_image_1 = $banner['right_image_1'] ?? '';
                $right_image_2 = $banner['right_image_2'] ?? '';
                if ($right_image_1 || $right_image_2): ?>
                    <div class="rights col-lg-<?php echo ($col_class === 'col-lg-7') ? '5' : '6'; ?>">
                        <div class="right-images">
                            <?php if ($right_image_1): ?>
                                <div class="right-image-item">
                                    <img src="<?php echo esc_url($right_image_1); ?>" alt="">
                                </div>
                            <?php endif; ?>
                            <?php if ($right_image_2): ?>
                                <div class="right-image-item">
                                    <img src="<?php echo esc_url($right_image_2); ?>" alt="">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif;
            }
            ?>
        </div>
    </div>
</section>

<?php if ($background_container === 'with_container'): ?>
</div>
<?php endif; ?>

<?php endif; ?>
