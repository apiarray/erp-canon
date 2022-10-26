<div class="container">
    <div class="col-md-6">
       <form action="<?php echo base_url().'barang2/return_gudang'?>" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="tgl">Tanggal</label>
                <input type="text" class="form-control" value="<?php echo date ('d-m-Y'); ?>" name="tanggal" required>
                </div>
                <div class="form-group col-md-6">
                <label for="no_transfer">No. transfer</label>
                <input type="text" class="form-control" id="no_transfer" name="no_faktur" required>
                </div>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" name="keterangan">
            </div>
            
			 <div class="form-group">
                <label for="kode">Kode</label>
                <input type="text" class="form-control" value="<?= $produk['kode'];?>" name="kode">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control"  value="<?= $produk['nama'];?>" name="barang">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="gudang_asal">Gudang Asal</label>
                <input type="text" class="form-control" value="<?= $produk['gudang'];?>" name="gudang_asal" required>
                </div>
     
                <div class="form-group col-md-6">
                <label for="gudang_tujuan">Gudang Tujuan</label>
              <input type="text" class="form-control"  name="gudang_tujuan" required>
                </div>
            </div>
           
           <div class="form-group col-md-6">
                <label for="qty">Jumlah Return</label>
                <input type="text" class="form-control"  name="jumlah" required>
				  <input type="hidden" name="kode_id" value="<?php foreach ($users as $daf): ?><?php echo $daf['kode_id'] ?><?php endforeach; ?>" class="form-control">
                </div>
            

            <button type="submit" class="btn btn-primary">Return</button>
            <a href="<?= base_url('barang2');?>" class="btn btn-success">Kembali</a>
            </form>
    </div>
</div>