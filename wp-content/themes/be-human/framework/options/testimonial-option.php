<?php

	/*	
	*	CrunchPress Portfolio Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file create and contains the portfolio post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	add_action( 'init', 'create_testimonial' );
	function create_testimonial() {
	
		$labels = array(
			'name' => _x('Testimonial', 'Testimonial General Name', 'crunchpress'),
			'singular_name' => _x('Testimonial Item', 'Testimonial Singular Name', 'crunchpress'),
			'add_new' => _x('Add New', 'Add New Testimonial Name', 'crunchpress'),
			'add_new_item' => __('Author Name', 'crunchpress'),
			'edit_item' => __('Author Name', 'crunchpress'),
			'new_item' => __('New Testimonial', 'crunchpress'),
			'view_item' => '',
			'search_items' => __('Search Testimonial', 'crunchpress'),
			'not_found' =>  __('Nothing found', 'crunchpress'),
			'not_found_in_trash' => __('Nothing found in Trash', 'crunchpress'),
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon' => CP_PATH_URL . '/framework/images/testimonial-icon.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			"show_in_nav_menus" => false,
			'exclude_from_search' => true,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments')
		); 
		  
		register_post_type( 'testimonial' , $args);
		
		register_taxonomy(
			"testimonial-category", array("testimonial"), array(
				"hierarchical" => true, 
				"label" => "Testimonial Categories", 
				"singular_label" => "Testimonial Categories", 
				"show_in_nav_menus" => false,
				"rewrite" => true));
		register_taxonomy_for_object_type('testimonial-category', 'testimonial');
		
	}
	
	// add table column in edit page
	add_filter("manage_edit-testimonial_columns", "show_testimonial_column");	
	function show_testimonial_column($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"author" => "Author",
			"testimonial-category" => "Testimonial Categories",
			"date" => "date");
		return $columns;
	}
	add_action("manage_posts_custom_column","testimonial_custom_columns");
	function testimonial_custom_columns($column){
		global $post;

		switch ($column) {
			case "testimonial-category":
			echo get_the_term_list($post->ID, 'testimonial-category', '', ', ','');
			break;
		}
	}
	
	$testimonial_meta_boxes = array(	
		"Author Position" => array(
			'title'=> __('AUTHOR POSITION', 'crunchpress'),
			'name'=>'testimonial-option-author-position',
			'type'=>'inputtext')
	);
	
	add_action('add_meta_boxes', 'add_testimonial_option');
	function add_testimonial_option(){	
	
		add_meta_box('testimonial-option', __('Testimonial Option','crunchpress'), 'add_testimonial_option_element',
			'testimonial', 'normal', 'high');
			
	}
	
	function add_testimonial_option_element(){
	
		global $post, $testimonial_meta_boxes;
		echo '<div id="cp-overlay-wrapper">';
		
		?> <div class="testimonial-option-meta" id="testimonial-option-meta"> <?php
			set_nonce();
			foreach($testimonial_meta_boxes as $meta_box){
		    $meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
				print_meta($meta_box);
			}
		?> </div> <?php
		
		echo '</div>';
		
	}
	
	function save_testimonial_option_meta($post_id){
		global $testimonial_meta_boxes;
		$edit_meta_boxes = $testimonial_meta_boxes;
				// save
		foreach ($edit_meta_boxes as $edit_meta_box){
			if(isset($_POST[$edit_meta_box['name']])){	
				$new_data = stripslashes($_POST[$edit_meta_box['name']]);		
			}else{
				$new_data = '';
			}
			$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
			save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
		}
	}
?>