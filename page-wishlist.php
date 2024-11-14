<?php
get_header();
?>
<div class="wishlist-page">
    <div class="base-container">
    <?php custom_breadcrumbs(); ?>
        <h1 class="wishlist-page__title">
            <?php the_title(); ?>
        </h1>
    <div class="wishlist-page__list-products">
        <?php
        $wishlist = furniturestore_get_withlist();
        $wishlist = implode(',', $wishlist);
        ?>

        <?php if (!$wishlist) : ?>
            <p><?php esc_html_e('Список бажань порожній', 'furniturestore'); ?></p>
        <?php else : ?>
            <?php echo do_shortcode("[products ids='$wishlist' limit=8]"); ?>
        <?php endif; ?>
    </div>
    </div>
</div>

<?php get_footer(); ?>