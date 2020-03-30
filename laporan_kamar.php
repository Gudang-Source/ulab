<?PHP
require_once("config.php");
if(isset($_GET['id'])){
	$kode_kamar = abs((int)$_GET['id']);
	$data_kamar = $db->fetch("select * from kamar_$c_nim where kode_kamar='$kode_kamar'");
	$nama_kamar = $data_kamar['nama_kamar'];
}else{
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Laporan Kamar - <?PHP echo "$nama_kamar - $c_name"; ?></title>
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
						<div class='panel-heading'>Laporan</div>
						<div class='panel-body'>
							<center>
								<h3><?PHP echo $c_name; ?></h3>
								<h4>Laporan Pendapatan Per Kamar</h4>
								<h5>Kamar : <?PHP echo $nama_kamar ?> </h5>
								<p>&nbsp;</p>
							</center>
							
							<table class="table table-hover table-bordered">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Id Pelanggan</th>
								  <th>Nama Pelanggan</th>
								  <th>Jenis Kelamin</th>
								  <th>Lama Inap (hari)</th>
								  <th>Fasilistas Tambahan</th>
								  <th>Biaya Kamar</th>
								  <th>Biaya Fasilistas Tambahan</th>
								  <th>Total Tagihan</th>
								</tr>
							  </thead>
							  <tbody>
								<?PHP
								$no = 1;
								$grand_total = 0;
								$semua_transaksi = $db->fetch_multiple("select p.nama_pelanggan_$c_nim,p.jenis_kelamin_$c_nim, k.nama_kamar_$c_nim,k.tarif_normal_$c_nim,k.tarif_khusus_$c_nim,t.* from transaksi_$c_nim t
								INNER JOIN pelanggan_$c_nim p ON t.id_pelanggan_$c_nim=p.id_pelanggan_$c_nim
								INNER JOIN kamar_$c_nim k ON t.kode_kamar_$c_nim=k.kode_kamar_$c_nim
								where k.kode_kamar_$c_nim='$kode_kamar'
								order by t.id_transaksi_$c_nim DESC");
								if(is_array($semua_transaksi)){
								foreach($semua_transaksi as $trx){
								//logika biaya kamar 
								$lama_inap = $trx["lama_inap_$c_nim"];
								if($lama_inap>10){
									$biaya_kamar = $trx["tarif_khusus_$c_nim"]*$lama_inap;
								}else{
									$biaya_kamar = $trx["tarif_normal_$c_nim"]*$lama_inap;
								}
								
								
								//logika untuk mendapatkan harga fasilitas tambahan
								$fasilitas_tambahan = $trx["fasilitas_tambahan_$c_nim"];
								$biaya_fasilitas_tambahan = 0;
								if($app->contains($fasilitas_tambahan,"Lemari")){
									$biaya_fasilitas_tambahan+=10000*$lama_inap;
								}
								if($app->contains($fasilitas_tambahan,"Kursi")){
									$biaya_fasilitas_tambahan+=8000*$lama_inap;
								}
								if($app->contains($fasilitas_tambahan,"Kipas")){
									$biaya_fasilitas_tambahan+=8000*$lama_inap;
								}
								
								//logika total tagihan
								$total_tagihan = $biaya_kamar+$biaya_fasilitas_tambahan;
								$grand_total += $total_tagihan;
								$kode_kmr = $trx["kode_kamar_$c_nim"];
								$nama_kmr = $trx["nama_kamar_$c_nim"];
								?>
								<tr>
								<td><?PHP echo $no; ?></td>
								<td><?PHP echo $app->jadikan_id_pelanggan($trx["id_pelanggan_$c_nim"]); ?></td>
								<td><?PHP echo $trx["nama_pelanggan_$c_nim"]; ?></td>
								<td><?PHP echo $trx["jenis_kelamin_$c_nim"]; ?></td>
								<td><?PHP echo $lama_inap; ?></td>
								<td><?PHP echo $fasilitas_tambahan; ?></td>
								<td><?PHP echo $app->rupiah($biaya_kamar); ?></td>
								<td><?PHP echo $app->rupiah($biaya_fasilitas_tambahan); ?></td>
								<td><?PHP echo $app->rupiah($total_tagihan); ?></td>
								</tr>
								<?PHP $no++;}
								?>
								<tr>
								<td colspan='8'>Grand Total</td>
								<td><?PHP echo $app->rupiah($grand_total); ?></td>
								</tr>
								<?PHP
								}else{echo "Belum ada data!";} ?>
							  </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?PHP require_once(ROOT."/include/footer.php"); ?>
	</body>
	<?PHP require_once(ROOT."/include/js.php"); ?>
</html>