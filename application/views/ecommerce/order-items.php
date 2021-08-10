
    <div class="page-wrapper" style="display: block;">
    
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Order Items</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Detail Pesanan</li>
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
                    <!-- Column -->
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h5 class="mb-0 text-white">Detail Pesanan</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <form action="<?=site_url('cart/updateCart')?>" method="post">
                                    <table class="table product-overview">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Product info</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th style="text-align:center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php $index = 1;?>
                                        <?php foreach ($orderItems as $key => $value): ?>
                                            
                                            <tr>
                                                <td width="150"><img src="<?=base_url('uploads/products/'.$value->foto)?>" alt="iMac" width="80"></td>
                                                <td width="550">
                                                    <h5 class="font-500"><?=$value->namaproduk?></h5>
                                                </td>
                                                <td>Rp<?=number_format($value->hargasatuan)?></td>
                                                <td width="70">
                                                    <?=$value->qty?>
                                                </td>
                                                <td width="150" id="<?=$index?>subtotal" align="center" class="font-500">Rp.<?=$value->hargasatuan*$value->qty?></td>
                                                
                                            </tr>
                                        <?php $index++; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="d-flex no-block align-items-center">
                                        <?php if($this->session->userdata('role') == 2 ) { ?>
                                            <a href="<?=site_url('orders/myorderlist')?>" class="btn btn-dark btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
                                        <?php } else { ?>
                                            <a href="<?=site_url('orders/allorder')?>" class="btn btn-dark btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
                                        <?php } ?> 
                                    </div>
                                </div>
                                </form>
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