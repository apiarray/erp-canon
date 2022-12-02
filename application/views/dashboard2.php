<div class="mx-3">
    <div class="d-flex flex-row gap">
        <div class="col-md-6 mb-4 shadow">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Jenis Barang</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $totalJenisBarang ?> Jenis</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard fa-2x text-warning-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4 shadow">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Total Barang</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $totalBarang < 0 ? 0 : $totalBarang ?> Buah</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard fa-2x text-warning-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-body">
                <h4>Daftar Barang Masuk</h4>
                <hr style="border-width: 3px;" class="border-primary">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No. DO</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Kuantitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barangDiterima as $item) : ?>
                            <tr>
                                <td><?= $item['no_do'] ?? '-' ?></td>
                                <td><?= date('d M Y', strtotime($item['tanggal'])) ?? '-' ?></td>
                                <td><?= $item['nama'] ?></td>
                                <td><?= $item['kategori'] ?? '-' ?></td>
                                <td><?= $item['total'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>