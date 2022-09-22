<div class="container">
    <div class="col-md-6">
        <h2 class="">Form Tambah Data</h2>
        <form action="" class="form-horizontal" method="POST">
            <div class="form-group">
                <label for="">Nama</label>
                <div class="form-inline d-flex justify-content-between">
                    <input type="text" name="firstname" placeholder="Nama Depan" class="form-control flex-grow-1">
                    &emsp;
                    <input type="text" name="lastname" placeholder="Nama Belakang" class="form-control flex-grow-1">
                </div>
                <small><span class="text-danger"><?=form_error('firstname');?></span></small>
                <small><span class="text-danger"><?=form_error('lastname');?></span></small>
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" placeholder="Masukkan Username" class="form-control">
                <small><span class="text-danger"><?=form_error('username');?></span></small>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" placeholder="Masukkan Email" class="form-control">
                <small><span class="text-danger"><?=form_error('email');?></span></small>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" class="form-control">
                <small><span class="text-danger"><?=form_error('password');?></span></small>
            </div>
    		<div class="form-group">
                <label for="">Kode Id</label>
                <input type="text" name="kode_id" placeholder="Masukkan Kode Id" class="form-control">
                <small><span class="text-danger"><?=form_error('kode_id');?></span></small>
            </div>
            <div class="form-group">
                <label class="d-block" for="">Role</label>
                <input type="radio" name="id_role" value="1" />&nbsp;ADMIN
                    &emsp;&emsp;
                <input type="radio" name="id_role" value="2" />&nbsp;USER
                <!--<small><span class="text-danger"><?=form_error('id_role');?></span></small>-->
            </div>
            
            <button type="submit" class="btn btn-primary mb-2">Tambah Data</button>
            <a href="<?=base_url('users');?>" class="btn btn-success mb-2">Kembali</a>
        </form>
    </div>
</div>