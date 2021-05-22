<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Bahan</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Masukan Bahan Barang</h6>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Bahan</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Bahan" name="nama_bahan" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Satuan</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan satuan" name="satuan" required>
                            </div>
                             <div class="form-group">
                                <label for="exampleInputEmail1">Harga</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan harga" name="harga" required>
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
                        $nama_bahan  = $_POST['nama_bahan'];
                        $satuan  = $_POST['satuan'];
                        $harga =$_POST['harga'];

                        $sql = "INSERT into bahan values(null, '$nama_bahan', '$satuan', '$harga')";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=bahan'</script>";
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