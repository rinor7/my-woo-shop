<?php 
// Three Boxes Section
$three_boxes = get_field('group_three_boxes') ?: [];
if (empty($three_boxes['disable_section']) && !empty($three_boxes['boxes'])): 
?>
<section class="three-box-about__section">
    <div class="container">
    <?php render_section_header('group_three_boxes'); ?>
        <div class="row">
            <?php foreach ($three_boxes['boxes'] as $box): ?>
                <div class="box col-12 col-md-4">
                    <div class="box__wrap">
                        <?php if (!empty($box['image'])): ?>
                            <div class="img">
                                <img src="<?php echo esc_url($box['image']); ?>" alt="<?php echo esc_attr($box['title'] ?? ''); ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($box['title'])): ?>
                            <span class="box__title"><?php echo esc_html($box['title']); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($box['subtitle'])): ?>
                            <p class="box__subtitle"><?php echo esc_html($box['subtitle']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>