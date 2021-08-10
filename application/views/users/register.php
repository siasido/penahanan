
<!DOCTYPE html>
<html dir="ltr">


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/authentication-register2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:47 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>SM Motor | Register</title>
	<link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?=base_url()?>/assets/src/assets/images/bengkel.jpg) no-repeat center center; background-size: cover;">
            <div class="auth-box on-sidebar p-4 bg-white m-0 rounded">
                <div>
                    
                    <h3 class="box-title mt-5 mb-0">Register Now</h3><small>Create your account and enjoy</small> 
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3 form-material" method="post" action="<?=site_url('users/prosesregistrasi')?>" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                  <div class="col-xs-12">
                                    <input class="form-control" id="username" name="username" value="<?=$this->input->post('username')?>" type="text" placeholder="Username">
                                    <div class="text-danger">
                                      <small><?php echo form_error('username'); ?></small>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group mt-3">
                                  <div class="col-xs-12">
                                    <input class="form-control" id="namalengkap" name="namalengkap" value="<?=$this->input->post('namalengkap')?>" type="text" placeholder="Nama">
                                    <div class="text-danger">
                                      <small><?php echo form_error('namalengkap'); ?></small>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group mt-3">
                                  <div class="col-xs-12">
                                    <input class="form-control" id="nohp" name="nohp" value="<?=$this->input->post('nohp')?>" type="text" placeholder="No. HP">
                                    <div class="text-danger">
                                      <small><?php echo form_error('nohp'); ?></small>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group mt-3">
                                  <div class="col-xs-12">
                                    <input class="form-control" id="password" name="password" value="<?=$this->input->post('password')?>" type="password" placeholder="Password">
                                    <div class="text-danger">
                                      <small><?php echo form_error('password'); ?></small>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group mt-3">
                                  <div class="col-xs-12">
                                    <input class="form-control" id="passconf" name="passconf" value="<?=$this->input->post('passconf')?>" type="password" placeholder="Re-type Password">
                                    <div class="text-danger">
                                      <small><?php echo form_error('passconf'); ?></small>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group text-center mt-3">
                                  <div class="col-xs-12">
                                    <input type="file" class="form-control" id="foto" name="foto" title="Foto Profil">
                                  </div>
                                </div>
                                <div class="form-group text-center mt-3">
                                  <div class="col-xs-12">
                                    <button name="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                                  </div>
                                </div>
                                <div class="form-group mb-0">
                                  <div class="col-sm-12 text-center">
                                    <p>Already have an account? <a href="<?=site_url('auth')?>" class="text-info ml-1">Sign In</a></p>
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url()?>assets/src/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip "]').tooltip();
    $(".preloader ").fadeOut();
    </script>
</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/authentication-register2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:48 GMT -->
</html>