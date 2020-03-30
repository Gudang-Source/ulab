<?PHP
class App{
	function is_valid_domain_name($domain_name){
		$domain = str_replace('www.','',$domain_name);
		if(preg_match('/([a-zA-Z0-9\-_]+\.)?[a-zA-Z0-9\-_]+\.[a-zA-Z]{2,5}/',$domain_name)){
			return true;
		}else{
			return false;
		}
	}
	function filesize_string($size_in_bytes){ #in bytes (B)
		$hasil_size_in_bytes = "Unknow KB";
		if ($size_in_bytes>1024 and $size_in_bytes < 1024000){
			$size_in_bytes=$size_in_bytes/1024;
			$me=substr($size_in_bytes,0,4);
			$hasil_size_in_bytes="$me KB";
		}
		
		if ($size_in_bytes>1024000 and $size_in_bytes < 1024000000){
			$size_in_bytes=$size_in_bytes/1024000;
			$me=substr($size_in_bytes,0,4);
			$hasil_size_in_bytes="$me MB";
		}
		if ($size_in_bytes>1024000000){
			$size_in_bytes=$size_in_bytes/1024000000;
			$me=substr($size_in_bytes,0,4);
			$hasil_size_in_bytes="$me GB";
		}
	return $hasil_size_in_bytes;
	}
	
	
	/**
	* GET CURRENT URL
	* since v1
	*/
	public function strleft($s1, $s2) {
		return substr($s1, 0, strpos($s1, $s2));
	}
	public function CURRENT_URL() {
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
	}
	
	
	/**
	* validate email address
	* since v1
	*/
	public function check_email($email){
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		  return false;
		}else{
			return true;
		}
	}
	
	/**
	* time ago
	* since v1
	*/
	function time_ago($date_time){
		$cur_time 	= time();
		$time_ago = strtotime($date_time);
		$time_elapsed 	= $cur_time - $time_ago;
		$seconds 	= $time_elapsed ;
		$minutes 	= round($time_elapsed / 60 );
		$hours 		= round($time_elapsed / 3600);
		$days 		= round($time_elapsed / 86400 );
		$weeks 		= round($time_elapsed / 604800);
		$months 	= round($time_elapsed / 2600640 );
		$years 		= round($time_elapsed / 31207680 );
		if($seconds <= 60){
			$data = "$seconds detik lalu";
		}else if($minutes <=60){
			$data = "$minutes menit lalu";
		}else if($hours <=24){
			$data = "$hours jam lalu";
		}else if($days <= 7){
			$data = "$days hari lalu";
		}else if($weeks <= 4.3){
			if($weeks==1){
				$data = "seminggu lalu";
			}else{
				$data = "$weeks minggu lalu";
			}
		}else{
			$time = substr($date_time, -8, 8);
			$date = stringdate($date_time);
			$data = "$date - $time";
		}
		return $data;
	}
	
	
	//rounded number
	public function bulatkan($angka, $precision = 1){
		if ($angka < 1000) {
        $n_format = number_format($angka);
		} else if ($angka > 1000 and $angka <= 1000000) {
			$n_format = number_format($angka / 1000, $precision) . 'K';
		} else if ($angka > 1000000 and $angka <= 1000000000) {
			$n_format = number_format($angka / 1000000, $precision) . 'M';
		} else {
			$n_format = number_format($angka / 1000000000, $precision) . 'B';
		}
		return $n_format;
	}
	
	//get extension file
	function get_ext($key) { 
		$key=strtolower(substr(strrchr($key, "."), 1));
		$key=str_replace("jpeg","jpg",$key);
		return $key;
	}
	
	public function cek_url($url){
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
			return false;
		}else{
			return true;
		}
	}
	
	//function download 
	//since version 1
	public function download2($path, $filename){
		clearstatcache();
		$file_extension = strtolower(substr(strrchr($filename,"."),1));
		$path = ROOT."/".$path;
		switch($file_extension){
		  case "pdf": $ctype="application/pdf"; break;
		  case "exe": $ctype="application/octet-stream"; break;
		  case "zip": $ctype="application/zip"; break;
		  case "rar": $ctype="application/rar"; break;
		  case "doc": $ctype="application/msword"; break;
		  case "xls": $ctype="application/vnd.ms-excel"; break;
		  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
		  case "gif": $ctype="image/gif"; break;
		  case "png": $ctype="image/png"; break;
		  case "jpeg":
		  case "jpg": $ctype="image/jpg"; break;
		  default: $ctype="application/proses";
		  }
		  $filename = "$filename";
		  header("Content-Type: octet/stream");
		  header("Pragma: private"); 
		  header("Expires: 0");
		  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		  header("Cache-Control: private",false); 
		  header("Content-Type: $ctype");
		  header("Content-Disposition: attachment; filename=\"".$filename."\";" );
		  header("Content-Transfer-Encoding: binary");
		  header("Content-Length:".filesize("$path"));
		  $fp = fopen($path, "rb");
		  ob_clean();
		  while (!feof($fp) && ( connection_status() == 0 ) && !connection_aborted()) {
			print( fread($fp, 10240 * 1024));
			flush();
			ob_flush();
		  }
		  fclose($fp);
	}
	
	function download ($file, $realname, $contenttype = 'application/octet-stream') {

		// Avoid sending unexpected errors to the client - we should be serving a file,
		// we don't want to corrupt the data we send
		@error_reporting(0);

		// Make sure the files exists, otherwise we are wasting our time
		if (!file_exists($file)) {
		  header("HTTP/1.1 404 Not Found");
		  exit;
		}

		// Get the 'Range' header if one was sent
		if (isset($_SERVER['HTTP_RANGE'])) $range = $_SERVER['HTTP_RANGE']; // IIS/Some Apache versions
		else if ($apache = apache_request_headers()) { // Try Apache again
		  $headers = array();
		  foreach ($apache as $header => $val) $headers[strtolower($header)] = $val;
		  if (isset($headers['range'])) $range = $headers['range'];
		  else $range = FALSE; // We can't get the header/there isn't one set
		} else $range = FALSE; // We can't get the header/there isn't one set

		// Get the data range requested (if any)
		$filesize = filesize($file);
		if ($range) {
		  $partial = true;
		  list($param,$range) = explode('=',$range);
		  if (strtolower(trim($param)) != 'bytes') { // Bad request - range unit is not 'bytes'
			header("HTTP/1.1 400 Invalid Request");
			exit;
		  }
		  $range = explode(',',$range);
		  $range = explode('-',$range[0]); // We only deal with the first requested range
		  if (count($range) != 2) { // Bad request - 'bytes' parameter is not valid
			header("HTTP/1.1 400 Invalid Request");
			exit;
		  }
		  if ($range[0] === '') { // First number missing, return last $range[1] bytes
			$end = $filesize - 1;
			$start = $end - intval($range[0]);
		  } else if ($range[1] === '') { // Second number missing, return from byte $range[0] to end
			$start = intval($range[0]);
			$end = $filesize - 1;
		  } else { // Both numbers present, return specific range
			$start = intval($range[0]);
			$end = intval($range[1]);
			if ($end >= $filesize || (!$start && (!$end || $end == ($filesize - 1)))) $partial = false; // Invalid range/whole file specified, return whole file
		  }      
		  $length = $end - $start + 1;
		} else $partial = false; // No range requested

		// Send standard headers
		header("Content-Type: $contenttype");
		header("Content-Length: $filesize");
		header('Content-Disposition: attachment; filename="'.$realname.'"');
		header('Accept-Ranges: bytes');

		// if requested, send extra headers and part of file...
		if ($partial) {
		  header('HTTP/1.1 206 Partial Content'); 
		  header("Content-Range: bytes $start-$end/$filesize"); 
		  if (!$fp = fopen($file, 'r')) { // Error out if we can't read the file
			header("HTTP/1.1 500 Internal Server Error");
			exit;
		  }
		  if ($start) fseek($fp,$start);
		  while ($length) { // Read in blocks of 8KB so we don't chew up memory on the server
			$read = ($length > 4096) ? 4096 : $length;
			$length -= $read;
			print(fread($fp,$read));
		  }
		  fclose($fp);
		} else readfile($file); // ...otherwise just send the whole file

		// Exit here to avoid accidentally sending extra content on the end of the file
		exit;

	  }
	  
		///
		function apache_request_headers() {
		  $arh = array();
		  $rx_http = '/\AHTTP_/';
		  foreach($_SERVER as $key => $val) {
			if( preg_match($rx_http, $key) ) {
			  $arh_key = preg_replace($rx_http, '', $key);
			  $rx_matches = array();
			  // do some nasty string manipulations to restore the original letter case
			  // this should work in most cases
			  $rx_matches = explode('_', $arh_key);
			  if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
				foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
				$arh_key = implode('-', $rx_matches);
			  }
			  $arh[$arh_key] = $val;
			}
		  }
		  return( $arh );
		}
	///
	
	//mata uang rupiah
	function rupiah($angka,$pre=0){
        $jadi="Rp.".number_format($angka,$pre,',','.');
        return $jadi;
    }
	
	function my_url_now(){
		$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		$my_url_now = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
		return $my_url_now;
	}
	
	function jadikan_kode_barang($kode){
		$data = $GLOBALS['prefix_kode_barang'];
		$hitung = count($kode);
		if($hitung==1){
			$data = "$data"."00$kode";
		}else if($hitung==2){
			$data = "$data"."0$kode";
		}else{
			$data = "$data$kode";
		}
		return $data;
	}
	
	function jadikan_id_pelanggan($id){
		$data = $GLOBALS['prefix_id_pelanggan'];
		$hitung = count($id);
		if($hitung==1){
			$data = "$data"."00$id";
		}else if($hitung==2){
			$data = "$data"."0$id";
		}else{
			$data = "$data$id";
		}
		return $data;
	}
	
	function jadikan_kode_kamar_pria($id){
		$data = $GLOBALS['prefix_kode_kamar_pria'];
		$hitung = count($id);
		if($hitung==1){
			$data = "$data"."00$id";
		}else if($hitung==2){
			$data = "$data"."0$id";
		}else{
			$data = "$data$id";
		}
		return $data;
	}
	
	function jadikan_kode_kamar_wanita($id){
		$data = $GLOBALS['prefix_kode_kamar_wanita'];
		$hitung = count($id);
		if($hitung==1){
			$data = "$data"."00$id";
		}else if($hitung==2){
			$data = "$data"."0$id";
		}else{
			$data = "$data$id";
		}
		return $data;
	}
	
	function jadikan_kode_transaksi($id){
		$data = $GLOBALS['prefix_kode_transaksi'];
		$hitung = count($id);
		if($hitung==1){
			$data = "$data"."00$id";
		}else if($hitung==2){
			$data = "$data"."0$id";
		}else{
			$data = "$data$id";
		}
		return $data;
	}
	function idr($angka){
        $jadi="Rp. ".number_format($angka,0,',','.');
        return $jadi;
    }
	
	function contains($soource,$partof){
		$hasil_validate=substr_count($soource, $partof);
		if($hasil_validate>0){
			return true;
		}else{
			return false;
		}
	}
}
?>