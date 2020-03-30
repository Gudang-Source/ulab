<?PHP
if(isset($_REQUEST['act'])){
	$act=$_REQUEST['act'];
	if($act=='input'){	
		//input data baru
		$nama = $_POST['nama'];
		$normal = abs((int)$_POST['normal']);
		$khusus = abs((int)$_POST['khusus']);
		$tipe = abs((int)$_POST['tipe']);
		$db->query("insert into kamar_$c_nim values('','$nama','$normal','$khusus','$tipe')");
		header("location:kamar.php?msg=1");
	}
	if($act=='hapus'){
		$kode=abs((int)$_GET['kode']);
		$db->query("delete from kamar_$c_nim where kode_kamar_$c_nim='$kode'");
		header("location:kamar.php?msg=3");
	}
}
?>