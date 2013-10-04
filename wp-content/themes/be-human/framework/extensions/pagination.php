<?php 
	if( !function_exists('pagination') ){
		function pagination($pages = '', $range = 4)
		{
			 $showitems = ($range * 2)+1;  
		 
			 global $paged;
			 if(empty($paged)) $paged = 1;
	
			 if($pages == '')
			 {
				 global $wp_query;
				 
				 $pages = $wp_query->max_num_pages;
				 
				 if(!$pages)
				 {
					 $pages = 1;
				 }
			 }   
		 
			 if(1 != $pages)
			 {		
				echo '<section class="pagination">';
				  echo "<ul id='pagination'>";  
				  //echo '<li class="p-title">Page '.$paged.' of '.$pages.'</li>';
				  //<span>Page ".$paged." of ".$pages."</span>";
				 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
				 if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a></li>";
		 
				 for ($i=1; $i <= $pages; $i++)
				 {
					 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
					 {
						 echo ($paged == $i)? "<li class=\"active\"><a href='".get_pagenum_link($i)."'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
					 }
				 }
		 
				 if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a></li>";
				 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
				 echo "</ul>\n";
				 echo '</section>';
			 }
		}
	}
?>