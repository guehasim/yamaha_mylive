<!DOCTYPE html>
<html lang="en">
<head>

  <?php 
  error_reporting(0);
  $sec = "15";
  ?>
  <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta http-equiv="refresh" content="<?php echo $sec?>;">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Yamaha</title>
  
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/vendor_components/bootstrap/dist/css/bootstrap.min.css">
    
    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/bootstrap-extend.css">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/master_style.css">

    <!-- skins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/skins/_all-skins.css">
    
    <!-- main-nav -->
    <link href="<?php echo base_url(); ?>assets/login/css/main-nav.css" rel="stylesheet" />    

    <!-- bootstrap datepicker --> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <!-- toast CSS -->
    <link href="<?php echo base_url(); ?>assets/login/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <style>
      table {
        border-collapse: collapse;
        width: 100%;
      }

      th, td {
        text-align: left;
        padding: 8px;
      }

      th{
        background-color: #020673;
        color:#FFFFFF;
      }

      tr:nth-child(even) {
        background-color: #D6EEEE;
      }
    </style>

    <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  title: {
    text: " "
  },
  theme: "light2",
  animationEnabled: true,
  toolTip:{
    shared: true,
    reversed: true
  },
  axisY: {
    title: "Total Monitoring",
    suffix: ""
  },
  legend: {
    cursor: "pointer",
    itemclick: toggleDataSeries
  },
  data: [
    {
      type: "stackedColumn",
      name: "Status Open",
      showInLegend: true,
      yValueFormatString: "#,##0",
      color: "#18fc03",
      dataPoints: <?php echo json_encode($open, JSON_NUMERIC_CHECK); ?>
    },{
      type: "stackedColumn",
      name: "Status Close",
      showInLegend: true,
      yValueFormatString: "#,##0",
      color: "#fc0303",
      dataPoints: <?php echo json_encode($close, JSON_NUMERIC_CHECK); ?>
    }
  ]
});
 
chart.render();
 
function toggleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else {
    e.dataSeries.visible = true;
  }
  e.chart.render();
}
 
}
</script>
</head>
<body class="hold-transition bg-img" style="background-color :#000000" data-overlay="3">    
    <div class="wrapper">
      <div class="container">
        <div class="row mt-20">    
          <div class="col-lg-12 col-xs-12">
            <div class="card">
              <div class="card-body">
                <h2 class="bg-purple-ym p-2 text-center font-weight-bold" style="background-color:#020673;">My LIVE Monitoring</h2>
                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div style="width: 100%;">
                  <table class="table table-striped" style="color:#000000">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Kategori</th>
                      <th>Name</th>
                      <th>Dept</th>
                      <th>Deskripsi</th>
                      <th>Status</th>
                    </thead>
                    <tbody>
                      <?php

                      $query = $this->db->query("SELECT
                                        tbl_transaksi.ID_Transaksi, 
                                        tbl_transaksi.Trans_TglJam, 
                                        tbl_transaksi.Trans_IDKaryawan, 
                                        tbl_transaksi.Trans_Ticket, 
                                        tbl_transaksi.Trans_Deskripsi, 
                                        tbl_transaksi.Trans_Status, 
                                        tbl_transaksi.Trans_img_before, 
                                        m_kategori.Kategori, 
                                        m_user.NamaUser,
                                        m_user.DeptUser
                                      FROM
                                        tbl_transaksi
                                        INNER JOIN
                                        m_kategori
                                        ON 
                                          tbl_transaksi.Trans_Ticket = m_kategori.ID_Kategori
                                        INNER JOIN
                                        m_user
                                        ON 
                                          tbl_transaksi.Trans_IDKaryawan = m_user.ID_User
                                      ORDER BY
                                        tbl_transaksi.ID_Transaksi DESC"); 
                       ?>
                       <?php $no=1; foreach ($query->result() as $ad): ?> 
                      <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo date('d M y',strtotime($ad->Trans_TglJam));?></td>
                        <td><?php echo $ad->Kategori;?></td>
                        <td><?php echo $ad->NamaUser;?></td>
                        <td><?php echo $ad->DeptUser;?></td>
                        <td><?php echo $ad->Trans_Deskripsi;?></td>
                        <?php
                            if ($ad->Trans_Status == 0) {
                               $tampil = "style='background-color:#18fc03; color:#000000;' ";
                             } else{
                              $tampil = "style='background-color:#fc0303; color:#FFFFFF;' ";
                             }
                             ?>
                        <td <?php echo $tampil;?>>
                            <?php
                            if ($ad->Trans_Status == 0) {
                               echo "Open";
                             }else{
                              echo "Close";
                             } 
                             ?>
                        </td>
                      </tr>

                      <?php $area_old = $area;?>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    <script src="<?php echo base_url() ?>assets/chart/canvasjs.min.js"></script>

    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
    
    <!-- popper -->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/popper/dist/popper.min.js"></script>
    
    <!-- Bootstrap 4.0-->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- toast -->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>



    <!-- bootstrap datepicker -->
  <script src="<?php echo base_url(); ?>assets/login/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- JQuery Validate -->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js"></script>
    
</body>
</html>
