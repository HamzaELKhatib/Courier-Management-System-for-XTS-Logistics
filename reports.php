<?php include 'db_connect.php' ?>
<?php $status = isset($_GET['status']) ? $_GET['status'] : 'all' ?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                <?php
                $status_arr = array("Enregistré","Envoyé","Livré en gars","Livré à domicile"); ?>
                <label for="date_from" class="mx-1">Status</label>
                <select name="" id="status" class="custom-select custom-select-sm col-sm-3">
                    <option value="all" <?php echo $status == 'all' ? "selected" : '' ?>>Tout<br> </option>
                    <?php foreach ($status_arr as $k => $v): ?>
                        <option value="<?php echo $k ?>" <?php echo $status != 'all' && $status == $k ? "selected" : '' ?>><?php echo $v; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="date_from" class="mx-1">From</label>
                <input type="date" id="date_from" class="form-control form-control-sm col-sm-3"
                       value="<?php echo isset($_GET['date_from']) ? date("Y-m-d", strtotime($_GET['date_from'])) : '' ?>">
                <label for="date_to" class="mx-1">To</label>
                <input type="date" id="date_to" class="form-control form-control-sm col-sm-3"
                       value="<?php echo isset($_GET['date_to']) ? date("Y-m-d", strtotime($_GET['date_to'])) : '' ?>">
                <button class="btn btn-sm btn-primary mx-1 bg-gradient-primary" type="button" id='view_report'>Voir Rapport
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success float-right" style="display: none" id="print">
                                <i class="fa fa-print"></i> Print
                            </button>
                        </div>
                    </div>

                    <table class="table table-bordered" id="report-list">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Expéditeur</th>
                            <th>Destinataire</th>
                            <th>Montant</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <th colspan="3"></th>
                        <th class="text-right">Total :</th>
                        <th id="tAmount" class="text-right"></th>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!---------------Printable Page (similaire à ctrl+p)---------------->
<noscript>
    <style>
        table.table {
            width: 100%;
            border-collapse: collapse;
        }

        table.table tr, table.table th, table.table td {
            border: 1px solid;
        }

        .text-center {
            text-align: center;
        }
    </style>
    <h3 class="text-cnter"><b>Rapoooooooooort</b></h3>
</noscript>
<div class="details d-none">
    <p><b>Plage de dates:</b> <span class="drange"></span></p>
    <p><b>Status:</b> <span class="status-field">All</span></p>
</div>
<script>
    function load_report() {
        start_load()
        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val()
        var status = $('#status').val()
        let sum = 0
        $.ajax({
            url: 'ajax.php?action=get_report',
            method: 'POST',
            data: {status: status, date_from: date_from, date_to: date_to},
            error: err => {
                console.log(err)
                alert_toast("An error occured", 'error')
                end_load()
            },
            success: function (resp) {
                if (typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object') {
                    resp = JSON.parse(resp)
                    if (Object.keys(resp).length > 0) {
                        $('#report-list tbody').html('')
                        var i = 1;
                        Object.keys(resp).map(function (k) {
                            var tr = $('<tr></tr>')
                            tr.append('<td>' + (i++) + '</td>')
                            tr.append('<td>' + (resp[k].date_created) + '</td>')
                            tr.append('<td>' + (resp[k].sender_name) + '</td>')
                            tr.append('<td>' + (resp[k].recipient_name) + '</td>')
                            tr.append('<td>' + (resp[k].price) + ' dh' + '</td>')
                            tr.append('<td>' + (resp[k].status) + '</td>')
                            $('#report-list tbody').append(tr)
                            //-------------------------------------------
                            //Sum of colomn numbers
                            sum = sum + parseFloat(resp[k].price.replace(/\,/g, ''), 10)
                            //console.log(sum)
                            //-------------------------------------------
                        })

                        $('#tAmount').append(sum + " dh")

                        $('#print').show()
                    } else {
                        $('#report-list tbody').html('')
                        var tr = $('<tr></tr>')
                        tr.append('<th class="text-center" colspan="6">Pas de résultat.</th>')
                        $('#report-list tbody').append(tr)
                        $('#print').hide()
                    }
                }
            }
            , complete: function () {
                end_load()
            }
        })
    }

    $('#view_report').click(function () {
        $('#tAmount').empty()
        if ($('#date_from').val() == '' || $('#date_to').val() == '') {
            alert_toast("Veuillez d'abord sélectionner les dates.", "error")
            return false;
        }

        load_report()
        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val()
        var status = $('#status').val()
        var target = './index.php?page=reports&filtered&date_from=' + date_from + '&date_to=' + date_to + '&status=' + status
        window.history.pushState({}, null, target);
    })

    $(document).ready(function () {
        if ('<?php echo isset($_GET['filtered']) ?>' == 1)
            load_report()
    })
    $('#print').click(function () {
        start_load()
        var ns = $('noscript').clone()
        var details = $('.details').clone()
        var content = $('#report-list').clone()
        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val()
        var status = $('#status').val()
        var stat_arr = '<?php echo json_encode($status_arr) ?>';
        stat_arr = JSON.parse(stat_arr);
        details.find('.drange').text(date_from + " to " + date_to)
        if (status > -1)
            details.find('.status-field').text(stat_arr[status])
        ns.append(details)

        ns.append(content)
        var nw = window.open('', '', 'height=700,width=900')
        nw.document.write(ns.html())
        nw.document.close()
        nw.print()
        setTimeout(function () {
            nw.close()
            end_load()
        }, 750)

    })

</script>

