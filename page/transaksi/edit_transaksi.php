<?php
$edit = mysqli_fetch_array(mysqli_query($conn,"SELECT * from transaksi where id_transaksi = $_GET[id]"));
if (isset($_POST['simpan'])) { 
    $nama_customer  = $_POST['nama_customer']; 
    $tanggal  = $_POST['tanggal'];
    $total = $_POST['total'];
    $sql = "UPDATE transaksi set nama_customer = '$nama_customer', tanggal='$tanggal' where id_transaksi = $_POST[id]";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=transaksi'</script>";
    } else {
        echo "Error : " . mysqli_error($conn);
    }
}
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Data Transaksi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Masukan Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <form role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $edit['id_transaksi'] ?>">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" value="<?php echo $edit['tanggal']; ?>" required="required">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pelanggan/Supplier</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Pelanggan" name="nama_customer" required value="<?php echo $edit['nama_customer'] ?>">

                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>