<?php 
$gallery = get_field('gallery_section', 'option') ?: [];

if (empty($gallery['disable_section']) && !empty($gallery['images'])): 
?>
<section class="gallery__section">
    <!-- <div class="container"> -->

        <?php render_section_header('gallery_section', 'option'); ?>

        <div class="swiper mySwiper-gallery">
            <div class="swiper-wrapper">
                <?php foreach ($gallery['images'] as $item): ?>
                    <div class="swiper-slide">
                        <?php if (!empty($item['image'])): ?>
                            <img src="<?php echo esc_url($item['image']); ?>" alt="" loading="lazy">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <!-- </div> -->
</section>
<?php endif; ?>
