<div class="container my-2">
    <?php if ($this->session->flashdata('flash2')) : ?>
        <div class="row mt-3">
            <div class="col md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Produk <strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">Data Produk <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>
                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('flash_error')) : ?>
        <div class="row mt-3">
            <div class="col md-6">
                <div class="alert alert-danger fade show" role="alert">
                    <?= $this->session->flashdata('flash_error'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('flash_success')) : ?>
        <div class="row mt-3">
            <div class="col md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('flash_success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <style>
        .active-row {
            background-color: #ddd;
        }
    </style>

    <div id="notif"></div>

    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('barang/search'); ?>">
                <div class="d-flex align-items-start">
                    <div class="mr-1 flex-grow-1">
                        <div class="input-group input-group-sm mb-1">
                            <input type="text" name="filter-nama" id="filter-nama" class="form-control form-control-sm" data-toggle="modal" data-target="#myModal" placeholder="Nama barang">
                        </div>
                        <div class="input-group input-group-sm mb-1">
                            <input type="text" name="filter-kode" id="filter-kode" class="form-control form-control-sm" placeholder="Kode barang">
                        </div>
                    </div>
                    <button class="btn btn-sm btn-info" type="submit">Filter</button>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <form action="<?= base_url('barang/index_serach') ?>">
                <div class="d-flex align-items-start">
                    <div class="mr-1 flex-grow-1">
                        <div class="input-group input-group-sm mb-1">
                            <select name="filter-kategori" id="filter-kategori" class="form-control form-control-sm" required>
                                <option value="">Pilih kategori</option>
                                <?php foreach ($get_kategori as $row) : ?>
                                    <option value="<?php echo $row->kategori; ?>"><?php echo $row->kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-group input-group-sm">
                            <select name="filter-gudang" id="filter-gudang" class="form-control form-control-sm" required>
                                <option value="">Pilih gudang</option>
                                <?php foreach ($get_gudang as $row) : ?>
                                    <option value="<?php echo $row->gudang; ?>"><?php echo $row->gudang; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-info" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="my-2">
        <a href="<?= base_url('barang/allBarang'); ?>" class="btn btn-primary">Show All</a>
        <a class="btn btn-info" href="#" data-toggle="modal" data-target="#modal_add_new">Tambah Data</a>
        <a class="btn btn-success" href="<?= base_url('barang/import_excel'); ?>">Import Excel</a>
        <a class="btn btn-success" href="<?= base_url('barang/excel'); ?>">Export Excel</a>
        <a href="<?= base_url('Transfer_gudang/tambah'); ?>" class="btn btn-secondary">Transfer Antar Gudang</a>
        <a href="<?= base_url('Adjust_stok/tambah'); ?>" class="btn btn-secondary">Penyesuaian Persedian</a>
        <a href="<?= base_url('Kartu_stok/tambah'); ?>" class="btn btn-secondary">Kartu Stok</a>
        <button class="btn btn-warning mt-2" onclick="returnKeSupplier()">Return Ke Supplier</button>
        <!-- <a href="<?= base_url('barang/transfer_gudang'); ?>" class="btn btn-secondary mb-2">Transfer Antar Gudang</a> -->
        <!-- <a href="<?= base_url('barang/laporan_pdf'); ?>" class="btn btn-danger mb-2">Export PDF</a> -->
    </div>

    <table id="lookup" class="table-responsive table table-hover" cellspacing="2" style="font-size:11px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Kode Akun</th>
                <!-- <th>Manager</th> -->
                <th>Gudang</th>
                <th>Unit Masuk</th>
                <th>Unit Keluar</th>
                <th>Unit Saldo</th>
                <th>HPP</th>
                <th>Harga Sebelum Pajak</th>
                <th>PPN</th>
                <th>Harga Setelah Pajak</th>
                <th>Harga Setoran</th>
                <th>Jumlah Modal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="check">
            <?php if ($data != null) : ?>
                <?php $no = 1; ?>
                <?php foreach ($data->result_array() as $dt) :
                    $kode = $dt['kode'];
                    $nama = $dt['nama'];
                    $kategori = $dt['kategori'];
                    $kode_akun = $dt['id_coa'];
                    $manager = $dt['manager'];
                    $gudang = $dt['gudang'];
                    $unitmasuk = $dt['unitmasuk'];
                    $unitkeluar = $dt['unitkeluar'];
                    $qty = $dt['qty'];
                    $unitbagus = $dt['unitbagus'];
                    $unitrusak = $dt['unitrusak'];
                    $hpp = $dt['hpp'];
                    $sebelumpajak = $dt['sebelumpajak'];
                    $ppn = $dt['ppn'];
                    $setelahpajak = $dt['setelahpajak'];
                    $hargasetoran = $dt['hargasetoran'];
                    $jumlah = $dt['jumlah'];
                    $id = $dt['id'];

                    if ($dt['id_coa'] != 0) {
                        $akun = $this->M_account->getDataById($dt['id_coa']);
                    }
                ?>
                    <tr data-kode="<?= $kode; ?>" data-barang="<?= $nama; ?>" data-gudang="<?= $gudang; ?>" data-qty="<?= $qty; ?>" class="t-row">
                        <td>
                            <?= $no++; ?>
                        </td>
                        <td>
                            <?= $kode; ?>
                        </td>
                        <td width="">
                            <?= $nama; ?>
                        </td>
                        <td>
                            <?php
                            if ($kategori) {
                                foreach ($get_category as $gc) :
                                    if ($gc->kode == $kategori) {
                                        echo $gc->name;
                                    }
                                endforeach;
                            } else {
                                echo "Tidak terdaftar";
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($dt['id_coa'] != 0) { ?>
                                <?= "K-" . $akun['kode'] . " - " . $akun['nama']; ?>
                            <?php } ?>
                        </td>
                        <!-- <td>
                    <?= $manager; ?>
                </td> -->
                        <td>
                            <?= $gudang; ?>
                        </td>
                        <td class="">
                            <?= $unitmasuk; ?>
                        </td>
                        <td class="">
                            <?= $unitkeluar; ?>
                        </td>
                        <td class="">
                            <?= $qty; ?>
                        </td>
                        <td class="">
                            <?php if ($hpp == "") { ?>
                                -
                            <?php } else { ?>
                                <?php echo number_format($hpp, 2, ',', '.'); ?>
                            <?php } ?>
                        </td>
                        <td class="">
                            <?php if ($sebelumpajak == "") { ?>
                                -
                            <?php } else { ?>
                                <?php echo number_format($sebelumpajak, 2, ',', '.'); ?>
                            <?php } ?>

                        </td>
                        <td class="">
                            <?php if ($ppn == "") { ?>
                                -
                            <?php } else { ?>
                                <?php echo $ppn . "%"; ?>
                            <?php } ?>
                        </td>
                        <td class="">
                            <?php if ($setelahpajak == "") { ?>
                                -
                            <?php } else { ?>
                                <?php echo number_format($setelahpajak, 2, ',', '.'); ?>
                            <?php } ?>

                        </td>
                        <td class="">
                            <?php if ($hargasetoran == "") { ?>
                                -
                            <?php } else { ?>
                                <?php echo number_format($hargasetoran, 2, ',', '.'); ?>
                            <?php } ?>

                        </td>
                        <td class="">
                            <?php if ($jumlah == "") { ?>
                                -
                            <?php } else { ?>
                                <?php echo number_format($jumlah, 2, ',', '.'); ?>
                            <?php } ?>

                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a data-toggle="modal" onclick="handleEditData('<?= $id ?>')" class="btn btn-success mt-2" style="margin-left:42px"><i class="fa fa-edit"></i>Edit</i></a>
                                    <a href="<?= base_url(); ?>barang/hapus/<?= $id; ?>" class="btn btn-danger mt-2" style="margin-left:35px" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <table id="lookup" class="table-responsive table table-hover" cellspacing="2" width="" style="font-size: small;">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <!-- <th>Manager</th> -->
                                <th>Gudang</th>
                                <th>QTY</th>
                                <th>Unit Bagus</th>
                                <th>Unit Rusak</th>
                                <th>HPP</th>
                                <th>Harga Sebelum Pajak</th>
                                <th>PPN</th>
                                <th>Harga Setelah Pajak</th>
                                <th>Harga Setoran</th>
                                <th>Jumlah Modal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($databrg != null) :
                                foreach ($databrg->result_array() as $i) :
                                    $id = $i['id'];
                                    $kode = $i['kode'];
                                    $nama = $i['nama'];
                                    $kategori = $i['kategori'];
                                    $gudang = $i['gudang'];
                                    $manager = $i['manager'];
                                    $gudang = $i['gudang'];
                                    $qty = $i['qty'];
                                    $unitbagus = $i['unitbagus'];
                                    $unitrusak = $i['unitrusak'];
                                    $hpp = $i['hpp'];
                                    $sebelumpajak = $i['sebelumpajak'];
                                    $ppn = $i['ppn'];
                                    $setelahpajak = $i['setelahpajak'];
                                    $hargasetoran = $i['hargasetoran'];
                                    $jumlah = $i['jumlah'];
                            ?>
                                    <tr class="pilih" data-nama="<?php echo $nama; ?>" data-kode="<?php echo $kode; ?>">
                                        <td>
                                            <?php echo $kode ?>
                                        </td>
                                        <td width="">
                                            <?php echo $nama ?>
                                        </td>
                                        <td>
                                            <?php echo $kategori ?>
                                        </td>
                                        <!-- <td>
                                    <?php echo $manager ?>
                                </td> -->
                                        <td>
                                            <?php echo $gudang ?>
                                        </td>
                                        <td class="">
                                            <?php echo $qty ?>
                                        </td>
                                        <td class="">
                                            <?php echo $unitbagus ?>
                                        </td>
                                        <td class="">
                                            <?php echo $unitrusak ?>
                                        </td>
                                        <td class="">
                                            <?php echo $hpp ?>
                                        </td>
                                        <td class="">
                                            <?php echo $sebelumpajak ?>
                                        </td>
                                        <td class="">
                                            <?php echo $ppn ?>
                                        </td>
                                        <td class="">
                                            <?php echo $setelahpajak ?>
                                        </td>
                                        <td class="">
                                            <?php echo $hargasetoran ?>
                                        </td>
                                        <td class="">
                                            <?php echo $jumlah ?>
                                        </td>
                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ============ MODAL ADD Kategori =============== -->
    <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"></h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url() . 'barang/tambah_aksi' ?>">
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputKode">Kode <span class="text-danger">*</span></label>
                                    <input class="form-control" id="inputKode" name="kode" autocomplete="off" />
                                    <table class="table table-bordered table-sm table-hover" id="tabelKode" style="position: absolute; background-color: white; z-index: 10; display: none;">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Gudang</th>
                                            </tr>
                                        </thead>
                                        <tbody id="show_data_kode">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputBarang">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputBarang" name="nama" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputKategori">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-control" id="inputKategori" name="kategori" required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($get_category as $row) { ?>
                                            <option value="<?php echo $row->kode; ?>"><?php echo $row->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- <div class="form-group col-md-6">
                                    <label for="inputManager">Manager</label>
                                    <input type="text" class="form-control" id="inputManager" placeholder="" name="manager">
                                </div> -->
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputGudang">Gudang <span class="text-danger">*</span></label>
                                    <select class="form-control" id="inputGudang" name="gudang" required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($get_category1 as $row) { ?>
                                            <option value="<?php echo $row->nama; ?>"><?php echo $row->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputSebelumPajak">Harga Sebelum Pajak</label>
                                    <input type="text" class="form-control numeric" id="inputSebelumPajak" name="sebelumpajak" oninput="hitungHargaPPN()" onchange="handlerFormat(event, '#inputSebelumPajak')">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPpn">PPN</label>
                                    <div class="d-flex align-items-center">
                                        <input type="text" class="form-control mr-1 numeric" id="inputPpn" name="ppn" oninput="hitungHargaPPN()">
                                        <span>%</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputSetelahPajak">Harga Setelah Pajak</label>
                                    <input type="text" class="form-control" id="inputSetelahPajak" name="setelahpajak" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputBagus">Unit Bagus</label>
                                    <input type="text" class="form-control" id="inputBagus" name="unitbagus">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputRusak">Unit Rusak</label>
                                    <input type="text" class="form-control" id="inputRusak" name="unitrusak">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputSetoran">Harga Setoran</label>
                                    <input type="text" class="form-control numeric" id="inputSetoran" name="hargasetoran" onchange="handlerFormat(event, '#inputSetoran')">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputStok">Stok Awal</label>
                                    <input type="text" class="form-control numeric" id="inputStok" name="qty" onkeyup="hitungTotal(event)">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="hpp">HPP</label>
                                    <input type="text" class="form-control numeric" id="hpp" name="hpp" onchange="handlerFormat(event, '#hpp')">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputTotal">Total</label>
                                    <input type="text" class="form-control" id="inputTotal" name="jumlah" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="hpp">Kode Akun</label>
                                    <select class="form-control" name="id_coa_create" id="id_coa_create"></select>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal Transfer Antar Gudang -->
    <div class="modal fade" id="modalTransferAntarGdg" tabindex="-1" aria-labelledby="modalTransferAntarGdgLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTransferAntarGdgLabel">Transfer Antar Gudang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('transfer_gudang/tambahDataTransferGdg'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tgl_tfgdg">Tanggal</label>
                                <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tgl_tfgdg" name="tgl_tfgdg" required value="<?= date('Y-m-d'); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no_transfer_tfgdg">No. Transfer</label>
                                <input type="text" class="form-control" id="no_transfer_tfgdg" name="no_transfer_tfgdg" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_tfgdg">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan_tfgdg" placeholder="" name="keterangan_tfgdg" value="-">
                        </div>
                        <div class="form-group">
                            <label for="kode_tfgdg">Kode</label>
                            <input type="text" class="form-control" id="kode_tfgdg" placeholder="" name="kode_tfgdg" readonly>
                        </div>
                        <div class="form-group">
                            <label for="barang_tfgdg">Nama Barang</label>
                            <input type="text" class="form-control" id="barang_tfgdg" placeholder="" name="barang_tfgdg" readonly>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gudang_asal_tfgdg">Gudang Asal</label>
                                <input type="text" class="form-control" id="gudang_asal_tfgdg" name="gudang_asal_tfgdg" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="gudang_tujuan_tfgdg">Gudang Tujuan</label>
                                <select name="gudang_tujuan_tfgdg" id="gudang_tujuan_tfgdg" class="form-control">
                                    ---
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="qty_asal_tfgdg">QTY Asal</label>
                                <input type="text" class="form-control" id="qty_asal_tfgdg" name="qty_asal_tfgdg" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jumlah_karton_tfgdg">Jumlah Karton</label>
                                <input type="text" class="form-control" id="jumlah_karton_tfgdg" name="jumlah_karton_tfgdg" required oninput="hitungQtyTf()">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="isi_karton_tfgdg">Isi Karton</label>
                                <input type="text" class="form-control" id="isi_karton_tfgdg" name="isi_karton_tfgdg" required oninput="hitungQtyTf()">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="qty_tfgdg">QTY Transfer</label>
                                <input type="text" class="form-control" id="qty_tfgdg" name="qty_tfgdg" readonly value="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Modal Transfer Antar Gudang -->

    <!-- Modal Return Ke Supplier -->
    <div class="modal fade" id="modalReturnKeSupplier" tabindex="-1" aria-labelledby="modalReturnKeSupplierLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalReturnKeSupplierLabel">Return Ke Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('return_supplier/tambahDataReturnSupplier'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tgl_returnsuppl">Tanggal</label>
                                <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tgl_returnsuppl" name="tgl_returnsuppl" required value="<?= date('Y-m-d'); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no_return_returnsuppl">No. Return</label>
                                <input type="text" class="form-control" id="no_return_returnsuppl" name="no_return_returnsuppl" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_returnsuppl">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan_returnsuppl" placeholder="" name="keterangan_returnsuppl" value="-">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kendaraan_returnsuppl">Jenis Kendaraan</label>
                            <input type="text" class="form-control" id="jenis_kendaraan_returnsuppl" placeholder="" name="jenis_kendaraan_returnsuppl">
                        </div>
                        <div class="form-group">
                            <label for="no_polisi_returnsuppl">No Polisi</label>
                            <input type="text" class="form-control" id="no_polisi_returnsuppl" placeholder="" name="no_polisi_returnsuppl">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_driver_returnsuppl">Nama Driver</label>
                                <input type="text" class="form-control" id="nama_driver_returnsuppl" name="nama_driver_returnsuppl" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_expedisi_returnsuppl">Nama Expedisi</label>
                                <input type="text" class="form-control" id="nama_expedisi_returnsuppl" name="nama_expedisi_returnsuppl" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kode_returnsuppl">Kode</label>
                                <input type="text" class="form-control" id="kode_returnsuppl" name="kode_returnsuppl" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="barang_returnsuppl">Nama Barang</label>
                                <input type="text" class="form-control" id="barang_returnsuppl" name="barang_returnsuppl" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gudang_asal_returnsuppl">Gudang Asal</label>
                                <input type="text" class="form-control" id="gudang_asal_returnsuppl" name="gudang_asal_returnsuppl" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="supplier_tujuan_returnsuppl">Supplier Tujuan</label>
                                <select class="form-control" id="supplier_tujuan_returnsuppl" name="supplier_tujuan_returnsuppl">
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="qty_asal_returnsuppl">Qty Asal</label>
                                <input type="text" class="form-control" id="qty_asal_returnsuppl" name="qty_asal_returnsuppl" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jumlah_karton_returnsuppl">Jumlah Karton</label>
                                <input type="text" class="form-control" id="jumlah_karton_returnsuppl" name="jumlah_karton_returnsuppl" oninput="hitungQtyReturn()" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="isi_karton_returnsuppl">Isi Karton</label>
                                <input type="text" class="form-control" id="isi_karton_returnsuppl" name="isi_karton_returnsuppl" oninput="hitungQtyReturn()" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="qty_returnsuppl">QTY Return</label>
                                <input type="text" class="form-control" id="qty_returnsuppl" name="qty_returnsuppl" readonly value="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Modal Return Ke Supplier -->


    <!-- ============ MODAL EDIT BARANG =============== -->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"></h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url() . 'barang/edit' ?>">
                    <div class="modal-body">
                        <section class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"></h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputkode_edit">Kode <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputkode_edit" name="kode" required>
                                                <input type="hidden" name="id" id="id_edit" maxlength="11" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputBarang_edit">Nama Barang <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputBarang_edit" name="nama" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputKategori_edit">Kategori <span class="text-danger">*</span></label>
                                                <select class="form-control" name="kategori" id="inputKategori_edit" required></select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="gudang_edit">Gudang <span class="text-danger">*</span></label>
                                                <select class="form-control" name="gudang" id="gudang_edit" required></select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputSebelumPajak_edit">Harga Sebelum Pajak</label>
                                                <input type="text" class="form-control" id="inputSebelumPajak_edit" name="sebelumpajak" oninput="hitungHargaPPN('_edit')" onchange="handlerFormat(event, '#inputSebelumPajak', '_edit')">
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputPpn_edit">PPN</label>
                                                <input type="text" class="form-control" id="inputPpn_edit" name="ppn" oninput="hitungHargaPPN('_edit')">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputSetelahPajak_edit">Harga Setelah Pajak</label>
                                                <input type="text" class="form-control" id="inputSetelahPajak_edit" name="setelahpajak" readonly>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputbagus_edit">Unit Bagus</label>
                                                <input type="text" class="form-control" id="inputbagus_edit" name="unitbagus">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputrusak_edit">Unit Rusak</label>
                                                <input type="text" class="form-control" id="inputrusak_edit" name="unitrusak">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputSetoran_edit">Harga Setoran</label>
                                                <input type="text" class="form-control" id="inputSetoran_edit" name="hargasetoran" onchange="handlerFormat(event, '#inputSetoran', '_edit')">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputStok_edit">Stok Awal</label>
                                                <input type="text" class="form-control" id="inputStok_edit" name="qty" onkeyup="hitungTotal(event, '_edit')">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="hpp_edit">HPP</label>
                                                <input type="text" class="form-control" id="hpp_edit" name="hpp" onchange="handlerFormat(event, '#hpp', '_edit')">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputTotal_edit">Total</label>
                                                <input type="text" class="form-control" id="inputTotal_edit" name="jumlah" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="id_coa_edit">Kode Akun</label>
                                                <select class="form-control" name="id_coa" id="id_coa_edit"></select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.box-body -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info">Edit</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- End of Container -->

<script src="<?php echo base_url() . 'js/jquery-1.11.2.min.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'bootstrap/js/bootstrap.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'datatables/jquery.dataTables.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'datatables/dataTables.bootstrap.js' ?>" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        fetch('<?= base_url('barang/getAkun'); ?>')
            .then(response => response.json())
            .then((result) => {
                $("#id_coa_create").empty()
                $("#id_coa_create").append('<option value="">--Pilih Akun--</option>')
                $.each(result, function(i, v) {
                    $("#id_coa_create").append(`<option value="${v.id}">K-${v.kode} - ${v.nama}</option>`)
                });
            });
    })

    const numberFormat = (number) => {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $(document).on("input", ".numeric", function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#lookup').dataTable();
    $('input[name=tgl_tfgdg]').datepicker('datepicker');
    $('input[name=tgl_returnsuppl]').datepicker('datepicker');
    $('.list-group').on('mouseover', function(e) {
        $(e.target).siblings().removeClass('list-group-item-secondary');
        $(e.target).addClass('list-group-item-secondary');
    });

    $('.list-group').on('mouseleave', function(e) {
        $(e.target).removeClass('list-group-item-secondary');
    });

    $('.pilih').on('click', function() {
        $('#filter-kode').val($(this).attr('data-kode'));
        $('#filter-nama').val($(this).attr('data-nama'));
        $('#myModal').modal('hide');
    });

    $(document).on('click', function(e) {
        if ($(e.target.parentElement).is('tr.t-row')) {
            $(e.target.parentElement).siblings().removeClass('active-row');
            $(e.target.parentElement).addClass('active-row');
        } else {
            $('tr.t-row').removeClass('active-row');
        }
    });

    function hitungQtyTf() {
        const jml_karton = Number($('input[name=jumlah_karton_tfgdg]').val());
        const isi_karton = Number($('input[name=isi_karton_tfgdg]').val());
        $('input[name=qty_tfgdg]').val(jml_karton * isi_karton);
    }

    function hitungQtyReturn() {
        const jml_karton = Number($('input[name=jumlah_karton_returnsuppl]').val());
        const isi_karton = Number($('input[name=isi_karton_returnsuppl]').val());
        $('input[name=qty_returnsuppl]').val(jml_karton * isi_karton);
    }

    document.getElementById('check').addEventListener('click', function(e) {
        fetch('<?= base_url('transfer_gudang/getLatestDate'); ?>')
            .then(response => response.json())
            .then((result) => {
                $('input[name=tgl_tfgdg]').val(result);
                $('input[name=tgl_returnsuppl]').val(result);
            });

        const el = e.target.parentElement;
        const kode = $(el).attr('data-kode');
        const barang = $(el).attr('data-barang');
        const gudang = $(el).attr('data-gudang');
        const qty = $(el).attr('data-qty');

        sessionStorage.setItem('kode', kode);
        sessionStorage.setItem('barang', barang);
        sessionStorage.setItem('gudang', gudang);
        sessionStorage.setItem('qty', qty);
    });

    function transferAntarGdg() {
        const d = new Date();

        fetch('<?= base_url('transfer_gudang/getLatestNoTf'); ?>')
            .then(response => response.json())
            .then((result) => {
                $('input[name=no_transfer_tfgdg]').val(result);
            });

        fetch('<?= base_url('barang/all_gudang'); ?>')
            .then(response => response.json())
            .then((result) => {
                let data = `<option value="">Pilih gudang</option>`;
                result.forEach(function(e) {
                    if (e.nama == sessionStorage.getItem('gudang')) {
                        data += '';
                    } else {
                        data += `<option value="${e.nama}">${e.nama}</option>`;
                    }
                });

                $('select[name=gudang_tujuan_tfgdg]').html(data);
            });

        $('input[name=kode_tfgdg]').val(sessionStorage.getItem('kode'));
        $('input[name=barang_tfgdg]').val(sessionStorage.getItem('barang'));
        $('input[name=gudang_asal_tfgdg]').val(sessionStorage.getItem('gudang'));
        $('input[name=qty_asal_tfgdg]').val(sessionStorage.getItem('qty'));
        $('#modalTransferAntarGdg').modal('show');
    }

    function returnKeSupplier() {
        const d = new Date();
        fetch('<?= base_url('return_supplier/getLatestNoReturn'); ?>')
            .then(response => response.json())
            .then((result) => {
                $('input[name=no_return_returnsuppl]').val(result);
            });

        fetch('<?= base_url('supplier/getAllSupplier'); ?>')
            .then(response => response.json())
            .then((result) => {
                let data = `<option value="">Pilih supplier</option>`;
                result.forEach(function(e) {
                    data += `<option value="${e.nama}">${e.nama}</option>`;
                });

                $('select[name=supplier_tujuan_returnsuppl]').html(data);
            });

        $('input[name=kode_returnsuppl]').val(sessionStorage.getItem('kode'));
        $('input[name=barang_returnsuppl]').val(sessionStorage.getItem('barang'));
        $('input[name=gudang_asal_returnsuppl]').val(sessionStorage.getItem('gudang'));
        $('input[name=qty_asal_returnsuppl]').val(sessionStorage.getItem('qty'));
        $('#modalReturnKeSupplier').modal('show');
    }

    function getBarang(id) {
        fetch('<?= base_url('barang/getBarang/'); ?>' + id)
            .then(response => response.json())
            .then((result) => {
                document.getElementById('inputKode').value = result.kode;
                document.getElementById('inputBarang').value = result.nama;
                document.getElementById('inputKategori').value = result.nama_ktg;
                document.getElementById('inputSebelumPajak').value = numberFormat(result.sebelumpajak);
                document.getElementById('inputPpn').value = result.ppn;
                document.getElementById('inputSetelahPajak').value = numberFormat(result.setelahpajak);
                document.getElementById('inputSetoran').value = numberFormat(result.hargasetoran);
                document.getElementById('hpp').value = numberFormat(result.hpp);

                let stok = document.getElementById('inputStok');

                let valStok = stok.value == "" ? 0 : parseFloat(stok.value.replace(/,/g, ''))

                let totFinal = valStok * parseFloat(result.setelahpajak);

                document.getElementById('inputTotal').value = totFinal == 0 ? "" : numberFormat(totFinal);

                document.getElementById('tabelKode').style.display = 'none';
                // console.log(result);
            });
    }

    document.getElementById('inputKode').addEventListener('input', function() {
        if (this.value != "") {
            fetch('<?= base_url('barang/searchBarang/'); ?>' + this.value)
                .then(response => response.json())
                .then((results) => {
                    if (!results[0]) {
                        document.getElementById('tabelKode').style.display = 'none';
                    } else {
                        let data = "";
                        // console.log(results);
                        results.forEach(function(e) {
                            data += `
                            <tr onclick="getBarang(${e.id})" style="cursor:pointer">
                            <td>${e.kode}</td>
                            <td>${e.nama}</td>
                            <td>${e.gudang}</td>
                            </tr>
                            `;
                        })

                        document.getElementById('show_data_kode').innerHTML = data;
                        // console.log(data);
                        document.getElementById('tabelKode').style.display = 'block';
                    }
                });
        } else {
            document.getElementById('tabelKode').style.display = 'none';
        }
    });

    function hitungHargaPPN(type = null) {
        let inputPpn = (type == null) ? document.getElementById('inputPpn') : document.getElementById('inputPpn' + type);
        let inputSebelumPajak = (type == null) ? document.getElementById('inputSebelumPajak') : document.getElementById('inputSebelumPajak' + type);
        let inputSetelahPajak = (type == null) ? document.getElementById('inputSetelahPajak') : document.getElementById('inputSetelahPajak' + type);
        let stok = (type == null) ? document.getElementById('inputStok') : document.getElementById('inputStok' + type);
        let total = (type == null) ? document.getElementById('inputTotal') : document.getElementById('inputTotal' + type);

        let valInputPpn = inputPpn.value == "" ? 0 : parseFloat(inputPpn.value.replace(/,/g, ''));
        let valInputSebelumPajak = inputSebelumPajak.value == "" ? 0 : parseFloat(inputSebelumPajak.value.replace(/,/g, ''))

        let totSetelahPajak = valInputSebelumPajak + valInputSebelumPajak * (valInputPpn / 100)

        inputSetelahPajak.value = totSetelahPajak == 0 ? "" : numberFormat(totSetelahPajak);

        let valStok = stok.value == "" ? 0 : parseFloat(stok.value.replace(/,/g, ''))
        let totFinal = valStok * totSetelahPajak == "" ? 0 : totSetelahPajak;

        total.value = totFinal == 0 ? "" : numberFormat(totFinal)
    }

    const hitungTotal = (event, type = null) => {
        let stok = event.currentTarget.value == "" ? 0 : parseFloat(event.currentTarget.value)
        let inputSetelahPajak = (type == null) ? document.getElementById('inputSetelahPajak') : document.getElementById('inputSetelahPajak' + type)
        let valInputSetelahPajak = inputSetelahPajak.value == "" ? 0 : parseFloat(inputSetelahPajak.value.replace(/,/g, ''));

        let total = (type == null) ? document.getElementById('inputTotal') : document.getElementById('inputTotal' + type)
        let totFinal = stok * valInputSetelahPajak;

        total.value = totFinal == 0 ? "" : numberFormat(totFinal)
    }

    const handlerFormat = (event, target, type = null) => {
        let a = event.currentTarget.value == "" ? "" : numberFormat(event.currentTarget.value)
        type == null ? $(`${target}`).val(a) : $(`${target}${type}`).val(a)
    }

    // jika dipilih, nim akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih', function(e) {
        document.getElementById("nama").value = $(this).attr('data-nama');
        $('#myModal').modal('hide');
        document.getElementById("kode").value = $(this).attr('data-kode');
        $('#myModal').modal('hide');
    });

    function dummy() {
        var nama = document.getElementById("nama").value;
        alert('Nama ' + nim + ' berhasil tersimpan');

        var kode = document.getElementById("kode").value;
        alert('Kode ' + ket + ' berhasil tersimpan');
    }

    function handleEditData(id) {
        fetch('<?= base_url('barang/getDataBarangById/'); ?>' + id)
            .then(response => response.json())
            .then((result) => {
                $("#modal_edit").modal('show');

                const produk = result.dataBarang;

                $("#id_edit").val(id);
                $("#inputkode_edit").val(produk.kode);
                $("#inputBarang_edit").val(produk.nama);
                $("#inputSebelumPajak_edit").val(numberFormat(produk.sebelumpajak));
                $("#inputPpn_edit").val(produk.ppn);
                $("#inputSetelahPajak_edit").val(numberFormat(produk.setelahpajak));
                $("#inputbagus_edit").val(produk.unitbagus);
                $("#inputrusak_edit").val(produk.unitrusak);
                $("#inputSetoran_edit").val(numberFormat(produk.hargasetoran));
                $("#inputStok_edit").val(produk.qty);
                $("#hpp_edit").val(numberFormat(produk.hpp));
                $("#inputTotal_edit").val(numberFormat(produk.jumlah));

                $("#inputKategori_edit").empty();
                $("#inputKategori_edit").append("<option value=''>--Pilih Kategori--</option>")
                $.each(result.dataCategory, function(i, v) {
                    if (v.kode == produk.kategori) {
                        $("#inputKategori_edit").append(`<option value="${v.kode}" selected>${v.name}</option>`)
                    } else {
                        $("#inputKategori_edit").append(`<option value="${v.kode}">${v.name}</option>`)
                    }
                });

                $("#gudang_edit").empty();
                $("#gudang_edit").append("<option value=''>--Pilih Gudang--</option>")
                $.each(result.dataGudang, function(i, v) {
                    if (v.gudang == produk.gudang) {
                        $("#gudang_edit").append(`<option value="${v.gudang}" selected>${v.gudang}</option>`)
                    } else {
                        $("#gudang_edit").append(`<option value="${v.gudang}">${v.gudang}</option>`)
                    }
                });

                $("#id_coa_edit").empty();
                $("#id_coa_edit").append("<option value=''>--Pilih Gudang--</option>")
                $.each(result.dataListAkun, function(i, v) {
                    if (v.id == produk.id_coa) {
                        $("#id_coa_edit").append(`<option value="${v.id}" selected>K-${v.kode} - ${v.nama}</option>`)
                    } else {
                        $("#id_coa_edit").append(`<option value="${v.id}">K-${v.kode} - ${v.nama}</option>`)
                    }
                });
            });
    }
</script>