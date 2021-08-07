
 <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Profile</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->


                        <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12">
                    <div class="card card-body">
                        <h3 class="mb-0">Edit Profile</h3>
                        <p class="text-muted mb-4 font-13"> Lengkapi form berikut untuk mengubah data profile pengguna:</p>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?=site_url('users/update')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="userid" value="<?=$this->input->post('userid') ?? $data_pengguna->userid?>">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" id="username" value="<?=$this->input->post('username') ?? $data_pengguna->username?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('username'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="namalengkap">Nama Lengkap</label>
                                                <input type="text" name="namalengkap" class="form-control" id="namalengkap" value="<?=$this->input->post('namalengkap') ?? $data_pengguna->namalengkap?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('namalengkap'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="nohp">No. HP</label>
                                                <input type="text" name="nohp" class="form-control" id="nohp" value="<?=$this->input->post('nohp') ?? $data_pengguna->nohp?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('nohp'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <span class="text-muted">*Kosongkan jika tidak ingin mengubah password</span>
                                                <input type="password" name="password" class="form-control" id="password" value="<?=$this->input->post('password')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('password'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="passconf">Retype Password</label>
                                                <input type="password" name="passconf" class="form-control" id="passconf" value="<?=$this->input->post('passconf')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('passconf'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            
                                            <div class="el-element-overlay">
                                                <div class="el-card-item pb-3">
                                                    <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">
                                                    <?php if ($data_pengguna->foto != null) { ?>
                                                        <a class="image-popup-vertical-fit" href="<?=base_url('uploads/users/'.$data_pengguna->foto)?>"> <img src="<?=base_url('uploads/users/'.$data_pengguna->foto)?>" class="d-block position-relative" width="150px" alt="user"> </a>
                                                    <?php } else { ?>
                                                        <a class="image-popup-vertical-fit" href="<?=base_url('assets/no_image.jpg')?>"> <img src="<?=base_url('assets/no_image.jpg')?>" class="d-block position-relative" width="150px" alt="user"> </a>
                                                    <?php } ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Foto</label><span class="text-muted">*Kosongkan file upload jika tidak ingin mengubah foto</span>
                                                <input type="file" class="form-control" id="foto" name="foto" aria-describedby="fileHelp">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mr-2">Submit</button>
                                            <a href="<?=site_url('barang/index')?>" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                


            </div>
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2020 Material Pro Admin by wrappixel.com
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
 
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url()?>assets/src/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="<?php echo base_url()?>assets/dist/js/app.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/app.init.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/src/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url()?>assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url()?>assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url()?>assets/dist/js/custom.min.js"></script>

    <!--Datatables plugins -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/pages/datatable/custom-datatable.js"></script>

    <!-- start - This is for export functionality only -->
    <script src="<?php echo base_url()?>assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="<?php echo base_url()?>assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/pages/datatable/datatable-advanced.init.js"></script>
   
    <!-- ZOOM IMage JS -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url()?>assets/src/assets/libs/magnific-popup/meg.init.js"></script>

    <!-- SELECT JS -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url()?>assets/src/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/pages/forms/select2/select2.init.js"></script>

    <!-- RangePicker JS -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/moment/moment.js"></script>
    <script src="<?php echo base_url()?>assets/src/assets/libs/daterangepicker/daterangepicker.js"></script>

    <!-- Datetetimepicker JS -->
    <!-- <script src="<?php echo base_url()?>assets/src/assets/libs/moment/moment.js"></script> -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js"></script>

    <script src="<?php echo base_url () ?>assets/src/assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
    <script src="<?php echo base_url () ?>assets/dist/js/custom.min.js"></script>
   

</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/starter-kit.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:36 GMT -->
</html>

