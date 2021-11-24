<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <main>
        <div class="container">
            <?php the_content() ?>
        </div>
    </main>
<?php endwhile; ?>
<?php get_footer(); ?>
