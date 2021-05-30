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
                                    <label>Nomor Barang</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan nomor barang" name="barang_id" required>
                                        
                                </div>
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Tanggal Input</label>
                                <input type="date" class="form-control input-lg" id="exampleInputEmail1" placeholder="date" name="tanggal" required>
                            </div>
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Nama Barang</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama barang" name="nama_barang" required>
                            </div>
                            
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Keterangan </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan keterangan" name="keterangan" required>
                            </div>
                            
                                
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['simpan'])) {
                        $barang_id = $_POST['barang_id'];
                        $tanggal  = $_POST['tanggal'];
                        $nama_barang  = $_POST['nama_barang'];
                        $keterangan = $_POST['keterangan'];
                        

                        $sql = "INSERT into barang_masuk values(NULL, '$barang_id', '$tanggal', '$nama_barang', '$keterangan')";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=barang_masuk'</script>";
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