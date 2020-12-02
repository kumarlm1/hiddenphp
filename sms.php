<?php

  session_start();
  require_once("classes/dbo.class.php");
  require_once("classes/functions.php");
  check_login($_SESSION["empid"]);
  if($_GET["ip"])
  {
  $sms = $db->dml("delete from  sms where device_id = ? ",array(decode($_GET["ip"])));
  }

 $sms = $db->get("select * from sms where sms_id IN (SELECT MAX(sms_id) from sms  GROUP by sms_user) ORDER BY sms_id DESC",array());
?><!DOCTYPE html>
<html>
    <script>
        //location.reload();
    </script>
  <head>
    <?php require_once("include/head.inc.php"); ?>
  </head>
      <script>
        function data_referesh()
        {
            window.location.href="https://jmart.xyz/admin/cron.php";
        }
    </script>
  <body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
       <!-- Logo -->
        <?php require_once("include/logo.inc.php"); ?>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
           <?php require_once("include/profile.inc.php"); ?>
           
          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <section class="sidebar">

        <?php require_once("include/sidebar.inc.php"); ?>

      </section>
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1><i class="fa fa-commenting-o"></i> SMS</h1>
      </section>
      <hr>

      <!-- Main content -->
      <section class="content">
        
        <div class="row">
        <div class="col-md-12 col-sm-12">
            <input type="button" onclick="location.reload()" value="Refresh" class="btn btn-danger">
        </div>
        <br>
        <div class="col-md-12 col-sm-12">

            <div class="box">
              <div class="box-body table-responsive">
                 <?php
                      if(isset($_SESSION["error"])) {
                         error($_SESSION["error"]);
                      }

                      if(isset($_SESSION["success"])) {
                          success($_SESSION["success"]);
                      }
                  ?>
                  <span id="success"></span>
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="20%">User Id</th>
                      <th width="20%">Device Id</th>
                      <th width="20%">Andriod Version</th>
                      <th width="20%">Device Model</th>
                      <th width="20%">Ip Address</th>
                
                      <th width="10%">Action </th>
                      <th width="10%">Status</th>
                      <th width="10%">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($sms as $res){
                          
                         $ips = strval($res["user_id"]);
                          $query = "SELECT * FROM clients where trim(ip)='".trim($ips)."'";
                          $resulto = mysqli_query($conn, $query);
                          

                        ?>
                                                   <tr>
                            
                            <td><?php echo $res["sms_user"];?>
                           
                            </td>
                            
                            <td><?php echo  $res["device_id"] ;?>
                            
                            
                            </td>
                            <td><?php echo $res["andriod_version"];?>
                            </td>
                             <td><?php echo $res["device_model"];?>
                            </td>
                            <td><?php echo $res["user_id"];?></td>
                            <td>
                              <a href="sms_details.php?ip=<?php echo encode($res["device_id"]);?>" class="btn btn-info"><i class="fa fa-arrow-right"></i></a>
                            </td>
                            <td>
                           <?php
                            $ip = $res["sms_user"];
                            $q=$db->get("select * from tbl_status where status1 = ? group by  status1",array($ip));
                            if(empty($q))
                            {
                                ?>
                                    <img src="uploads/offline.png" style="height:10px;margin-top:-3px;">&nbsp;<font color="red">Offline</font>
                                <?php
                            }
                            else
                            {
                                foreach($q as $da)
                                {
                                        if($da['status2']=='Online')
                                        {
                                            ?>
                                            <img src="uploads/online.png" style="height:10px;margin-top:-3px;">&nbsp;<font color="green">Online</font>
                                            <?php
                                        }
                                }
                            }
                            
                            
                          ?>
                            </td>
                            <td>
                              <a href="sms.php?ip=<?php echo encode($res["device_id"]);?>" class="btn btn-info"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                        <?php
                      }
                    ?>  
                  </tbody>
                </table>
              </div>
            </div>

          </div>

        </div>
       
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <?php require_once("include/footer.inc.php"); ?>
    </footer>

    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

  </div>
  <!-- ./wrapper -->

  <?php require_once("include/script.inc.php"); ?>

  <!-- page script -->
  <script>
    $(function () {
      $('#dataTable').DataTable();
      
      $.get("https://jmart.xyz/admin/cron.php");
    });

  </script>
  </body>
</html>
