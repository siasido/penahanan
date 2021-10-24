
 <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Tambah Penetapan Izin/Persetujuan Sita</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Penetapan Izin/Persetujuan Sita</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->


                        <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="col-md-12 col-lg-11">
                    <div class="card card-body">
                        <h3 class="mb-0">Tambah Penetapan Izin/Persetujuan Sita</h3>
                        <p class="text-muted mb-4 font-13"> Lengkapi form berikut untuk menambah penetapan:</p>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?=site_url('penyitaan/submit')?>" method="post">

                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="jenispenyitaan">Jenis Penyitaan</label>
                                                <select class="select2 form-control custom-select <?=form_error('jenispenyitaan') ? 'is-invalid' : null ?>" name="jenispenyitaan" style="width: 100%; height:36px;" required>
                                                    <option value="">Pilih Jenis Penyitaan</option>
                                                    <option value="1" <?php echo set_select('jenispenyitaan', 1)?>>Penetapan Izin Sita</option>
                                                    <option value="2" <?php echo set_select('jenispenyitaan', 2)?>>Penetapan Persetujuan Sita</option>
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('jenispenyitaan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name="id">
                                        
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="tglpermohonan">Tanggal Permohonan</label>
                                                <input type="text" class="form-control" name="tglpermohonan" id="tglpermohonan" value="<?=$this->input->post('tglpermohonan')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('tglpermohonan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="instansi">Instansi Pemohon</label>
                                                <select class="select2 form-control custom-select <?=form_error('idinstansi') ? 'is-invalid' : null ?>" name="idinstansi" style="width: 100%; height:36px;" required>
                                                <?php foreach ($data_instansi as $key => $val) {?>
                                                    <option value="<?=$key?>" <?=set_value('idinstansi') == $key ? 'selected' : null;?>> <?=$val['namainstansi']?></option>
                                                <?php } ?>
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('idinstansi'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="nomorpermohonan">No. Permohonan</label>
                                                <input type="text" name="nomorpermohonan" class="form-control" id="nomorpermohonan" value="<?=$this->input->post('nomorpermohonan')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('nomorpermohonan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="idtersangka">Nama Tersangka</label>
                                                <select class="select2 form-control custom-select <?=form_error('idtersangka') ? 'is-invalid' : null ?>" id="idtersangka" name="idtersangka" style="width: 100%; height:36px;" required>
                                                <?php foreach ($data_tersangka as $key => $val) {?>
                                                    <option value="<?=$key?>" <?=set_value('idtersangka') == $key ? 'selected' : null;?>> <?=$val['namatersangka']?></option>
                                                <?php } ?>
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('idtersangka'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="jenisperkara">Jenis Perkara</label>
                                                <textarea class="form-control" id="jenisperkara" name="jenisperkara" rows="3" ><?=$this->input->post('jenisperkara')?></textarea>
                                            </div>
                                            <div class="text-danger">
                                                <small><?php echo form_error('jenisperkara'); ?></small>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="pasalperkara">Pasal Perkara</label>
                                                <textarea class="form-control" id="pasalperkara" name="pasalperkara" rows="3" ><?=$this->input->post('pasalperkara')?></textarea>
                                            </div>
                                            <div class="text-danger">
                                                <small><?php echo form_error('pasalperkara'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="nomorlaporansita">No. Laporan Sita</label>
                                                <input type="text" name="nomorlaporansita" class="form-control" id="nomorlaporansita" value="<?=$this->input->post('nomorlaporansita')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('nomorlaporansita'); ?></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="tgllaporansita">Tanggal Laporan Sita</label>
                                                <input type="text" class="form-control" name="tgllaporansita" id="tgllaporansita" value="<?=$this->input->post('tgllaporansita')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('tgllaporansita'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">   
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="tglbasita">Tanggal Berita Acara Sita</label>
                                                <input type="text" class="form-control" name="tglbasita" id="tglbasita" value="<?=$this->input->post('tglbasita')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('tglbasita'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="deskripsipenyitaan">Barang yang disita:</label>
                                                <textarea class="form-control" id="deskripsipenyitaan" name="deskripsipenyitaan" rows="5" ><?=$this->input->post('deskripsipenyitaan')?></textarea>
                                            </div>
                                            <div class="text-danger">
                                                <small><?php echo form_error('deskripsipenyitaan'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="disitadari">Barang disita dari:</label>
                                                <input type="text" name="disitadari" class="form-control" id="disitadari" value="<?=$this->input->post('disitadari')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('disitadari'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mr-2">Simpan</button>
                                                <a href="<?=site_url('penyitaan/index')?>" class="btn btn-inverse waves-effect waves-light">Batal</a>
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
    <script src="<?php echo base_url()?>assets/src/assets/libs/moment/moment-with-locales.js"></script>
    <script src="<?php echo base_url()?>assets/src/assets/libs/daterangepicker/daterangepicker.js"></script>

    <!-- Datetetimepicker JS -->
    <!-- <script src="<?php echo base_url()?>assets/src/assets/libs/moment/moment.js"></script> -->
    <script src="<?php echo base_url()?>assets/src/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js"></script>

    <script src="<?php echo base_url () ?>assets/src/assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
    <script src="<?php echo base_url () ?>assets/dist/js/custom.min.js"></script>
    <script>
        // moment.locale("id").format('L');
        // moment().format('MMMM Do YYYY, h:mm:ss a');
        $('#tglpermohonan').bootstrapMaterialDatePicker({
            time: false,
            format: 'YYYY-MM-DD',
            lang: 'id',
            maxDate : new Date()
        });

        $('#tgllaporansita').bootstrapMaterialDatePicker({
            time: false,
            format: 'YYYY-MM-DD',
            lang: 'id',
            maxDate : new Date() 
        });

        $('#tglbasita').bootstrapMaterialDatePicker({
            time: false,
            format: 'YYYY-MM-DD',
            lang: 'id',
            maxDate : new Date() 
        });

    </script>

</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/starter-kit.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:36 GMT -->
</html>

