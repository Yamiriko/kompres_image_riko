var ukuran_gambar = 0;
var tipe_filenya = "";

function readURL(input,tag_gambar) {
	tipe_filenya = input.files[0].type;
	console.log("File type : " + tipe_filenya);
	let valid_gambar = ["image/jpeg","image/png","image/gif"];
	if (input.files && input.files[0]) {
		if ($.inArray(input.files[0].type, valid_gambar) !== -1){
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#' + tag_gambar).attr('hidden', false);
				$('#' + tag_gambar).attr('src', e.target.result);
				$('#' + tag_gambar).addClass("img-rounded");
				$('#' + tag_gambar).css("width", "300px");
				$('#' + tag_gambar).css("padding-bottom", "15px");
				ukuran_gambar = input.files[0].size;
			}
			reader.readAsDataURL(input.files[0]);
		}
		else {
			toastr.error('File yang diupload hanya boleh berformat jpg/jpeg, gif, dan png.');
			$(this).focus();
		}
	}
}

function readURL_toBase64(selektor_input,tag_gambar,hasilbase64) {	
	const compressor = new Compress();	
	$("#" + selektor_input).on('change',function(evt){
		tipe_filenya = this.files[0].type;
		console.log("File type : " + tipe_filenya);
		const files = [...evt.target.files];
		let valid_gambar = ["image/jpeg","image/png","image/gif"];
		if ($.inArray(tipe_filenya, valid_gambar) !== -1){
			compressor.compress(files, {
				size: 4, //Ukuran maximum file
				quality: .75, //Kualitas gambar
				maxWidth: 640, //Lebar gambar
				//maxHeight: 320, //Tinggi Kabar
				resize: true //Gunakan ini jika ada maxWidth atau ada maxHeight atau keduanya ada
			}).then((results) => {
				$('#' + tag_gambar).attr('hidden', false);
				$('#' + tag_gambar).css('width', '300px');
				$('#' + tag_gambar).css('padding-bottom', '15px');
				console.log(results);
				const output = results[0];
				const file = Compress.convertBase64ToFile(output.data, output.ext);
				console.log(file);
				$('#' + tag_gambar).attr('src', output.prefix + output.data);
				$('#' + hasilbase64).val(output.data);
				ukuran_gambar = this.files[0].size;
			});
		}
		else {
			$('#' + tag_gambar).attr('hidden', true);
			toastr.error('File yang diupload hanya boleh berformat jpg/jpeg, gif, dan png.');
			$("#" + selektor_input).focus();
		}
	});
}

function upload_client_side(selektor_foto,selektor_base64,pesannya,tombol){
	console.log("ukuran_file : " + ukuran_gambar);
	if (ukuran_gambar > 0){
		let fd = new FormData();
		if (tipe_filenya == "image/jpeg"){
			fd.append("ext_gambar","jpg");
		}
		else if (tipe_filenya == "image/png"){
			fd.append("ext_gambar","png");
		}
		else if (tipe_filenya == "image/gif"){
			fd.append("ext_gambar","gif");
		}
		fd.append("modul","client_side");
		fd.append("act","upload");
		fd.append("gambar",$("#" + selektor_base64).val());
		
		let urlbro = "aksi/restapi.php";
		
		$.ajax({
			type: "POST",
			url: urlbro,
			processData: false,
			contentType: false,
			mimeType: "multipart/form-data",
			data: fd,
			beforeSend:function(){
				{
					$("#" + pesannya).html('<mark><i>Loading...</i></mark>');
					$("#" + tombol).attr("disabled",true);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				{
					$("#" + pesannya).html('<mark><i>' + jqXHR + '</i></mark>');
					$("#" + tombol).attr("disabled",false);
				};
			},
			success: function(response, textStatus, jqXHR) {
				{
					$("#" + tombol).attr("disabled",false);
					$('#hasil_base64_gbr').val(null);
					let obj = JSON.parse(response);
					if (obj.pesan == "sukses"){
						$("#" + pesannya).html('<mark><i>Sukses</i></mark>');
					}
					else if (obj.pesan == "gagal"){
						$("#" + pesannya).html('<mark><i>Gagal</i></mark>');
					}
					else if (obj.pesan == "gambar_kosong"){
						$("#" + pesannya).html('<mark><i>Gambar Kosong</i></mark>');
					}
				};
			}
		});
	}
	else {
		alert("Gambar Belum Dipilih");
	}
}

function upload_server_side(selektor_foto,pesannya,tombol){
	console.log("ukuran_file : " + ukuran_gambar);
	if (ukuran_gambar > 0){
		let fd = new FormData();
		fd.append("modul","server_side");
		fd.append("act","upload");
		var foto_preview = $('#' + selektor_foto)[0].files[0];
		fd.append("fotonya",foto_preview);
		
		let urlbro = "aksi/restapi.php";
		
		$.ajax({
			type: "POST",
			url: urlbro,
			processData: false,
			contentType: false,
			mimeType: "multipart/form-data",
			data: fd,
			beforeSend:function(){
				{
					$("#" + pesannya).html('<mark><i>Loading...</i></mark>');
					$("#" + tombol).attr("disabled",true);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				{
					$("#" + pesannya).html('<mark><i>' + jqXHR + '</i></mark>');
					$("#" + tombol).attr("disabled",false);
				};
			},
			success: function(response, textStatus, jqXHR) {
				{
					$("#" + tombol).attr("disabled",false);
					$('#hasil_base64_gbr').val(null);
					let obj = JSON.parse(response);
					if (obj.pesan == "sukses"){
						$("#" + pesannya).html('<mark><i>Sukses</i></mark>');
					}
					else if (obj.pesan == "gagal"){
						$("#" + pesannya).html('<mark><i>Gagal</i></mark>');
					}
					else if (obj.pesan == "gambar_kosong"){
						$("#" + pesannya).html('<mark><i>Gambar Kosong</i></mark>');
					}
				};
			}
		});
	}
	else {
		alert("Gambar Belum Dipilih");
	}
}