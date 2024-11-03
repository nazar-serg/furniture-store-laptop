<?php get_header(); ?>
<div class="single-article">
    <div class="base-container">
        <?php custom_breadcrumbs(); ?>
       <h1 class="single-article__title">
        <?php the_title(); ?>
       </h1>
       <div class="single-article__thumbnail">
        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
       </div>
       <div class="single-article__content">
        
       </div>
    </div>
</div>
<?php get_footer(); ?>