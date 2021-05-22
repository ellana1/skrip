<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Data Stok Barang</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Stok Barang</h6>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <?php
                        $id = @$_GET['id'];
                        $sql = mysqli_query($conn, "SELECT *FROM stok where id = '$_GET[id]'") or die(mysqli_error());
                        $data = mysqli_fetch_array($sql);
                        ?>
                    </div>
                    <form role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Barang</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama barang" name="nama_barang" required value="<?= $data['nama_barang'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stok</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan stok" name="stok" required value="<?= $data['stok'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Harga" name="harga" required value="<?= $data['harga'] ?>">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <select name="kategori_id" class="custom-select">
                                <option>--Pilih Kategori--</option>
                                <?php $kategori = mysqli_query($conn, "SELECT * from kategori"); ?>
                                <?php foreach ($kategori as $row) : ?>
                                    <option value="<?php echo $row['nama_kategori'] ?>"><?php echo $row['nama_kategori'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        </div>
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
                        $kategori = $_POST['kategori'];

                        $sql = "UPDATE stok set nama_barang='$nama_barang', stok='$stok', harga='$harga', kategori='$kategori' where id='$id'";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil diubah!');window.location.href='?halaman=stok'</script>";
                        } else {
                            echo "Error : " . mysqli_error($conn);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>