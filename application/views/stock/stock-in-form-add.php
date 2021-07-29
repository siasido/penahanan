
 <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Stock</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Purchase Order</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->


                        <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12">
                    <div class="card card-body">
                        <h3 class="mb-0">Purchase Barang</h3>
                        <p class="text-muted mb-4 font-13"> Lengkapi form berikut untuk purchase barang:</p>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?=site_url('stock/submitInStock')?>" method="post">
                                    <div class="row">
                                        <input type="hidden" name="idpurchase">
                                        <div class="col-sm-12 col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                            
                                                <label for="purchasedate">Tanggal PO</label>
                                                <input type="date" name="purchasedate" class="form-control" id="purchasedate" value="<?=$this->input->post('purchasedate')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('purchasedate'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="idsupplier">Supplier</label>
                                                <select class="select2 form-control custom-select <?=form_error('idsupplier') ? 'is-invalid' : null ?>" name="idsupplier" style="width: 100%; height:36px;">
                                                    <option value="">Pilih Supplier</option>
                                                    <?php foreach ($data_supplier as $key => $val) {?>
                                                        <option value="<?=$val->idsupplier?>" <?php echo set_select('idsupplier', $val->idsupplier)?>> <?=$val->namasupplier?></option>
                                                    <?php } ?>
                                                
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('idsupplier'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="idproduk">Barang</label>
                                                <select id="idproduk" class="select2 form-control custom-select <?=form_error('idproduk') ? 'is-invalid' : null ?>" name="idproduk" style="width: 100%; height:36px;">
                                                <?php foreach ($data_barang as $key => $val) { ?>
                                                    <option value="<?=$key?>" <?=set_value('idproduk') == $key ? 'selected' : null;?> data-namaunit="<?=$val['namaunit']?>" data-sisastock="<?=$val['sisastock']?>"><?=$val['namaproduk']?></option>
                                                <?php }?>
                                                </select>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('idproduk'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="sisastock">Initial Stock</label>
                                                <input type="text" name="sisastock" class="form-control" id="sisastock" value="<?=$this->input->post('sisastock')?>" readonly>
                                                <div class="text-danger">
                                                    <small><?php echo form_error('sisastock'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="qty">Qty</label>
                                                <input type="number" name="qty" class="form-control" id="qty" value="<?=$this->input->post('qty')?>">
                                                <div class="text-danger">
                                                    <small><?php echo form_error('qty'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="qty" id="labelsatuan">Satuan Unit</label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="form-group">
                                                <label for="notes">Catatan</label>
                                                <textarea class="form-control" id="notes" name="notes" rows="2" ><?=$this->input->post('notes')?></textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mr-2">Submit</button>
                                        <a href="<?=site_url('stock/inStockList')?>" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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
        $("#idproduk").on("change", function (e) {
            let objectEvent = $('option:selected', this);
            let namaunit = objectEvent.attr('data-namaunit');
            $("#labelsatuan").empty();
            $("#labelsatuan").append(namaunit);


            let initStock = objectEvent.attr('data-sisastock');
            console.log(initStock.value);
            $('#sisastock').val(initStock);
        });
    </script>

</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/starter-kit.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:36 GMT -->
</html>

