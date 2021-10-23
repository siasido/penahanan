
 <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Profil Instansi</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Edit Instansi</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->


                        <!-- Container fluid  -->
                        <div class="container-fluid">
                <div class="col-md-12 col-lg-11">
                    <div class="card card-body">
                        <h3 class="mb-0">Edit Tersangka</h3>
                        <p class="text-muted mb-4 font-13"> Lengkapi form berikut untuk mengubah data tersangka:</p>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?=site_url('tersangka/update')?>" method="post">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?=($this->input->post('id') ?? $data->id)?>">
                                        
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" class="form-control" id="nama" value="<?=($this->input->post('nama') ?? $data->nama)?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('nama'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="tempatlahir">Tempat Lahir</label>
                                                <input type="text" name="tempatlahir" class="form-control" id="tempatlahir" value="<?=($this->input->post('tempatlahir') ?? $data->tempatlahir)?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('tempatlahir'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="tgllahir">Tanggal Lahir</label>
                                                <input type="text" class="form-control" name="tgllahir" id="tgllahir" value=<?=($this->input->post('tgllahir') ?? $data->tgllahir)?>>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('tgllahir'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="jeniskelamin">Jenis Kelamin</label>
                                                <select class="select2 form-control custom-select <?=form_error('jeniskelamin') ? 'is-invalid' : null ?>" name="jeniskelamin" style="width: 100%; height:36px;" required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <?php $selectedGender = ($this->input->post('jeniskelamin') ?? $data->jeniskelamin)?>
                                                    <option value="1" <?=($selectedGender == 1 ? 'selected' : null) ?>> Laki-laki</option>
                                                    <option value="2" <?=($selectedGender == 2 ? 'selected' : null) ?>> Perempuan</option>
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('jeniskelamin'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="suku">Suku</label>
                                                <input type="text" name="suku" class="form-control" id="suku" value="<?=($this->input->post('suku') ?? $data->suku)?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('suku'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="kebangsaan">Kebangsaan</label>
                                                <input type="text" name="kebangsaan" class="form-control" id="kebangsaan" value="<?=($this->input->post('kebangsaan') ?? $data->kebangsaan)?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('kebangsaan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="pekerjaan">Pekerjaan</label>
                                                <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" value="<?=($this->input->post('pekerjaan') ?? $data->pekerjaan)?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('pekerjaan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="pendidikan">Pendidikan</label>
                                                <select class="select2 form-control custom-select <?=form_error('pendidikan') ? 'is-invalid' : null ?>" name="pendidikan" style="width: 100%; height:36px;" required>
                                                    <option value="">Pilih Pendidikan</option>
                                                    <?php $selectedPendidikan = ($this->input->post('pendidikan') ?? $data->pendidikan)?>
                                                    <option value="1" <?=($selectedPendidikan == 1 ? 'selected' : null) ?>>SD</option>
                                                    <option value="2" <?=($selectedPendidikan == 2 ? 'selected' : null) ?>>SMP</option>
                                                    <option value="3" <?=($selectedPendidikan == 3 ? 'selected' : null) ?>>SLTA</option>
                                                    <option value="4" <?=($selectedPendidikan == 4 ? 'selected' : null) ?>>Diploma I (D1)</option>
                                                    <option value="5" <?=($selectedPendidikan == 5 ? 'selected' : null) ?>>Diploma III (D3)</option>
                                                    <option value="6" <?=($selectedPendidikan == 6 ? 'selected' : null) ?>>Diploma IV (D4)</option>
                                                    <option value="7" <?=($selectedPendidikan == 7 ? 'selected' : null) ?>>Sarjana (S1)</option>
                                                    <option value="8" <?=($selectedPendidikan == 8 ? 'selected' : null) ?>>Magister (S2)</option>
                                                    <option value="9" <?=($selectedPendidikan == 9 ? 'selected' : null) ?>>Doktoral (S3)</option>
                                                    <option value="10" <?=($selectedPendidikan == 10 ? 'selected' : null) ?>>Lain-lain</option>
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('pendidikan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="agama">Agama</label>
                                                <select class="select2 form-control custom-select <?=form_error('agama') ? 'is-invalid' : null ?>" name="agama" style="width: 100%; height:36px;" required>
                                                    <option value="">Pilih Agama</option>
                                                    <?php $selectedAgama = ($this->input->post('agama') ?? $data->agama)?>
                                                    <option value="1" <?=($selectedAgama == 1 ? 'selected' : null) ?>>Budha</option>
                                                    <option value="2" <?=($selectedAgama == 2 ? 'selected' : null) ?>>Hindu</option>
                                                    <option value="3" <?=($selectedAgama == 3 ? 'selected' : null) ?>>Islam</option>
                                                    <option value="4" <?=($selectedAgama == 4 ? 'selected' : null) ?>>Katolik</option>
                                                    <option value="5" <?=($selectedAgama == 5 ? 'selected' : null) ?>>Konghucu</option>
                                                    <option value="6" <?=($selectedAgama == 6 ? 'selected' : null) ?>>Kristen Protestan</option>
                                                    <option value="7" <?=($selectedAgama == 7 ? 'selected' : null) ?>>Lain-lain</option>
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('agama'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" ><?=($this->input->post('alamat') ?? $data->alamat)?></textarea>
                                            </div>
                                            <div class="text-danger">
                                                <small><?php echo form_error('alamat'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mr-2">Simpan</button>
                                                <a href="<?=site_url('tersangka/index')?>" class="btn btn-inverse waves-effect waves-light">Batal</a>
                                            </div>
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
    <script>
        // moment.locale("id").format('L');
        // moment().format('MMMM Do YYYY, h:mm:ss a');
        $('#tgllahir').bootstrapMaterialDatePicker({
            time: false,
            format: 'YYYY-MM-DD',
            lang: 'id',
            maxDate : new Date()
        });
    </script>

</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/starter-kit.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:36 GMT -->
</html>

