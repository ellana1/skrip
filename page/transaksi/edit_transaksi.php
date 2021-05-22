
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Update Data Transaksi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Masukan Data Transaksi</h6>
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
                                    <label>Nomor Pelanggan</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan nomor pelanggan" name="customer_id" required>
                                        
                                </div>
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Nama Pelanggan</label>
                                <input type="date" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan nama pelanggan" name="nama_customer" required>
                            </div>
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Tanggal</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="date" name="tanggal" required>
                            </div>
                            
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Harga </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan harga" name="harga" required>
                            </div>
                            <div class="col-md-12 col-xs-12 form-group">
                                    <label>Total </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Total" name="total" required>
                            </div>
                            
                                
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div>
                    </form>
                    <?php
                    $bln=date('n');
                    $bul=date('m');
                    $taun=date('Y');

                    if (isset($_POST['simpan'])) {
                        $id = $_POST['id'];
                        $customer_id = $_POST['customer_id'];
                        $nama_customer  = $_POST['nama_customer'];
                        $tanggal  = $_POST['tanggal'];
                        $harga = $_POST['harga'];
                        $total = $_POST['total'];

                        $sql = "UPDATE transaksi set customer_id= '$customer_id', nama_customer='$nama_customer', tanggal='$tanggal', harga='$harga' total= '$total'                                                          where id='$id'";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=transaksi'</script>";
                        } else {
                            echo "Error : " . mysqli_error($conn);
                        }
                    }
                    ?>
                </div>
                


            </div>


        </div>
    </div>
</div>