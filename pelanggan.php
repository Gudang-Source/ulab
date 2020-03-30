<?PHP
require_once("config.php");
require_once("action/pelanggan.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Data Pelanggan - <?PHP echo $c_name; ?></title>
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
							echo "<div class='alert alert-success'>Sukses menambahkan data pelanggan baru!!</div>";
						}else if($msg==2){
							echo "<div class='alert alert-success'>Sukses menambahkan mengedit data pelanggan!!</div>";
						}else if($msg==3){
							echo "<div class='alert alert-success'>Sukses menghapus data pelanggan!!</div>";
						}
					}
					?>
					<div class='panel panel-default'>
						<div class='panel-heading'>Semua Data Pelanggan</div>
						<div class='panel-body'>
							<a class='btn btn-success' href='#tambah'><i class='fa fa-plus'></i> Tambah data pelanggan</a>
							<p>
							<table class="table table-hover table-bordered">
							  <thead>
								<tr>
								  <th>ID Pelanggan</th>
								  <th>Nama Pelanggan</th>
								  <th>No HP</th>
								  <th>Aksi</th>
								</tr>
							  </thead>
							  <tbody>
								<?PHP
								$semua_pelanggan = $db->fetch_multiple("select * from pelanggan_$c_nim order by id_pelanggan_$c_nim DESC");
								
								if(is_array($semua_pelanggan)){
								foreach($semua_pelanggan as $pelanggan){
								?>
								<tr>
								<td><?PHP echo $app->jadikan_id_pelanggan($pelanggan["id_pelanggan_$c_nim"]); ?></td>
								<td><?PHP echo $pelanggan["nama_pelanggan_$c_nim"]; ?></td>
								<td><?PHP echo $pelanggan["jenis_kelamin_$c_nim"]; ?></td>
								<td>
								<div class="btn-group">
								  
								  <a onclick="return confirm('Are you sure you want to delete this data?');" href="pelanggan.php?act=hapus&id=<?PHP echo $pelanggan['id_pelanggan_$c_nim']; ?>" class="btn btn-xs btn-danger"> <i class="fa fa-remove" title='Hapus'></i> </a> 
								</div>
								</td>
								</tr>
								<?PHP }}else{echo "Belum ada data!";} ?>
							  </tbody>
							</table>
						</div>
					</div>
					<div class='panel panel-success' id='tambah'>
						<div class='panel-heading'>Tambah Data Pelanggan</div>
						<div class='panel-body'>
							<form method='post' action='pelanggan.php'>
								<div class='form-group'>
									<label>Nama Pelanggan</label>
									<input type='text' class='form-control' name='nama' required/>
								</div>
								<div class='form-group'>
									<label>Jenis Kelamin Pelanggan</label>
									<select name='jk' class='form-control'>
										<option>Laki-Laki</option>
										<option>Perempuan</option>
									</select>
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