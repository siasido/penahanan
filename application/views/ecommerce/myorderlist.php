
    <div class="page-wrapper" style="display: block;">
    
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Pesanan</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Pesanan Saya</li>
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

                                <h4 class="card-title mb-3">Pesanan Saya</h4>

                                <ul class="nav nav-pills bg-nav-pills mb-3">
                                    <li class="nav-item">
                                        <a href="#order1" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Order</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#proses1" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0 ">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Dikemas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#kirim1" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Dikirim</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#selesai1" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Selesai</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane show active" id="order1">
                                        <div class="table-responsive no-wrap">
                                            <table class="table product-overview v-middle">
                                                <thead>
                                                    <tr>
                                                        <th class="border-0">No. Order</th>
                                                        <th class="border-0">Tanggal</th>
                                                        <th class="border-0">Penerima</th>
                                                        <th class="border-0">Kurir</th>
                                                        <th class="border-0">Total Bayar</th>
                                                        <th class="border-0">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($data_orderlist as $key => $value) { ?>
                                                    <tr>
                                                        <td><a href="<?=site_url('orders/detailPesanan/'.$value->no_order)?>"><?=$value->no_order?></a></td>
                                                        <td><?=datetime_indo($value->created_at)?></td>
                                                        <td>
                                                             <p>Nama :<strong><?=$value->namapenerima?></p></strong>
                                                            <p>No. HP: <?=$value->nohppenerima?></p>
                                                            <p>Alamat: <?=$value->alamat?></p>
                                                        </td>
                                                        <td>
                                                            <p><strong><?=$value->kurir?></p></strong>
                                                            <p>Catatan: <?=$value->notes?></p>
                                                        </td>
                                                        <td>
                                                           <p>Rp<?=number_format($value->total)?></p> 
                                                            <?php if ($value->statusbayar == 0 ) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Belum Bayar</span>
                                                            <?php } else if ($value->statusbayar ==1) { ?>
                                                                <span class="px-2 py-1 badge badge-success font-weight-100">Menunggu Konfirmasi Admin</span>
                                                            <?php } else if ($value->statusbayar ==2) { ?>
                                                                <span class="px-2 py-1 badge badge-danger font-weight-100">Ditolak</span>
                                                                <p>Catatan: <?=$value->catatanpembayaran?></p>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($value->statusbayar == 0 ) { ?>
                                                                <a href="<?=site_url('orders/formbayar/'.$value->idsales)?>" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Bayar">Bayar</a> 
                                                            <?php } else if ($value->statusbayar == 2 ) { ?>
                                                                <a href="<?=site_url('orders/formbayar/'.$value->idsales)?>" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Bayar">Bayar</a> 
                                                                
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="proses1">
                                        <div class="table-responsive no-wrap">
                                            <table class="table product-overview v-middle">
                                                <thead>
                                                    <tr>
                                                        <th class="border-0">No. Order</th>
                                                        <th class="border-0">Tanggal</th>
                                                        <th class="border-0">Penerima</th>
                                                        <th class="border-0">Kurir</th>
                                                        <th class="border-0">Total Bayar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($data_processedOrderlist as $key => $value) { ?>
                                                    <tr>
                                                        <td><a href="<?=site_url('orders/detailPesanan/'.$value->no_order)?>"><?=$value->no_order?></a></td>
                                                        <td><?=datetime_indo($value->created_at)?></td>
                                                        <td>
                                                             <p>Nama :<strong><?=$value->namapenerima?></p></strong>
                                                            <p>No. HP: <?=$value->nohppenerima?></p>
                                                            <p>Alamat: <?=$value->alamat?></p>
                                                        </td>
                                                        <td>
                                                            <p><strong><?=$value->kurir?></p></strong>
                                                            <p>Catatan: <?=$value->notes?></p>
                                                        </td>
                                                        <td>
                                                           <p>Rp<?=number_format($value->total)?></p> 
                                                            <?php if ($value->statusbayar == 0 ) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Belum Bayar</span>
                                                            <?php } else if ($value->statusbayar ==1) { ?>
                                                                <span class="px-2 py-1 badge badge-success font-weight-100">Menunggu Konfirmasi Admin</span>
                                                            <?php } else if ($value->statusbayar ==2) { ?>
                                                                <span class="px-2 py-1 badge badge-danger font-weight-100">Ditolak</span>
                                                                <p>Catatan: <?=$value->catatanpembayaran?></p>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="kirim1">
                                        <div class="table-responsive no-wrap">
                                            <table class="table product-overview v-middle">
                                                <thead>
                                                    <tr>
                                                        <th class="border-0">No. Order</th>
                                                        <th class="border-0">Tanggal</th>
                                                        <th class="border-0">Penerima</th>
                                                        <th class="border-0">Kurir</th>
                                                        <th class="border-0">Total Bayar</th>
                                                        <th class="border-0">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($data_terkirim as $key => $value) { ?>
                                                    <tr>
                                                        <td><a href="<?=site_url('orders/detailPesanan/'.$value->no_order)?>"><?=$value->no_order?></a></td>
                                                        <td><?=datetime_indo($value->created_at)?></td>
                                                        <td>
                                                             <p>Nama :<strong><?=$value->namapenerima?></p></strong>
                                                            <p>No. HP: <?=$value->nohppenerima?></p>
                                                            <p>Alamat: <?=$value->alamat?></p>
                                                        </td>
                                                        <td>
                                                            <p><strong><?=$value->kurir?></p></strong>
                                                            <p>No. RESI: <strong><?=$value->noresi?></p></strong>
                                                            <p>Catatan: <?=$value->notes?></p>
                                                        </td>
                                                        <td>
                                                           <p>Rp<?=number_format($value->total)?></p> 
                                                            <?php if ($value->statusbayar == 0 ) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Belum Bayar</span>
                                                            <?php } else if ($value->statusbayar ==1) { ?>
                                                                <span class="px-2 py-1 badge badge-success font-weight-100">Menunggu Konfirmasi Admin</span>
                                                            <?php } else if ($value->statusbayar ==2) { ?>
                                                                <span class="px-2 py-1 badge badge-danger font-weight-100">Ditolak</span>
                                                                <p>Catatan: <?=$value->catatanpembayaran?></p>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?=site_url('orders/terimabarang/'.$value->idsales)?>" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Terima Barang">Terima Barang</a>
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="selesai1">
                                        <div class="table-responsive no-wrap">
                                            <table class="table product-overview v-middle">
                                                <thead>
                                                    <tr>
                                                        <th class="border-0">No. Order</th>
                                                        <th class="border-0">Tanggal</th>
                                                        <th class="border-0">Penerima</th>
                                                        <th class="border-0">Kurir</th>
                                                        <th class="border-0">Total Bayar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($data_diterima as $key => $value) { ?>
                                                    <tr>
                                                        <td><a href="<?=site_url('orders/detailPesanan/'.$value->no_order)?>"><?=$value->no_order?></a></td>
                                                        <td><?=datetime_indo($value->created_at)?></td>
                                                        <td>
                                                             <p>Nama :<strong><?=$value->namapenerima?></p></strong>
                                                            <p>No. HP: <?=$value->nohppenerima?></p>
                                                            <p>Alamat: <?=$value->alamat?></p>
                                                        </td>
                                                        <td>
                                                            <p><strong><?=$value->kurir?></p></strong>
                                                            <p>No. RESI: <strong><?=$value->noresi?></p></strong>
                                                            <p>Catatan: <?=$value->notes?></p>
                                                        </td>
                                                        <td>
                                                           <p>Rp<?=number_format($value->total)?></p> 
                                                            <?php if ($value->statusbayar == 0 ) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Belum Bayar</span>
                                                            <?php } else if ($value->statusbayar ==1) { ?>
                                                                <span class="px-2 py-1 badge badge-success font-weight-100">Menunggu Konfirmasi Admin</span>
                                                            <?php } else if ($value->statusbayar ==2) { ?>
                                                                <span class="px-2 py-1 badge badge-danger font-weight-100">Ditolak</span>
                                                                <p>Catatan: <?=$value->catatanpembayaran?></p>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
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