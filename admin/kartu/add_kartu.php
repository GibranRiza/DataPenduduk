<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nomor KK</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="Nomor KK" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kepala Keluarga</label>
				<div class="col-sm-6">
					<!-- <input type="text" class="form-control" id="kepala" name="kepala" placeholder="Nama Kepala Keluarga" required> -->
					<select name="id_pend" id="id_pend" class="form-control" required>
						<option selected="selected">- Pilih Penduduk -</option>
						<?php
				// ambil data dari database
				$query = "select * from tb_pdd where status='Ada'";
				$hasil = mysqli_query($koneksi, $query);
				while ($row = mysqli_fetch_array($hasil)) {
				?>
						<option value="<?php echo $row['id_pend'] ?>">
							<?php echo $row['nik'] ?>
							-
							<?php echo $row['nama'] ?>
						</option>
						<?php
				}
				?>
					</select>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-kartu" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
        $sql_simpan = "INSERT INTO tb_kk (no_kk, id_pend) VALUES (
            '".$_POST['no_kk']."',
            '".$_POST['id_pend']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-kartu';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-kartu';
          }
      })</script>";
    }}
     //selesai proses simpan data
