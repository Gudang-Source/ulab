<?PHP
if(isset($_REQUEST['act'])){
	$act=$_REQUEST['act'];
	if($act=='input'){	
		//input data baru
		$nama = $_POST['nama'];
		$jk = $_POST['jk'];
		$db->query("insert into pelanggan_$c_nim values('','$nama','$jk')");
		header("location:pelanggan.php?msg=1");
	}
	if($act=='hapus'){
		$id=abs((int)$_GET['id']);
		$db->query("delete from pelanggan_$c_nim where id_pelanggan_$c_nim='$id'");
		header("location:pelanggan.php?msg=3");
	}
}
?>