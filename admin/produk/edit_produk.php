<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Update Produk</h3>
                    <?php
                    $id = @$_GET['id'];
                    $sql = mysqli_query($conn, "SELECT * FROM barang where id = '$_GET[id]'") or die(mysqli_error());
                    $data = mysqli_fetch_array($sql);
                    ?>
                </div>
                <form role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <select name="kategori_id" class="custom-select">
                                <option>--Pilih Kategori--</option>
                                <?php $kategori = mysqli_query($conn, "SELECT * from kategori"); ?>
                                <?php foreach ($kategori as $row) : ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['kategori_id'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama barang" name="kode_barang" required value="<?= $data['kode_barang'] ?>">
                        </div>
                         
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama barang" name="nama_barang" required value="<?= $data['nama_barang'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stok</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan stok" name="stok_id" required value="<?= $data['stok_id'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Harga" name="harga" required value="<?= $data['harga'] ?>">
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
                    $kode_barang  = $_POST['kode_barang'];
                    $nama_barang  = $_POST['nama_barang'];
                    $stok_id = $_POST['stok_id'];
                    $harga = $_POST['harga'];

                    $sql = "UPDATE barang set kategori_id='$kategori_id', kode_barang ='$kode_barang', nama_barang='$nama_barang', stok_id='$stok_id', harga='$harga' where id='$id'";
                    $query = mysqli_query($conn, $sql);
                    if ($query) {
                        echo "<script>alert('Data berhasil diubah!');window.location.href='?halaman=produk'</script>";
                    } else {
                        echo "Error : " . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>