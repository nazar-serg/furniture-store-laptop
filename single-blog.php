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
            <?php if (have_rows('blog_single_page')) : 
                while(have_rows('blog_single_page')) : the_row();

                    if (get_row_layout() == 'text_single_page_text' ) :
                        $content = get_sub_field('text');
            ?>

            <div class="single-article__main-content">
                <?php echo $content; ?>
            </div>
            <?php elseif( get_row_layout() == 'text_single_page_image' ):
            $image_id = get_sub_field('image');

            if ($image_id) : ?>
            <div class="single-article__content-image animation-gsap">
                <?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
            </div>
            <?php endif; ?>
            <?php elseif( get_row_layout() == 'text_single_page_blockquote' ):
            $text_blockquote = get_sub_field('blockquote');
            ?>
            <div class="single-article__blockquote">
                <blockquote>
                    <?php echo $text_blockquote; ?>
                </blockquote>
            </div>
            <?php 
            endif;
        endwhile;
        endif; ?>
       </div>
       <div class="single-article__other-posts">
       <h2 class="single-article__title-other-posts title-h2">
			<?php esc_html_e('Статті', 'furniturestore'); ?>
		</h2>
       <?php
            $current_post_id = get_the_ID();

            $args = array(
                'post_type' => 'blog',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'post__not_in' => array($current_post_id),
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) : ?>
                <div class="articles__wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="articles__item">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="articles__post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="articles__post-info">
                                <span class="articles__post-data">
                                    <?php echo get_the_date(); ?>
                                </span>
                                <h3 class="articles__post-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php
            endif;

            wp_reset_postdata(); 
            ?>

       </div>
    </div>
</div>
<?php get_footer(); ?>