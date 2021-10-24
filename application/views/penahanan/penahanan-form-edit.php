
 <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Penetapan Penahanan</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Penetapan Penahanan</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->


                        <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="col-md-12 col-lg-11">
                    <div class="card card-body">
                        <h3 class="mb-0">Ubah Penetapan Penahanan</h3>
                        <p class="text-muted mb-4 font-13"> Lengkapi form berikut untuk mengubah penetapan penahanan:</p>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?=site_url('penahanan/update')?>" method="post">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?=(encode_url($this->input->post('id') ?? $row->id))?>">
                                        
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="tglpermohonan">Tanggal Permohonan</label>
                                                <input type="text" class="form-control" name="tglpermohonan" value=<?=($this->input->post('tglpermohonan') ?? $row->tglpermohonan)?> id="tglpermohonan">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('tglpermohonan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="instansi">Instansi Pemohon</label>
                                                <select class="select2 form-control custom-select <?=form_error('idinstansi') ? 'is-invalid' : null ?>" name="idinstansi" style="width: 100%; height:36px;" required>
                                                <?php $selectedInstansiPemohon = ($this->input->post('idinstansi') ?? $row->idinstansi)?>
                                                <?php foreach ($data_instansi as $key => $val) {?>
                                                    <option value="<?=$key?>" <?=($key == $selectedInstansiPemohon ? 'selected' : null); ?> > <?=$val['namainstansi']?></option>
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
                                                <input type="text" name="nomorpermohonan" class="form-control" id="nomorpermohonan" value="<?=$this->input->post('nomorpermohonan') ?? $row->nomorpermohonan?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('nomorpermohonan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="idtersangka">Nama Tersangka</label>
                                                <select class="select2 form-control custom-select <?=form_error('idtersangka') ? 'is-invalid' : null ?>" id="idtersangka" name="idtersangka" style="width: 100%; height:36px;" required>
                                                <?php $selectedTersangka = ($this->input->post('idtersangka') ?? $row->idtersangka)?>
                                                <?php foreach ($data_tersangka as $key => $val) {?>
                                                    <option value="<?=$key?>" <?=($key == $selectedTersangka ? 'selected' : null); ?>> <?=$val['namatersangka']?></option>
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
                                                <textarea class="form-control" id="jenisperkara" name="jenisperkara" rows="3" ><?=$this->input->post('jenisperkara') ?? $row->jenisperkara?></textarea>
                                            </div>
                                            <div class="text-danger">
                                                <small><?php echo form_error('jenisperkara'); ?></small>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="pasalperkara">Pasal Perkara</label>
                                                <textarea class="form-control" id="pasalperkara" name="pasalperkara" rows="3" ><?=$this->input->post('pasalperkara') ?? $row->pasalperkara?></textarea>
                                            </div>
                                            <div class="text-danger">
                                                <small><?php echo form_error('pasalperkara'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="instansi">Instansi Penetap Penahanan Terakhir</label>
                                                <select class="select2 form-control custom-select <?=form_error('instansipenahanterakhir') ? 'is-invalid' : null ?>" name="instansipenahanterakhir" style="width: 100%; height:36px;" required>
                                                <?php $selectedInstansiPenahan = ($this->input->post('instansipenahanterakhir') ?? $row->instansipenahanterakhir)?>
                                                <?php foreach ($data_instansi as $key => $val) {?>
                                                    <option value="<?=$key?>" <?=($key == $selectedInstansiPenahan ? 'selected' : null); ?>> <?=$val['namainstansi']?></option>
                                                <?php } ?>
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('instansipenahanterakhir'); ?></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="tglpenahananhabis">Tanggal Penahanan Berakhir</label>
                                                <input type="text" class="form-control" name="tglpenahananhabis" id="tglpenahananhabis" value="<?=$this->input->post('tglpenahananhabis') ?? $row->tglpenahananhabis?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('tglpenahananhabis'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">   
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="pasalrujukan">Pasal Rujukan</label>
                                                <select class="select2 form-control custom-select <?=form_error('pasalrujukan') ? 'is-invalid' : null ?>" name="pasalrujukan" id="pasalrujukan" style="width: 100%; height:36px;" required>
                                                    <?php $selectedPasalRujukan = ($this->input->post('pasalrujukan') ?? $row->pasalrujukan)?>
                                                    <option value="">-Pilih Pasal Rujukan-</option>
                                                    <option value="1" <?=(1 == $selectedPasalRujukan ? 'selected' : null); ?> data-lamapermintaanpenahanan="30">Pasal 25 Ayat (2) KUHAP </option>
                                                    <option value="2" <?=(2 == $selectedPasalRujukan ? 'selected' : null); ?> data-lamapermintaanpenahanan="30">Pasal 29 Ayat (1,2 dan 3) KUHAP Tahap I</option>
                                                    <option value="3" <?=(3 == $selectedPasalRujukan ? 'selected' : null); ?> data-lamapermintaanpenahanan="30">Pasal 29 Ayat (1,2 dan 3) KUHAP Tahap II</option>
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('pasalrujukan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="perpanjangan">Permintaan Perpanjangan Penahanan (hari)</label>
                                                <input type="text" name="perpanjangan" class="form-control" id="perpanjangan" value="<?=$this->input->post('perpanjangan') ?? $row->perpanjangan?>" readonly>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('perpanjangan'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mr-2">Simpan</button>
                                                <a href="<?=site_url('penahanan/index')?>" class="btn btn-inverse waves-effect waves-light">Batal</a>
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

        $('#tglpenahananhabis').bootstrapMaterialDatePicker({
            time: false,
            format: 'YYYY-MM-DD',
            lang: 'id',
            // maxDate : new Date() 
        });

        $("#pasalrujukan").on("change", function (e) {
            
            let objectEvent = $('option:selected', this);
            let lamahari = objectEvent.attr('data-lamapermintaanpenahanan');
            console.log(lamahari);
            // $("#perpanjangan").val();
            $("#perpanjangan").val(lamahari);
        });
    </script>

</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/starter-kit.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:36 GMT -->
</html>

