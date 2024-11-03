<?php get_header(); ?>

<h1>Архив блога</h1>

<?php if ( have_posts() ) : ?>
    <div class="post-list">
        <?php while ( have_posts() ) : the_post(); ?>
            <article>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php the_excerpt(); ?></p>
            </article>
        <?php endwhile; ?>
    </div>

    <?php the_posts_navigation(); ?>
<?php else : ?>
    <p>Записей не найдено.</p>
<?php endif; ?>

<?php get_footer(); ?>
