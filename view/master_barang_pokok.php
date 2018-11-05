<section class="content-header">
	<h1>
		Master barang pokok
		<small>Daftar barang pokok</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Master barang pokok</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">Master barang pokok</h6>
			<div class="box-tools pull-right">				
				<button type="button" class="btn btn-box-tool" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align:center">Foto</th>
							<th style="text-align:center">Kode</th>
							<th>Nama Barang</th>
							<th style="text-align:center">Satuan</th>
							<th style="text-align:right;">Harga</th>
							<th style="width:10%;text-align:center;"><i class="fa fa-gears fa-fw"></i></th>
						</tr>
					</thead>

					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<form action="" method="post" id="form_data" enctype="multipart/form-data">
	<div class="modal fade" id="modalForm">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
					<h5 class="modal-title" id="modalTitle"></h5>
				</div>

				<div class="modal-body">
					<input type="hidden" id="act" name="act" value="save">
					<input type="hidden" id="txtId" name="id" value="0">

					<div class="row">
						<div class="col-md-6">
							<label class="small-label">Nama barang_pokok</label>
							<input type="text" class="form-control input-sm" name="nama_barang_pokok" id="txtNama">
						</div>

						<div class="col-md-6">
							<label class="small-label">Harga</label>
							<input type="number" class="form-control input-sm" name="harga" id="txtHarga">
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label class="small-label">Satuan</label>
							<select class="form-control input-sm" id="txtIdSatuan" name="id_satuan">
							</select>
						</div>

						<div class="col-md-6">
							<label class="small-label">Satuan 2</label>
							<select class="form-control input-sm" id="txtIdSatuan2" name="id_satuan2">
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label class="small-label">Upload Foto</label>
							<input type="file" name="foto" id="foto" class="form-control input-sm">
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
					<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check fa-fw"></i> Simpan</button>
				</div>
			</div>
		</div>
	</div>
</form>

<div class="modal fade" id="modalDetail">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
				<h5 class="modal-title"><i class="fa fa-file fa-fw"></i> Detail Data</h5>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
						<a href="" id="previewLink" target="_blank"><img src="" class="img-responsive img-thumbnail" style="height: 150px;width: 150px;" id="previewImage"></a>
					</div>

					<div class="col-md-8 col-sm-12 col-xs-12">
						<div class="table-responsive" style="margin-top: 5px;">
							<table class="table table-condensed">
								<tr>
									<td style="width: 30%">Kode</td>
									<td>: <span id="lblKode"></span></td>
								</tr>
								<tr>
									<td>Nama Barang</td>
									<td>: <span id="lblNama"></span></td>
								</tr>
								<tr>
									<td>Harga</td>
									<td>: <span id="lblHarga"></span></td>
								</tr>
								<tr>
									<td>Satuan</td>
									<td>: <span id="lblSatuan"></span></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				
				
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	var tabel = $("#dataGrid").DataTable({
		processing: true,
		serverSide: true,
		paging: true,
		order: [
		[0, "desc"]
		],
		"ajax": {
			url: "controller/master_barang_pokok.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [
		{
			sortable: false,
			className: "centerCol",
			width: "12%",
			data: "foto",
			render: function(data){
				return "<img src='upload/"+(data === null || data === '' ? 'notfound.jpg' : data)+"' class='img-responsive img-thumb img-link' style='width:30px;height:30px;' />"
			}
			
		},
		{
			className: "centerCol",
			width: "15%",
			data: "kode_barang_pokok"
		},
		{data: "nama_barang_pokok"},
		{
			className: "centerCol",
			width: "12%",
			data: { 
				strSatuan: "strSatuan",
				strSatuan2: "strSatuan2"
			},
			render: function(data){
				return data.strSatuan+", "+data.strSatuan2;
			}
		},
		{
			className: "rightCol",
			width: "12%",
			data: "harga",
			render: function(data, type, row){
				return rupiah(data);
			}
		},
		{
			data: null,
			className: "centerCol",
			sortable: false,
			defaultContent: "<button type='button' class='btn btn-info btn-xs btnEdit'><i class='fa fa-pencil fa-fw'></i></button> <button type='button' class='btn btn-danger btn-xs btnDel'><i class='fa fa-trash fa-fw'></i></button>"
		}
		]
	});

	$("#dataGrid tbody").on("click", ".btnEdit", function(){
		var data = tabel.row($(this).parents("tr")).data();
		edit(data[0]);
	});

	$("#dataGrid tbody").on("click", ".btnDel", function(){
		var data = tabel.row($(this).parents("tr")).data();
		del(data[0]);
	});

	$("#dataGrid tbody").on("click", ".img-link", function(){
		var data = tabel.row($(this).parents("tr")).data();
		detail(data[0]);
	});

	function detail(id){

		$.post("controller/master_barang_pokok.php",{
			act: "getData",
			id: id
		}, function(data){

			var dataSet = data.result[0];

			$("#lblKode").html(dataSet.kode_barang_pokok);
			$("#lblNama").html(dataSet.nama_barang_pokok);
			$("#lblHarga").html(rupiah(dataSet.harga));
			$("#lblSatuan").html(dataSet.strSatuan+", "+dataSet.strSatuan2);

			var dataImg = dataSet.foto === null || dataSet.foto === "" ? "notfound.jpg" : dataSet.foto;

			$("#previewImage").attr("src", "upload/"+dataImg);
			$("#previewLink").attr("href", "upload/"+dataImg);

		}, "json");

		$("#modalDetail").modal({
			backdrop: "static"
		});
	}

	function resetField(){
		$("#txtId").val("0");
		$("#modalForm .form-control").val("");
		$("#txtNama").focus();
		$("#txtIdSatuan, #txtIdSatuan2").val("0");

	}


	$(document).ready(function(){
		$("#form_data").on("submit", function(e){
			e.preventDefault();

			$.ajax({
				type: "post",
				url: "controller/master_barang_pokok.php",
				processData: false,
				contentType: false,
				cache: false,
				data: new FormData(this),
				dataType: "json",
				success: function(data){

					switch(data.status){
						case "invalid_extension":
						alert("Extensi file yang di izinkan hanya gambar!");
						break;
						case "error_upload":
						alert("Gagal mengupload file gambar!");
						break;
						case false:
						alert("Gagal menyimpan data!");
						break;
						case true:
						$("#modalForm").modal("hide");
						tabel.ajax.reload();
						break;
					}
				}
			});

		});
	});
	

	function getSatuan(){
		$.post("controller/master_barang_pokok.php",{
			act: "getSatuan"
		}, function(data){	
			var lst = "";

			lst += "<option value='0' selected>- Pilih Satuan -</option>";

			$(data.result).each(function(i, val){
				lst += "<option value='"+val.id_satuan+"'>"+val.kode_satuan+"</option>"
			});

			$("#txtIdSatuan").html(lst);
			$("#txtIdSatuan2").html(lst);

		}, "json");
	}

	getSatuan();

	function addNew(){
		resetField();

		$("#modalTitle").html("<i class='fa fa-plus fa-fw'></i> Tambah Baru");

		$("#modalForm").modal({
			backdrop: "static"
		});
	}

	function edit(id){
		resetField();

		$.post("controller/master_barang_pokok.php",{
			act: "getData",
			id: id
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id_barang_pokok);
			$("#txtNama").val(dataSet.nama_barang_pokok);
			$("#txtHarga").val(dataSet.harga);
			$("#txtIdSatuan").val(dataSet.id_satuan);
			$("#txtIdSatuan2").val(dataSet.id_satuan2);

			$("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");

			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function del(id){
		var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

		if(konfirmasi){
			$.post("controller/master_barang_pokok.php",{
				act: "del",
				id: id
			}, function(data){
				if(data.status === true){
					alert("Data berhasil di hapus");
					tabel.ajax.reload();
				}else{
					alert("Data gagal di hapus");
				}

			}, "json");
		}
	}

	function save(){
		var id = $("#txtId").val();
		var nama = $("#txtNama").val();
		var telpon = $("#txtTelpon").val();
		var alamat = $("#txtAlamat").val();

		$.post("controller/master_barang_pokok.php",{
			act: "save",
			id: id,
			nama: nama,
			telpon: telpon,
			alamat: alamat
		}, function(data){

			if(data.status === true){
				alert("Data berhasil di simpan");
				$("#modalForm").modal("hide");
				tabel.ajax.reload();
			}else{
				alert("Data gagal di simpan");
			}

		}, "json");

	}



</script>