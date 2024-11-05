<?php
/*
* Template Name: Template contact page
*/
?>
<?php get_header(); ?>
<div class="contact-page">
    <div class="base-container">
        <?php custom_breadcrumbs(); ?>
       <h1 class="contact-page__title">
        <?php the_title(); ?>
       </h1>
       <?php echo do_shortcode('[ccf_form]'); ?>
    </div>
</div>
<?php get_footer(); ?>