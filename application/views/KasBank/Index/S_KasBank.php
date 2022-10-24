<script>
    $(document).ready(function() {
        getDataKasBank();

        $("#tableDataKasBank").DataTable();
    })

    const numberFormat = (number) => {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    const getDataKasBank = () => {
        fetch('<?= base_url('Kas_bank/getDataKasBank'); ?>')
            .then(response => response.json())
            .then((result) => {

                if (result.length > 0) {
                    if ($.fn.DataTable.isDataTable('#tableDataKasBank')) {
                        $('#tableDataKasBank').DataTable().destroy();
                    }

                    $("#tableDataKasBank > tbody").empty();

                    let totPenerimaan = 0;
                    let totPengeluaran = 0;
                    result.forEach((v) => {
                        totPenerimaan += parseFloat(v.penerimaan)
                        totPengeluaran += parseFloat(v.pengeluaran)
                        $("#tableDataKasBank > tbody").append(`
                            <tr class="text-center">
                                <td>${v.tanggal}</td>
                                <td>${v.kode}</td>
                                <td>${numberFormat(v.penerimaan)}</td>
                                <td>${numberFormat(v.pengeluaran)}</td>
                                <td>aksi edit, hapus</td>
                            </tr>
                        `);
                    });


                    $("#tableDataKasBank").DataTable();

                    $("#tableDataKasBank > tfoot tr #totPenerimaan").html(numberFormat(totPenerimaan));
                    $("#tableDataKasBank > tfoot tr #totPengeluaran").html(numberFormat(totPengeluaran));
                } else {
                    $("#tableDataKasBank > tfoot tr #totPenerimaan").html(0);
                    $("#tableDataKasBank > tfoot tr #totPengeluaran").html(0);
                }

            });
    }
</script>