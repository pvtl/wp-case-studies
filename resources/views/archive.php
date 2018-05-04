<?php
/**
 * The template for displaying archive pages
 */

get_header(); ?>

<div class="main-container">
    <div class="main-grid">
        <main class="main-content">
        <?php if (have_posts()) : ?>
            <div class="grid-x grid-margin-x">
                <?php while (have_posts()) :
                    the_post(); ?>
                    <div class="cell small-4 text-center">
                        <div class="card">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('small') ?>
                            </a>
                            <div class="card-section">
                                <h3><?php the_title(); ?></h3>
                                <div class="case-study-summary">
                                    <?php the_field('summary'); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="button">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php
        if (function_exists('foundationpress_pagination')) :
            foundationpress_pagination();
        elseif (is_paged()) :
        ?>
            <nav id="post-nav">
                <div class="post-previous"><?php next_posts_link(__('&larr; Older posts', 'foundationpress')); ?></div>
                <div class="post-next"><?php previous_posts_link(__('Newer posts &rarr;', 'foundationpress')); ?></div>
            </nav>
        <?php endif; ?>

        </main>
        <?php get_sidebar(); ?>

    </div>
</div>

<?php get_footer();
