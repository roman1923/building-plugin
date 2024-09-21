<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col">
			<?php if (have_posts()): ?>
				<?php while (have_posts()):
					the_post(); ?>
					<div class="post">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php else: ?>
				<p>No posts found.</p>
			<?php endif; ?>
			<span>Примітка: перший будинок це ідентичний або максимально наближений до вашого запиту, кожні наступні також наближені та відсортованні за спаданням екологічності</span>
			<?php echo do_shortcode('[real_estate_filter]'); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>