<?php
/*
* Template Name: Template about page
*/
?>
<?php get_header(); ?>
<div class="about-page">
    <div class="base-container">
        <?php custom_breadcrumbs(); ?>
        <section class="about-page__main-content">
            <section class="about-page__content-top">
                <div class="about-page__text">
                    <h1 class="about-page__title">
                        <?php the_title(); ?>
                    </h1>
                    <?php the_field('about_text_left'); ?>
                </div>
                <div class="about-page__image animation-gsap">
                    <?php 
                    $image = get_field('about_image_right');
                    $size = 'full';
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size );
                    }
                    ?>
                </div>
            </section>

            <section class="about-page__content-bottom">
                <div class="about-page__image animation-gsap">
                    <?php 
                    $image = get_field('about_image_left');
                    $size = 'full';
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size );
                    }
                    ?>
                </div>
                <div class="about-page__text">
                    <?php the_field('about_text_right'); ?>
                </div>
            </section>
            
        </section>
    </div>
</div>
<?php get_footer(); ?>