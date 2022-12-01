<div class="container">
    <div class="col-md-6 col-lg-10">
        <h5>Edit Form Data</h5>

        <form action="<?= base_url() ?>daftar_mitra/prosesEdit" method="POST">
            <input type="hidden" name="id" class="form-control" value="<?= $data['id']; ?>">
            <input type="hidden" id="dataPromotor" class="form-control" value="<?= $data['promoter']; ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputKode">ID</label>
                    <input type="text" class="form-control" id="inputKode" name="kode_id" value="<?= $data['kode']; ?>" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputNama">Nama</label>
                    <input type="text" class="form-control" id="inputNama" name="name" value="<?= $data['name']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputTgl">Tgl Lahir</label>
                    <input type="date" class="form-control" id="inputTgl" name="tgl_lahir" value="<?= $data['tgl_lahir']; ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="dosen_pa">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-control">
                        <?php foreach ($jabatan as $pr) : ?>
                            <?php if ($pr['name'] == $data['jabatan']) : ?>
                                <option value="<?= $pr['name'] ?>" selected><?= $pr['kode'] ?> - <?= $pr['name'] ?></option>
                            <?php else : ?>
                                <option value="<?= $pr['name'] ?>"><?= $pr['kode'] ?> - <?= $pr['name'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="promoter">Promoter</label>
                    <select class="form-control" name="promoter" id="promoter"></select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTahun">Tahun Gabung</label>
                    <input type="text" class="form-control" id="inputTahun" name="thn_gabung" value="<?= $data['thn_gabung']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputGudang">Gudang</label>
                    <select name="gudang" id="gudang" class="form-control">
                        <?php foreach ($gudang as $pr) : ?>
                            <?php if ($pr == $pilih['nama']) : ?>
                                <option value="<?= $pr['nama']; ?>" selected><?= $pr['nama']; ?></option>
                            <?php else : ?>
                                <option value="<?= $pr['nama']; ?>"><?= $pr['nama']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAlamat">Alamat</label>
                <input type="text" class="form-control" id="inputAlamat" name="alamat" value="<?= $data['alamat']; ?>">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputKota">Kota</label>
                    <input type="text" class="form-control" id="inputKota" name="kota" value="<?= $data['kota']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputTelepon">Telepon</label>
                    <input type="text" class="form-control" id="inputTelepon" name="telepon" value="<?= $data['telepon']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="text" class="form-control" id="inputEmail" name="email" value="<?= $data['email']; ?>">
            </div>


            <button type="submit" class="btn btn-primary mb-2">Edit Data</button>
            <a href="<?= base_url('daftar_mitra'); ?>" class="btn btn-success mb-2">Kembali</a>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#jabatan").trigger('change');
    })

    function handlePromotor(value) {
        let dataDb = $("#dataPromotor").val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('Daftar_mitra/getPromotorByKode') ?>",
            data: {
                kode: value,
                type: 'edit',
                name: $("#inputNama").val()
            },
            dataType: "JSON",
            success: function(response) {
                $("#prometer").empty()
                let html = "";

                if (value == "001") {
                    html += `<option value="">--Pilih--</option>`
                } else {
                    if (response.length > 0) {
                        html += `<option value="">--Pilih--</option>`
                        $.each(response, function(i, v) {
                            if (v.name == dataDb) {
                                html += `<option value="${v.name}" selected>${v.jabatan} - ${v.name}</option>`
                            } else {
                                html += `<option value="${v.name}">${v.jabatan} - ${v.name}</option>`
                            }
                        })
                    } else {
                        html += `<option value="">--Pilih--</option>`;
                        html += `<option value="">--Belum Ada Data--</option>`;
                    }
                }
                $("#promoter").append(html);
            }
        })
    }

    $('#jabatan').change(function() {
        const selectedText = this.options[this.selectedIndex].text;
        const selectedCode = selectedText.split(' - ')[0];
        handlePromotor(selectedCode);
    });

    $(document).ready(function() {
        $('#promoter').select2();
    })
</script>