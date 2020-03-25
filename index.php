<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<!-- bootstrap-4.4.1 -->
	<link rel="stylesheet" href="asset/plugin/bootstrap-4.4.1-dist/css/bootstrap.min.css" />
	
	<style>
	@media screen and (min-width: 100px) {
		section{
			padding:20px 20px 20px 20px;
		}
	}
	@media screen and (min-width: 576px) {
		section{
			padding:30px 30px 30px 30px;
		}
	}
	@media screen and (min-width: 768px) {
		section{
			padding:50px 50px 50px 50px;
		}
	}
	@media screen and (min-width: 992px) {
		section{
			padding:50px 50px 50px 50px;
		}
	}
	@media screen and (min-width: 1200px) {
		section{
			padding:50px 50px 50px 50px;
		}
	}
	</style>
	
	<!-- jQuery -->
	<script src="asset/plugin/jquery/jquery.min.js"></script>
	<!-- Kompress -->
	<script src="asset/plugin/kompres_image/kompres.js"></script>
	<!-- main -->
	<script src="asset/js/main.js?versi=1"></script>
</head>
<body>
	<?php
	$modul = (isset($_GET['modul']))? $_GET['modul'] : null;
	switch($modul){
	default:
	?>
	<section>
        <div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-info text-white">
							Kompres dan Upload Gambar By Riko Software
						</div>
						<div class="card-body">
							<center><a class="btn btn-primary" href="?modul=client_side">Kompress Gambar Client Side</a></center>
							<center>&nbsp;</center>
							<center><a class="btn btn-success" href="?modul=server_side">Kompress Gambar Server Side</a></center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	break;
	case "client_side":
	?>
	<section>
        <div class="container">
			<div class="card">
				<div class="card-header bg-info text-white">
					Kompres Gambar Client Side By Riko Software
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Gambarnya</label><br>
								<img src="" alt="" id="tampilan_gambarnya"></img>
							</div>
						</div>
						<div hidden class="col-md-12">
							<div class="form-group">
								<label>Base64 Gambarnya</label><br>
								<textarea class="form-control" id="hasil_base64_gbr"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Gambar Mau Diupload</label><br>
								<div class="input-group">
									<div class="custom-file">
										<input id="fotonya" name="fotonya" type="file" class="custom-file-input" accept="image/gif,image/JPEG,image/PNG" placeholder="Gambar Mau Diupload" />
										<label class="custom-file-label" for="foto_ktp">Pilih Gambar</label>
									</div>
								</div>
								<span id="pesan_gambar"></span>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<button id="btn_simpan" type="button" class="btn btn-success" tabindex="4" onClick='upload_client_side("fotonya","hasil_base64_gbr","pesan_gambar","btn_simpan");' ><i class="fas fa-cloud-upload-alt"></i>&nbsp;Simpan</button>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a class="btn btn-info" href="?modul=">Kembali</a>
				</div>
			</div>
		</div>
	</section>
	<script>
	$(document).ready(function(){	
		readURL_toBase64("fotonya","tampilan_gambarnya","hasil_base64_gbr","tipe_gambar");
	});
	</script>
	<?php
	break;
	case "server_side":
	?>
	<section>
        <div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-info text-white">
							Kompres Gambar Server Side By Riko Software
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Gambarnya</label><br>
										<img src="" alt="" id="tampilan_gambarnya"></img>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Gambar Mau Diupload</label><br>
										<div class="input-group">
											<div class="custom-file">
												<input id="fotonya" name="fotonya" type="file" class="custom-file-input" accept="image/gif,image/JPEG,image/PNG" placeholder="Gambar Mau Diupload" onChange='readURL(this,"tampilan_gambarnya");' />
												<label class="custom-file-label" for="foto_ktp">Pilih Gambar</label>
											</div>
										</div>
										<span id="pesan_gambar"></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<button id="btn_simpan" type="button" class="btn btn-success" tabindex="4" onClick='upload_server_side("fotonya","pesan_gambar","btn_simpan");' ><i class="fas fa-cloud-upload-alt"></i>&nbsp;Simpan</button>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<a class="btn btn-info" href="?modul=">Kembali</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php	
	break;
	}
	?>
</body>
	<!-- bootstrap-4.4.1 -->
	<script src="asset/plugin/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
</html>