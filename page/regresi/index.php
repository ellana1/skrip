<?php
require ('page/metode/regresi/RegresiLinier.php');
$x = array();
$min=mysqli_fetch_array(mysqli_query($conn,"SELECT min(tanggal) as tanggal from transaksi"));
$max=mysqli_fetch_array(mysqli_query($conn,"SELECT max(tanggal) as tanggal from transaksi"));
$bulan =  date_format(date_create($min['tanggal']),"m");
$tahun =  date_format(date_create($min['tanggal']),"Y");
$n=0;
do {
    $n++;
    if ($bulan == 13) {
        $bulan=1;
        $tahun++;
    }
    $sbulan= $bulan < 10 ? "0".$bulan :  $bulan;
    $sbulan = str_replace("00","0",$sbulan);
    $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_transaksi where tanggal like '".$tahun."-".$sbulan."%'";
    $bulanan=mysqli_fetch_array(mysqli_query($conn,$sql));
    $y[]= $bulanan['harga']!=0 ? $bulanan['harga'] : 0;
    $x[]=$bulan;
    $bulan++;
}while ($n<12);
$regresi = new RegresiLinier($x, $y);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latihan Regresi Linier</title>
    <script src="page/metode/regresi/Chart.min.js"></script>    
</head>
<body>
    <table  class="table table-bordered table-striped">
        <thead class="bg-primary text-light">
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Total Pendapatan</th>
                <th>Hasil Regresi</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            $hasilregresi = 0;
            $alpha=0.2;
            $min=mysqli_fetch_array(mysqli_query($conn,"SELECT min(tanggal) as tanggal from transaksi"));
            $max=mysqli_fetch_array(mysqli_query($conn,"SELECT max(tanggal) as tanggal from transaksi"));
            $bulan =  date_format(date_create($min['tanggal']),"m");
            $tahun =  date_format(date_create($min['tanggal']),"Y");
            $n=0;
            $no=1;
            do {
                unset($ST1);
                if ($bulan == 13) {
                    $bulan=1;
                    $tahun++;
                }
                $sbulan= $bulan < 10 ? "0".$bulan :  $bulan;
                $sbulan = str_replace("00","0",$sbulan);
                $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_transaksi where tanggal like '".$tahun."-".$sbulan."%'";
                error_reporting(0);                                      // echo $sql;exit;
                $bulanan=mysqli_fetch_array(mysqli_query($conn,$sql));
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".bulan($bulan)." ".$tahun."</td>"; 
                echo "<td>";
                $total += $bulanan['harga']!=0 ? $bulanan['harga'] : 0;
                echo $bulanan['harga']!=0 ? "Rp. ".number_format($bulanan['harga']) : "<i class='text-muted'>Rp. 0</i>";
                echo "</td>"; 
                echo "<td>"; 
                echo $regresi->all[$n];
                if ($regresi->all[$n] < 0) {
                    $hasilregresi -= round($regresi->all[$n]*-1);
                }else{
                    $hasilregresi += (round($regresi->all[$n],2));  //.number_format(round($STlast['harga_res'],2))
                }
                echo "</td>"; 
                echo "</tr>"  ;
                $n++;
                $no++;
                $bulan++;
            } while ($n<12);
            ?>
        </tbody>
        <tfoot>
            <th colspan="2" class="text-right">Total</th>
            <th>Rp. <?php echo number_format($total) ?></th>
            <th>Rp. <?php echo number_format($hasilregresi) ?></th>
        </tfoot>
    </table>
    <?php
//contoh menampilkan data regresi linear
    // echo "<textarea style='width:100%; height:300px; '>";
    // echo "X Variable : \n";
    // print_r($x);
    // echo "</textarea>";
    // echo "<textarea style='width:100%; height:300px; '>";
    // echo "Y Variable : \n";
    // print_r($y);
    // echo "</textarea>";
    // echo "<textarea style='width:100%; height:300px; '>";
    // echo "Hasil Analisis Regresi Linear Sederhana : \n";
    // print_r($regresi->all);
    // echo "</textarea>";
    ?>
    <br>
    <h3>Regresi Linier</h3>
    <canvas id="graph" width=500 height="150"></canvas>
    <script>
        ctx = document.getElementById('graph');
        var chart = new Chart(ctx, {
            type : 'line',
            data: {
                labels: [<?=implode(",",$x)?>],
                datasets: [
                {
                    label: 'Pendapatan',
                    data: [<?=implode(",", $y)?>],
                    backgroundColor: 'rgba(12, 199, 132, 0.2)',
                    borderWidth: 1
                },
                {
                    label: 'Regresi Linier',
                    data: [<?=implode(",", $regresi->all)?>],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 1
                },
                ]
            }
        });
    </script>
</body>
</html>
