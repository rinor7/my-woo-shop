<?php
global $header_type; // required to access global variable
include("includes/headers/{$header_type}.php"); 
?>

<main id="primary" class="site-archive archive-page-main-posts">

	<?php include("includes/blocks/hero.php"); ?>

    <div class="container">
        <div class="archive-layout">
            <div class="archive-content">
                <?php if (have_posts()) : ?>

                    <div class="page-header">
                        <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
                    </div>

                    <div class="articles row">
                        <?php while (have_posts()) : the_post(); ?>

                        <article class="col-lg-4 col-md-6 col-6" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <a href="<?php the_permalink(); ?>">
                            <?php 
                                $transparent_bg = get_field('transparent_bg');

                                if ($transparent_bg) : ?>
                                    <div class="<?php echo get_field('transparent_bg') ? 'transparent-bg' : ''; ?>">
                                    <img src="<?php echo esc_url($transparent_bg); ?>" alt="">
                                    </div>
                                    
                                <?php elseif (has_post_thumbnail()) : ?>
                                    <div class="main-image">
                                    <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php endif; 
                            ?>

                            <h2 class="entry-title">
                                <?php the_title(); ?>
                            </h2>

                            <div class="entry-category">
                                <?php echo 'Category:'; ?>
                                <span><?php 
                                    $cat = get_the_category();
                                    if (!empty($cat)) {
                                        echo $cat[0]->name;
                                    }
                                ?>
                                </span>
                            </div>  

                            <div class="entry-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            </a>
                            </article>


                        <?php endwhile; ?>
                    </div>

                    
                <?php else : ?>

                    <p><?php _e('No posts found', 'base-theme'); ?></p>

                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php include("includes/footers/default.php");  ?>