
    <div class="page-wrapper" style="display: block;">
    
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Pesanan</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Semua Pesanan</li>
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

                                <h4 class="card-title mb-3">List Pesanan</h4>

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
                                                        <th class="border-0">Aksi</th>
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
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Menunggu Konfirmasi</span>
                                                            <?php } else if ($value->statusbayar == 2) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Rejected</span>
                                                            <?php } else if ($value->statusbayar == 3) { ?>
                                                                <span class="px-2 py-1 badge badge-success font-weight-100">Accepted</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($value->statusbayar == 0 || $value->statusbayar == 2) { ?>
                                                                
                                                            <?php } else if ($value->statusbayar == 1) { ?>
                                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-bukti-<?=$value->idsales?>">Confirm Payment</button>
                                                            <?php } else if ($value->statusbayar == 3) { ?>
                                                                <a href="<?=site_url('orders/prosesorder/'.$value->idsales)?>" class="btn btn-primary">Kemas Barang</a>
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
                                                        <th class="border-0">Aksi</th>
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
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Menunggu Konfirmasi</span>
                                                            <?php } else if ($value->statusbayar == 2) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Rejected</span>
                                                            <?php } else if ($value->statusbayar == 3) { ?>
                                                                <span class="px-2 py-1 badge badge-success font-weight-100">Accepted</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($value->statusorder == 1) { ?>
                                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-kirim-<?=$value->idsales?>">Kirim Barang</button>
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
                                                            <p>No RESI: <strong><?=$value->noresi?></p></strong>
                                                            <p>Catatan: <?=$value->notes?></p>
                                                        </td>
                                                        <td>
                                                           <p>Rp<?=number_format($value->total)?></p> 
                                                            <?php if ($value->statusbayar == 0 ) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Belum Bayar</span>
                                                            <?php } else if ($value->statusbayar ==1) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Menunggu Konfirmasi</span>
                                                            <?php } else if ($value->statusbayar == 2) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Rejected</span>
                                                            <?php } else if ($value->statusbayar == 3) { ?>
                                                                <span class="px-2 py-1 badge badge-success font-weight-100">Accepted</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($value->statusorder == 1) { ?>
                                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-kirim-<?=$value->idsales?>">Kirim Barang</button>
                                                            <?php } ?>
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
                                                            <p>No RESI: <strong><?=$value->noresi?></p></strong>
                                                            <p>Catatan: <?=$value->notes?></p>
                                                        </td>
                                                        <td>
                                                           <p>Rp<?=number_format($value->total)?></p> 
                                                            <?php if ($value->statusbayar == 0 ) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Belum Bayar</span>
                                                            <?php } else if ($value->statusbayar ==1) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Menunggu Konfirmasi</span>
                                                            <?php } else if ($value->statusbayar == 2) { ?>
                                                                <span class="px-2 py-1 badge badge-warning font-weight-100">Rejected</span>
                                                            <?php } else if ($value->statusbayar == 3) { ?>
                                                                <span class="px-2 py-1 badge badge-success font-weight-100">Accepted</span>
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

            <!--  Modal content for the above example -->
            <?php foreach ($data_orderlist as $key => $value) { ?>
            <div class="modal fade" id="modal-bukti-<?=$value->idsales?>" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h4 class="modal-title" id="myLargeModalLabel">Konfirmasi Pembayaran</h4>
                            <button type="button" class="close ml-auto" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Bukti Pembayaran</label>
                                    <img src="<?=base_url('/uploads/bukti-bayar/'.$value->buktipembayaran)?>" class="img-thumbnail" style="width:400px; height:500px" alt="user" />
                                </div>
                                <div class="col-md-6">
                                    <form action="<?=site_url('orders/confirmpayment')?>" method="post">
                                        <div class="row">
                                            <input type="hidden" name="idsales" value="<?=$value->idsales?>">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Aksi</label>
                                                    <select class="select2 form-control custom-select <?=form_error('statusbayar') ? 'is-invalid' : null ?>" name="statusbayar" required style="width: 100%; height:36px;">
                                                        <option value="">Pilih Aksi</option>
                                                        <option value="2" <?php echo set_select('statusbayar','2')?>> Reject</option>
                                                        <option value="3" <?php echo set_select('statusbayar','3')?>> Accept</option>
                                                    </select>
                                                    <div class="text-danger">
                                                        <small><?php echo form_error('statusbayar'); ?></small>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Catatan</label>
                                                    <textarea required class="form-control" id="catatanpembayaran" name="catatanpembayaran" rows="2" ><?=$this->input->post('catatanpembayaran')?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button name="submit" type="submit" class="btn btn-info">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?php } ?>


            <?php foreach ($data_processedOrderlist as $key => $value) { ?>
            <div class="modal fade" id="modal-kirim-<?=$value->idsales?>" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h4 class="modal-title" id="myLargeModalLabel">Kirim Barang</h4>
                            <button type="button" class="close ml-auto" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="table-responsive no-wrap">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Penerima</td>
                                                <td>:</td>
                                                <td><?=$value->namapenerima?></td>
                                            </tr>
                                            <tr>
                                                <td>No.HP</td>
                                                <td>:</td>
                                                <td><?=$value->nohppenerima?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td><?=$value->alamat?></td>
                                            </tr>
                                            <tr>
                                                <td>Catatan</td>
                                                <td>:</td>
                                                <td><?=$value->notes?></td>
                                            </tr>
                                            <tr>
                                                <td>Kurir</td>
                                                <td>:</td>
                                                <td><?=$value->kurir?></td>
                                            </tr>
                                            <form action="<?=site_url('orders/kirimbarang')?>" method="post">
                                            <input type="hidden" name="idsales" value="<?=$value->idsales?>">
                                            <tr>
                                                <td><strong>No Resi</strong></td>
                                                <td>:</td>
                                                <td><input type="text" class="form-control" name="noresi" placeholder="0123FQH1xxx" maxlength="15" required></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><button type="submit" name="submit" class="btn btn-block btn-primary waves-effect waves-light mr-2">Submit</button></td>
                                            </tr>
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?php } ?>

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