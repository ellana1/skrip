<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"> Metode</h1>
    <div class="box-header">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Single Exponential Smoothing</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table  class="table table-bordered table-striped">
                                                    <thead class="bg-primary text-light">
                                                        <tr>
                                                            <th rowspan="2">No</th>
                                                            <th rowspan="2">Bulan</th>
                                                            <th colspan="2">Nilai Pengamatan</th>
                                                            <th colspan="2">Nilai Perkiraan (n=3)</th>
                                                            <th colspan="2">Nilai Perkiraan (n=5)</th>
                                                        </tr>
                                                        <tr>
                                                            <th>QTY</th>
                                                            <th>Total Pendapatan</th>
                                                            <th>Perkiraan QTY</th>
                                                            <th>Perkiraan Pendapatan</th>
                                                            <th>Perkiraan QTY</th>
                                                            <th>Perkiraan Pendapatan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> 
                                                        <?php
                                                        $alpha=0.2;
                                                        $min=mysqli_fetch_array(mysqli_query($conn,"SELECT min(tanggal) as tanggal from transaksi"));
                                                        $max=mysqli_fetch_array(mysqli_query($conn,"SELECT max(tanggal) as tanggal from transaksi"));
                                                        $bulan =  date_format(date_create($min['tanggal']),"m");
                                                        $tahun =  date_format(date_create($min['tanggal']),"Y");
                                                        $n=1;
                                                        do {
                                                            unset($ST1);
                                                            if ($bulan == 13) {
                                                                $bulan=1;
                                                                $tahun++;
                                                            }
                                                            $sbulan= $bulan < 10 ? "0".$bulan :  $bulan;
                                                            $sbulan = str_replace("00","0",$sbulan);
                                                            $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_transaksi where tanggal like '".$tahun."-".$sbulan."%'";
                                                            // echo $sql;exit;
                                                            $bulanan=mysqli_fetch_array(mysqli_query($conn,$sql));
                                                            echo "<tr>";
                                                            echo "<td>".$n."</td>";
                                                            echo "<td>".bulan($bulan)." ".$tahun."</td>"; 
                                                            echo "<td>";
                                                            echo $bulanan['qty']!=null ? $bulanan['qty'] : "<i class='text-muted'>0</i>";
                                                            echo "</td>"; 
                                                            echo "<td>";
                                                            echo $bulanan['harga']!=0 ? "Rp. ".number_format($bulanan['harga']) : "<i class='text-muted'>Rp. 0</i>";
                                                            echo "</td>"; 
                                                            $data[$n]['harga']=$bulanan['qty'];
                                                            $data[$n]['harga']=$bulanan['harga'];
                                                        // metode  n =3
                                                            $request=3;
                                                            $ST1['qty_rule']="";
                                                            $ST1['harga_rule']="";
                                                            $string['qty_rule']="<b>S’t = α Xt + (1- α) S’t-1</b> <br>";    
                                                            $string['harga_rule']="<b>S’t = α Xt + (1- α) S’t-1</b> <br>"; 
                                                            if ($n<=$request) {
                                                                $qty = "-";
                                                                $harga="-";
                                                                echo "<td>-</td><td>-</td>";
                                                            }else{
                                                                $loop=0;
                                                                //Sʾt = α Xt + (1- α) S’t-1 
                                                                $tmpbulan=$bulan-$request;
                                                                if ($tmpbulan < 0) {
                                                                    $tmpbulan = 12 + $tmpbulan;
                                                                    $tmptahun--;
                                                                }else{
                                                                    $tmptahun=$tahun;
                                                                }
                                                                $ES[$n]['qty']=0;
                                                                $ES[$n]['harga']=0;
                                                                $ES[$n]['qty_rule']="";
                                                                $ES[$n]['harga_rule']="";
                                                                do {
                                                                    $num=$loop+1;
                                                                    if ($tmpbulan == 13) {
                                                                        $tmpbulan=1;
                                                                        $tmptahun++;
                                                                    }
                                                                    $tmpbulan= $tmpbulan < 10 ? "0".$tmpbulan :  $tmpbulan;
                                                                    $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_transaksi   where tanggal like '".$tmptahun."-".$tmpbulan."%'";
                                                                    $tmp=mysqli_fetch_array(mysqli_query($conn,$sql));
                                                                    $temp_qty=$tmp['qty']>0 ? $tmp['qty'] : 0;
                                                                    $temp_harga=$tmp['harga']>0 ? $tmp['harga'] : 0;
                                                                    $recent['qty'] = isset($recent['qty']) ? $recent['qty'] : $tmp['qty'];
                                                                    $recent['harga'] = isset($recent['harga']) ? $recent['harga'] : $tmp['harga'];
                                                                    $ST1[$loop]['qty']=($alpha * $temp_qty) + ((1 - $alpha) * $recent['qty']);
                                                                    $ST1[$loop]['harga']=($alpha * $temp_harga) + ((1 - $alpha) * $recent['harga']);
                                                                    $ST1['qty_res']=$ST1[$loop]['qty'];
                                                                    $ST1['harga_res']=$ST1[$loop]['harga'];
                                                                    $string['qty_rule'] .= "<li>Sʾ".$num." = (".$alpha." x ".$temp_qty.") + (1 - ".$alpha.") x ".$recent['qty']." = ".$ST1['qty_res']."</li>";
                                                                    $string['harga_rule'] .= "<li>Sʾ".$num." = (".$alpha." x ".$temp_harga.") + (1 - ".$alpha.") x ".$recent['harga']." = ".$ST1['harga_res']."</li>";
                                                                    $recent['qty'] = $ST1['qty_res'];
                                                                    $recent['harga'] = $ST1['harga_res'];
                                                                    $tmpbulan++;
                                                                    $loop++;
                                                                } while ($loop<$request); 
                                                                $loop=0;
                                                                $string['qty_rule'].="<b>S’t = α S’t + (1- α) Sˮt-1 </b>  <br>";   
                                                                $string['harga_rule'].="<b>S’t = α S’t + (1- α) Sˮt-1 </b>  <br>"; 
                                                            // Sˮt = α S’t + (1- α) Sˮt-1 
                                                                $tmpbulan=$bulan-$request;
                                                                if ($tmpbulan < 0) {
                                                                    $tmpbulan = 12 + $tmpbulan;
                                                                    $tmptahun--;
                                                                }else{
                                                                    $tmptahun=$tahun;
                                                                }
                                                                do {
                                                                    $num=$loop+1;
                                                                    if ($tmpbulan == 13) {
                                                                        $tmpbulan=1;
                                                                        $tmptahun++;
                                                                    }
                                                                    $tmpbulan= $tmpbulan < 10 ? "0".$tmpbulan :  $tmpbulan;
                                                                    $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_transaksi   where tanggal like '".$tmptahun."-".$tmpbulan."%'";
                                                                    $tmp=mysqli_fetch_array(mysqli_query($conn,$sql));
                                                                    $recent['qty'] = isset($recent['qty']) ? $recent['qty'] : $tmp['qty'];
                                                                    $recent['harga'] = isset($recent['harga']) ? $recent['harga'] : $tmp['harga'];
                                                                    $ST2[$loop]['qty']=($alpha * $ST1[$loop]['qty']) + ((1 - $alpha) * $recent['qty']);
                                                                    $ST2[$loop]['harga']=($alpha * $ST1[$loop]['harga']) + ((1 - $alpha) * $recent['harga']);
                                                                    $ST2['qty_res']=$ST2[$loop]['qty'];
                                                                    $ST2['harga_res']=$ST2[$loop]['harga'];
                                                                    $string['qty_rule'] .= "<li>Sʾʾ".$num." = (".$alpha." x ".$ST1[$loop]['qty'].") + (1 - ".$alpha.") x ".$recent['qty']." = ".$ST2['qty_res']."</li>";
                                                                    $string['harga_rule'] .= "<li>Sʾʾ".$num." = (".$alpha." x ".$ST1[$loop]['harga'].") + (1 - ".$alpha.") x ".$recent['harga']." = ".$ST2['harga_res']."</li>";
                                                                    $recent['qty'] = $ST2['qty_res'];
                                                                    $recent['harga'] = $ST2['harga_res'];
                                                                    $tmpbulan++;
                                                                    $loop++;
                                                                } while ($loop<$request); 
                                                                $loop=0;
                                                                $string['qty_rule'].="<b>at = 2S’t– Sˮt</b><br>";   
                                                                $string['harga_rule'].="<b>at = 2S’t– Sˮt</b><br>"; 
                                                            // at = 2S’t– Sˮt
                                                                $tmpbulan=$bulan-$request;
                                                                if ($tmpbulan < 0) {
                                                                    $tmpbulan = 12 + $tmpbulan;
                                                                    $tmptahun--;
                                                                }else{
                                                                    $tmptahun=$tahun;
                                                                }
                                                                do {
                                                                    $num=$loop+1;
                                                                    if ($tmpbulan == 13) {
                                                                        $tmpbulan=1;
                                                                        $tmptahun++;
                                                                    }
                                                                    $tmpbulan= $tmpbulan < 10 ? "0".$tmpbulan :  $tmpbulan;
                                                                    $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_transaksi   where tanggal like '".$tmptahun."-".$tmpbulan."%'";
                                                                    $tmp=mysqli_fetch_array(mysqli_query($conn,$sql));
                                                                    $temp_qty=$tmp['qty']>0 ? $tmp['qty'] : 0;
                                                                    $temp_harga=$tmp['harga']>0 ? $tmp['harga'] : 0;
                                                                    $recent['qty'] = isset($recent['qty']) ? $recent['qty'] : $tmp['qty'];
                                                                    $recent['harga'] = isset($recent['harga']) ? $recent['harga'] : $tmp['harga'];
                                                                    $at[$loop]['qty']=2*($ST1[$loop]['qty']) - $ST2[$loop]['qty'];
                                                                    $at[$loop]['harga']=2*($ST1[$loop]['harga']) - $ST2[$loop]['harga'];
                                                                    $at['qty_res']=$at[$loop]['qty'];
                                                                    $at['harga_res']=$at[$loop]['harga'];
                                                                    $string['qty_rule'] .= "<li>a".$num." = 2(".$ST1[$loop]['qty'].") - ".$ST2[$loop]['qty']." = ".$at['qty_res']."</li>";
                                                                    $string['harga_rule'] .= "<li>a".$num." = 2(".$ST1[$loop]['harga'].") - ".$ST2[$loop]['harga']." = ".$at['harga_res']."</li>";
                                                                    $recent['qty'] = $at['qty_res'];
                                                                    $recent['harga'] = $at['harga_res'];
                                                                    $tmpbulan++;
                                                                    $loop++;
                                                                } while ($loop<$request); 
                                                                $loop=0;
                                                            // bt=  <h:frac> n='α' d='1-α'</h:frac> (S’t-S’’t)
                                                                $string['qty_rule'].="<b>bt = (α/1-α)(S’t-S’’t)</b><br>";   
                                                                $string['harga_rule'].="<b>bt=  (α/1-α)(S’t-S’’t)</b><br>"; 
                                                                $tmpbulan=$bulan-$request;
                                                                if ($tmpbulan < 0) {
                                                                    $tmpbulan = 12 + $tmpbulan;
                                                                    $tmptahun--;
                                                                }else{
                                                                    $tmptahun=$tahun;
                                                                }
                                                                do {
                                                                    $num=$loop+1;
                                                                    $bt[$loop]['qty']= ($alpha / (1-$alpha)) * ($ST1[$loop]['qty']-$ST2[$loop]['qty']);
                                                                    $bt[$loop]['harga']= ($alpha / (1-$alpha)) * ($ST1[$loop]['harga']-$ST2[$loop]['harga']);
                                                                    $bt['qty_res']=$bt[$loop]['qty'];
                                                                    $bt['harga_res']=$bt[$loop]['harga'];
                                                                    $string['qty_rule'] .= "<li>b".$num." = (".$alpha." / 1-".$alpha.") * (".$ST1[$loop]['qty']." - ".$ST2[$loop]['qty'].") = ".$bt['qty_res']." </li>";
                                                                    $string['harga_rule'] .= "<li>b".$num." = (".$alpha." / 1-".$alpha.") * (".$ST1[$loop]['harga']." - ".$ST2[$loop]['harga'].") = ".$bt['harga_res']." </li>";
                                                                    $recent['qty'] = $bt['qty_res'];
                                                                    $recent['harga'] = $bt['harga_res'];
                                                                    $tmpbulan++;
                                                                    $loop++;
                                                                } while ($loop<$request); 
                                                            // bt=  <h:frac> n='α' d='1-α'</h:frac> (S’t-S’’t)
                                                                $string['qty_rule'].="<b>St+m = at + bt m</b><br>";   
                                                                $string['harga_rule'].="<b>St+m = at + bt m</b><br>"; 
                                                                $num=$loop+1;
                                                                $STlast[$loop]['qty']= ($at['qty_res']+$bt['qty_res']);
                                                                $STlast[$loop]['harga']=($at['harga_res']+$bt['harga_res']);
                                                                $STlast['qty_res']=$STlast[$loop]['qty'];
                                                                $STlast['harga_res']=$STlast[$loop]['harga'];
                                                                $string['qty_rule'] .= "<li>S".$num." = (".$at['qty_res']." + ".$bt['qty_res'].") = ".$STlast['qty_res']." </li>";
                                                                $string['harga_rule'] .= "<li>S".$num." = (".$at['harga_res']." + ".$bt['harga_res'].") = ".$STlast['harga_res']." </li>";
                                                                $recent['qty'] = $STlast['qty_res'];
                                                                $recent['harga'] = $STlast['harga_res'];
                                                            // print_r($string['harga_rule']);
                                                                ?>
                                                                <td>
                                                                    <?php echo $string['qty_rule'] ?>
                                                                    <?php echo round($STlast['qty_res'],2)?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $string['harga_rule'] ?>
                                                                    <?php echo "Rp. ".number_format(round($STlast['harga_res'],2)) ?>
                                                                </td>
                                                                <?php
                                                            }
                                // endmetode 
              // metode  n =5
                                                            $request=5;
                                                            $ST1['qty_rule']="";
                                                            $ST1['harga_rule']="";
                                                            $string['qty_rule']="<b>S’t = α Xt + (1- α) S’t-1</b> <br>";    
                                                            $string['harga_rule']="<b>S’t = α Xt + (1- α) S’t-1</b> <br>"; 
                                                            if ($n<=$request) {
                                                                $qty = "-";
                                                                $harga="-";
                                                                echo "<td>-</td><td>-</td>";
                                                            }else{
                                                                $loop=0;
                                                //Sʾt = α Xt + (1- α) S’t-1 
                                                                $tmpbulan=$bulan-$request;
                                                                if ($tmpbulan < 0) {
                                                                    $tmpbulan = 12 + $tmpbulan;
                                                                    $tmptahun--;
                                                                }else{
                                                                    $tmptahun=$tahun;
                                                                }
                                                                $ES[$n]['qty']=0;
                                                                $ES[$n]['harga']=0;
                                                                $ES[$n]['qty_rule']="";
                                                                $ES[$n]['harga_rule']="";
                                                                do {
                                                                    $num=$loop+1;
                                                                    if ($tmpbulan == 13) {
                                                                        $tmpbulan=1;
                                                                        $tmptahun++;
                                                                    }
                                                                    $tmpbulan= $tmpbulan < 10 ? "0".$tmpbulan :  $tmpbulan;
                                                                    $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_transaksi   where tanggal like '".$tmptahun."-".$tmpbulan."%'";
                                                                    $tmp=mysqli_fetch_array(mysqli_query($conn,$sql));
                                                                    $temp_qty=$tmp['qty']>0 ? $tmp['qty'] : 0;
                                                                    $temp_harga=$tmp['harga']>0 ? $tmp['harga'] : 0;
                                                                    $recent['qty'] = isset($recent['qty']) ? $recent['qty'] : $tmp['qty'];
                                                                    $recent['harga'] = isset($recent['harga']) ? $recent['harga'] : $tmp['harga'];
                                                                    $ST1[$loop]['qty']=($alpha * $temp_qty) + ((1 - $alpha) * $recent['qty']);
                                                                    $ST1[$loop]['harga']=($alpha * $temp_harga) + ((1 - $alpha) * $recent['harga']);
                                                                    $ST1['qty_res']=$ST1[$loop]['qty'];
                                                                    $ST1['harga_res']=$ST1[$loop]['harga'];
                                                                    $string['qty_rule'] .= "<li>Sʾ".$num." = (".$alpha." x ".$temp_qty.") + (1 - ".$alpha.") x ".$recent['qty']." = ".$ST1['qty_res']."</li>";
                                                                    $string['harga_rule'] .= "<li>Sʾ".$num." = (".$alpha." x ".$temp_harga.") + (1 - ".$alpha.") x ".$recent['harga']." = ".$ST1['harga_res']."</li>";
                                                                    $recent['qty'] = $ST1['qty_res'];
                                                                    $recent['harga'] = $ST1['harga_res'];
                                                                    $tmpbulan++;
                                                                    $loop++;
                                                                } while ($loop<$request); 
                                                                $loop=0;
                                                                $string['qty_rule'].="<b>S’t = α S’t + (1- α) Sˮt-1 </b>  <br>";   
                                                                $string['harga_rule'].="<b>S’t = α S’t + (1- α) Sˮt-1 </b>  <br>"; 
                                            // Sˮt = α S’t + (1- α) Sˮt-1 
                                                                $tmpbulan=$bulan-$request;
                                                                if ($tmpbulan < 0) {
                                                                    $tmpbulan = 12 + $tmpbulan;
                                                                    $tmptahun--;
                                                                }else{
                                                                    $tmptahun=$tahun;
                                                                }
                                                                do {
                                                                    $num=$loop+1;
                                                                    if ($tmpbulan == 13) {
                                                                        $tmpbulan=1;
                                                                        $tmptahun++;
                                                                    }
                                                                    $tmpbulan= $tmpbulan < 10 ? "0".$tmpbulan :  $tmpbulan;
                                                                    $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_transaksi  where tanggal like '".$tmptahun."-".$tmpbulan."%'";
                                                                    $tmp=mysqli_fetch_array(mysqli_query($conn,$sql));
                                                                    $recent['qty'] = isset($recent['qty']) ? $recent['qty'] : $tmp['qty'];
                                                                    $recent['harga'] = isset($recent['harga']) ? $recent['harga'] : $tmp['harga'];
                                                                    $ST2[$loop]['qty']=($alpha * $ST1[$loop]['qty']) + ((1 - $alpha) * $recent['qty']);
                                                                    $ST2[$loop]['harga']=($alpha * $ST1[$loop]['harga']) + ((1 - $alpha) * $recent['harga']);
                                                                    $ST2['qty_res']=$ST2[$loop]['qty'];
                                                                    $ST2['harga_res']=$ST2[$loop]['harga'];
                                                                    $string['qty_rule'] .= "<li>Sʾʾ".$num." = (".$alpha." x ".$ST1[$loop]['qty'].") + (1 - ".$alpha.") x ".$recent['qty']." = ".$ST2['qty_res']."</li>";
                                                                    $string['harga_rule'] .= "<li>Sʾʾ".$num." = (".$alpha." x ".$ST1[$loop]['harga'].") + (1 - ".$alpha.") x ".$recent['harga']." = ".$ST2['harga_res']."</li>";
                                                                    $recent['qty'] = $ST2['qty_res'];
                                                                    $recent['harga'] = $ST2['harga_res'];
                                                                    $tmpbulan++;
                                                                    $loop++;
                                                                } while ($loop<$request); 
                                                                $loop=0;
                                                                $string['qty_rule'].="<b>at = 2S’t– Sˮt</b><br>";   
                                                                $string['harga_rule'].="<b>at = 2S’t– Sˮt</b><br>"; 
                                            // at = 2S’t– Sˮt
                                                                $tmpbulan=$bulan-$request;
                                                                if ($tmpbulan < 0) {
                                                                    $tmpbulan = 12 + $tmpbulan;
                                                                    $tmptahun--;
                                                                }else{
                                                                    $tmptahun=$tahun;
                                                                }
                                                                do {
                                                                    $num=$loop+1;
                                                                    if ($tmpbulan == 13) {
                                                                        $tmpbulan=1;
                                                                        $tmptahun++;
                                                                    }
                                                                    $tmpbulan= $tmpbulan < 10 ? "0".$tmpbulan :  $tmpbulan;
                                                                    $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_transaksi  where tanggal like '".$tmptahun."-".$tmpbulan."%'";
                                                                    $tmp=mysqli_fetch_array(mysqli_query($conn,$sql));
                                                                    $temp_qty=$tmp['qty']>0 ? $tmp['qty'] : 0;
                                                                    $temp_harga=$tmp['harga']>0 ? $tmp['harga'] : 0;
                                                                    $recent['qty'] = isset($recent['qty']) ? $recent['qty'] : $tmp['qty'];
                                                                    $recent['harga'] = isset($recent['harga']) ? $recent['harga'] : $tmp['harga'];
                                                                    $at[$loop]['qty']=2*($ST1[$loop]['qty']) - $ST2[$loop]['qty'];
                                                                    $at[$loop]['harga']=2*($ST1[$loop]['harga']) - $ST2[$loop]['harga'];
                                                                    $at['qty_res']=$at[$loop]['qty'];
                                                                    $at['harga_res']=$at[$loop]['harga'];
                                                                    $string['qty_rule'] .= "<li>a".$num." = 2(".$ST1[$loop]['qty'].") - ".$ST2[$loop]['qty']." = ".$at['qty_res']."</li>";
                                                                    $string['harga_rule'] .= "<li>a".$num." = 2(".$ST1[$loop]['harga'].") - ".$ST2[$loop]['harga']." = ".$at['harga_res']."</li>";
                                                                    $recent['qty'] = $at['qty_res'];
                                                                    $recent['harga'] = $at['harga_res'];
                                                                    $tmpbulan++;
                                                                    $loop++;
                                                                } while ($loop<$request); 
                                                                $loop=0;
                                            // bt=  <h:frac> n='α' d='1-α'</h:frac> (S’t-S’’t)
                                                                $string['qty_rule'].="<b>bt = (α/1-α)(S’t-S’’t)</b><br>";   
                                                                $string['harga_rule'].="<b>bt=  (α/1-α)(S’t-S’’t)</b><br>"; 
                                                                $tmpbulan=$bulan-$request;
                                                                if ($tmpbulan < 0) {
                                                                    $tmpbulan = 12 + $tmpbulan;
                                                                    $tmptahun--;
                                                                }else{
                                                                    $tmptahun=$tahun;
                                                                }
                                                                do {
                                                                    $num=$loop+1;
                                                                    $bt[$loop]['qty']= ($alpha / (1-$alpha)) * ($ST1[$loop]['qty']-$ST2[$loop]['qty']);
                                                                    $bt[$loop]['harga']= ($alpha / (1-$alpha)) * ($ST1[$loop]['harga']-$ST2[$loop]['harga']);
                                                                    $bt['qty_res']=$bt[$loop]['qty'];
                                                                    $bt['harga_res']=$bt[$loop]['harga'];
                                                                    $string['qty_rule'] .= "<li>b".$num." = (".$alpha." / 1-".$alpha.") * (".$ST1[$loop]['qty']." - ".$ST2[$loop]['qty'].") = ".$bt['qty_res']." </li>";
                                                                    $string['harga_rule'] .= "<li>b".$num." = (".$alpha." / 1-".$alpha.") * (".$ST1[$loop]['harga']." - ".$ST2[$loop]['harga'].") = ".$bt['harga_res']." </li>";
                                                                    $recent['qty'] = $bt['qty_res'];
                                                                    $recent['harga'] = $bt['harga_res'];
                                                                    $tmpbulan++;
                                                                    $loop++;
                                                                } while ($loop<$request); 
                                            // bt=  <h:frac> n='α' d='1-α'</h:frac> (S’t-S’’t)
                                                                $string['qty_rule'].="<b>St+m = at + bt m</b><br>";   
                                                                $string['harga_rule'].="<b>St+m = at + bt m</b><br>"; 
                                                                $num=$loop+1;
                                                                $STlast[$loop]['qty']= ($at['qty_res']+$bt['qty_res']);
                                                                $STlast[$loop]['harga']=($at['harga_res']+$bt['harga_res']);
                                                                $STlast['qty_res']=$STlast[$loop]['qty'];
                                                                $STlast['harga_res']=$STlast[$loop]['harga'];
                                                                $string['qty_rule'] .= "<li>S".$num." = (".$at['qty_res']." + ".$bt['qty_res'].") = ".$STlast['qty_res']." </li>";
                                                                $string['harga_rule'] .= "<li>S".$num." = (".$at['harga_res']." + ".$bt['harga_res'].") = ".$STlast['harga_res']." </li>";
                                                                $recent['qty'] = $STlast['qty_res'];
                                                                $recent['harga'] = $STlast['harga_res'];
                                            // print_r($string['harga_rule']);
                                                                ?>
                                                                <td>
                                                                    <?php //echo $string['qty_rule'] ?>
                                                                    <?php echo round($STlast['qty_res'],2)?>
                                                                </td>
                                                                <td>
                                                                    <?php //echo $string['harga_rule'] ?>
                                                                    <?php echo "Rp. ".number_format(round($STlast['harga_res'],2)) ?>
                                                                </td>
                                                                <?php
                                                            }
              // endmetode 
                                                            echo "</tr>"  ;
                                                            $n++;
                                                            $bulan++;
                                                        } while ($n<=12);
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Regresi Linier</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <?php include 'page/metode/regresi/index.php' ?>

                                                <!-- <table class="table table-bordered table-striped">
                                                    <thead class="bg-primary text-light">
                                                        <tr>
                                                            <th rowspan="2">No</th>
                                                            <th rowspan="2">Bulan</th>
                                                            <th colspan="2">Nilai Pengamatan</th>
                                                            <th colspan="2">Nilai Prediksi</th>
                                                        </tr>
                                                        <tr>
                                                            <th>QTY</th>
                                                            <th>Total Harga</th>

                                                            <th>QTY</th>
                                                            <th>Total Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> 
                                                        <?php
                                                        $alpha=0.2;
                                                        $min=mysqli_fetch_array(mysqli_query($conn,"SELECT min(tanggal) as tanggal from transaksi"));
                                                        $max=mysqli_fetch_array(mysqli_query($conn,"SELECT max(tanggal) as tanggal from transaksi"));
                                                        $bulan =  date_format(date_create($min['tanggal']),"m");
                                                        $tahun =  date_format(date_create($min['tanggal']),"Y");
                                                        $n=1;
                                                        do {
                                                            unset($ST1);
                                                            if ($bulan == 13) {
                                                                $bulan=1;
                                                                $tahun++;
                                                            }
                                                            $sbulan= $bulan < 10 ? "0".$bulan :  $bulan;
                                                            $sbulan = str_replace("00","0",$sbulan);
                                                            $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id=detail_transaksi.transaksi_id where tanggal like '".$tahun."-".$sbulan."%'";
                                                            // echo $sql;exit;
                                                            $bulanan=mysqli_fetch_array(mysqli_query($conn,$sql));
                                                            echo "<tr>";
                                                            echo "<td>".$n."</td>";
                                                            echo "<td>".bulan($bulan)." ".$tahun."</td>"; 
                                                            echo "<td>";
                                                            echo $bulanan['qty']!=null ? $bulanan['qty'] : "<i class='text-muted'>0</i>";
                                                            echo "</td>"; 
                                                            echo "<td>";
                                                            echo $bulanan['harga']!=0 ? "Rp. ".number_format($bulanan['harga']) : "<i class='text-muted'>Rp. 0</i>";
                                                            echo "</td>"; 
                                                            $data[$n]['harga']=$bulanan['qty'];
                                                            $data[$n]['harga']=$bulanan['harga'];
                                                        // metode  n =3
                                                            $request=3;
                                                            $ST1['qty_rule']="";
                                                            $ST1['harga_rule']="";
                                                            $string['qty_rule']="<b>S’t = α Xt + (1- α) S’t-1</b> <br>";    
                                                            $string['harga_rule']="<b>S’t = α Xt + (1- α) S’t-1</b> <br>"; 
                                                            if ($n<=$request) {
                                                                $qty = "-";
                                                                $harga="-";
                                                                echo "<td>".$qty."</td>";
                                                                echo "<td>".$harga."</td>";
                                                                echo "</tr>"  ;
                                                            }else{
                                                                $loop=0;
                                                                $tmpbulan=$bulan-$request;
                                                                if ($tmpbulan < 0) {
                                                                    $tmpbulan = 12 + $tmpbulan;
                                                                    $tmptahun--;
                                                                }else{
                                                                    $tmptahun=$tahun;
                                                                }
                                                                $ES[$n]['qty']=0;
                                                                $ES[$n]['harga']=0;
                                                                $ES[$n]['qty_rule']="";
                                                                $ES[$n]['harga_rule']="";
                                                                do {
                                                                    $num=$loop+1;
                                                                    if ($tmpbulan == 13) {
                                                                        $tmpbulan=1;
                                                                        $tmptahun++;
                                                                    }
                                                                    $tmpbulan= $tmpbulan < 10 ? "0".$tmpbulan :  $tmpbulan;
                                                                    $sql="SELECT sum(qty) as qty,sum(total) as harga from transaksi join detail_transaksi on transaksi.id=detail_transaksi.transaksi_id   where tanggal like '".$tmptahun."-".$tmpbulan."%'";
                                                                    $tmp=mysqli_fetch_array(mysqli_query($conn,$sql));
                                                                    $temp_qty=$tmp['qty']>0 ? $tmp['qty'] : 0;
                                                                    $temp_harga=$tmp['harga']>0 ? $tmp['harga'] : 0;
                                                                    
                                                                    $xQTY[$tmpbulan]    = $tmpbulan;
                                                                    $yQTY[$tmpbulan]    = $temp_qty;
                                                                    $xHARGA[$tmpbulan]  = $tmpbulan;
                                                                    $yHARGA[$tmpbulan]  = $temp_harga;

                                                                    $xyQTY[$tmpbulan]   = $xQTY[$tmpbulan] * $yQTY[$tmpbulan];
                                                                    $xyHARGA[$tmpbulan] = $xHARGA[$tmpbulan] * $yHARGA[$tmpbulan];

                                                                    $xxQTY[$tmpbulan]   = pow($xQTY[$tmpbulan], 2);
                                                                    $xxHARGA[$tmpbulan] = pow($xQTY[$tmpbulan], 2);

                                                                    $tmpbulan++;
                                                                    $loop++;
                                                                } while ($loop<$request); 
                                                                $sumxQTY[$sbulan]     = sum($xQTY);
                                                                $sumxHARGA[$sbulan]   = sum($xHARGA);

                                                                $sumyQTY[$sbulan]     = sum($yQTY);
                                                                $sumyHARGA[$sbulan]   = sum($yHARGA);

                                                                $sumxyQTY[$sbulan]    = sum($xyQTY);
                                                                $sumxyHARGA[$sbulan]  = sum($xyHARGA);

                                                                $sumxxQTY[$sbulan]    = sum($xxQTY);
                                                                $sumxxHARGA[$sbulan]  = sum($xxHARGA);

                                                                $avgxQTY[$sbulan]     = $sumxQTY[$sbulan] / count($xQTY);
                                                                $avgxHARGA[$sbulan]   = $sumxHARGA[$sbulan] / count($xHARGA);

                                                                $avgyQTY[$sbulan]     = $sumyQTY[$sbulan] / count($xQTY);
                                                                $avgyHARGA[$sbulan]   = $sumyHARGA[$sbulan] / count($xHARGA);

                                                                $aQTY[$sbulan]        = (($sumyQTY[$sbulan]*$sumxxQTY[$sbulan]) - ($sumxQTY[$sbulan]*$sumxyQTY[$sbulan])) / ($sumxxQTY[$sbulan] - pow($sumxQTY[$sbulan],2));   
                                                                $aHARGA[$sbulan]      = (($sumyHARGA[$sbulan]*$sumxxHARGA[$sbulan]) - ($sumxHARGA[$sbulan]*$sumxyHARGA[$sbulan])) / ($sumxxHARGA[$sbulan] - pow($sumxHARGA[$sbulan],2));  

                                                                $bQTY[$sbulan]        = ($sumxyQTY[$sbulan]-($sumxQTY[$sbulan] * $sumyQTY[$sbulan]))/($sumxxQTY[$sbulan] - $sumxxQTY[$sbulan]);
                                                                $bHARGA[$sbulan]      = ($sumxyHARGA[$sbulan]-($sumxHARGA[$sbulan] * $sumyHARGA[$sbulan]))/($sumxxHARGA[$sbulan] - $sumxxHARGA[$sbulan]);

                                                                $coordYQTY[$sbulan]   = $aQTY[$sbulan] + ($bQTY[$sbulan]);
                                                                $coordYHARGA[$sbulan] = $aHARGA[$sbulan] + ($bHARGA[$sbulan]);
                                                                echo "<td>".$coordYQTY."</td>";
                                                                echo "<td>".$coordYHARGA."</td>";
                                                                echo "</tr>"  ;
                                                            }    

                                                            // endmetode 
                                                            $n++;
                                                            $bulan++;
                                                            
                                                        } while ($n<=12);
                                                        ?>
                                                    </tbody>
                                                </table> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>