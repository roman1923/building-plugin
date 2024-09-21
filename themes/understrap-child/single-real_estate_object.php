<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col">
			<?php if (have_posts()):
				while (have_posts()):
					the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<ul>
						<li><strong>Building Name:</strong> <?php the_field('building_name'); ?></li>
						<li><strong>Coordinates:</strong> <?php the_field('location_coordinates'); ?></li>
						<li><strong>Number of Floors:</strong> <?php the_field('number_of_floors'); ?></li>
						<li><strong>Building Type:</strong> <?php the_field('building_type'); ?></li>
						<li><strong>Environmental Rating:</strong> <?php the_field('environmental_rating'); ?></li>
					</ul>

					<h3>Premises</h3>
					<?php if (have_rows('premises')): ?>
						<ul>
							<?php while (have_rows('premises')):
								the_row(); ?>
								<li>
									<strong>Premise Area:</strong> <?php the_sub_field('premise_area'); ?><br>
									<strong>Number of Rooms:</strong> <?php the_sub_field('number_of_rooms'); ?><br>
									<strong>Balcony:</strong> <?php the_sub_field('balcony'); ?><br>
									<strong>Bathroom:</strong> <?php the_sub_field('bathroom'); ?><br>
									<?php
									$premise_image = get_sub_field('premise_image');
									if ($premise_image): ?>
										<img src="<?php echo esc_url($premise_image['url']); ?>" alt="Premise Image">
									<?php endif; ?>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				<?php endwhile; endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>