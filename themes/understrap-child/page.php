<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col">
			<?php if (have_posts()):
				while (have_posts()):
					the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<div class="content">
						<?php the_content(); ?>
					</div>
				<?php endwhile; endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>