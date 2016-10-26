<?php //get_template_part('templates/page', 'header'); ?>
<div class="margen">
<div class="container">

<div id="filters" class="clearfix combo-filters">
	<div class="ui-group">
		<h6>Zonas:</h6>			
		<?php tax_termsB(); ?>
	</div>
	<br>
	<div class="ui-group">
		<h6>Tipo:</h6>
		<div class="btn-group btn-group-tipo option-set" data-filter-group="tipo">
			<button class="btn btn-sm btn-outline-primary check" data-filter="*" >Todos</button>
			<?php $taxName = "tipo";
			$terms = get_terms($taxName,array('parent' => 0,'orderby' => 'name','order' => 'ASC'));
			foreach($terms as $term) {
				echo '<button class="btn btn-sm btn-outline-primary collapsed tipo-'.$term->slug.'" data-filter=".tipo-'.$term->slug.'" data-toggle="collapse" data-target="#tipo-'.$term->slug.'" >'.$term->name.'</button>';
			}
			?>
		</div>
	</div>
</div>
<hr>
<!-- el gran listado -->
<div class="grid row">
	<?php query_posts( $query_string . '&posts_per_page=-1&orderby=rand' ); while (have_posts()) : the_post(); ?>

	<div <?php post_class("grid-item col-sm-4"); ?> data-zona="<?php data_lugar('zona'); ?>" data-tipo="<?php data_lugar('tipo'); ?>">
		<div class="card card-inverse" <?php poster_bg("medium"); ?> >
			<div class="card-block text-xs-center card-text">
				<?php  $terms = get_the_terms( $post->ID, 'tipo' );
				if ( $terms ){
					foreach ( $terms as $term ) {
						echo '<img src="'.get_template_directory_uri().'/dist/images/i_'.$term->slug.'_b.png" class="icono">';
					}
					echo '<p class="lead">'.$term->name.'</p>';
				} ?>
				<h6 class="entry-title0"><?php the_title(); ?></h6>
				<?php entry_termsB(); ?>
				<a href="<?php the_permalink(); ?>" class="btn btn-secondary">ver</a>
			</div>
		</div>
	</div>
<?php endwhile; ?>
</div>
</div>
</div>