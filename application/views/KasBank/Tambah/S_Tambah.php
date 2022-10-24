<script>
    $(document).ready(function() {

        $(document).on("input", ".numeric", function(event) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });


        fetch('<?= base_url('Kas_bank/getLatestNoTf'); ?>')
            .then(response => response.json())
            .then((result) => {
                $('input[name=nomor_kas_bank]').val(result);
            });

        countTotal();

        initDataTable("#tableDataRincian", [0, 1, 2, 3, 4, 5, 6, 7])
    });

    const countTotal = () => {

        let totPenerimaan = 0;
        let totPegeluaran = 0;

        $("#tableDataRincian > tbody tr").each(function() {
            let penerimaan = $(this).find("td:eq(3) input[type='text']").val()
            let pengeluaran = $(this).find("td:eq(4) input[type='text']").val()

            let changeValPenerimaan = penerimaan == "" ? 0 : parseFloat(penerimaan);
            let changeValPengeluaran = pengeluaran == "" ? 0 : parseFloat(pengeluaran);
            totPenerimaan += changeValPenerimaan
            totPegeluaran += changeValPengeluaran

        });

        $("#penerimaan_sementara").val(numberFormat(totPenerimaan))
        $("#pengeluaran_sementara").val(numberFormat(totPegeluaran))
    }

    const initDataTable = (table, target) => {
        $(table).DataTable({
            columnDefs: [{
                sortable: false,
                targets: target
            }],
            lengthMenu: [
                [-1],
                ['All']
            ],
        });
    }

    const numberFormat = (number) => {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    const handleShowDataPengiriman = () => {

        $("#showData").modal('show');
        $(".modal-title").html("Data Pengiriman");

        fetch('<?= base_url('Kas_bank/getDataPengiriman'); ?>')
            .then(response => response.json())
            .then((result) => {

                if (result.length > 0) {
                    if ($.fn.DataTable.isDataTable('#tableShowData')) {
                        $('#tableShowData').DataTable().destroy();
                    }

                    $("#tableShowData > tbody").empty();

                    result.forEach((v) => {
                        $("#tableShowData > tbody").append(`
                            <tr class="text-center">
                                <td>
                                    <input type="checkbox" class="form-control check-item" style="transform: scale(0.5)" name="chk-data[]" id="chk-data[]" value="${v.id}"/>
                                </td>
                                <td>${v.tanggal}</td>
                                <td>${v.no_aktivitas}</td>
                                <td>Rp. ${numberFormat(v.nominal)}</td>
                            </tr>
                        `);
                    });

                    initDataTable("#tableShowData", [0, 1, 2, 3])

                } else {
                    $("#tableShowData > tbody").html(`<tr><td colspan="4" class="text-center text-danger">Data Kosong</td></tr>`);
                }

            });
    }

    const handleShowDataPenerimaan = () => {

        $("#showData").modal('show');
        $(".modal-title").html("Data Penerimaan");

        fetch('<?= base_url('Kas_bank/getDataPenerimaan'); ?>')
            .then(response => response.json())
            .then((result) => {

                if (result.length > 0) {
                    if ($.fn.DataTable.isDataTable('#tableShowData')) {
                        $('#tableShowData').DataTable().destroy();
                    }

                    $("#tableShowData > tbody").empty();

                    result.forEach((v) => {
                        $("#tableShowData > tbody").append(`
                            <tr class="text-center">
                                <td>
                                    <input type="checkbox" class="form-control check-item" style="transform: scale(0.5)" name="chk-data[]" id="chk-data[]" value="${v.id}"/>
                                </td>
                                <td>${v.tanggal}</td>
                                <td>${v.no_aktivitas}</td>
                                <td>Rp. ${numberFormat(v.nominal)}</td>
                            </tr>
                        `);
                    });

                    initDataTable("#tableShowData", [0, 1, 2, 3])

                } else {
                    $("#tableShowData > tbody").html(`<tr><td colspan="4" class="text-center text-danger">Data Kosong</td></tr>`);
                }

            });
    }


    function checkAllSJ(e) {
        var checkboxes = $("input[name='chk-data[]']");
        if (e.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                }
            }
        }
    }

    const handleChooseData = async () => {
        const type = $("#showData .modal-title").html().split(" ")[1].toLowerCase();

        let arr_chk = [];
        var checkboxes = $("input[name='chk-data[]']");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked == true && !(checkboxes[i].disabled)) {
                arr_chk.push(checkboxes[i].value);
            }
        }

        if (arr_chk.length == 0) {
            alert("Pilih data yang akan dipilih");
        } else {
            const url = "<?= base_url('Kas_bank/getDataByChecked') ?>";

            let postData = new FormData();
            postData.append('id', arr_chk);
            postData.append('type', type);

            const request = await fetch(url, {
                method: 'POST',
                body: postData
            });

            const response = await request.json();

            initDataToRincian(response, type);
            $("#showData").modal('hide');
            arr_chk.length = 0;
        }
    }

    const initDataToRincian = (response, type) => {

        if ($.fn.DataTable.isDataTable('#tableDataRincian')) {
            $('#tableDataRincian').DataTable().destroy();
        }

        response.forEach(function(v, i) {

            $("#tableDataRincian > tbody:last").append(`
                <tr>
                    <td>${v.tanggal} <input type="hidden" value="${type}, ${v.id}"></td>
                    <td>${v.no_aktivitas}</td>
                    <td>${numberFormat(v.nominal)}</td>
                    <td>
                        <input type="text" class="form-control numeric handleCountPenerimaan" ${type === "penerimaan" ? "disabled" : ""}>
                    </td>
                    <td>
                        <input type="text" class="form-control numeric handleCountPengeluaran" ${type === "pengiriman" ? "disabled" : ""}>
                    </td>
                    <td>
                        <input type="text" class="form-control" disabled id="sisaAktivitas">
                    </td>
                    <td>
                        <select class="form-control rekening" name="rekening" id="rekening" required></select>
                    </td>
                    <td>
                        <button type="button" class="deleteItem" style="border:none;background:transparent"><i class="fas fa-trash text-danger" style="cursor: pointer"></i></button>
                    </td>
                </tr>
            `);
        });

        $("#tableDataRincian > tbody tr").each(function(i, v) {
            let currentRow = $(this);
            let nominal = currentRow.find("td:eq(2)");
            let penerimaan = currentRow.find("td:eq(3) input[type='text']");
            let pengeluaran = currentRow.find("td:eq(4) input[type='text']");
            let sisaAktivitas = currentRow.find("td:eq(5) input[type='text']");

            penerimaan.keyup(function() {
                const valPenerimaan = penerimaan.val() == "" ? 0 : parseFloat(penerimaan.val())
                sisaAktivitas.val(numberFormat(parseFloat(nominal.text().replace(/,/g, '')) - valPenerimaan));
                countTotal()
            })

            pengeluaran.keyup(function() {
                const valPengeluaran = pengeluaran.val() == "" ? 0 : parseFloat(pengeluaran.val())
                sisaAktivitas.val(numberFormat(parseFloat(nominal.text().replace(/,/g, '')) - valPengeluaran));
                countTotal()
            })


        });


        fetch('<?= base_url('Kas_bank/getRekening'); ?>')
            .then(response => response.json())
            .then((result) => {
                $('.rekening').empty();
                let html = '';
                html += "<option value=''>--Pilih Rekening--</option>";
                result.forEach((v) => {
                    html += `<option value="${v.id}">${v.name}</option>`;
                });

                $('.rekening').append(html);
            });

        initDataTable("#tableDataRincian", [0, 1, 2, 3, 4, 5, 6, 7])
    }

    $(document).on("click", ".deleteItem", function() {
        $(this).parent().parent().remove();
    });

    const handleCloseModalShowData = () => {
        $("#showData").modal('hide');
        $("#tableShowData > tbody").empty();
    }

    const handleSaveData = () => {


        let arrId = [];
        let arrTgl = [];
        let arrNomorAktivitas = []
        let arrNominal = [];
        let arrPenerimaan = [];
        let arrPengeluaran = [];
        let arrSisaAktivitas = [];
        let arrRekening = [];
        let finalDetailData = [];

        if ($("#tanggal").val() == "") {
            alert('Tanggal tidak boleh kosong!')
            $("#error").val("1");
            return false;
        } else {
            $("#tableDataRincian tbody tr").each(function(i, v) {
                let id = $(this).find("td:eq(0) input[type='hidden']")
                let tgl = $(this).find("td:eq(0)")
                let nomorAktivitas = $(this).find("td:eq(1)")
                let nominal = $(this).find("td:eq(2)")
                let penerimaan = $(this).find("td:eq(3) input[type='text']")
                let pengeluaran = $(this).find("td:eq(4) input[type='text']")
                let sisaAktivitas = $(this).find("td:eq(5) input[type='text']")
                let rekening = $(this).find("td:eq(6) select").children("option").filter(":selected");

                if (tgl.attr('class') == "dataTables_empty") {
                    alert('Rincian kas kosong! minimal ada 1 data yang terisi')
                    $("#error").val("1");
                    return false;
                } else {
                    $("#error").val("0");
                }

                if (!penerimaan.attr('disabled')) {
                    if (penerimaan.val() == "") {
                        alert('Penerimaan tidak boleh kosong!')
                        $("#error").val("1");
                        return false;
                    } else {
                        $("#error").val("0");
                    }
                }

                if (!pengeluaran.attr('disabled')) {
                    if (pengeluaran.val() == "") {
                        alert('Pengeluaran tidak boleh kosong!')
                        $("#error").val("1");
                        return false;
                    } else {
                        $("#error").val("0");
                    }
                }

                if (rekening.val() == "") {
                    alert('Rekening tidak boleh kosong!')
                    $("#error").val("1");
                    return false;
                } else {
                    $("#error").val("0");
                }

                if ($("#error").val() == 0) {
                    id.map(function() {
                        arrId.push($(this).val());
                    }).get();

                    tgl.map(function() {
                        arrTgl.push($(this).text());
                    }).get();

                    nomorAktivitas.map(function() {
                        arrNomorAktivitas.push($(this).text());
                    }).get();

                    nominal.map(function() {
                        arrNominal.push(parseFloat($(this).text().replace(/,/g, '')));
                    }).get();

                    penerimaan.map(function() {
                        arrPenerimaan.push($(this).val());
                    }).get();

                    pengeluaran.map(function() {
                        arrPengeluaran.push($(this).val());
                    }).get();

                    sisaAktivitas.map(function() {
                        arrSisaAktivitas.push(parseFloat($(this).val().replace(/,/g, '')));
                    }).get();

                    rekening.map(function() {
                        arrRekening.push($(this).val());
                    }).get();
                } else {
                    return false
                }
            });
        }

        if ($("#error").val() != 0) {
            return false;
        } else {
            if (arrId != null) {
                for (let index = 0; index < arrId.length; index++) {
                    finalDetailData.push({
                        id: arrId[index],
                        tgl: arrTgl[index],
                        nomorAktivitas: arrNomorAktivitas[index],
                        nominal: arrNominal[index],
                        penerimaan: arrPenerimaan[index],
                        pengeluaran: arrPengeluaran[index],
                        sisaAktivitas: arrSisaAktivitas[index],
                        rekening: arrRekening[index],
                    });
                }
            }

            const datas = {
                tgl: $("#tanggal").val(),
                noKasBank: $("#nomor_kas_bank").val(),
                keterangan: $("#keterangan").val(),
                totPenerimaan: parseFloat($("#penerimaan_sementara").val().replace(/,/g, '')),
                totPengeluaran: parseFloat($("#pengeluaran_sementara").val().replace(/,/g, '')),
                detailData: finalDetailData
            }

            $.ajax({
                url: "<?= base_url('Kas_bank/save'); ?>",
                type: "POST",
                data: datas,
                dataType: "JSON",
                success: function(response) {
                    if (response) {
                        location.href = "<?= base_url('Kas_bank') ?>"
                    } else {
                        alert('tambah data gagal');
                    }
                }
            })

        }
    }
</script>