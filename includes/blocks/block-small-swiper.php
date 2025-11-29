<?php if (!get_field('block-small-swiper')['disable_section'] ?? false): ?>
<section class="block-small-swiper">
    <div class="container">
        <div class="swiper mySwiper mySwiper-boxes-section">
            <div class="swiper-wrapper">
                <?php
                    // Keep the disable_section check where it is (pt-swiper). The repeater items
                    // for this block are stored on the ACF Options page as a top-level
                    // repeater named 'block-small-swiper'. Use 'option' to fetch them directly.
                    $repeater_items = get_field('block-small-swiper', 'option') ?: array();
                    if (!empty($repeater_items)):
                        foreach ($repeater_items as $item):
                    ?>
                <div class="swiper-slide">
                    <div class="slider-wrap">
                        <div class="img">
                            <img src="<?php echo esc_url($item['image']['url'] ?? ''); ?>" alt="<?php echo esc_attr($item['image']['alt'] ?? ''); ?>" loading="lazy">
                        </div>
                        <div class="content">
                            <span><?php echo esc_html($item['title'] ?? ''); ?></span>
                            <p><?php echo wp_kses_post($item['content'] ?? ''); ?></p>
                        </div>
                    </div>
                </div>
                <?php
                        endforeach;
                    endif;
                    ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>