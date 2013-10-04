<?php 



	/*	

	*	CrunchPress Page Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file create and contains the page post_type meta elements
	*	---------------------------------------------------------------------
	*/

	// a type that each element can be ( also set in page-dragging.js )

	$div_size = array(

			

		'Accordion' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),

		'Blog' => array(
			'element1-2'=>'1/2',
			'element1-1'=>'1/1'),

		'News' => array(

			'element1-2'=>'1/2',
			'element1-1'=>'1/1'),
		
		'News-Slider' => array(

			'element1-2'=>'1/2',
			'element1-1'=>'1/1'),		

		'Contact-Form' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),

		'Our-Team'=>array(
			'element1-1'=>'1/1'),	
		
		'Career'=>array(
			'element1-1'=>'1/1'),
			
		'Product-Listing'=>array(
			'element1-1'=>'1/1'),	
		
		'Services'=>array(
			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),
		
		'Content' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),

		

		'Column' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),

		'DonateNow' => array(

			'element1-2'=>'1/2',

			'element1-1'=>'1/1'),

		'Divider' => array(

			'element1-1'=>'1/1'),		

		'Events' => array(

			'element1-2'=>'1/2',
			'element1-1'=>'1/1'),
		
		'Charity-Events' => array(

			'element1-1'=>'1/1'),	

		'Product-Slider' => array(

			'element1-1'=>'1/1'),		
			
		'Crowd-Funding' => array(

			'element1-1'=>'1/1'),			
		
		'Feature-Project' => array(
		
			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),	
		
		'Feature-Product' => array(
		
			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),

		
		'Blog-Slider'=>array(
			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),	
			
		'Venue'=>array(
			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),

		'Gallery' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),		


		'Slider' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),

		'Tab' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),

			

		// 'Testimonial' => array(

			// 'element1-4'=>'1/4',

			// 'element1-3'=>'1/3',

			// 'element1-2'=>'1/2',

			// 'element2-3'=>'2/3',

			// 'element3-4'=>'3/4',

			// 'element1-1'=>'1/1'),

			

		'Toggle-Box' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),



	);

	

	// the element in page options

	$page_meta_boxes = array(
	
		"Gallery Top Open" => array( 'type'=>'open', 'id'=>'cp-top-gallery-wrapper'),
		
		'Gallery Slideshow'=>array(

			'title'=>'(TEMPLATE PAGE: GALLERY SLIDESHOW) CHOOSE IMAGES GALLERY',

			'name'=>'page-option-item-gallery-selection',

			'options'=>array(),

			'type'=>'combobox_post',

			'hr'=>'none',

			'description'=>'Choose Gallery for Slideshow Gallery (Page Template) Please read documentation for further detail.'),

		"Gallery Top Close" => array( 'type'=>'close' ),
		
		"Top Content Open" => array( 'type'=>'open', 'id'=>'cp-show-content-title-dd'),
		
		'Facebook Fan'=>array(

			'title'=>'FACEBOOK FAN PAGE',

			'name'=>'page-option-item-facebook-selection',

			'options'=>array('0'=>'Yes','1'=>'No'),

			'type'=>'combobox',
			
			'default' => 'No',

			'hr'=>'none',

			'description'=>'Do you want to set this page as facebook fan page.'),
		
		'show-content-title'=>array(					

			'title'=> 'CONTENT TITLE',

			'name'=> 'cp-show-content-title',

			'type'=> 'combobox',

			'options'=>array('0'=>'Yes','1'=>'No'),

			'description'=>'You can Turn/On Page Content Title.'),
		
		'show-content-description'=>array(					

			'title'=> 'CONTENT DESCRIPTION',

			'name'=> 'cp-show-content-descrip',

			'type'=> 'combobox',

			'options'=>array('0'=>'Yes','1'=>'No'),

			'description'=>'You can Turn/On Page Content Description.'),

		"Page Item" => array(

			'item'=>'page-option-item-type' ,

			'size'=>'page-option-item-size', 

			'xml'=>'page-option-item-xml', 

			'type'=>'page-option-item',

			'name'=>array(
				
				'Content' => array(
				
					'show-big-toolbar'=>array(

						'title'=>'ENABLE BIG TOOLBAR',

						'name'=>'page-option-item-content-toolbar',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes', '1'=>'No'),

						'default'=> 'No',
						
						'hr'=> 'none',

						'description'=>'Bigtool bar will only appear this option selected to yes otherwise no toolbar will show default layout will be.'),
				
					'button-text'=>array(

						'title'=> 'BUTTON TITLE',

						'name'=> 'page-option-content-item-title-toolbar',

						'type'=> 'inputtext'),
						
					'button-link'=>array(

						'title'=> 'BUTTON LINK',

						'name'=> 'page-option-content-item-link-toolbar',

						'type'=> 'inputtext'),	
				),
				

				'Blog'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-blog-header-title',

						'type'=> 'inputtext'),			

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-blog-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'description'=>'Choose the post category you want to fetch the post.'),

					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF DESCRIPTION',

						'name'=> 'page-option-item-blog-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 285,

						'description'=>'This is the number of content character.'),

					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-blog-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes', '1'=>'No'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of blog post is greater than the number of fetched item in one page.'),
					
					'num-fetch'=>array(					

						'title'=> 'BLOG NUMBER OF POSTS',

						'name'=> 'page-option-item-blog-num-fetch',

						'type'=> 'inputtext',

						'default'=> 9,

						'description'=>'This is the number of fetched item in one page.'),	

				),
				
				'News'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-news-header-title',

						'type'=> 'inputtext'),			

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-news-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'description'=>'Choose the post category you want to fetch the post.'),

					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF DESCRIPTION',

						'name'=> 'page-option-item-news-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 285,

						'description'=>'This is the number of thumbnail content character.'),

					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-news-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes', '1'=>'No'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of news post is greater than the number of fetched item in one page.'),
						
					'num-fetch'=>array(					

						'title'=> 'NUMBERS OF NEWS',

						'name'=> 'page-option-item-news-num-fetch',

						'type'=> 'inputtext',

						'default'=> 9,

						'description'=>'This is the number of fetched item in one page.'),	

				),

				'Our-Team'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-team-header-title',

						'type'=> 'inputtext'),

					'select_feature'=>array(

						'title'=>'CHOOSE FEATURE MEMBER',

						'name'=>'page-option-item-feature-member',

						'options'=>array(),

						'type'=>'combobox_post',

						'description'=>'Choose the post category you want to fetch the post.'),						

					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-team-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 285,

						'description'=>'This is the number of content character.'),

					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-team-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes', '1'=>'No'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of news post is greater than the number of fetched item in one page.'),

					'num-fetch'=>array(					

						'title'=> 'NEWS NUM FETCH',

						'name'=> 'page-option-item-team-num-fetch',

						'type'=> 'inputtext',

						'default'=> 9,

						'description'=>'This is the number of fetched item in one page.'),
	

				),

				'Career'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-career-header-title',

						'type'=> 'inputtext'),		

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-career-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the Career category you want the Job to be fetched.'),						

					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-career-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 285,

						'description'=>'This is the number of content character.'),

					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-career-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes', '1'=>'No'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of news post is greater than the number of fetched item in one page.'),

					'num-fetch'=>array(					

						'title'=> 'NEWS NUM FETCH',

						'name'=> 'page-option-item-career-num-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=>'This is the number of fetched item in one page.'),
	

				),
				
				'Feature-Project'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-project-header-title',

						'type'=> 'inputtext'),			

					'project'=>array(

						'title'=>'CHOOSE PROJECT',

						'name'=>'page-option-item-project-name',

						'options'=>array(),

						'type'=>'combobox_post',

						'description'=>'Choose the Project you want to show.'),

				),

				'Gallery' =>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-gallery-header-title',

						'type'=> 'inputtext'),	

					'item-size'=>array(

						'title'=> 'GALLERY TYPE',

						'name'=> 'page-option-item-gallery-item-size',

						'type'=> 'combobox',

						'options'=> array('2 Column', '3 Column', '4 Column')

					),
					
					'num-size'=>array(

						'title'=> 'NUMBER OF IMAGES',

						'name'=> 'page-option-item-gallery-num-size',

						'default'=> 5,

						'type'=> 'inputtext'),	

					'page'=> array(

						'title'=> 'CHOOSE GALLERY PAGE',

						'name'=> 'page-option-item-gallery-page',

						'type'=> 'combobox_post',

						'options'=> array(),

						'hr'=>'none'

					),					

				),

				'Events'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-event-header-title',

						'type'=> 'inputtext'),
						
					'eventview'=>array(

						'title'=>'SELECT EVENT VIEW',

						'name'=>'page-option-item-event-view',

						'type'=> 'combobox',

						'options'=>array('0'=>'Listing View', '1'=>'Calendar View'),

						'description'=>'This option enable the events show as in listing and in calendar view.'),	
						
					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-event-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the event category you want the item to be fetched.'),
					
					'eventtype'=>array(

						'title'=>'SELECT EVENT TYPE',

						'name'=>'page-option-item-event-type',

						'type'=> 'combobox',

						'options'=>array('0'=>'All Events', '1'=>'Upcoming Events','2'=>'Past Events'),

						'description'=>'This option enable the category events that helps you filter the event in past and future.'),	
						
					'event-type-open'=>array('type'=>'open','name'=>'event_type_open','id'=>'event_type_open'),	

					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-event-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 100,

						'description'=>'Set the event description content character length.'),

					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-event-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes', '1'=>'No'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of selected page is greater than the number of fetched item in one page.'),
					
					'num-fetch'=>array(					

						'title'=> 'NUMBER OF EVENTS TO SHOW',

						'name'=> 'page-option-item-event-num-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=> 'This is the number of event thumbnail you want to fetch in one page.'),	
					
					'event-type-close'=>array('type'=>'close','name'=>'event_type_open'),	

				),
				
				'Venue'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-event-venue-title',

						'type'=> 'inputtext'),
						
					'location'=>array(

						'title'=>'CHOOSE LOCATION',

						'name'=>'page-option-item-venue-category',

						'options'=>array(),

						'type'=>'combobox_post',

						'hr'=> 'none',

						'description'=>'Choose the location you want the event to be fetched.'),	
					
					'num-fetch'=>array(					

						'title'=> 'NUMBER OF EVENTS TO SHOW',

						'name'=> 'page-option-venue-event-num-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=> 'This is the number of events you want to fetch in one page.'),	
				),
				
				'Charity-Events'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-charity-event-title',

						'type'=> 'inputtext'),
						
					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-charity-event-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the category you want the event to be fetched.'),	
					
					'num-fetch'=>array(					

						'title'=> 'NUMBER OF EVENTS TO SHOW',

						'name'=> 'page-option-charity-event-num-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=> 'This is the number of events you want to fetch in one page.'),	
						
					'video-gallery'=>array(

						'title'=>'CHOOSE GALLERY',

						'name'=>'page-option-charity-event-gallery',

						'options'=>array(),

						'type'=>'combobox_post',

						'hr'=> 'none',

						'description'=>'Choose the Video or Image gallery you want to show along side events.'),		
				),		
				
				'Product-Listing'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-product-header-title',

						'type'=> 'inputtext'
					),

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-product-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the product category you want the Item to be fetched.'
					),
					
					'num-excerpt'=>array(

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-product-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 150,

						'description'=>'This is the number of content character.'
					),
					
					'layout_select'=>array(

						'title'=> 'SELECT LAYOUT',

						'name'=> 'page-option-item-product-layout',

						'type'=> 'combobox',
						
						'defualt'=> 'Full',

						'options'=>array('0'=>'Grid', '1'=>'Full'),

					),	
					
					'product-type-filterable-open'=>array('type'=>'open','id'=>'product-type-filterable','name'=>'product_type_filterable'),
						
					'filterable'=>array(

						'title'=> 'SHOW FILTERABLE',

						'name'=> 'page-option-item-product-filterable',

						'type'=> 'combobox',
						
						'defualt'=> 'No',

						'options'=>array('0'=>'Yes', '1'=>'No'),

					),		
					
					'product-type-filterable-close'=>array('type'=>'close','name'=>'product_type_filterable'),

					
					
					'product-type-open'=>array('type'=>'open','id'=>'product-type-hide','name'=>'product_type_close'),
					
					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-product-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes', '1'=>'No'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of news post is greater than the number of fetched item in one page.'
					),

					'num-fetch'=>array(					

						'title'=> 'NEWS NUM FETCH',

						'name'=> 'page-option-item-product-num-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=>'This is the number of fetched item in one page.'
					),
					
					'product-type-close'=>array('type'=>'close','name'=>'product_type_close'),		

				),
				
				
				'Product-Slider' => array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-product-slider-title',

						'type'=> 'inputtext'),			

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-product-slider-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'description'=>'Choose the product category you want to fetch the products.'),
						
					'num-fetch'=>array(					

						'title'=> 'NUMBERS OF PRODUCTS',

						'name'=> 'page-option-item-product-slider-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=>'This is the number of fetched item in widget.'),	

				),
				
				'Crowd-Funding' => array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-ignition-header-title',

						'type'=> 'inputtext'
					),

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-ignition-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the category you want the Item to be fetched.'
					),
					
					'num-excerpt'=>array(

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-ignition-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 150,

						'description'=>'This is the number of content character.'
					),
					
					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-ignition-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes', '1'=>'No'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of news post is greater than the number of fetched item in one page.'
					),

					'num-fetch'=>array(					

						'title'=> 'NEWS NUM FETCH',

						'name'=> 'page-option-item-ignition-num-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=>'This is the number of fetched item in one page.'
					),
					
					

				),
				
				'Product-Slider' => array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-product-slider-title',

						'type'=> 'inputtext'),			

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-product-slider-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'description'=>'Choose the product category you want to fetch the products.'),
						
					'num-fetch'=>array(					

						'title'=> 'NUMBERS OF PRODUCTS',

						'name'=> 'page-option-item-product-slider-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=>'This is the number of fetched item in widget.'),	

				),
			
				'Blog-Slider'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-blog-item-title',

						'type'=> 'inputtext'),
						
					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-blog-item-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the category you want the blog to be fetched.'),	
					
					'num-excerpt'=>array(

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-blog-slider-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 150,

						'description'=>'This is the number of content character.'
					),	
					
					'num-fetch'=>array(					

						'title'=> 'NUMBER OF BLOG TO SHOW',

						'name'=> 'page-option-blog-num-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=> 'This is the number of blog you want to fetch in one page.'),	
				),	
				
				'News-Slider'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-news-slider-title',

						'type'=> 'inputtext'),			

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-news-slider-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'description'=>'Choose the news category you want to fetch the news.'),
						
					'num-fetch'=>array(					

						'title'=> 'NUMBERS OF NEWS',

						'name'=> 'page-option-item-news-slider-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=>'This is the number of fetched item in widget.'),	

				),
				
				'Feature-Product'=>array(

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-feature-product-slider-title',

						'type'=> 'inputtext'),			

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-feature-product-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'description'=>'Choose the product category you want to fetch the news.'),
						
					'num-fetch'=>array(					

						'title'=> 'NUMBERS OF PRODUCTS',

						'name'=> 'page-option-item-news-slider-fetch',

						'type'=> 'inputtext',

						'default'=> 5,

						'description'=>'This is the number of fetched item in slider.'),	

				),
				
				
				'Slider' =>array(

					'slider-type'=>array(

						'title'=>'SLIDER TYPE',

						'name'=>'page-option-item-slider-type',

						'options'=>array('0'=>'Bx-Slider','1'=>'Layer-Slider'),
						/*'options'=>array('0'=>'Anything','1'=>'Flex-Slider','2'=>'Default-Slider','3'=>'Layer-Slider'),*/
						
						/*'options'=>array('0'=>'Anything','1'=>'Flex-Slider','2'=>'Default-Slider'),*/

						'type'=>'combobox',

						'hr'=>'none',
						
						'description'=>'Select Slider from the dropdown list.',

					    ),
						
					'slider-slide'=>array(

						'title'=>'SELECT SLIDE IMAGES',

						'name'=>'page-option-item-slider-images',

						'options'=>array(),

						'type'=>'combobox_post',

						'hr'=>'none',
						
						'description'=>'Select Slider Image Gallery from the dropdown list.',

					    ),
					
					'slider-slide-layer'=>array(

						'title'=>'SELECT LAYER SLIDER ID',

						'name'=>'page-option-item-slider-layer',

						'options'=>array(),

						'type'=>'combobox',

						'hr'=>'none',
						
						'description'=>'Select Layer Slider Images slide.',

					    ),	
					
					'width'=>array(

						'title'=>'SLIDER WIDTH',

						'name'=>'page-option-item-slider-width',

						'type'=>'inputtext',

						'default'=>'940',
						
						'description'=>'Please enter the width of the slider.',

						'hr'=>'none'),

					'height'=>array(

						'title'=>'SLIDER HEIGHT',

						'name'=>'page-option-item-slider-height',

						'type'=>'inputtext',

						'default'=>'360',
						
						'description'=>'Please enter the Height of the slider.',

						'hr'=>'none'),

				),
				
				
				'Services' => array(

					"image" => array(

						'title'=> __('IMAGE', 'crunchpress'),

						'name'=>'page-option-item-column-service-image',

						'type'=>'upload',

						'description'=>'Select proper image size according to service widget size'),				

					'title'=>array(

						'title'=> __('TITLE', 'crunchpress'),

						'name'=> 'page-option-item-column-service-title',

						'type'=> 'inputtext'),

					'caption'=>array(

						'title'=> __('CAPTION', 'crunchpress'),

						'name'=> 'page-option-item-column-service-caption',

						'type'=> 'textarea',

						'hr'=>'none'),

					'morelink'=>array(

						'title'=> __('Url', 'crunchpress'),

						'name'=> 'page-option-item-column-service-link',

						'type'=> 'inputtext'),

				),

				
				'Accordion' =>array(

					'header'=>array(

						'title'=> __('HEADER TITLE', 'crunchpress'),

						'name'=> 'page-option-item-accordion-header-title',

						'type'=> 'inputtext'),

					'tab-item'=>array(

						'tab-num'=>'page-option-item-accordion-num',

						'title'=>'page-option-item-accordion-title',

						'caption'=>'page-option-item-accordion-content',

						'active'=>'',

						'hr'=>'none')

				),


				'Column'=>array(

					'column-text'=>array(

						'title'=> 'Column Text',

						'name'=> 'page-option-item-column-text',

						'type'=> 'textarea',

						'hr'=> 'none')

				),


				'Divider' =>array(

					'text'=>array(

						'title'=> 'DIVIDER',

						'name'=> 'page-option-item-divider-text',

						'type'=> 'description',

						'hr'=> 'none',

						'description'=> "Add Divider in page"),				

				),

				'Tab' =>array(

				     'tab-widget'=>array(

						'title'=> __('Tab Widget Title', 'crunchpress'),

						'name'=> 'page-option-item-tab-widget',

						'type'=> 'inputtext'),

					'tab-item'=>array(

						'tab-num'=>'page-option-item-tab-num',

						'title'=>'page-option-item-tab-title',

						'caption'=>'page-option-item-tab-content',

						'active'=>'',

						'hr'=>'none')

				),				

				'Toggle-Box' =>array(

					'header'=>array(

						'title'=> __('HEADER TITLE', 'crunchpress'),

						'name'=> 'page-option-item-toggle-box-header-title',

						'type'=> 'inputtext'),

					'tab-item'=>array(

						'tab-num'=>'page-option-item-toggle-box-num',

						'title'=>'page-option-item-toggle-box-title',

						'caption'=>'page-option-item-toggle-box-content',

						'active'=>'page-option-item-toggle-box-active',

						'hr'=>'none')

				),

				'DonateNow' =>array(
					
					'description'=>array(

						'title'=>'DONATION DESCRIPTION OR HTML',

						'name'=>'page-option-item-donation-description',

						'type'=>'textarea',

						'hr'=>'none',

						'description'=>'Please enter the description text here.'),	
						
					'donate_button_text'=>array(

						'title'=>'DONATION BUTTON TEXT',

						'name'=>'page-option-item-donation-button',

						'type'=>'inputtext',

						'hr'=>'none',
						
						'default' => 'Donate Now',

						'description'=>'Please write text for donation button.'),
					
					'button-link'=>array(

						'title'=>'BUTTON LINK',

						'name'=>'page-option-item-donation-link',

						'type'=>'inputtext',

						'hr'=>'none',

						'description'=>'Please write text for donation button.'),						

				),
				
				'Contact-Form'=>array(

					'header'=>array(

						'title'=>'HEADER',

						'name'=>'page-option-item-header-email',

						'type'=>'inputtext',

						'hr'=>'none',

						'description'=>'Please write your contact form header title here.'),
					
					'email'=>array(

						'title'=>'E-MAIL',

						'name'=>'page-option-item-contat-email',

						'type'=>'inputtext',

						'hr'=>'none',

						'description'=>'Place the destination of the email when user submit the contact form here.'),

				),	
			)

		),
		
		
		"Page Sidebar Template" => array(

			'title'=> __('SELECT LAYOUT', 'crunchpress'), 

			'name'=>'page-option-sidebar-template', 
			
			'id'=>'page-option-sidebar-template', 

			'type'=>'radioimage', 

			'default'=>'no-sidebar',

			'hr'=>'none',

			'options'=>array(

				'1'=>array('value'=>'right-sidebar','image'=>'/framework/images/right-sidebar.png'),

				'2'=>array('value'=>'left-sidebar','image'=>'/framework/images/left-sidebar.png'),

				'3'=>array('value'=>'both-sidebar','image'=>'/framework/images/both-sidebar.png'),
				
				'4'=>array('value'=>'both-sidebar-left','image'=>'/framework/images/both-sidebar-left.png'),
				
				'5'=>array('value'=>'both-sidebar-right','image'=>'/framework/images/both-sidebar-right.png'),

				'6'=>array('value'=>'no-sidebar','image'=>'/framework/images/no-sidebar.png','default'=>'selected')

			)

		),

		

		"Choose Left Sidebar" => array(

			'title'=> __('CHOOSE LEFT SIDEBAR', 'crunchpress'),

			'name'=>'page-option-choose-left-sidebar',

			'type'=>'combobox',

			'hr'=>'none'

		),		

		

		"Choose Right Sidebar" => array(

			'title'=> __('CHOOSE RIGHT SIDEBAR', 'crunchpress'),

			'name'=>'page-option-choose-right-sidebar',

			'type'=>'combobox',

		),

		
		"Top Slider On" => array(

			'title'=> __('MAIN SLIDER', 'crunchpress'),

			'name'=>'page-option-top-slider-on',

			'options'=>array('0'=>'Yes','1'=>'No'),

			'type'=>'combobox',
			
			'default'=> 'No',

			'hr'=>'none',

			'description' => 'Turn on Main slider on page.'

		),		

		"Top Slider Open" => array( 'type'=>'open', 'id'=>'cp-top-slider-wrapper'),
		
		"Top Slider Type" => array(

			'title'=> __('TOP SLIDER TYPE', 'crunchpress'),

			'name'=>'page-option-top-slider-types',

			'options'=>array('0'=>'Bx-Slider','1'=>'Layer-Slider'),
			
			/*'options'=>array('0'=>'Anything','1'=>'Flex-Slider','2'=>'Bx-Slider','3'=>'Layer-Slider'),*/
			/*'options'=>array('0'=>'Anything','1'=>'Flex-Slider','2'=>'Default-Slider','3'=>'Layer-Slider'),*/
			/*'options'=>array('0'=>'Anything','1'=>'Flex-Slider','2'=>'Default-Slider'),*/

			'type'=>'combobox',
			
			'default' => 'no-slider',

			'hr'=>'none',

			'description' => 'Top slider is the slider under the main navigation menu and above the page template( so it will always be full width ).'

		),

		 // "Top-Slider-Height Open" => array( 'type'=>'open', 'id'=>'cp-top-slider-wrapper-height'),
		
		 // "Top Slider Height" => array(

			// 'title'=> __('TOP SLIDER HEIGHT', 'crunchpress'),

			// 'name'=>'page-option-top-slider-height',

			// 'type'=>'inputtext',
			
			// 'default' => 700,

			// 'hr'=>'none',

			// 'description' => 'Top slider Comes top of the page add height to it.'

		 // ),
		
		 // "Top-Slider-Height Close" => array( 'type'=>'close','id'=>'cp-top-slider-wrapper-height'),
		
		
		"Top-Slider-Images Open" => array( 'type'=>'open', 'id'=>'cp-top-slider-wrapper-image'),
		
		"Top Slider Images" => array(

			'title'=> __('TOP SLIDER SLIDE IMAGES', 'crunchpress'),

			'name'=>'page-option-top-slider-images',

			'options'=>array(),

			'type'=>'combobox_post',

			'hr'=>'none',

			'description' => 'Top slider Comes top of the page select image slide for default sliders..'

		),
		
		"Top-Slider-Images Close" => array( 'type'=>'close','id'=>'cp-top-slider-wrapper-image'),
		
		"Top-Slider-Layer Open" => array( 'type'=>'open', 'id'=>'cp-top-slider-wrapper-layer'),
		
		"Top Slider Layer" => array(

			'title'=> __('TOP LAYER SLIDER ID', 'crunchpress'),

			'name'=>'page-option-top-slider-layer',

			'options'=>array(),

			'type'=>'combobox',

			'hr'=>'none',

			'description' => 'Top Slider Layer Images Input Select Layer Slider Image Slide.'

		),
		
		"Top-Slider-Layer Close" => array( 'type'=>'close','id'=>'cp-top-slider-wrapper-layer'),

		"Top Slider Close" => array( 'type'=>'close','id'=>'cp-top-slider-wrapper'),
		
		"Top Content Close" => array( 'type'=>'close' ,'id'=>'cp-show-content-title-dd'),
		
		"StreetView-open" => array( 'type'=>'open','id'=>'cp-street-view-wrapper','name'=>'cp-street-view-wrapper'),
		
		"Map Type" => array(

			'title'=> __('Map Type', 'crunchpress'),

			'name'=>'page-option-map-type-on',

			'options'=>array('0'=>'Street View','1'=>'Map View'),

			'type'=>'combobox',
			
			'default'=> 'No',

			'hr'=>'none',

			'description' => 'Show Street View or Map View on Page.'

		),		
		
		"Location" => array(

			'title'=> __('Street View Location', 'crunchpress'),

			'name'=>'page-option-street-view-location',

			'options'=>array(),

			'type'=>'combobox',

			'hr'=>'none',

			'description' => 'Selection Location to show its view.'

		),
		
		"StreetView-aa" => array( 'type'=>'close','name'=>'cp-street-view-wrapper'),

	);

	

	// create Page Option Meta

	add_action('add_meta_boxes', 'add_page_option');

	function add_page_option(){

	

		add_meta_box('page-option', __('Page Option','crunchpress'), 'add_page_option_element',

			'page', 'normal', 'high');

	}

	function add_page_option_element(){

	

		global $post, $page_meta_boxes;

		

		//init array

		$page_meta_boxes['Page Item']['name']['Blog']['category']['options'] = get_category_list( 'category' );
		
		$page_meta_boxes['Page Item']['name']['News']['category']['options'] = get_category_list( 'category' );
		
		$page_meta_boxes['Page Item']['name']['News-Slider']['category']['options'] = get_category_list( 'category' );
		
		$page_meta_boxes['Page Item']['name']['Product-Slider']['category']['options'] = get_category_list( 'product_cat' );
		
		$page_meta_boxes['Page Item']['name']['Crowd-Funding']['category']['options'] = get_category_list( 'category' );
		
		$page_meta_boxes['Page Item']['name']['Our-Team']['select_feature']['options'] = get_title_list_array( 'teams' );

		$page_meta_boxes['Page Item']['name']['Gallery']['page']['options'] = get_title_list_array( 'gallery' );
		
		$page_meta_boxes['Page Item']['name']['Feature-Product']['category']['options'] = get_category_list( 'product_cat' );
		
		$page_meta_boxes['Page Item']['name']['Blog-Slider']['category']['options'] = get_category_list( 'category' );
		
		$page_meta_boxes['Page Item']['name']['Charity-Events']['video-gallery']['options'] = get_title_list_array( 'gallery' );
		
		$page_meta_boxes['Page Item']['name']['Charity-Events']['category']['options'] = get_category_list( 'event-category' );

		$page_meta_boxes['Page Item']['name']['Events']['category']['options'] = get_category_list( 'event-category' );
		
		$page_meta_boxes['Page Item']['name']['Product-Listing']['category']['options'] = get_category_list( 'product_cat' );
		
		$page_meta_boxes['Page Item']['name']['Feature-Project']['project']['options'] = get_title_list_array( 'ignition_product' );

		//$page_meta_boxes['Page Item']['name']['Testimonial']['category']['options'] = get_category_list( 'testimonial-category' );

		//$page_meta_boxes['Page Item']['name']['Testimonial']['specific']['options'] = get_title_list( 'testimonial' );
		
		$page_meta_boxes['Page Item']['name']['Slider']['slider-slide']['options'] = get_title_list_array('cp_slider');
		
		$page_meta_boxes['Page Item']['name']['Venue']['location']['options'] = get_title_list_array( 'event_location' );
		
		$page_meta_boxes['Page Item']['name']['Career']['category']['options'] = get_category_list( 'career-category' );
		
		$page_meta_boxes['Gallery Slideshow']['options'] = get_title_list_array('gallery');

		$page_meta_boxes['Choose Left Sidebar']['options'] = get_sidebar_name();

		$page_meta_boxes['Choose Right Sidebar']['options'] = $page_meta_boxes['Choose Left Sidebar']['options'];
		
		$page_meta_boxes['Top Slider Images']['options'] = get_title_list_array('cp_slider');
		
		$page_meta_boxes['Top Slider Layer']['options'] = layer_slider_id();
		
		$page_meta_boxes['Page Item']['name']['Slider']['slider-slide-layer']['options'] = layer_slider_id();

		echo '<div id="cp-overlay-wrapper">';

		echo '<div id="cp-overlay-content">';

		

		set_nonce();

		

		//get value

		foreach( $page_meta_boxes as $page_meta_box ){

		

			if( $page_meta_box['type'] == 'page-option-item' ){

			

				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['xml'], true);
				
				print_page_default_elements($page_meta_box);
				
				print_page_selected_elements($page_meta_box);

			}

			elseif( $page_meta_box['type'] == 'sidebar' ){ echo 'ok'; die;

				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['xml'], true);
				
				print_page_default_elements($page_meta_box);
				
				print_page_selected_elements($page_meta_box);
				

				echo 'ok';

				

			}else if( $page_meta_box['type'] == 'imagepicker' ){

			

				$slider_xml_string = get_post_meta($post->ID, $page_meta_box['xml'], true);

				if(!empty($slider_xml_string)){

				

					$slider_xml_val = new DOMDocument();

					$slider_xml_val->loadXML( $slider_xml_string );

					$page_meta_box['value'] = $slider_xml_val->documentElement;

					

				}

				print_meta( $page_meta_box );

			

			}else{

				

				if( empty( $page_meta_box['name'] ) ){ $page_meta_box['name'] = ''; }

				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['name'], true);

				print_meta( $page_meta_box );

			

			}

			echo "<div class='clear'></div>";

			echo empty($page_meta_box['hr'])? '<hr class="separator mt20">': '';

		

		}		

		echo '</div>';

		echo '</div>';

		

	}

	

	// call when update page with save_post action 

	function save_page_option_meta($post_id){

	

		global $page_meta_boxes;

		$edit_meta_boxes = $page_meta_boxes;

		

		foreach ($edit_meta_boxes as $edit_meta_box){

			if( $edit_meta_box['type'] == 'page-option-item' ){

				if(isset($_POST[$edit_meta_box['size']])){

					$num = sizeof($_POST[$edit_meta_box['size']]);

				}else{

					$num = 0;

				}

				

				$item_xml = '<item-tag>';

				$item_content_num = array();

				for($i=0; $i<$num; $i++){

				

					$item_type_new = $_POST[$edit_meta_box['item']][$i];

					$item_xml = $item_xml . '<' . $item_type_new . '>';

					$item_size_new = $_POST[$edit_meta_box['size']][$i];

					$item_xml = $item_xml . create_xml_tag('size',$item_size_new);

					$item_content = $edit_meta_box['name'][$item_type_new];

					if(!isset($item_content_num[$item_type_new])){

						$item_content_num[$item_type_new] = 1 ;

						if($item_type_new == 'Slider'){

							$item_content_num['slider-item'] = 0;

						}else if($item_type_new == 'Accordion'){

							$item_content_num['accordion-item'] = 0;

						}else if($item_type_new == 'Tab'){

							$item_content_num['tab-item'] = 0;

						}else if($item_type_new == 'Toggle-Box'){

							$item_content_num['toggle-box-item'] = 0;

						}

					}

					

					foreach($item_content as $key => $value){

					

						if($key == 'slider-item'){

					

							$item_xml = $item_xml . '<' . $key . '>';

							$slider_num = $_POST[$value['slider-num']][$item_content_num[$item_type_new]];

							for($j=0; $j<$slider_num; $j++){

								$item_xml = $item_xml . '<slider>';

								$temp = isset( $_POST[$value['image']][$item_content_num['slider-item']] )? $_POST[$value['image']][$item_content_num['slider-item']] : '';

								$item_xml = $item_xml . create_xml_tag('image', $temp);

								$temp = isset( $_POST[$value['title']][$item_content_num['slider-item']] )? htmlspecialchars($_POST[$value['title']][$item_content_num['slider-item']]) : '';

								$item_xml = $item_xml . create_xml_tag('title', $temp);

								$temp = isset( $_POST[$value['linktype']][$item_content_num['slider-item']] )? $_POST[$value['linktype']][$item_content_num['slider-item']] : '';

								$item_xml = $item_xml . create_xml_tag('linktype', $temp);

								$temp = isset( $_POST[$value['link']][$item_content_num['slider-item']] )? htmlspecialchars($_POST[$value['link']][$item_content_num['slider-item']]) : '';

								$item_xml = $item_xml . create_xml_tag('link', $temp);

								$temp = isset( $_POST[$value['caption']][$item_content_num['slider-item']] )? htmlspecialchars($_POST[$value['caption']][$item_content_num['slider-item']]) : '';

								$item_xml = $item_xml . create_xml_tag('caption', $temp);

								$item_xml = $item_xml . '</slider>';

								$item_content_num['slider-item']++; 

								

							}

							

							$item_xml = $item_xml . '</' . $key . '>';

						}else if($key == "tab-item"){

							$item_xml = $item_xml . '<' . $key . '>';

							if($item_type_new == "Accordion"){

								$tab_type = 'accordion-item';

							}else if($item_type_new == "Toggle-Box"){

								$tab_type = 'toggle-box-item';

							}else{

								$tab_type = 'tab-item';

							}



							$tab_num = $_POST[$value['tab-num']][$item_content_num[$item_type_new]];

							

							for($j=0; $j<$tab_num; $j++){

								$item_xml = $item_xml . '<tab>';

								$temp = isset( $_POST[$value['title']][$item_content_num[$tab_type]] )? htmlspecialchars($_POST[$value['title']][$item_content_num[$tab_type]]) : '';

								$item_xml = $item_xml . create_xml_tag('title', $temp);

								$temp = isset( $_POST[$value['caption']][$item_content_num[$tab_type]] )? htmlspecialchars($_POST[$value['caption']][$item_content_num[$tab_type]]) : '';

								$item_xml = $item_xml . create_xml_tag('caption', $temp);

								$temp = isset( $_POST[$value['active']][$item_content_num[$tab_type]] )? $_POST[$value['active']][$item_content_num[$tab_type]] : '';

								$item_xml = $item_xml . create_xml_tag('active', $temp);

								$item_xml = $item_xml . '</tab>';

								$item_content_num[$tab_type]++;

							}

							

							$item_xml = $item_xml . '</' . $key . '>';

							

						}else{

						

							if(isset($_POST[$value['name']][$item_content_num[$item_type_new]])){

							

								$item_value = htmlspecialchars($_POST[$value['name']][$item_content_num[$item_type_new]]);

								$item_xml = $item_xml .  create_xml_tag($key, $item_value);

							}else{

								$item_xml = $item_xml .  create_xml_tag($key, '');

							}

						}

					}

					

					$item_xml = $item_xml . '</' . $item_type_new . '>';

					$item_content_num[$item_type_new]++;

					

				}

				

				$item_xml = $item_xml . '</item-tag>';

				$item_xml_old = get_post_meta($post_id, $edit_meta_box['xml'], true);

				save_meta_data($post_id, $item_xml, $item_xml_old, $edit_meta_box['xml']);

				

			}else if( $edit_meta_box['type'] == 'imagepicker' ){

				if(isset($_POST[$edit_meta_box['name']['image']])){

					$num = sizeof($_POST[$edit_meta_box['name']['image']]) - 1;

				}else{

					$num = -1;

				}

				

				$slider_xml_old = get_post_meta($post_id,$edit_meta_box['xml'],true);

				$slider_xml = "<slider-item>";

				

				for($i=0; $i<=$num; $i++){

					$slider_xml = $slider_xml. "<slider>";

					$image_new = stripslashes($_POST[$edit_meta_box['name']['image']][$i]);

					$slider_xml = $slider_xml. create_xml_tag('image',$image_new);

					$title_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['title']][$i]));

					$slider_xml = $slider_xml. create_xml_tag('title',$title_new);

					$caption_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['caption']][$i]));

					$slider_xml = $slider_xml. create_xml_tag('caption',$caption_new);

					$linktype_new = stripslashes($_POST[$edit_meta_box['name']['linktype']][$i]);

					$slider_xml = $slider_xml. create_xml_tag('linktype',$linktype_new);

					$link_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['link']][$i]));

					$slider_xml = $slider_xml. create_xml_tag('link',$link_new);

					$slider_xml = $slider_xml . "</slider>";

				}

				

				$slider_xml = $slider_xml . "</slider-item>";

				save_meta_data($post_id, $slider_xml, $slider_xml_old, $edit_meta_box['xml']);

					

			}else if($edit_meta_box['type'] == 'open' || $edit_meta_box['type'] == 'close'){

			

			}else{

				if(isset($_POST[$edit_meta_box['name']])){

					$new_data = stripslashes($_POST[$edit_meta_box['name']]);

				}else{

					$new_data = '';

				}

				$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);

				save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);				

			}

		}

	}

	

	

	// print all elements that can be added to selected elements

	function print_page_default_elements($args){

						extract($args);

		

		?>
<div class="meta-body custom_page">
  <div class="meta-title">
    <label>
      <?php _e('Click On Element To Drop in Placeholder:', 'crunchpress'); ?>
    </label>
  </div>
  
  <!-- Select Item List -->
  <?php
	$content_element = $name;
	unset($content_element['Services']);
	unset($content_element['Accordion']);
	unset($content_element['Product-Slider']);	
	unset($content_element['Blog-Slider']);
	unset($content_element['News-Slider']);
	unset($content_element['Slider']);
	unset($content_element['Column']);
	unset($content_element['Divider']);
	unset($content_element['Tab']);
	unset($content_element['Toggle-Box']);
	unset($content_element['DonateNow']);
	unset($content_element['Contact-Form']);
	unset($content_element['Feature-Project']);
	unset($content_element['Feature-Product']);
	
	if(!class_exists("Woocommerce")){
		unset($content_element['Product-Listing']);
	}
	if(!class_exists("Product_Widget")){
		unset($content_element['Crowd-Funding']);
		
	}
	
	$content_shortcode = $name;
	unset($content_shortcode['Content']);
	unset($content_shortcode['Blog']);
	unset($content_shortcode['News']);
	unset($content_shortcode['Our-Team']);
	unset($content_shortcode['Career']);
	unset($content_shortcode['Gallery']);
	unset($content_shortcode['Events']);
	unset($content_shortcode['Venue']);
	unset($content_shortcode['Charity-Events']);
	unset($content_shortcode['Product-Listing']);
	unset($content_shortcode['Crowd-Funding']);
	unset($content_shortcode['Contact-Form']);
	
	if(!class_exists("Woocommerce")){
		unset($content_shortcode['Product-Slider']);
		unset($content_shortcode['Feature-Product']);
	}
	if(!class_exists("Product_Widget")){
		unset($content_shortcode['Feature-Project']);
	}
	
	
	$content_element_form = $name;
	unset($content_element_form['Content']);
	unset($content_element_form['Blog']);
	unset($content_element_form['News']);
	unset($content_element_form['Our-Team']);
	unset($content_element_form['Career']);
	unset($content_element_form['Gallery']);
	unset($content_element_form['Events']);
	unset($content_element_form['Venue']);
	unset($content_element_form['Charity-Events']);
	unset($content_element_form['Feature-Product']);
	unset($content_element_form['Product-Listing']);
	unset($content_element_form['Crowd-Funding']);
	unset($content_element_form['Services']);
	unset($content_element_form['Accordion']);
	unset($content_element_form['Product-Slider']);
	unset($content_element_form['Blog-Slider']);
	unset($content_element_form['News-Slider']);
	unset($content_element_form['Slider']);
	unset($content_element_form['Column']);
	unset($content_element_form['Divider']);
	unset($content_element_form['Tab']);
	unset($content_element_form['Toggle-Box']);
	unset($content_element_form['DonateNow']);
	unset($content_element_form['Feature-Project']);
	

  ?>
  <div class="meta-input">
    <div class="page-select-element-list-wrapper combobox box-one">
		<div class="title_backend"><h2>Custom Post/ Content</h2></div>
		  <ul class="element_backend"><?php foreach( $content_element as $key => $value ){?>
			<li class="drag_able"><a class="dragable" id="" rel="<?php echo $key;?>"><?php echo $key;?></a></li>
		  <?php }?>
		  </ul>
    </div>
	<div class="page-select-element-list-wrapper combobox box-one">
	<div class="title_backend"><h2>Forms / Elements</h2></div>
	   <ul class="element_backend">
	  <?php foreach( $content_element_form as $key => $value ){?>
		<li class="drag_able"><a class="dragable" id="" rel="<?php echo $key;?>"><?php echo $key;?></a></li>
	  <?php }?>
	  </ul>
    </div>
    <div class="page-select-element-list-wrapper combobox box-one">
	<div class="title_backend"><h2>Shortcodes</h2></div>
	   <ul class="element_backend">
	  <?php foreach( $content_shortcode as $key => $value ){?>
		<li class="drag_able"><a class="dragable" id="" rel="<?php echo $key;?>"><?php echo $key;?></a></li>
	  <?php }?>
	  </ul>
    </div>
    <br class="clear">
  </div>
  <br class="clear">
</div>

<!-- Default Item to Clone to-->

<div class="page-element-lists" id="page-element-lists">
  <?php

					foreach( $name as $key => $value ){

						print_page_elements($args, '', $key);					

					}

				?>
  <br class="clear">
</div>
<?php

	}

	

	// chosen elements

	function print_page_selected_elements($args){	

		    extract($args);

		

		?>
<div class="page-methodology" id="page-methodology">
  <div class="page-selected-elements-wrapper">
    <div class="page-selected-elements page-no-sidebar" id="page-selected-elements">
<div id="selected-image-none" class="bg_title_drop">Drop Elements Here</div>

      <?php

						if($value != ''){

							$xml = new DOMDocument();

							$xml->loadXML($value);
							$counter_xml = 0;
							foreach($xml->documentElement->childNodes as $item){
								$counter_xml++;
									print_page_elements($args, $item, $item->nodeName);
							}

						}

					?>
    </div>
    <br class="clear">
  </div>
</div>
<?php

		

	}

	

	// function that manage to print each elements from receiving arguments

	function print_page_elements($args, $xml_val, $item_type){

		$element1_2 = '';

		extract($args);

		

		//echo "<pre>";print_r($name['Widget']);

		$head_type = $item_type;

		if(empty($xml_val)){

			$head_size = '';

			$head_name = array('item'=>$item,'size'=>$size,'itemname'=>'','sizename'=>'');

		}else{

			$head_size = find_xml_value($xml_val, 'size');

			$head_name = array('item'=>$item,'size'=>$size,'itemname'=>$item.'[]','sizename'=>$size.'[]');

		}

		

		print_page_item_identical($head_name, $head_size, $head_type);

		?>
<div class="page-element-edit-box" id="page-element-edit-box">
  <?php

				foreach( $name[$item_type] as $input_key => $input_value ){

					

					if( $input_key == 'slider-item' ){

						$slider_value = find_xml_node($xml_val, 'slider-item');

						print_image_picker( array('name'=>$input_value, 'value'=>$slider_value ) );

					  }else if( $input_key == 'tab-item' ){

							   print_box_tab($input_value, find_xml_node($xml_val, 'tab-item'));

				      }else if( $input_key == 'haji-item' ){

							   print_panel_sidebar('lol',$input_value);

				      }else{

					    $input_value['value'] = find_xml_value($xml_val, $input_key);

						$input_value['name'] = $input_value['name'] . '[]';

						print_meta( $input_value );

					}

					if( ( $input_key!= 'open' && $input_key != 'close') ){

						echo ( empty($input_value['hr']) )? '<hr class="separator mt20">': '';

					}

				}

			?>
</div>
</div>
<?php

		

	}

	

	// print the identical part of Page Item 

	function print_page_item_identical($item, $size, $text){

		global $div_size;

		if(empty( $size )) { 

			foreach( $div_size[$text] as $key => $val ){

				$size = $key; 

				break;

			}

		} 

						

		?>
<div class="page-element <?php echo $size; ?>" id="page-element" rel="<?php echo $text; ?>">
  <div class="page-element-item" id="page-element-item" >
    <div class="item-bar-left">
      <div class="change-element-size-temp">
        <div class="add-element-size" id="add-element-size" ></div>
        <div class="sub-element-size" id="sub-element-size" ></div>
      </div>
    </div>
    <span class="page-element-item-text"> <?php echo $text; ?> </span>
    <input type="hidden" id="<?php echo $item['item'];?>" class="<?php echo $item['item'];?>" value="<?php echo $text; ?>" name="<?php echo $item['itemname'];?>">
    <input type="hidden" id="<?php echo $item['size'];?>" class="<?php echo $item['size'];?>" value="<?php echo $size; ?>" name="<?php echo $item['sizename'];?>">
    <div class="item-bar-right">
      <div class="element-size-text" id="element-size-text"><?php echo $div_size[$text][$size]; ?></div>
      <div class="change-element-property"> <a title="Edit">
        <div rel="cp-edit-box" id="page-element-edit-box" class="edit-element"></div>
        </a> <a title="Delete">
        <div class="delete-element" id="delete-element"></div>
        </a> </div>
    </div>
  </div>
  <?php

		

	}

	

	//Print exceptional input element ( from meta-template )

	function print_box_tab($name, $values){

	

		?>
  <div class="meta-body">
    <div class="meta-title meta-tab">ADD MORE TABS</div>
    <div id="page-tab-add-more" class="page-tab-add-more" />
  </div>
  <br class="clear">
  <div class="meta-input">
    <input type='hidden' class="tab-num" id="tab-num" name='<?php echo $name['tab-num']; ?>[]' value=<?php 

					echo empty($values)? 0: $values->childNodes->length;

				?> />
    <div class="added-tab" id="added-tab">
      <ul>
        <li id="page-item-tab" class="default">
          <div class="meta-title meta-tab-title">TABS TITLE</div>
          <input type="text"  id='<?php echo $name['title']; ?>' />
          <br>
          <div class="meta-title meta-tab-title">TABS TEXT</div>
          <textarea id='<?php echo $name['caption']; ?>' ></textarea>
          <br>
          <?php if(!empty($name['active'])){ ?>
          <div class="meta-title meta-tab-title">Tabs Active</div>
          <div class="combobox">
            <select id='<?php echo $name['active']; ?>' >
              <option>Yes</option>
              <option selected>No</option>
            </select>
          </div>
          <?php } ?>
          <div id="unpick-tab" class="unpick-tab"></div>
        </li>
        <?php

							

							if(!empty($values)){

								foreach ($values->childNodes as $tab){ 

							?>
        <li id="page-item-tab" class="page-item-tab">
          <div class="meta-title meta-tab-title">TABS TITLE</div>
          <input type="text" name='<?php echo $name['title']; ?>[]' id='<?php echo $name['title']; ?>' value="<?php echo find_xml_value($tab, 'title'); ?>" />
          <br>
          <div class="meta-title meta-tab-title">TABS TEXT</div>
          <textarea name='<?php echo $name['caption']; ?>[]' id='<?php echo $name['caption']; ?>' ><?php echo find_xml_value($tab, 'caption'); ?></textarea>
          <br>
          <div id="unpick-tab" class="unpick-tab"></div>
          <?php if(!empty($name['active'])){ ?>
          <?php $is_active = find_xml_value($tab, 'active'); ?>
          <div class="meta-title meta-tab-title">Tabs Active</div>
          <div class="combobox">
            <select id='<?php echo $name['active']; ?>' name='<?php echo $name['active']; ?>[]' >
              <option <?php if($is_active=='Yes'){ echo 'selected'; } ?>>Yes</option>
              <option <?php if($is_active!='Yes'){ echo 'selected'; } ?>>No</option>
            </select>
          </div>
          <?php } ?>
        </li>
        <?php

							

								}

							}

						?>
      </ul>
      <br class=clear>
    </div>
  </div>
  <br class=clear>
</div>
<?php

		

	}

	

	// sidebar => name, value

	function print_panel_sidebar($title, $values){

	

		extract($values);

		

		?>
<div class="panel-body" id="panel-body">
  <div class="panel-body-gimmick"></div>
  <div class="panel-title">
    <label>
      <?php echo $title; ?>
    </label>
  </div>
  <div class="panel-input">
    <input type="text" id="add-more-sidebar" value="type title here" rel="type title here">
    <div id="add-more-sidebar" class="add-more-sidebar"></div>
  </div>
  <?php if(isset($description)){ ?>
  <div class="panel-description">
    <?php echo $description; ?>
  </div>
  <?php } ?>
  <br class="clear">
  <div id="selected-sidebar" class="selected-sidebar">
    <div class="default-sidebar-item" id="sidebar-item">
      <div class="panel-delete-sidebar"></div>
      <div class="slider-item-text"></div>
      <input type="hidden" id="<?php echo $name; ?>">
    </div>
    <?php 

				

				if(!empty($value)){

					

					$xml = new DOMDocument();

					$xml->loadXML($value);

					

					foreach( $xml->documentElement->childNodes as $sidebar_name ){

					

				?>
    <div class="sidebar-item" id="sidebar-item">
      <div class="panel-delete-sidebar"></div>
      <div class="slider-item-text"><?php echo $sidebar_name->nodeValue; ?></div>
      <input type="hidden" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo $sidebar_name->nodeValue; ?>">
    </div>
    <?php 

					} 

					

				} 

				

				?>
  </div>
</div>
<?php 

		

	}
