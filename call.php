<?php
  session_start();
  require_once("classes/dbo.class.php");
  require_once("classes/functions.php");
  check_login($_SESSION["empid"]);

  $recording = $db->get("select * from call_recording group by call_email order by call_name",array());
?><!DOCTYPE html>
<html>
  <head>
    <?php require_once("include/head.inc.php"); ?>
  </head>
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
        <h1><i class="fa fa-phone"></i> Call Recording</h1>
      </section>
      <hr>

      <!-- Main content -->
      <section class="content">
        
        <div class="row">

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
                      <th width="40%">Name</th>
                      <th width="50%">Email</th>
                      <th width="10%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($recording as $res){
                        echo '
                          <tr>
                            <td>'.$res["call_name"].'</td>
                            <td>'.$res["call_email"].'</td>
                            <td>
                              <a href="call_details.php?email='.encode($res["call_email"]).'" class="btn btn-info"><i class="fa fa-arrow-right"></i></a>
                            </td>
                          </tr>
                        ';
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
    });

  </script>
  </body>
</html>
