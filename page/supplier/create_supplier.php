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
                <label for="exampleInputEmail1">Nama Perusahaan</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Perusahaan" name="nama_perusahaan" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan alamat" name="alamat" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Produksi</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Password" name="produk" required>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
          </form>
          <?php
          if (isset($_POST['simpan'])) {
            $id = $_POST['id'];
            $nama_perusahaan     = $_POST['nama_perusahaan'];
            $alamat = $_POST['alamat'];
            $produk = $_POST['produk'];


            $sql = "INSERT into suppliers values(null, '$nama_perusahaan', '$alamat', '$produk' '$id')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
              echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=supplier'</script>";
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
<!-- /.row -->