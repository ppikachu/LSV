<div class="margen text-xs-center">
<div class="container">
<?php the_content(); ?>
</div>

<?php if (is_page('agenda-de-actividades')) mostrar_banner('agenda'); ?>

<div class="margen text-xs-center">
<div class="container">
<?php echo types_render_field("bloque"); ?>
</div>
</div>
<!-- // content-single -->