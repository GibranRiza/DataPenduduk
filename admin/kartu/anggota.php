<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_pdd p inner join tb_kk k on k.id_pend=p.id_pend WHERE id_kk='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek);
		
		$kk=$data_cek['id_kk'];
    }
?>


<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-users"></i> Anggota KK</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">


			<input type='hidden' class="form-control" id="id_kk" name="id_kk" value="<?php echo $data_cek['id_kk']; ?>"
			 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nomor KK | Kepala Keluarga</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="no_kk" name="no_kk" value="<?php echo $data_cek['no_kk']; ?>"
					 readonly/>
				</div>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data_cek['nama']; ?>"
					 readonly/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php echo $data_cek['kelurahan']; ?>, RT <?php echo $data_cek['rt']; ?> RW <?php echo $data_cek['rw']; ?>"
					 readonly/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Anggota</label>
				<div class="col-sm-4">
					<select name="id_pend" id="id_pend" class="form-control select2bs4" required>
						<option selected="selected">- Penduduk -</option>
						<?php
                        // ambil data dari database
                        $query = "select * from tb_pdd where status='Ada'";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
							// Cek Nilai Value dari $row['data'];
							$nik = isset($row['nik']) ? $row['nik'] : '';
							$id_pend = isset($row['id_pend']) ? $row['id_pend'] : '';
							$nama = isset($row['nama']) ? $row['nama'] : '';
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
				<div class="col-sm-3">
					<select name="hubungan" id="hubungan" class="form-control">
						<option>- Hub Keluarga -</option>
						<option>Istri</option>
						<option>Anak</option>
					</select>
				</div>
				<input type="submit" name="Simpan" value="Tambah" class="btn btn-success">
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>NIK</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Hub Keluarga</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>

							<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT p.nik, p.nama, p.jekel, a.hubungan, a.id_anggota 
			  from tb_pdd p inner join tb_anggota a on a.id_pend=p.id_pend where status='Ada' and id_kk=$kk");
              while ($data= $sql->fetch_assoc()) {
            ?>

							<tr>
								<td>
									<?php echo $data['nik']; ?>
								</td>
								<td>
									<?php echo $data['nama']; ?>
								</td>
								<td>
									<?php echo $data['jekel']; ?>
								</td>
								<td>
									<?php echo $data['hubungan']; ?>
								</td>
								<td>
									<a href="?page=del-anggota&kode=<?php echo $data['id_anggota']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
									 title="Hapus" class="btn btn-danger btn-sm">
										<i class="fa fa-trash"></i>
									</a>
								</td>
							</tr>

							<?php
              }
            ?>
						</tbody>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<a href="?page=data-kartu" title="Kembali" class="btn btn-warning">Kembali</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
        $sql_simpan = "INSERT INTO tb_anggota (id_kk, id_pend, hubungan) VALUES (
            '".$_POST['id_kk']."',
            '".$_POST['id_pend']."',
            '".$_POST['hubungan']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=anggota';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=anggota';
          }
      })</script>";
    }}
