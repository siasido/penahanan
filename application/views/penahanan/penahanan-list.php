 
 <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">List Penetapan Penahanan</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Penetapan Penahanan</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->


            <!-- Container fluid  -->
            <div class="container-fluid">

                <?php if ($this->session->flashdata('notif_success')) { ?>
                    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Success - </strong><?= $this->session->flashdata('notif_success') ?>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('notif_failed')) { ?>
                    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Error - </strong> <?= $this->session->flashdata('notif_failed') ?>
                    </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List Penetapan Penahanan</h4>
                                <div class="text-right">
                                        <a href="<?=site_url('penahanan/add')?>" class="btn btn-info">
                                            Tambah Penetapan Penahanan
                                        </a>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="file_export" class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Penetapan</th>
                                                <th>Nomor Penetapan</th>
                                                <th>Instansi Pemohon</th>
                                                <th>Nama Tersangka</th>
                                                <th>Jenis Perkara</th>
                                                <th>Perpanjangan Penahanan (hari)</th>
                                                
                                                <?php if ($this->session->userdata('role') == 1 ) { ?>
                                                    <th>Created At</th>
                                                    <th>Last Updated</th>
                                                    
                                                <?php } ?>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $key => $value) { ?>
                                                <tr>
                                                <td><?=datetime_indo($value->created_at)?></td>
                                                <td><?=$value->nomorpenetapan?></td>
                                                <td><?=$value->namainstansi?></td>
                                                <td><?=$value->namatersangka?></td>
                                                <td><?=$value->jenisperkara?></td>
                                                <td><?=$value->perpanjangan?></td>
                                                <?php if ($this->session->userdata('role') == 1 ) { ?>
                                                <td><?=datetime_indo($value->created_at)?></td>
                                                <td><?=datetime_indo($value->updated_at)?></td>
                                                <?php } ?>
                                                <td>
                                                    <a href="<?=site_url('penahanan/detail/'.encode_url($value->id))?>" class="btn waves-effect waves-light btn-success"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Detil">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button class="btn waves-effect waves-light btn-secondary" data-toggle="modal" data-target="#modal<?=$value->id?>" >
                                                        <i class="fas fa-print"></i>
                                                    </button>
                                                    <a href="<?=site_url('penahanan/edit/'.encode_url($value->id))?>" class="btn waves-effect waves-light btn-warning"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <?php if ($this->session->userdata('role') == 1 ) { ?>
                                                    <a href="<?=site_url('penahanan/delete/'.encode_url($value->id))?>" class="btn waves-effect waves-light btn-danger"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <?php foreach ($data as $key => $value) { ?>
                <!-- sample modal content -->
                <div id="modal<?=$value->id?>" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h4 class="modal-title" id="myModalLabel">Cetak Penetapan Penahanan</h4>
                                <button type="button" class="close ml-auto" data-dismiss="modal"
                                    aria-hidden="true">×</button>
                            </div>
                            <form action="<?=site_url('penahanan/cetak')?>" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        
                                            <div class="row">
                                                <input type="hidden" name="id" value="<?=$value->id?>">
                                                <div class="col-md-12 mb-12">
                                                    <div class="form-group">
                                                        <label for="roleuser">Pejabat Pembuat Penetapan</label>
                                                        <select class="select2 form-control custom-select <?=form_error('roleuser') ? 'is-invalid' : null ?>" name="roleuser" style="width: 100%; height:36px;" required>
                                                            <option value="">-Pilih Pejabat-</option>
                                                            <option value="2" <?php echo set_select('roleuser', 2)?>>Ketua Pengadilan</option>
                                                            <option value="3" <?php echo set_select('roleuser', 3)?>>Wakil Ketua Pengadilan</option>
                                                        </select>
                                                        <div class="text-danger">
                                                            <small><?php echo form_error('roleuser'); ?></small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Cetak Penetapan</button>
                            </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            <?php }?>
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
    <script data-cfasync="false" src="<?php echo base_url()?>assets/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
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
   
</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/starter-kit.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:36 GMT -->
</html>

