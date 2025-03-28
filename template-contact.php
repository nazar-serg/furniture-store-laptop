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
       <div class="contact-page__wrapper">
            <div class="contact-page__info">
                <div class="contact-page__item">
                    <?php 
                    $address_group = get_field('address_group');
                    if($address_group) :
                    ?>
                    <h3 class="contact-page__title-item">
                        <?php echo $address_group['title']; ?>
                    </h3>
                    <div class="contact-page__text">
                        <?php echo $address_group['text']; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="contact-page__item">
                    <?php 
                    $address_group = get_field('contact_us_group');
                    if($address_group) :
                    ?>
                    <h3 class="contact-page__title-item">
                        <?php echo $address_group['title']; ?>
                    </h3>
                    <div class="contact-page__text">
                        <a href="tel:<?php echo $address_group['phone']; ?>">
                            <?php echo $address_group['phone']; ?>
                        </a>
                    </div>
                    <div class="contact-page__text">
                        <a href="mailto:<?php echo $address_group['email']; ?>">
                            <?php echo $address_group['email']; ?>
                        </a>
                        
                    </div>
                    <?php endif; ?>
                </div>

                <div class="contact-page__item">
                    <?php 
                    $working_time_group = get_field('working_time_group');
                    if($working_time_group) :
                    ?>
                    <h3 class="contact-page__title-item">
                        <?php echo $working_time_group['title']; ?>
                    </h3>
                    <div class="contact-page__text">
                        <?php echo $working_time_group['time_work_1']; ?>
                    </div>
                    <div class="contact-page__text">
                    <?php echo $working_time_group['time_work_2']; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="contact-page__form">
                <?php echo do_shortcode('[ccf_form]'); ?>
            </div>
       </div>
       
    </div>
</div>
<?php get_footer(); ?>