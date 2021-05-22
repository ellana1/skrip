<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Data Produk</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Produk</h6>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <?php
                        $id = @$_GET['id'];
                        $sql = mysqli_query($conn, "SELECT *FROM barang where id = '$_GET[id]'") or die(mysqli_error());
                        $data = mysqli_fetch_array($sql);
                        ?>
                    </div>
                    <form role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama barang" name="kategori_id" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kode Barang</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama barang" name="kode_barang" required>
                            </div>
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
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['simpan'])) {
                        $id = $_POST['id'];
                        $kategori_id = $_POST['kategori_id'];
                        $kode_barang  = $_POST['nama_barang'];
                        $nama_barang  = $_POST['kode_barang'];
                        $stok_id = $_POST['stok'];
                        $harga = $_POST['harga'];

                        $sql = "UPDATE barang set kategori_id='$kategori_id',kode_barang='$kode_barang',nama_barang='$nama_barang', stok='$stok_id', harga='$harga' where id='$id'";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil diubah!');window.location.href='?halaman=data_barang'</script>";
                        } else {
                            echo "Error : " . mysqli_error($conn);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>