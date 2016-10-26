<div class="container">
	<div class="row flex-items-xs-center">
		<div class="col-xs-4 col-sm-3"><img class="img-fluid" src="<?php echo get_template_directory_uri().'/dist/images/banner_vino_argentino.png' ?>" ></div>
	</div>
    <div class="row flex-items-xs-center">
        <div class="col-xs-4 col-sm-3"><img class="img-fluid" src="<?php echo get_template_directory_uri().'/dist/images/banner_vino_bebida_nac.png' ?>" ></div>
		<div class="col-xs-4 col-sm-3"><img class="img-fluid" src="<?php echo get_template_directory_uri().'/dist/images/banner_wine_moderation.png' ?>" ></div>
		<div class="col-xs-4 col-sm-3"><img class="img-fluid" src="<?php echo get_template_directory_uri().'/dist/images/banner_ba.png' ?>" ></div>
	</div>
</div>

<footer class="content-info bg-inverse margen">
  <div class="container">

    <?php dynamic_sidebar('sidebar-footer'); ?>

    <div class="row flex-items-xs-middle flex-items-xs-center text-xs-center text-md-left">
    	<div class="col-xs-4 col-md-2">
    		<img class="img-fluid" src="<?php echo get_template_directory_uri().'/dist/images/logo.png' ?>" >
    	</div>
    	<div class="col-md-8 font-weight-bold">
    		<p><span class="color-secondary">Todas las actividades son exclusivamente para mayores de 18 años</span><br>
			BEBER CON MODERACION. PROHIBIDA SU VENTA A MENORES DE 18 AÑOS.</p>
            <p>#SemanaDelVino<br>
            seguinos&nbsp;&nbsp;</span>
            <a target="_blank" href="<?php echo of_get_option('facebook_url');?>"><span class="fa-stack"><i class="fa fa-circle fa-inverse fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x color-negro" aria-hidden="true"></i></span></a>
            <a target="_blank" href="<?php echo of_get_option('twitter_url');?>"><span class="fa-stack"><i class="fa fa-circle fa-inverse fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x color-negro" aria-hidden="true"></i></span></a>
            <a target="_blank" href="<?php echo of_get_option('instagram_url');?>"><span class="fa-stack"><i class="fa fa-circle fa-inverse fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x color-negro" aria-hidden="true"></i></span></a>
            </p>
    	</div>
    </div>
    
  </div>
</footer>
