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
<?php if($this->session->flashdata('flash2')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Juice_4u <strong>berhasil </strong><?= $this->session->flashdata('flash2');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>

<?php if($this->session->flashdata('flash')) :?>
<div class="row mt-3">
    <div class="col md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">Data Juice_4u <strong>berhasil </strong><?= $this->session->flashdata('flash');?>
        <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>    
</div>
<?php endif;?>
<div class="row">
  <div class="col-lg-4">
    <form action="" method="post">
        <div class="form-group input-group input-group-sm">
            <div class="input-group-prepend">
                <label class="input-group-text" for="tahun">Tahun</label>
            </div>
            <select class="form-control" id="tahun">
                <!-- <option value="">Pilih Tahun</option> -->
                  <option value="<?php echo $tahun['year'];?>"><?php echo $tahun['year'];?></option>
            </select>
        </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-lg-4">
    <form action="" method="post">
        <div class="form-group input-group input-group-sm">
            <div class="input-group-prepend">
                <label class="input-group-text" for="bulan">Bulan</label>
            </div>
            <select class="form-control" id="bulan">
                <option value="">Pilih Bulan</option>
                <?php foreach($bulan as $bln) : ?>
                  <option value="<?php echo $bln['id'];?>" <?php echo ($bln['id'] ==  date("m")) ? ' selected="selected"' : '';?>><?php echo $bln['name'];?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
  </div>
</div>

<div class="row mt-3">
    <div class="col-lg-6">
        <form action="" method="post">
            <div class="form-group input-group input-group-sm">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="weekending">Weekending</label>
                </div>
                <select class="form-control" id="weekending">
                    <option value="">Pilih tanggal</option>
                    
                    <?php foreach($tgl as $tanggal) : ?>
                    <option value="<?= $tanggal['tgl_validasi']; ?>"><?= $tanggal['tgl_validasi']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>
    <div class="col-lg-6">
    <form action="" method="post">
            <div class="form-group input-group input-group-sm">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="mitra">Mitra</label>
                </div>
                <select class="form-control" id="mitra">
                    <option value="">Pilih Mitra</option>
                    <option value="">Show All</option>
                   <?php foreach($mitra as $row):?>
                    <option value="<?=$row['name']?>"><?=$row['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </form>
    </div>
</div>
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalTambah">Tambah Data</button>
<a href="<?= base_url('juice_4u/excel');?>" class="btn btn-success mb-2">Export Excell</a>

<div class="table-responsive">
<!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
<table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

        <thead>
            <tr style="text-align:center">
                <th>No.</th>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Point</th>
                <th>Omzet</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="show_data">
            <tr><td class="text-center" colspan="6">Tidak ada data ditampilkan. Silahkan pilih tanggal weekending untuk menampilkan data.</td></tr>
        </tbody>
    </table>
    <!-- <div class="row mt-3"> -->
    <div class="col-lg-6" style="margin-top:120px;">
        <form action="" method="post">
            <div class="form-group input-group input-group-sm">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="weekending">Total Point</label>
                </div>
               <input type="text" name="" id="total-point" class="form-control">
            </div>
        </form>
    </div>
    <div class="col-lg-6">
        <form action="" method="post">
            <div class="form-group input-group input-group-sm">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="weekending">Total Omzet</label>
                </div>
               <input type="text" name="" id="total-omzet" class="form-control">
            </div>
        </form>
    </div>
    <!-- </div> -->
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambah">Tambah data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('juice_4u/tambah'); ?>" class="form-horizontal" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="nama" placeholder="" class="form-control" autofocus="on" autocomplete="off">
            <small><span class="text-danger"><?=form_error('nama');?></span></small>
          </div>

          <div class="form-group">
            <label for="">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" autocomplete="off">
            <small><span class="text-danger"><?=form_error('lokasi');?></span></small>
          </div>

          <div class="form-group">
            <label for="">Point</label>
            <input type="text" name="point" placeholder="" class="form-control" autocomplete="off">
            <small><span class="text-danger"><?=form_error('point');?></span></small>
          </div>
          <div class="form-group">
            <label for="">Omzet</label>
            <input type="text" name="omzet" placeholder="" class="form-control" autocomplete="off">
            <small><span class="text-danger"><?=form_error('omzet');?></span></small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEdit">Edit data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('juice_4u/edit'); ?>" class="form-horizontal" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="nama2" id="nama2" placeholder="" class="form-control" autofocus="on" autocomplete="off">
            <small><span class="text-danger"><?=form_error('nama');?></span></small>
          </div>

          <div class="form-group">
            <label for="">Lokasi</label>
            <input type="text" name="lokasi2" id="lokasi2" placeholder="Masukkan nama gudang" class="form-control" autocomplete="off">
            <small><span class="text-danger"><?=form_error('lokasi');?></span></small>
          </div>

          <div class="form-group">
            <label for="">Point</label>
            <input type="text" name="point2" id="point2" placeholder="" class="form-control" autocomplete="off">
            <small><span class="text-danger"><?=form_error('point');?></span></small>
          </div>
          <div class="form-group">
            <label for="">Omzet</label>
            <input type="text" name="omzet2" id="omzet2" placeholder="" class="form-control" autocomplete="off">
            <small><span class="text-danger"><?=form_error('omzet');?></span></small>
          </div>
          <input type="hidden" name="id" id="id" value="" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Edit Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    $('.datepicker').datepicker();
      $(document).ready(function(){
        allData()
      })
      
    
  
    function allData() {
      let weekending = $('#weekending').val();
      let mitra = $('#mitra').val();
      let tahun = $('#tahun').val();
      let bulan = $('#bulan').val();
      let date = tahun + '-' + bulan;
      console.log(mitra)
        let fetchUrl = weekending != '' ?"juice_4u/tampil_data/" + weekending: (bulan != '' && tahun != '')? "juice_4u/tampil_data_bulanan/" +date:(mitra != '')?"juice_4u/tampil_data_mitra/" + mitra:'juice_4u/tampil_data' ;

        $.ajax({
            url: "<?= base_url(); ?>" + fetchUrl,
            success: function(result) {
                let results = JSON.parse(result);
                console.log(result )
                let data = "";
                let totalPoint = 0;
                let totalOmzet = 0;

                if (!results[0]) {
                    data = `<tr><td class="text-center" colspan="6">Tidak ada data ditampilkan. Silahkan pilih tanggal weekending untuk menampilkan data.</td></tr>`;
                } else {
                    for (let i = 0; i < results.length; i++) {
                        totalPoint = 0
                        totalOmzet = parseFloat(results[i].total) + totalOmzet
                        data += `
                        <tr>
                        <td class="text-center">
                        ${i+1}
                        </td>
                        <td>
                        ${results[i].nama_mitra}
                        </td>
                        <td width="">
                        ${results[i].lokasi}
                        </td>
                        <td width="">
                        0
                        </td>
                        <td width="">
                        ${results[i].total}
                        </td>
                        <td style="text-align:center">
                        <a onclick="getDataById(${results[i].id})" class="btn btn-success text-white" style=""><i class="fa fa-edit"></i>Edit</i></a>
                        <a href="<?= base_url(); ?>juice_4u/hapus/${results[i].id}" class="btn btn-danger " style="" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i>Hapus</a>
                        </td>
                        </tr>
                        `;
                    }
                }
                $('#total-point').val(totalPoint)
                $('#total-omzet').val(totalOmzet)
                $('#show_data').html(data);
            }
        });
    }

    

    // Fetch data
    $('#weekending').on('change', function() {
      $('#bulan').val('')
      $('#mitra').val('')
      allData();
      
    });
    $('#bulan').on('change', function() {
      $('#weekending').val('')
      $('#mitra').val('')
      allData();
      
    });
    $('#mitra').on('change', function() {
      $('#weekending').val('')
      // $('#tahun').val('')
      $('#bulan').val('')
      allData();
      
    });

    // Tutup buku
    $('#tutup_buku_btn').on('click', function() {
        let tgl_tutup_buku = $('#tutup_buku').val();
        let tutupBukuUrl = "account/tutup_buku/" + tgl_tutup_buku;

        $.ajax({
            url: "<?= base_url(); ?>" + tutupBukuUrl,
            success: function(result) {
                alert('Proses tutup buku telah dilakukan!');
                window.location.reload();
            }
        });
    });

    function getDataById(id) {
        let url = "juice_4u/getDataById/" + id;

        $.ajax({
            url: "<?= base_url(); ?>" + url,
            success: function(result) {
                let results = JSON.parse(result);
                
                $('#nama2').val(results.nama);
                $('#lokasi2').val(results.lokasi);
                $('#point2').val(results.point);
                $('#omzet2').val(results.omzet);
                $('#id').val(results.id);
                $('#modalEdit').modal('show');
            }
        });
    }
</script>
