<form action="/product/save" method="post">
    <div class="modal fade" class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Hak Akses
                        <?php $i = 1; ?>
                        <?php foreach ($list_user as $usr) : ?>
                            <tr>
                                <td width="">
                                    <?php echo $usr['name'] ?>
                                </td>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                            </h3>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
                        <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

                            <thead>
                                <tr style="text-align:center">
                                    <th>Nama Sub Menu</th>
                                    <th>C</th>
                                    <th>R</th>
                                    <th>U</th>
                                    <th>D</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_menu as $lm) {
                                    $no = 0;
                                    echo '<tr>';
                                    echo '<td>' . $lm['nama_sub_menu'] . '</td>';
                                    echo '<td><input name="tambah' . $no . '"' . ($lm['tambah'] == '1'
                                        ? 'checked' : '') . '
                             type="checkbox" 
                             class="form-control size-check">
                             </td>';
                                    echo '<td><input name="akses' . $no . '"' . ($lm['akses'] == '1'
                                        ? 'checked' : '') . '
                          type="checkbox" 
                          class="form-control size-check">
                          </td>';
                                    echo '<td><input name="update' . $no . '"' . ($lm['update'] == '1'
                                        ? 'checked' : '') . '
                             type="checkbox" 
                             class="form-control size-check">
                             </td>';
                                    echo '<td><input name="delete' . $no . '"' . ($lm['delete'] == '1'
                                        ? 'checked' : '') . '
                          type="checkbox" 
                          class="form-control size-check">
                          </td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>