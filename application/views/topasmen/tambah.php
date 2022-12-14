<div class="container">
    <div class="col-md-6">
        <h5>Tambah Form Data</h5>

        <form action="" method="POST"> 
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputNama">Nama</label>
                <input type="text" class="form-control" id="inputNama" name="nama" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputManager">Manager</label>
                <input type="text" class="form-control" id="inputManager" name="manager" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputPoin">Poin Sendiri</label>
                <input type="text" class="form-control" id="inputPoin" name="poin_sendiri" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputTeam">Poin Team</label>
                <input type="text" class="form-control" id="inputTeam" name="poin_tim" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputPeringkat">Peringkat Langsung</label>
                <input type="text" class="form-control" id="inputPeringkat" name="peringkat_langsung" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputPeringkat2">Peringkat Tidak Langsung</label>
                <input type="text" class="form-control" id="inputPeringkat2" name="peringkat_tidaklangsung" required>
                </div>
            </div>
                 
               
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputLeader">Jumlah Leader</label>
                <input type="text" class="form-control" id="inputLeader" name="jumlah_leader" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputDistri">Jumlah Distributor</label>
                <input type="text" class="form-control" id="inputDistri" name="jumlah_distributor" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputRetrain">Jumlah Retrain</label>
                <input type="text" class="form-control" id="inputRetrain" name="jumlah_retrain" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputObservasi">Jumlah Observasi</label>
                <input type="text" class="form-control" id="inputObservasi" name="jumlah_observasi" required>
                </div>
            </div>
                <div class="form-group">
                    <label for="inputTeam">Jumlah Team</label>
                    <input type="text" name="jumlah_team" placeholder="Masukkan jumlah team" class="form-control" id="inputTeam">
                    <small><span class="text-danger"><?=form_error('jumlah_team');?></span></small>
                </div>
                

            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="<?= base_url('top_lead');?>" class="btn btn-success">Kembali</a>
            </form>
    </div>
</div>