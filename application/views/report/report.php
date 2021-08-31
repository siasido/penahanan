 
 <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Report</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Bulanan</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->

            <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?=site_url('orders/report')?>" method="post">
                                <div class="input-group">
                                    <select class="custom-select" name="month">
                                        <option value="">- Pilih Bulan -</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                    <select class="form-control" name="year" required>
                                    <option value="">- Pilih Tahun -</option>
                                    <?php
                                    for ($year = (int)date('Y'); 2020 <= $year; $year--): ?>
                                        <option value="<?=$year;?>"><?=$year;?></option>
                                    <?php endfor; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            <!-- Container fluid  -->
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Penjualan Bulanan</h4>
                                
                                <div class="table-responsive">
                                    <table id="file_export" class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>No. Order</th>
                                                <th>Tanggal</th>
                                                <th>Penerima</th>
                                                <th>Kurir</th>
                                                <th>Total Bayar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_orderlist as $key => $value) { ?>
                                                <tr>
                                                    <td><?=$value->no_order?></td>
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
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Danger Alert Modal -->
                <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content modal-filled bg-danger">
                            <div class="modal-body p-4">
                                <div class="text-center">
                                    <i class="dripicons-wrong h1"></i>
                                    <!-- <h4 class="mt-2 text-white">Oh snap!</h4> -->
                                    <p class="mt-3 op-7">Apakah anda yakin ingin menghapus data?</p>
                                    <form action="<?=site_url('barang/delete')?>" method="post">
                                        <input type="hidden" id="idproduk2" value=""      name="idproduk">
                                        <button type="button" class="btn btn-light my-2"
                                            data-dismiss="modal">Cancel</button>
                                        <button name="submit" class="btn btn-outline-light my-2" type="submit">Ya, Hapus Data</button>
                                        
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
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

    <script>
        $('#danger-alert-modal').modal({
            show: false
        }); 

        function showDeletAlert(id){
            $('#danger-alert-modal').modal({
                show: true
            }); 
            $('#idproduk2').val(id);
        }

        
        
    </script>
   
</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/material/starter-kit.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:19:36 GMT -->
</html>

