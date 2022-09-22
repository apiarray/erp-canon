
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php if($this->session->flashdata('flash_error')) :?>
            <div class="row mt-3">
                <div class="col md-6">
                    <div class="alert alert-danger fade show" role="alert">
                        <?= $this->session->flashdata('flash_error'); ?>
                    </div>
                </div>    
            </div>
            <?php endif;?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form action="<?= base_url('transfer_gudang/tambah'); ?>" method="POST"> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNama">Tanggal</label>
                        <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="inputNama" name="tgl_tfgdg" required autocomplete="off" value="<?= date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputManager">No. Transfer</label>
                        <input type="text" class="form-control" id="inputManager" name="no_transfer_tfgdg" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPoin">Keterangan</label>
                        <input type="text" class="form-control" id="inputPoin" name="keterangan_tfgdg" required value="-">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputTeam">Kode</label>
                        <input type="text" class="form-control" id="inputTeam" name="kode_tfgdg" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPeringkat">Barang</label>
                        <input type="text" class="form-control" id="inputPeringkat" name="barang_tfgdg" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPeringkat2">Gudang Asal</label>
                        <input type="text" class="form-control" id="inputPeringkat2" name="gudang_asal_tfgdg" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputLeader">Gudang Tujuan</label>
                        <select class="form-control" id="inputLeader" name="gudang_tujuan_tfgdg" required>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputDistri">Qty</label>
                        <input type="text" class="form-control" id="inputDistri" name="qty_tfgdg" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
                <a href="<?= base_url('transfer_gudang');?>" class="btn btn-success">Kembali</a>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalKode" tabindex="-1" aria-labelledby="modalKodeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKodeLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover" cellspacing="2">
                    <thead>
                        <tr>
                           <th>Kode Barang</th>
                           <th>Nama Barang</th>
                           <th>Gudang</th>
                       </tr>
                   </thead>
                   <tbody>
                        <?php
                        if ($databrg != null):         
                        foreach($databrg->result_array() as $i):
                        $id=$i['id'];
                        $kode=$i['kode'];
                        $nama=$i['nama'];
                        $gudang=$i['gudang'];
                        ?>
                        <tr class="pilih" data-nama="<?php echo $nama; ?>" data-kode="<?php echo $kode; ?>" data-gudang="<?php echo $gudang; ?>" style="cursor: pointer;">
                            <td>
                                <?php echo $kode ?>
                            </td>
                            <td width="">
                                <?php echo $nama ?>
                            </td>
                            <td>
                                <?php echo $gudang ?>
                            </td>
                        </tr>
                        <?php endforeach; endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap.js'?>"></script>

<script>
    $('input[name=tgl_tfgdg]').datepicker('datepicker');
    $('input[name=kode_tfgdg]').on('click', function() {
        $('#modalKode').modal('show');
    });

    $('.pilih').on('click', function() {
        $('input[name=kode_tfgdg]').val($(this).attr('data-kode'));
        $('input[name=barang_tfgdg]').val($(this).attr('data-nama'));
        $('input[name=gudang_asal_tfgdg]').val($(this).attr('data-gudang'));
        $('#modalKode').modal('hide');
    });

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
</script>