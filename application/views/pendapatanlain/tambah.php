<div class="container">
    <div class="col-md-12">
        <h2 class="">Form Tambah Data</h2>
        <form action="" class="form-horizontal" method="POST">
            <div class="row transaksi-b">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">No Faktur</label>
                        <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="PL-<?php echo sprintf("%04s", $no_faktur) ?>" readonly>

                        <small><span class="text-danger"><?=form_error('no_faktur');?></span></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Tgl</label>
                        <input type="text" required name="tgl" placeholder="<?php echo date('d/M/y');?>" class="form-control" value="<?php echo date('d/m/y');?>">
                        <small><span class="text-danger"><?=form_error('tgl');?></span></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Rekening</label>
                        <select class="form-control" name="rekening">
                            <option value="Kas">Kas</option> 
                            <option value="Tunai">Tunai</option> 
                        </select>
                        <small><span class="text-danger"><?=form_error('rekening');?></span></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Kode Jurnal</label>
                        <input type="text" required value="-" name="kode_jurnal" class="form-control">
                        <small><span class="text-danger"><?=form_error('kode_jurnal');?></span></small>
                    </div>
                </div>
            </div>
            <hr>
            <button type="button" class="btn btn-success btn-sm mb-2 add-new-akun"><i class="fa fa-plus"></i> tambah akun</button>
            <div class="row transaksi-b">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Kode dan Nama Akun</label>
                        <select name="kode_akun[]" class="form-control">
                            <?php foreach($coa as $a){ ?>
                                <option value="<?= $a['id'] ?>"><?= $a['kode'] ?> - <?= $a['nama'] ?></option>

                            <?php } ?>
                        </select >
                        <small><span class="text-danger"><?=form_error('kode_akun');?></span></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Transaksi</label>
                        <input type="text" name="transaksi[]" required placeholder="Masukkan Transaksi" class="form-control">
                        <small><span class="text-danger"><?=form_error('transaksi');?></span></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Jumlah Sub Total</label>
                        <input type="number" name="subtotal[]" value="0"  required placeholder="Masukkan Jumlah" class="form-control subtotal">
                        <small><span class="text-danger"><?=form_error('jumlah');?></span></small>
                    </div>
                </div>
            </div>
            <div class="transaksi-copy"></div>
            
            <div class="row mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-3"></div>
                <div class="col-md-5 text-right">
                    <div class="form-group mb-4">
                        <h5 for=""><b>Jumlah Total : <span id="jumlah_total">Rp. 0</span></b></h5>
                        <input type="hidden" id="jumlah_totalhd" name="jumlah_total">
                        <small><span class="text-danger"><?=form_error('jumlah_total');?></span></small>
                    </div>
                    <a href="<?=base_url('pendapatan');?>" class="btn btn-success mb-2">Kembali</a>
                    <button type="submit" class="btn btn-primary mb-2">Tambah Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    console.log('start');
    function sumsubtotal(){
        var total = 0;
        var sb = $('input[name="subtotal[]"]');

        $(sb).each(function () {
            total += parseFloat(this.value)
        });

        if (!isNaN(total)) {
            // pengiriman.value = parseFloat(total);
            $('#jumlah_total').html(total);
            $('#jumlah_totalhd').val(total);
        }
    }
	$(document).ready(function() {
        $(".add-new-akun").click(function(){
            var content = "";
            content = `
            <div class="row akun-new">    
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Kode dan Nama Akun</label>
                        <select name="kode_akun[]" class="form-control">
                            <?php foreach($coa as $a){ ?>
                                <option value="<?= $a['id'] ?>"><?= $a['kode'] ?> - <?= $a['nama'] ?></option>
                            <?php } ?>
                        </select >
                        <small><span class="text-danger"><?=form_error('kode_akun');?></span></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Transaksi</label>
                        <input type="text" name="transaksi[]" required placeholder="Masukkan Transaksi" class="form-control">
                        <small><span class="text-danger"><?=form_error('transaksi');?></span></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Jumlah Sub Total</label>
                        <input type="text" name="subtotal[]" required value="0" placeholder="Masukkan Jumlah" class="form-control subtotal">
                        <small><span class="text-danger"><?=form_error('jumlah');?></span></small>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <br>
                        <button class="btn btn-danger remove-akun"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
            `;
            $('.transaksi-copy').append(content);
            sumsubtotal();
        });

        // function sumsubtotal(){
        //     var total = 0;
        //     $('.subtotal').each(function (i, val) {
        //         total += parseFloat(total) + parseFloat($(val).val());
        //     });
        //     $('#jumlah_total').html(total);
        //     $('input[name="jumlah_total"]').val(total);
        // }

        $(".transaksi-copy").on("click",".remove-akun",function(){ 
            $(this).parents(".akun-new").remove();
            sumsubtotal();
        });
        
        $(".transaksi-b").on("input", ".subtotal", function(){
            sumsubtotal();
        });

        $(".transaksi-copy").on("input", ".subtotal", function(){
            sumsubtotal();
        });


        
    });
</script>