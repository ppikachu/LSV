<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
		
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<div class="entry-content row">
			<div class="col-md-7">
				<?php the_content(); ?>
			</div>
			<div class="col-md-5">
				<?php $args = array (
					'p'                      => wpcf_pr_post_get_belongs(get_the_ID(),'promo'),
					'post_type'              => array( 'promo' ),
				);
				$query = new WP_Query( $args );

				// The Loop
				if ( $args['p'] ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						the_content();
					}
				}
				wp_reset_postdata(); ?>
			</div>
		</div>

		<?php
		$direccion = types_render_field("direccion");
		$direccion = str_replace(' ', '+', $direccion);
		$zoom = types_render_field("zoom");
		if ($direccion) {	?>
		
		<!-- <img class="img-fluid" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $direccion; ?>&zoom=12&size=640x360&markers=color:blue|label:<?php echo the_title(); ?>|<?php echo $direccion; ?>&key=AIzaSyBICzl0aDD-taMslP42Z1_cFYPrt6Harao"> -->

		<div class="iframe-container">
		<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $direccion; ?>&zoom=<?php echo $zoom; ?>&key=<?php $options = get_option('lsv_options'); echo of_get_option('maps_api'); ?>" allowfullscreen></iframe>
		</div>
		<?php }	?>
			
		<footer>
			<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
		</footer>
		<?php comments_template('/templates/comments.php'); ?>
	</article>
<?php endwhile; ?>