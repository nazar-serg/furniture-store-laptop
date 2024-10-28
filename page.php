<?php get_header() ?>
<div class="base-container">
        <?php custom_breadcrumbs(); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h1 class="section-title mb-3"><span><?php the_title() ?></span></h1>
			<?php the_content(); ?>
			<?php endwhile; else: ?>
			<p>Записів немає.</p>
		<?php endif; ?>		
</div>


<?php get_footer() ?>