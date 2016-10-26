<div id="barra_share">
	<div class="container">
		<div class="row">
		<div class="col-xs text-xs-right flex-xs-middle">
    		#SemanaDelVino <span class="hidden-xs-down">| seguinos&nbsp;&nbsp;</span>
            <a target="_blank" href="<?php echo of_get_option('facebook_url');?>"><span class="fa-stack"><i class="fa fa-circle fa-inverse fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x" aria-hidden="true"></i></span></a>
            <a target="_blank" href="<?php echo of_get_option('twitter_url');?>"><span class="fa-stack"><i class="fa fa-circle fa-inverse fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x" aria-hidden="true"></i></span></a>
            <a target="_blank" href="<?php echo of_get_option('instagram_url');?>"><span class="fa-stack"><i class="fa fa-circle fa-inverse fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x" aria-hidden="true"></i></span></a>
		</div>
		</div>
	</div>
</div>

<nav class="navbar navbar-full navbar-dark bg-primary">
	
	<div class="clearfix"><button class="navbar-toggler hidden-md-up color-blanco pull-xs-right" type="button" data-toggle="collapse" data-target="#menu_principal" aria-controls="menu_principal" aria-expanded="false" aria-label="Toggle navigation">&#9776;</button></div>
	
	<div id="mmenu" class="container">
	<a class="navbar-brand" href="/la-gran-celebracion"></a>
	  <div class="collapse navbar-toggleable-sm" id="menu_principal">
	    <?php wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new bs4Navwalker(), 'menu_class' => 'nav navbar-nav pull-xs-right text-xs-right']); ?>
	  </div>
	</div>

</nav>