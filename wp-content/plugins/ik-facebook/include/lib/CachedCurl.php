<?php
/*
This file is part of The IK Facebook Plugin .

The IK Facebook Plugin  is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

The IK Facebook Plugin  is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with The IK Facebook Plugin.  If not, see <http://www.gnu.org/licenses/>.
*/

	class CachedCurl
	{
		var $cache_time = 900; // 900 seconds [15 minutes]
		
		function __construct($cache_time = 900)
		{					
			$this->cache_time = $cache_time;
		}
				
		function load_url($url, $post_fields = false, $headers = false, $cacheResult = true)
		{
			$cache_key = strlen($url) . md5($url);
			
			// check for a cached result (if $cacheReult is true)
			if ($cacheResult && $result = get_transient($cache_key)) {
				return $result;
			}

			// load file with cURL
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL,            $url );
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
			curl_setopt($ch, CURLOPT_TIMEOUT,        10); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 

			if ($post_fields) {
				curl_setopt($ch, CURLOPT_POST,           true ); 
				curl_setopt($ch, CURLOPT_POSTFIELDS,    $post_fields);
			}
			
			if ($headers) {
				if (!is_array($headers)) {
					$headers = array($headers); // has to be wrapped in an array for curl
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				}
			}
			
			$result = curl_exec($ch);
			curl_close($ch);
			
			// store to cache (if asked)
			if ($cacheResult && $result) {
				set_transient($cache_key, $result, $this->cache_time);
			}
			return $result;
		}
	}
?>