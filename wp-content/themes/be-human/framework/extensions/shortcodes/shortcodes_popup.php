<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<title>
<?php
# LAYOUTS
if($_GET['section']=='layouts'){
	echo 'Column';
}elseif($_GET['section']=='buttons'){
	echo 'Buttons';
}elseif($_GET['section']=='msgbox'){
	echo 'Message Box';	
}elseif($_GET['section']=='video-shortcodes'){
	echo 'Video Shortcodes';	
}elseif($_GET['section']=='blockQuote'){
	echo 'Block Quote';	
}elseif($_GET['section']=='lists'){
	echo 'List Shortcodes';	
}elseif($_GET['section']=='dropcap'){
	echo 'Dropcape';	
}else if($_GET['section']=='social'){
	echo 'social';
}else{ 
    echo 'SHORTCODES';
}
?>
</title>
<link rel="stylesheet" type="text/css" href="shortcode-css.css"/>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="tiny_mce_popup.js"></script>
<script type="text/javascript">
	function send_shortcode(shortcode) {
	    
	    var shortcode_value = jQuery('#'+shortcode).html();
	    
	    window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, shortcode_value);
	    window.tinyMCE.activeEditor.execCommand('mceRepaint');
	    tinyMCEPopup.close();
	}
		
	function d(id) { return document.getElementById(id); }

	function flipTab(n) {
		for (i=1;i<=6;i++) {
			c = d('content'+i.toString());
			t = d('tab'+i.toString());
			if ( n == i ) {
				c.className = '';
				t.className = 'current';
			} else {
				c.className = 'hidden';
				t.className = '';
			}
		}
	}

    function init() {
        document.getElementById('version').innerHTML = tinymce.majorVersion + "." + tinymce.minorVersion;
        document.getElementById('date').innerHTML = tinymce.releaseDate;
    }
    
    tinyMCEPopup.onInit.add(init);
    
</script>

</head>

<?php
$dummy_text="Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.";
$dummy_text_short="Lorem ipsum dolor sit amet.";
$button_text= "Button Text";
?>
<div id="values">
	
	<!-- two cols -->
	<div id="two-cols">
		[column col="1/2"]Content for 1/2 Column here[/column]<br>
        [column col="1/2"]Content for 1/2 Column here[/column]<br> 
	</div>	

	<!-- three cols -->
	<div id="three-cols">
		[column col="1/3"]Content for 1/3 Column here[/column]<br>
		[column col="1/3"]Content for 1/3 Column here[/column]<br>
		[column col="1/3"]Content for 1/3 Column here[/column]<br>
	</div>

	<!-- four cols -->
	<div id="four-cols">
		[column col="1/4"]Content for 1/4 Column here[/column]<br>
		[column col="1/4"]Content for 1/4 Column here[/column]<br>
		[column col="1/4"]Content for 1/4 Column here[/column]<br>
	    [column col="1/4"]Content for 1/4 Column here[/column]<br>
	</div>

	<!-- two-three cols -->
	<div id="two-three-cols">
		[column col="2/3"]Content for 2/3 Column here[/column]<br>
	</div>

	<!-- three-three cols -->
	<div id="three-four-cols">
		[column col="3/4"]Content for 3/4 Column here[/column]<br>
	</div>
		
	<!--
	******************************************************
	*
	*
	*         		Video Shortcodes
	*
	*
	******************************************************
	-->
			    
	
	<!-- youtube -->
	<div id="youtube">
		[youtube height="HEIGHT" width="WIDTH"]PLACE_LINK_HERE[/youtube]
	</div>

	<!-- vimeo -->
	<div id="vimeo">
		[vimeo height="HEIGHT" width="WIDTH"]PLACE_LINK_HERE[/vimeo]
	</div>
    
    
	<!--
	******************************************************
	*
	*
	*         		Pullquotes
	*
	*
	******************************************************
	-->
			    
	
	<!-- pullquote left -->
	<div id="pullquote-left">
        [quote align="left" color="#999999"]<?php echo $dummy_text;?>[/quote]
	</div>
    
    <!-- pullquote left -->
	<div id="pullquote-center">
		 [quote align="center" color="#999999"]<?php echo $dummy_text;?>[/quote]
	</div>
    
	<!-- pullquote right -->
	<div id="pullquote-right">
		 [quote align="right" color="#999999"]<?php echo $dummy_text;?>[/quote]
	</div>
	

	<!--
	******************************************************
	*
	*
	*         		MESSAGE BOXES
	*
	*
	******************************************************
	-->
	<div id="blue">
		[message_box title="MESSAGE TITLE" color="blue"]<?php echo $dummy_text;?>[/message_box]
	</div>

	<div id="red">
        [message_box title="MESSAGE TITLE" color="red"]<?php echo $dummy_text;?>[/message_box] 
	</div>

	<div id="yellow">
		[message_box title="MESSAGE TITLE" color="yellow"]<?php echo $dummy_text;?>[/message_box]
	</div>	
	
	<div id="green">
		[message_box title="MESSAGE TITLE" color="green"]<?php echo $dummy_text;?>[/message_box]
	</div>

	<!--
	******************************************************
	*
	*
	*         		Dropcaps
	*
	*
	******************************************************
	-->

	<div id="dropcap1">
		[dropcap color="#555555"]A[/dropcap]
	</div>
	
	<div id="dropcap2">
		[dropcap type="circle" color="#ffffff" background="#ef7f2c"]S[/dropcap]
	</div>

	<!--
	******************************************************
	*
	*
	*         		Lists
	*
	*
	******************************************************
	-->

	
	<div id="square">
		<br />
			[list type="square"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 

	<div id="check">
		<br />
			[list type="check"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
    <div id="plus">
		<br />
			[list type="plus"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
     
      <div id="arrow">
		<br />
			[list type="arrow"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
    
     <div id="cross">
		<br />
			[list type="cross"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
     <div id="star">
		<br />
			[list type="star"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
    
    <div id="minus">
		<br />
			[list type="minus"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
    
     <div id="arrow2">
		<br />
			[list type="arrow2"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
     <div id="circle">
		<br />
			[list type="circle"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
    
     <div id="bullet">
		<br />
			[list type="bullet"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
    
     <div id="bullet2">
		<br />
			[list type="bullet2"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
    <div id="bullet3">
		<br />
			[list type="bullet3"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
	<div id="square-box">
		<br />
			[list type="square-box"]
				<ul>
				<li>ADD YOUR LIST CONTENT HERE</li>
				<li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
                <li>ADD YOUR LIST CONTENT HERE</li>
				</ul>
			[/list]
		<br />
	</div> 
	<!--
	******************************************************
	*
	*
	*         		Buttons
	*
	*
	******************************************************
	-->
	<div id="cpstrap-1-1">
		[button color="#ffffff" background="#191919" size="small" src="PUT LINK HERE"]BUTTON CONTENT[/button]
	</div>

	<div id="cpstrap-1-2">
		[button color="#ffffff" background="#191919" size="medium" src="PUT LINK HERE"]BUTTON CONTENT[/button]
	</div>
	
	<div id="cpstrap-1-3">
		[button color="#ffffff" background="#191919" size="large" src="PUT LINK HERE"]BUTTON CONTENT[/button]	
	</div>				
				
	<div id="cpstrap-2-1">
		[button color="#ffffff" background="#9a1a33" size="small" src="PUT LINK HERE"]BUTTON CONTENT[/button]
	</div>

	<div id="cpstrap-2-2">
		[button color="#ffffff" background="#9a1a33" size="medium" src="PUT LINK HERE"]BUTTON CONTENT[/button]
	</div>
	
	<div id="cpstrap-2-3">
		[button color="#ffffff" background="#9a1a33" size="large" src="PUT LINK HERE"]BUTTON CONTENT[/button]	
	</div>
	
	<div id="cpstrap-3-1">
		[button color="#ffffff" background="#35586C" size="small" src="PUT LINK HERE"]BUTTON CONTENT[/button]
	</div>

	<div id="cpstrap-3-2">
		[button color="#ffffff" background="#35586C" size="medium" src="PUT LINK HERE"]BUTTON CONTENT[/button]
	</div>
	
	<div id="cpstrap-3-3">
		[button color="#ffffff" background="#35586C" size="large" src="PUT LINK HERE"]BUTTON CONTENT[/button]
	</div>	
	
	
	<!--
	******************************************************
	*
	*
	*         		Social
	*
	*
	******************************************************
	-->
	
	<div id="facebook_icon">
		[social size="small" type="fb_hr" src="PUT LINK HERE"]Facebook[/social]
	</div>	
	<div id="twitter_icon">
		[social size="small" type="twitter_hr" src="PUT LINK HERE"]Twitter[/social]
	</div>	
	<div id="delicious_icon">
		[social size="small" type="delicious" src="PUT LINK HERE"]Delicious[/social]
	</div>	
	<div id="googleplus_icon">
		[social size="small" type="googleplus_hr" src="PUT LINK HERE"]Google Plus[/social]
	</div>	
	<div id="linked_in_icon">
		[social size="small" type="linked_hr" src="PUT LINK HERE"]Linked In[/social]
	</div>	
	<div id="youtube_icon">
		[social size="small" type="youtube_hr" src="PUT LINK HERE"]Youtube[/social]
	</div>	
	<div id="flickr_icon">
		[social size="small" type="flickr_hr" src="PUT LINK HERE"]Flickr[/social]
	</div>	
	<div id="vimeo_icon">
		[social size="small" type="vimeo_hr" src="PUT LINK HERE"]Vimeo[/social]
	</div>	
	<div id="pinterest_icon">
		[social size="small" type="pinterest_hr" src="PUT LINK HERE"]Pinterest[/social]
	</div>		
	
</div>



<?php
#
# 	LAYOUTS
#

if($_GET['section']=='layouts'):
?>

<div class="content_wrapper">
 <table class="layouts">
   <tr>
       <td>		
		<img src="images/2-col.png" onclick="send_shortcode('two-cols')" class="rt_button" /><br />
		<label>Two Columns</label>
	  </td>

       <td>		
		<img src="images/3-col.png" onclick="send_shortcode('three-cols')" class="rt_button" /><br />
		<label>Three Columns</label>
	  </td>

       <td>		
		<img src="images/4-col.png" onclick="send_shortcode('four-cols')" class="rt_button" /><br />
		<label>Four Columns</label>
	  </td>   
   </tr>

   <tr>
       <td>		
		<img src="images/3-1-col.png" onclick="send_shortcode('two-three-cols')" class="rt_button" /><br />
		<label>2:3 and 1:3 Columns </label>
	  </td>

       <td>		
		<img src="images/4-1-col.png" onclick="send_shortcode('three-four-cols')" class="rt_button" /><br />
		<label>3:4 and 1:4 Columns</label>
	  </td>

       <td>		
		<img src="images/5-1-col.png" onclick="send_shortcode('four-five-cols')" class="rt_button" /><br />
		<label>4:5 and 1:5 Columns</label>
	  </td>
   </tr>
</table>
</div>
<?php endif;?> 


<?php
#
# 	VIEDO
#

if($_GET['section']=='video-shortcodes'):
?> 
<div class="content_wrapper">   
<center>
<table>
       <tr>
           <td>
            <input type="button" value="Youtube" onclick="send_shortcode('youtube')" id="rt_button_8" class="rt_button">
           <input type="button" value="Vimeo" onclick="send_shortcode('vimeo')" id="rt_button_8" class="rt_button">
           </td>
       </tr>
</table>
</center>
</div>
<?php endif;?>


<?php
#
# 	HIGHLIGHT
#

if($_GET['section']=='msgbox'):
?>
<div class="content_wrapper">
<div style="text-align:center">  
<table>
        <tr>
            <td>
           <input type="button" value="Insert Blue" onclick="send_shortcode('blue')" id="rt_button_8" class="box_blue">
           <input type="button" value="Insert Red" onclick="send_shortcode('red')" id="rt_button_8" class="box_red">
           <input type="button" value="Insert Green" onclick="send_shortcode('green')" id="rt_button_8" class="box_green">
           <input type="button" value="Insert Yellow" onclick="send_shortcode('yellow')" id="rt_button_8" class="box_yellow">
           </td>
       </tr>  
     </table> 
</div>
</div>
<?php endif;?>

<?php
#
# 	BLOCK QUOTES
#

if($_GET['section']=='blockQuote'):
?>
<div class="content_wrapper"> 
<div style="text-align:center">
<table> 
       <tr>
           <td>
            <input type="button" value="Insert Left" onclick="send_shortcode('pullquote-left')" id="rt_button_8" class="rt_button">
            <input type="button" value="Insert Center" onclick="send_shortcode('pullquote-center')" id="rt_button_8" class="rt_button">
            <input type="button" value="Insert Right" onclick="send_shortcode('pullquote-right')" id="rt_button_8" class="rt_button">
           </td>
       </tr>
</table>
</div>
</div>
<?php endif;?>
<?php
#
# 	LISTS
#

if($_GET['section']=='lists'):
?>
<div class="content_wrapper"> 
<div style="text-align:center">
<table>
 		<tr>
           <td>
			   <input type="button" value="Square List Style" onclick='send_shortcode("square")' id="rt_button_8" class="rt_button">
			   <input type="button" value="Check List Style " onclick='send_shortcode("check")' id="rt_button_8" class="rt_button">
			   <input type="button" value="Plus List Style" onclick='send_shortcode("plus")' id="rt_button_8" class="rt_button">
			   <input type="button" value="Arrow List Style" onclick='send_shortcode("arrow")' id="rt_button_8" class="rt_button">
			   <input type="button" value="Cross List Style" onclick='send_shortcode("cross")' id="rt_button_8" class="rt_button">
			   <input type="button" value="Star List Style" onclick='send_shortcode("star")' id="rt_button_8" class="rt_button">
			   <input type="button" value="Minus List Style" onclick='send_shortcode("minus")' id="rt_button_8" class="rt_button">
			   <input type="button" value="Arrow2 List Style" onclick='send_shortcode("arrow2")' id="rt_button_8" class="rt_button">
			   <input type="button" value="Circle List Style" onclick='send_shortcode("circle")' id="rt_button_8" class="rt_button">
           </td>
       </tr>
</table>
</div>
</div>
<?php endif;?>

<?php
#
# 	DROPCAP
#

if($_GET['section']=='dropcap'):
?>
<div class="content_wrapper"> 
<div style="text-align:center">
<table>
 		 <tr>
           <td></td>
           <td>
           <input type="button" value="Dropcap Style 1" onclick="send_shortcode('dropcap1')"' id="rt_button_8" class="rt_button">
           <input type="button" value="Dropcap Style 2" onclick="send_shortcode('dropcap2')"' id="rt_button_8" class="rt_button">
           </td>
       </tr>
</table>
</div>
</div>
<?php endif;?>


<?php
#
# 	BUTTONS
#

if($_GET['section']=='buttons'):
?>
<div class="content_wrapper">         
<table>
<tr>
	<td>				
		<a class="cpstrap dark small" onclick='send_shortcode("cpstrap-1-1")'>Small Button</a>
		<a class="cpstrap dark medium" onclick='send_shortcode("cpstrap-1-2")'>Medium Button</a>
		<a class="cpstrap dark big" onclick='send_shortcode("cpstrap-1-3")'>Big Button</a>				
	</td>
</tr>
<tr>
	<td>				
		<a class="cpstrap red small" onclick='send_shortcode("cpstrap-2-1")'>Small Button</a>
		<a class="cpstrap red medium" onclick='send_shortcode("cpstrap-2-2")'>Medium Button</a>
		<a class="cpstrap red big" onclick='send_shortcode("cpstrap-2-3")'>Big Button</a>				
	</td>
</tr>
<tr>
	<td>				
		<a class="cpstrap blue small" onclick='send_shortcode("cpstrap-3-1")'>Small Button</a>
		<a class="cpstrap blue medium" onclick='send_shortcode("cpstrap-3-2")'>Medium Button</a>
		<a class="cpstrap blue big" onclick='send_shortcode("cpstrap-3-3")'>Big Button</a>						
	</td>
</tr>
</table>
</div>	
<?php endif;
#
# 	BUTTONS
#

if($_GET['section']=='social'){ ?>
<div class="content_wrapper">         
<table>
<tr>
	<td>				
		<a onClick='send_shortcode("facebook_icon")' class="social_icon icon_fb">Facebook</a>
		<a onClick='send_shortcode("twitter_icon")' class="social_icon icon_twitter">Twitter</a>
		<a onClick='send_shortcode("delicious_icon")' class="social_icon icon_del">Delicious</a>
	
		<a onClick='send_shortcode("googleplus_icon")' class="social_icon icon_gplus">Google Plus</a>
		<a onClick='send_shortcode("linked_in_icon")' class="social_icon icon_link">Linked In</a>
		<a onClick='send_shortcode("youtube_icon")' class="social_icon icon_youtube">Youtube</a>
	
		<a onClick='send_shortcode("flickr_icon")' class="social_icon icon_flickr">Flickr</a>
		<a onClick='send_shortcode("vimeo_icon")' class="social_icon icon_vimeo">Vimeo</a>
		<a onClick='send_shortcode("pinterest_icon")' class="social_icon icon_pin">Pinterest</a>
	</td>
</tr>
</table>
</div>	

<?php } ?>