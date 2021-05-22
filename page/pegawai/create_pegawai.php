<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Tambah Data Pegawai </h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Masukan Identitas Anda</h6>
    </div>
    <div class="card-body">
      <div class="col-lg-12">
        <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama" name="nama" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Alamat Anda" name="alamat" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nomor Telepon</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nomor Telepon" name="telp" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Username" name="username" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Masukan Password" name="password" required>
              </div>
              <div class="form-group">
                <label for="identity">Upload Foto Identitas Pegawai</label>
                <input type="file" required name="foto" class="form-control input-lgn" accept="images/*">
                <small style="color: red">Foto dengan format jpeg, jpg, atau png, serta tidak melebihi 1MB.</small>
                <div style="height:15px;"></div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
          </form>
          <?php

          if (isset($_POST['simpan'])) {
            $nama     = $_POST['nama'];
            $alamat   = $_POST['alamat'];
            $telp     = $_POST['telp'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $level    = 'pegawai';

            $foto_pegawai = $_FILES["foto"]["name"];
            $gmbr_pegawai = $_FILES["foto"]["tmp_name"];
            move_uploaded_file($gmbr_pegawai, "assets/img/pegawai/$foto_pegawai");
           $sql= "INSERT INTO pegawai(nama,alamat,telp,username,password,foto) values('$nama','$alamat','$telp','$username','$password','$foto_pegawai')";
           $query = mysqli_query($conn, $sql);
            if ($query) {
              echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=pegawai'</script>";
            } else {
              echo "Error : " . mysqli_error($conn);
            }
          }
          ?>
        </div>


      </div>
    </div>
    <!--/.col (left) -->
  </div>
</div>
</div>