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
        <section class="why-choose-us">
            <?php
            $why_choose_us_items = get_field('why_choose_us_items');
            if ($why_choose_us_items) : ?>
             <div class="why-choose-us__wrapper">
                <?php foreach($why_choose_us_items as $elem) :
            ?>
                <div class="why-choose-us__item">
                    <div class="why-choose-us__number">
                        <?php echo $elem['number']; ?>
                    </div>
                    <div class="why-choose-us__text">
                        <?php echo $elem['text']; ?>
                    </div>
                </div>
            
            <?php 
        endforeach; ?>
        </div>
        <?php endif; ?>

        </section>
        <section class="customer-reviews">
            <h2 class="customer-reviews__title">
                <?php esc_html_e('Відгуки клієнтів', 'furniturestore'); ?>
            </h2>
            <div class="customer-reviews__wrapper">
                <?php
                $args = array(
					'post_type' => 'reviews',
					'posts_per_page' => -1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
                $query = new WP_Query($args);
                if ($query->have_posts()) :
                ?>
                <div class="owl-carousel owl-theme customer-reviews__carousel">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="customer-reviews__item item">
                    <div class="customer-reviews__item-wrapper">
                        <div class="customer-reviews__info">
                            <div class="customer-reviews__name">
                                <?php the_title(); ?>
                            </div>
                           
                            <div class="customer-reviews__stars">
                            <?php 
                                for ($i = 0; $i < 5; $i++) :
                            ?>
                                <img src="<?php echo get_template_directory_uri() . '/assets/images/icon/star.png'; ?>" alt=" icon star">
                            <?php endfor; ?>
                            </div>
                        </div>
                        <div class="customer-reviews__content">
                            <div class="customer-reviews__text">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>     
                </div>
                <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>
<?php get_footer(); ?>