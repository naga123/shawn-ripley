/**
 *	CrunchPress Panel File
 *	---------------------------------------------------------------------
 * 	@version	1.0
 * 	@author		CrunchPress
 * 	@link		http://crunchpress.com
 * 	@copyright	Copyright (c) CrunchPress
 * 	---------------------------------------------------------------------
 * 	This file contains the jQuery script that animate the CrunchPress 
 *  panel elements.
 *	---------------------------------------------------------------------
 */
jQuery(document).ready(function () {

    // Accordion Css
    jQuery('#panel-nav li a#parent').click(function () {
        if (jQuery(this).attr('class') != 'active') {
            jQuery('#panel-nav li ul').slideUp();
            jQuery(this).next().slideToggle();
            jQuery('#panel-nav li a').removeClass('active');
            jQuery(this).addClass('active');
        } else {
            jQuery('#panel-nav li ul').slideUp();
            jQuery(this).removeClass('active');
        }
        return false;
    });

    jQuery('#panel-nav li a#children').click(function () {
        if (jQuery(this).attr('class') != 'c-active') {
            jQuery('#panel-nav li a#children').removeClass('c-active');
            jQuery(this).addClass('c-active');
        }
        var selectedDiv = jQuery('div#panel-elements').children('#' + jQuery(this).attr('rel'));
        selectedDiv.fadeIn();
        selectedDiv.siblings().not('.panel-element-head, .panel-element-tail').hide();
        return false;
    });
    jQuery('#panel-nav ul li:first a').triggerHandler('click');
    jQuery('#panel-nav ul li:first ul li:first a').triggerHandler('click');
    // Upload Button
    jQuery("input#upload_image_text").change(function () {
        jQuery(this).siblings("input[type='hidden']").val(jQuery(this).val());
    });
    jQuery('input:button.upload_image_button').click(function () {
        example_image = jQuery(this).siblings("#input-example-image");
        upload_text = jQuery(this).siblings("#upload_image_text");
        attachment_id = jQuery(this).siblings("#upload_image_attachment_id");
        tb_show('Upload Media', 'media-upload.php?post_id=&type=image&amp;TB_iframe=true');
        window.send_to_editor = function (html) {
            image_url = jQuery(html).attr('href');
            thumb_url = jQuery('img', html).attr('src');
            attid = jQuery(html).attr('attid');

            attachment_id.val(attid);
            example_image.html('<img src=' + thumb_url + ' />');
            upload_text.val(image_url);
            tb_remove();
        }
        return false;
    });

    // Mini Color
    jQuery(".color-picker").miniColors({
        change: function (hex, rgb) {
            jQuery("#console").prepend('HEX: ' + hex + ' (RGB: ' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ')<br />');
        }

    });

    // Create Sidebar
    jQuery("div#add-more-sidebar").click(function () {
        var clone_item = jQuery(this).parents('.panel-input').siblings('#selected-sidebar').find('.default-sidebar-item').clone(true);
        var clone_val = jQuery(this).siblings('input#add-more-sidebar').val();
        if (clone_val.indexOf("&") > 0) {
            alert('You can\'t use the special charactor ( such as & ) as the sidebar name.');
            return;
        }
        if (clone_val == '' || clone_val == 'type title here') return;
        clone_item.removeClass('default-sidebar-item').addClass('sidebar-item');
        clone_item.find('input').attr('name', function () {
            return jQuery(this).attr('id') + '[]';
        });
        clone_item.find('input').attr('value', clone_val);
        clone_item.find('.slider-item-text').html(clone_val);
        jQuery("#selected-sidebar").append(clone_item);
        jQuery(".sidebar-item").slideDown();
		jQuery('input#add-more-sidebar').val('type title here');
    });
    jQuery(".sidebar-item").css('display', 'block');
    jQuery(".panel-delete-sidebar").click(function () {

        var deleted_sidebar = jQuery(this);
        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_sidebar.parents("#sidebar-item").slideUp("200", function () {
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
    jQuery('input#add-more-sidebar').setBlankText();

    jQuery(".tabs").tabs();

    // Add Multiple Ingredients
	var counter = 0;
    jQuery("div#add-more-ingre").click(function () {
		var clone_item = jQuery(this).parent().parent().children('#selected-ingre').children('.default-ingre-item').clone(true);
		var clone_val = jQuery(this).parent().parent().children('.panel-title').children('input#add-more-name').val();
		var clone_val_title = jQuery(this).parent().parent().children('.panel-input').children('input#add-more-title').val();
        if (clone_val.indexOf("&") > 0) {
            alert('You can\'t use the special charactor ( such as & ) as the ingre name.');
            return;
        }
        if (clone_val == '' || clone_val == 'type field heading here') return;
        clone_item.removeClass('default-ingre-item').addClass('ingre-item');
        clone_item.find('input').attr('name', function () {
            return jQuery(this).attr('id') + '[]';
        });
        clone_item.find('input#add-more-name').attr('value', clone_val);
		clone_item.find('input#add-more-title').attr('value', clone_val_title);
        clone_item.find('.ingre-item-name').html(clone_val);
		clone_item.find('.ingre-item-title').html(clone_val_title);
		clone_item.find('.ingre-item-counter').html(++counter);
        jQuery("#selected-ingre").append(clone_item);
        jQuery(".ingre-item").slideDown();
		jQuery(this).parent().parent().children('.panel-title').children('input#add-more-name').val('type field heading here');
		jQuery(this).parent().parent().children('.panel-input').children('input#add-more-title').val('type field title here');
    });
    jQuery(".ingre-item").css('display', 'block');
    jQuery(".panel-delete-ingre").click(function () {

        var deleted_sidebar = jQuery(this);
        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_sidebar.parent().parent().slideUp("200", function () {
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
    jQuery('input#add-more-ingre').setBlankText();
	
	// Add Multiple Ingredients
	var counter = 0;
    jQuery("div#add-more-elements").click(function () {
		var clone_item = jQuery(this).parent().parent().parent().children('#selected-element').children('.default-element-item').clone(true);
		var clone_val = jQuery(this).parent().parent().children('.panel-title').children('input#add-more-name').val();
		var clone_val_title = jQuery(this).parent().parent().children('.panel-title').children('input#add-more-title').val();
		var clone_val_des = jQuery(this).parent().parent().children('.panel-title').children('textarea#add-more-desc').val();
        if (clone_val.indexOf("&") > 0) {
            alert('You can\'t use the special charactor ( such as & ) as the ingre name.');
            return;
        }
        if (clone_val == '' || clone_val == 'Select start time' && clone_val_title == '' || clone_val_title == 'Select end time' && clone_val_des == '' || clone_val_des == 'Enter description here') return;
        clone_item.removeClass('default-element-item').addClass('element-item');
        clone_item.find('input').attr('name', function () {
            return jQuery(this).attr('id') + '[]';
        });
		clone_item.find('textarea').attr('name', function () {
            return jQuery(this).attr('id') + '[]';
        });
        clone_item.find('input#add-more-name').attr('value', clone_val);
		clone_item.find('input#add-more-title').attr('value', clone_val_title);
		clone_item.find('textarea#add-more-desc').val(clone_val_des);
        clone_item.find('.element-item-name').html(clone_val);
		clone_item.find('.element-item-title').html(clone_val_title);
		clone_item.find('.element-item-desc').html(clone_val_des);
		//clone_item.find('.ingre-item-counter').html(++counter);
        jQuery("#selected-element").append(clone_item);
        jQuery(".element-item").slideDown();
		jQuery(this).parent().parent().children('.panel-title').children('input#add-more-name').val('Select Start Time');
		jQuery(this).parent().parent().children('.panel-title').children('input#add-more-title').val('Select End Time');
		jQuery(this).parent().parent().children('.panel-title').children('textarea#add-more-desc').val('Enter description here');
    });
    jQuery(".element-item").css('display', 'block');
    jQuery(".panel-delete-element").click(function () {

        var deleted_sidebar = jQuery(this);
        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_sidebar.parent().parent().slideUp("200", function () {
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
    jQuery('input#add-more-ingre').setBlankText();
	
	
	// Add Multiple Ingredients
	var counter = 0;
    jQuery("a.draggable").click(function () {
		
		var clone_item = jQuery(this).parent().parent().parent().parent().find('#element_container').children('#element_sec').clone(true);
		//alert(clone_item);
		var clone_val_abc = jQuery(this).parent().addClass('added');
		clone_val_abc.slideUp();
		var clone_val = jQuery(this).parent().find('span').text();
		var clone_item_id = jQuery(this).parent().find('span').attr('id');
		var clone_item_img = jQuery(this).parent().find('img').attr('src');
        if (clone_val.indexOf("&") > 0) {
            alert('You can\'t use the special charactor ( such as & ) as the ingre name.');
            return;
        }
		//alert(clone_val);
        if (clone_val == '' || clone_val == 'Select start time') return;
        //clone_item.removeClass('default-element-item').addClass('element-item');
        clone_item.find('input').attr('name', function () {
            return 'select_organizer[]';
        });
		//clone_item.find('textarea').attr('name', function () {
            //return jQuery(this).attr('id') + '[]';
       // });
        
		clone_item.find('img').attr('src', clone_item_img);
		clone_item.find('span').text(clone_val);
		clone_item.find('input.element_text').attr('value', clone_item_id);
		
		//clone_item.find('textarea#add-more-desc').val(clone_val_des);
        //clone_item.find('.element-item-name').html(clone_val);
		//clone_item.find('.element-item-title').html(clone_val_title);
		//clone_item.find('.element-item-desc').html(clone_val_des);
		//clone_item.find('.ingre-item-counter').html(++counter);
		
        jQuery("#element_container_abc").append(clone_item);
		
        jQuery(".element_sec").slideDown();
		jQuery(this).parent().parent().children('.panel-title').children('input#add-more-name').val('Select Start Time');
		jQuery(this).parent().parent().children('.panel-title').children('input#add-more-title').val('Select End Time');
		jQuery(this).parent().parent().children('.panel-title').children('textarea#add-more-desc').val('Enter description here');
    });
    jQuery(".element-item").css('display', 'block');
    jQuery(".organ-delete-element").click(function () {

        var deleted_sidebar = jQuery(this).parent();
		
        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_sidebar.slideUp("200", function () {
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
    jQuery('input#add-more-ingre').setBlankText();
	
    //Add typekit font
    jQuery("div#add-typekit-font").click(function () {
        var clone_item = jQuery(this).parents('.panel-input').siblings('#selected_typekitfont').find('.default_typekit').clone(true);
        var clone_val = jQuery(this).siblings('input#add-typekit-font').val();
        if (clone_val.indexOf("&") > 0) {
            alert('You can\'t use the special charactor ( such as & ) as the font family.');
            return;
        }
        if (clone_val == '' || clone_val == 'type font family here') return;
        clone_item.removeClass('default_typekit').addClass('typekit_item');
        clone_item.find('input').attr('name', function () {
            return jQuery(this).attr('id') + '[]';
        });
        clone_item.find('input').attr('value', clone_val);
        clone_item.find('.typekitfont_text').html(clone_val);
        jQuery("#selected_typekitfont").append(clone_item);
        jQuery(".typekit_item").slideDown();
		jQuery('input#add-typekit-font').val('type title here');
    });
    jQuery(".typekit_item").css('display', 'block');
    jQuery(".panel-delete-typekitfont").click(function () {

        var deleted_typekit = jQuery(this);
        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_typekit.parents("#typekit_item").slideUp("200", function () {
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
    jQuery('input#add-typekit-font').setBlankText();

    // Upload Font
    jQuery('div#add-more-font').click(function () {
        var clone_item = jQuery(this).siblings('#added-font').find('.default-font-item').clone(true);
        clone_item.removeClass('default-font-item').addClass('font-item');
        clone_item.find('input').attr('name', function () {
            return jQuery(this).attr('id') + '[]';
        });
        jQuery("#added-font").append(clone_item);
        jQuery('.font-item').slideDown();
    });
    jQuery(".font-item").css('display', 'block');
    jQuery(".panel-delete-font").click(function () {
        var deleted_font = jQuery(this);

        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_font.parents("#font-item").slideUp('200', function () {
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
    jQuery("input.upload-font-button").click(function () {
        attachment_id = jQuery(this).siblings(".font-attachment-id");
        upload_font = jQuery(this).siblings(".upload-font-text");
        font_name_box = jQuery(this).parents('#font-item').find(".cp_upload_font_name");
        tb_show('Upload Media', 'media-upload.php?post_id=&amp;TB_iframe=true');
        window.send_to_editor = function (html) {
            attid = jQuery(html).attr('attid');
            font_url = jQuery(html).attr('href');
            jQuery.get(font_url, function (data) {
                var font_family_pos = data.indexOf('"font-family":"');
                if (font_family_pos > 0) {
                    attachment_id.val(attid);
                    upload_font.val(font_url);
                    font_family_pos = font_family_pos + 15

                    var font_family_pos_end = data.indexOf('"', font_family_pos + 1);
                    var font_name = data.substring(font_family_pos, font_family_pos_end);
                    font_name_box.val(font_name);

                    var custom_font = jQuery(".cp-panel-select-font-family").children('option:nth-child(2)');
                    jQuery("<option rel='" + font_url + "' >" + "- " + font_name + "</option>").insertAfter(custom_font);
                    tb_remove();
                } else {
                    tb_remove();
                    alert('Only CUFON ( .js file ) is supported with the upload font function. If it\'s already cufon try choosing the "File URL" as link instead of the "Attachment ID" when you click the "Insert to post" button.');
                }
            });
        }
        return false;
    });
	
	
	jQuery("button#default_fun").click(function () {
		
		jQuery('#font_size_normal').siblings('input').val('');
		jQuery('#font_size_normal').find('a').removeAttr('style');
		jQuery('#font_size_normal').siblings('#slidertext').text('');
		
		
		jQuery('#heading_h1').siblings('input').val('');
		jQuery('#heading_h1').find('a').removeAttr('style');
		jQuery('#heading_h1').siblings('#slidertext').text('');
		
		jQuery('#heading_h2').siblings('input').val('');
		jQuery('#heading_h2').find('a').removeAttr('style');
		jQuery('#heading_h2').siblings('#slidertext').text('');
		
		jQuery('#heading_h3').siblings('input').val('');
		jQuery('#heading_h3').find('a').removeAttr('style');
		jQuery('#heading_h3').siblings('#slidertext').text('');
		
		jQuery('#heading_h4').siblings('input').val('');
		jQuery('#heading_h4').find('a').removeAttr('style');
		jQuery('#heading_h4').siblings('#slidertext').text('');
		
		jQuery('#heading_h5').siblings('input').val('');
		jQuery('#heading_h5').find('a').removeAttr('style');
		jQuery('#heading_h5').siblings('#slidertext').text('');
		
		jQuery('#heading_h6').siblings('input').val('');
		jQuery('#heading_h6').find('a').removeAttr('style');
		jQuery('#heading_h6').siblings('#slidertext').text('');
		
		jQuery('#font_google').siblings('span').text('Theme Default');
		
		jQuery('#font_google_heading').siblings('span').text('Theme Default');
		jQuery('#menu_font_google').siblings('span').text('Theme Default');
		
		
		//alert(dd);
    });

    //Submit Button
    jQuery("#options-panel-form").submit(function () {
        var loading = jQuery(this).find('.loading-save-changes');
        loading.addClass('now-loading');
        jQuery.post(ajaxurl, jQuery(this).serialize(), function (data) {
            if (data == -1) {
                jQuery('#panel-element-save-complete').children(".panel-element-save-text").html("Save Options Failed");
            } else {
                jQuery('#panel-element-save-complete').children(".panel-element-save-text").html("Save Options Complete");
            }

            var y = jQuery(window).scrollTop() + 140;
            jQuery('#panel-element-save-complete').css('top', y);
            jQuery('#panel-element-save-complete').show().delay('2000').fadeOut();
            loading.removeClass('now-loading');
        });
        return false;
    });

    // Import Dummies Data
    jQuery('#import-dummies-data').click(function () {
        var now_loading = jQuery(this).siblings('#import-now-loading');
        now_loading.fadeIn();
        jQuery.post(ajaxurl, {
            action: 'load_dummy_data'
        }, function (data) {
            if (data == 1) {

                var y = jQuery(window).scrollTop() + 140;
                jQuery('#panel-element-save-complete').children(".panel-element-save-text").html("Import Option Complete");
                jQuery('#panel-element-save-complete').css('top', y);
                jQuery('#panel-element-save-complete').show().delay('2000').fadeOut();
                now_loading.fadeOut();

            } else {

                now_loading.hide();
                alert(data);

            }

        });

    });

    // Sliderbar
    jQuery('div[rel="sliderbar"]').each(function () {
        var bar_id = jQuery(this).attr('id');
        var init_val = jQuery(this).siblings('input[name="' + bar_id + '"]').attr('value');
        jQuery(this).slider({
            min: 10,
            max: 72,
            value: init_val,
            slide: function (event, ui) {
                jQuery(this).siblings('input[name="' + bar_id + '"]').attr('value', ui.value);
                jQuery(this).siblings('#slidertext').html(ui.value + ' px');
            }
        });
    });
	
	// Sliderbar
    jQuery('div[rel="logo_bar"]').each(function () {
        var bar_id = jQuery(this).attr('id');
        var init_val = jQuery(this).siblings('input[name="' + bar_id + '"]').attr('value');
        jQuery(this).slider({
            min: 10,
            max: 400,
            value: init_val,
            slide: function (event, ui) {
                jQuery(this).siblings('input[name="' + bar_id + '"]').attr('value', ui.value);
                jQuery(this).siblings('#slidertext').html(ui.value + ' px');
            }
        });
    });

    // Load Example Font
    jQuery(".font_google").change(function () {
        var selected_combobox = jQuery(this);
        var selected_rel = selected_combobox.find("option:selected").attr('value');
		var select_object_type = selected_combobox.find("option:selected").parent().attr('label');
		if(select_object_type == 'ADOBE EDGE FONT'){
			var sample_text = selected_combobox.parent().parent().parent().find("#option-font-sample");
				var script = document.createElement("script");
				jQuery.post(ajaxurl, {
					action: 'get_cp_typekit_url',
					font: jQuery(this).val()
				}, function (data) {
					if (data) {
							var script = document.createElement("script");
							script.type = "text/javascript";
							script.src = data.url;
							jQuery('head').append(script);
							sample_text.css('font-family', selected_combobox.val());
					}
				}, 'json');
		}else if(select_object_type == 'GOOGLE FONT'){
			if (selected_rel != '') {
				var sample_text = selected_combobox.parent().parent().parent().find("#option-font-sample");
				//alert(sample_text);
				jQuery.post(ajaxurl, {
					action: 'get_cp_font_url',
					font: jQuery(this).val()
				}, function (data) {
					if (data) {
						if (data.type == "Google Font") {
							jQuery('head').append('<link rel="stylesheet" type="text/css" href="' + data.url + '" >');
							sample_text.html(URL.sample_text);
							//jQuery.fontAvailable(selected_combobox.val());
							sample_text.css('font-family', selected_combobox.val());
							
						}
					}
				}, 'json');
			}
		}else{
		
		
		}
       

    });

    jQuery(".font_google").each(function () {
        jQuery(this).triggerHandler("change");
    });

    // Change the style of <select>
    if (!jQuery.browser.opera) {
        jQuery('.combobox select').each(function () {
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


    // Style of on off button
    jQuery("div.checkbox-switch").click(function () {
        if (jQuery(this).hasClass('checkbox-switch-on')) {
            jQuery(this).removeClass('checkbox-switch-on').addClass('checkbox-switch-off');
        } else {
            jQuery(this).removeClass('checkbox-switch-off').addClass('checkbox-switch-on');
        }

    });


    //radioimage check-list
    jQuery('.radio-image-wrapper input').change(function () {
        jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
        jQuery(this).siblings("label").children("#check-list").addClass("check-list");


        var panel_body = jQuery(this).parents('.panel-body');
        if (jQuery(this).val() == 'right-sidebar') {
            panel_body.siblings('.cp_right_sidebar').slideDown();
            panel_body.siblings('.cp_left_sidebar').slideUp();
        } else if (jQuery(this).val() == 'left-sidebar') {
            panel_body.siblings('.cp_right_sidebar').slideUp();
            panel_body.siblings('.cp_left_sidebar').slideDown();
        } else if (jQuery(this).val() == 'both-sidebar') {
            panel_body.siblings('.cp_right_sidebar').slideDown();
            panel_body.siblings('.cp_left_sidebar').slideDown();
        } else if (jQuery(this).val() == 'both-sidebar-left') {
            panel_body.siblings('.cp_right_sidebar').slideDown();
            panel_body.siblings('.cp_left_sidebar').slideDown();
        } else if (jQuery(this).val() == 'both-sidebar-right') {
            panel_body.siblings('.cp_right_sidebar').slideDown();
            panel_body.siblings('.cp_left_sidebar').slideDown();
        } else if (jQuery(this).val() == 'no-sidebar') {
            panel_body.siblings('.cp_right_sidebar').slideUp();
            panel_body.siblings('.cp_left_sidebar').slideUp();
        }
    })


    jQuery('.radio-image-wrapper input:checked').each(function () {
        jQuery(this).triggerHandler("change");
    });


    jQuery("#event_start_date").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        onSelect: function (selectedDate) {
            jQuery("#event_end_date").datepicker("option", "minDate", selectedDate);
        }
    })


    jQuery("#event_end_date").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        onSelect: function (selectedDate) {
            jQuery("#event_start_date").datepicker("option", "maxDate", selectedDate);
        }

    });
	
	 jQuery("#pro_commence_date").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
    });

	jQuery("#date_posted").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
    });
	

    jQuery(".date_picker").datepicker();


    //Time Picker Class
    jQuery('.time_picker').timepicker({
        showNowButton: true,
        showDeselectButton: true,
        defaultTime: '', // removes the highlighted time for when the input is empty.
        showCloseButton: true
    });
	
	

    //Slider theme options drop down
    jQuery('#select_slider').change(function () {
        var option_class = jQuery("#select_slider option:selected").attr("class");


        if (option_class == 'flex_slider') {
            jQuery('.flex_slider_box').slideDown();
            jQuery('.bx_slider_box').slideUp();
            jQuery('.anything_slider_box').slideUp();
        } else if (option_class == 'bx_slider') {
            jQuery('.bx_slider_box').slideDown();
            jQuery('.flex_slider_box').slideUp();
            jQuery('.anything_slider_box').slideUp();
        } else if (option_class == 'anything_slider') {
            jQuery('.anything_slider_box').slideDown();
            jQuery('.flex_slider_box').slideUp();
            jQuery('.bx_slider_box').slideUp();
        } else {
            jQuery('.anything_slider_box').slideUp();
            jQuery('.flex_slider_box').slideUp();
            jQuery('.bx_slider_box').slideUp();
        }



    });
    // Slider Toogle Script Start
    var selected_class = jQuery("#home_select_slider option:selected").attr("class");
    if (selected_class == 'layer_slider') {
        jQuery('.layer_slider_shortcode').slideDown();
    } else {
        jQuery('.layer_slider_shortcode').slideUp();
        jQuery('.cp_select_slider').slideDown();
    }

    //Slider theme options drop down
    jQuery('#home_select_slider').change(function () {
        var option_class = jQuery("#home_select_slider option:selected").attr("class");
        if (option_class == 'layer_slider') {
            jQuery('.layer_slider_shortcode').slideDown();
            jQuery('.cp_select_slider').slideUp();
        } else {
            jQuery('.layer_slider_shortcode').slideUp();
            jQuery('.cp_select_slider').slideDown();
        }
    });
    // Slider Toogle Script Ends
	
	// Slider Toogle Script Start
    var selected_class = jQuery(".select_background_patren option:selected").attr("class");
	if (selected_class == 'select_bg_patren') {
		jQuery('#select_bg_color').slideUp();
		jQuery('#bg_upload_id').slideDown();
		jQuery('#select_bg_patren').slideDown();
		jQuery('#image_upload_id').slideUp();
		jQuery('.image_upload_options').slideUp();
	} else if(selected_class == 'select_bg_color'){
		jQuery('#select_bg_color').slideDown();
		jQuery('#bg_upload_id').slideUp();
		jQuery('#select_bg_patren').slideUp();
		jQuery('#image_upload_id').slideUp();
		jQuery('.image_upload_options').slideUp();
	} else if(selected_class == 'select_bg_image'){
		jQuery('#image_upload_id').slideDown();
		jQuery('.image_upload_options').slideDown();
		jQuery('#select_bg_color').slideUp();
		jQuery('#bg_upload_id').slideUp();
		jQuery('#select_bg_patren').slideUp();
	}
	
    //Slider theme options drop down
    jQuery('.select_background_patren').change(function () {
        var option_class = jQuery(".select_background_patren option:selected").attr("class");
		if (option_class == 'select_bg_patren') {
			jQuery('#select_bg_color').slideUp();
			jQuery('#bg_upload_id').slideDown();
			jQuery('#select_bg_patren').slideDown();
			jQuery('#image_upload_id').slideUp();
			jQuery('.image_upload_options').slideUp();
		} else if(option_class == 'select_bg_color'){
			jQuery('#select_bg_color').slideDown();
			jQuery('#bg_upload_id').slideUp();
			jQuery('#select_bg_patren').slideUp();
			jQuery('#image_upload_id').slideUp();
			jQuery('.image_upload_options').slideUp();
		} else if(option_class == 'select_bg_image'){
			jQuery('#image_upload_id').slideDown();
			jQuery('.image_upload_options').slideDown();
			jQuery('#select_bg_color').slideUp();
			jQuery('#bg_upload_id').slideUp();
			jQuery('#select_bg_patren').slideUp();
		}
    });
	
	
		// Slider Toogle Script Start
    var selected_class = jQuery("#select_layout_cp option:selected").attr("class");
	if (selected_class == 'box_layout') {
		jQuery('#boxed_layout').slideDown();
	}else{
		jQuery('#boxed_layout').slideUp();
	}
	
	
	 //Slider theme options drop down
    jQuery('#select_layout_cp').change(function () {
        var option_class = jQuery("#select_layout_cp option:selected").attr("class");
		if (option_class == 'box_layout') {
			jQuery('#boxed_layout').slideDown();
		}else{
			jQuery('#boxed_layout').slideUp();
		}
    });
	
	// Slider Toogle Script Start
    var selected_class = jQuery(".select_background_patren_sec option:selected").attr("class");
	if (selected_class == 'select_bg_patren') {
		jQuery('#select_bg_color_sec').slideUp();
		jQuery('#bg_upload_id_sec').slideDown();
		jQuery('#select_bg_patren_sec').slideDown();
		jQuery('#image_upload_id_sec').slideUp();
		jQuery('.image_upload_options_sec').slideUp();
	}else if(selected_class == 'select_bg_color'){
		jQuery('#select_bg_color_sec').slideDown();
			jQuery('#bg_upload_id_sec').slideUp();
			jQuery('#select_bg_patren_sec').slideUp();
			jQuery('#image_upload_id_sec').slideUp();
			jQuery('.image_upload_options_sec').slideUp();
	} else if(selected_class == 'select_bg_image'){
			jQuery('#image_upload_id_sec').slideDown();
			jQuery('.image_upload_options_sec').slideDown();
			jQuery('#select_bg_color_sec').slideUp();
			jQuery('#bg_upload_id_sec').slideUp();
			jQuery('#select_bg_patren_sec').slideUp();
	}
	
    //Slider theme options drop down
    jQuery('.select_background_patren_sec').change(function () {
        var option_class = jQuery(".select_background_patren_sec option:selected").attr("class");
		if (option_class == 'select_bg_patren') {
			jQuery('#select_bg_color_sec').slideUp();
			jQuery('#bg_upload_id_sec').slideDown();
			jQuery('#select_bg_patren_sec').slideDown();
			jQuery('#image_upload_id_sec').slideUp();
			jQuery('.image_upload_options_sec').slideUp();
		} else if(option_class == 'select_bg_color'){
			jQuery('#select_bg_color_sec').slideDown();
			jQuery('#bg_upload_id_sec').slideUp();
			jQuery('#select_bg_patren_sec').slideUp();
			jQuery('#image_upload_id_sec').slideUp();
			jQuery('.image_upload_options_sec').slideUp();
		} else if(option_class == 'select_bg_image'){
			jQuery('#image_upload_id_sec').slideDown();
			jQuery('.image_upload_options_sec').slideDown();
			jQuery('#select_bg_color_sec').slideUp();
			jQuery('#bg_upload_id_sec').slideUp();
			jQuery('#select_bg_patren_sec').slideUp();
		}
    });
	
	//Slider theme options drop down
    jQuery('.checkbox_class').change(function () {
        var option_class = jQuery(".checkbox_class").is(':checked');
		if (option_class == true) {
			jQuery('.emptyme').val('');
		} 
    });
	//Slider theme options drop down
    jQuery('.ft_pattern').change(function () {
        var option_class = jQuery(".ft_pattern").is(':checked');
		if (option_class == true) {
			jQuery('.emptyme_ft_pattern').val('');
		} 
    });
	
	
	//Delete Logo Image on Click
    jQuery('.close-me').click(function () {
		jQuery(this).parent().parent().find('.clearme').val('');
		jQuery(this).parent().parent().find('img.img-class').attr('src','');
    });
	

    // Slider Toogle Script Start
    var selected_class = jQuery("#event_thumbnail option:selected").attr("class");
    if (selected_class == 'Video') {
        jQuery('.select_slider_option').slideUp();
        jQuery('.video_class').slideDown();
    } else if (selected_class == 'Slider') {
        jQuery('.select_slider_option').slideDown();
        jQuery('.video_class').slideUp();
    } else {
        jQuery('.select_slider_option').slideUp();
        jQuery('.video_class').slideUp();
    }

    //Slider theme options drop down
    jQuery('#event_thumbnail').change(function () {
        var option_class = jQuery("#event_thumbnail option:selected").attr("class");
        if (option_class == 'Image') {
            jQuery('.select_slider_option').slideUp();
            jQuery('.video_class').slideUp();
        } else if (option_class == 'Video') {
            jQuery('.select_slider_option').slideUp();
            jQuery('.video_class').slideDown();
        } else if (option_class == 'Slider') {
            jQuery('.select_slider_option').slideDown();
            jQuery('.video_class').slideUp();
        }



    });
	
	    // Slider Toogle Script Start
    var selected_class = jQuery("#entry_level option:selected").attr("class");
    if (selected_class == 'external') {
		jQuery('.addi_info').slideDown();
		jQuery('.bookingurl').slideUp();
    } else if (selected_class == 'free_entry') {
		jQuery('.addi_info').slideUp();
		jQuery('.bookingurl').slideUp();
    } else {
		jQuery('.addi_info').slideUp();
		jQuery('.bookingurl').slideDown();
    }

    //Slider theme options drop down
    jQuery('#entry_level').change(function () {
        var option_class = jQuery("#entry_level option:selected").attr("class");
        if (option_class == 'external') {
            jQuery('.addi_info').slideDown();
            jQuery('.bookingurl').slideUp();
        } else if (option_class == 'free_entry') {
            jQuery('.addi_info').slideUp();
            jQuery('.bookingurl').slideUp();
        } else if (option_class == 'paid_entry') {
            jQuery('.addi_info').slideUp();
            jQuery('.bookingurl').slideDown();
        }



    });


    var selected_class = jQuery("#newsletter_settings option:selected").attr("class");
    if (selected_class == 'built_in_newsletter') {
        jQuery('.download_newsletter').slideDown();
        jQuery('.feedburner_id').slideUp();
    } else if (selected_class == 'google_feed_burner') {
        jQuery('.download_newsletter').slideUp();
        jQuery('.feedburner_id').slideDown();
    }

    //Slider theme options drop down
    jQuery('#newsletter_settings').change(function () {
        var option_class = jQuery("#newsletter_settings option:selected").attr("class");


        if (option_class == 'built_in_newsletter') {
            jQuery('.download_newsletter').slideDown();
            jQuery('.feedburner_id').slideUp();
        } else if (option_class == 'google_feed_burner') {
            jQuery('.download_newsletter').slideUp();
            jQuery('.feedburner_id').slideDown();
        }



    });


    //background combobox
    jQuery('#cp_background_style').change(function () {
        if (jQuery(this).val() == 'Pattern') {
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_pattern').slideDown();
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_custom').slideUp();
        } else if (jQuery(this).val() == 'Custom Image') {
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_pattern').slideUp();
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_custom').slideDown();
        } else {
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_pattern').slideUp();
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_custom').slideUp();
        }

    });
    jQuery('#cp_background_style').each(function () {
        if (jQuery(this).val() == 'Pattern') {
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_pattern').css('display', 'block');
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_custom').css('display', 'none');
        } else if (jQuery(this).val() == 'Custom Image') {
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_pattern').css('display', 'none');
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_custom').css('display', 'block');
        } else {
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_pattern').css('display', 'none');
            jQuery(this).parents('.panel-body').siblings('.body-cp_background_custom').css('display', 'none');
        }

    });


    // Load Default Color
    jQuery('#color_scheme_1').change(function () {
        jQuery('.color-picker').each(function () {
            jQuery(this).val(jQuery(this).attr('color_scheme_1'));
            jQuery(this).trigger('keyup.miniColors');
        });

    });
    // Load Blue Color
    jQuery('#color_scheme_2').change(function () {
        jQuery('.color-picker').each(function () {
            jQuery(this).val(jQuery(this).attr('color_scheme_2'));
            jQuery(this).trigger('keyup.miniColors');
        });

    });
    // Load Brown Color
    jQuery('#color_scheme_3').change(function () {
        jQuery('.color-picker').each(function () {
            jQuery(this).val(jQuery(this).attr('color_scheme_3'));
            jQuery(this).trigger('keyup.miniColors');

        });


    });
    // Load Red Color
    jQuery('#color_scheme_4').change(function () {
        jQuery('.color-picker').each(function () {
            jQuery(this).val(jQuery(this).attr('color_scheme_4'));
            jQuery(this).trigger('keyup.miniColors');
        });

    });
});

// a function to check if selected font is currenty available for use
(function ($) {


    var element;
    $.fontAvailable = function (fontName) {
        var width, height;


        // prepare element, and append to DOM
        if (!element) {
            element = $(document.createElement('span'))
                .css('visibility', 'hidden')
                .css('position', 'absolute')
                .css('top', '-10000px')
                .css('left', '-10000px')
                .html('abcdefghijklmnopqrstuvwxyz')
                .appendTo(document.body);
        }


        // get the width/height of element after applying a fake font

        width = element.css('font-family', '__FAKEFONT__')
            .width();
        height = element.height();


        // set test font
        element.css('font-family', fontName);


        return width !== element.width() || height !== element.height();
    }


    $.fn.setBlankText = function () {
        this.live("blur", function () {
            var default_value = $(this).attr("rel");
            if ($(this).val() == "") {
                $(this).val(default_value);
                $(this).css('font-style', 'italic');
                $(this).css('color', '#999');
            }



        }).live("focus", function () {
            var default_value = $(this).attr("rel");
            if ($(this).val() == default_value) {
                $(this).val("");
                $(this).css('font-style', 'normal');
                $(this).css('color', '#444');
            }
        });
    }



})(jQuery);