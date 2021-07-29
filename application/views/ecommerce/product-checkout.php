
    <div class="page-wrapper" style="display: block;">
    
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Checkout Keranjang</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Checkout Keranjang</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Daftar Belanja</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Foto Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Quantity</th>
                                                <th>Harga Satuan</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($this->cart->contents() as $items): ?>
                                            <tr>
                                                <td>
                                                    <?php foreach ($items['options'] as $key => $value): ?>
                                                        <img src="<?=base_url('uploads/products/'.$value)?>" alt="iMac" width="80">
                                                    <?php endforeach; ?>
                                                </td>
                                                <td><?=$items['name']?></td>
                                                <td><?=$items['qty']?></td>
                                                <td class="font-500">Rp<?=number_format($items['price'])?></td>
                                                <td class="font-500">Rp<?=number_format($items['qty']*$items['price'])?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                            <tr>
                                                <td colspan="4" class="font-500" align="right">Total Harga</td>
                                                <td class="font-500"><strong>Rp<?=number_format($this->cart->total())?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <h5 class="card-title">Checkout Keranjang</h5>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="nav-item">
                                        <a href="#iprofile" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Data Penerima</span>
                                    </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="iprofile">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <form action="<?=site_url('orders/prosescheckout')?>" method="post">
                                                <?php $no_order = date('YmdHis').strtoupper(random_string('alnum',8))?>
                                                    <div class="form-group input-group mt-5">
                                                        <div class="input-group-prepend">
                                                            <!-- <span class="input-group-text"><i class="fab fa-cc-visa"></i></span> -->
                                                        </div>
                                                        <!-- <input type="text" class="form-control" placeholder="Card Number" aria-label="Amount (to the nearest dollar)"> -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-7 col-md-7">
                                                            <div class="form-group">
                                                                <label>Nama Penerima</label>
                                                                <input type="hidden" name="no_order" value="<?=$no_order?>">
                                                                <input type="hidden" name="total" value="<?=$this->cart->total()?>">
                                                                <input type="text" class="form-control" name="namapenerima" value="<?=$this->input->post('namapenerima')?>" placeholder="John Doe"> 
                                                            </div>
                                                            <div class="text-danger">
                                                                <small><?php echo form_error('namapenerima'); ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-5 col-md-5 pull-right">
                                                            <div class="form-group">
                                                                <label>No. HP</label>
                                                                <input type="number" class="form-control" name="nohppenerima" value="<?=$this->input->post('nohppenerima')?>" placeholder="0812xxx..." > 
                                                            </div>
                                                            <div class="text-danger">
                                                                <small><?php echo form_error('nohppenerima'); ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-7 col-md-7">
                                                            <div class="form-group">
                                                                <label>Alamat</label>
                                                                <textarea class="form-control" id="alamat" name="alamat" rows="2" ><?=$this->input->post('alamat')?></textarea>
                                                            </div>
                                                            <div class="text-danger">
                                                                <small><?php echo form_error('alamat'); ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-5 col-md-5 pull-right">
                                                            <div class="form-group">
                                                                <label>Catatan</label>
                                                                <textarea class="form-control" id="notes" name="notes" rows="2" ><?=$this->input->post('notes')?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-7 col-md-7">
                                                            <div class="form-group">
                                                                <label>Jasa Pengiriman</label>
                                                                <select class="select2 form-control custom-select <?=form_error('kurir') ? 'is-invalid' : null ?>" name="kurir" style="width: 100%; height:36px;">
                                                                    <option value="">Pilih Jasa Pengiriman</option>
                                                                    <option value="JNE" <?php echo set_select('kurir','JNE')?>> JNE</option>
                                                                    <option value="Sicepat" <?php echo set_select('kurir','Sicepat')?>> Sicepat</option>
                                                                    <option value="JNT" <?php echo set_select('kurir','JNT')?>> JNT</option>
                                                                    <option value="Tiki" <?php echo set_select('kurir','Tiki')?>> Tiki</option>
                                                                    <option value="POS" <?php echo set_select('kurir','POS')?>> POS</option>
                                                                </select>
                                                                <div class="text-danger">
                                                                    <small><?php echo form_error('kurir'); ?></small>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="col-xs-5 col-md-5 pull-right">
                                                            <div class="form-group">
                                                                <label>Rekening Pembayaran</label>
                                                                <select class="select2 form-control custom-select <?=form_error('idrekening') ? 'is-invalid' : null ?>" name="idrekening" style="width: 100%; height:36px;">
                                                                    <!-- <option value="">Pilih Supplier</option> -->
                                                                    <?php foreach ($data_rekening as $key => $val) {?>
                                                                        <option value="<?=$key?>" <?=set_value('idrekening') == $key ? 'selected' : null;?>> <?=$val['rekening']?></option>
                                                                    <?php } ?>
                                                                
                                                                </select>
                                                                <div class="text-danger">
                                                                    <small><?php echo form_error('idsupplier'); ?></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="<?=site_url('cart/show')?>" class="btn btn-secondary">Back To Cart</a>
                                                    <button name="submit" type="submit" class="btn btn-info">Make Payment</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
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
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->

    <!-- <div class="chat-windows"></div> -->
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
    <script>
        function updateQty(objEvent){ 
           console.log(objEvent.value);
           console.log(objEvent.dataset.hargasatuan);
           console.log(objEvent.dataset.index)

           let qty = objEvent.value;
           let hargasatuan = objEvent.dataset.hargasatuan;
           let id = objEvent.dataset.index;
           
            document.getElementById(id+'subtotal').innerHTML = 'Rp'+(qty*hargasatuan).toLocaleString(window.document.documentElement.lang);
        }
    </script>

</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/starter-kit.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:36 GMT -->
</html>