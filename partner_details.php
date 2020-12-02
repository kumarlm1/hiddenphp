<?php
  session_start();
  require_once("classes/dbo.class.php");
  require_once("classes/functions.php");
  check_login($_SESSION["empid"]);

  if(!isset($_GET["id"]) || empty($_GET["id"])){
    header("location:business_partner.php"); exit;
  }

  $id = decode($_GET["id"]);
  $partners = $db->get("select * from business_partners,categories,states,cities where partner_category = cat_id AND partner_state = states.id AND partner_city = cities.id and partner_id = ? ",array($id));
  
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
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        
        <?php require_once("include/sidebar.inc.php"); ?>

      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1><i class="fa fa-user-md"></i> Business Partner Details</h1>
      </section>
      <hr>

      <!-- Main content -->
      <section class="content">

        <div class="row">

          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="box box-primary">
              <div class="box-body box-profile">

                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Name</b> <br> <?php echo $partners[0]["partner_name"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Email</b> <br> <?php echo $partners[0]["partner_email"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Contact</b> <br> <?php echo $partners[0]["partner_contact"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Category</b> <br> <?php echo $partners[0]["cat_name"] ?></div>
                  
                  <div class="col-lg-12 col-md-12 col-sm-12"><br></div>

                  <div class="col-lg-3 col-md-3 col-sm-6"><b>State</b> <br> <?php echo $partners[0]["state_name"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>City</b> <br> <?php echo $partners[0]["city_name"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Opning Hours</b> <br> <?php echo $partners[0]["partner_opening_hours"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>GST Number</b> <br> <?php echo $partners[0]["partner_gst_number"] ?></div>

                  <div class="col-lg-12 col-md-12 col-sm-12"><br></div>

                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Address</b> <br> <?php echo $partners[0]["partner_address"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Serving Location</b> <br> <?php echo $partners[0]["partner_location"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Status</b> <br> <?php echo (($partners[0]["partner_status"] == 1) ? 'Active' : 'Deactive') ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Created At</b> <br> <?php echo $partners[0]["partner_created_at"] ?></div>

                  <div class="col-lg-12 col-md-12 col-sm-12"><br></div>

                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Subscription Plan</b> <br> <?php echo $partners[0]["partner_subscription_plan"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Transaction Id</b> <br> <?php echo $partners[0]["partner_transaction_id"] ?></div>
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Transaction Date</b> <br> <?php echo $partners[0]["partner_transaction_date"] ?></div>
                  
                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Subscription Plan Expire</b> <br> <?php echo $partners[0]["partner_plan_expire_date"] ?></div>

                  <div class="col-lg-12 col-md-12 col-sm-12"><br></div>

                  <div class="col-lg-3 col-md-3 col-sm-6"><b>Transaction Amount</b> <br> <?php echo $partners[0]["partner_transaction_amount"] ?> Rs.</div>
                </div>

              </div>

            </div>
          </div> 
        </div>

        <div class="row dnone listing-box">
          
          <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                
                <div class="box-body">
                 
                  <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Listing Name">
                        </div>
                      
                        <div class="form-group">
                          <label for="availability">Availability</label>
                          <input type="text" class="form-control" name="availability" id="availability" placeholder="Availability">
                        </div>
                      
                        <div class="form-group">
                          <label for="price">Price</label>
                          <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                        </div>

                        <div class="form-group">
                          <label for="name">Product/Service Image</label>
                          <input type="file" class="form-control form-control-file" name="image" id="image">
                        </div>
                      
                        <div class="form-group">
                          <label for="name">Product/Service Video</label>
                          <input type="file" class="form-control form-control-file" name="video" id="video">
                        </div>
                   
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" name="description" id="description" placeholder="Description" rows="4"></textarea>
                        </div>

                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group" style="padding-top: 7px;">
                              <label for="name">Negotiable</label> <br>
                              <input type="radio" class="" name="negotiable" value="Yes"> Yes &nbsp;&nbsp;&nbsp;
                              <input type="radio" class="" name="negotiable" value="No"> No
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group" style="padding-top: 7px;">
                                <label for="name">Listing Type</label> <br>
                                <input type="radio" class="listing_type" name="type" value="product"> Product &nbsp;&nbsp;&nbsp;
                                <input type="radio" class="listing_type" name="type" value="service"> Service
                              </div>
                          </div>
                        </div>

                        <div class="row dnone" id="product">
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                              <label for="color">Color</label>
                              <input type="text" class="form-control" name="color" id="color" placeholder="Product Color">
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                              <label for="size">Size</label>
                              <input type="text" class="form-control" name="size" id="size" placeholder="Product Size">
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                              <label for="specifications">Specifications</label>
                              <input type="text" class="form-control" name="specifications" id="specifications" placeholder="Product Specifications">
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                              <label for="compatibility">Compatibility</label>
                              <input type="text" class="form-control" name="compatibility" id="compatibility" placeholder="Product Compatibility">
                            </div>
                          </div>
                        </div>

                        <div class="row dnone" id="service">
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                              <label for="service_type">Service Type</label>
                              <input type="text" class="form-control" name="service_type" id="service_type" placeholder="Service Type">
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                              <label for="service_time">Service Time</label>
                              <input type="text" class="form-control" name="service_time" id="service_time" placeholder="Service Time">
                            </div>
                          </div>

                        </div>
                        
                    </div>

                  </div>

                  <br>
                  <center>
                    <button class="btn btn-primary" type="submit">Add</button> &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" id="close">Close</button>
                  </center>

                 </div>
                 
              </div>
          </div>
        </div>

        <div class="row">
          
          <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="box">
                <div class="box-body table-responsive">
                  <h4 class="box-title"><b>Business Listing</b></h4> 
                  <button class="btn btn-primary f-right" id="add_listing">Add Listing</button>
                  <hr>
                  
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Availability</th>
                        <th>Price</th>
                        <th>Negotiable</th>
                        <th>Created At</th>
                      </tr>
                    </thead>
                    <tbody>
                                            
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
  <script type="text/javascript">
    $(document).ready(function(){
      
      $('#dataTable').DataTable();

      $('#add_listing').click(function(){

        $('.listing-box').removeClass('dnone');
        $('#add_listing').addClass('dnone');
      });


      $('.listing_type').change(function(){
        var type = $(this).val();
        
        if(type == 'product'){

          $('#product').removeClass('dnone');
          $('#service').addClass('dnone');
          $('#service input[type="text"]').val('');

        }else if(type == 'service'){

          $('#service').removeClass('dnone');
          $('#product').addClass('dnone');
          $('#product input[type="text"]').val('');

        }
      });

      $('#close').click(function(){

        $('.listing-box').addClass('dnone');
        $('#add_listing').removeClass('dnone');
      });

    });
  </script>
  </body>
</html>

