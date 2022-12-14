<div class="container">
        <div class="col-md-6">
            <h2 class="">Form Tambah Data</h2>
            <form action="" class="form-horizontal" method="POST">
            <input type="hidden" name="id" value="<?= $chartofaccount['id'];?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputKode">Kode</label>
                <input type="text" class="form-control" id="inputKode" name="kode_id"  placeholder="Masukkan Kode" value="<?= $chartofaccount['kode_id'];?>">
                </div>
                <div class="form-group col-md-6">
                <label for="inputBarang">Nama Akun</label>
                <input type="text" class="form-control" id="inputBarang" name="nama"  placeholder="Masukkan Nama Akun" value="<?= $chartofaccount['nama'];?>">
                </div>
            </div>

                <div class="form-group">
                    <label for="">Jenis</label>
                    <input type="text" name="jenis" placeholder="Masukkan Jenis Akun" class="form-control" value="<?= $chartofaccount['jenis'];?>">
                    <small><span class="text-danger"><?=form_error('jenis');?></span></small>
                    Silahkan pilih salah satu<br>
                    <input type="radio" name="" id="" value="Nominal">Nominal
                    <input type="radio" name="" id="" value="Riel">Riel
                </div>

                <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="text" name="nominal" placeholder="Masukkan Nominal" class="form-control" value="<?= $chartofaccount['nominal'];?>">
                    <small><span class="text-danger"><?=form_error('nominal');?></span></small>
                    Silahkan pilih salah satu<br>
                    <input type="radio" name="" id="" value="Debit">Debit
                    <input type="radio" name="" id="" value="Kredit">Kredit
                </div>

                <div class="form-group">
                    <label for="">Saldo Awal Akun</label>
                    <input type="text" name="saldo" placeholder="Masukkan Saldo Awal Akun" class="form-control" value="<?= $chartofaccount['saldo'];?>">
                    <small><span class="text-danger"><?=form_error('saldo');?></span></small>
                </div>

                <div class="form-group">
                    <label for="">Saldo Awal Override</label>
                    <input type="text" name="debit" placeholder="Masukkan Saldo Awal Override" class="form-control" value="<?= $chartofaccount['debit'];?>">
                    <small><span class="text-danger"><?=form_error('debit');?></span></small>
                </div>
            
                <button type="submit" class="btn btn-primary mb-2">Tambah Data</button>
                <a href="<?=base_url('account');?>" class="btn btn-success mb-2">Kembali</a>
            </form>
        </div>
    </div>