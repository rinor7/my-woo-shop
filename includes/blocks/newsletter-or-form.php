<?php if (!get_field('news_form_section', 'option')['disable_section'] ?? false): ?>
    <div class="container">
<section class="news-form__section" aria-label="Form Section">
    <div class="container">
        <div class="row">
            <?php if (!empty(get_field('news_form_section', 'option')['left_content'])): ?>
            <div class="news-form__left col-lg-6">
                <?php 
                echo do_shortcode(get_field('news_form_section', 'option')['left_content']); 
                ?>
            </div>
            <?php endif; ?>
            
            <?php if (!empty(get_field('news_form_section', 'option')['right_content'])): ?>
            <div class="news-form__right col-lg-6">
                <?php 
                    echo do_shortcode(get_field('news_form_section', 'option')['right_content']); 
                ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
</div>
<?php endif; ?>