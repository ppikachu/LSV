<?php
/**
 * Template Name: Inicio Template
 */
?>

<?php mostrar_banner('rotator-home-1'); ?>

<?php while (have_posts()) : the_post(); ?>
<div class="margen text-xs-center">
<div class="container">
<?php the_content(); ?>
</div>
</div>
<?php endwhile; ?>

<?php mostrar_banner('inicio'); ?>
<?php mostrar_banner('rotator-inicio'); ?>

<div class="margen text-xs-center">
	<div class="container">
		<h4>Tenés alguna consulta?</h4>
		<br>
		<?php echo do_shortcode('[contact-form-7 id="217" title="contacto"]'); ?>
	</div>
</div>