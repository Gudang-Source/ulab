<?PHP
SESSION_START();
$localhost = 1;
define('_DB_HOST', 'localhost');
define('_DB_USER', 'root');
define('_DB_PASS', '');
define('_DB_NAME', 'ujian_labor_dewa_802066'); //ganti sesuai dengan nama database kamu
define('ROOT', dirname(__FILE__));
define('DEBUG',true); //jika belum di periksa sama dosen, setting jadi TRUE, klu mau di cek oleh dosen set FALSE
if(DEBUG==true){error_reporting(E_ALL);}else{error_reporting(0);}
$c_nim = "802066"; //isi dengan nim kamu, contoh 066 atau 14066
$c_name = "Kontrakan SAR"; // isi dengan nama PT atau nama situs juga boleh
$c_author = "Dewa"; //nama pembuatnya di sini
$c_tema = "me"; //tema ada 1 - 16
$prefix_id_pelanggan = "PR"; //ini terserah mau di ganti juga boleh
$prefix_kode_kamar_pria = "KMP"; //ini terserah mau di ganti juga boleh
$prefix_kode_kamar_wanita = "KMW"; //ini terserah mau di ganti juga boleh
$prefix_kode_transaksi = "TR-"; //ini terserah mau di ganti juga boleh
$today = date("Y-m-d");
$now = date("H:i:s");
//start
require_once(ROOT."/core/core.php");
?>