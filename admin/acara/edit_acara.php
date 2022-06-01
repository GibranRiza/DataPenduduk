<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_acara WHERE acara='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Acara</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Acara</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="acara" name="acara" placeholder="Acara" value="<?php echo $data_cek['acara']; ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Detail</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="detail" name="detail" placeholder="Detail Acara" value="<?php echo $data_cek['detail']; ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Waktu & Tanggal</label>
				<div class="col-sm-6">
					<input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Waktu & Tanggal" value="<?php echo $data_cek['tanggal']; ?>" required>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-info">
			<a href="?page=data-acara" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Ubah'])){
    $sql_ubah = "UPDATE tb_acara SET 
		acara='".$_POST['acara']."',
		detail='".$_POST['detail']."',
		tanggal='".$_POST['tanggal']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-acara';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=edit-acara';
        }
      })</script>";
    }}
