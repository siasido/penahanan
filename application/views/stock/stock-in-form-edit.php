
 <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Products</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->


                        <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12">
                    <div class="card card-body">
                        <h3 class="mb-0">Edit Barang</h3>
                        <p class="text-muted mb-4 font-13"> Lengkapi form berikut untuk mengubah data barang:</p>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?=site_url('barang/update')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="idproduk" value="<?=$this->input->post('idproduk') ?? $data_barang->idproduk?>">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="idkategori">Kategori Barang</label>
                                                <select class="select2 form-control custom-select <?=form_error('idkategori') ? 'is-invalid' : null ?>" name="idkategori" style="width: 100%; height:36px;">
                                                    <option value="">Pilih Kategori</option>
                                                    <?php $selectedKategori = $this->input->post('idkategori') ?? $data_barang->idkategori?>
                                                    <?php foreach ($data_kategori as $key => $val) {?>
                                                        <option value="<?=$val->idkategori?>" <?php echo $selectedKategori== $val->idkategori ? 'selected' : null ?>> <?=$val->namakategori?></option>
                                                    <?php } ?>
                                                
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('paket'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                
                                                <label for="namaproduk">Nama Barang</label>
                                                <input type="text" name="namaproduk" class="form-control" id="namaproduk" value="<?=$this->input->post('namaproduk') ?? $data_barang->namaproduk?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('namaproduk'); ?></small>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="idunit">Satuang Barang</label>
                                                <select class="select2 form-control custom-select <?=form_error('idunit') ? 'is-invalid' : null ?>" name="idunit" style="width: 100%; height:36px;">
                                                    <option value="">Pilih Satuan</option>
                                                    <?php $selectedUnit = $this->input->post('idunit') ?? $data_barang->idunit?>
                                                    <?php foreach ($data_unit as $key => $val) {?>
                                                        <option value="<?=$val->idunit?>" <?php echo $selectedUnit== $val->idunit ? 'selected' : null ?>> <?=$val->namaunit?></option>
                                                    <?php } ?>
                                                
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('paket'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="hargasatuan">Harga Satuan</label>
                                                <input type="number" name="hargasatuan" class="form-control" id="hargasatuan" value="<?=$this->input->post('hargasatuan') ?? $data_barang->hargasatuan?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('hargasatuan'); ?></small>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2" ><?=$this->input->post('deskripsi') ?? $data_barang->deskripsi?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            
                                            <div class="el-element-overlay">
                                                <div class="el-card-item pb-3">
                                                    <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">
                                                    <?php if ($data_barang->foto != null) { ?>
                                                        <a class="image-popup-vertical-fit" href="<?=base_url('uploads/products/'.$data_barang->foto)?>"> <img src="<?=base_url('uploads/products/'.$data_barang->foto)?>" class="d-block position-relative" width="150px" alt="user"> </a>
                                                    <?php } else { ?>
                                                        <a class="image-popup-vertical-fit" href="<?=base_url('assets/no_image.jpg')?>"> <img src="<?=base_url('assets/no_image.jpg')?>" class="d-block position-relative" width="150px" alt="user"> </a>
                                                    <?php } ?>
                                                        
                                                    </div>
                                                    <div class="el-card-content">
                                                        <!-- <h4 class="mb-0">Project title</h4>  -->
                                                        <span class="text-muted">*Kosongkan file upload jika tidak ingin mengubah foto</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Foto</label>
                                                <input type="file" class="form-control" id="foto" name="foto" aria-describedby="fileHelp">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mr-2">Submit</button>
                                        <a href="<?=site_url('barang/index')?>" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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

