<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$judul; ?></h6>
        </div>
        <div class="card-body">
        <div class="table-responsive table table-hover">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>ID Mitra</th>
                        <th>Nama Mitra</th>
                        <th>Jabatan</th>
                        <th>(Rp) Saldo Awal Override</th>
                        <th>(Rp) Saldo Awal HO</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($mitraList):
                        $no=1;
                        foreach($mitraList as $mitra) {
                        ?>
                        <tr>
                            <td><?=$no;?>.</td>
                            <td><?=$mitra['kode'];?></td>
                            <td><?=$mitra['name'];?></td>
                            <td><?=$mitra['jabatan'];?></td>
                            <td><?=($mitra['saldo_override']) ? number_format($mitra['saldo_override']) : 0;?></td>
                            <td><?=($mitra['saldo_ho']) ? number_format($mitra['saldo_ho']) : 0;?></td>
                            <td>
                                <a href="<?=base_url();?>override/saldoupdate/<?=$mitra['id'];?>" class="btn btn-success" style="margin-left:42px"><i class="fa fa-edit"></i>Edit</i></a>
                            </td>
                        </tr>
                        <?php
                            $no++;
                        }
                    endif; ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>

</section> 
</div>