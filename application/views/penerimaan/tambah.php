<div class="container">
  <div class="row my-3">
    <div class="col">
      <a href="<?= base_url('penerimaan'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
  </div>

  <div class="row">
    <div class="col" id="alert-space">
    </div>
  </div>

  <form method="post" id="createForm">
    <div class="row">
      <div class="col-4">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">Supplier :</label>
          </div>
          <input type="text" name="supplier" id="nama"  class="form-control form-control-sm" data-toggle="modal" data-target="#myModal">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="alamat" class="input-group-text">No. Sj Supplier :</label>
          </div>
          <input type="text" name="no_sj" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">Tgl. SJ Supplier :</label>
          </div>
          <input type="text" name="tanggal" class="form-control form-control-sm">
          <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
        </div>           
      </div>
      <div class="col-4">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">No. LPB :</label>
          </div>
          <input type="text" name="no_lpb" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="alamat" class="input-group-text">No. PO :</label>
          </div>
          <input type="text" name="no_po"  class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">No. Kontainer :</label>
          </div>
          <input type="text" name="no_kontiner"  class="form-control form-control-sm">
          <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
        </div>   
      </div>
      <div class="col-4">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">No. Polisi :</label>
          </div>
          <input type="text" name="no_polisi"  class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="alamat" class="input-group-text">Nama Driver :</label>
          </div>
          <input type="text" name="nama_supir"  class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">No. Segel :</label>
          </div>
          <input type="text" name="no_segel"  class="form-control form-control-sm">
          <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
        </div>
      </div>
    </div>

    <div class="table-responsive mt-3">
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr style="text-align:center;">
            <th>#</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Jumlah Karton</th>
            <th>Isi Karton</th>
            <th>Total Qty</th>
            <th>Harga</th>
            <th>Total Harga</th>
          </tr>
        </thead>
        <tbody id="customFields">
          <tr>   
            <td>
              <a href="javascript:void(0);" class="addCF rows"><i class="fas fa-plus"></i></a>
            </td>
            <td style="text-align:center;">
              <input type="text" name="kode" id="kode"  class="form-control form-control-sm" data-toggle="modal" data-id="1" data-target="#myModal1">
            </td>
            <td>
              <input type="text" name="nama"  id="namabrg"  class="form-control form-control-sm">
            </td>
            <td style="text-align:center;">
              <input type="text" name="qty" id="txt1" onkeyup="sum();"  class="form-control form-control-sm">
            </td>
            <td style="text-align:center;">
              <input type="text" name="isi_karton" id="txt2" onkeyup="sum();"  class="form-control form-control-sm">
            </td>
            <td style="text-align:center;">
              <input type="text" name="total_qty" id="txt3"  class="form-control form-control-sm" readonly>
            </td>
            <td style="text-align:center;">
              <input type="text" name="harga" onkeyup="sumHarga()" class="form-control form-control-sm">
            </td>
            <td style="text-align:center;">
              <input type="text" name="total_harga" class="form-control form-control-sm">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <button type="button" class="btn btn-primary mb-2 mt-2" onclick="showModalFaktur()">Proses</button>
    <!-- <button type="button" class="btn btn-primary mb-2 mt-2">Proses</button> -->
  </form>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="modal-body table-responsive">
          <table id="lookup" style="width:750px" class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th>Nama Supplier</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>  
              <?php 
              $no = 1;           
              foreach($data->result_array() as $i):
              $nama=$i['nama'];
              $alamat=$i['alamat'];
              ?>
              <tr class="pilih" data-nama="<?php echo $nama; ?>" data-alamat="<?php echo $alamat; ?>">
                <td><?php echo $nama; ?></td>
                <td><?php echo $alamat; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>  
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel1"></h4>
        </div>
        <div class="modal-body table-responsive">
          <table id="lookup1" style="width:750px" class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th>Kode</th>
  					    <th>Nama Barang</th>
                <th>Gudang</th>
              </tr>
            </thead>
            <tbody>
              <?php 
  						$no = 1;				   
  						foreach($data2->result_array() as $i):
  						$kode=$i['kode'];
  						$namabrg=$i['nama'];
  						$gudang=$i['gudang'];
  				    ?>
              <tr class="pilih1" data-kode="<?php echo $kode; ?>" data-nama="<?php echo $namabrg; ?>" data-gudang="<?php echo $gudang; ?>">
                <td><?php echo $kode; ?></td>
                <td><?php echo $namabrg; ?></td>
                <td><?php echo $gudang; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>       
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalFaktur" tabindex="-1" role="dialog" aria-labelledby="modalFakturLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFakturLabel">Proses Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          Apakah Anda ingin mencetak faktur untuk data ini?
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-primary" data-dismiss="modal" onclick="submitForm('print')"><i class="fas fa-print"></i>&nbsp;Print</button>
          <button class="btn btn-sm btn-secondary" data-dismiss="modal" onclick="submitForm()"><i class="fas fa-times"></i>&nbsp;Tutup</button>
        </div>
      </div>
    </div>
  </div>
  
</div>
<!-- end of .container -->

<script src="<?php echo base_url().'js/jquery-1.11.2.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'bootstrap/js/bootstrap.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'datatables/jquery.dataTables.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'datatables/dataTables.bootstrap.js'?>" type="text/javascript"></script>

<script type="text/javascript">
  getDefaultData();

  function getDefaultData() {
    $('input[name=tanggal]').val("<?= date('d/m/Y'); ?>");
    $.get({
      url: '<?= base_url('penerimaan/getNoLPB'); ?>',
      dataType: 'json',
      success: function(result) {
        $('input[name=no_lpb]').val(result);
      }
    })
  }

  // dataTable lookup mahasiswa
  $("#lookup").dataTable();
  $('#lookup1').DataTable()
  $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  });

  // jika dipilih, nim akan masuk ke input dan modal di tutup
  $(document).on('click', '.pilih', function (e) {
    document.getElementById("nama").value = $(this).attr('data-nama');
    $('#myModal').modal('hide');
    document.getElementById("alamat").value = $(this).attr('data-alamat');
    $('#myModal').modal('hide');
  }); 

  // jika dipilih, nim akan masuk ke input dan modal di tutup
  $(document).on('click', '.pilih1', function () {
    document.getElementById("kode").value = $(this).attr('data-kode');
    $('#myModal1').modal('hide');
		document.getElementById("namabrg").value = $(this).attr('data-nama');
    $('#myModal1').modal('hide');
  });

  function sum() {
    var txtFirstNumberValue = document.getElementById('txt1').value;
    var txtSecondNumberValue = document.getElementById('txt2').value;
    var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);

    if (!isNaN(result)) {
      document.getElementById('txt3').value = result;
    }
    sumHarga();
  }

  function sumHarga() {
    const total_qty = Number(document.querySelector('input[name="total_qty"]').value);
    const harga = Number(document.querySelector('input[name="harga"]').value);
    document.querySelector('input[name="total_harga"]').value = total_qty * harga;
  }    

  function showModalFaktur() {
    $('#modalFaktur').modal('show');
  }

  function submitForm(print) {
    const data = {
      supplier: $('input[name=supplier]').val(),
      no_sj: $('input[name=no_sj]').val(),
      tanggal: $('input[name=tanggal]').val(),
      no_lpb: $('input[name=no_lpb]').val(),
      no_po: $('input[name=no_po]').val(),
      no_kontiner: $('input[name=no_kontiner]').val(),
      no_polisi: $('input[name=no_polisi]').val(),
      nama_supir: $('input[name=nama_supir]').val(),
      no_segel: $('input[name=no_segel]').val(),
      kode: $('input[name=kode]').val(),
      nama: $('input[name=nama]').val(),
      gudang: $('input[name=gudang]').val(),
      qty: $('input[name=qty]').val(),
      isi_karton: $('input[name=isi_karton]').val(),
      total_qty: $('input[name=total_qty]').val(),
      harga: $('input[name=harga]').val(),
      total_harga: $('input[name=total_harga]').val()
    };

    let url = print ? "/print" : "";

    const alert_success = `
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Data Penerimaan <strong>berhasil</strong> ditambahkan!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
    `;

    $.post({
      url: '<?= base_url('penerimaan/tambahDataPenerimaan'); ?>' + url,
      data: data,
      dataType: 'json',
      success: function(result) {
        if (result['errors']) {
          const alert_danger = `
          <div class="alert alert-danger" role="alert">
            ${result['errors']}
          </div>
          `;

          $('#alert-space').html(alert_danger);
        } else {
          getDefaultData();
          $('input[name=supplier]').val("");
          $('input[name=no_sj]').val("");
          $('input[name=no_po]').val("");
          $('input[name=no_kontiner]').val("");
          $('input[name=no_polisi]').val("");
          $('input[name=nama_supir]').val("");
          $('input[name=no_segel]').val("");
          $('input[name=kode]').val("");
          $('input[name=nama]').val("");
          $('input[name=gudang]').val("");
          $('input[name=qty]').val("");
          $('input[name=isi_karton]').val("");
          $('input[name=total_qty]').val("");
          $('input[name=harga]').val("");
          $('input[name=total_harga]').val("");          
          $('#alert-space').html(alert_success);
          // setTimeout(() => $('.alert-success').alert('close'), 5000);
          if (result == "print") {
            window.open('<?= base_url('penerimaan/print'); ?>');
          }
        }
      }
    });

  //   const form = document.getElementById('createForm');
  //   if (!print) {
  //     form.action = "<?= base_url('penerimaan/tambah'); ?>";
  //   } else {
  //     form.action = "<?= base_url('penerimaan/tambah/print'); ?>";
  //   }

    // form.submit();
  }
  
  
//   window.onpopstate = function(event) {
    // window.history.pushState(null, '', "index");
//   }

  $(".addCF").click(function(){
		$("#customFields").append(`
        <tr>         
          <td>
            <a href="javascript:void(0);" class="remCF rows"><i class="fas fa-trash"></i></a>
          </td>
          <td style="text-align:center;">
            <input type="text" name="kode" id="kode"  class="form-control form-control-sm" data-toggle="modal" data-target="#myModal1">
          </td>
          <td>
            <input type="text" name="nama"  id="namabrg"  class="form-control form-control-sm">
          </td>
          <td style="text-align:center;">
            <input type="text" name="qty" id="txt1" onkeyup="sum();"  class="form-control form-control-sm">
          </td>
          <td style="text-align:center;">
            <input type="text" name="isi_karton" id="txt2" onkeyup="sum();"  class="form-control form-control-sm">
          </td>
          <td style="text-align:center;">
            <input type="text" name="total_qty" id="txt3"  class="form-control form-control-sm" readonly>
          </td>
          <td style="text-align:center;">
            <input type="text" name="harga" onkeyup="sumHarga()" class="form-control form-control-sm">
          </td>
          <td style="text-align:center;">
            <input type="text" name="total_harga" class="form-control form-control-sm">
          </td>
        </tr>
      `);
	});
  $("#customFields").on('click','.remCF',function(){
    $(this).parent().parent().remove();
  });
</script>
