<div class="container">
    <div class="col-md-6 col-lg-10">
        <!-- <h5>Tambah Form Data</h5> -->

        <!-- <form action="" method="POST">  -->
        <form action="<?= base_url() ?>daftar_mitra/tambah" method="post">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="kode">ID</label>
                    <input type="text" class="form-control" id="kode" name="kode" value="MT-<?php echo sprintf("%04s", $kode) ?>" readonly>

                    <!-- <input type="text" class="form-control" id="inputKode" name="kode" required> -->
                </div>
                <div class="form-group col-md-4">
                    <label for="inputNama">Nama</label>
                    <input type="text" class="form-control" id="inputNama" name="name" required>
                </div>
                <!-- <div class="form-group col-md-4">
                    <label for="inputNama">Username</label>
                    <select name="username" id="username" class="form-control">
                        <?php foreach ($daftarmitra as $df) : ?>
                            <?php if (isset($df['username'])) : ?>
                                <option value=""><?= $df['username']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div> -->
            </div>
            <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="inputTgl">Tgl Lahir</label>
                    <input type="date" class="form-control" id="inputTgl" name="tgl_lahir" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control" name="jabatan" id="jabatan">
                        <option value="">-- Pilih --</option>
                        <?php foreach ($jabatan as $j) : ?>
                            <option value="<?= $j['name'] ?>"><?= $j['kode'] ?> - <?= $j['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <select class="form-control" name="jabatan" id="jabatan">
                 <option value="">-- Pilih --</option>
                 <?
                    //php foreach ($jabatan as $j) :
                    ?>
                    <option name="jabatan"><
                        //?= $j;?></option>
                <?
                //php endforeach;
                ?>
                </select> -->
                </div>
                <div class="form-group col-md-4">
                    <label for="jabatan">Promoter</label>
                    <select class="form-control" name="promoter" id="prometer">
                        <option value="">Pilih Promoter</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTahun">Tahun Gabung</label>
                    <input type="text" class="form-control" id="inputTahun" name="thn_gabung" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="gudang">Gudang</label>
                    <select class="form-control" name="gudang" id="gudang">
                        <option value="">-- Pilih --</option>
                        <?php foreach ($gudang as $j) : ?>
                            <option name="gudang"><?= $j['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAlamat">Alamat</label>
                <input type="text" class="form-control" id="inputAlamat" name="alamat" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputKota">Kota</label>
                    <input type="text" class="form-control" id="inputKota" name="kota" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputTelepon">Telepon</label>
                    <input type="text" class="form-control" id="inputTelepon" name="telepon" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="text" class="form-control" id="inputEmail" name="email" required>
            </div>
    </div>

    <button type="submit" class="btn btn-primary ml-2">Tambah Data</button>
    <a href="<?= base_url('daftar_mitra'); ?>" class="btn btn-success">Kembali</a>
    </form>
</div>

<script>
    function handlePromotor(value) {
        $.ajax({
                type: "POST",
                url: "<?= base_url('Daftar_mitra/getPromotorByKode') ?>",
                data: {
                    kode: value,
                    type: 'create',
                    name: null
                },
                dataType: "JSON",
                success: function(response) {
                    $("#prometer").empty()
                    let html = "";

                    // if (value == "Vice President") {
                    //     html += `<option value="">--Pilih--</option>`
                    // } else {
                    //     if (response.length > 0) {
                    //         html += `<option value="">--Pilih--</option>`
                    //         $.each(response, function(i, v) {
                    //             html += `<option value="${v.name}">${v.jabatan} - ${v.name}</option>`
                    //         })
                    //     } else {
                    //         html += `<option value="">--Pilih--</option>`;
                    //         html += `<option value="">--Belum Ada Data--</option>`;
                    //     }
                    // }

                        if (response.length > 0) {
                            html += `<option value="">--Pilih--</option>`
                            $.each(response, function(i, v) {
                                html += `<option value="${v.name}">${v.jabatan} - ${v.name}</option>`
                            })
                        } else {
                            html += `<option value="">--Pilih--</option>`;
                            html += `<option value="">--Belum Ada Data--</option>`;
                        }

                        $("#prometer").append(html);
                    }
                })
        }

        $('#jabatan').change(function () {
            const selectedText = this.options[this.selectedIndex].text;
            const selectedCode = selectedText.split(' - ')[0];
            handlePromotor(selectedCode);
        });
</script>