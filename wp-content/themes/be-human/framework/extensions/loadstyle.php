<?php

// Ajax to include font infomation
	add_action('wp_ajax_nopriv_cp_color_bg', 'cp_color_bg');
	add_action('wp_ajax_cp_color_bg','cp_color_bg');
	function cp_color_bg($recieve_color='',$recieve_an_color='',$backend_on_off=''){

		global $html_new;
		if($backend_on_off <> 1){
			$recieve_color = $_POST['color'];
			$recieve_an_color = $_POST['color_anchor'];

		}
		$html_new .= '<style id="stylesheetd">';

		$html_new .= '#horizontal_tabs ul li.active a, #horizontal_tabs ul li:hover a{ border:1px solid '.$recieve_color.' !important; background:'.$recieve_color.' !important;}';
		$html_new .= '.donate_btn, .abt_btn{ border:1px solid '.$recieve_color.' !important; background:'.$recieve_color.' !important;}';

		$html_new .= '#event_calander .fc-button-next{ background:'.$recieve_color.' !important; margin-right:20px;}';
		$html_new .= '.event_more a{background: none repeat scroll 0 0 '.$recieve_color.' !important; }';
		$html_new .= '.feature:hover .ftr_img, .feature.active .ftr_img{background: '.$recieve_color.' !important;}';
		$html_new .= '#donation_box h2{border-left:3px solid '.$recieve_color.' !important;}';
		$html_new .= '#charity_progress h3 a{ background:'.$recieve_color.' !important;}';
		$html_new .= '#charity_progress .progress-striped .bar {  background-color: '.$recieve_color.' !important;}';
		$html_new .= '#news .img_title { background:'.$recieve_color.' !important;border-top:2px solid '.$recieve_color.' !important;}';
		$html_new .= '#icon_toggle { background:'.$recieve_color.' !important;}';
		$html_new .= '#slider_blog .icon_date i{ background: none repeat scroll 0 0 '.$recieve_color.' !important;}';
		$html_new .= '#banner_rounded{ background:'.$recieve_color.' !important;}';
		$html_new .= '#footer #frm_newsletter input[type="submit"]{ background: '.$recieve_color.' !important;}';
		$html_new .= '#page_title h2{ border-color:'.$recieve_color.' !important;}';
		$html_new .= '.p404 h3 i{ background:'.$recieve_color.' !important; }';
		$html_new .= '.blog_item .read_more{ background:'.$recieve_color.' !important; }';
		$html_new .= '#comments_form input[type="submit"]{ background:'.$recieve_color.' !important;}';
		$html_new .= '.btns{ background:'.$recieve_color.' important; }';
		$html_new .= '.title_right .btns{ background:'.$recieve_color.' important; }';
		$html_new .= '.checkout_btn{ background:'.$recieve_color.' !important;}';
		$html_new .= '#cart_down_content{ background:'.$recieve_color.' !important;  }';
		$html_new .= '#cart_down_content.dropdown-menu li{ background:'.$recieve_color.' !important;}';
		$html_new .= '#product .btn{ background:'.$recieve_color.' important;  }';
		$html_new .= '.team_member_description .mem_desig{ border-bottom:1px solid '.$recieve_color.' !important;}';
		$html_new .= '.content_sidebar input[type="submit"], .content_sidebar button{ background: '.$recieve_color.' !important; }';
		$html_new .= '#tags li a.active, #tags li a:hover{ background:'.$recieve_color.' !important;}';
		$html_new .= '#slider_products .bottom_sec{ background:'.$recieve_color.' !important;}';
		//$html_new .= '#event_grid .hasCountdown{ background:'.$recieve_color.' important; }';
		$html_new .= '#listing_dropdown ul li a {    background: none repeat scroll 0 0 '.$recieve_color.' !important;}';
		$html_new .= '.gallery-page .view_new figure:hover{ border-color:'.$recieve_color.' !important;}';
		$html_new .= '.heading-bar-table th{ background:'.$recieve_color.' !important;}';
		$html_new .= '.id-widget h2.id-product-title a{ background:'.$recieve_color.' !important;}';
		$html_new .= '#commentform input[type="submit"]{ background:'.$recieve_color.';}';
		$html_new .= '.woocommerce-page #content input.button{background:'.$recieve_color.' important;}';
		$html_new .= '.woocommerce-message, .woocommerce-info{border-top-color:'.$recieve_color.' !important;}';
		$html_new .= '.woocommerce-message:before, .woocommerce-info:before{ background-color:'.$recieve_color.' !important; }';
		$html_new .= '.tagcloud a.active, .tagcloud a:hover{ background:'.$recieve_color.' !important; color:#000; }';
		$html_new .= '.widget_search #searchform input[type="submit"]{background: '.$recieve_color.' !important;}';
		$html_new .= '.widget.widget_nav_menu .menu li.current-menu-item { background:'.$recieve_color.' important;}';
		$html_new .= '#slider_shop .price_cart{background:'.$recieve_color.';}';
		$html_new .= '.h-line{  border-top:2px solid '.$recieve_color.' !important;}';
		$html_new .= '#btn_newsletter, #footer #frm_newsletter input[type="submit"]{background:'.$recieve_color.';}';
		$html_new .= '#donation_box button, a.donate-now{background:'.$recieve_color.';}';
		$html_new .= '#banner_slider li div .b_green{background:'.$recieve_color.' !important;}';
		$html_new .= ' .post_featured_image .slider_content{background:'.$recieve_color.' !important;}';
		$html_new .= ' .hasCountdown, .tCountdOwn{background:'.$recieve_color.' !important;}';
		$html_new .= '#event_grid .countdown_section{border-left:1px solid #fff !important;}';
		$html_new .= '#event_grid .countdown_section{border-right:1px solid #fff !important;}';
		$html_new .= '.widget.widget_nav_menu .menu li a:hover, .widget.widget_nav_menu .menu li.current-menu-item  { background:'.$recieve_color.' !important; }';
		$html_new .= '#mymenu .current-menu-item, #mymenu .current-menu-ancestor{ background:'.$recieve_color.' !important; }';
		$html_new .= '#mymenu .dropdown-menu > li > a:hover,#mymenu .dropdown-menu > li > a:focus,#mymenu .sub-menu > li > a:hover,#mymenu .sub-menu > li > a:focus, .children > li > a:hover,#mymenu .children > li > a:focus,#mymenu .dropdown-submenu:hover > a,#mymenu .dropdown-submenu:focus > a{ background:'.$recieve_color.' !important; }';
		$html_new .= '.fund_project .progress-striped .bar, #charity_progress .progress-striped .bar{ background:'.$recieve_color.' !important;}';
		$html_new .= '#nav .navbar li:hover{ background:'.$recieve_color.' !important; }';
		$html_new .= '.woocommerce a.button, .woocommerce-page a.button,.woocommerce button.button,.woocommerce-page button.button,.woocommerce input.button,.woocommerce-page input.button,.woocommerce #respond input#submit,.woocommerce-page #respond input#submit,.woocommerce #content input.button,.woocommerce-page #content input.button{background:'.$recieve_color.' !important;}';
		$html_new .= '#cart_down i,.bx-wrapper .bx-next:hover,.bx-wrapper .bx-prev:hover{color:'.$recieve_color.' !important;}';
		$html_new .= '.btns{background:'.$recieve_color.' !important;border-color:'.$recieve_color.' !important;}';
		$html_new .= '.blog_class .bx-wrapper .bx-controls-direction a:hover{background:'.$recieve_color.' !important;}';
		$html_new .= '#map_abs,#map_abs span{background:'.$recieve_color.' !important;}';


		$html_new .= '.career-list{background:'.$recieve_color.' !important;color:'.$recieve_an_color.' !important;}';
		$html_new .= '.charity_counter_wrapper .charity_title{color:'.$recieve_an_color.' !important;}';
		$html_new .= '.read_more{color:'.$recieve_an_color.' !important;}';
		$html_new .= '#header .btn-group #get_count_head{color:'.$recieve_an_color.' !important;}';
		$html_new .= '.cart_baskit i{color:'.$recieve_an_color.' !important;}';
		$html_new .= '.price_cart span{color:#fff !important;}';
		$html_new .= 'span.countdown_amount{ color:'.$recieve_an_color.' !important; }';
		$html_new .= '#event_grid .event_info span.countdown_amount{ color:'.$recieve_an_color.' !important; }';
		$html_new .= '.fund_project .info span,#charity_progress .info span{ color:'.$recieve_an_color.' !important;}';
		$html_new .= '#calander_list h1{ color:'.$recieve_an_color.' !important;}';
		$html_new .= 'a{ color:'.$recieve_an_color.'; }';
		$html_new .= '.widget.widget_recent_comments a{ color:'.$recieve_an_color.' important; }';
		$html_new .= '.widget.widget_nav_menu .menu li a{ color:'.$recieve_an_color.';}';
		$html_new .= '.widget.widget_pages li a{ color:'.$recieve_an_color.';}';
		$html_new .= '.id-widget .id-product-infobox .id-progress-raised {color:'.$recieve_an_color.' !important;}';
		$html_new .= '.current_collection{ color:'.$recieve_an_color.' !important;}';
		$html_new .= '#latest_tweets span{ clear:both; width:100%; color:'.$recieve_an_color.' !important;}';
		$html_new .= '#product .price { color:'.$recieve_an_color.' !important; }';

		$html_new .= '.cart_total{ color:'.$recieve_an_color.' !important; }';
		$html_new .= '#product_info h3{ color:'.$recieve_an_color.' !important; }';
		$html_new .= '.contact_info i{  color:'.$recieve_an_color.' !important;}';
		$html_new .= '.blog_post_detail .post_meta_detail ul li i{ color:'.$recieve_an_color.' !important;}';
		$html_new .= '.post_meta ul i{ color:'.$recieve_an_color.' !important;}';
		$html_new .= '#footer .widget a{ color:'.$recieve_an_color.' !important;}';
		$html_new .= '#latest_tweets li a { color:'.$recieve_an_color.' !important;}';
		$html_new .= '#accordion_news .accordion-inner a{ color:'.$recieve_an_color.' !important;}';
		$html_new .= '#charity_progress h2{ color:'.$recieve_an_color.' !important;}';
		$html_new .= '#accordion_news .title{ color:'.$recieve_an_color.' !important;}';
		//$html_new .= '.charity_title {color:'.$recieve_an_color.' !important;}';
		$html_new .= '.feature:hover  .ftr_txt strong, .feature.active .ftr_txt strong { color:'.$recieve_an_color.' !important;}';
		$html_new .= '</style>';

		//Color Picker Is Installed
		if($backend_on_off <> 1){
			die(json_encode($html_new));
		}else{
			return $html_new;
		}

	}


// Add Style to Frontend
function add_font_code(){
	global $pagenow;
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

		}

			$header_logo_upload = '';
			$logo_width = '';
			$logo_height = '';
			$select_layout_cp = '';
			$boxed_scheme = '';
			$select_bg_pat = '';
			$color_scheme = '';
			$color_anchor = '';
			$bg_scheme = '';
			$body_patren = '';
			$body_image = '';
			$position_image_layout = '';
			$image_repeat_layout = '';
			$image_attachment_layout = '';
			$header_css_code = '';
			$google_webmaster_code = '';
			$countd_event_category = '';
			$copyright_code = '';
			$consumer_key = '';
			$consumer_secret = '';
			$user_token = '';
			$user_secret = '';
			$twitter_id = '';
			$footer_banner = '';
			$footer_col_layout = '';
			$phone_contact = '';
			$social_networking = '';
			$footer_logo = '';
			$footer_logo_width = '';
			$footer_logo_height = '';
			$footer_layout = '';
			$breadcrumbs = '';
			$rtl_layout = '';
			$tf_username = '';
			$tf_sec_api = '';

			$cp_general_settings = get_option('general_settings');
			if($cp_general_settings <> ''){
				$cp_logo = new DOMDocument ();
				$cp_logo->loadXML ( $cp_general_settings );
				$header_logo = find_xml_value($cp_logo->documentElement,'header_logo');
				$logo_width = find_xml_value($cp_logo->documentElement,'logo_width');
				$logo_height = find_xml_value($cp_logo->documentElement,'logo_height');
				$select_layout_cp = find_xml_value($cp_logo->documentElement,'select_layout_cp');
				$boxed_scheme = find_xml_value($cp_logo->documentElement,'boxed_scheme');
				$select_bg_pat = find_xml_value($cp_logo->documentElement,'select_bg_pat');
				$color_scheme = find_xml_value($cp_logo->documentElement,'color_scheme');
				$color_anchor = find_xml_value($cp_logo->documentElement,'color_anchor');
				$bg_scheme = find_xml_value($cp_logo->documentElement,'bg_scheme');
				$body_patren = find_xml_value($cp_logo->documentElement,'body_patren');
				$color_patren = find_xml_value($cp_logo->documentElement,'color_patren');
				$body_image = find_xml_value($cp_logo->documentElement,'body_image');
				$position_image_layout = find_xml_value($cp_logo->documentElement,'position_image_layout');
				$image_repeat_layout = find_xml_value($cp_logo->documentElement,'image_repeat_layout');
				$image_attachment_layout = find_xml_value($cp_logo->documentElement,'image_attachment_layout');
				$header_css_code = find_xml_value($cp_logo->documentElement,'header_css_code');
				$google_webmaster_code = find_xml_value($cp_logo->documentElement,'google_webmaster_code');
				$countd_event_category = find_xml_value($cp_logo->documentElement,'countd_event_category');
				$copyright_code = find_xml_value($cp_logo->documentElement,'copyright_code');
				$footer_banner = find_xml_value($cp_logo->documentElement,'footer_banner');
				$footer_col_layout = find_xml_value($cp_logo->documentElement,'footer_col_layout');
				$phone_contact = find_xml_value($cp_logo->documentElement,'phone_contact');
				$social_networking = find_xml_value($cp_logo->documentElement,'social_networking');
				$consumer_key = find_xml_value($cp_logo->documentElement,'consumer_key');
				$consumer_secret = find_xml_value($cp_logo->documentElement,'consumer_secret');
				$user_token = find_xml_value($cp_logo->documentElement,'user_token');
				$user_secret = find_xml_value($cp_logo->documentElement,'user_secret');
				$twitter_id = find_xml_value($cp_logo->documentElement,'twitter_id');
				$breadcrumbs = find_xml_value($cp_logo->documentElement,'breadcrumbs');
				$rtl_layout = find_xml_value($cp_logo->documentElement,'rtl_layout');
				$tf_username = find_xml_value($cp_logo->documentElement,'tf_username');
				$tf_sec_api = find_xml_value($cp_logo->documentElement,'tf_sec_api');
			}
?>
<style type="text/css" media="screen">
<?php
	 if($select_bg_pat == 'Background-Image'){
			$image_src_head = '';
			if(!empty($body_image)){
				$image_src_head = wp_get_attachment_image_src( $body_image, 'full' );
				$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
				$thumb_src_preview = wp_get_attachment_image_src( $body_image, 'full');
			}	?>
		body{
			background-image:url(<?php echo $thumb_src_preview[0];?>);
			background-repeat:<?php echo $image_repeat_layout;?>;
			background-position:<?php echo $position_image_layout;?>;
			background-attachment:<?php echo $image_attachment_layout;?>;
			background-size:100%;
		}
		<?php }else if($select_bg_pat == 'Background-Color'){?>
		body{
			background:<?php echo $bg_scheme?> !important;
		}
		.inner-pages h2 .txt-left{
			background:<?php echo $bg_scheme;?>;
		}
		<?php }else if($select_bg_pat == 'Background-Patren'){
		if(!empty($body_patren)){
		$image_src_head = wp_get_attachment_image_src( $body_patren, 'full' );
		$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
		$thumb_src_preview = wp_get_attachment_image_src( $body_patren, array(60,60));?>
		body{
			background:url(<?php echo $thumb_src_preview[0];?>) repeat !important;
		}
		<?php }else{
		?>
		body{
			background:<?php echo $bg_scheme?> url(<?php echo CP_PATH_URL; ?><?php echo $color_patren;?>) repeat;
		}
		.inner-pages h2 .txt-left{
			background:<?php echo $bg_scheme?> url(<?php echo CP_PATH_URL; ?><?php echo $color_patren;?>) repeat;
		}
	<?php
			}
		}
	if($heading_h1 <> ''){?>
	h1{
	font-size:<?php echo $heading_h1;?>px !important;
	}
	<?php }?>
	<?php if($heading_h2 <> ''){?>
	h2{
	font-size:<?php echo $heading_h2;?>px !important;
	}
	<?php }?>
	<?php if($heading_h3 <> ''){?>
	h3{
	font-size:<?php echo $heading_h3;?>px !important;
	}
	<?php }?>
	<?php if($heading_h4 <> ''){?>
	h4{
	font-size:<?php echo $heading_h4;?>px !important;
	}
	<?php }?>
	<?php if($heading_h5 <> ''){?>
	h5{
	font-size:<?php echo $heading_h5;?>px !important;
	}
	<?php }?>
	<?php if($heading_h6 <> ''){?>
	h6{
	font-size:<?php echo $heading_h6;?>px !important;
	}
	<?php }?>
	<?php if($font_size_normal <> ''){?>
	body{
	font-size:<?php echo $font_size_normal;?>px !important;
	}
	<?php }?>
	<?php if($font_google <> 'Default'){?>
	body{
		font-family:"<?php echo $font_google;?>";
	}
	input, button, select, textarea{
		font-family:"<?php echo $font_google;?>";
	}
	.comment-reply-link, #submit_btn, .form-submit #submit, .send-btn{
		font-family:"<?php echo $font_google;?>";
	}
	<?php }else{ ?>
	input, button, select, textarea{
		font-family: 'Open Sans',sans-serif;
	}
	body{
		font-family: 'Open Sans',sans-serif;
	}
	.author-art p {
		font-family: 'Open Sans',sans-serif;
	}
	.d-btn,
	.author-name a,
	.title2 a{
		font-family: 'Open Sans',sans-serif;
	}
	.b-top-links{ font-size:14px; }
	<?php }
	if($select_layout_cp == 'box_layout'){ ?>
	.boxed{
		background:<?php echo $boxed_scheme;?>;
	}
	<?php }	?>
	<?php if($font_google_heading <> 'Default'){?>
	h1, h2, h3, h4, h5, h6{
		font-family:"<?php echo $font_google_heading;?>";
	}
	<?php }else{?>
	h1, h2, h3, h4, h5, h6{
		font-family: 'Open Sans',sans-serif;
	}
	<?php
	}
if($menu_font_google <> 'Default'){?>
	#nav{
		font-family:"<?php echo $menu_font_google;?>";
	}
	<?php }else{?>
	#nav{
		font-family:'Open Sans',sans-serif;
	}
	<?php
	}



?>
</style>
	<?php
		$recieve_color = '';
		$recieve_an_color = '';
		$html_new = '';
		$backend_on_off = 1;
		//Color Scheme
		if($color_scheme <> ''){
			$recieve_color = $color_scheme;
			$recieve_an_color = $color_anchor;
			echo cp_color_bg($recieve_color,$recieve_an_color,$backend_on_off);
		}
}

global $pagenow;
if( $GLOBALS['pagenow'] != 'wp-login.php' ){
	if(!is_admin()){
		//for Frontend only
		add_action('wp_footer', 'add_font_code');

		$font_google = '';
		$font_size_normal = '';
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
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			$font_google = find_xml_value($cp_typo->documentElement,'font_google');
			$font_size_normal = find_xml_value($cp_typo->documentElement,'font_size_normal');
			$font_google_heading = find_xml_value($cp_typo->documentElement,'font_google_heading');
			$heading_h1 = find_xml_value($cp_typo->documentElement,'heading_h1');
			$heading_h2 = find_xml_value($cp_typo->documentElement,'heading_h2');
			$heading_h3 = find_xml_value($cp_typo->documentElement,'heading_h3');
			$heading_h4 = find_xml_value($cp_typo->documentElement,'heading_h4');
			$heading_h5 = find_xml_value($cp_typo->documentElement,'heading_h5');
			$heading_h6 = find_xml_value($cp_typo->documentElement,'heading_h6');
			$embed_typekit_code = find_xml_value($cp_typo->documentElement,'embed_typekit_code');

		}

		$header_logo_upload = '';
		$logo_width = '';
		$logo_height = '';
		$select_bg_pat = '';
		$color_scheme = '#555';
		$bg_scheme = '';
		$body_patren = '';
		$color_patren = '';
		$header_css_code = '';
		$google_webmaster_code = '';
		$copyright_code = '';
		$social_networking = '';
		$footer_logo = '';
		$footer_logo_width = '';
		$footer_logo_height = '';
		$breadcrumbs = '';
		$responsive = '';
		$tf_username = '';
		$tf_sec_api = '';

		//General Settings Values
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$header_logo = find_xml_value($cp_logo->documentElement,'header_logo');
			$header_link = find_xml_value($cp_logo->documentElement,'header_link');
			$logo_width = find_xml_value($cp_logo->documentElement,'logo_width');
			$logo_height = find_xml_value($cp_logo->documentElement,'logo_height');
			$select_bg_pat = find_xml_value($cp_logo->documentElement,'select_bg_pat');
			$color_scheme = find_xml_value($cp_logo->documentElement,'color_scheme');
			$bg_scheme = find_xml_value($cp_logo->documentElement,'bg_scheme');
			$body_patren = find_xml_value($cp_logo->documentElement,'body_patren');
			$color_patren = find_xml_value($cp_logo->documentElement,'color_patren');
			$social_networking = find_xml_value($cp_logo->documentElement,'social_networking');
			$header_css_code = find_xml_value($cp_logo->documentElement,'header_css_code');
			$google_webmaster_code = find_xml_value($cp_logo->documentElement,'google_webmaster_code');
			$copyright_code = find_xml_value($cp_logo->documentElement,'copyright_code');
			$footer_logo = find_xml_value($cp_logo->documentElement,'footer_logo');
			$footer_logo_width = find_xml_value($cp_logo->documentElement,'footer_logo_width');
			$footer_logo_height = find_xml_value($cp_logo->documentElement,'footer_logo_height');
			$breadcrumbs = find_xml_value($cp_logo->documentElement,'breadcrumbs');
			$responsive = find_xml_value($cp_logo->documentElement,'responsive');
			$tf_username = find_xml_value($cp_logo->documentElement,'tf_username');
			$tf_sec_api = find_xml_value($cp_logo->documentElement,'tf_sec_api');
		}


	}
}