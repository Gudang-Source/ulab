<?PHP
require_once("config.php");
require_once("action/kamar.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Data Kamar - <?PHP echo $c_name; ?></title>
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
					<?PHP 
					if(isset($_GET['msg'])){
						$msg = $_GET['msg'];
						if($msg==1){
							echo "<div class='alert alert-success'>Sukses menambahkan data Kamar baru!!</div>";
						}else if($msg==2){
							echo "<div class='alert alert-success'>Sukses menambahkan mengedit data Kamar!!</div>";
						}else if($msg==3){
							echo "<div class='alert alert-success'>Sukses menghapus data Kamar!!</div>";
						}
					}
					?>
					<div class='panel panel-default'>
						<div class='panel-heading'>Semua Data Kamar</div>
						<div class='panel-body'>
							<a class='btn btn-success' href='#tambah'><i class='fa fa-plus'></i> Tambah data kamar</a>
							<p>
							<table class="table table-hover table-bordered">
							  <thead>
								<tr>
								  <th>Kode Kamar</th>
								  <th>Nama Kamar</th>
								  <th>Tarif Normal</th>
								  <th>Tarif Khusus</th>
								  <th>Aksi</th>
								</tr>
							  </thead>
							  <tbody>
								<?PHP
								$semua_kamar = $db->fetch_multiple("select * from kamar_$c_nim order by kode_kamar_$c_nim DESC");
								if(is_array($semua_kamar)){
								foreach($semua_kamar as $kamar){
								//untuk dapatkan kode kamar 
								if($kamar["tipe_kamar_$c_nim"]==1){
									$kode_kamar = $prefix_kode_kamar_pria.$kamar["kode_kamar_$c_nim"];
								}else{
									$kode_kamar = $prefix_kode_kamar_wanita.$kamar["kode_kamar_$c_nim"];
								}
								?>
								<tr>
								<td><?PHP echo $kode_kamar; ?></td>
								<td><?PHP echo $kamar["nama_kamar_$c_nim"]; ?></td>
								<td><?PHP echo $app->rupiah($kamar["tarif_normal_$c_nim"],0); ?></td>
								<td><?PHP echo $app->rupiah($kamar["tarif_khusus_$c_nim"],0); ?></td>
								<td>
								<div class="btn-group">
								  <a onclick="return confirm('Are you sure you want to delete this data?');" href="kamar.php?act=hapus&kode=<?PHP echo $kamar["kode_kamar_$c_nim"]; ?>" class="btn btn-xs btn-danger"> <i class="fa fa-remove" title='Hapus'></i> </a> 
								</div>
								</td>
								</tr>
								<?PHP }}else{echo "Belum ada data!";} ?>
							  </tbody>
							</table>
						</div>
					</div>
					<div class='panel panel-success' id='tambah'>
						<div class='panel-heading'>Tambah Data Kamar</div>
						<div class='panel-body'>
							<form method='post' action='kamar.php'>
								<div class='form-group'>
									<label>Nama Kamar</label>
									<input type='text' class='form-control' name='nama' required/>
								</div>
								<div class='form-group'>
									<label>Kamar Untuk</label>
									<select name='tipe' class='form-control'>
										<option value='1'>Laki-Laki</option>
										<option value='1'>Perempuan</option>
									</select>
								</div>
								<div class='form-group'>
									<label>Tarif Normal</label>
									<input type='text' class='form-control' name='normal' required/>
								</div>
								<div class='form-group'>
									<label>Tarif Khusus</label>
									<input type='text' class='form-control' name='khusus' required/>
								</div>
								<input type='hidden' name='act' value='input'/>
								<button class='btn btn-success'>Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?PHP require_once(ROOT."/include/footer.php"); ?>
	</body>
	<?PHP require_once(ROOT."/include/js.php"); ?>
</html>