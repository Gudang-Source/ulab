<?PHP
if(isset($_REQUEST['act'])){
	$act=$_REQUEST['act'];
	if($act=='input'){	
		//input data baru
		$kode_kamar = $_POST['kode_kamar'];
		$id_pelanggan = $_POST['id_pelanggan'];
		$lama_inap = $_POST['lama_inap'];
		//fasilitas
		$fasilitas_tambahan = "";
		if(isset($_POST['f_lemari'])){
			if(empty($fasilitas_tambahan)){
				$fasilitas_tambahan = $fasilitas_tambahan."Lemari";
			}else{
				$fasilitas_tambahan = $fasilitas_tambahan.", Lemari";
			}
		}
		if(isset($_POST['f_kursi'])){
			if(empty($fasilitas_tambahan)){
				$fasilitas_tambahan = $fasilitas_tambahan."Kursi";
			}else{
				$fasilitas_tambahan = $fasilitas_tambahan.", Kursi";
			}
		}
		if(isset($_POST['f_kipas'])){
			if(empty($fasilitas_tambahan)){
				$fasilitas_tambahan = $fasilitas_tambahan."Kipas Angin";
			}else{
				$fasilitas_tambahan = $fasilitas_tambahan.", Kipas Angin";
			}
		}
		if($cara_pembayaran==1){
			$data_kamar = $db->fetch("select harga_kamar from kamar_$c_nim where kode_kamar='$kode_kamar'");
			$uang_muka=$data_kamar['harga_kamar'];
			$jangka_waktu = 0;
		}
		$db->query("insert into transaksi_$c_nim values('','$id_pelanggan','$kode_kamar','$lama_inap','$fasilitas_tambahan')");
		header("location:input.php?msg=1");
	}
}
?>