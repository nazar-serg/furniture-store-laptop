<?php get_header(); ?>
<div class="blog-page">
    <div class="base-container">
        <?php custom_breadcrumbs(); ?>
       <h1 class="blog-page__title">
        <?php esc_html_e('Блог', 'furniturestore'); ?>
       </h1>
       <div class="blog-page__all-posts">
       <?php
				$args = array(
					'post_type' => 'blog',
					'posts_per_page' => 3,
					'orderby' => 'date',
					'order' => 'DESC'
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
			?>
       </div>
    </div>
</div>
<?php get_footer(); ?>