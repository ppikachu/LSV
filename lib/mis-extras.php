<?php

function remove_dashboard_meta() {
		//remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		//remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		//remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		//remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		//remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		//remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
}
add_action( 'admin_init', 'remove_dashboard_meta' );

define('GOOGLE_FONTS', 'Raleway:300,400,500,700');
function load_google_fonts() {			
	if( ! defined( 'GOOGLE_FONTS' ) ) return;	
	echo '<link href="http://fonts.googleapis.com/css?family=' . GOOGLE_FONTS . '" rel="stylesheet" type="text/css" />'."\n";

}

add_action( 'wp_head', 'load_google_fonts' , 1);

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Usage: get_id_by_slug('any-page-slug');
function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}

// Displays comma separated taxonomy terms
function entry_terms() {
	$terms = get_the_terms( $post->ID , 'zona' );
	//print_r($terms);
	if ( ! empty( $terms ) ) {
		echo '<p class="small entry-meta"><span class="entry-terms">';
			foreach ( $terms as $term ) {
				$entry_terms .= $term->name . ' / ';
			}
			$entry_terms = rtrim( $entry_terms, ' / ' );
		echo $entry_terms . '</span></p>';
	}
}


// List terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)
function data_lugar($parametro) {
	global $post;
	$term_list = wp_get_post_terms($post->ID, $parametro, array('orderby' => 'group'));
	//print_r($term_list);
	if ( ! empty( $term_list ) ) {
			foreach ( $term_list as $term ) {
				$entry_terms .= $term->slug . ' ';
			}
			$entry_terms = rtrim( $entry_terms, ' ' );
		echo $entry_terms;
	}
}

function entry_termsB() {
	global $post;
	$term_list = wp_get_post_terms($post->ID, 'zona', array('orderby' => 'group'));
	//print_r($term_list);
	if ( ! empty( $term_list ) ) {
		echo '<p class="small entry-meta"><span class="entry-terms">';
			foreach ( $term_list as $term ) {
				$entry_terms .= $term->name . ' / ';
			}
			$entry_terms = rtrim( $entry_terms, ' / ' );
		echo $entry_terms . '</span></p>';
	}
}


function tax_terms() {
	$taxName = "zona";
	$terms = get_terms($taxName,array('parent' => 0,'orderby' => 'name'));
	foreach($terms as $term) {
		echo '<button class="btn btn-sm btn-outline-primary" data-zona=".zona-'.$term->slug.'" data-toggle="collapse" data-parent="#filters" data-target="#sub-'.$term->slug.'" aria-expanded="false" aria-controls="sub-'.$term->slug.'" >'.$term->name.'</button> ';
		echo '<span class="panel-collapse collapse" id="sub-'.$term->slug.'" role="tabpanel">';
		$term_children = get_terms($taxName, array( 'parent' => $term->term_id,'hierarchical'=>false ));
			foreach($term_children as $term_child_id) {
				$term_grandchildren = get_terms($taxName, array( 'parent' => $term_child_id->term_id ));
				//if ($term_grandchildren) echo '<div id="grand">';
				echo '<button class="hijo btn btn-sm btn-outline-primary" data-zona=".zona-'.$term_child_id->slug.'" data-toggle="collapse" data-parent="#sub0-'.$term->slug.'" data-target="#grand-'.$term_child_id->slug.'" aria-expanded="false" aria-controls="grand-'.$term_child_id->slug.'">'.$term_child_id->name.'</button> ';
				if ($term_grandchildren) {
					echo '<span class="panel-collapse collapse" id="grand-'.$term_child_id->slug.'" role="tabpanel">';
					foreach($term_grandchildren as $term_grandchild) {
						echo '<button class="btn btn-sm btn-outline-cyan" data-zona=".zona-'.$term_grandchild->slug.'">'.$term_grandchild->name.'</button> ';
					}
					echo '</span>';
				}
				//if ($term_grandchildren) echo '</div>';
			}
		echo '</span>';
	}
}

function tax_termsB() {
	$taxName = "zona";
	$terms = get_terms($taxName,array('parent' => 0,'orderby' => 'name'));
	echo '<ul class="btn-group-zonas" data-filter-group="zona">';
	echo '<li><button id="btn-todos" class="btn btn-sm btn-outline-primary check zona toggle" data-filter="*">Todos</button></li>';
	foreach($terms as $term) {
		echo '<li>';
		echo '<button class="zona btn btn-sm btn-outline-primary toggle" data-filter=".zona-'.$term->slug.'" >'.$term->name.'</button> ';
		$term_children = get_terms($taxName, array( 'parent' => $term->term_id,'hierarchical'=>false,'hide_empty' => true ));
		if ($term_children) echo '<ul class="inner" id="sub-'.$term->slug.'" >';
			foreach($term_children as $term_child_id) {
				$term_grandchildren = get_terms($taxName, array( 'parent' => $term_child_id->term_id,'hide_empty' => true ));
				if ($term_grandchildren) $toggle= ' toggle'; else $toggle=' toggle';
				echo '<li>';
				echo '<button class="hijo btn btn-sm btn-outline-primary'.$toggle.'" data-filter=".zona-'.$term_child_id->slug.'" >'.$term_child_id->name.'</button> ';
				if ($term_grandchildren) {
					echo '<ul class="grand-ul inner" id="grand-'.$term_child_id->slug.'">';
					foreach($term_grandchildren as $term_grandchild) {
						echo '<li><button class="grand btn btn-sm btn-outline-cyan" data-filter=".zona-'.$term_grandchild->slug.'">'.$term_grandchild->name.'</button></li>';
					}
					echo '</ul>';
				}
				echo '</li>';
			}
		if ($term_children) echo '</ul>';
		echo '</li>';
	}
	echo '</ul>';
}

function poster( $media_id ) {
	$poster = wp_get_attachment_image_src( $media_id, 'large' , false );
	return $poster[0];
}

function poster_bg( $size="large",$post_id="post") {
	global $post;
	if ("post" === $post_id) $post_id = $post->ID;
	$poster = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size , false );
	if ($poster) echo 'style="background-image:url('.$poster[0].'); background-size:cover; background-position:center;"';
	//else echo 'style="background-image:url('.get_template_directory_uri().'/dist/images/foto.svg); background-size:cover; background-position:center;"';
}

function mostrar_banner($slug) {
 $args = array('post_type' => 'modulos-banner','name'=>$slug);
	// The Query
	$the_query = new WP_Query( $args );
	// The Loop
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$child_posts = types_child_posts('banner');
			$i_banners = count($child_posts);

			if ($i_banners==1) {
					foreach ($child_posts as $child_post) {
							$imagen_html = types_render_field( "banner_imagen", array( "post_id"=>$child_post->ID ));
						if ($child_post->fields['has_boton']==1) {
							$link_banner = types_render_field( "banner-url", array( "post_id"=>$child_post->ID,"raw"=>"true" ));
							$texto_boton = $child_post->fields['texto-boton'];
							$color_boton = $child_post->fields['color-boton'];
						}
						echo '<div class="banner_uno">';
						echo $imagen_html;
						if ($child_post->fields['has_boton']==1) echo '<div class="zona_boton flex-items-sm-right"><div class="col-md-4 flex-sm-middle"><a class="btn btn-'.$color_boton.'" href="'.$link_banner.'" >'.$texto_boton.' <i class="fa fa-angle-right"></i></a></div></div>';
						echo '</div>';
					}
			} else { // mas de un banner / carousel
					$i = 1;
					$active = ' active';
					$indicators = '<ol class="carousel-indicators">';
					$precarousel = '';

					foreach ($child_posts as $child_post) {
						$imagen_html = types_render_field( "banner_imagen", array( "post_id"=>$child_post->ID ));
						$link_banner = types_render_field( "banner-url", array( "post_id"=>$child_post->ID,"raw"=>"true" ));
						if ($i > 1) $active = '';
						if ($child_post->fields['has_boton']==1) {
							$texto_boton = $child_post->fields['texto-boton'];
							$color_boton = $child_post->fields['color-boton'];
						}
						if (types_render_field(indicator)==1) $indicators .= '<li data-target="#carousel-banner-'.$slug.'" data-slide-to="'.($i-1).'" class="'.$active.'"></li>';
						$precarousel .= '<div class="carousel-item banner_dos'.$active.'">';
						if ($child_post->fields['tipo-link']==2) $precarousel .= '<a target="_blank" href="'.$link_banner.'">';
						$precarousel .= $imagen_html;
						if ($child_post->fields['tipo-link']) $precarousel .= '</a>';
						if ($child_post->fields['has_boton']==1&&$child_post->fields['tipo-link']==1) $precarousel .= '<div class="zona_boton row flex-items-xs-right flex-items-xs-middle"><div class="col-xs-5 col-sm-4"><a class="btn btn-'.$color_boton.'" href="'.$link_banner.'" >'.$texto_boton.' <i class="fa fa-angle-right"></i></a></div></div>';
						$precarousel .=  '</div>';
						$i++;
					}
				
				$indicators .= '</ol>';
				$carousel = '<div id="carousel-banner-'.$slug.'" class="carousel slide" data-ride="carousel"><div class="carousel-inner" role="listbox">'.$indicators.$precarousel.'</div><a class="left carousel-control" href="#carousel-banner-'.$slug.'" role="button" data-slide="prev"><span class="icon-prev" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel-banner-'.$slug.'" role="button" data-slide="next"><span class="icon-next" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>';
				
				echo $carousel;

			}
		}
	/* Restore original Post Data */ wp_reset_postdata();
}

function hex2rgb($hexColor) {
	$shorthand = (strlen($hexColor) == 4);
	list($r, $g, $b) = $shorthand? sscanf($hexColor, "#%1s%1s%1s") : sscanf($hexColor, "#%2s%2s%2s");
	return [
		"r" => hexdec($shorthand? "$r$r" : $r),
		"g" => hexdec($shorthand? "$g$g" : $g),
		"b" => hexdec($shorthand? "$b$b" : $b)
	];
}

// admin only!
// sanitize any special characters in your image files
//

function sanitize_filename_on_upload($filename) {
$ext = end(explode('.',$filename));
// Replace all weird characters
$sanitized = preg_replace('/[^a-zA-Z0-9-_.]/','', substr($filename, 0, -(strlen($ext)+1)));
// Replace dots inside filename
$sanitized = str_replace('.','-', $sanitized);
return strtolower($sanitized.'.'.$ext);
}
add_filter('sanitize_file_name', 'sanitize_filename_on_upload', 10);
//