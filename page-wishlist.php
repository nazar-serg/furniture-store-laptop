<?php
get_header();
?>
<div class="wishlist-page">
    <div class="base-container">
    <?php custom_breadcrumbs(); ?>
        <h1 class="wishlist-page__title">
            <?php the_title(); ?>
        </h1>
        <?php echo do_shortcode('[wishlist]'); ?>
    </div>
</div>

<?php get_footer(); ?>