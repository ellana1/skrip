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
                            <div class="row">
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Kategori Produk</label>
                                    <select name="kategori_id" class="custom-select">
                                        <option>--Pilih Kategori--</option>
                                        <?php $kategori = mysqli_query($conn, "SELECT * from kategori"); ?>
                                        <?php foreach ($kategori as $row) : ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['nama_kategori'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Kode barang</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan kode barang" name="kode_barang" required>
                                </div>

                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama barang" name="nama_barang" required>
                                </div>


                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Stok </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan stok" name="stok" required>
                                </div>

                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Harga" name="harga" required>
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
                        $kategori_id = $_POST['kategori_id'];
                        $kode_barang  = $_POST['kode_barang'];
                        $nama_barang  = $_POST['nama_barang'];
                        $stok_id = $_POST['stok'];
                        $harga = $_POST['harga'];


                        $sql = "INSERT into barang values(null, '$kategori_id', '$kode_barang', '$nama_barang', '$stok_id', '$harga')";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=produk'</script>";
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