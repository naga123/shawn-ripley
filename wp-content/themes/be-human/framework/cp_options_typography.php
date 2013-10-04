<?php

	/*	
	*	CrunchPress Options File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
add_action('wp_ajax_typography_settings','typography_settings');
function typography_settings(){
		
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
<?php 
					if(isset($action) AND $action == 'typography_settings'){
						$typography_xml = '<typography_settings>';
						$typography_xml = $typography_xml . create_xml_tag('font_google',$font_google);
						$typography_xml = $typography_xml . create_xml_tag('font_size_normal',$font_size_normal);
						$typography_xml = $typography_xml . create_xml_tag('font_google_heading',$font_google_heading);
						$typography_xml = $typography_xml . create_xml_tag('menu_font_google',$menu_font_google);
						$typography_xml = $typography_xml . create_xml_tag('heading_h1',$heading_h1);
						$typography_xml = $typography_xml . create_xml_tag('heading_h2',$heading_h2);
						$typography_xml = $typography_xml . create_xml_tag('heading_h3',$heading_h3);
						$typography_xml = $typography_xml . create_xml_tag('heading_h4',$heading_h4);
						$typography_xml = $typography_xml . create_xml_tag('heading_h5',$heading_h5);
						$typography_xml = $typography_xml . create_xml_tag('heading_h6',$heading_h6);
						$typography_xml = $typography_xml . create_xml_tag('embed_typekit_code',htmlspecialchars(stripslashes($embed_typekit_code)));
						$typography_xml = $typography_xml . '</typography_settings>';

						
						$font_setting_xml = '<typekit_font>';
						$sidebars = $_POST['typekit_font'];
						foreach($sidebars as $keys=>$values){
							$font_setting_xml = $font_setting_xml . create_xml_tag('typekit_font',$values);
						}
						$font_setting_xml = $font_setting_xml . '</typekit_font>';
						save_option('typokit_settings', get_option('typokit_settings'), $font_setting_xml);
						
						
						if(!save_option('typography_settings', get_option('typography_settings'), $typography_xml)){
						
							die( json_encode($return_data) );
							
						}
						
						die(json_encode( array('success'=>'0') ) );
						
					}
		$font_google = '';
		$font_size_normal = '';
		$menu_font_google = '';
		$fonts_array = '';
		$font_google_heading = '';
		$heading_h1 = '';
		$heading_h2 = '';
		$heading_h3 = '';
		$heading_h4 = '';
		$heading_h5 = '';
		$heading_h6 = '';
		$embed_typekit_code = '';
		$cp_typography_settings = get_option('typography_settings');
		
		//$dd = find_xml_node($logo_uploa_d,'logo_upload');
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			$font_google = find_xml_value($cp_typo->documentElement,'font_google');
			$font_size_normal = find_xml_value($cp_typo->documentElement,'font_size_normal');
			$menu_font_google = find_xml_value($cp_typo->documentElement,'menu_font_google');
			$font_google_heading = find_xml_value($cp_typo->documentElement,'font_google_heading');
			$heading_h1 = find_xml_value($cp_typo->documentElement,'heading_h1');
			$heading_h2 = find_xml_value($cp_typo->documentElement,'heading_h2');
			$heading_h3 = find_xml_value($cp_typo->documentElement,'heading_h3');
			$heading_h4 = find_xml_value($cp_typo->documentElement,'heading_h4');
			$heading_h5 = find_xml_value($cp_typo->documentElement,'heading_h5');
			$heading_h6 = find_xml_value($cp_typo->documentElement,'heading_h6');
			$embed_typekit_code = find_xml_value($cp_typo->documentElement,'embed_typekit_code');
			
		}?>		
<div id="wrapper_backend">
	<div id="header_theme_options">	
		<span id="backend_logo"><h1><a href="#">CrunchPress Framework</a></h1></span>
		<span id="backend_search"><button value="default" id="default_fun">Restore To Default</button></span>
	</div>
	<div class="wrapper_1">
		<?php echo top_navigation_html();?>		
	</div>
	<div class="below_wrapper tabs">
		<div class="wrapper_left">
			<ul id="wp_t_o_right_menu">
				<li><a href="#font_family" class=""><?php _e('Font Family', 'crunchpress'); ?></a></li>
				<li><a href="#font_size" class=""><?php _e('Font Size', 'crunchpress'); ?></a></li>
				<li><a href="#type_kit_font" class=""><?php _e('Type Kit Font', 'crunchpress'); ?></a></li>
			</ul>
		</div>
		<div class="wrapper_right">
			<form id="options-panel-form" name="goodlayer-panel-form">
			<div class="panel-elements" id="panel-elements">
				<div class="panel-element" id="panel-element-save-complete">
					<div class="panel-element-save-text"><?php _e('Save Options Complete', 'crunchpress'); ?>.</div>
					<div class="panel-element-save-arrow"></div>
				</div>
			<ul>
				<li id="font_family" class="typography_class">
						<h3>Font Family Settings</h3>
						<?php $fonts_array = get_font_array();?>
						<ul class="recipe_class">
							<li class="panel-title">
								<label for="font_google"><?php _e('FONT FAMILY', 'crunchpress'); ?></label>
							</li>
							<li class="panel-input">	
								<div class="combobox">
									<select class="font_google" name="font_google" id="font_google">
										<option <?php if( $font_google == 'Default' ){ echo 'selected'; }?> value="Default">Theme Default</option>
										<!--<optgroup label="Used font">
										<?php
										$fonts_arr = get_font_array();
										foreach($fonts_arr as $keys=>$values){
											if($values == 'Used font'){ ?>
												<option <?php if( $font_google == esc_html($keys) ){ echo 'selected'; }?>><?php echo $keys; ?></option>
												<?php
											}
										}?>
										</optgroup>-->		
										<div class="clear"></div>
										<!--ADOBE EDGE FONT START -->
										<optgroup label="ADOBE EDGE FONT">
											<option <?php if( $font_google == 'abril-fatface' ){ echo 'selected'; }?> value="abril-fatface">Abril Fatface</option>
											<option <?php if( $font_google == 'acme' ){ echo 'selected'; }?> value="acme">Acme</option>
											<option <?php if( $font_google == 'alegreya_sc' ){ echo 'selected'; }?> value="alegreya-sc">Alegreya SC</option>
											<option <?php if( $font_google == 'alegreya' ){ echo 'selected'; }?> value="alegreya">Alegreya</option>
											<option <?php if( $font_google == 'alexa-std' ){ echo 'selected'; }?> value="alexa-std">Alexa Std</option>
											<option <?php if( $font_google == 'amaranth' ){ echo 'selected'; }?> value="amaranth">Amaranth</option>
											<option <?php if( $font_google == 'andika' ){ echo 'selected'; }?> value="andika">Andika</option>
											<option <?php if( $font_google == 'anonymous-pro' ){ echo 'selected'; }?> value="anonymous-pro">Anonymous Pro</option>
											<option <?php if( $font_google == 'arvo' ){ echo 'selected'; }?> value="arvo">Arvo</option>
											<option <?php if( $font_google == 'asap' ){ echo 'selected'; }?> value="asap">Asap</option>
											<option <?php if( $font_google == 'berkshire-swash' ){ echo 'selected'; }?> value="berkshire-swash">Berkshire Swash</option>
											<option <?php if( $font_google == 'bree-serif' ){ echo 'selected'; }?> value="bree-serif">Bree Serif</option>
											<option <?php if( $font_google == 'brush-script-std' ){ echo 'selected'; }?> value="brush-script-std">Brush Script Std</option>
											<option <?php if( $font_google == 'chunk' ){ echo 'selected'; }?> value="chunk">Chunk</option>
											<option <?php if( $font_google == 'cousine' ){ echo 'selected'; }?> value="cousine">Cousine</option>
											<option <?php if( $font_google == 'crete-round' ){ echo 'selected'; }?> value="crete-round">Crete Round</option>
											<option <?php if( $font_google == 'droid-sans-mono' ){ echo 'selected'; }?> value="droid-sans-mono">Droid Sans Mono</option>
											<option <?php if( $font_google == 'droid-sans' ){ echo 'selected'; }?> value="droid-sans">Droid Sans</option>
											<option <?php if( $font_google == 'droid-serif' ){ echo 'selected'; }?> value="droid-serif">Droid Serif</option>
											<option <?php if( $font_google == 'ewert' ){ echo 'selected'; }?> value="ewert">Ewert</option>
											<option <?php if( $font_google == 'fusaka-std' ){ echo 'selected'; }?> value="fusaka-std">Fusaka Std</option>
											<option <?php if( $font_google == 'gentium-basic' ){ echo 'selected'; }?> value="gentium-basic">Gentium Basic</option>
											<option <?php if( $font_google == 'gentium-book-basic' ){ echo 'selected'; }?> value="gentium-book-basic">Gentium Book Basic</option>
											<option <?php if( $font_google == 'giddyup-std' ){ echo 'selected'; }?> value="giddyup-std">Giddyup Std</option>
											<option <?php if( $font_google == 'gravitas-one' ){ echo 'selected'; }?> value="gravitas-one">Gravitas One</option>
											<option <?php if( $font_google == 'hobo-std' ){ echo 'selected'; }?> value="hobo-std">Hobo Std</option>
											<option <?php if( $font_google == 'holtwood-one-sc' ){ echo 'selected'; }?> value="holtwood-one-sc">Holtwood One SC</option>
											<option <?php if( $font_google == 'imprima' ){ echo 'selected'; }?> value="imprima">Imprima</option>
											<option <?php if( $font_google == 'inconsolata' ){ echo 'selected'; }?> value="inconsolata">Inconsolata</option>
											<option <?php if( $font_google == 'inika' ){ echo 'selected'; }?> value="inika">Inika</option>
											<option <?php if( $font_google == 'istok-web' ){ echo 'selected'; }?> value="istok-web">Istok Web</option>
											<option <?php if( $font_google == 'jim-nightshade' ){ echo 'selected'; }?> value="jim-nightshade">Jim Nightshade</option>
											<option <?php if( $font_google == 'josefin-slab' ){ echo 'selected'; }?> value="josefin-slab">Josefin Slab</option>
											<option <?php if( $font_google == 'kameron' ){ echo 'selected'; }?> value="kameron">Kameron</option>
											<option <?php if( $font_google == 'kaushan-script' ){ echo 'selected'; }?> value="kaushan-script">Kaushan Script</option>
											<option <?php if( $font_google == 'kotta-one' ){ echo 'selected'; }?> value="kotta-one">Kotta One</option>
											<option <?php if( $font_google == 'krona-one' ){ echo 'selected'; }?> value="krona-one">Krona One</option>
											<option <?php if( $font_google == 'la-belle-aurore' ){ echo 'selected'; }?> value="la-belle-aurore">La Belle Aurore</option>
											<option <?php if( $font_google == 'lato' ){ echo 'selected'; }?> value="lato">Lato</option>
											<option <?php if( $font_google == 'league-gothic' ){ echo 'selected'; }?> value="league-gothic">League Gothic</option>
											<option <?php if( $font_google == 'lekton' ){ echo 'selected'; }?> value="lekton">Lekton</option>
											<option <?php if( $font_google == 'linden-hill' ){ echo 'selected'; }?> value="linden-hill">Linden Hill</option>
											<option <?php if( $font_google == 'lobster-two' ){ echo 'selected'; }?> value="lobster-two">Lobster Two</option>
											<option <?php if( $font_google == 'lobster' ){ echo 'selected'; }?> value="lobster">Lobster</option>
											<option <?php if( $font_google == 'lusitana' ){ echo 'selected'; }?> value="lusitana">Lusitana</option>
											<option <?php if( $font_google == 'm-1c' ){ echo 'selected'; }?> value="m-1c">M+ 1c</option>
											<option <?php if( $font_google == 'm-1m' ){ echo 'selected'; }?> value="m-1m">M+ 1m</option>
											<option <?php if( $font_google == 'marck-script' ){ echo 'selected'; }?> value="marck-script">Marck Script</option>
											<option <?php if( $font_google == 'marvel' ){ echo 'selected'; }?> value="marvel">Marvel</option>
											<option <?php if( $font_google == 'maven-pro' ){ echo 'selected'; }?> value="maven-pro">Maven Pro</option>
											<option <?php if( $font_google == 'merienda-one' ){ echo 'selected'; }?> value="merienda-one">Merienda One</option>
											<option <?php if( $font_google == 'merriweather' ){ echo 'selected'; }?> value="merriweather">Merriweather</option>
											<option <?php if( $font_google == 'mr-bedfort' ){ echo 'selected'; }?> value="mr-bedfort">Mr Bedfort</option>
											<option <?php if( $font_google == 'mr-de-haviland' ){ echo 'selected'; }?> value="mr-de-haviland">Mr De Haviland</option>
											<option <?php if( $font_google == 'mrs-saint-delafield' ){ echo 'selected'; }?> value="mrs-saint-delafield">Mrs Saint Delafield</option>
											<option <?php if( $font_google == 'muli' ){ echo 'selected'; }?> value="muli">Muli</option>
											<option <?php if( $font_google == 'neuton-cursive' ){ echo 'selected'; }?> value="neuton-cursive">Neuton Cursive</option>
											<option <?php if( $font_google == 'neuton' ){ echo 'selected'; }?> value="neuton">Neuton</option>
											<option <?php if( $font_google == 'noticia-text' ){ echo 'selected'; }?> value="noticia-text">Noticia Text</option>
											<option <?php if( $font_google == 'open-sans-condensed' ){ echo 'selected'; }?> value="open-sans-condensed">Open Sans Condensed</option>
											<option <?php if( $font_google == 'open-sans' ){ echo 'selected'; }?> value="open-sans">Open Sans</option>
											<option <?php if( $font_google == 'overlock-sc' ){ echo 'selected'; }?> value="overlock-sc">Overlock SC</option>
											<option <?php if( $font_google == 'overlock' ){ echo 'selected'; }?> value="overlock">Overlock</option>
											<option <?php if( $font_google == 'parisienne' ){ echo 'selected'; }?> value="parisienne">Parisienne</option>
											<option <?php if( $font_google == 'passion-one' ){ echo 'selected'; }?> value="passion-one">Passion One</option>
											<option <?php if( $font_google == 'patua-one' ){ echo 'selected'; }?> value="patua-one">Patua One</option>
											<option <?php if( $font_google == 'petrona' ){ echo 'selected'; }?> value="petrona">Petrona</option>
											<option <?php if( $font_google == 'pinyon-script' ){ echo 'selected'; }?> value="pinyon-script">Pinyon Script</option>
											<option <?php if( $font_google == 'playball' ){ echo 'selected'; }?> value="playball">Playball</option>
											<option <?php if( $font_google == 'playfair-display' ){ echo 'selected'; }?> value="playfair-display">Playfair Display</option>
											<option <?php if( $font_google == 'poiret-one' ){ echo 'selected'; }?> value="poiret-one">Poiret One</option>
											<option <?php if( $font_google == 'prata' ){ echo 'selected'; }?> value="prata">Prata</option>
											<option <?php if( $font_google == 'pt-sans-caption' ){ echo 'selected'; }?> value="pt-sans-caption">PT Sans Caption</option>
											<option <?php if( $font_google == 'pt-sans-narrow' ){ echo 'selected'; }?> value="pt-sans-narrow">PT Sans Narrow</option>
											<option <?php if( $font_google == 'pt-sans' ){ echo 'selected'; }?> value="pt-sans">PT Sans</option>
											<option <?php if( $font_google == 'pt-serif-caption' ){ echo 'selected'; }?> value="pt-serif-caption">PT Serif Caption</option>
											<option <?php if( $font_google == 'pt-serif' ){ echo 'selected'; }?> value="pt-serif">PT Serif</option>
											<option <?php if( $font_google == 'quantico' ){ echo 'selected'; }?> value="quantico">Quantico</option>
											<option <?php if( $font_google == 'quattrocento-sans' ){ echo 'selected'; }?> value="quattrocento-sans">Quattrocento Sans</option>
											<option <?php if( $font_google == 'questrial' ){ echo 'selected'; }?> value="questrial">Questrial</option>
											<option <?php if( $font_google == 'quicksand' ){ echo 'selected'; }?> value="quicksand">Quicksand</option>
											<option <?php if( $font_google == 'qwigley' ){ echo 'selected'; }?> value="qwigley">Qwigley</option>
											<option <?php if( $font_google == 'radley' ){ echo 'selected'; }?> value="radley">Radley</option>
											<option <?php if( $font_google == 'rochester' ){ echo 'selected'; }?> value="rochester">Rochester</option>
											<option <?php if( $font_google == 'ropa-sans' ){ echo 'selected'; }?> value="ropa-sans">Ropa Sans</option>
											<option <?php if( $font_google == 'rosario' ){ echo 'selected'; }?> value="rosario">Rosario</option>
											<option <?php if( $font_google == 'ruda' ){ echo 'selected'; }?> value="ruda">Ruda</option>
											<option <?php if( $font_google == 'sail' ){ echo 'selected'; }?> value="sail">Sail</option>
											<option <?php if( $font_google == 'ansita-one' ){ echo 'selected'; }?> value="sansita-one">Sansita One</option>
											<option <?php if( $font_google == 'sanvito-pro-display' ){ echo 'selected'; }?> value="sanvito-pro-display">Sanvito Pro Display</option>
											<option <?php if( $font_google == 'sarina' ){ echo 'selected'; }?> value="sarina">Sarina</option>
											<option <?php if( $font_google == 'satisfy' ){ echo 'selected'; }?> value="satisfy">Satisfy</option>
											<option <?php if( $font_google == 'seaweed-script' ){ echo 'selected'; }?> value="seaweed-script">Seaweed Script</option>
											<option <?php if( $font_google == 'share-regular' ){ echo 'selected'; }?> value="share-regular">Share Regular</option>
											<option <?php if( $font_google == 'shuriken-std' ){ echo 'selected'; }?> value="shuriken-std">Shuriken Std</option>
											<option <?php if( $font_google == 'sigmar-one' ){ echo 'selected'; }?> value="sigmar-one">Sigmar One</option>
											<option <?php if( $font_google == 'sofia' ){ echo 'selected'; }?> value="sofia">Sofia</option>
											<option <?php if( $font_google == 'source-code-pro' ){ echo 'selected'; }?> value="source-code-pro">Source Code Pro</option>
											<option <?php if( $font_google == 'source-sans-pro' ){ echo 'selected'; }?> value="source-sans-pro">Source Sans Pro</option>
											<option <?php if( $font_google == 'strumpf-std' ){ echo 'selected'; }?> value="strumpf-std">Strumpf Std</option>
											<option <?php if( $font_google == 'syncopate' ){ echo 'selected'; }?> value="syncopate">Syncopate</option>
											<option <?php if( $font_google == 'titan-one' ){ echo 'selected'; }?> value="titan-one">Titan One</option>
											<option <?php if( $font_google == 'ubuntu-condensed' ){ echo 'selected'; }?> value="ubuntu-condensed">Ubuntu Condensed</option>
											<option <?php if( $font_google == 'ultra' ){ echo 'selected'; }?> value="ultra">Ultra</option>
											<option <?php if( $font_google == 'unifrakturcook' ){ echo 'selected'; }?> value="unifrakturcook">UnifrakturCook</option>
											<option <?php if( $font_google == 'vera-sans' ){ echo 'selected'; }?> value="vera-sans">Vera Sans</option>
											<option <?php if( $font_google == 'vidaloka' ){ echo 'selected'; }?> value="vidaloka">Vidaloka</option>
											<option <?php if( $font_google == 'Volkhov' ){ echo 'selected'; }?> value="volkhov">Volkhov</option>
											<option <?php if( $font_google == 'yellowtail' ){ echo 'selected'; }?> value="yellowtail">Yellowtail</option>							
										</optgroup>
										
										<!--GOOGLE Font Start -->
										<optgroup label="GOOGLE FONT">
										<?php 
										foreach($fonts_array as $font_key =>$font_value){ 
											if($font_value == 'Google Font'){ ?>
												<option <?php if( $font_google == esc_html($font_key) ){ echo 'selected'; }?>><?php echo $font_key; ?></option>
											<?php
											}
										}	
										?>
										</optgroup>		
										<!--Typekit Font Start -->
										<optgroup label="Typekit font">
										<?php
										$fonts_arr = get_font_array();
										foreach($fonts_arr as $keys=>$values){
											if($values == 'Used font'){ ?>
												<option <?php if( $font_google == esc_html($keys) ){ echo 'selected'; }?>><?php echo $keys; ?></option>
												<?php
											}
										}?>
										</optgroup>							
									</select>
								</div>
							</li>
							<li class="description"><span class="option-font-sample" id="option-font-sample">FONT FAMILY</span><br /><br /><div class="clear"></div>Please Select font family from dropdown for website body text.</li>
						</ul>
						<div class="clear"></div>
						<ul class="recipe_class">
							<li class="panel-title">
								<label for="font_google_heading"><?php _e('FONT FAMILY HEADINGS', 'crunchpress'); ?></label>
							</li>
							<li class="panel-input">	
								<div class="combobox">
									<select class="font_google" name="font_google_heading" id="font_google_heading">
										<option <?php if( $font_google_heading == 'Default' ){ echo 'selected'; }?> value="Default">Theme Default</option>
										<!--ADOBE EDGE FONT START -->
										<optgroup label="ADOBE EDGE FONT">
											
											<option <?php if( $font_google_heading == 'abril-fatface' ){ echo 'selected'; }?> value="abril-fatface">Abril Fatface</option>
											<option <?php if( $font_google_heading == 'acme' ){ echo 'selected'; }?> value="acme">Acme</option>
											<option <?php if( $font_google_heading == 'alegreya_sc' ){ echo 'selected'; }?> value="alegreya-sc">Alegreya SC</option>
											<option <?php if( $font_google_heading == 'alegreya' ){ echo 'selected'; }?> value="alegreya">Alegreya</option>
											<option <?php if( $font_google_heading == 'alexa-std' ){ echo 'selected'; }?> value="alexa-std">Alexa Std</option>
											<option <?php if( $font_google_heading == 'amaranth' ){ echo 'selected'; }?> value="amaranth">Amaranth</option>
											<option <?php if( $font_google_heading == 'andika' ){ echo 'selected'; }?> value="andika">Andika</option>
											<option <?php if( $font_google_heading == 'anonymous-pro' ){ echo 'selected'; }?> value="anonymous-pro">Anonymous Pro</option>
											<option <?php if( $font_google_heading == 'arvo' ){ echo 'selected'; }?> value="arvo">Arvo</option>
											<option <?php if( $font_google_heading == 'asap' ){ echo 'selected'; }?> value="asap">Asap</option>
											<option <?php if( $font_google_heading == 'berkshire-swash' ){ echo 'selected'; }?> value="berkshire-swash">Berkshire Swash</option>
											<option <?php if( $font_google_heading == 'bree-serif' ){ echo 'selected'; }?> value="bree-serif">Bree Serif</option>
											<option <?php if( $font_google_heading == 'brush-script-std' ){ echo 'selected'; }?> value="brush-script-std">Brush Script Std</option>
											<option <?php if( $font_google_heading == 'chunk' ){ echo 'selected'; }?> value="chunk">Chunk</option>
											<option <?php if( $font_google_heading == 'cousine' ){ echo 'selected'; }?> value="cousine">Cousine</option>
											<option <?php if( $font_google_heading == 'crete-round' ){ echo 'selected'; }?> value="crete-round">Crete Round</option>
											<option <?php if( $font_google_heading == 'droid-sans-mono' ){ echo 'selected'; }?> value="droid-sans-mono">Droid Sans Mono</option>
											<option <?php if( $font_google_heading == 'droid-sans' ){ echo 'selected'; }?> value="droid-sans">Droid Sans</option>
											<option <?php if( $font_google_heading == 'droid-serif' ){ echo 'selected'; }?> value="droid-serif">Droid Serif</option>
											<option <?php if( $font_google_heading == 'ewert' ){ echo 'selected'; }?> value="ewert">Ewert</option>
											<option <?php if( $font_google_heading == 'fusaka-std' ){ echo 'selected'; }?> value="fusaka-std">Fusaka Std</option>
											<option <?php if( $font_google_heading == 'gentium-basic' ){ echo 'selected'; }?> value="gentium-basic">Gentium Basic</option>
											<option <?php if( $font_google_heading == 'gentium-book-basic' ){ echo 'selected'; }?> value="gentium-book-basic">Gentium Book Basic</option>
											<option <?php if( $font_google_heading == 'giddyup-std' ){ echo 'selected'; }?> value="giddyup-std">Giddyup Std</option>
											<option <?php if( $font_google_heading == 'gravitas-one' ){ echo 'selected'; }?> value="gravitas-one">Gravitas One</option>
											<option <?php if( $font_google_heading == 'hobo-std' ){ echo 'selected'; }?> value="hobo-std">Hobo Std</option>
											<option <?php if( $font_google_heading == 'holtwood-one-sc' ){ echo 'selected'; }?> value="holtwood-one-sc">Holtwood One SC</option>
											<option <?php if( $font_google_heading == 'imprima' ){ echo 'selected'; }?> value="imprima">Imprima</option>
											<option <?php if( $font_google_heading == 'inconsolata' ){ echo 'selected'; }?> value="inconsolata">Inconsolata</option>
											<option <?php if( $font_google_heading == 'inika' ){ echo 'selected'; }?> value="inika">Inika</option>
											<option <?php if( $font_google_heading == 'istok-web' ){ echo 'selected'; }?> value="istok-web">Istok Web</option>
											<option <?php if( $font_google_heading == 'jim-nightshade' ){ echo 'selected'; }?> value="jim-nightshade">Jim Nightshade</option>
											<option <?php if( $font_google_heading == 'josefin-slab' ){ echo 'selected'; }?> value="josefin-slab">Josefin Slab</option>
											<option <?php if( $font_google_heading == 'kameron' ){ echo 'selected'; }?> value="kameron">Kameron</option>
											<option <?php if( $font_google_heading == 'kaushan-script' ){ echo 'selected'; }?> value="kaushan-script">Kaushan Script</option>
											<option <?php if( $font_google_heading == 'kotta-one' ){ echo 'selected'; }?> value="kotta-one">Kotta One</option>
											<option <?php if( $font_google_heading == 'krona-one' ){ echo 'selected'; }?> value="krona-one">Krona One</option>
											<option <?php if( $font_google_heading == 'la-belle-aurore' ){ echo 'selected'; }?> value="la-belle-aurore">La Belle Aurore</option>
											<option <?php if( $font_google_heading == 'lato' ){ echo 'selected'; }?> value="lato">Lato</option>
											<option <?php if( $font_google_heading == 'league-gothic' ){ echo 'selected'; }?> value="league-gothic">League Gothic</option>
											<option <?php if( $font_google_heading == 'lekton' ){ echo 'selected'; }?> value="lekton">Lekton</option>
											<option <?php if( $font_google_heading == 'linden-hill' ){ echo 'selected'; }?> value="linden-hill">Linden Hill</option>
											<option <?php if( $font_google_heading == 'lobster-two' ){ echo 'selected'; }?> value="lobster-two">Lobster Two</option>
											<option <?php if( $font_google_heading == 'lobster' ){ echo 'selected'; }?> value="lobster">Lobster</option>
											<option <?php if( $font_google_heading == 'lusitana' ){ echo 'selected'; }?> value="lusitana">Lusitana</option>
											<option <?php if( $font_google_heading == 'm-1c' ){ echo 'selected'; }?> value="m-1c">M+ 1c</option>
											<option <?php if( $font_google_heading == 'm-1m' ){ echo 'selected'; }?> value="m-1m">M+ 1m</option>
											<option <?php if( $font_google_heading == 'marck-script' ){ echo 'selected'; }?> value="marck-script">Marck Script</option>
											<option <?php if( $font_google_heading == 'marvel' ){ echo 'selected'; }?> value="marvel">Marvel</option>
											<option <?php if( $font_google_heading == 'maven-pro' ){ echo 'selected'; }?> value="maven-pro">Maven Pro</option>
											<option <?php if( $font_google_heading == 'merienda-one' ){ echo 'selected'; }?> value="merienda-one">Merienda One</option>
											<option <?php if( $font_google_heading == 'merriweather' ){ echo 'selected'; }?> value="merriweather">Merriweather</option>
											<option <?php if( $font_google_heading == 'mr-bedfort' ){ echo 'selected'; }?> value="mr-bedfort">Mr Bedfort</option>
											<option <?php if( $font_google_heading == 'mr-de-haviland' ){ echo 'selected'; }?> value="mr-de-haviland">Mr De Haviland</option>
											<option <?php if( $font_google_heading == 'mrs-saint-delafield' ){ echo 'selected'; }?> value="mrs-saint-delafield">Mrs Saint Delafield</option>
											<option <?php if( $font_google_heading == 'muli' ){ echo 'selected'; }?> value="muli">Muli</option>
											<option <?php if( $font_google_heading == 'neuton-cursive' ){ echo 'selected'; }?> value="neuton-cursive">Neuton Cursive</option>
											<option <?php if( $font_google_heading == 'neuton' ){ echo 'selected'; }?> value="neuton">Neuton</option>
											<option <?php if( $font_google_heading == 'noticia-text' ){ echo 'selected'; }?> value="noticia-text">Noticia Text</option>
											<option <?php if( $font_google_heading == 'open-sans-condensed' ){ echo 'selected'; }?> value="open-sans-condensed">Open Sans Condensed</option>
											<option <?php if( $font_google_heading == 'open-sans' ){ echo 'selected'; }?> value="open-sans">Open Sans</option>
											<option <?php if( $font_google_heading == 'overlock-sc' ){ echo 'selected'; }?> value="overlock-sc">Overlock SC</option>
											<option <?php if( $font_google_heading == 'overlock' ){ echo 'selected'; }?> value="overlock">Overlock</option>
											<option <?php if( $font_google_heading == 'parisienne' ){ echo 'selected'; }?> value="parisienne">Parisienne</option>
											<option <?php if( $font_google_heading == 'passion-one' ){ echo 'selected'; }?> value="passion-one">Passion One</option>
											<option <?php if( $font_google_heading == 'patua-one' ){ echo 'selected'; }?> value="patua-one">Patua One</option>
											<option <?php if( $font_google_heading == 'petrona' ){ echo 'selected'; }?> value="petrona">Petrona</option>
											<option <?php if( $font_google_heading == 'pinyon-script' ){ echo 'selected'; }?> value="pinyon-script">Pinyon Script</option>
											<option <?php if( $font_google_heading == 'playball' ){ echo 'selected'; }?> value="playball">Playball</option>
											<option <?php if( $font_google_heading == 'playfair-display' ){ echo 'selected'; }?> value="playfair-display">Playfair Display</option>
											<option <?php if( $font_google_heading == 'poiret-one' ){ echo 'selected'; }?> value="poiret-one">Poiret One</option>
											<option <?php if( $font_google_heading == 'prata' ){ echo 'selected'; }?> value="prata">Prata</option>
											<option <?php if( $font_google_heading == 'pt-sans-caption' ){ echo 'selected'; }?> value="pt-sans-caption">PT Sans Caption</option>
											<option <?php if( $font_google_heading == 'pt-sans-narrow' ){ echo 'selected'; }?> value="pt-sans-narrow">PT Sans Narrow</option>
											<option <?php if( $font_google_heading == 'pt-sans' ){ echo 'selected'; }?> value="pt-sans">PT Sans</option>
											<option <?php if( $font_google_heading == 'pt-serif-caption' ){ echo 'selected'; }?> value="pt-serif-caption">PT Serif Caption</option>
											<option <?php if( $font_google_heading == 'pt-serif' ){ echo 'selected'; }?> value="pt-serif">PT Serif</option>
											<option <?php if( $font_google_heading == 'quantico' ){ echo 'selected'; }?> value="quantico">Quantico</option>
											<option <?php if( $font_google_heading == 'quattrocento-sans' ){ echo 'selected'; }?> value="quattrocento-sans">Quattrocento Sans</option>
											<option <?php if( $font_google_heading == 'questrial' ){ echo 'selected'; }?> value="questrial">Questrial</option>
											<option <?php if( $font_google_heading == 'quicksand' ){ echo 'selected'; }?> value="quicksand">Quicksand</option>
											<option <?php if( $font_google_heading == 'qwigley' ){ echo 'selected'; }?> value="qwigley">Qwigley</option>
											<option <?php if( $font_google_heading == 'radley' ){ echo 'selected'; }?> value="radley">Radley</option>
											<option <?php if( $font_google_heading == 'rochester' ){ echo 'selected'; }?> value="rochester">Rochester</option>
											<option <?php if( $font_google_heading == 'ropa-sans' ){ echo 'selected'; }?> value="ropa-sans">Ropa Sans</option>
											<option <?php if( $font_google_heading == 'rosario' ){ echo 'selected'; }?> value="rosario">Rosario</option>
											<option <?php if( $font_google_heading == 'ruda' ){ echo 'selected'; }?> value="ruda">Ruda</option>
											<option <?php if( $font_google_heading == 'sail' ){ echo 'selected'; }?> value="sail">Sail</option>
											<option <?php if( $font_google_heading == 'ansita-one' ){ echo 'selected'; }?> value="sansita-one">Sansita One</option>
											<option <?php if( $font_google_heading == 'sanvito-pro-display' ){ echo 'selected'; }?> value="sanvito-pro-display">Sanvito Pro Display</option>
											<option <?php if( $font_google_heading == 'sarina' ){ echo 'selected'; }?> value="sarina">Sarina</option>
											<option <?php if( $font_google_heading == 'satisfy' ){ echo 'selected'; }?> value="satisfy">Satisfy</option>
											<option <?php if( $font_google_heading == 'seaweed-script' ){ echo 'selected'; }?> value="seaweed-script">Seaweed Script</option>
											<option <?php if( $font_google_heading == 'share-regular' ){ echo 'selected'; }?> value="share-regular">Share Regular</option>
											<option <?php if( $font_google_heading == 'shuriken-std' ){ echo 'selected'; }?> value="shuriken-std">Shuriken Std</option>
											<option <?php if( $font_google_heading == 'sigmar-one' ){ echo 'selected'; }?> value="sigmar-one">Sigmar One</option>
											<option <?php if( $font_google_heading == 'sofia' ){ echo 'selected'; }?> value="sofia">Sofia</option>
											<option <?php if( $font_google_heading == 'source-code-pro' ){ echo 'selected'; }?> value="source-code-pro">Source Code Pro</option>
											<option <?php if( $font_google_heading == 'source-sans-pro' ){ echo 'selected'; }?> value="source-sans-pro">Source Sans Pro</option>
											<option <?php if( $font_google_heading == 'strumpf-std' ){ echo 'selected'; }?> value="strumpf-std">Strumpf Std</option>
											<option <?php if( $font_google_heading == 'syncopate' ){ echo 'selected'; }?> value="syncopate">Syncopate</option>
											<option <?php if( $font_google_heading == 'titan-one' ){ echo 'selected'; }?> value="titan-one">Titan One</option>
											<option <?php if( $font_google_heading == 'ubuntu-condensed' ){ echo 'selected'; }?> value="ubuntu-condensed">Ubuntu Condensed</option>
											<option <?php if( $font_google_heading == 'ultra' ){ echo 'selected'; }?> value="ultra">Ultra</option>
											<option <?php if( $font_google_heading == 'unifrakturcook' ){ echo 'selected'; }?> value="unifrakturcook">UnifrakturCook</option>
											<option <?php if( $font_google_heading == 'vera-sans' ){ echo 'selected'; }?> value="vera-sans">Vera Sans</option>
											<option <?php if( $font_google_heading == 'vidaloka' ){ echo 'selected'; }?> value="vidaloka">Vidaloka</option>
											<option <?php if( $font_google_heading == 'Volkhov' ){ echo 'selected'; }?> value="volkhov">Volkhov</option>
											<option <?php if( $font_google_heading == 'yellowtail' ){ echo 'selected'; }?> value="yellowtail">Yellowtail</option>							
										</optgroup>
										
										<!--GOOGLE Font Start -->
										<optgroup label="GOOGLE FONT">
										<?php 
										foreach($fonts_array as $font_key =>$font_value){ 
												if($font_value == 'Google Font'){ ?>
												<option <?php if( $font_google_heading == esc_html($font_key) ){ echo 'selected'; }?>><?php echo $font_key; ?></option>
											<?php
											}
										}	
										?>
										
										<!--Typekit Font Start -->
										<optgroup label="Typekit font">
										<?php
										$fonts_arr = get_font_array();
										foreach($fonts_arr as $keys=>$values){
											if($values == 'Typekit font'){ ?>
												<option <?php if( $font_google_heading == esc_html($keys) ){ echo 'selected'; }?>><?php echo $keys; ?></option>
												<?php
											}
										}?>
										</optgroup>							
									</select>
								</div>
							</li>
							<li class="description"><span class="option-font-sample" id="option-font-sample">FONT FAMILY</span><br /><br /><div class="clear"></div>Please select font family from dropdown for website Headings.</li>
						</ul>
						<ul class="recipe_class">
							<li class="panel-title">
								<label for="menu_font_google"><?php _e('MENU FONT FAMILY', 'crunchpress'); ?></label>
							</li>
							<li class="panel-input">	
								<div class="combobox">
									<select class="font_google" name="menu_font_google" id="menu_font_google">
										<option <?php if( $menu_font_google == 'Default' ){ echo 'selected'; }?> value="Default">Theme Default</option>
										<!--<optgroup label="Used font">
										<?php
										$fonts_arr = get_font_array();
										foreach($fonts_arr as $keys=>$values){
											if($values == 'Used font'){ ?>
												<option <?php if( $menu_font_google == esc_html($keys) ){ echo 'selected'; }?>><?php echo $keys; ?></option>
												<?php
											}
										}?>
										</optgroup>-->		
										<div class="clear"></div>
										<!--ADOBE EDGE FONT START -->
										<optgroup label="ADOBE EDGE FONT">
											<option <?php if( $menu_font_google == 'abril-fatface' ){ echo 'selected'; }?> value="abril-fatface">Abril Fatface</option>
											<option <?php if( $menu_font_google == 'acme' ){ echo 'selected'; }?> value="acme">Acme</option>
											<option <?php if( $menu_font_google == 'alegreya_sc' ){ echo 'selected'; }?> value="alegreya-sc">Alegreya SC</option>
											<option <?php if( $menu_font_google == 'alegreya' ){ echo 'selected'; }?> value="alegreya">Alegreya</option>
											<option <?php if( $menu_font_google == 'alexa-std' ){ echo 'selected'; }?> value="alexa-std">Alexa Std</option>
											<option <?php if( $menu_font_google == 'amaranth' ){ echo 'selected'; }?> value="amaranth">Amaranth</option>
											<option <?php if( $menu_font_google == 'andika' ){ echo 'selected'; }?> value="andika">Andika</option>
											<option <?php if( $menu_font_google == 'anonymous-pro' ){ echo 'selected'; }?> value="anonymous-pro">Anonymous Pro</option>
											<option <?php if( $menu_font_google == 'arvo' ){ echo 'selected'; }?> value="arvo">Arvo</option>
											<option <?php if( $menu_font_google == 'asap' ){ echo 'selected'; }?> value="asap">Asap</option>
											<option <?php if( $menu_font_google == 'berkshire-swash' ){ echo 'selected'; }?> value="berkshire-swash">Berkshire Swash</option>
											<option <?php if( $menu_font_google == 'bree-serif' ){ echo 'selected'; }?> value="bree-serif">Bree Serif</option>
											<option <?php if( $menu_font_google == 'brush-script-std' ){ echo 'selected'; }?> value="brush-script-std">Brush Script Std</option>
											<option <?php if( $menu_font_google == 'chunk' ){ echo 'selected'; }?> value="chunk">Chunk</option>
											<option <?php if( $menu_font_google == 'cousine' ){ echo 'selected'; }?> value="cousine">Cousine</option>
											<option <?php if( $menu_font_google == 'crete-round' ){ echo 'selected'; }?> value="crete-round">Crete Round</option>
											<option <?php if( $menu_font_google == 'droid-sans-mono' ){ echo 'selected'; }?> value="droid-sans-mono">Droid Sans Mono</option>
											<option <?php if( $menu_font_google == 'droid-sans' ){ echo 'selected'; }?> value="droid-sans">Droid Sans</option>
											<option <?php if( $menu_font_google == 'droid-serif' ){ echo 'selected'; }?> value="droid-serif">Droid Serif</option>
											<option <?php if( $menu_font_google == 'ewert' ){ echo 'selected'; }?> value="ewert">Ewert</option>
											<option <?php if( $menu_font_google == 'fusaka-std' ){ echo 'selected'; }?> value="fusaka-std">Fusaka Std</option>
											<option <?php if( $menu_font_google == 'gentium-basic' ){ echo 'selected'; }?> value="gentium-basic">Gentium Basic</option>
											<option <?php if( $menu_font_google == 'gentium-book-basic' ){ echo 'selected'; }?> value="gentium-book-basic">Gentium Book Basic</option>
											<option <?php if( $menu_font_google == 'giddyup-std' ){ echo 'selected'; }?> value="giddyup-std">Giddyup Std</option>
											<option <?php if( $menu_font_google == 'gravitas-one' ){ echo 'selected'; }?> value="gravitas-one">Gravitas One</option>
											<option <?php if( $menu_font_google == 'hobo-std' ){ echo 'selected'; }?> value="hobo-std">Hobo Std</option>
											<option <?php if( $menu_font_google == 'holtwood-one-sc' ){ echo 'selected'; }?> value="holtwood-one-sc">Holtwood One SC</option>
											<option <?php if( $menu_font_google == 'imprima' ){ echo 'selected'; }?> value="imprima">Imprima</option>
											<option <?php if( $menu_font_google == 'inconsolata' ){ echo 'selected'; }?> value="inconsolata">Inconsolata</option>
											<option <?php if( $menu_font_google == 'inika' ){ echo 'selected'; }?> value="inika">Inika</option>
											<option <?php if( $menu_font_google == 'istok-web' ){ echo 'selected'; }?> value="istok-web">Istok Web</option>
											<option <?php if( $menu_font_google == 'jim-nightshade' ){ echo 'selected'; }?> value="jim-nightshade">Jim Nightshade</option>
											<option <?php if( $menu_font_google == 'josefin-slab' ){ echo 'selected'; }?> value="josefin-slab">Josefin Slab</option>
											<option <?php if( $menu_font_google == 'kameron' ){ echo 'selected'; }?> value="kameron">Kameron</option>
											<option <?php if( $menu_font_google == 'kaushan-script' ){ echo 'selected'; }?> value="kaushan-script">Kaushan Script</option>
											<option <?php if( $menu_font_google == 'kotta-one' ){ echo 'selected'; }?> value="kotta-one">Kotta One</option>
											<option <?php if( $menu_font_google == 'krona-one' ){ echo 'selected'; }?> value="krona-one">Krona One</option>
											<option <?php if( $menu_font_google == 'la-belle-aurore' ){ echo 'selected'; }?> value="la-belle-aurore">La Belle Aurore</option>
											<option <?php if( $menu_font_google == 'lato' ){ echo 'selected'; }?> value="lato">Lato</option>
											<option <?php if( $menu_font_google == 'league-gothic' ){ echo 'selected'; }?> value="league-gothic">League Gothic</option>
											<option <?php if( $menu_font_google == 'lekton' ){ echo 'selected'; }?> value="lekton">Lekton</option>
											<option <?php if( $menu_font_google == 'linden-hill' ){ echo 'selected'; }?> value="linden-hill">Linden Hill</option>
											<option <?php if( $menu_font_google == 'lobster-two' ){ echo 'selected'; }?> value="lobster-two">Lobster Two</option>
											<option <?php if( $menu_font_google == 'lobster' ){ echo 'selected'; }?> value="lobster">Lobster</option>
											<option <?php if( $menu_font_google == 'lusitana' ){ echo 'selected'; }?> value="lusitana">Lusitana</option>
											<option <?php if( $menu_font_google == 'm-1c' ){ echo 'selected'; }?> value="m-1c">M+ 1c</option>
											<option <?php if( $menu_font_google == 'm-1m' ){ echo 'selected'; }?> value="m-1m">M+ 1m</option>
											<option <?php if( $menu_font_google == 'marck-script' ){ echo 'selected'; }?> value="marck-script">Marck Script</option>
											<option <?php if( $menu_font_google == 'marvel' ){ echo 'selected'; }?> value="marvel">Marvel</option>
											<option <?php if( $menu_font_google == 'maven-pro' ){ echo 'selected'; }?> value="maven-pro">Maven Pro</option>
											<option <?php if( $menu_font_google == 'merienda-one' ){ echo 'selected'; }?> value="merienda-one">Merienda One</option>
											<option <?php if( $menu_font_google == 'merriweather' ){ echo 'selected'; }?> value="merriweather">Merriweather</option>
											<option <?php if( $menu_font_google == 'mr-bedfort' ){ echo 'selected'; }?> value="mr-bedfort">Mr Bedfort</option>
											<option <?php if( $menu_font_google == 'mr-de-haviland' ){ echo 'selected'; }?> value="mr-de-haviland">Mr De Haviland</option>
											<option <?php if( $menu_font_google == 'mrs-saint-delafield' ){ echo 'selected'; }?> value="mrs-saint-delafield">Mrs Saint Delafield</option>
											<option <?php if( $menu_font_google == 'muli' ){ echo 'selected'; }?> value="muli">Muli</option>
											<option <?php if( $menu_font_google == 'neuton-cursive' ){ echo 'selected'; }?> value="neuton-cursive">Neuton Cursive</option>
											<option <?php if( $menu_font_google == 'neuton' ){ echo 'selected'; }?> value="neuton">Neuton</option>
											<option <?php if( $menu_font_google == 'noticia-text' ){ echo 'selected'; }?> value="noticia-text">Noticia Text</option>
											<option <?php if( $menu_font_google == 'open-sans-condensed' ){ echo 'selected'; }?> value="open-sans-condensed">Open Sans Condensed</option>
											<option <?php if( $menu_font_google == 'open-sans' ){ echo 'selected'; }?> value="open-sans">Open Sans</option>
											<option <?php if( $menu_font_google == 'overlock-sc' ){ echo 'selected'; }?> value="overlock-sc">Overlock SC</option>
											<option <?php if( $menu_font_google == 'overlock' ){ echo 'selected'; }?> value="overlock">Overlock</option>
											<option <?php if( $menu_font_google == 'parisienne' ){ echo 'selected'; }?> value="parisienne">Parisienne</option>
											<option <?php if( $menu_font_google == 'passion-one' ){ echo 'selected'; }?> value="passion-one">Passion One</option>
											<option <?php if( $menu_font_google == 'patua-one' ){ echo 'selected'; }?> value="patua-one">Patua One</option>
											<option <?php if( $menu_font_google == 'petrona' ){ echo 'selected'; }?> value="petrona">Petrona</option>
											<option <?php if( $menu_font_google == 'pinyon-script' ){ echo 'selected'; }?> value="pinyon-script">Pinyon Script</option>
											<option <?php if( $menu_font_google == 'playball' ){ echo 'selected'; }?> value="playball">Playball</option>
											<option <?php if( $menu_font_google == 'playfair-display' ){ echo 'selected'; }?> value="playfair-display">Playfair Display</option>
											<option <?php if( $menu_font_google == 'poiret-one' ){ echo 'selected'; }?> value="poiret-one">Poiret One</option>
											<option <?php if( $menu_font_google == 'prata' ){ echo 'selected'; }?> value="prata">Prata</option>
											<option <?php if( $menu_font_google == 'pt-sans-caption' ){ echo 'selected'; }?> value="pt-sans-caption">PT Sans Caption</option>
											<option <?php if( $menu_font_google == 'pt-sans-narrow' ){ echo 'selected'; }?> value="pt-sans-narrow">PT Sans Narrow</option>
											<option <?php if( $menu_font_google == 'pt-sans' ){ echo 'selected'; }?> value="pt-sans">PT Sans</option>
											<option <?php if( $menu_font_google == 'pt-serif-caption' ){ echo 'selected'; }?> value="pt-serif-caption">PT Serif Caption</option>
											<option <?php if( $menu_font_google == 'pt-serif' ){ echo 'selected'; }?> value="pt-serif">PT Serif</option>
											<option <?php if( $menu_font_google == 'quantico' ){ echo 'selected'; }?> value="quantico">Quantico</option>
											<option <?php if( $menu_font_google == 'quattrocento-sans' ){ echo 'selected'; }?> value="quattrocento-sans">Quattrocento Sans</option>
											<option <?php if( $menu_font_google == 'questrial' ){ echo 'selected'; }?> value="questrial">Questrial</option>
											<option <?php if( $menu_font_google == 'quicksand' ){ echo 'selected'; }?> value="quicksand">Quicksand</option>
											<option <?php if( $menu_font_google == 'qwigley' ){ echo 'selected'; }?> value="qwigley">Qwigley</option>
											<option <?php if( $menu_font_google == 'radley' ){ echo 'selected'; }?> value="radley">Radley</option>
											<option <?php if( $menu_font_google == 'rochester' ){ echo 'selected'; }?> value="rochester">Rochester</option>
											<option <?php if( $menu_font_google == 'ropa-sans' ){ echo 'selected'; }?> value="ropa-sans">Ropa Sans</option>
											<option <?php if( $menu_font_google == 'rosario' ){ echo 'selected'; }?> value="rosario">Rosario</option>
											<option <?php if( $menu_font_google == 'ruda' ){ echo 'selected'; }?> value="ruda">Ruda</option>
											<option <?php if( $menu_font_google == 'sail' ){ echo 'selected'; }?> value="sail">Sail</option>
											<option <?php if( $menu_font_google == 'ansita-one' ){ echo 'selected'; }?> value="sansita-one">Sansita One</option>
											<option <?php if( $menu_font_google == 'sanvito-pro-display' ){ echo 'selected'; }?> value="sanvito-pro-display">Sanvito Pro Display</option>
											<option <?php if( $menu_font_google == 'sarina' ){ echo 'selected'; }?> value="sarina">Sarina</option>
											<option <?php if( $menu_font_google == 'satisfy' ){ echo 'selected'; }?> value="satisfy">Satisfy</option>
											<option <?php if( $menu_font_google == 'seaweed-script' ){ echo 'selected'; }?> value="seaweed-script">Seaweed Script</option>
											<option <?php if( $menu_font_google == 'share-regular' ){ echo 'selected'; }?> value="share-regular">Share Regular</option>
											<option <?php if( $menu_font_google == 'shuriken-std' ){ echo 'selected'; }?> value="shuriken-std">Shuriken Std</option>
											<option <?php if( $menu_font_google == 'sigmar-one' ){ echo 'selected'; }?> value="sigmar-one">Sigmar One</option>
											<option <?php if( $menu_font_google == 'sofia' ){ echo 'selected'; }?> value="sofia">Sofia</option>
											<option <?php if( $menu_font_google == 'source-code-pro' ){ echo 'selected'; }?> value="source-code-pro">Source Code Pro</option>
											<option <?php if( $menu_font_google == 'source-sans-pro' ){ echo 'selected'; }?> value="source-sans-pro">Source Sans Pro</option>
											<option <?php if( $menu_font_google == 'strumpf-std' ){ echo 'selected'; }?> value="strumpf-std">Strumpf Std</option>
											<option <?php if( $menu_font_google == 'syncopate' ){ echo 'selected'; }?> value="syncopate">Syncopate</option>
											<option <?php if( $menu_font_google == 'titan-one' ){ echo 'selected'; }?> value="titan-one">Titan One</option>
											<option <?php if( $menu_font_google == 'ubuntu-condensed' ){ echo 'selected'; }?> value="ubuntu-condensed">Ubuntu Condensed</option>
											<option <?php if( $menu_font_google == 'ultra' ){ echo 'selected'; }?> value="ultra">Ultra</option>
											<option <?php if( $menu_font_google == 'unifrakturcook' ){ echo 'selected'; }?> value="unifrakturcook">UnifrakturCook</option>
											<option <?php if( $menu_font_google == 'vera-sans' ){ echo 'selected'; }?> value="vera-sans">Vera Sans</option>
											<option <?php if( $menu_font_google == 'vidaloka' ){ echo 'selected'; }?> value="vidaloka">Vidaloka</option>
											<option <?php if( $menu_font_google == 'Volkhov' ){ echo 'selected'; }?> value="volkhov">Volkhov</option>
											<option <?php if( $menu_font_google == 'yellowtail' ){ echo 'selected'; }?> value="yellowtail">Yellowtail</option>							
										</optgroup>
										
										<!--GOOGLE Font Start -->
										<optgroup label="GOOGLE FONT">
										<?php 
										foreach($fonts_array as $font_key =>$font_value){ 
											if($font_value == 'Google Font'){ ?>
												<option <?php if( $menu_font_google == esc_html($font_key) ){ echo 'selected'; }?>><?php echo $font_key; ?></option>
											<?php
											}
										}	
										?>
										</optgroup>		
										<!--Typekit Font Start -->
										<optgroup label="Typekit font">
										<?php
										$fonts_arr = get_font_array();
										foreach($fonts_arr as $keys=>$values){
											if($values == 'Typekit font'){ ?>
												<option <?php if( $menu_font_google == esc_html($keys) ){ echo 'selected'; }?>><?php echo $keys; ?></option>
												<?php
											}
										}?>
										</optgroup>							
									</select>
								</div>
							</li>
							<li class="description"><span class="option-font-sample" id="option-font-sample">FONT FAMILY</span><br /><br /><div class="clear"></div>Please Select font family from dropdown for website Menu.</li>
						</ul>
												
				</li>
				<li id="font_size">
					<h3>Font Size Settings</h3>
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<label for="heading_h1" > <?php _e('BODY TEXT FONT SIZE', 'crunchpress'); ?> </label>
							</li>	
							<li class="panel-input">
								<div id="font_size_normal" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="font_size_normal" value="<?php echo $font_size_normal;?>">
								<div id="slidertext"><?php echo $font_size_normal;?>px</div>
							</li>
							<li class="description">Please manage font body size for your website body text.</li>
						</ul>
						<div class="clear"></div>
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<label for="heading_h1" > <?php _e('HEADING H1 SIZE', 'crunchpress'); ?> </label>
							</li>	
							<li class="panel-input">
								<div id="heading_h1" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h1" value="<?php echo $heading_h1;?>">
								<div id="slidertext"><?php echo $heading_h1;?>px</div>
							</li>
							<li class="description">Please manage font size for website Heading - h1</li>
						</ul>
						<div class="clear"></div>
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<label for="heading_h2" > <?php _e('HEADING H2 SIZE', 'crunchpress'); ?> </label>
							</li>	
							<li class="panel-input">
								<div id="heading_h2" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h2" value="<?php echo $heading_h2;?>">
								<div id="slidertext"><?php echo $heading_h2;?>px</div>
							</li>
							<li class="description">Please manage font size for website Heading - h2</li>
						</ul>
						<div class="clear"></div>
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<label for="heading_h3" > <?php _e('HEADING H3 SIZE', 'crunchpress'); ?> </label>
							</li>	
							<li class="panel-input">
								<div id="heading_h3" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h3" value="<?php echo $heading_h3;?>">
								<div id="slidertext"><?php echo $heading_h3;?>px</div>
							</li>
							<li class="description">Please manage font size for website Heading - h3</li>
						</ul>
						<div class="clear"></div>
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<label for="heading_h4" > <?php _e('HEADING H4 SIZE', 'crunchpress'); ?> </label>
							</li>	
							<li class="panel-input">
								<div id="heading_h4" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h4" value="<?php echo $heading_h4;?>">
								<div id="slidertext"><?php echo $heading_h4;?>px</div>
							</li>
							<li class="description">Please manage font size for website Heading - h4</li>
						</ul>
						<div class="clear"></div>
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<label for="heading_h5" > <?php _e('HEADING H5 SIZE', 'crunchpress'); ?> </label>
							</li>	
							<li class="panel-input">
								<div id="heading_h5" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h5" value="<?php echo $heading_h5;?>">
								<div id="slidertext"><?php echo $heading_h5;?>px</div>
							</li>
							<li class="description">Please manage font size for website Heading - h5</li>
						</ul>
						<div class="clear"></div>
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<label for="heading_h6" > <?php _e('HEADING H6 SIZE', 'crunchpress'); ?> </label>
							</li>	
							<li class="panel-input">
								<div id="heading_h6" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h6" value="<?php echo $heading_h6;?>">
								<div id="slidertext"><?php echo $heading_h6;?>px</div>
							</li>
							<li class="description">Please manage font size for website Heading - h6</li>
						</ul>					
				</li>	
				<li id="type_kit_font">
					<div class="typekit_font_class">
						<h3>Typekit Font Upload Settings</h3>
						<div class="type_kit">
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="embed_typekit_code" > <?php _e('TYPEKIT EMBED CODE', 'crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<textarea name="embed_typekit_code" id="embed_typekit_code" ><?php echo ($embed_typekit_code == '')? esc_html($embed_typekit_code): esc_html($embed_typekit_code);?></textarea>
								</li>
								<li class="description">Please paste TypeKit Embeded Code <pre><script></script></pre> Here.</li>
							</ul>
							<div class="clear"></div>
							<div class="panel-title">
								<label for="add-typekit-font" > <?php _e('Font Name', 'crunchpress'); ?> </label>
							</div>	
							<div class="panel-input">
								<input type="text" id="add-typekit-font" value="type font family here" rel="type font family here">
								<div id="add-typekit-font" class="add-typekit-font"></div>
							</div>
							<br class="clear">
							<div id="selected_typekitfont" class="selected_typekitfont">
								<div class="default_typekit" id="typekit_item">
									<div class="panel-delete-typekitfont"></div>
									<div class="typekitfont_text"></div>
									<input type="hidden" id="typekit_font">
								</div>
							<?php
							//Sidebar addition
							$cp_typekit_settings = get_option('typokit_settings');
							if($cp_typekit_settings <> ''){
								$typekit_xml = new DOMDocument();
								$typekit_xml->loadXML($cp_typekit_settings);
								foreach( $typekit_xml->documentElement->childNodes as $typekit_font ){?>
								<div class="typekit_item" id="typekit_item">
									<div class="panel-delete-typekitfont"></div>
									<div class="typekitfont_text"><?php echo $typekit_font->nodeValue; ?></div>
									<input type="hidden" name="typekit_font[]" id="typekit_font" value="<?php echo $typekit_font->nodeValue; ?>">
								</div>
							<?php }
							}
							?>
							</div>
						</div>
					</div>
				</li>
			</ul>			
			<div class="clear"></div>
			<div class="panel-element-tail">
				<div class="tail-save-changes">
					<div class="loading-save-changes"></div>
					<input type="submit" value="<?php echo __('Save Changes','crunchpress') ?>">
					<input type="hidden" name="action" value="typography_settings">				
					<!--<input type="hidden" name="security" value="<?php //echo wp_create_nonce(plugin_basename(__FILE__))?>">-->
				</div>
			</div>
		</form>
	</div>
</div>
	</div>
</div>	
	<?php
}	
?>
