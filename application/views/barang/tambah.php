<div class="container">
    <div class="col-md-6">
        <h5>Tambah Form Data</h5>

        <form action="" method="POST"> 
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputKode">Kode</label>
                <input type="text" class="form-control" id="inputKode" name="kode" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputBarang">Nama Barang</label>
                <input type="text" class="form-control" id="inputBarang" name="nama" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputKategori">Kategori</label>
                <input type="text" class="form-control" id="inputKategori" placeholder="" name="id_role">
            </div>
            <div class="form-group">
                <label for="inputKategori">Manager</label>
                <input type="text" class="form-control" id="inputKategori" placeholder="" name="manager">
            </div>
            <div class="form-group">
                <label for="inputGudang">Gudang</label>
                <input type="text" class="form-control" id="inputGudang" placeholder="" name="gudang">
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                <label for="inputCity">Harga Sebelum Pajak</label>
                <input type="text" class="form-control" id="inputCity" name="sebelumpajak" required>
                </div>
     
                <div class="form-group col-md-2">
                <label for="inputZip">PPN</label>
                <input type="text" class="form-control" id="inputZip" name="ppn" required>
                </div>
                <div class="form-group col-md-5">
                <label for="inputZip">Harga Setelah Pajak</label>
                <input type="text" class="form-control" id="inputZip" name="setelahpajak" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputbagus">Unit Bagus</label>
                <input type="text" class="form-control" id="inputbagus" name="unitbagus" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputrusak">Unit Rusak</label>
                <input type="text" class="form-control" id="inputrusak" name="unitrusak" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputSetoran">Harga Setoran</label>
                <input type="text" class="form-control" id="inputSetoran" name="hargasetoran" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputStok">Stok Awal</label>
                <input type="text" class="form-control" id="inputStok" name="qty" required>
                </div>
            </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputCity">HPP</label>
                <input type="text" class="form-control" id="inputCity" name="hpp" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputTotal">Total</label>
                <input type="text" class="form-control" id="inputTotal" name="jumlah" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="<?= base_url('barang');?>" class="btn btn-success">Kembali</a>
            </form>
    </div>
</div>