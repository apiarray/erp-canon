<div class="content-wrapper col-12">
    <section class="content-header ml mt-2 auto">

        <!-- <ol class=""> -->
        <!-- <h2>
    Menu Data Produk
    <div class="row mt-3">
    <div class="col-md-6">
        <form action="" method="post">
            <div class="input-group">
            <input type="text" name="keyword" id="" placeholder="Cari Data Produk..." class="form-control" autocomplete="off">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            </div>
        </form>
    </div>
</div>
</h2> -->



        </ol>
        <div style="margin-left:5px">

            <div class="">
                <?php if ($this->session->flashdata('flash2')) : ?>
                    <div class="row mt-3">
                        <div class="col md-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Setup Jurnal <strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
                                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="row mt-3">
                        <div class="col md-6">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">Data Setup Jurnal <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>
                                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <a href="<?= base_url('setup_jurnal/tambah'); ?>" class="btn btn-info mb-2">Tambah Data</a>
                <div class="table-responsive">
                    <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
                    <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

                        <thead>
                            <tr style="text-align:center">
                                <th>No.</th>
                                <th>Kode Jurnal</th>
                                <th>Formulir</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($setup_jurnal as $erp) : ?>
                                <tr>
                                    <td style="text-align:center">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $erp['kode_jurnal']; ?>
                                    </td>
                                    <td width="">
                                        <?php echo ucfirst(str_replace('_', ' ', $erp['formulir'])); ?>
                                    </td>
                                    <td width="">
                                        <?php echo $erp['keterangan'] ?>
                                    </td>

                                    <td style="text-align:center">

                                        <!-- <div class="btn-group" > -->
                                        <!-- <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu"> -->
                                        <a href="<?php echo base_url(); ?>setup_jurnal/edit/<?= $erp['id']; ?>" class="btn btn-success" style=""><i class="fa fa-edit"></i>Edit</i></a>
                                        <a href="<?= base_url(); ?>setup_jurnal/hapus/<?= $erp['id']; ?>" class="btn btn-danger " style="" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
                                        <!-- </div> -->
                                        <!-- </div> -->
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>