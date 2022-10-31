
<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$judul; ?></h6>
        </div>
        <div class="card-body">
            <?php if($this->session->flashdata('success')) echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $this->session->flashdata('success') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></div>'; ?>

            <?=validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></div>'); ?>

            <?=form_open(''); ?>
                <input type="hidden" name="id" value="<?=($overrides->id);?>" />
                
                    <div class="row mb-3">
                        <div class="form-group col-sm-6">
                            <label class="my-1 mr-2">Kode</label>
                            <input type="text" class="form-control" name="kode" value="<?=$overrides->kode;?>" readonly/>
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="my-1 mr-2">Nama Jabatan</label>
                            <select class="form-control" name="kode_jabatan">
                                <option value="">-- Pilih --</option>
                                <?php foreach($jabatanList as $jabtan) {
                                    echo '<option value="' . $jabtan['kode'] . '"';
                                    if($overrides->kode_jabatan == $jabtan['kode']) echo 'selected';
                                    echo '>' . $jabtan['name'] . '</option>';
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
                                    <input type="text" class="form-control" name="persen[omsetless_15]" value="2" />
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="check[]" value="omsetless_15" <?=($overrides->omsetless_15=='Y') ? 'checked="checked"' : '';?>/>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Lebih dari 15 Juta</td>
                                <td>
                                    <input type="text" class="form-control" name="persen[omsetmore_15]" value="3" />
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="check[]" value="omsetmore_15" <?=($overrides->omsetmore_15=='Y') ? 'checked="checked"' : '';?>/>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Berapapun Omzet</td>
                                <td>
                                    <input type="text" class="form-control" name="persen[omsetall]" value="4" />
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="check[]" value="omsetall" <?=($overrides->omsetall=='Y') ? 'checked="checked"' : '';?>/>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                <a href="<?=base_url('override');?>" class="btn btn-secondary my-1">Cancel</a>
                <button type="submit" class="btn btn-primary my-1">Submit</button>
            </form>
        </div>
    </div>

</section> 
</div>

<script type="text/javascript">
    var deferred = new $.Deferred(),
        promise = deferred.promise();

    $(document).on('click', 'input[type="checkbox"]', function() {      
        $('input[type="checkbox"]').not(this).prop('checked', false);      
    });

    setTimeout(function(){
        $(".alert").each(function(index){
            $(this).delay(200*index).fadeTo(1500,0).slideUp(500,function(){
                $(this).remove();
            });
        });
    },2000);
</script>