<?php
/**
 * The template for displaying 'case-study' single posts
 */

get_header(); ?>

<?php get_template_part('template-parts/featured-image'); ?>
<div class="main-container">
    <div class="main-grid">
        <main class="main-content case-study-single">
            <?php while (have_posts()) :
                the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <div class="case-study-content"><?php the_field('content'); ?></div>
                <hr />

                <div class="case-study-testimonial"><?php the_field('testimonial'); ?></div>
                <p class="case-study-author"><?php the_field('testimonial_author'); ?></p>

                <?php
                    $images = get_field('image_gallery');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                ?>

                <?php if ($images) : ?>
                    <div class="grid-x grid-margin-x">
                        <?php foreach ($images as $image) : ?>
                            <div class="cell small-4 text-center">
                                <?php
                                    echo wp_get_attachment_image(
                                        $image['ID'],
                                        $size,
                                        null,
                                        array('class' => 'thumbnail')
                                    );
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </main>
    </div>
</div>

<?php get_footer();
