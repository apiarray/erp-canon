<div class="content-wrapper col-12">
  <section class="content-header ml mt-2 auto">




    </ol>
    <div style="margin-left:5px">

      <div class="">
        <?php if ($this->session->flashdata('flash2')) : ?>
          <div class="row mt-3">
            <div class="col md-6">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Top Asmen <strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('flash')) : ?>
          <div class="row mt-3">
            <div class="col md-6">
              <div class="alert alert-success alert-dismissible fade show" role="alert">Data Top Asmen <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>
                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="row mt-3">
          <div class="col-lg-6">
            <form action="" method="post">
              <div class="form-group input-group input-group-sm">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="weekending">Weekending</label>
                </div>
                <select class="form-control" id="weekending" onchange="getData(this.value)">
                  <option value="">Pilih tanggal</option>
                  <option value="up">Weekending Up</option>
                  <?php foreach ($tgl as $weekending) : ?>
                    <option value="<?= $weekending['tgl']; ?>"><?= $weekending['tgl']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </form>
          </div>
          <div class="col-lg-6">

          </div>
        </div>
        <button class="btn btn-info mb-2" data-toggle="modal" data-target="#modalTambah">Tambah Data</button>
        <a href="<?= base_url('top_asmen/excell'); ?>" class="btn btn-success mb-2">Export Excell</a>

        <div class="table-responsive">
          <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
          <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

            <thead>
              <tr style="text-align:center">
                <th>No.</th>
                <th>Nama</th>
                <th>Manager</th>
                <th>Poin sendiri</th>
                <th>Poin team</th>
                <th>Peringkat Langsung</th>
                <th>Peringkat Tidak Langsung</th>
                <th>Jumlah Leader</th>
                <th>Jumlah Distributor</th>
                <th>Jumlah Retrain</th>
                <th>Jumlah Observasi</th>
                <th>Jumlah Team</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="show_data">
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal Tambah -->
      <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahLabel">Form Tambah Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputNama">Nama Mitra</label>
                  <input type="text" class="form-control" id="inputNama" name="nama" value="<?= $this->session->userdata('username') ?>" required readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputManager">Manager</label>
                  <select name="manager" id="inputManager" class="form-control">
                    <option value="">--Pilih Manager--</option>
                    <?php foreach ($manager as $value) { ?>
                      <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="inputPoint">Poin Sendiri</label>
                  <input type="text" class="form-control numeric" id="inputPoint" name="poin_sendiri" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="inputPointTeam">Poin Team</label>
                  <input type="text" class="form-control numeric" id="inputPointTeam" name="poin_team" required>
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="inputPeringkat">Peringkat Langsung</label>
                  <input type="text" class="form-control numeric" id="inputPeringkat" name="peringkat_langsung" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="inputPeringkat2">Peringkat Tidak Langsung</label>
                  <input type="text" class="form-control numeric" id="inputPeringkat2" name="peringkat_tidaklangsung" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputLeader">Jumlah Leader</label>
                  <input type="text" class="form-control numeric" id="inputLeader" name="jumlah_leader" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="inputTeam">Jumlah Team</label>
                  <input type="text" class="form-control numeric" id="inputTeam" name="jumlah_team" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputDistri">Jumlah Distributor</label>
                  <input type="text" class="form-control numeric" id="inputDistri" name="jumlah_distributor" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputRetrain">Jumlah Retrain</label>
                  <input type="text" class="form-control numeric" id="inputRetrain" name="jumlah_retrain" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputObservasi">Jumlah Observasi</label>
                  <input type="text" class="form-control numeric" id="inputObservasi" name="jumlah_observasi" required>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              <button type="button" class="btn btn-primary" onclick="handleSaveData()">Tambah Data</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Edit -->
      <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditLabel">Form Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputNamaEdit">Nama Mitra</label>
                  <input type="hidden" name="id" id="id">
                  <input type="text" class="form-control" id="inputNamaEdit" name="nama" required readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputManagerEdit">Manager</label>
                  <select name="manager" id="inputManagerEdit" class="form-control">
                    <option value="">--Pilih Manager--</option>
                    <?php foreach ($manager as $value) { ?>
                      <option value="<?= $value->name ?>"><?= $value->name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="inputPointEdit">Poin Sendiri</label>
                  <input type="text" class="form-control numeric" id="inputPointEdit" name="poin_sendiri" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="inputPointTeamEdit">Poin Team</label>
                  <input type="text" class="form-control numeric" id="inputPointTeamEdit" name="poin_team" required>
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="inputPeringkatEdit">Peringkat Langsung</label>
                  <input type="text" class="form-control numeric" id="inputPeringkatEdit" name="peringkat_langsung" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="inputPeringkat2Edit">Peringkat Tidak Langsung</label>
                  <input type="text" class="form-control numeric" id="inputPeringkat2Edit" name="peringkat_tidaklangsung" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputLeaderEdit">Jumlah Leader</label>
                  <input type="text" class="form-control numeric" id="inputLeaderEdit" name="jumlah_leader" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="inputTeamEdit">Jumlah Team</label>
                  <input type="text" class="form-control numeric" id="inputTeamEdit" name="jumlah_team" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputDistriEdit">Jumlah Distributor</label>
                  <input type="text" class="form-control numeric" id="inputDistriEdit" name="jumlah_distributor" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputRetrainEdit">Jumlah Retrain</label>
                  <input type="text" class="form-control numeric" id="inputRetrainEdit" name="jumlah_retrain" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputObservasiEdit">Jumlah Observasi</label>
                  <input type="text" class="form-control numeric" id="inputObservasiEdit" name="jumlah_observasi" required>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              <button type="button" class="btn btn-primary" onclick="handleEditData()">Edit Data</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  $(document).on("input", ".numeric", function(event) {
    this.value = this.value.replace(/[^0-9]/g, '');
  });

  $('#mytable').DataTable({
    bInfo: false
  });
  getData('');

  function getData(weekending) {

    $.ajax({
      url: "<?= base_url(); ?>top_asmen2/getData/" + weekending,
      success: function(result) {
        let results = JSON.parse(result);
        let data = "";

        if (!results[0]) {
          data += `<tr><td colspan="13" class="text-center">Tidak ada data ditampilkan. Silahkan pilih tanggal weekending untuk menampilkan data.</td></tr>`;
        } else {
          for (let i = 0; i < results.length; i++) {
            data += `
            <tr>
            <td style="text-align:center">
            ${i+1}
            </td>
            <td width="">
            ${results[i].nama}
            </td>
            <td width="">
            ${results[i].manager}
            </td>
            <td>
            ${results[i].poin_sendiri}
            </td>
            <td>
            ${results[i].poin_tim}
            </td>
            <td>
            ${results[i].peringkat_langsung}
            </td>
            <td class="">
            ${results[i].peringkat_tidaklangsung}                    
            </td>
            <td class="">
            ${results[i].jumlah_leader}                    
            </td>
            <td class="">
            ${results[i].jumlah_distributor}                    
            </td>
            <td class="">
            ${results[i].jumlah_retrain}                    
            </td>
            <td class="">
            ${results[i].jumlah_observasi}                    
            </td>
            <td class="">
            ${results[i].jumlah_team}                    
            </td>
            <td>

            <div class="btn-group" >
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action
            </button>
            <div class="dropdown-menu">
            <a onclick="getDataById(${results[i].id})" class="btn btn-success text-white" style="margin-left:42px"><i class="fa fa-edit"></i>Edit</i></a>
            <a href="<?= base_url(); ?>top_asmen2/hapus/${results[i].id}" class="btn btn-danger mt-2" style="margin-left:35px" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
            </div>
            </div>
            </td>
            </tr>
            `;
          }
        }

        $('#show_data').html(data);
      }
    });
  }

  const handleSaveData = () => {
    let mitra = $("#inputNama").val();
    let manager = $("#inputManager").val();
    let pointSendiri = $("#inputPoint").val();
    let pointTeam = $("#inputPointTeam").val();
    let peringkatLangsung = $("#inputPeringkat").val();
    let peringkatTidakLangsung = $("#inputPeringkat2").val();
    let leader = $("#inputLeader").val();
    let team = $("#inputTeam").val();
    let distributor = $("#inputDistri").val();
    let retrain = $("#inputRetrain").val();
    let observasi = $("#inputObservasi").val();

    if (mitra == "") {
      alert('Nama Mitra tidak boleh kosong');
      return false;
    } else if (manager == "") {
      alert('Manager tidak boleh kosong');
      return false;
    } else if (pointSendiri == "") {
      alert('Point Sendiri tidak boleh kosong');
      return false;
    } else if (pointTeam == "") {
      alert('Point Team tidak boleh kosong');
      return false;
    } else if (peringkatLangsung == "") {
      alert('Peringkat Langsung tidak boleh kosong');
      return false;
    } else if (peringkatTidakLangsung == "") {
      alert('Peringkat Tidak Langsung tidak boleh kosong');
      return false;
    } else if (leader == "") {
      alert('Leader tidak boleh kosong');
      return false;
    } else if (team == "") {
      alert('Team tidak boleh kosong');
      return false;
    } else if (distributor == "") {
      alert('Distributor tidak boleh kosong');
      return false;
    } else if (retrain == "") {
      alert('Retrain tidak boleh kosong');
      return false;
    } else if (observasi == "") {
      alert('Observasi tidak boleh kosong');
      return false;
    } else {
      $.ajax({
        type: "POST",
        url: "<?= base_url("Top_asmen2/tambah") ?>",
        data: {
          mitra,
          manager,
          pointSendiri,
          pointTeam,
          peringkatLangsung,
          peringkatTidakLangsung,
          leader,
          team,
          distributor,
          retrain,
          observasi
        },
        dataType: "JSON",
        success: function(result) {
          if (result == true) {
            location.href = "<?= base_url("Top_asmen2") ?>"
          }
        }
      });
    }
  }

  function getDataById(id) {
    $.ajax({
      url: "<?= base_url('top_asmen2/getDataById/'); ?>" + id,
      success: function(result) {
        let results = JSON.parse(result);

        $('#id').val(results.id);
        $('#inputNamaEdit').val(results.nama);
        $('#inputManagerEdit').val(results.manager).trigger('change');
        $('#inputPointEdit').val(results.poin_sendiri);
        $('#inputPointTeamEdit').val(results.poin_tim);
        $('#inputPeringkatEdit').val(results.peringkat_langsung);
        $('#inputPeringkat2Edit').val(results.peringkat_tidaklangsung);
        $('#inputLeaderEdit').val(results.jumlah_leader);
        $('#inputDistriEdit').val(results.jumlah_distributor);
        $('#inputRetrainEdit').val(results.jumlah_retrain);
        $('#inputObservasiEdit').val(results.jumlah_observasi);
        $('#inputTeamEdit').val(results.jumlah_team);

        $('#modalEdit').modal('show');
      }
    });
  }

  const handleEditData = () => {
    let id = $("#id").val();
    let mitra = $("#inputNamaEdit").val();
    let manager = $("#inputManagerEdit").val();
    let pointSendiri = $("#inputPointEdit").val();
    let pointTeam = $("#inputPointTeamEdit").val();
    let peringkatLangsung = $("#inputPeringkatEdit").val();
    let peringkatTidakLangsung = $("#inputPeringkat2Edit").val();
    let leader = $("#inputLeaderEdit").val();
    let team = $("#inputTeamEdit").val();
    let distributor = $("#inputDistriEdit").val();
    let retrain = $("#inputRetrainEdit").val();
    let observasi = $("#inputObservasiEdit").val();

    if (mitra == "") {
      alert('Nama Mitra tidak boleh kosong');
      return false;
    } else if (manager == "") {
      alert('Manager tidak boleh kosong');
      return false;
    } else if (pointSendiri == "") {
      alert('Point Sendiri tidak boleh kosong');
      return false;
    } else if (pointTeam == "") {
      alert('Point Team tidak boleh kosong');
      return false;
    } else if (peringkatLangsung == "") {
      alert('Peringkat Langsung tidak boleh kosong');
      return false;
    } else if (peringkatTidakLangsung == "") {
      alert('Peringkat Tidak Langsung tidak boleh kosong');
      return false;
    } else if (leader == "") {
      alert('Leader tidak boleh kosong');
      return false;
    } else if (team == "") {
      alert('Team tidak boleh kosong');
      return false;
    } else if (distributor == "") {
      alert('Distributor tidak boleh kosong');
      return false;
    } else if (retrain == "") {
      alert('Retrain tidak boleh kosong');
      return false;
    } else if (observasi == "") {
      alert('Observasi tidak boleh kosong');
      return false;
    } else {
      $.ajax({
        type: "POST",
        url: "<?= base_url("Top_asmen2/edit") ?>",
        data: {
          id,
          mitra,
          manager,
          pointSendiri,
          pointTeam,
          peringkatLangsung,
          peringkatTidakLangsung,
          leader,
          team,
          distributor,
          retrain,
          observasi
        },
        dataType: "JSON",
        success: function(result) {
          if (result == true) {
            location.href = "<?= base_url("Top_asmen2") ?>"
          }
        }
      });
    }
  }
</script>