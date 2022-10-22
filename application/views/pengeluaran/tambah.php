<div class="container">
    <div class="col-md-12">
        <h5>Tambah Form Data</h5>

        <form action="" method="POST"> 
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail">Tanggal</label>
                    <input type="date" class="form-control" id="inputEmail" name="tgl" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputTgl">Bukti Transaksi</label>
                    <input type="text" class="form-control" id="inputTgl" name="reff" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Kode Jurnal</label>
                    <input type="text" required value="-" name="kode_jurnal" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">Uraian</label>
                    <textarea type="text" class="form-control" id="inputEmail" name="uraian" required></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Rekening</label>
                    <select class="form-control" name="rekening">
                        <?php foreach($rekening as $a){ ?>
                            <option value="<?= $a['id'] ?>"><?= $a['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <hr>
            <button type="button" class="btn btn-success btn-sm mb-2 add-new-akun"><i class="fa fa-plus"></i> tambah akun</button>
            <div class="form-row pengeluaran-b">
                <div class="form-group col-md-4">
                    <label for="inputAlamat">No. Akun</label>
                    <select class="form-control" name="kode_id[]">
                        <?php foreach($coa as $a){ ?>
                            <option value="<?= $a['id'] ?>"><?= $a['kode'] ?> - <?= $a['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputTahun">Jumlah</label>
                    <input type="text" class="form-control jumlah" value="0" id="inputTahun" name="jumlah[]" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputJabatan">Batasan</label>
                    <input type="text" class="form-control" id="inputJabatan" name="batasan[]" required>
                </div>
            </div>
            <div class="pengeluaran-copy"></div>
            
            <div class="row mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-3"></div>
                <div class="col-md-5 text-right">
                    <div class="form-group mb-4">
                        <h5 for=""><b>Jumlah Total : <span id="jumlah_total">Rp. 0</span></b></h5>
                        <input type="hidden" id="jumlah_totalhd" name="jumlah_total">
                    </div>
                    <a href="<?= base_url('penerimaan');?>" class="btn btn-success">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    console.log('start');
    function sumsubtotal(){
        var total = 0;
        var sb = $('input[name="jumlah[]"]');

        $(sb).each(function () {
            total += parseFloat(this.value)
        });

        if (!isNaN(total)) {
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
                        <label for="">No. Akun</label>
                        <select name="kode_id[]" class="form-control">
                            <?php foreach($coa as $a){ ?>
                                <option value="<?= $a['id'] ?>"><?= $a['kode'] ?> - <?= $a['nama'] ?></option>
                            <?php } ?>
                        </select >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputTahun">Jumlah</label>
                        <input type="text" class="form-control jumlah" value="0" id="inputTahun" name="jumlah[]" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="inputJabatan">Batasan</label>
                        <input type="text" class="form-control" id="inputJabatan" name="batasan[]" required>
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
            $('.pengeluaran-copy').append(content);
            sumsubtotal();
        });

        $(".pengeluaran-copy").on("click",".remove-akun",function(){ 
            $(this).parents(".akun-new").remove();
            sumsubtotal();
        });
        
        $(".pengeluaran-b").on("input", ".jumlah", function(){
            sumsubtotal();
        });

        $(".pengeluaran-copy").on("input", ".jumlah", function(){
            sumsubtotal();
        });


        
    });
</script>