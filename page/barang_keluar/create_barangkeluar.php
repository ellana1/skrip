<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Barang Keluar</h1>
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
                                    <label>Jumlah keluar</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan stok barang" name="pengeluaran" required>
                                        
                                </div>
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Tanggal Output</label>
                                <input type="date" class="form-control input-lg" id="exampleInputEmail1" placeholder="date" name="tanggal" required>
                            </div>
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Penerima</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama penerima" name="penerima" required>
                            </div>
                            <div class="col-md-12 col-xs-12 form-group">
                                    <label>Keterangan</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama keterangan" name="keterangan" required>
                            </div>
                            
                                
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['simpan'])) {
                        $pengeluaran = $_POST['pengeluaran'];
                        $tanggal  = $_POST['tanggal'];
                        $penerima  = $_POST['penerima'];
                        $keterangan =$_POST['keterangan'];
                        

                        $sql = "INSERT into barang_keluar VALUES (NULL, `pengeluaran`, `tanggal`, `penerima`, `keterangan`)";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=barang_keluar'</script>";
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