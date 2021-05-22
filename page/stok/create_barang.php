<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Data Barang</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Masukan Data Barang</h6>
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
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama barang" name="nama_barang" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stok</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan stok" name="stok" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Harga" name="harga" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Kategori" name="kategori" required>
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
                        $nama_barang  = $_POST['nama_barang'];
                        $stok = $_POST['stok'];
                        $harga = $_POST['harga'];
                        $kategori    = $_POST['kategori'];

                        $sql = "insert into stok values(null, '$nama_barang', '$stok', '$harga', '$kategori')";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=stok'</script>";
                        } else {
                            echo "Error : " . mysqli_error($conn);
                        }
                    }
                    ?>
                </div>
                <!-- /.box -->


            </div>


        </div>
    </div>
</div>