<?php
/*
* Template Name: Template faq page
*/
?>
<?php get_header(); ?>
<div class="faq">
    <div class="base-container">
        <?php custom_breadcrumbs(); ?>
       <h1 class="faq__title">
        <?php the_title(); ?>
       </h1>
       <div class="faq__wrapper">
        <div class="faq__image animation-gsap">
            <?php 
                $image = get_field('faq_image');
                $size = 'full';

                if ($image) {
                    echo wp_get_attachment_image($image, $size);
                }
            ?>
        </div>
       <div class="faq__accordion">
        <?php
        $rows = get_field('faq');
        if ($rows) :
            foreach($rows as $row) :
        ?>
        <div class="faq__item">
            <div class="faq__header">
                <h3><?php echo $row['title']; ?></h3>
                <span class="arrow"><i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
            </div>
            <div class="faq__content">
                <p><?php echo $row['text']; ?></p>
            </div>
        </div>
        <?php
    endforeach;
    endif; 
    ?>
       </div>
       </div>
    </div>
</div>
<?php get_footer(); ?>