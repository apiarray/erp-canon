<div class="container">
    <div class="row-fluid">
        <h5>Tambah Form Data</h5>

        <form action="<?= base_url('team2/tambah');?>" method="POST"> 
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="kode">ID</label>
                    <input type="text" class="form-control" id="kode" name="kode" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputNama">Nama</label>
                    <input type="text" class="form-control" id="inputNama" name="nama" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputNama">User</label>
                    <!-- <input type="text" class="form-control" name="user_mitra" required> -->
                    <select class="form-control select2" name="user_mitra" id="mitra">
                        <?php foreach($listMitra as $a){ ?>
                            <option value="<?= $a['kode'] ?>"><?= $a['kode'] . '- ' . $a['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputNama">Kode dan Nama Mitra</label>
                    <input type="text" class="form-control" name="nama_mitra" readonly>
                    <input type="hidden" class="form-control" name="kode_mitra">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="inputTgl">Tgl Lahir</label>
                <input type="date" class="form-control" id="inputTgl" name="tgl_lahir" required>
                </div>
                <div class="form-group col-md-4">
                 <label for="jabatan">Jabatan</label>
                 <select class="form-control select2" name="jabatan" id="jabatan">
                 <option value="">-- Pilih --</option>
                 <?php foreach ($jabatanList as $jbt) :?>
                    <option value="<?=$jbt['kode'];?>"><?= $jbt['name'];?></option>
                <?php endforeach;?>
                </select>
             </div>
                <!-- <div class="form-group col-md-4">
                <label for="inputJabatan">Jabatan</label>
                <input type="text" class="form-control" id="inputJabatan" name="jabatan" required>
                </div> -->
                <div class="form-group col-md-4">
                <label for="inputTahun">Thn Gabung</label>
                <input type="text" class="form-control" id="inputTahun" name="thn_gabung" required>
                </div>
            </div>
                <div class="form-group">
                <label for="inputAlamat">Alamat</label>
                <input type="text" class="form-control" id="inputAlamat" name="alamat" required>
                </div>
     
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputKota">Kota</label>
                <input type="text" class="form-control" id="inputKota" name="kota" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputTelepon">No Telp</label>
                <input type="text" class="form-control" id="inputTelepon" name="no_telp" required>
                </div>
            </div>
        
                <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="text" class="form-control" id="inputEmail" name="email" required>
                </div>
               

            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="<?= base_url('team2');?>" class="btn btn-success">Kembali</a>
            </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.select2').select2();
    $('#mitra').select2().on('change', function(){
        var text = $(this).find("option:selected").text();
        var value = $(this).val();
        console.log(value + "; " + text)
        // Set selected 
        $('input[name=nama_mitra').val(text);
        $('input[name=kode_mitra').val(value);
    });
});
</script>