<?php
if ( ! defined( 'ABSPATH' ) ) exit;

//Redirection du single vers l'archive pour certains événements
function kasutan_event_maybe_redirect() {
	if(is_single() && get_post_type()==="programmation") {
		if(function_exists('get_field') && "non"===esc_attr(get_field('avec_single'))) {
			$url=esc_url(get_field('ohm_page_agenda','option'));
			if($url) {
				wp_safe_redirect( $url );
				exit;
			}
					
		}
	}
}

function kasutan_event_get_meta($post_id) {
	if(!function_exists('get_field')) {
		return false;
	}
	$keys=array('date','heure','prix','avec_single','description','artistes');
	$jours=array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
	$metas=array();
	foreach($keys as $key) {
		$metas[$key]=wp_kses_post(get_field($key,$post_id));
	}

	if(isset($metas['date'])) {
		$timestamp=strtotime($metas['date']);
		$date=intval($metas['date']);
		$today=intval(date('Ymd'));
		if($date===$today) {
			$metas['date_texte']="Aujourd&rsquo;hui";
		} else if($date===$today+1) {
			$metas['date_texte']="Demain";
		} else {
			$jour=$jours[date('w',$timestamp)];
			$metas['date_texte']=$jour.' '.date('d.m.Y',$timestamp);		
		}

	}
	return $metas;
}

function kasutan_event_affiche_meta_single($post_id) {
	$metas=kasutan_event_get_meta($post_id);
	if(!$metas) {
		return;
	}
	echo '<ul class="meta">';
		if(isset($metas['artistes'])) {
			printf('<li class="artistes">%s</li>',$metas['artistes']);
		}

		if(isset($metas['date_texte'])) {
			printf('<li class="date">%s',$metas['date_texte']);
				if(isset($metas['heure'])) printf(' - <span class="heure">%s</span>',$metas['heure']);
			echo '</li>';
		}
		
		if(isset($metas['prix'])) {
			printf('<li class="prix">%s</li>',$metas['prix']);
		}

		if(isset($metas['description'])) {
			printf('<li class="description">%s</li>',$metas['description']);
		}

	echo '</ul>';
}

function kasutan_event_affiche_ligne($post_id) {
	$nom=get_the_title($post_id);
	$fonction=$tel=$mobile=$email=false;

	if(function_exists('get_field')) {
		$fonction=wp_kses_post(get_field('fonction',$post_id));
		$tel=wp_kses_post(get_field('tel',$post_id));
		$mobile=wp_kses_post(get_field('mobile',$post_id));
		$email=wp_kses_post(get_field('email',$post_id));
	}
	echo '<li class="personne">';
		printf('<div class="image">%s</div>',get_the_post_thumbnail( $post_id, 'thumbnail'));
		echo '<div class="texte">';
			printf('<h3 class="nom has-vert-color">%s</h3>',$nom);
			if($fonction) printf('<p class="fonction">%s</p>',$fonction);
			if($tel) printf('<a class="tel" href="tel:%s">Tél.&nbsp;: %s</a>',$tel,$tel);
			if($mobile) printf('<a class="mobile" href="tel:%s">Mobile.&nbsp;: %s</a>',$mobile,$mobile);
			if($email) printf('<a class="email" href="mailto:%s">Mail&nbsp;: %s</a>',antispambot($email),antispambot($email));
			
		echo '</div>';
	echo '</li>';
}


/******************Colonnes dans l'admin *****************/
add_filter( 'manage_programmation_posts_columns', 'kasutan_set_custom_edit_programmation_columns' );

function kasutan_set_custom_edit_programmation_columns( $columns ) {

$columns['artistes'] = 'Artistes';
$columns['date_event'] = 'Date event';
$columns['heure'] = 'Heure';
$columns['prix'] = 'Prix';
$columns['date'] =  'Date publication';
$columns['avec_single'] =  'Page single ?';

return $columns;
}

add_action( 'manage_programmation_posts_custom_column' , 'kasutan_custom_programmation_column', 10, 2 );

function kasutan_custom_programmation_column( $column, $post_id ) {
	if(!function_exists('get_field')) {
		echo '';
	}
switch ( $column ) {

	// display the value of an ACF (Advanced Custom Fields) field
	case 'date_event' :
		$date=esc_attr(get_field('date',$post_id));
		$date_affichage=date("d.m.Y",strtotime($date));
		echo $date_affichage;

		break;
	
	case 'heure' :
		echo esc_html(get_field( 'heure', $post_id ));
		break;
	case 'prix' :
		echo esc_html(get_field( 'prix', $post_id ));
		break;

	case 'artistes' :
		echo esc_html(get_field( 'artistes', $post_id ));
		break;

	case 'avec_single' :
		$avec_single=esc_html(get_field( 'avec_single', $post_id ));
		if($avec_single==='oui') {
			printf('<a href="%s" target="_blank">oui</a>',get_the_permalink( $post_id ));
		} else {
			echo 'non';
		}
		break;

	default:
		break;
}
}