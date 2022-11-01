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

            <?=form_open('', array('id' => 'form0','method'=>'post')); ?>
                <input type="hidden" name="id" value="<?=($mitraList->id);?>" />
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="my-1 mr-2">ID Mitra</label>
                        <input type="text" class="form-control" name="kode" value="<?=$mitraList->kode;?>" readonly>
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="my-1 mr-2">Nama Mitra</label>
                        <input type="text" class="form-control" name="name" value="<?=$mitraList->name;?>" readonly>
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="my-1 mr-2">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" value="<?=$mitraList->jabatan;?>" readonly>
                    </div>                    
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="my-1 mr-2">Saldo Awal Override</label>
                        <input type="text" class="form-control" name="saldo_override" value="<?=$mitraList->saldo_override;?>">
                    </div>
                    
                    <div class="form-group col-sm-6">
                        <label class="my-1 mr-2">Saldo Awal HO</label>
                        <input type="text" class="form-control" name="saldo_ho" value="<?=$mitraList->saldo_ho;?>">
                    </div>
                </div>

                <a href="<?=base_url('override/saldo');?>" class="btn btn-secondary my-1">Cancel</a>
                <button type="submit" class="btn btn-primary my-1">Submit</button>
            </form>
        </div>
    </div>

</section> 
</div>