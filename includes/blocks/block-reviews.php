<?php 
$reviews = get_field('reviews_section', 'option') ?: [];
if (empty($reviews['disable_section']) && !empty($reviews['reviews'])): 
?>
<section class="reviews__section">
    <div class="container">
    <?php render_section_header('reviews_section', 'option'); ?>

        <div class="swiper mySwiper-reviews">
            <div class="swiper-wrapper">
                <?php foreach ($reviews['reviews'] as $review): ?>
                    <div class="swiper-slide">
                        <div class="review-text">
                            <div class="review-content">
                                <?php if (!empty($review['title'])): ?>
                                    <h3><?php echo esc_html($review['title']); ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($review['subtitle'])): ?>
                                    <p><?php echo esc_html($review['subtitle']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <?php if (!empty($review['image'])): ?>
                            <div class="review-image">
                                <img src="<?php echo esc_url($review['image']); ?>" alt="<?php echo esc_attr($review['title'] ?? ''); ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
