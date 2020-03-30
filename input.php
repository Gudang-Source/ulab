<?PHP
require_once("config.php");
require_once("action/input.php");
$cek_pelanggan = $db->num_rows("select id_pelanggan_$c_nim from pelanggan_$c_nim");
$cek_kamar = $db->num_rows("select kode_kamar_$c_nim from kamar_$c_nim");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Input Data Transaksi - <?PHP echo $c_name; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?PHP require_once(ROOT."/include/css.php"); ?>
	</head>
	<body>
		<header>
			<?PHP require_once(ROOT."/include/header.php"); ?>
		</header>
		<div class='container' style='margin-top:70px'>
			<div class='row' style='min-height:520px'>
				<div class='col-md-12'>
					<div class='panel panel-danger' id='tambah'>
						<div class='panel-heading'>Tambah Data Transaksi</div>
						<div class='panel-body'>
							<?PHP 
							if(isset($_GET['msg'])){
								$msg = $_GET['msg'];
								if($msg==1){
									echo "<div class='alert alert-success'>Sukse menambahkan data transaksi, silahkan cek di menu laporan!!</div>";
								}
							}
							?>
							<?PHP if($cek_kamar!=0 and $cek_pelanggan!=0){ ?>
							<form method='post' action='input.php'>
								<div class='form-group'>
									<label>Pilih Pelanggan</label>
									<select name='id_pelanggan' class='form-control'>
										<?PHP
											$semua_pelanggan = $db->fetch_multiple("select * from pelanggan_$c_nim order by id_pelanggan_$c_nim DESC");
											foreach($semua_pelanggan as $pelanggan){
												$id_pelanggan = $app->jadikan_id_pelanggan($pelanggan["id_pelanggan_$c_nim"]);
												$id_pel = $pelanggan["id_pelanggan_$c_nim"];
												$nama_pel = $pelanggan["nama_pelanggan_$c_nim"];
												echo "<option value='$id_pel'>$nama_pel ::: $id_pelanggan</option>";
											}
										?>
									</select>
								</div>
								<div class='form-group'>
									<label>Pilih Kamar</label>
									<select name='kode_kamar' class='form-control'>
										<?PHP
											$semua_kamar = $db->fetch_multiple("select * from kamar_$c_nim order by kode_kamar_$c_nim DESC");
											foreach($semua_kamar as $kamar){
												//untuk dapatkan kode kamar 
												$kode_kmr = $kamar["kode_kamar_$c_nim"];
												$nama_kmr = $kamar["nama_kamar_$c_nim"];
												if($kamar['tipe_kamar']==1){
													$kode_kamar = $prefix_kode_kamar_pria.$kamar["kode_kamar_$c_nim"];
												}else{
													$kode_kamar = $prefix_kode_kamar_wanita.$kamar["kode_kamar_$c_nim"];
												}
												$harga_kamar_normal = $app->rupiah($kamar["tarif_no_$c_nim"]);
												echo "<option value='$kode_kmr'>$nama_kmr ::: $kode_kamar</option>";
											}
										?>
									</select>
								</div>
								<div class='form-group'>
									<label>Lama Inap</label>
									<input type='number' name='lama_inap' class='form-control' required/>
								</div>
								<div class='form-group alert alert-success'>
									<label>Fasilitas tambahan</label>
									<p>
									Lemari (Rp10.000/hari) <input name='f_lemari' type="checkbox"/><br>
									Kursi (Rp8.000/hari)<input name='f_kursi' type="checkbox"/><br>
									Kipas Angin (Rp10.000)<input name='f_kipas' type="checkbox"/><br>
								</div>
								<input type='hidden' name='act' value='input'/>
								<button class='btn btn-success'>Simpan</button>
							</form>
							<?PHP }else{echo "Oppsss... Harap masukan daftar kamar dan daftar pelanggan dulu!";} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?PHP require_once(ROOT."/include/footer.php"); ?>
	</body>
	<?PHP require_once(ROOT."/include/js.php"); ?>
</html>