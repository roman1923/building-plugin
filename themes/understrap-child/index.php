<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>

                <div class="pagination">
                    <?php echo paginate_links(); ?>
                </div>

            <?php else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
