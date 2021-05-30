<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Tambah Data User </h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Masukan Identitas Anda</h6>
    </div>
    <div class="card-body">
      <div class="col-lg-12">
        <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama" name="nama" required>
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
              <label for="exampleInputEmail1">level</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan level" name="level" required>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
          </form>
          <?php
          if (isset($_POST['simpan'])) {
            $id_user = $_POST['id_user'];
            $nama     = $_POST['nama'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $level    = $_POST['level'];;

            $sql = "INSERT into user values(null, '$username', '$password', '$level', '$nama')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
              echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=user'</script>";
            } else {
              echo "Error : " . mysqli_error($conn);
            }
          }
          ?>
        </div>
        <!-- /.box -->


      </div>
      <!--/.col (left) -->

    </div>
  </div>
</div>