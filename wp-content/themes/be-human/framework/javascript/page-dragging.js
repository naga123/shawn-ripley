/**
 *	CrunchPress Page Dragging File
 *	---------------------------------------------------------------------
 * 	@version	1.0
 * 	@author		CrunchPress
 * 	@link		http://crunchpress.com
 * 	@copyright	Copyright (c) CrunchPress
 * 	---------------------------------------------------------------------
 * 	This file contains the jQuery script for Page Dragging
 *	---------------------------------------------------------------------
 */
jQuery(document).ready(function () {

    // All of size that div can be (text, class, value)
    var DIV_SIZE = [
        ['1/4', 'element1-4', 1 / 4, ['Services','Column', 'Gallery', 'Contact-Form', 'Content', 'Page', 'Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box','Venue','Blog-Slider','Feature-Project','Feature-Product']],
        ['1/3', 'element1-3', 1 / 3, ['Services','Column', 'Gallery', 'Contact-Form', 'Content', 'Page', 'Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box','Venue','Blog-Slider','Feature-Project','Feature-Product']],
        ['1/2', 'element1-2', 1 / 2, ['Services','DonateNow', 'Contact-Form', 'Column', 'Gallery', 'Content', 'News', 'Events', 'Blog', 'Page', 'Testimonial', 'Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box', 'Services-Widget','Venue','News-Slider','Blog-Slider','Feature-Project','Feature-Product']],
        ['2/3', 'element2-3', 2 / 3, ['Services','Column', 'Gallery', 'Contact-Form', 'Content', 'Page', 'Testimonial', 'Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box','Venue','Blog-Slider','Feature-Project','Feature-Product']],
        ['3/4', 'element3-4', 3 / 4, ['Services','Column', 'Gallery', 'Contact-Form', 'Content', 'Page', 'Testimonial', 'Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box','Venue','Blog-Slider','Feature-Project','Feature-Product']],
        ['1/1', 'element1-1', 1, ['Services','DonateNow', 'Column', 'Gallery', 'Content', 'Blog', 'Page', 'Events', 'News', 'Testimonial', 'Slider', 'Accordion', 'Tab', 'Divider', 'Message-Box', 'Toggle-Box', 'Text-Widget', 'Contact-Form','Venue','News-Slider','Product-Listing','Blog-Slider','Feature-Project','Feature-Product']],
    ];

    var page_item_list = jQuery("#page-element-lists");
    var page_methodology = jQuery('#page-methodology');
    var page_alignment_val = '';

    //Bind sidebar template option
    jQuery('input[name="page-option-sidebar-template"]').change(function () {
        jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
        jQuery(this).siblings("label").children("#check-list").addClass("check-list");
        if (jQuery(this).val() == "left-sidebar") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideDown();
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideUp();
        } else if (jQuery(this).val() == "right-sidebar") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideUp();
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideDown();
        } else if (jQuery(this).val() == "both-sidebar") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideDown();
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideDown();
        } else if (jQuery(this).val() == "both-sidebar-left") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideDown();
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideDown();
        } else if (jQuery(this).val() == "both-sidebar-right") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideDown();
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideDown();
        } else {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideUp();
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideUp();
        }
    });
    jQuery('input[name="page-option-sidebar-template"]:checked').triggerHandler("change");

    // Change the style of <select>
    if (!jQuery.browser.opera) {
        jQuery('.meta-input .combobox select').each(function () {
            var title = jQuery(this).attr('title');
            if (jQuery('option:selected', this).val() != '') title = jQuery('option:selected', this).text();
            jQuery(this)
                .css({
                'z-index': 10,
                'opacity': 0,
                '-khtml-appearance': 'none'
            })
                .after('<span rel="combobox">' + title + '</span>')
                .change(function () {
                val = jQuery('option:selected', this).text();
                jQuery(this).next().text(val);
            })
        });
    };

    //Bind the delete element button
    var init_object = jQuery("div#cp-overlay-wrapper");
    init_object.find(".delete-element").click(function () {

        var deleted_element = jQuery(this).parents('#page-element');

        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_element.fadeOut(function () {
                            jQuery(this).remove();
                        });
                    }
                },
                'Cancel': {
                    'class': 'confirm-no',
                    'action': function () {
                        return false;
                    }
                }
            }
        });
    });

    //Add Element Size
    init_object.find(".add-element-size").click(function () {
        jQuery(this).cpPageAddElementSize();
    });
    jQuery.fn.cpPageAddElementSize = function () {
        var click_object = jQuery(this).parents('#page-element');
        var object_type = click_object.attr('rel');
        var is_upper_style = false;
        var current_style = '';
        for (var i = 0; i < DIV_SIZE.length - 1; i++) {
            if (click_object.hasClass(DIV_SIZE[i][1])) {
                is_upper_style = true;
                current_style = DIV_SIZE[i][1];
            }
            if (is_upper_style && jQuery.inArray(object_type, DIV_SIZE[i + 1][3]) > -1) {
                if (i < DIV_SIZE.length - 2) {
                    click_object.removeClass(current_style).addClass(DIV_SIZE[i + 1][1]);
                    click_object.find("#element-size-text").html(DIV_SIZE[i + 1][0]);
                    click_object.find("#page-option-item-size").val(DIV_SIZE[i + 1][1])
                } else if (i == DIV_SIZE.length - 2) {
                    click_object.removeClass(current_style).addClass(DIV_SIZE[i + 1][1]);
                    click_object.find("#element-size-text").html(DIV_SIZE[i + 1][0]);
                    click_object.find("#page-option-item-size").val(DIV_SIZE[i + 1][1])
                }
                break;
            }
        }
    }

    //Subtract Element size
    init_object.find(".sub-element-size").click(function () {
        jQuery(this).cpPageSubElementSize();
    });
    jQuery.fn.cpPageSubElementSize = function () {
        var click_object = jQuery(this).parents('#page-element');
        var object_type = click_object.attr('rel');
        var is_lower_style = false;
        var current_style = '';
        for (var i = DIV_SIZE.length - 1; i > 0; i--) {
            if (click_object.hasClass(DIV_SIZE[i][1])) {
                is_lower_style = true;
                current_style = DIV_SIZE[i][1];
            }
            if (is_lower_style && jQuery.inArray(object_type, DIV_SIZE[i - 1][3]) > -1) {
                if (i > 1) {
                    click_object.removeClass(current_style).addClass(DIV_SIZE[i - 1][1]);
                    click_object.find("#element-size-text").html(DIV_SIZE[i - 1][0]);
                    click_object.find("#page-option-item-size").val(DIV_SIZE[i - 1][1])
                } else if (i == 1) {
                    click_object.removeClass(current_style).addClass(DIV_SIZE[i - 1][1]);
                    click_object.find("#element-size-text").html(DIV_SIZE[i - 1][0]);
                    click_object.find("#page-option-item-size").val(DIV_SIZE[i - 1][1])
                }
                break;
            }
        }
    }

    //Bind Add Items
    jQuery("a.dragable").click(function () {
        //var selectd_list = jQuery(this).siblings(".page-select-element-list-wrapper").children("select");
        var selectd_list = jQuery(this).text();

        var clone_item = page_item_list.find('div[rel="' + selectd_list + '"]').clone(true);
        if (clone_item) {
            clone_item.find("#page-option-item-size").attr('name', function () {
                return jQuery(this).attr('id') + '[]';
            });
            clone_item.find("#page-option-item-type").attr('name', function () {
                return jQuery(this).attr('id') + '[]';
            });
            clone_item.css("display", "none");
			page_methodology.find("#page-selected-elements").find('.bg_title_drop').remove();
            page_methodology.find("#page-selected-elements").append(clone_item);
            page_methodology.find(".page-element").fadeIn();
        }
    });
	var selected_element = page_methodology.find("#page-selected-elements").find('#page-element').attr('id');
	if(selected_element == 'page-element'){
		page_methodology.find("#page-selected-elements").find('.bg_title_drop').remove();
	}
    page_methodology.find("#page-selected-elements").sortable({
        forcePlaceholderSize: true,
        placeholder: 'placeholder'
    });

    //jQuery("a[rel='dd']").click(function(){jQuery("input#page-add-item-button").click(function(){
    //var selectd_list = jQuery(this).siblings(".page-select-element-list-wrapper").children("select");
    //var selectd_list = jQuery(this).text();

    //var clone_item = page_item_list.find('div[rel="' + selectd_list + '"]').clone(true);
    //if( clone_item ){
    //clone_item.find("#page-option-item-size").attr('name',function(){
    //return jQuery(this).attr('id')+ '[]';
    //});
    //clone_item.find("#page-option-item-type").attr('name',function(){
    //return jQuery(this).attr('id')+ '[]';
    //});
    //clone_item.css("display","none");
    //page_methodology.find("#page-selected-elements").append(clone_item);
    //page_methodology.find(".page-element").fadeIn();
    //}
    //});

    //page_methodology.find("#page-selected-elements").sortable({ forcePlaceholderSize: true, placeholder: 'placeholder' });


    // Button effects;
    jQuery(".add-element-size").hover(function () {
        jQuery(this).addClass("add-element-size-hover");
    }, function () {
        jQuery(this).removeClass("add-element-size-hover");
    });
    jQuery(".sub-element-size").hover(function () {
        jQuery(this).addClass("sub-element-size-hover");
    }, function () {
        jQuery(this).removeClass("sub-element-size-hover");
    });

    // Tab chooser
    jQuery('.page-item-tab').css('display', 'block');
    jQuery(".page-tab-add-more").click(function () {
        var added_tab = jQuery(this).siblings(".meta-input").children("#added-tab");
        var clone_tab = added_tab.find(".default").clone(true);
        clone_tab.attr('class', 'page-item-tab');
        clone_tab.find('input, textarea, select').attr('name', function () {
            return jQuery(this).attr('id') + '[]';
        });
        added_tab.siblings("#tab-num").val(function () {
            return parseInt(jQuery(this).val()) + 1;
        });
        added_tab.children("ul").append(clone_tab);
        added_tab.find('.page-item-tab').slideDown();

    });
    jQuery(".unpick-tab").click(function () {
        var deleted_tab = jQuery(this);

        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_tab.parents('#page-item-tab').slideUp(function () {
                            jQuery(this).remove();
                        });
                        deleted_tab.parents("#added-tab").siblings("#tab-num").val(function () {
                            return parseInt(jQuery(this).val()) - 1;
                        });
                    }
                },
                'Cancel': {
                    'class': 'confirm-no',
                    'action': function () {
                        return false;
                    }
                }
            }
        });
    });

    // Link type of slider

    // Bind No Top Slider
    jQuery('select#page-option-top-slider-types').change(function () {
        if (jQuery(this).val() == '') {
           jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-image').slideUp();
            jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-layer').slideUp();
			jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-height').slideUp();
        } else if (jQuery(this).val() == 'Layer-Slider') {
            jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-image').slideUp();
            jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-layer').slideDown();
			jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-height').slideUp();
        }else if (jQuery(this).val() == 'Bx-Slider') {
            jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-image').slideDown();
            jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-layer').slideUp();
			jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-height').slideDown();
        } else {
             jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-image').slideDown();
            jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-layer').slideUp();
			jQuery(this).parents('.meta-body').siblings('#cp-top-slider-wrapper-height').slideUp();
        }
    });
   
     var selected_class = jQuery("select#page-option-top-slider-types option:selected").attr("rel");
    if (selected_class == 'Layer-Slider') {
        jQuery('#cp-top-slider-wrapper-image').slideUp();
		jQuery('#cp-top-slider-wrapper-layer').slideDown();
		jQuery('#cp-top-slider-wrapper-height').slideUp();
    }else if (selected_class == 'Bx-Slider') {
        jQuery('#cp-top-slider-wrapper-image').slideDown();
		jQuery('#cp-top-slider-wrapper-layer').slideUp();
		jQuery('#cp-top-slider-wrapper-height').slideDown();
    }else {
		jQuery('#cp-top-slider-wrapper-image').slideDown();
		jQuery('#cp-top-slider-wrapper-layer').slideUp();
		jQuery('#cp-top-slider-wrapper-height').slideUp();
    }
   

    jQuery('select#page-option-item-slider-linktype, select#page-option-top-slider-linktype').each(function () {
        var selected_val = jQuery(this).val();
        if (selected_val == 'No Link' || selected_val == 'Lightbox') {
            jQuery(this).parent().siblings('div').css('display', 'none');
        } else {
            if (selected_val == 'Link to URL') {
                jQuery(this).parent().siblings('div').not('[rel="video"]').css('display', 'block');
                jQuery(this).parent().siblings('div[rel="video"]').css('display', 'none');
            } else {
                jQuery(this).parent().siblings('div').not('[rel="url"]').css('display', 'block');
                jQuery(this).parent().siblings('div[rel="url"]').css('display', 'none');
            }
        }
    });

	    // Slider Toogle Script Start
    var selected_class = jQuery("#page-option-top-slider-on option:selected").attr("rel");
    if (selected_class == 'Yes') {
        jQuery('#cp-top-slider-wrapper').slideDown();
    } else {
        jQuery('#cp-top-slider-wrapper').slideUp();
    }

    //Slider theme options drop down
    jQuery('#page-option-top-slider-on').change(function () {
        var option_class = jQuery("#page-option-top-slider-on option:selected").attr("rel");
        if (option_class == 'Yes') {
			jQuery('#cp-top-slider-wrapper').slideDown();
        } else {
            jQuery('#cp-top-slider-wrapper').slideUp();
        }
    });
    // Slider Toogle Script Ends
	
	
    // Upload Image
    jQuery("input#upload_image_text_meta").change(function () {
        jQuery(this).siblings("input[type='hidden']").val(jQuery(this).val());
    });
    jQuery('input:button.upload_image_button_meta').click(function () {
        example_image = jQuery(this).siblings("#meta-input-example-image");
        upload_text = jQuery(this).siblings("#upload_image_text_meta");
        attachment_id = jQuery(this).siblings("#upload_image_attachment_id");
        tb_show('Upload Media', 'media-upload.php?post_id=&type=image&amp;TB_iframe=true');

        var oldSendToEditor = window.send_to_editor;
        window.send_to_editor = function (html) {
            image_url = jQuery(html).attr('href');
            thumb_url = jQuery('img', html).attr('src');
            attid = jQuery(html).attr('attid');

            upload_text.val(image_url);
            attachment_id.val(attid);
            example_image.html('<img class="img_size_50x50" src=' + thumb_url + ' />');
            tb_remove();

            window.send_to_editor = oldSendToEditor;
        }
        return false;
    });

    // Testimonial Option
    jQuery("div.combobox #page-option-item-testimonial-display-type").change(function () {
        var cp_category = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-category");
        var cp_specific = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-specific");
        if (jQuery(this).val() == 'Testimonial Category') {
            cp_specific.parents(".meta-body").slideUp();
            cp_category.parents(".meta-body").slideDown();
        } else {
            cp_category.parents(".meta-body").slideUp();
            cp_specific.parents(".meta-body").slideDown();
        }
    });
    jQuery("div.combobox #page-option-item-testimonial-display-type").each(function () {
        var cp_category = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-category");
        var cp_specific = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-specific");
        if (jQuery(this).val() == 'Testimonial Category') {
            cp_specific.parents(".meta-body").css('display', 'none');
            cp_category.parents(".meta-body").css('display', 'block');
        } else {
            cp_category.parents(".meta-body").css('display', 'none');
            cp_specific.parents(".meta-body").css('display', 'block');
        }
    });
	
	
	// Attraction Option
    jQuery("div.combobox #page-option-item-attraction-view").change(function () {
        var cp_location = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-attraction-location");
        var cp_category = jQuery(this).parents(".meta-body").parent().find("#hide_show_element");
		var cp_pagination = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-attraction-pagination");
        if (jQuery(this).val() == 'Listing View') {
            cp_location.parents(".meta-body").slideUp();
            cp_category.slideDown();			
        } else {
            cp_category.slideUp();
			cp_location.parents(".meta-body").slideDown();
        }
    });
    jQuery("div.combobox #page-option-item-attraction-view").each(function () {
        var cp_location = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-attraction-location");
        var cp_complete = jQuery(this).parents(".meta-body").parent().find("#hide_show_element");
		var cp_pagination = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-attraction-pagination");
        if (jQuery(this).val() == 'Listing View') {
            cp_location.parents(".meta-body").css('display', 'none');
            cp_complete.css('display', 'block');
        } else {
			cp_complete.css('display', 'none');
            cp_location.parents(".meta-body").css('display', 'block');
        }
    });
	
	// Event Option
    jQuery("div.combobox #page-option-item-event-view").change(function () {
        var cp_event_listing = jQuery(this).parents(".meta-body").parent().find("#event_type_open");
        if (jQuery(this).val() == 'Listing View') {
            cp_event_listing.slideDown();			
        } else {
            cp_event_listing.slideUp();			
        }
    });
    jQuery("div.combobox #page-option-item-event-view").each(function () {
        var cp_event_listing = jQuery(this).parents(".meta-body").parent().find("#event_type_open");
        if (jQuery(this).val() == 'Listing View') {
            cp_event_listing.css('display', 'block');
        } else {
			cp_event_listing.css('display', 'none');
        }
    });
	
	// Filterable Condition for PRoduct Option
    jQuery("div.combobox #page-option-item-product-filterable").change(function () {
        var cp_product_listing = jQuery(this).parents(".meta-body").parent().parent().find("#product-type-hide");
        if (jQuery(this).val() == 'No') {
            cp_product_listing.slideDown();			
        } else {
            cp_product_listing.slideUp();			
        }
    });
    jQuery("div.combobox #page-option-item-product-filterable").each(function () {
        var cp_product_listing = jQuery(this).parents(".meta-body").parent().parent().find("#product-type-hide");
        if (jQuery(this).val() == 'No') {
            cp_product_listing.css('display', 'block');
        } else {
			cp_product_listing.css('display', 'none');
        }
    });
	
	
	jQuery("div.combobox #page-option-item-product-layout").change(function () {
        var cp_product_listing_filter = jQuery(this).parents(".meta-body").parent().find("#product-type-filterable");
		var cp_product_pagi = jQuery(this).parents(".meta-body").parent().find("#product-type-hide");
        if (jQuery(this).val() == 'Grid') {
            cp_product_listing_filter.slideDown();
			cp_product_pagi.slideDown();
        } else {
            cp_product_listing_filter.slideUp();
			cp_product_pagi.slideDown();
        }
    });
    jQuery("div.combobox #page-option-item-product-layout").each(function () {
        var cp_product_listing_filter = jQuery(this).parents(".meta-body").parent().find("#product-type-filterable");
		var cp_product_pagi = jQuery(this).parents(".meta-body").parent().find("#product-type-hide");
        if (jQuery(this).val() == 'Grid') {
            cp_product_listing_filter.css('display', 'block');
			cp_product_pagi.css('display', 'block');
        } else {
			cp_product_listing_filter.css('display', 'none');
			cp_product_pagi.css('display', 'block');
        }
    });
	
   
	// Slider Toogle Script Start
    var selected_class = jQuery("#page_template option:selected").val();
    if (selected_class == 'page-sitemap.php') {
         jQuery("#page-option").slideUp();
    } else if(selected_class == 'page-galleryslideshow.php'){
            jQuery("#page-option").slideDown();
			jQuery("#cp-show-content-title-dd").slideUp();
			jQuery("#cp-street-view-wrapper").slideUp();
			jQuery("#cp-top-gallery-wrapper").slideDown();
    }else if(selected_class == 'page-map-view.php'){
		    jQuery("#page-option").slideDown();
			jQuery("#cp-top-gallery-wrapper").slideUp();
			jQuery("#cp-show-content-title-dd").slideUp();
			jQuery("#cp-street-view-wrapper").slideDown();
	}else{
			jQuery("#page-option").slideDown();
			jQuery("#cp-top-gallery-wrapper").slideUp();
			jQuery("#cp-show-content-title-dd").slideDown();
			jQuery("#cp-street-view-wrapper").slideUp();
	}
	
	
    // Page Template Choose
    jQuery("#page_template").change(function () {
        if (jQuery(this).val() == 'page-sitemap.php') {
            jQuery("#page-option").slideUp();
        } else if (jQuery(this).val() == 'page-galleryslideshow.php'){
           jQuery("#page-option").slideDown();
			jQuery("#cp-show-content-title-dd").slideUp();
			jQuery("#cp-street-view-wrapper").slideUp();
			jQuery("#cp-top-gallery-wrapper").slideDown();
			
        }else if(jQuery(this).val() == 'page-map-view.php'){
		    jQuery("#page-option").slideDown();
			jQuery("#cp-top-gallery-wrapper").slideUp();
			jQuery("#cp-show-content-title-dd").slideUp();
			jQuery("#cp-street-view-wrapper").slideDown();
		}else{
		    jQuery("#page-option").slideDown();
			jQuery("#cp-top-gallery-wrapper").slideUp();
			jQuery("#cp-show-content-title-dd").slideDown();
			jQuery("#cp-street-view-wrapper").slideUp();
		}
    });

});