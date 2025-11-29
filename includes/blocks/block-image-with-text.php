<!-- if its needed background without container 
add image-no-container-left class on parent div block-image-with-text-->
<?php if (!get_field('block-image-with-text')['disable_section'] ?? false): ?>
<section class="block-image-with-text" aria-label="Section Image-Text">
    <div class="container">
        <div class="row">
            <div class="lefts col-lg-6">

                <div class="img">
                    <img src="<?php echo ( get_field('block-image-with-text')['image'] );?>" alt="Background"
                        loading=“lazy”>
                </div>

            </div>
            <div class="rights col-lg-6">
                <h2><?php echo ( get_field('block-image-with-text')['titleh1'] );?></h2>
                <div class="paragraph-second"><?php echo ( get_field('block-image-with-text')['titleh2'] );?></div>
                <div class="paragraph-third"><?php echo ( get_field('block-image-with-text')['titleh3'] );?></div>

                <div class="buttons">
                    <div class="default-btn">
                        <a href="<?php echo ( get_field('block-image-with-text')['link1'] );?>"
                            class="link-btn"><?php echo ( get_field('block-image-with-text')['name1'] );?></a>
                    </div>
                    <div class="default-btn two-btns">
                        <a href="<?php echo ( get_field('block-image-with-text')['link2'] );?>"
                            class="link-btn"><?php echo ( get_field('block-image-with-text')['name2'] );?></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php endif; ?>