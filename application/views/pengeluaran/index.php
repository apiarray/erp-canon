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

<form action="<?= base_url('');?>" method="post">
    <div class="row">
        <div class="col-lg-4">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="weekending" class="input-group-text">Tanggal Awal:</label>
                </div>
                <input type="date" name="name" id="name" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <label for="namawin2mgr" class="input-group-text">Taggal Akhir :</label>
                </div>
                <input type="date" name="jenis_kendaraan" id="jenis_kendaraan" class="form-control form-control-sm">
                <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
            </div>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </div>
    </div>
</form>
<hr>
<?php if($this->session->flashdata('flash2')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Pengeluaran <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>

<?php if($this->session->flashdata('flash')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">Data Pengeluaran <strong>berhasil </strong><?= $this->session->flashdata('flash');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>
<a href="<?= base_url('pengeluaran/tambah');?>" class="btn btn-info mb-2">Tambah Data</a>
<div class="table-responsive">
<!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
<table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

        <thead>
            <tr style="text-align:center;">
                <th style="text-align:center;">No.</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Bukti Transaksi</th>
                <th>Rekeneing</th>
                <th>Jumlah Total</th>
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;?>
            <?php $total=0;?>
            <?php foreach ($pengeluaran as $pen): 
                $total += floatval($pen['total_pengeluaran']);
                ?>
            <tr>
                <td style="text-align:center;">
                    <?php echo $i;?>
                </td>
                <td style="text-align:center;">
                    <?php echo $pen['tgl'] ?>
                </td>
                <td>
                    <?php echo $pen['uraian'] ?>
                </td>
                <td style="text-align:center;">
                    <?php echo $pen['reff'] ?>
                </td>
                <td style="text-align:center;">
                    <?php echo $pen['rekening'] ?>
                </td>
                <td style="text-align:center;">
                    <?php echo $pen['total_pengeluaran'] ?>
                </td>
                <td style="text-align:center;">
                
                <div class="btn-group" >
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu">
                    <a href="<?php echo base_url();?>pengeluaran/edit/<?= $pen['id'];?>" class="btn btn-success" style="margin-left:42px"><i class="fa fa-edit"></i>Edit</i></a>
                    <a href="<?= base_url();?>pengeluaran/hapus/<?= $pen['id'];?>" class="btn btn-danger mt-2" style="margin-left:35px" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
                    </div>
                </div>
                </td>
            </tr>
            <?php $i++;?>
            <?php endforeach; ?>
            <tr>
                <td  colspan="4"></td>
                <td>
                    <h5><b>Total</b></h5>
                </td>
                <td colspan="1">
                    <h5><b><?= $total ?><b></h5>
                </td>
            </tr>

        </tbody>
    </table>
    </div>
</div>