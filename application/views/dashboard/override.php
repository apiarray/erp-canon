<?php
// echo json_encode($overrides);
?>
<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left"><?=$judul; ?></h6>
            <div class="float-right">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#overrideModal">Tambah</a>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive table table-hover">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Kantor</th>
                        <th>Summary</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($overrides):
                        $no=1;
                        foreach($overrides as $override) {
                        ?>
                        <tr>
                            <td><?=$no;?>.</td>
                            <td><?=$override['nama']; ?></td>
                            <td><?=$override['kantor']; ?></td>
                            <td><?=$override['summary']; ?></td>
                            <td><?=$override['total_saving']; ?></td>
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

<!-- Jabatan Modal-->
<div class="modal fade" id="overrideModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Override</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">??</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if($this->session->flashdata('success')) echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $this->session->flashdata('success') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></div>'; ?>

                <?=validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></div>'); ?>

                <?=form_open('dashboard/override_create', array(
                    'id' => 'jabatanform',
                    'class' => 'form-inline',
                    'method'=>'post'
                )); ?>
                    <div class="row mb-3">
                        <div class="form-group col-sm-6">
                            <label class="my-1 mr-2">Kode</label>
                            <input type="text" class="form-control" name="kode" />
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="my-1 mr-2">Nama Jabatan</label>
                            <select class="form-control" name="name">
                                <option value="">-- Pilih --</option>
                                <?php foreach($jabatanList as $jabtan) {
                                    echo '<option value="' . $jabtan['id'] . '">' . $jabtan['name'] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="50%">Omset Penjualan</th>
                                <th>Persen (%)</th>
                                <th>Checklist</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kurang dari 15 Juta</td>
                                <td>
                                    <input type="text" class="form-control" name="persen" value="2" />
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="check" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Lebih dari 15 Juta</td>
                                <td>
                                    <input type="text" class="form-control" name="persen" value="3" />
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="check" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Berapapun Omzet</td>
                                <td>
                                    <input type="text" class="form-control" name="persen" value="4" />
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="check" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" id="tagSubmit" class="btn btn-primary my-1">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    var deferred = new $.Deferred(), promise = deferred.promise();

    $(document).on('click', 'input[type="checkbox"]', function() {      
        $('input[type="checkbox"]').not(this).prop('checked', false);      
    });

    $('.tagHapus').on('click', function(e) {
        e.preventDefault();
        if(confirm('Yakin ingin dihapus?')) {
            var id = $(this).data("id");
            $.get("<?=base_url();?>jabatan/hapus/" + id, function(data, status){
                console.log(data);
                var obj = JSON.parse(data);
                if(obj.success){
                    Swal.fire({
                        icon: 'error',
                        text: obj.msg
                    });
                }
            });
            $(this).closest("tr").remove();
        }

    });

    $('#tagSubmit').on('click', function(e) {
        e.preventDefault();
        $('input[name=kode]').removeAttr('disabled');

        $.ajax({
            type: "POST",
            url: $('form#jabatanform').attr('action'),
            data: $('form#jabatanform').serialize(),
            success: function(response) {
                console.log(response);
                var obj = JSON.parse(response);
                if(obj.success){
                    $('#overrideModal').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: obj.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // setTimeout(function(){
                    //     window.location.reload();
                    // },2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: obj.msg,
                        text: obj.data
                    });
                }
            },
            error: function() {
                alert('Error');
            }
        });
        return false;
    });

    $('#overrideModal').on('shown.bs.modal', function (e) {
        $.get("<?=base_url('dashboard/override_getkode');?>", function(data, status){
            // console.log(data);
            $('input[name=kode]').val(data).attr('disabled', 'disabled');
        });
    });

    setTimeout(function(){
        $(".alert").each(function(index){
            $(this).delay(200*index).fadeTo(1500,0).slideUp(500,function(){
                $(this).remove();
            });
        });
    },2000);
</script>