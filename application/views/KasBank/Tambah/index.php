<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title"><?= $title; ?></h3> -->
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Nomor:</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="nomor_kas_bank" id="nomor" placeholder="AUTO" readonly value="">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="checkbox" name="" id="penomoran_otomatis" style="margin-top: 5%" checked> automatic_numbering
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal:</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control datepicker" name="tanggal" required value="{tanggal}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Perusahaan:</label>
                                        <select id="id_perusahaan" class="form-control id_perusahaan" name="perusahaan" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label>PIC:</label>
                                        <select id="pejabat" class="form-control" name="pejabat" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label>Information:</label>
                                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <?php $menu = array(
                                'rincian_buku_kas_umum',
                                'saldo_sumber_dana',
                            ) ?>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#rincian_buku_kas_umum" role="tab" data-toggle="tab">Rincian Buku Kas Umum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#saldo_sumber_dana" role="tab" data-toggle="tab">Saldo Sumber Dana</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="rincian_buku_kas_umum">

                                    <div class="text-center">

                                    </div>

                                    <div class="mb-3 mt-3 table-responsive">
                                        <table class="table table-bordered" id="table_detail_rincian_buku_kas_umum">
                                            <thead class="{bg_header}" id="atastabel" hidden>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Tipe</th>
                                                    <th>Tanggal</th>
                                                    <th>No. Aktivitas</th>
                                                    <th>Penerimaan</th>
                                                    <th>Pengeluaran</th>
                                                    <th>Nomor Akun</th>
                                                    <th>Kode Unit</th>
                                                    <th>Departemen</th>
                                                    <th>Sumber Dana</th>
                                                </tr>
                                            </thead>
                                            <tbody id="isitabel"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="saldo_sumber_dana">
                                    <div class="mb-3 mt-3 table-responsive">
                                        <table class="table table-bordered" id="table_detail_rincian_buku_kas_umum">
                                            <thead class="bg-secondary" id="atastabel">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Tipe</th>
                                                    <th>Tanggal</th>
                                                    <th>No. Aktivitas</th>
                                                    <th>Penerimaan</th>
                                                    <th>Pengeluaran</th>
                                                    <th>Nomor Akun</th>
                                                    <th>Kode Unit</th>
                                                    <th>Departemen</th>
                                                    <th>Sumber Dana</th>
                                                </tr>
                                            </thead>
                                            <tbody id="isitabel"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-2 text-right" style="margin-top: 1%">Total Penerimaan</div>
                                <div class="col-md-3">
                                    <input type="text" id="penerimaan_sementara" class="form-control decimalnumber text-right" name="" readonly>
                                    <input type="hidden" id="penerimaan" class="form-control decimalnumber text-right" name="penerimaan" readonly>
                                </div>
                                <div class="col-md-2 text-right" style="margin-top: 1%">Total Pengeluaran</div>
                                <div class="col-md-3">
                                    <input type="text" id="pengeluaran_sementara" class="form-control decimalnumber text-right" name="" readonly>
                                    <input type="hidden" id="pengeluaran" class="form-control decimalnumber text-right" name="pengeluaran" readonly>
                                </div>
                                <div class="col-md-3">

                                </div>

                            </div>

                            <br>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="text-left">
                                <div class="btn-group">
                                    <a href="" class="btn bg-danger">Batal</a>
                                    <button type="submit" class="btn bg-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->